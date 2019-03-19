-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 20 2019 г., 01:47
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users_data`
--

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(1, 'Ukraine'),
(4, 'USA'),
(6, 'Italy'),
(7, 'Nigeria');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(320) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `country_id`) VALUES
(1, 'Brie Larson', 'brie@larson.com', 4),
(3, 'Ivo Bobul', 'ivo@bob.com', 1),
(4, 'Roberto Benigni', 'roberto @mail.com', 6),
(5, 'Oleg Vynnyk', 'alega@mail.com', 1),
(6, 'Will Smith', 'will@smi.com', 7),
(7, 'Sophia Loren', 'sophia@mail.com', 6),
(8, 'Snoop Dogg', 'snoop@mail.com', 7),
(9, 'Kanye West', 'kanye@mail.com', 7);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
