CREATE DATABASE `mydeal`;

CREATE TABLE `projects` (
  `id_projects` int(11) NOT NULL,
  `project_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `users` (
  `author` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_date` datetime NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_projects`),
  ADD KEY `AIndex` (`email`),
  ADD KEY `PIndex` (`project_name`);

ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_tasks`),
  ADD KEY `TNIndex` (`task_name`),
  ADD KEY `PNIndex` (`project_name`);

--job9task1
ALTER TABLE `tasks` ADD FULLTEXT KEY `search` (`task_name`);
--

ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

ALTER TABLE `projects`
  MODIFY `id_projects` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tasks`
  MODIFY `id_tasks` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
