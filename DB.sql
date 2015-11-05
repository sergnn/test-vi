-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 04 2015 г., 18:01
-- Версия сервера: 5.6.26-74.0-beget-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sergiu9b_moocher`
--

-- --------------------------------------------------------

--
-- Структура таблицы `vi_courier`
--
-- Создание: Ноя 02 2015 г., 15:29
--

DROP TABLE IF EXISTS `vi_courier`;
CREATE TABLE IF NOT EXISTS `vi_courier` (
  `id` int(11) NOT NULL,
  `first-name` varchar(80) NOT NULL,
  `last-name` varchar(80) NOT NULL,
  `middle-name` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vi_courier`
--

INSERT INTO `vi_courier` (`id`, `first-name`, `last-name`, `middle-name`) VALUES
(1, 'Владислав', 'Козлов', 'Степанович'),
(2, 'Василий', 'Сазонов', 'Игоревич'),
(3, 'Георгий', 'Власов', 'Иванович'),
(4, 'Константин', 'Константинопольский', 'Константинович'),
(5, 'Фёдор', 'Родионов', 'Анатольевич'),
(6, 'Никита', 'Смирнов', 'Викторович'),
(7, 'Дмитрий', 'Волков', 'Антонович'),
(8, 'Роман', 'Пестов', 'Фёдорович'),
(9, 'Максим', 'Никонов', 'Георгиевич'),
(10, 'Пётр', 'Туров', 'Александрович');

-- --------------------------------------------------------

--
-- Структура таблицы `vi_regions`
--
-- Создание: Ноя 02 2015 г., 15:04
--

DROP TABLE IF EXISTS `vi_regions`;
CREATE TABLE IF NOT EXISTS `vi_regions` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `travel-time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vi_regions`
--

INSERT INTO `vi_regions` (`id`, `name`, `travel-time`) VALUES
(1, 'Санкт-Петербург', 3),
(2, 'Уфа', 2),
(3, 'Нижний Новгород', 1),
(4, 'Владимир', 1),
(5, 'Кострома', 1),
(6, 'Екатеринбург', 5),
(7, 'Ковров', 1),
(8, 'Воронеж', 4),
(9, 'Самара', 3),
(10, 'Астрахань', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `vi_schedule`
--
-- Создание: Ноя 02 2015 г., 16:27
--

DROP TABLE IF EXISTS `vi_schedule`;
CREATE TABLE IF NOT EXISTS `vi_schedule` (
  `id` int(11) NOT NULL,
  `who` int(11) NOT NULL,
  `departure` date DEFAULT NULL,
  `destination` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `vi_courier`
--
ALTER TABLE `vi_courier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- Индексы таблицы `vi_regions`
--
ALTER TABLE `vi_regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- Индексы таблицы `vi_schedule`
--
ALTER TABLE `vi_schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `vi_courier`
--
ALTER TABLE `vi_courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `vi_regions`
--
ALTER TABLE `vi_regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `vi_schedule`
--
ALTER TABLE `vi_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
