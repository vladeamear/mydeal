-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 22 2020 г., 15:29
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mydeal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id_projects` int(11) NOT NULL,
  `project_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

--Добавляются данные в таблицу с проектами 'projects'
--Структура добавления следующая:
--  id проекта, его название и имя автора
INSERT INTO `projects` (`id_projects`, `project_name`, `author`) VALUES
(1, 'Работа', 'Константин'),
-- проект с id = 1, названием - 'Работа', автор которого - Константин
(2, 'Учеба', 'Константин'),
(3, 'Входящие', 'Константин'),
(4, 'Домашние дела', 'Константин'),
(5, 'Авто', 'Константин'),
(6, 'Бизнес', 'Антон'),
(7, 'Авто', 'Антон'),
(8, 'Дела по дому', 'Антон'),
(9, 'Стирка носков', 'Пётр');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id_tasks` int(11) NOT NULL,
  `task_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moment_of_creation` datetime NOT NULL,
  `file_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `task_status` tinyint(1) DEFAULT NULL,
  `project_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

--Добавляются данные в таблицу с заданиями 'tasks'
--Структура добавления следующая:
--   id задания, название задания, момент создания задания, ссылка на файл, дедлайн, статус выполнения, 
--   название проекта, к которому оно принадлежит, имя автора
INSERT INTO `tasks` (`id_tasks`, `task_name`, `moment_of_creation`, `file_link`, `deadline`, `task_status`, `project_name`, `author`) VALUES
(1, 'Собеседование в IT компании', '2004-05-23 14:25:10', NULL, '2019-01-12', 0, 'Работа', 'Константин'),
--НАПРИМЕР
-- id равно 1, название - Собеседование в IT компании, момент создания - 14 часов 25 минут 10 секунд 23го мая 2004 года,
-- ссылки на файл нет, дедлайн - первого декабря 2019 года, не выполнено (0), относится к проекту 'Работа', автор - Константин ;
(2, 'Выполнить тестовое задание', '2005-05-23 14:25:10', NULL, '2020-10-20', 0, 'Работа', 'Константин'),
(3, 'Сделать задание первого раздела', '2019-11-30 14:25:10', NULL, '2019-12-21', 1, 'Учеба', 'Константин'),
(4, 'Встреча с другом', '2019-12-24 14:25:10', NULL, '2019-12-25', 0, 'Входящие', 'Константин'),
(5, 'Купить корм для кота', '2019-11-30 19:25:10', NULL, NULL, 0, 'Домашние дела', 'Константин'),
(6, 'Заказать пиццу', '2019-12-30 13:25:10', NULL, NULL, 1, 'Домашние дела', 'Константин'),
-- тут нет даты дедлайн, она не обязательна, и это задание уже выполнено (1);
(7, 'Сделать что-нибудь когда-нибудь', '2019-11-30 19:25:10', NULL, '2019-11-30', 0, 'Бизнес', 'Антон'),
(8, 'Сделать когда-нибудь куда-нибудь', '2019-11-29 19:25:10', NULL, '2019-11-30', 1, 'Бизнес', 'Антон'),
(9, 'Заказать не спиццу', '2018-12-30 13:25:10', NULL, '2019-12-31', 1, 'Авто', 'Антон'),
(10, 'Постирать носки', '2019-06-30 19:25:10', 'https://drive.google.com/file/d/1-gImxNf3tjA1YzP66qFKvt1Qfl45DOXE/view?usp=sharing', NULL, 0, 'Стирка носков', 'Пётр');
-- тут есть ссылка на файл, который хранпится на гугл диске.

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `author` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_date` datetime NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

--Добавляются данные в таблицу с пользователями 'users'
--Структура добавления следующая:
--   имя автора, момент регистрации, и-мейл, пароль
INSERT INTO `users` (`author`, `register_date`, `email`, `user_password`) VALUES
('Антон', '2001-11-30 19:25:10', 'antoshka228@gmail.com', 'IloVeCars'),
('Константин', '2008-11-30 19:25:10', 'kostik@mail.com', 'kostya'),
('Пётр', '2011-11-30 19:25:10', 'petrushka@yandex.ru', 'werppl');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_projects`),
  ADD KEY `AIndex` (`author`),
  ADD KEY `PIndex` (`project_name`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_tasks`),
  ADD KEY `TNIndex` (`task_name`),
  ADD KEY `PNIndex` (`project_name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`author`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id_projects` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_tasks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
