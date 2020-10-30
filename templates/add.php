<?php
    $projects = $data['projects'];
    $tasks = $data['tasks'];
    $show_complete_tasks = $data['toshowornottoshow'];
?>

    <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
                    <ul class="main-navigation__list">
                        <?php
                            for ($i = 0; $i < count($projects); $i++){
                        ?>
                        <li class="main-navigation__list-item">
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

        <a class="button button--transparent button--plus content__side-button" href="form-project.html">Добавить проект</a>
      </section>

      <main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="index.html" method="post" autocomplete="off">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input" type="text" name="name" id="name" value="" placeholder="Введите название">
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select" name="project" id="project">
              <?php
                for($i = 0; $i < count($projects); $i++){
              ?>
              <option value=""><?=$projects[$i]["project_name"]?></option>
              <?
                }
              ?>
            </select>
          </div>

          <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date" type="text" name="date" id="date" value="" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
          </div>

          <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="file" id="file" value="">

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