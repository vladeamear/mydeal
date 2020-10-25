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

$list_0f_projects = mysqli_query($con, "SELECT `project_name` FROM `projects` WHERE `author` = '$username'");
$list_0f_tasks = mysqli_query($con, "SELECT `task_name`, `deadline`, `project_name`, `task_status` FROM `tasks` WHERE `author` = '$username'");

if(!$list_0f_projects || !$list_0f_tasks){
    $error = mysqli_error($con);
    print('Ошибка MySQL: '.$error);
}

$projects_from_db = mysqli_fetch_all($list_0f_projects, MYSQLI_ASSOC);
$tasks_from_db = mysqli_fetch_all($list_0f_tasks, MYSQLI_ASSOC);

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$projects = array(
    'Работа','Учеба','Входящие','Домашние дела','Авто'
);

$tasks = array(
    array('Собеседование в IT компании', '01.12.2019', 'Работа', false),
    array('Выполнить тестовое задание', '20.10.2020', 'Работа', false),
    array('Сделать задание первого раздела', '21.12.2019', 'Учеба', true),
    array('Встреча с другом', '22.12.2019', 'Входящие', false),
    array('Купить корм для кота', 'null', 'Домашние дела', false),
    array('Заказать пиццу', 'null', 'Домашние дела', false)
);

function howmuch($innertasks,$projectname){
    $j = 0;
    for ($i = 0; $i < count($innertasks); $i++){
        if($innertasks[$i][2] == $projectname)
            $j++;
    }
    return $j;
}

$page_content = include_template('main.php', ['projects' => $projects, 'tasks' => $tasks, 'toshowornottoshow' => $show_complete_tasks]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);

print($layout_content);

?>