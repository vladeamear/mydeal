<?php
require_once 'vendor/autoload.php';

$con = mysqli_connect('localhost','root','root','mydeal');
if ($con==false){
    print("ошибка подключения: ".mysqli_connect_error());
}

// $transport = new Swift_SmtpTransport('smtp.yandex.org', 25);
// $massage = new Swift_Message("Уведомление от сервиса «Дела в порядке»");

mysqli_set_charset($con, "utf8");

$list_0f_users = mysqli_query($con, "SELECT `email`, `author` FROM `users`");

$users = mysqli_fetch_all($list_0f_users, MYSQLI_ASSOC);

for ($i = 0; $i < count($users); $i++){
    $undone = mysqli_query($con, "SELECT `task_name`, `deadline` FROM `tasks` WHERE `email` = '{$users[$i]['email']}' AND `deadline` = CURRENT_DATE() AND `task_status` = 0");
    $undone = mysqli_fetch_all($undone, MYSQLI_ASSOC);
    if(!empty($undone)){
        $transport = new Swift_SmtpTransport('smtp.yandex.org', 25);
        $massage = new Swift_Message("Уведомление от сервиса «Дела в порядке»");
        $s = '';
        $massage -> setTo([$users[$i]['email'] => 'user']);
        for ($j = 1; $j < count($undone); $j++){
            $s = $s . ', задача ' . $undone[$j]['task_name'] . ' на ' . $undone[$j]['deadline'];
        }
        $massage -> setBody('Уважаемый, ' . $users[$i]['author'] . '. У вас запланирована задача ' . $undone[0]['task_name'] . ' на ' . $undone[0]['deadline'] . $s);
        $massage -> setFrom('looser.s.usami@yandex.ru', 'ДелаВПорядке');
        $mailer = new Swift_Mailer($transport);
        $mailer -> send($massage);
    }
};

?>