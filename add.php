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
            return "слишком много букав!";
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
            $errors[$key] = "поле заполни";
    }
    if ($_POST['project'] == 'Выбрать')
        $errors['project'] = 'Выбери';

    $link_to_file = '';
    if(isset($_FILES['file']['name'])){

        $uploaddir = 'uploads/';
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        
        echo '<pre>';
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }
        
        echo 'Некоторая отладочная информация:';
        print_r($_FILES);
        
        print "</pre>";
        $link_to_file = '';

        // $tmp_name = $_FILES['file']['tmp_name'];
        // $path = $_FILES['file']['name'];
        // $file_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE),$tmp_name);
        // $filename = uniqid() . $file_type;
        // $link_to_file = 'uploads/' . $filename;
        // move_uploaded_file($tmp_name, $link_to_file);
        // $file['path'] = $filename;
    }

    if (count($errors)){
        $page_content = include_template('add.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => $errors]);
    }
    else{
        $sql = mysqli_query($con, "INSERT INTO tasks SET
            task_name = '{$_POST['name']}', 
            moment_of_creation = NOW(), 
            file_link = '{$link_to_file}', 
            deadline = '{$_POST['date']}', 
            task_status = 0,
            project_name = '{$_POST['project']}', 
            author = '{$username}';
        ");
        $page_content = include_template('add.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => []]);
    }

}
else{
    $page_content = include_template('add.php', ['projects' => $projects_from_db, 'tasks' => $tasks_from_db, 'errors' => []]);
}

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $username]);
print($layout_content);

?>