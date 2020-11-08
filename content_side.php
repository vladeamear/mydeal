<?php
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
                            <a class="main-navigation__list-item-link" href="<?=addGet('tab',$projects[$i]["id_projects"])?>">
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