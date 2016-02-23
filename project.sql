-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 24 2016 г., 10:40
-- Версия сервера: 5.6.26-log
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `project_id` int(9) NOT NULL,
  `descrip` varchar(1000) NOT NULL,
  `file` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `file_with` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `project_id`, `descrip`, `file`, `username`, `date`, `status`, `file_with`) VALUES
(4, 1, 'Первый', 'Tips.txt', 'pavel', '2016-01-23 13:35:50', 1, 'Tips.txt'),
(9, 1, 'Третий', 'Tips.ver2.txt', 'admin', '2016-01-23 13:54:10', 2, 'Tips.txt'),
(10, 1, '123', 'pusto.бла.txt', 'pavelpilyak', '2016-01-23 15:23:47', 1, 'pusto.бла.txt'),
(11, 1, '123', '.ver2pusto.бла.txt', 'pavelpilyak', '2016-01-23 15:23:55', 1, 'pusto.бла.txt'),
(12, 1, '123', 'pusto.бла.ver2o.бла.txt', 'pavelpilyak', '2016-01-23 15:24:19', 1, 'pusto.бла.txt'),
(13, 1, '123', 'pusto.бла.ver2.txt', 'pavelpilyak', '2016-01-23 15:29:43', 2, 'pusto.бла.txt'),
(14, 1, '123', 'node-v4.2.4.tar.gz', 'pavelpilyak', '2016-01-24 06:43:48', 2, 'node-v4.2.4.tar.gz'),
(15, 1, '123', 'vs_community.exe', 'pavelpilyak', '2016-01-24 06:57:05', 2, 'vs_community.exe');

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` tinyint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `descrip` varchar(10000) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `username` varchar(150) NOT NULL,
  `party` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `name`, `descrip`, `date_start`, `date_end`, `date`, `status`, `username`, `party`) VALUES
(1, 'Проект первый', 'Описание', '2016-01-30', '2016-01-31', '2016-01-23 12:01:51', 0, 'pavelpilyak', 'pavel;admin;');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `last_login_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `last_login_date`) VALUES
(1, 'pavelpilyak', '$1$nP1.ky/.$zdS7FQVCr7gnlmh/IGAJn1', '2016-01-24 09:40:20'),
(2, 'pavel', '$1$zG4.AS2.$8v761dtStnbKLa0SPSYzA1', '2016-01-23 15:42:20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
