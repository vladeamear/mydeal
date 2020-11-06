<?php
    $projects = $data['projects'];
    $tasks = $data['tasks'];
    $show_complete_tasks = $data['toshowornottoshow'];
    function getGetVal($name){
      return $_GET[$name] ?? "";
    }  
?>
            <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list">
                        <?php
                            for ($i = 0; $i < count($projects); $i++){
                        ?>
                        <li class="main-navigation__list-item <?php
                            if (isset($pname) and $projects[$i]["project_name"] == $pname)
                                echo 'main-navigation__list-item--active';
                        ?>">
                            <a class="main-navigation__list-item-link" href="?tab=<?=$projects[$i]["id_projects"]?>">
                                <?=$projects[$i]["project_name"]?>
                            </a>
                            <span class="main-navigation__list-item-count"><?=howmuch($tasks,$projects[$i]["project_name"])?></span>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="project.php">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <!-- <> -->

                <form class="search-form" action="" method="GET" autocomplete="off">
                    <input class="search-form__input" type="text" name="search" value="<?=getGetVal('search')?>" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <!-- <> -->

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                    <!-- tasks-switch__item--active -->
                        <a href="?d=0" class="tasks-switch__item <?php
                            if($_GET['d'] == 0 || !$_GET['d']) echo 'tasks-switch__item--active'
                        ?>">Все задачи</a>
                        <a href="?d=1" class="tasks-switch__item <?php
                            if($_GET['d'] == 1) echo 'tasks-switch__item--active'
                        ?>">Повестка дня</a>
                        <a href="?d=2" class="tasks-switch__item <?php
                            if($_GET['d'] == 2) echo 'tasks-switch__item--active'
                        ?>">Завтра</a>
                        <a href="?d=3" class="tasks-switch__item <?php
                            if($_GET['d'] == 3) echo 'tasks-switch__item--active'
                        ?>">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" name="state" type="checkbox">
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                    <?php 
                    if(!$stasks){
                    ?>
                    <tr>
                        Ничего не найдено по вашему запросу <br /><br />
                        <a class="button button--transparent content__side-button" href="/">На главную</a>
                    </tr>
                    <?php
                    } else{
                        for ($i = 0; $i <count($stasks); $i++){


                                $k = abs(strtotime(date('Y-m-d'))-strtotime($stasks[$i]["deadline"]));

                            if ($show_complete_tasks == 0 && $stasks[$i]["task_status"]==1)
                                continue;
                    ?>
                    <tr class="tasks__item task <?php 
                        if($stasks[$i][3]==true) echo 'task--completed';
                        if($k < 86400) echo 'task--important';
                        ?>">
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden" type="checkbox" <?php if($stasks[$i]["task_status"]==1) echo 'checked'?>>
                                <span class="checkbox__text"><?=$stasks[$i]["task_name"]?></span>
                            </label>
                        </td>
                        <td class="task__date"><?=$stasks[$i]["deadline"]?></td>
                        <td class="task__controls"><a href="/<?=$stasks[$i]["file_link"]?>"><?=$stasks[$i]["file_link"]?></a></td>
                    </tr>
                    <?
                        }
                    }
                    ?>
                </table>
            </main>
    