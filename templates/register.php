<?php
    // $projects = $data['projects'];
    // $tasks = $data['tasks'];
    // $errors = $data['errors'];
    function getPostVal($name){
      return $_POST[$name] ?? "";
    }
?>
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
