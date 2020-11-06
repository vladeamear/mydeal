<?php
    $projects = $data['projects'];
    $tasks = $data['tasks'];
    $errors = $data['errors'];
    function getPostVal($name){
      return $_POST[$name] ?? "";
    }
    
?>
    <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
                    <ul class="main-navigation__list">
                        <?php
                            for ($i = 0; $i < count($projects); $i++){
                        ?>
                        <li class="main-navigation__list-item">
                            <a class="main-navigation__list-item-link" href="index.php?tab=<?=$projects[$i]["id_projects"]?>">
                                <?=$projects[$i]["project_name"]?>
                            </a>
                            <span class="main-navigation__list-item-count"><?=howmuch($tasks,$projects[$i]["project_name"])?></span>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </nav>

        <a class="button button--transparent button--plus content__side-button" href="project.php">Добавить проект</a>
      </section>

      <main class="content__main">
        <h2 class="content__main-heading">Добавление проекта</h2>

        <form class="form"  action="" method="POST" autocomplete="off">
          <div class="form__row">
              <?php
                $classname = '';

                if (isset($errors['name'])){
                  $classname = 'form__input--error';
              ?>
              <p class="form__massage"><?=$errors['name']?></p>
              <?
                }
              ?>
            <label class="form__label" for="project_name">Название <sup>*</sup></label>

            <input class="form__input <?=$classname?>" type="text" name="name" id="project_name" value="<?=getPostVal('name')?>" placeholder="Введите название проекта">
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
      </main>