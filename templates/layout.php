<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?=$data['title']?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/flatpickr.min.css">
</head>

<body>
<h1 class="visually-hidden">Дела в порядке</h1>

<div class="page-wrapper <?php
    if ($data['title'] == 'Дела в порядке') echo 'body-background';
?>">
    <div class="container container--with-sidebar">
        <header class="main-header">
            <a href="/">
                <img src="img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
            </a>

            <?
                if($data['title'] != 'Регистрация' && $data['title'] != 'Вход' && $data['title'] != 'Дела в порядке'){
            ?>

            <div class="main-header__side">
                <a class="main-header__side-item button button--plus open-modal" href="add.php">Добавить задачу</a>

                <div class="main-header__side-item user-menu">
                    <div class="user-menu__data">
                        <p><?=$data['title']?></p>

                        <a href="#">Выйти</a>
                    </div>
                </div>
            </div>
            <?
                }else{
            ?>
             <div class="main-header__side">
                <a class="main-header__side-item button button--transparent" href="auth.php">Войти</a>
            </div>
            <?
                }
            ?>
        </header>
        <div class="content">

        <?=$data['content'];?> 

        </div>
    </div>
</div>

<script src="flatpickr.js"></script>
<script src="script.js"></script>
</body>
</html>