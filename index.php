<?php

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

$username = 'Константин';

$list_0f_projects = mysqli_query($con, "SELECT `project_name`, `id_projects` FROM `projects` WHERE `author` = '$username'");
$list_0f_tasks = mysqli_query($con, "SELECT `task_name`, `deadline`, `project_name`, `task_status` FROM `tasks` WHERE `author` = '$username'");

if(!$list_0f_projects || !$list_0f_tasks){
    $error = mysqli_error($con);
    print('Ошибка MySQL: '.$error);
}


$projects_from_db = mysqli_fetch_all($list_0f_projects, MYSQLI_ASSOC);
$tasks_from_db = mysqli_fetch_all($list_0f_tasks, MYSQLI_ASSOC);


// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

function howmuch($innertasks,$projectname){
    $j = 0;
    for ($i = 0; $i < count($innertasks); $i++){
        if($innertasks[$i]["project_name"] == $projectname)
            $j++;
    }
    return $j;
}

$pname = "";
$stasks = $tasks_from_db;
$page = 'main.php';

if (isset($_GET['tab']) && ($_GET['tab']) != 0){
    $pname = $_GET['tab'];
    for($i = 0; $i < count($projects_from_db); $i++){
        if ($pname == $projects_from_db[$i]["id_projects"])
            $pname = $projects_from_db[$i]["project_name"];
    }
    for($i = count($tasks_from_db)-1; $i >= 0; $i--){
        if ($pname != $stasks[$i]["project_name"])
            array_splice($stasks, $i, 1);
    }
    $page = 'main.php';
}

if (isset($_GET['tab']) && ($_GET['tab']) == 0)
    $page = 'add.php';

$page_content = include_template($page, ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'pname' => $pname, 'stasks' => $stasks, 'toshowornottoshow' => $show_complete_tasks]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);

print($layout_content);

?>