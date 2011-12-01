-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 01 2011 г., 17:51
-- Версия сервера: 5.1.58
-- Версия PHP: 5.2.14

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cl71252_tm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_discussion`
--

DROP TABLE IF EXISTS `tm_acl_discussion`;
CREATE TABLE `tm_acl_discussion` (
  `user_id` int(10) unsigned NOT NULL,
  `discussion_id` int(10) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_write` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`discussion_id`),
  KEY `fk_tm_acl_discussion_tm_discussion1` (`discussion_id`),
  KEY `fk_tm_acl_discussion_tm_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_acl_discussion`
--

INSERT INTO `tm_acl_discussion` (`user_id`, `discussion_id`, `is_read`, `is_write`) VALUES
(1, 3, 1, 1),
(1, 14, 1, 1),
(1, 15, 1, 1),
(1, 16, 1, 1),
(1, 17, 1, 1),
(1, 18, 1, 1),
(1, 19, 1, 1),
(1, 20, 1, 1),
(1, 21, 1, 1),
(1, 22, 1, 1),
(1, 23, 1, 1),
(1, 24, 1, 1),
(1, 25, 1, 1),
(1, 26, 1, 1),
(1, 27, 1, 1),
(1, 30, 1, 1),
(1, 31, 1, 1),
(1, 32, 1, 1),
(1, 33, 1, 1),
(2, 3, 1, 1),
(2, 14, 1, 0),
(2, 15, 1, 1),
(2, 16, 1, 1),
(2, 17, 1, 1),
(2, 18, 1, 1),
(2, 19, 1, 1),
(2, 20, 1, 1),
(2, 21, 1, 1),
(2, 22, 1, 1),
(2, 23, 1, 0),
(2, 24, 1, 0),
(2, 25, 1, 0),
(2, 26, 1, 0),
(2, 27, 1, 0),
(2, 30, 1, 0),
(2, 31, 1, 0),
(2, 32, 1, 0),
(2, 33, 1, 1),
(5, 3, 1, 0),
(5, 14, 1, 0),
(5, 15, 1, 0),
(5, 16, 1, 0),
(5, 17, 1, 0),
(5, 18, 1, 0),
(5, 19, 1, 0),
(5, 20, 1, 0),
(5, 21, 1, 0),
(5, 22, 1, 0),
(5, 23, 1, 0),
(5, 24, 1, 0),
(5, 25, 1, 0),
(5, 26, 1, 0),
(5, 27, 1, 0),
(5, 30, 1, 0),
(5, 31, 1, 0),
(5, 32, 1, 0),
(5, 33, 1, 0),
(6, 14, 1, 1),
(6, 23, 1, 1),
(6, 24, 1, 1),
(6, 25, 1, 1),
(6, 26, 1, 1),
(6, 27, 1, 1),
(6, 30, 1, 1),
(6, 31, 1, 1),
(6, 32, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_document`
--

DROP TABLE IF EXISTS `tm_acl_document`;
CREATE TABLE `tm_acl_document` (
  `user_id` int(10) unsigned NOT NULL,
  `document_id` int(10) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_write` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`document_id`),
  KEY `fk_tm_acl_document_tm_user1` (`user_id`),
  KEY `fk_tm_acl_document_tm_document1` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_acl_document`
--

INSERT INTO `tm_acl_document` (`user_id`, `document_id`, `is_read`, `is_write`) VALUES
(1, 20, 1, 1),
(1, 34, 1, 1),
(1, 35, 1, 1),
(1, 36, 1, 1),
(1, 38, 1, 1),
(1, 39, 1, 1),
(2, 20, 1, 1),
(2, 34, 1, 1),
(2, 35, 1, 1),
(2, 36, 1, 0),
(2, 38, 1, 0),
(2, 39, 1, 1),
(5, 20, 1, 0),
(5, 34, 1, 0),
(5, 35, 1, 0),
(5, 36, 1, 0),
(5, 38, 1, 0),
(5, 39, 1, 0),
(6, 36, 1, 1),
(6, 38, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_role`
--

DROP TABLE IF EXISTS `tm_acl_role`;
CREATE TABLE `tm_acl_role` (
  `tm_user_role_id` int(10) unsigned NOT NULL,
  `tm_user_resource_id` int(10) unsigned NOT NULL,
  `is_allow` tinyint(1) NOT NULL DEFAULT '0',
  `privileges` varchar(255) NOT NULL,
  PRIMARY KEY (`tm_user_role_id`,`tm_user_resource_id`),
  KEY `tm_user_resource_id` (`tm_user_resource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_acl_role`
--

INSERT INTO `tm_acl_role` (`tm_user_role_id`, `tm_user_resource_id`, `is_allow`, `privileges`) VALUES
(1, 1, 1, 'show'),
(1, 2, 1, 'show'),
(1, 3, 1, 'show'),
(1, 4, 1, 'show'),
(1, 5, 1, 'show'),
(1, 6, 1, 'show'),
(1, 7, 1, 'show'),
(1, 8, 1, 'show'),
(1, 15, 1, 'show'),
(1, 19, 1, 'show'),
(1, 20, 1, 'show'),
(1, 21, 1, 'show'),
(1, 22, 1, 'show'),
(1, 23, 1, 'show'),
(1, 24, 1, 'show'),
(1, 25, 1, 'show'),
(1, 26, 1, 'show,show-attribute-hash,show-attribute-type'),
(1, 27, 1, 'show'),
(1, 28, 1, 'show'),
(1, 29, 1, 'show'),
(1, 30, 1, 'show'),
(1, 31, 1, 'show'),
(1, 32, 1, 'show'),
(1, 33, 1, 'show'),
(1, 34, 1, 'show'),
(1, 35, 1, 'show'),
(1, 36, 1, 'show'),
(1, 37, 1, 'show,show-attribute-hash,show-attribute-type'),
(1, 38, 1, 'show'),
(1, 39, 1, 'show'),
(1, 40, 1, 'show'),
(1, 41, 1, 'show'),
(1, 42, 1, 'show'),
(1, 43, 1, 'show'),
(1, 44, 1, 'show'),
(1, 45, 1, 'show'),
(1, 46, 1, 'show'),
(1, 47, 1, 'show'),
(1, 48, 1, 'show'),
(1, 49, 1, 'show'),
(1, 50, 1, 'show'),
(1, 51, 1, 'show'),
(1, 52, 1, 'show'),
(1, 53, 1, 'show'),
(1, 54, 1, 'show'),
(1, 55, 1, 'show'),
(1, 56, 1, 'show'),
(1, 57, 1, 'show'),
(1, 58, 1, 'show'),
(1, 59, 1, 'show'),
(1, 60, 1, 'show'),
(1, 61, 1, 'show'),
(1, 62, 1, 'show'),
(1, 63, 1, 'show'),
(1, 64, 1, 'show'),
(1, 65, 1, 'show'),
(1, 66, 1, 'show'),
(1, 67, 1, 'show'),
(1, 68, 1, 'show'),
(1, 69, 1, 'show'),
(1, 70, 1, 'show'),
(1, 71, 1, 'show'),
(1, 72, 1, 'show'),
(1, 73, 0, 'show'),
(1, 74, 0, 'show'),
(1, 75, 1, 'show'),
(3, 1, 1, 'show'),
(3, 2, 1, 'show'),
(3, 3, 1, 'show'),
(3, 4, 1, 'show'),
(3, 5, 0, 'show'),
(3, 6, 0, 'show'),
(3, 7, 0, 'show'),
(3, 8, 0, 'show'),
(3, 15, 0, 'show'),
(3, 19, 0, 'show'),
(3, 20, 0, 'show'),
(3, 21, 0, 'show'),
(3, 22, 0, 'show'),
(3, 23, 0, 'show'),
(3, 24, 0, 'show'),
(3, 25, 0, 'show'),
(3, 26, 1, 'show'),
(3, 27, 0, 'show'),
(3, 28, 0, 'show'),
(3, 29, 0, 'show'),
(3, 30, 0, 'show'),
(3, 31, 0, 'show'),
(3, 32, 0, 'show'),
(3, 33, 0, 'show'),
(3, 34, 0, 'show'),
(3, 35, 0, 'show'),
(3, 36, 0, 'show'),
(3, 37, 1, 'show'),
(3, 38, 0, 'show'),
(3, 39, 0, 'show'),
(3, 40, 0, 'show'),
(3, 41, 0, 'show'),
(3, 42, 0, 'show'),
(3, 43, 0, 'show'),
(3, 44, 0, 'show'),
(3, 45, 0, 'show'),
(3, 46, 0, 'show'),
(3, 47, 0, 'show'),
(3, 48, 0, 'show'),
(3, 49, 0, 'show'),
(3, 50, 1, 'show'),
(3, 51, 0, 'show'),
(3, 52, 0, 'show'),
(3, 53, 0, 'show'),
(3, 54, 0, 'show'),
(3, 55, 0, 'show'),
(3, 56, 0, 'show'),
(3, 57, 0, 'show'),
(3, 58, 1, 'show'),
(3, 59, 0, 'show'),
(3, 60, 1, 'show'),
(3, 61, 0, 'show'),
(3, 62, 0, 'show'),
(3, 63, 0, 'show'),
(3, 64, 1, 'show'),
(3, 65, 1, 'show'),
(3, 66, 1, 'show'),
(3, 67, 0, 'show'),
(3, 68, 0, 'show'),
(3, 69, 0, 'show'),
(3, 70, 0, 'show'),
(3, 71, 0, 'show'),
(3, 72, 0, 'show'),
(3, 73, 1, 'show'),
(3, 74, 1, 'show'),
(3, 75, 1, 'show'),
(4, 1, 1, 'show'),
(4, 2, 1, 'show'),
(4, 3, 1, 'show'),
(4, 4, 1, 'show'),
(4, 5, 0, 'show'),
(4, 6, 0, 'show'),
(4, 7, 0, 'show'),
(4, 8, 0, 'show'),
(4, 15, 0, 'show'),
(4, 19, 0, 'show'),
(4, 20, 0, 'show'),
(4, 21, 0, 'show'),
(4, 22, 0, 'show'),
(4, 23, 0, 'show'),
(4, 24, 0, 'show'),
(4, 25, 0, 'show'),
(4, 26, 1, 'show'),
(4, 27, 0, 'show'),
(4, 28, 1, 'show'),
(4, 29, 0, 'show'),
(4, 30, 0, 'show'),
(4, 31, 0, 'show'),
(4, 32, 0, 'show'),
(4, 33, 0, 'show'),
(4, 34, 0, 'show'),
(4, 35, 0, 'show'),
(4, 36, 0, 'show'),
(4, 37, 1, 'show'),
(4, 38, 1, 'show'),
(4, 39, 1, 'show'),
(4, 40, 0, 'show'),
(4, 41, 0, 'show'),
(4, 42, 0, 'show'),
(4, 43, 0, 'show'),
(4, 44, 0, 'show'),
(4, 45, 0, 'show'),
(4, 46, 0, 'show'),
(4, 47, 0, 'show'),
(4, 48, 0, 'show'),
(4, 49, 0, 'show'),
(4, 50, 1, 'show'),
(4, 51, 1, 'show'),
(4, 52, 1, 'show'),
(4, 53, 0, 'show'),
(4, 54, 0, 'show'),
(4, 55, 1, 'show'),
(4, 56, 0, 'show'),
(4, 57, 1, 'show'),
(4, 58, 0, 'show'),
(4, 59, 0, 'show'),
(4, 60, 0, 'show'),
(4, 61, 0, 'show'),
(4, 62, 0, 'show'),
(4, 63, 0, 'show'),
(4, 64, 0, 'show'),
(4, 65, 0, 'show'),
(4, 66, 1, 'show'),
(4, 67, 0, 'show'),
(4, 68, 0, 'show'),
(4, 69, 0, 'show'),
(4, 70, 0, 'show'),
(4, 71, 0, 'show'),
(4, 72, 0, 'show'),
(4, 73, 1, 'show'),
(4, 74, 1, 'show'),
(4, 75, 1, 'show'),
(5, 1, 1, 'show'),
(5, 2, 1, 'show'),
(5, 3, 1, 'show'),
(5, 4, 1, 'show'),
(5, 5, 0, 'show'),
(5, 6, 0, 'show'),
(5, 7, 0, 'show'),
(5, 8, 0, 'show'),
(5, 15, 0, 'show'),
(5, 19, 0, 'show'),
(5, 20, 0, 'show'),
(5, 21, 0, 'show'),
(5, 22, 0, 'show'),
(5, 23, 0, 'show'),
(5, 24, 0, 'show'),
(5, 25, 0, 'show'),
(5, 26, 0, 'show'),
(5, 27, 0, 'show'),
(5, 28, 0, 'show'),
(5, 29, 0, 'show'),
(5, 30, 0, 'show'),
(5, 31, 0, 'show'),
(5, 32, 0, 'show'),
(5, 33, 0, 'show'),
(5, 34, 0, 'show'),
(5, 35, 0, 'show'),
(5, 36, 0, 'show'),
(5, 37, 0, 'show'),
(5, 38, 0, 'show'),
(5, 39, 0, 'show'),
(5, 40, 0, 'show'),
(5, 41, 0, 'show'),
(5, 42, 0, 'show'),
(5, 43, 0, 'show'),
(5, 44, 0, 'show'),
(5, 45, 0, 'show'),
(5, 46, 0, 'show'),
(5, 47, 0, 'show'),
(5, 48, 0, 'show'),
(5, 49, 0, 'show'),
(5, 50, 0, 'show'),
(5, 51, 0, 'show'),
(5, 52, 0, 'show'),
(5, 53, 0, 'show'),
(5, 54, 0, 'show'),
(5, 55, 0, 'show'),
(5, 56, 0, 'show'),
(5, 57, 0, 'show'),
(5, 58, 0, 'show'),
(5, 59, 0, 'show'),
(5, 60, 0, 'show');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_task`
--

DROP TABLE IF EXISTS `tm_acl_task`;
CREATE TABLE `tm_acl_task` (
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_write` tinyint(1) NOT NULL DEFAULT '0',
  `is_executant` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`,`task_id`),
  KEY `fk_tm_acl_tm_user1` (`user_id`),
  KEY `fk_tm_acl_tm_task1` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_acl_task`
--

INSERT INTO `tm_acl_task` (`user_id`, `task_id`, `is_read`, `is_write`, `is_executant`) VALUES
(1, 8, 1, 1, 0),
(1, 9, 1, 1, 0),
(1, 10, 1, 1, 0),
(1, 11, 1, 1, 1),
(1, 20, 1, 1, 1),
(1, 21, 1, 1, 0),
(1, 22, 1, 1, 0),
(1, 23, 1, 1, 0),
(2, 8, 1, 1, 1),
(2, 9, 1, 1, 1),
(2, 10, 1, 1, 1),
(2, 11, 1, 1, 1),
(2, 20, 1, 1, 1),
(2, 21, 1, 1, 1),
(2, 22, 1, 0, 0),
(2, 23, 1, 1, 1),
(5, 8, 1, 0, 0),
(5, 9, 1, 0, 0),
(5, 10, 1, 0, 0),
(5, 11, 1, 1, 1),
(5, 20, 1, 1, 1),
(5, 21, 1, 0, 0),
(5, 22, 1, 0, 0),
(5, 23, 1, 0, 0),
(6, 22, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_discussion`
--

DROP TABLE IF EXISTS `tm_discussion`;
CREATE TABLE `tm_discussion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `date_create` datetime NOT NULL,
  `is_first` tinyint(1) NOT NULL DEFAULT '0',
  `is_message` tinyint(1) NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tm_discussion_tm_discussion1` (`parent_id`),
  KEY `fk_tm_discussion_tm_user1` (`user_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `tm_discussion`
--

INSERT INTO `tm_discussion` (`id`, `message`, `date_create`, `is_first`, `is_message`, `topic_id`, `parent_id`, `user_id`) VALUES
(3, 'Первый проект', '2011-11-27 22:14:57', 0, 0, NULL, NULL, 1),
(4, 'Первая задача', '2011-11-27 22:15:40', 0, 0, 3, NULL, 1),
(5, 'Вторая задача', '2011-11-28 20:18:07', 0, 0, 3, NULL, 1),
(6, 'Третья задача', '2011-11-28 20:28:33', 0, 0, 3, NULL, 1),
(12, 'Пятая задача', '2011-11-28 21:36:55', 0, 0, 3, NULL, 1),
(13, 'Тест', '2011-11-28 21:46:06', 0, 0, 3, NULL, 1),
(14, 'Второй проект', '2011-11-28 22:27:55', 0, 0, NULL, NULL, 1),
(15, 'Первый коомментарий', '2011-11-29 22:43:11', 0, 1, 3, NULL, 1),
(16, 'Второй комментарий', '2011-11-29 22:43:30', 0, 1, 3, NULL, 1),
(17, 'Ответ на первый комментарий', '2011-11-29 22:43:43', 0, 1, 3, 15, 1),
(18, 'Ответ на второй комментарий', '2011-11-29 22:44:01', 0, 1, 3, 16, 1),
(19, 'Ответ на ответ на первый комментарий', '2011-11-29 22:44:18', 0, 1, 3, 17, 1),
(20, 'Еще ответ на первый комментарий', '2011-11-29 22:45:43', 0, 1, 3, 15, 1),
(21, 'Третий комментарий', '2011-11-29 23:23:29', 0, 1, 3, NULL, 1),
(22, 'Вот мой ответ на второй комментарий', '2011-11-30 00:21:51', 0, 1, 3, 16, 1),
(23, 'Первый комментарий', '2011-11-30 00:22:24', 0, 1, 14, NULL, 1),
(24, 'Ответ', '2011-11-30 00:22:31', 0, 1, 14, 23, 1),
(25, 'Комментарий с файлом', '2011-11-30 18:01:45', 0, 1, 14, NULL, 1),
(26, 'Комментарий с файлом', '2011-11-30 18:02:40', 0, 1, 14, NULL, 1),
(27, 'Ответ на первый комментарий с файлом', '2011-11-30 19:17:34', 0, 1, 14, 23, 1),
(30, 'Файл для комментария', '2011-12-01 13:34:38', 0, 0, 14, NULL, 1),
(31, 'Мой комментарий', '2011-12-01 13:36:17', 0, 1, 30, NULL, 1),
(32, 'Еще комментарий', '2011-12-01 13:37:09', 0, 1, 30, NULL, 1),
(33, 'Задача с описанием приложения', '2011-12-01 15:27:41', 0, 0, NULL, NULL, 1),
(34, 'Тестовый комментарий', '2011-12-01 15:31:40', 0, 1, 33, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_discussion_document`
--

DROP TABLE IF EXISTS `tm_discussion_document`;
CREATE TABLE `tm_discussion_document` (
  `document_id` int(10) unsigned NOT NULL,
  `discussion_id` int(10) unsigned NOT NULL,
  `is_doc` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`document_id`,`discussion_id`),
  KEY `document_id` (`document_id`),
  KEY `discussion_id` (`discussion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_discussion_document`
--

INSERT INTO `tm_discussion_document` (`document_id`, `discussion_id`, `is_doc`) VALUES
(37, 26, 1),
(38, 27, 1),
(38, 30, 0),
(38, 31, 0),
(38, 32, 0),
(40, 34, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document`
--

DROP TABLE IF EXISTS `tm_document`;
CREATE TABLE `tm_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date_create` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_folder` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tm_document_tm_document1` (`parent_id`),
  KEY `fk_tm_document_tm_user1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `tm_document`
--

INSERT INTO `tm_document` (`id`, `title`, `date_create`, `user_id`, `file`, `is_folder`, `parent_id`) VALUES
(20, 'Первый проект', '2011-11-27 22:14:57', 1, 'Pervyiy_proekt', 1, NULL),
(21, 'Первая задача', '2011-11-27 22:15:40', 1, 'Pervaya_zadacha', 1, 20),
(22, 'Вторая задача', '2011-11-28 20:18:06', 1, 'Vtoraya_zadacha', 1, 20),
(23, 'Третья задача', '2011-11-28 20:28:33', 1, 'Tretya_zadacha', 1, 20),
(32, 'Пятая задача', '2011-11-28 21:36:54', 1, 'Pyataya_zadacha', 1, 20),
(33, 'Тест', '2011-11-28 21:46:06', 1, 'Test', 1, 20),
(34, 'Тест прав', '2011-11-28 22:02:02', 1, 'Test_prav', 1, 20),
(35, 'Тест документ', '2011-11-28 22:02:53', 1, 'file_28-11-2011-22-03-08.mwb', 0, 20),
(36, 'Второй проект', '2011-11-28 22:27:55', 1, 'Vtoroy_proekt', 1, NULL),
(37, 'Тест файла', '2011-11-30 18:02:40', 1, 'file_30-11-2011-18-02-40.jpg', 0, 36),
(38, 'Файл для комментария', '2011-11-30 19:17:35', 1, 'file_30-11-2011-19-17-35.jpg', 0, 36),
(39, 'Задача с описанием приложения', '2011-12-01 15:27:41', 1, 'Zadacha_s_opisaniem_prilojeniya', 1, NULL),
(40, 'Документ тестовый с описанием', '2011-12-01 15:31:40', 1, 'file_01-12-2011-15-31-41.exe', 0, 39),
(41, 'Описание задачи', '2011-12-01 15:36:23', 1, 'file_01-12-2011-15-36-23.exe', 0, 39);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document_attribute`
--

DROP TABLE IF EXISTS `tm_document_attribute`;
CREATE TABLE `tm_document_attribute` (
  `document_id` int(10) unsigned NOT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `attribute_value` text NOT NULL,
  `is_fill` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`document_id`,`attribute_key`),
  KEY `fk_tm_task_attribute_tm_task1` (`document_id`),
  KEY `fk_tm_document_attribute_tm_document_attribute_type1` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_document_attribute`
--

INSERT INTO `tm_document_attribute` (`document_id`, `attribute_key`, `type_id`, `attribute_value`, `is_fill`) VALUES
(40, 'description', 1, '', 1),
(40, 'full_text', 2, 'Большое описание файла', 1),
(40, 'test_list', 3, 'Один', 1),
(41, 'description', 1, '', 1),
(41, 'full_text', 2, 'Очень большое описание', 1),
(41, 'test_list', 3, 'Один', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document_attribute_type`
--

DROP TABLE IF EXISTS `tm_document_attribute_type`;
CREATE TABLE `tm_document_attribute_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `handler` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tm_document_attribute_type`
--

INSERT INTO `tm_document_attribute_type` (`id`, `title`, `handler`, `description`) VALUES
(1, 'Строка', 'TM_Attribute_AttributeType', 'Любое строковое значение'),
(2, 'Текст', 'TM_Attribute_AttributeTypeText', 'Многострочный  текст'),
(3, 'Список', 'TM_Attribute_AttributeTypeList', 'Список из возможных вариантов');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document_hash`
--

DROP TABLE IF EXISTS `tm_document_hash`;
CREATE TABLE `tm_document_hash` (
  `document_id` int(10) unsigned DEFAULT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `list_value` text,
  PRIMARY KEY (`attribute_key`),
  KEY `fk_tm_document_hash_tm_task_attribute_type1` (`type_id`),
  KEY `fk_tm_document_hash_tm_task1` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_document_hash`
--

INSERT INTO `tm_document_hash` (`document_id`, `attribute_key`, `title`, `type_id`, `list_value`) VALUES
(NULL, 'description', 'Текстовое описание документа', 1, ' '),
(NULL, 'full_text', 'Большой текст', 2, ''),
(NULL, 'test_list', 'Проверка списка', 3, 'Один||Два||Три ');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task`
--

DROP TABLE IF EXISTS `tm_task`;
CREATE TABLE `tm_task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tm_task_tm_user1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `tm_task`
--

INSERT INTO `tm_task` (`id`, `title`, `user_id`, `date_create`) VALUES
(8, 'Первый проект', 1, '2011-11-27 22:14:47'),
(9, 'Первая задача', 1, '2011-11-27 22:15:34'),
(10, 'Вторая задача', 1, '2011-11-28 20:17:56'),
(11, 'Третья задача', 1, '2011-11-28 20:27:15'),
(20, 'Пятая задача', 1, '2011-11-28 21:32:19'),
(21, 'Тест', 1, '2011-11-28 21:44:44'),
(22, 'Второй проект', 1, '2011-11-28 22:27:49'),
(23, 'Задача с описанием приложения', 1, '2011-12-01 15:27:18');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_attribute`
--

DROP TABLE IF EXISTS `tm_task_attribute`;
CREATE TABLE `tm_task_attribute` (
  `task_id` int(10) unsigned NOT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `attribute_value` text NOT NULL,
  `is_fill` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_id`,`attribute_key`),
  KEY `fk_tm_task_attribute_tm_task_attribute_type1` (`type_id`),
  KEY `fk_tm_task_attribute_tm_task1` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_task_attribute`
--

INSERT INTO `tm_task_attribute` (`task_id`, `attribute_key`, `type_id`, `attribute_value`, `is_fill`) VALUES
(23, 'description', 1, '', 0),
(23, 'description2', 2, '', 0),
(23, 'full_text', 2, '', 0),
(23, 'test_list', 3, 'Один', 0),
(23, 'Срок', 4, '01.12.2011 15:35:51', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_attribute_type`
--

DROP TABLE IF EXISTS `tm_task_attribute_type`;
CREATE TABLE `tm_task_attribute_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `handler` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tm_task_attribute_type`
--

INSERT INTO `tm_task_attribute_type` (`id`, `title`, `handler`, `description`) VALUES
(1, 'Строка', 'TM_Attribute_AttributeType', 'Любое строковое значение'),
(2, 'Текст', 'TM_Attribute_AttributeTypeText', 'Многострочный  текст'),
(3, 'Список', 'TM_Attribute_AttributeTypeList', 'Список из возможных вариантов'),
(4, 'Дата', 'TM_Attribute_AttributeTypeDate', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_discussion`
--

DROP TABLE IF EXISTS `tm_task_discussion`;
CREATE TABLE `tm_task_discussion` (
  `task_id` int(10) unsigned NOT NULL,
  `discussion_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`task_id`,`discussion_id`),
  KEY `fk_tm_task_discussion_tm_discussion1` (`discussion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_task_discussion`
--

INSERT INTO `tm_task_discussion` (`task_id`, `discussion_id`) VALUES
(8, 3),
(9, 4),
(10, 5),
(11, 6),
(20, 12),
(21, 13),
(22, 14),
(8, 15),
(8, 16),
(8, 17),
(8, 18),
(8, 19),
(8, 20),
(8, 21),
(8, 22),
(22, 23),
(22, 24),
(22, 25),
(22, 26),
(22, 27),
(23, 33),
(23, 34);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_document`
--

DROP TABLE IF EXISTS `tm_task_document`;
CREATE TABLE `tm_task_document` (
  `task_id` int(10) unsigned NOT NULL,
  `document_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`task_id`,`document_id`),
  KEY `fk_tm_task_document_tm_task1` (`task_id`),
  KEY `fk_tm_task_document_tm_document1` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_task_document`
--

INSERT INTO `tm_task_document` (`task_id`, `document_id`) VALUES
(8, 20),
(9, 21),
(10, 22),
(11, 23),
(20, 32),
(21, 33),
(22, 36),
(23, 39),
(23, 41);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_hash`
--

DROP TABLE IF EXISTS `tm_task_hash`;
CREATE TABLE `tm_task_hash` (
  `task_id` int(10) unsigned DEFAULT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `list_value` text,
  PRIMARY KEY (`attribute_key`),
  KEY `fk_tm_task_hash_tm_task_attribute_type1` (`type_id`),
  KEY `fk_tm_task_hash_tm_task1` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_task_hash`
--

INSERT INTO `tm_task_hash` (`task_id`, `attribute_key`, `title`, `type_id`, `list_value`) VALUES
(NULL, 'description', 'Текстовое описание задачи', 1, ''),
(NULL, 'description2', 'description', 2, ' '),
(NULL, 'full_text', 'Большой текст', 2, ''),
(NULL, 'test_list', 'Проверка списка', 3, 'Один||Два||Три '),
(NULL, 'Срок', 'Срок выполнения задачи', 4, ' ');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_relation`
--

DROP TABLE IF EXISTS `tm_task_relation`;
CREATE TABLE `tm_task_relation` (
  `parent_id` int(10) unsigned NOT NULL,
  `child_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`parent_id`,`child_id`),
  KEY `fk_tm_task_relation_tm_task2` (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_task_relation`
--

INSERT INTO `tm_task_relation` (`parent_id`, `child_id`) VALUES
(8, 9),
(8, 10),
(8, 11),
(8, 20),
(8, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user`
--

DROP TABLE IF EXISTS `tm_user`;
CREATE TABLE `tm_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_tm_user_tm_user_role1` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tm_user`
--

INSERT INTO `tm_user` (`id`, `login`, `password`, `role_id`, `date_create`) VALUES
(1, 'admin', '123', 1, '2011-11-16 16:26:11'),
(2, 'user', '321', 4, '2011-11-17 23:35:18'),
(5, 'boss', '654', 3, '2011-11-25 21:50:02'),
(6, 'user2', '333', 4, '2011-11-25 21:50:32');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user_attribute`
--

DROP TABLE IF EXISTS `tm_user_attribute`;
CREATE TABLE `tm_user_attribute` (
  `user_id` int(10) unsigned NOT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `attribute_value` text NOT NULL,
  `is_fill` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`attribute_key`),
  KEY `fk_tm_task_attribute_tm_task1` (`user_id`),
  KEY `fk_tm_document_attribute_tm_document_attribute_type1` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_user_attribute`
--

INSERT INTO `tm_user_attribute` (`user_id`, `attribute_key`, `type_id`, `attribute_value`, `is_fill`) VALUES
(2, 'name', 1, 'Первый пользователь', 1),
(5, 'name', 1, 'Начальник', 1),
(6, 'name', 1, 'Второй пользователь', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user_attribute_type`
--

DROP TABLE IF EXISTS `tm_user_attribute_type`;
CREATE TABLE `tm_user_attribute_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `handler` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tm_user_attribute_type`
--

INSERT INTO `tm_user_attribute_type` (`id`, `title`, `handler`, `description`) VALUES
(1, 'Строка', 'TM_Attribute_AttributeType', 'Любое строковое значение'),
(2, 'Текст', 'TM_Attribute_AttributeTypeText', 'Многострочный  текст'),
(3, 'Список', 'TM_Attribute_AttributeTypeList', 'Список из возможных вариантов');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user_hash`
--

DROP TABLE IF EXISTS `tm_user_hash`;
CREATE TABLE `tm_user_hash` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `list_value` text,
  PRIMARY KEY (`attribute_key`),
  KEY `fk_tm_document_hash_tm_task_attribute_type1` (`type_id`),
  KEY `fk_tm_document_hash_tm_task1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_user_hash`
--

INSERT INTO `tm_user_hash` (`user_id`, `attribute_key`, `title`, `type_id`, `list_value`) VALUES
(NULL, 'name', 'Имя', 1, ' ');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user_profile`
--

DROP TABLE IF EXISTS `tm_user_profile`;
CREATE TABLE `tm_user_profile` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_key` varchar(255) NOT NULL,
  `profile_value` text NOT NULL,
  PRIMARY KEY (`user_id`,`profile_key`),
  KEY `fk_tm_user_profile_tm_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `tm_user_profile`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tm_user_resource`
--

DROP TABLE IF EXISTS `tm_user_resource`;
CREATE TABLE `tm_user_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

--
-- Дамп данных таблицы `tm_user_resource`
--

INSERT INTO `tm_user_resource` (`id`, `title`) VALUES
(51, 'discussion/add'),
(54, 'discussion/addTopic'),
(53, 'discussion/delete'),
(56, 'discussion/deleteTopic'),
(52, 'discussion/edit'),
(55, 'discussion/editTopic'),
(50, 'discussion/index'),
(63, 'discussion/showAcl'),
(38, 'document/add'),
(47, 'document/addAttributeHash'),
(44, 'document/addAttributeType'),
(41, 'document/addFolder'),
(40, 'document/delete'),
(49, 'document/deleteAttributeHash'),
(46, 'document/deleteAttributeType'),
(43, 'document/deleteFolder'),
(39, 'document/edit'),
(48, 'document/editAttributeHash'),
(45, 'document/editAttributeType'),
(42, 'document/editFolder'),
(37, 'document/index'),
(62, 'document/showAcl'),
(75, 'document/showDiscussion'),
(74, 'document/view'),
(57, 'files/'),
(4, 'index/index'),
(1, 'login'),
(2, 'login/index'),
(3, 'login/logout'),
(64, 'reports/generateReport'),
(60, 'reports/index'),
(65, 'reports/showDesigner'),
(58, 'reposrts'),
(27, 'task/add'),
(33, 'task/addAttributeHash'),
(30, 'task/addAttributeType'),
(29, 'task/delete'),
(35, 'task/deleteAttributeHash'),
(32, 'task/deleteAttributeType'),
(36, 'task/deleteLinkToDoc'),
(28, 'task/edit'),
(34, 'task/editAttributeHash'),
(31, 'task/editAttributeType'),
(26, 'task/index'),
(61, 'task/showAcl'),
(66, 'task/showDiscussion'),
(73, 'task/view'),
(5, 'user'),
(6, 'user/add'),
(70, 'user/addAttributeHash'),
(67, 'user/addAttributeType'),
(22, 'user/addResource'),
(19, 'user/addRole'),
(8, 'user/delete'),
(72, 'user/deleteAttributeHash'),
(69, 'user/deleteAttributeType'),
(24, 'user/deleteResource'),
(21, 'user/deleteRole'),
(7, 'user/edit'),
(71, 'user/editAttributeHash'),
(68, 'user/editAttributeType'),
(23, 'user/editResource'),
(20, 'user/editRole'),
(25, 'user/fillResource'),
(15, 'user/index'),
(59, 'user/showRoleAcl');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user_role`
--

DROP TABLE IF EXISTS `tm_user_role`;
CREATE TABLE `tm_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tm_user_role`
--

INSERT INTO `tm_user_role` (`id`, `title`) VALUES
(1, 'admin'),
(3, 'chief'),
(4, 'manager'),
(5, 'guest');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tm_acl_discussion`
--
ALTER TABLE `tm_acl_discussion`
  ADD CONSTRAINT `fk_tm_acl_discussion_tm_discussion1` FOREIGN KEY (`discussion_id`) REFERENCES `tm_discussion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_acl_discussion_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_acl_document`
--
ALTER TABLE `tm_acl_document`
  ADD CONSTRAINT `fk_tm_acl_document_tm_document1` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_acl_document_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_acl_role`
--
ALTER TABLE `tm_acl_role`
  ADD CONSTRAINT `tm_acl_role_ibfk_1` FOREIGN KEY (`tm_user_role_id`) REFERENCES `tm_user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_acl_role_ibfk_2` FOREIGN KEY (`tm_user_resource_id`) REFERENCES `tm_user_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_acl_task`
--
ALTER TABLE `tm_acl_task`
  ADD CONSTRAINT `tm_acl_task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_acl_task_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_discussion`
--
ALTER TABLE `tm_discussion`
  ADD CONSTRAINT `tm_discussion_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `tm_discussion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_discussion_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_discussion_ibfk_3` FOREIGN KEY (`topic_id`) REFERENCES `tm_discussion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_discussion_document`
--
ALTER TABLE `tm_discussion_document`
  ADD CONSTRAINT `tm_discussion_document_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_discussion_document_ibfk_2` FOREIGN KEY (`discussion_id`) REFERENCES `tm_discussion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_document`
--
ALTER TABLE `tm_document`
  ADD CONSTRAINT `tm_document_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_document_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `tm_document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_document_attribute`
--
ALTER TABLE `tm_document_attribute`
  ADD CONSTRAINT `tm_document_attribute_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_document_attribute_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `tm_document_attribute_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_document_hash`
--
ALTER TABLE `tm_document_hash`
  ADD CONSTRAINT `fk_tm_document_hash_tm_document1` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_document_hash_tm_document_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_document_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_task`
--
ALTER TABLE `tm_task`
  ADD CONSTRAINT `fk_tm_task_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_task_attribute`
--
ALTER TABLE `tm_task_attribute`
  ADD CONSTRAINT `tm_task_attribute_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_task_attribute_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `tm_task_attribute_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_task_discussion`
--
ALTER TABLE `tm_task_discussion`
  ADD CONSTRAINT `tm_task_discussion_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_task_discussion_ibfk_2` FOREIGN KEY (`discussion_id`) REFERENCES `tm_discussion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_task_document`
--
ALTER TABLE `tm_task_document`
  ADD CONSTRAINT `tm_task_document_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_task_document_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_task_hash`
--
ALTER TABLE `tm_task_hash`
  ADD CONSTRAINT `fk_tm_task_hash_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_hash_tm_task_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_task_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_task_relation`
--
ALTER TABLE `tm_task_relation`
  ADD CONSTRAINT `tm_task_relation_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `tm_task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_task_relation_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `tm_task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_user`
--
ALTER TABLE `tm_user`
  ADD CONSTRAINT `tm_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tm_user_role` (`id`);

--
-- Ограничения внешнего ключа таблицы `tm_user_attribute`
--
ALTER TABLE `tm_user_attribute`
  ADD CONSTRAINT `tm_user_attribute_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_user_attribute_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `tm_user_attribute_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_user_hash`
--
ALTER TABLE `tm_user_hash`
  ADD CONSTRAINT `tm_user_hash_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `tm_user_attribute_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_user_profile`
--
ALTER TABLE `tm_user_profile`
  ADD CONSTRAINT `fk_tm_user_profile_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
