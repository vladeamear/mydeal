<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$projects = array(
    'Работа','Учеба','Входящие','Домашние дела','Авто'
);

$tasks = array(
    array('Собеседование в IT компании', '01.12.2019', 'Работа', false),
    array('Выполнить тестовое задание', '19.10.2020', 'Работа', false),
    array('Сделать задание первого раздела', '21.12.2019', 'Учеба', true),
    array('Встреча с другом', '22.12.2019', 'Входящие', false),
    array('Купить корм для кота', 'null', 'Домашние дела', false),
    array('Заказать пиццу', 'null', 'Домашние дела', false)
);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Дела в порядке</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/flatpickr.min.css">
</head>

<body>
<h1 class="visually-hidden">Дела в порядке</h1>

<div class="page-wrapper">
    <div class="container container--with-sidebar">
        <header class="main-header">
            <a href="/">
                <img src="img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
            </a>

            <div class="main-header__side">
                <a class="main-header__side-item button button--plus open-modal" href="pages/form-task.html">Добавить задачу</a>

                <div class="main-header__side-item user-menu">
                    <div class="user-menu__data">
                        <p>Константин</p>

                        <a href="#">Выйти</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="content">
            <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list">
                    <?
                    foreach ($projects as $v){
                    ?>
                        <li class="main-navigation__list-item">
                            <a class="main-navigation__list-item-link" href="#"><?=$v?></a>
                            <span class="main-navigation__list-item-count">0</span>
                        </li>
                    <?
                    }
                    ?>
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="pages/form-project.html" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" <? 
                        if($show_complete_tasks == 1) echo 'checked' 
                        ?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                    <?
                        foreach ($tasks as $t){
                    ?>
                    <tr class="tasks__item task <?
                        if ($t[3] == true) echo 'task--completed'
                    ?>">
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden" type="checkbox" <?
                                    if ($t[3] == true) echo 'checked'
                                ?>>
                                <span class="checkbox__text"><?=$t[0]?></span>
                            </label>
                        </td>
                        <td class="task__date"><?=$t[2]?></td>
                        <td class="task__controls"></td>
                    </tr>
                    <?
                    }
                    ?>
                </table>
            </main>
        </div>
    </div>
</div>
<script src="flatpickr.js"></script>
<script src="script.js"></script>
</body>
</html>
