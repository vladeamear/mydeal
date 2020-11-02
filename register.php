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

    $required = ['email', 'password', 'name'];

    if (filter_var($form['email'],FILTER_VALIDATE_EMAIL) == false){
        $errors['email'] = 'E-mail должен быть корректным';
    }
    foreach($required as $field){
        if (empty($form[$field]))
            $errors[$field] = 'Это поле надо заполнить';
    }

    $email = "'" . $form['email'] . "'";
    $sql = "SELECT * FROM users WHERE email = $email";
    $res = mysqli_fetch_all(mysqli_query($con, $sql), MYSQLI_ASSOC);

    if(count($res))
        $errors['email'] = 'Пользователь с этим E-mail уже зарегестрирован';

    if (!count($errors)){
        $password = password_hash($form['password'], PASSWORD_DEFAULT);
        $sql = mysqli_query($con, "INSERT INTO users SET
            author = '{$form['name']}', 
            register_date = NOW(), 
            email = '{$form['email']}',
            user_password = '{$password}' 
        ");
        header ('Location: index.php');
        exit(); 
    }
}

$layout_content = include_template('register.php', ['errors' => $errors, 'title' => 'Регистрация']);
print($layout_content);

?>