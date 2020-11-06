<?php
session_start();

define('CACHE_DIR', basename(__DIR__ . DIRECTORY_SEPARATOR . 'cache'));
define('UPLOAD_PATH', basename(__DIR__ . DIRECTORY_SEPARATOR . 'uploads'));

function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

$con = mysqli_connect('localhost','root','root','mydeal');
if ($con==false){
    print("ошибка подключения: ".mysqli_connect_error());
}

mysqli_set_charset($con, "utf8");

// $useremail = !$_SESSION['user']['email'];

if(!$_SESSION){
    $page_content = include_template('guest.php', []);
    $layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'Дела в порядке']);
} else {
$useremail = $_SESSION['user']['email'];
$list_0f_projects = mysqli_query($con, "SELECT `project_name`, `id_projects` FROM `projects` WHERE `email` = '$useremail'");
$list_0f_tasks = mysqli_query($con, "SELECT `task_name`, `deadline`, `project_name`, `task_status`,`file_link` FROM `tasks` WHERE `email` = '$useremail'");
$username = mysqli_query($con, "SELECT `author` FROM `users` WHERE `email` = '$useremail'");
$username = mysqli_fetch_all($username, MYSQLI_ASSOC)[0]['author'];

if(!$list_0f_projects || !$list_0f_tasks){
    $error = mysqli_error($con);
    print('Ошибка MySQL: '.$error);
}

$projects_from_db = mysqli_fetch_all($list_0f_projects, MYSQLI_ASSOC);
$tasks_from_db = mysqli_fetch_all($list_0f_tasks, MYSQLI_ASSOC);

$show_complete_tasks = rand(0, 1);

function howmuch($innertasks,$projectname){
    $j = 0;
    for ($i = 0; $i < count($innertasks); $i++){
        if($innertasks[$i]["project_name"] == $projectname)
            $j++;
    }
    return $j;
}

if (isset($_GET['search'])){
    $search = trim($_GET['search']);
    if($search){
        mysqli_query($con, 'CREATE FULLTEXT INDEX search ON tasks(task_name)');
        $sql = "SELECT `task_name`, `deadline`, `project_name`, `task_status`,`file_link` FROM `tasks` "
        . "WHERE (`email` = '{$useremail}') AND (MATCH(task_name) AGAINST ('{$search}'))";
        $list_0f_tasks = mysqli_query($con, $sql);
        $tasks_from_db = mysqli_fetch_all($list_0f_tasks, MYSQLI_ASSOC);
    }
}

$pname = "";
$stasks = $tasks_from_db;

if (isset($_GET['tab']) &&  $tasks_from_db != ['НЕТ РЕЗУЛЬАТОВ']){
    $pname = $_GET['tab'];
    for($i = 0; $i < count($projects_from_db); $i++){
        if ($pname == $projects_from_db[$i]["id_projects"])
            $pname = $projects_from_db[$i]["project_name"];
    }
    for($i = count($tasks_from_db)-1; $i >= 0; $i--){
        if ($pname != $stasks[$i]["project_name"])
            array_splice($stasks, $i, 1);
    }
}

$page_content = include_template('main.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'pname' => $pname, 'stasks' => $stasks, 'toshowornottoshow' => $show_complete_tasks]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);
}

print($layout_content);

?>