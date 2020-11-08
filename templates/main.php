<?php
    $projects = $data['projects'];
    $tasks = $data['tasks'];
    include 'content_side.php';
?>
            

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="" method="GET" autocomplete="off">
                    <input class="search-form__input" type="text" name="search" value="<?=getGetVal('search')?>" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="<?=addGet('time',0)?>" class="tasks-switch__item <?php
                            if($_GET['time'] == 0 || !$_GET['time']) echo 'tasks-switch__item--active'
                        ?>">Все задачи</a>
                        <a href="<?=addGet('time',1)?>" class="tasks-switch__item <?php
                            if($_GET['time'] == 1) echo 'tasks-switch__item--active'
                        ?>">Повестка дня</a>
                        <a href="<?=addGet('time',2)?>" class="tasks-switch__item <?php
                            if($_GET['time'] == 2) echo 'tasks-switch__item--active'
                        ?>">Завтра</a>
                        <a href="<?=addGet('time',3)?>" class="tasks-switch__item <?php
                            if($_GET['time'] == 3) echo 'tasks-switch__item--active'
                        ?>">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <input class="checkbox__input visually-hidden show_completed" name="state" type="checkbox" <?php
                            if (!empty($_GET['show_completed']) && $_GET['show_completed'] == 1) echo 'checked';
                        ?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                    <?php 
                    if(!$stasks){
                    ?>
                    <tr>
                        По вашему запросу ничего не найдено. <br /><br />
                        <a class="button button--transparent content__side-button" href="/">На главную</a>
                    </tr>
                    <?php
                    } else{
                        $j=0;
                        for ($i = 0; $i <count($stasks); $i++){


                                $k = abs(strtotime(date('Y-m-d'))-strtotime($stasks[$i]["deadline"]));

                            if ((empty($_GET['show_completed']) || $_GET['show_completed']==0) && $stasks[$i]["task_status"]==1){
                                $j++;
                                continue;
                            }
                                
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
                    <?php
                        }
                        if($j == count($stasks)){
                    ?>
                    <tr>Все задачи выполнены. Чтобы увидеть их нажмите "Показать выполненные".</tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </main>
    