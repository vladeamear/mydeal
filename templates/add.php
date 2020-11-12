<?php
    $projects = $data['projects'];
    $tasks = $data['tasks'];
    $errors = $data['errors'];
    include 'content_side.php';
?>
<main class="content__main">
  <h2 class="content__main-heading">Добавление задачи</h2>
  <?php
    if (empty($projects)){
  ?>
  <p>Для того, чтобы Добавить задачу вам сначала необходимо создать как минимум один проект</p>
  <?php
    } else {
  ?>

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
<?
    }
?>