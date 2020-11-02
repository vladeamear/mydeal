<?php
    // $projects = $data['projects'];
    // $tasks = $data['tasks'];
    // $errors = $data['errors'];
    function getPostVal($name){
      return $_POST[$name] ?? "";
    }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <h1 class="visually-hidden">Дела в порядке</h1>

  <div class="page-wrapper">
    <div class="container container--with-sidebar">
      <header class="main-header">
        <a href="#">
          <img src="../img/logo.png" width="153" height="42" alt="Логитип Дела в порядке">
        </a>

        <div class="main-header__side">
          <a class="main-header__side-item button button--transparent" href="form-authorization.html">Войти</a>
        </div>
      </header>

      <div class="content">
        <section class="content__side">
          <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>

          <a class="button button--transparent content__side-button" href="form-authorization.html">Войти</a>
        </section>

        <main class="content__main">
          <h2 class="content__main-heading">Регистрация аккаунта</h2>

          <form class="form" action="" method="POST" autocomplete="off">
            <div class="form__row">
              <label class="form__label" for="email">E-mail <sup>*</sup></label>
              <?php
                $classname = '';
                if (isset($errors['email']))
                  $classname = 'form__input--error';
              ?>
              <input class="form__input <?=$classname?>" type="text" name="email" id="email" value="<?=getPostVal('email')?>" placeholder="Введите e-mail">
              <?php
                $classname = '';
                if (isset($errors['email'])){
              ?>
              <p class="form__message"><?=$errors['email']?></p>
              <?
                }
              ?>
            </div>

            <div class="form__row">
              <label class="form__label" for="password">Пароль <sup>*</sup></label>
              <?php
                $classname = '';
                if (isset($errors['password']))
                  $classname = 'form__input--error';
              ?>
              <input class="form__input <?=$classname?>" type="password" name="password" id="password" value="<?=getPostVal('password')?>" placeholder="Введите пароль">
              <?php
                $classname = '';
                if (isset($errors['password'])){
              ?>
              <p class="form__message"><?=$errors['password']?></p>
              <?
                }
              ?>
            </div>

            <div class="form__row">
              <label class="form__label" for="name">Имя <sup>*</sup></label>
              <?php
                $classname = '';
                if (isset($errors['name']))
                  $classname = 'form__input--error';
              ?>
              <input class="form__input <?=$classname?>" type="text" name="name" id="name" value="<?=getPostVal('name')?>" placeholder="Введите пароль">
              <?php
                $classname = '';
                if (isset($errors['name'])){
              ?>
              <p class="form__message"><?=$errors['name']?></p>
              <?
                }
              ?>
            </div>

            <div class="form__row form__row--controls">
              <?php
                if(count($errors)){
              ?>
              <p class="error-message">Пожалуйста, исправьте ошибки в форме</p>
              <?
                }
              ?>
              <input class="button" type="submit" name="" value="Зарегистрироваться">
            </div>
          </form>
        </main>
      </div>
    </div>
  </div>
</body>
</html>
