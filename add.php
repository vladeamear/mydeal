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

function howmuch($innertasks,$projectname){
    $j = 0;
    for ($i = 0; $i < count($innertasks); $i++){
        if($innertasks[$i]["project_name"] == $projectname)
            $j++;
    }
    return $j;
}

$con = mysqli_connect('localhost','root','root','mydeal');
if ($con==false){
    print("ошибка подключения: ".mysqli_connect_error());
}

mysqli_set_charset($con, "utf8");

$username = 'Константин';

$list_0f_projects = mysqli_query($con, "SELECT `project_name`, `id_projects` FROM `projects` WHERE `author` = '$username'");
$list_0f_tasks = mysqli_query($con, "SELECT `task_name`, `deadline`, `project_name`, `task_status` FROM `tasks` WHERE `author` = '$username'");

$projects_from_db = mysqli_fetch_all($list_0f_projects, MYSQLI_ASSOC);
$tasks_from_db = mysqli_fetch_all($list_0f_tasks, MYSQLI_ASSOC);





if($_SERVER['REQUEST_METHOD'] == 'POST'){

    function validLen(){
        $len = strlen($_POST['name']);
        if($len > 40)
            return "В названии должно быть до 40 символов";
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
        if (isset($rules[$key])){
            $rule = $rules[$key];
            $errors[$key] = $rule();
        }
    }

    $errors = array_filter($errors);
    
    foreach($required as $key){
        if(empty($_POST[$key]))
            $errors[$key] = "Необходимо заполнить поле";
    }
    if ($_POST['project'] == 'Выбрать')
        $errors['project'] = 'Необходимо выбрать проект';

    if($_FILES["file"]["name"] != ""){
        $tmp_name = $_FILES["file"]["tmp_name"];
        $name = basename($_FILES["file"]["name"]);
        $type = $_FILES["file"]["type"];
        if ($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
            $type = "doc";
        else{
            $pos = strpos($type,"/");
            $type = substr($type, $pos+1);
        }
        $filename = uniqid() . '.' .$type;
        move_uploaded_file($tmp_name, "uploads/$filename");
        $link_to_file = "uploads/$filename";
    }
    else $link_to_file = '';

    if(empty($_POST['date'])){
        $date = 'NULL';
    }
    else $date = '"' . $_POST['date'] . '"';

    if (count($errors)){
        $page_content = include_template('add.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => $errors]);
    }
    else{
        $sql = mysqli_query($con, "INSERT INTO tasks SET
            task_name = '{$_POST['name']}', 
            moment_of_creation = NOW(), 
            file_link = '{$link_to_file}', 
            deadline = {$date}, 
            task_status = 0,
            project_name = '{$_POST['project']}', 
            author = '{$username}';
        ");
        // $page_content = include_template('add.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => []]);
        header ('Location: index.php');
        exit(); 
    }

}
else{
    $page_content = include_template('add.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => []]);
}

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);
print($layout_content);

?>