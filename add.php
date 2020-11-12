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

    $text = htmlspecialchars($_POST['name']);

    function validLen(){
        $len = strlen(htmlspecialchars($_POST['name']));
        if($len > 100){
            return "В названии должно быть меньше символов";
        }
        return null;
    }

    $required = ['name','project'];
    $errors = [];

    $rules = [
        'name' => function(){
            return validLen();
        }
    ];

    foreach($_POST as $key => $value){
        if(isset($rules[$key])){
            $rule = $rules[$key];
            $errors[$key] = $rule();
        }
    }

    $errors = array_filter($errors);
    
    foreach($required as $key){
        if(empty($_POST[$key])){
            $errors[$key] = "Необходимо заполнить поле";
        }
    }
    if($_POST['project'] == 'Выбрать'){
        $errors['project'] = 'Необходимо выбрать проект';
    }

    if($_FILES["file"]["name"] != ""){
        $tmp_name = $_FILES["file"]["tmp_name"];
        $name = basename($_FILES["file"]["name"]);
        $type = $_FILES["file"]["type"];
        if($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
            $type = "doc";
        }
        else{
            $pos = strpos($type,"/");
            $type = substr($type, $pos+1);
        }
        $filename = uniqid() . '.' .$type;
        move_uploaded_file($tmp_name, "uploads/$filename");
        $link_to_file = "uploads/$filename";
    } else {
        $link_to_file = '';
    }

    if(empty($_POST['date'])){
        $date = 'NULL';
    } else {
        $date = '"' . $_POST['date'] . '"';
    }

    if(count($errors)){
        $page_content = include_template('add.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => $errors]);
    } else {
        $sql = mysqli_query($con, "INSERT INTO tasks SET
            task_name = '{$text}', 
            moment_of_creation = NOW(), 
            file_link = '{$link_to_file}', 
            deadline = {$date}, 
            task_status = 0,
            project_name = '{$_POST['project']}', 
            email = '{$useremail}';
        ");
        header ('Location: index.php');
        exit(); 
    }

} else {
    $page_content = include_template('add.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => []]);
}

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);
print($layout_content);

?>