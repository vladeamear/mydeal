<?php

require_once "init+functions.php";

$useremail = $_SESSION['user']['email'];

$list_0f_projects = mysqli_query($con, "SELECT `project_name`, `id_projects` FROM `projects` WHERE `email` = '$useremail'");
$list_0f_tasks = mysqli_query($con, "SELECT `task_name`, `deadline`, `project_name`, `task_status`,`file_link` FROM `tasks` WHERE `email` = '$useremail'");
$username = mysqli_query($con, "SELECT `author` FROM `users` WHERE `email` = '$useremail'");
$username = mysqli_fetch_all($username, MYSQLI_ASSOC)[0]['author'];

$projects_from_db = mysqli_fetch_all($list_0f_projects, MYSQLI_ASSOC);
$tasks_from_db = mysqli_fetch_all($list_0f_tasks, MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $text = $_POST['name'];

    $errors = [];

    if(empty($text)){
        $errors['name'] = "Необходимо заполнить поле";
    } else if(strlen($text) > 20){
        $errors['name'] = "В названии должно быть меньше символов";
    } else {
        for ($i = 0; $i < count($projects_from_db); $i++){
            if($text == $projects_from_db[$i]['project_name']){
                $errors['name'] = "У вас уже есть проект с таким названием";
                break;
            }
        }
    }

    if (count($errors)){
        $page_content = include_template('project.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => $errors]);
    }
    else{
        $sql = mysqli_query($con, "INSERT INTO projects SET
            project_name = '{$text}', 
            email = '{$useremail}';
        ");
        header ('Location: index.php');
        exit(); 
    }

}
else{
    $page_content = include_template('project.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => []]);
}

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);
print($layout_content);

?>