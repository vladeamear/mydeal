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

        <a class="button button--transparent button--plus content__side-button" href="form-project.html">Добавить проект</a>
      </section>

      <main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="" enctype="multipart/form-data" method="POST" autocomplete="off">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
              <?php
                $classname = '';

                if (isset($errors['name'])){
                  $classname = 'form__input--error';
              ?>
              <p class="form__massage"><?=$errors['name']?></p>
              <?
                }
              ?>
            <input class="form__input <?=$classname?>" type="text" name="name" id="name" value="<?=getPostVal('name')?>" placeholder="Введите название">
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>
              <?php
                $classname = '';

                if (isset($errors['project'])){
                  $classname = 'form__input--error';
              ?>
              <p class="form__massage"><?=$errors['project']?></p>
              <?
                }
              ?>
            <select class="form__input form__input--select <?=$classname?>" name="project" id="project">
              <option>Выбрать</option>
              <?php
                for($i = 0; $i < count($projects); $i++){
              ?>
              <option <?php if ($projects[$i]["project_name"] == getPostVal('project')) echo 'selected'?>><?=$projects[$i]["project_name"]?></option>
              <?
                }
              ?>
            </select>
          </div>

          <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date" type="text" name="date" id="date" value="<?=getPostVal('date')?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
          </div>

          <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="file" id="file" value="<?=getPostVal('file')?>">

              <label class="button button--transparent" for="file">
                <span>Выберите файл</span>
              </label>
            </div>
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
      </main>