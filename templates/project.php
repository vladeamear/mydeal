<?php
    $projects = $data['projects'];
    $tasks = $data['tasks'];
    $errors = $data['errors'];
    function getPostVal($name){
      return $_POST[$name] ?? "";
    }
    include 'content_side.php';
?>
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