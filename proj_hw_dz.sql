-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 24 2022 г., 16:27
-- Версия сервера: 5.7.33-cll-lve
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hhpqemgg_proj_hw_dz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activeuser`
--

CREATE TABLE `activeuser` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dataint` time NOT NULL,
  `dateintegare` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Структура таблицы `apicode`
--

CREATE TABLE `apicode` (
  `id` int(11) NOT NULL,
  `idCh` int(11) NOT NULL,
  `log` varchar(12) NOT NULL,
  `code` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблицы `dz_less_100000`
--

CREATE TABLE `dz_less_100000` (
  `newid` int(10) UNSIGNED NOT NULL,
  `week` int(11) NOT NULL,
  `par_q` int(100) NOT NULL,
  `dz` text,
  `nph` int(11) DEFAULT NULL,
  `ph1` text,
  `ph2` text,
  `ph3` text,
  `ph4` text,
  `ph5` text,
  `day` int(11) DEFAULT NULL,
  `to_do` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Структура таблицы `enginepass`
--

CREATE TABLE `enginepass` (
  `id` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `url` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Структура таблицы `less_100000`
--

CREATE TABLE `less_100000` (
  `id` int(11) NOT NULL,
  `name` text,
  `var` int(11) DEFAULT NULL,
  `checkL` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Структура таблицы `man_teams`
--

CREATE TABLE `man_teams` (
  `id_team` int(11) UNSIGNED NOT NULL,
  `name_team` text NOT NULL,
  `pass` varchar(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `com_team` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `man_teams`
--

INSERT INTO `man_teams` (`id_team`, `name_team`, `pass`, `id_admin`, `com_team`) VALUES
(100000, 'Test', 'NTf5E6', 1, 'test system');

-- --------------------------------------------------------

--
-- Структура таблицы `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `text` text NOT NULL,
  `verif` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(35) DEFAULT NULL,
  `socailnet` varchar(20) DEFAULT NULL,
  `avatar` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `surname`, `email`, `password`, `socailnet`, `avatar`) VALUES
(1, 'admin', 'Test', 'Admin', 'admin@hwdz.ezh.com.ua', '', NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `userstoteams`
--

CREATE TABLE `userstoteams` (
  `iD` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `teamID` int(11) NOT NULL,
  `pos` int(11) NOT NULL DEFAULT '1',
  `inf` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `userstoteams`
--

INSERT INTO `userstoteams` (`iD`, `userID`, `teamID`, `pos`, `inf`) VALUES
(1, 1, 100000, 3, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activeuser`
--
ALTER TABLE `activeuser`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `apicode`
--
ALTER TABLE `apicode`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dz_less_100000`
--
ALTER TABLE `dz_less_100000`
  ADD PRIMARY KEY (`newid`);


--
-- Индексы таблицы `enginepass`
--
ALTER TABLE `enginepass`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `less_100000`
--
ALTER TABLE `less_100000`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `man_teams`
--
ALTER TABLE `man_teams`
  ADD PRIMARY KEY (`id_team`);

--
-- Индексы таблицы `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `userstoteams`
--
ALTER TABLE `userstoteams`
  ADD PRIMARY KEY (`iD`);
--
-- AUTO_INCREMENT для таблицы `activeuser`
--
ALTER TABLE `activeuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `apicode`
--
ALTER TABLE `apicode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dz_less_100000`
--
ALTER TABLE `dz_less_100000`
  MODIFY `newid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=579;
--
-- AUTO_INCREMENT для таблицы `enginepass`
--
ALTER TABLE `enginepass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT для таблицы `less_100000`
--
ALTER TABLE `less_100000`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=543;
-- AUTO_INCREMENT для таблицы `man_teams`
--
ALTER TABLE `man_teams`
  MODIFY `id_team` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9283366;

--
-- AUTO_INCREMENT для таблицы `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1750626775;

--
-- AUTO_INCREMENT для таблицы `userstoteams`
--
ALTER TABLE `userstoteams`
  MODIFY `iD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
COMMIT;