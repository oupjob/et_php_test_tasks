-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 26 2019 г., 10:28
-- Версия сервера: 10.1.38-MariaDB-0+deb9u1
-- Версия PHP: 7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `books`
--
CREATE DATABASE IF NOT EXISTS `books` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `books`;

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES
(1, 'Илья', 'Ильф'),
(2, 'Евгений', 'Петров'),
(5, 'Аркадий', 'Стругацкий'),
(6, 'Борис', 'Стругацкий');

-- --------------------------------------------------------

--
-- Структура таблицы `authors_2_books`
--

DROP TABLE IF EXISTS `authors_2_books`;
CREATE TABLE IF NOT EXISTS `authors_2_books` (
  `author_id` int(32) NOT NULL,
  `book_id` int(32) NOT NULL,
  KEY `author_constraint` (`author_id`),
  KEY `book_constraint` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `authors_2_books`
--

INSERT INTO `authors_2_books` (`author_id`, `book_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(6, 13),
(6, 14);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`) VALUES
(1, 'Двенадцать стульев'),
(2, 'Одноэтажная америка'),
(5, 'Пикник на обочине'),
(6, 'Трудно быть богом'),
(7, 'Пикник на обочине'),
(8, 'Трудно быть богом'),
(9, 'Лес'),
(10, 'Понедельник начинается в субботу'),
(11, 'Град обреченный'),
(12, 'Обитаемый остров'),
(13, 'Полдень, XXII век'),
(14, 'Гадкие лебеди');
