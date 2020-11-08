<?php

require_once "init+functions.php";

if(!$_SESSION){
    $page_content = include_template('guest.php', []);
    $layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'Дела в порядке']);
} else {
    
$d = '';
if (isset($_GET['time'])){
    switch($_GET['time']){
        case(1):
            $d = "AND CURDATE() = DATE(`deadline`)";
            break;
        case(2):
            $d = "AND CURDATE()+1 = DATE(`deadline`)";
            break;
        case(3):
            $d = "AND CURDATE() > DATE(`deadline`)";
            break;
        default:
            break;
    }
}


$useremail = $_SESSION['user']['email'];
$list_0f_projects = mysqli_query($con, "SELECT `project_name`, `id_projects` FROM `projects` WHERE `email` = '$useremail'");
$list_0f_tasks = mysqli_query($con, "SELECT `id_tasks`,`task_name`, `deadline`, `project_name`, `task_status`,`file_link` FROM `tasks` WHERE `email` = '$useremail'");
$list_0f_stasks = mysqli_query($con, "SELECT `id_tasks`,`task_name`, `deadline`, `project_name`, `task_status`,`file_link` FROM `tasks` WHERE `email` = '$useremail' $d");
$username = mysqli_query($con, "SELECT `author` FROM `users` WHERE `email` = '$useremail'");
$username = mysqli_fetch_all($username, MYSQLI_ASSOC)[0]['author'];

if(!$list_0f_projects || !$list_0f_tasks){
    $error = mysqli_error($con);
    print('Ошибка MySQL: '.$error);
}

$projects_from_db = mysqli_fetch_all($list_0f_projects, MYSQLI_ASSOC);
$tasks_from_db = mysqli_fetch_all($list_0f_tasks, MYSQLI_ASSOC);
$stasks = mysqli_fetch_all($list_0f_stasks, MYSQLI_ASSOC);

$pname = "";

if (isset($_GET['tab'])){
    $pname = $_GET['tab'];
    for($i = 0; $i < count($projects_from_db); $i++){
        if ($pname == $projects_from_db[$i]["id_projects"])
            $pname = $projects_from_db[$i]["project_name"];
    }
    for($i = count($stasks)-1; $i >= 0; $i--){
        if ($pname != $stasks[$i]["project_name"])
            array_splice($stasks, $i, 1);
    }
}

if (isset($_GET['search'])){
    $search = trim($_GET['search']);
    if($search){
        mysqli_query($con, 'CREATE FULLTEXT INDEX search ON tasks(task_name)');
        $sql = "SELECT `task_name`, `deadline`, `project_name`, `task_status`,`file_link` FROM `tasks` "
        . "WHERE (`email` = '{$useremail}') AND (MATCH(task_name) AGAINST ('{$search}')) $d";
        $stasks = mysqli_query($con, $sql);
        $stasks = mysqli_fetch_all($stasks, MYSQLI_ASSOC);
    }
}


$page_content = include_template('main.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'pname' => $pname, 'stasks' => $stasks]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);
}

print($layout_content);

?>