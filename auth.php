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

$list_0f_users = mysqli_query($con, "SELECT `author`, `email`,`user_password` FROM `users` WHERE 1");

$users_from_db = mysqli_fetch_all($list_0f_users, MYSQLI_ASSOC);

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $form = $_POST;

    $required = ['email', 'password'];

    for($i = 0; $i < count($users_from_db); $i++){
        if($users_from_db[$i]['email'] == $form['email']){
            $errors['email'] = NULL;
            $hash = $users_from_db[$i]['user_password'];
            break;
        } else {
            $errors['email'] = 'Такого e-mail не существует';
        }
    }

    if (filter_var($form['email'],FILTER_VALIDATE_EMAIL) == false){
        $errors['email'] = 'E-mail должен быть корректным';
    }

    if(!$errors['email']){
        if(!password_verify($form['password'], $hash)){
            $errors['password'] = 'Неверный пароль';
        }
    } else {
        $errors['password'] = 'Введите корректный e-mail';
    }
    
    foreach($required as $field){
        if (empty($form[$field]))
            $errors[$field] = 'Заполните поле';
    }


    $errors = array_filter($errors);

    if(!count($errors)){
        $user = mysqli_query($con, "SELECT * FROM `users` WHERE email = '{$form['email']}'");
        $user = mysqli_fetch_array($user, MYSQLI_ASSOC);
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit();
    }
}
if(isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
$page_content = include_template('auth.php', ['errors' => $errors]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'Вход']);
print($layout_content);

?>