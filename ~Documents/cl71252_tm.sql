-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 27 2011 г., 22:18
-- Версия сервера: 5.1.50
-- Версия PHP: 5.3.8-ZS5.5.0

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


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
CREATE TABLE IF NOT EXISTS `tm_acl_discussion` (
  `user_id` int(10) unsigned NOT NULL,
  `discussion_id` int(10) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_write` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`discussion_id`),
  KEY `fk_tm_acl_discussion_tm_discussion1` (`discussion_id`),
  KEY `fk_tm_acl_discussion_tm_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_document`
--

DROP TABLE IF EXISTS `tm_acl_document`;
CREATE TABLE IF NOT EXISTS `tm_acl_document` (
  `user_id` int(10) unsigned NOT NULL,
  `document_id` int(10) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_write` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`document_id`),
  KEY `fk_tm_acl_document_tm_user1` (`user_id`),
  KEY `fk_tm_acl_document_tm_document1` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_role`
--

DROP TABLE IF EXISTS `tm_acl_role`;
CREATE TABLE IF NOT EXISTS `tm_acl_role` (
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
(4, 60, 0, ''),
(5, 1, 1, 'show'),
(5, 2, 1, 'show'),
(5, 3, 1, 'show'),
(5, 4, 0, 'show'),
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
(5, 57, 0, 'show');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_task`
--

DROP TABLE IF EXISTS `tm_acl_task`;
CREATE TABLE IF NOT EXISTS `tm_acl_task` (
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_write` tinyint(1) NOT NULL DEFAULT '0',
  `is_executant` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`,`task_id`),
  KEY `fk_tm_acl_tm_user1` (`user_id`),
  KEY `fk_tm_acl_tm_task1` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tm_discussion`
--

DROP TABLE IF EXISTS `tm_discussion`;
CREATE TABLE IF NOT EXISTS `tm_discussion` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tm_discussion`
--

INSERT INTO `tm_discussion` (`id`, `message`, `date_create`, `is_first`, `is_message`, `topic_id`, `parent_id`, `user_id`) VALUES
(3, 'Первый проект', '2011-11-27 22:14:57', 0, 0, NULL, NULL, 1),
(4, 'Первая задача', '2011-11-27 22:15:40', 0, 0, 3, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_discussion_document`
--

DROP TABLE IF EXISTS `tm_discussion_document`;
CREATE TABLE IF NOT EXISTS `tm_discussion_document` (
  `tm_document_id` int(10) unsigned NOT NULL,
  `tm_discussion_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tm_document_id`,`tm_discussion_id`),
  KEY `fk_tm_document_discussion_tm_document1` (`tm_document_id`),
  KEY `fk_tm_document_discussion_tm_discussion1` (`tm_discussion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document`
--

DROP TABLE IF EXISTS `tm_document`;
CREATE TABLE IF NOT EXISTS `tm_document` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `tm_document`
--

INSERT INTO `tm_document` (`id`, `title`, `date_create`, `user_id`, `file`, `is_folder`, `parent_id`) VALUES
(20, 'Первый проект', '2011-11-27 22:14:57', 1, 'Pervyiy_proekt', 1, NULL),
(21, 'Первая задача', '2011-11-27 22:15:40', 1, 'Pervaya_zadacha', 1, 20);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document_attribute`
--

DROP TABLE IF EXISTS `tm_document_attribute`;
CREATE TABLE IF NOT EXISTS `tm_document_attribute` (
  `document_id` int(10) unsigned NOT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `attribute_value` text NOT NULL,
  `is_fill` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`document_id`,`attribute_key`),
  KEY `fk_tm_task_attribute_tm_task1` (`document_id`),
  KEY `fk_tm_document_attribute_tm_document_attribute_type1` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document_attribute_type`
--

DROP TABLE IF EXISTS `tm_document_attribute_type`;
CREATE TABLE IF NOT EXISTS `tm_document_attribute_type` (
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
CREATE TABLE IF NOT EXISTS `tm_document_hash` (
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
CREATE TABLE IF NOT EXISTS `tm_task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tm_task_tm_user1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `tm_task`
--

INSERT INTO `tm_task` (`id`, `title`, `user_id`, `date_create`) VALUES
(8, 'Первый проект', 1, '2011-11-27 22:14:47'),
(9, 'Первая задача', 1, '2011-11-27 22:15:34');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_attribute`
--

DROP TABLE IF EXISTS `tm_task_attribute`;
CREATE TABLE IF NOT EXISTS `tm_task_attribute` (
  `task_id` int(10) unsigned NOT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `attribute_value` text NOT NULL,
  `is_fill` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_id`,`attribute_key`),
  KEY `fk_tm_task_attribute_tm_task_attribute_type1` (`type_id`),
  KEY `fk_tm_task_attribute_tm_task1` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_attribute_type`
--

DROP TABLE IF EXISTS `tm_task_attribute_type`;
CREATE TABLE IF NOT EXISTS `tm_task_attribute_type` (
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
CREATE TABLE IF NOT EXISTS `tm_task_discussion` (
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
(9, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_document`
--

DROP TABLE IF EXISTS `tm_task_document`;
CREATE TABLE IF NOT EXISTS `tm_task_document` (
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
(9, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_hash`
--

DROP TABLE IF EXISTS `tm_task_hash`;
CREATE TABLE IF NOT EXISTS `tm_task_hash` (
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
CREATE TABLE IF NOT EXISTS `tm_task_relation` (
  `parent_id` int(10) unsigned NOT NULL,
  `child_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`parent_id`,`child_id`),
  KEY `fk_tm_task_relation_tm_task2` (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_task_relation`
--

INSERT INTO `tm_task_relation` (`parent_id`, `child_id`) VALUES
(8, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user`
--

DROP TABLE IF EXISTS `tm_user`;
CREATE TABLE IF NOT EXISTS `tm_user` (
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
-- Структура таблицы `tm_user_profile`
--

DROP TABLE IF EXISTS `tm_user_profile`;
CREATE TABLE IF NOT EXISTS `tm_user_profile` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_key` varchar(255) NOT NULL,
  `profile_value` text NOT NULL,
  PRIMARY KEY (`user_id`,`profile_key`),
  KEY `fk_tm_user_profile_tm_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user_resource`
--

DROP TABLE IF EXISTS `tm_user_resource`;
CREATE TABLE IF NOT EXISTS `tm_user_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

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
(57, 'files/'),
(4, 'index/index'),
(1, 'login'),
(2, 'login/index'),
(3, 'login/logout'),
(60, 'reports/index'),
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
(5, 'user'),
(6, 'user/add'),
(22, 'user/addResource'),
(19, 'user/addRole'),
(8, 'user/delete'),
(24, 'user/deleteResource'),
(21, 'user/deleteRole'),
(7, 'user/edit'),
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
CREATE TABLE IF NOT EXISTS `tm_user_role` (
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
  ADD CONSTRAINT `fk_tm_acl_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_acl_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_document_discussion_tm_discussion1` FOREIGN KEY (`tm_discussion_id`) REFERENCES `tm_discussion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_document_discussion_tm_document1` FOREIGN KEY (`tm_document_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_task_discussion_tm_discussion1` FOREIGN KEY (`discussion_id`) REFERENCES `tm_discussion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_discussion_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Ограничения внешнего ключа таблицы `tm_user_profile`
--
ALTER TABLE `tm_user_profile`
  ADD CONSTRAINT `fk_tm_user_profile_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
