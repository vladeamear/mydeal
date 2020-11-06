<?php

require_once "init+functions.php";

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
        $user = mysqli_query($con, "SELECT * FROM `users` WHERE email = '{$form['email']}'");
        $user = mysqli_fetch_array($user, MYSQLI_ASSOC);
        $_SESSION['user'] = $user;
        header ('Location: index.php');
        exit(); 
    }
}
$page_content = include_template('register.php', ['errors' => $errors]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'Регистрация']);
print($layout_content);

?>