-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 03 2020 г., 23:51
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
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id_projects`, `project_name`, `email`) VALUES
(1, 'Работа', 'kostik@mail.com'),
(2, 'Учеба', 'kostik@mail.com'),
(3, 'Входящие', 'kostik@mail.com'),
(4, 'Домашние дела', 'kostik@mail.com'),
(5, 'Авто', 'kostik@mail.com'),
(6, 'Бизнес', 'antoshka228@gmail.com'),
(7, 'Авто', 'antoshka228@gmail.com'),
(8, 'Дела по дому', 'antoshka228@gmail.com'),
(9, 'Стирка носков', 'petrushka@yandex.ru'),
(10, 'тест 1', 'looser.s.usami@gmail.com'),
(11, 'кокос', 'looser.s.usami@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id_tasks` int(11) NOT NULL,
  `task_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moment_of_creation` datetime NOT NULL,
  `file_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `task_status` tinyint(1) DEFAULT NULL,
  `project_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id_tasks`, `task_name`, `moment_of_creation`, `file_link`, `deadline`, `task_status`, `project_name`, `email`) VALUES
(1, 'Собеседование в IT компании', '2004-05-23 14:25:10', '', '2019-01-12', 0, 'Работа', 'kostik@mail.com'),
(2, 'Выполнить тестовое задание', '2005-05-23 14:25:10', '', '2020-10-20', 0, 'Работа', 'kostik@mail.com'),
(3, 'Сделать задание первого раздела', '2019-11-30 14:25:10', '', '2019-12-21', 1, 'Учеба', 'kostik@mail.com'),
(4, 'Встреча с другом', '2019-12-24 14:25:10', '', '2019-12-25', 0, 'Входящие', 'kostik@mail.com'),
(5, 'Купить корм для кота', '2019-11-30 19:25:10', NULL, NULL, 0, 'Домашние дела', 'kostik@mail.com'),
(6, 'Заказать пиццу', '2019-12-30 13:25:10', NULL, NULL, 1, 'Домашние дела', 'kostik@mail.com'),
(7, 'Сделать что-нибудь когда-нибудь', '2019-11-30 19:25:10', NULL, '2019-11-30', 0, 'Бизнес', 'antoshka228@gmail.com'),
(8, 'Сделать когда-нибудь куда-нибудь', '2019-11-29 19:25:10', NULL, '2019-11-30', 1, 'Бизнес', 'antoshka228@gmail.com'),
(9, 'Заказать не спиццу', '2018-12-30 13:25:10', NULL, '2019-12-31', 1, 'Авто', 'antoshka228@gmail.com'),
(82, 'носки постирал', '2020-11-03 23:45:25', '', '2020-11-12', 0, 'Стирка носков', 'petrushka@yandex.ru'),
(83, 'job8task2', '2020-11-03 23:50:02', '', '2020-11-03', 0, 'кокос', 'looser.s.usami@gmail.com'),
(84, 'тест 1', '2020-11-03 23:50:18', '', '2020-11-18', 0, 'тест 1', 'looser.s.usami@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `author` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_date` datetime NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`author`, `register_date`, `email`, `user_password`) VALUES
('Антон', '2020-11-03 23:42:44', 'antoshka228@gmail.com', '$2y$10$7Iie5/HyxZAfXgWX5KnL/ukI3QnvEVTqzvt8F9th6V9LATRD0ZGeO'),
('Константин', '2020-11-03 23:43:57', 'kostik@mail.com', '$2y$10$F3V3mpEz2irfrs1VYNHX9e1lYgYWfeUDtdnb.n7/JZ2PjH/DdVXbC'),
('Владимир', '2020-11-02 20:31:41', 'looser.s.usami@gmail.com', '$2y$10$0ZoVqsdKod1MZKQtvUreDuc2MQdmSKVo8HdhjMV.MMDpDGjDZXLWa'),
('Пётр', '2020-11-03 23:44:53', 'petrushka@yandex.ru', '$2y$10$T.zlf8XyYP2JD0qMCyRyzuP2MpMVgE3ciBtZN0/ltxcj08mGGd27a');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_projects`),
  ADD KEY `AIndex` (`email`),
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
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id_projects` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_tasks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
