-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 22 2011 г., 13:19
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

CREATE TABLE IF NOT EXISTS `tm_acl_discussion` (
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


-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_document`
--

CREATE TABLE IF NOT EXISTS `tm_acl_document` (
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


-- --------------------------------------------------------

--
-- Структура таблицы `tm_acl_task`
--

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

--
-- Дамп данных таблицы `tm_acl_task`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tm_discussion`
--

CREATE TABLE IF NOT EXISTS `tm_discussion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `is_first` tinyint(1) NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tm_discussion_tm_discussion1` (`parent_id`),
  KEY `fk_tm_discussion_tm_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `tm_discussion`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tm_discussion_document`
--

CREATE TABLE IF NOT EXISTS `tm_discussion_document` (
  `tm_document_id` int(10) unsigned NOT NULL,
  `tm_discussion_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tm_document_id`,`tm_discussion_id`),
  KEY `fk_tm_document_discussion_tm_document1` (`tm_document_id`),
  KEY `fk_tm_document_discussion_tm_discussion1` (`tm_discussion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_discussion_document`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tm_document`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `tm_document`
--

INSERT INTO `tm_document` (`id`, `title`, `date_create`, `user_id`, `file`, `is_folder`, `parent_id`) VALUES
(1, 'Первая папка', '2011-11-22 06:59:33', 1, '', 1, NULL),
(2, 'Вторая папка', '2011-11-22 07:10:00', 1, '', 1, NULL),
(4, 'Тест2', '2011-11-22 07:14:55', 1, '', 1, 1),
(5, 'Тест2', '2011-11-22 08:19:07', 1, 'file_22-11-2011-08-21-22.pdf', 0, 1),
(6, 'Новый', '2011-11-22 08:31:35', 1, 'file_22-11-2011-08-31-54.pdf', 0, 1),
(9, 'Проверка', '2011-11-22 12:52:32', 1, 'file_22-11-2011-12-52-32.pdf', 0, NULL),
(10, 'Линковка', '2011-11-22 12:59:21', 1, 'file_22-11-2011-12-59-21.pdf', 0, NULL),
(11, 'Тест на удаление', '2011-11-22 13:13:41', 1, 'file_22-11-2011-13-13-41.pdf', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document_attribute`
--

CREATE TABLE IF NOT EXISTS `tm_document_attribute` (
  `document_id` int(10) unsigned NOT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `attribute_value` text NOT NULL,
  PRIMARY KEY (`document_id`,`attribute_key`),
  KEY `fk_tm_task_attribute_tm_task1` (`document_id`),
  KEY `fk_tm_document_attribute_tm_document_attribute_type1` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_document_attribute`
--

INSERT INTO `tm_document_attribute` (`document_id`, `attribute_key`, `type_id`, `attribute_value`) VALUES
(1, 'description', 1, ''),
(1, 'full_text', 2, ''),
(1, 'test_list', 3, 'Один'),
(5, 'description', 1, ''),
(5, 'full_text', 2, ''),
(5, 'test_list', 3, 'Один');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_document_attribute_type`
--

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
(1, 'Первый проект', 1, '2011-11-18 14:36:42'),
(2, 'Первая задача', 1, '2011-11-18 15:05:03'),
(3, 'Вторая задача', 1, '2011-11-18 15:10:25'),
(4, 'Первая задача', 1, '2011-11-18 15:05:03'),
(5, 'Второй проект', 1, '2011-11-18 23:40:19'),
(6, 'Тест', 1, '2011-11-18 23:41:01'),
(7, 'Тест на удаление', 1, '2011-11-20 23:22:57'),
(8, 'Вторая подзадача', 1, '2011-11-21 20:39:21'),
(9, '123', 1, '2011-11-22 08:21:56');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_attribute`
--

CREATE TABLE IF NOT EXISTS `tm_task_attribute` (
  `task_id` int(10) unsigned NOT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `attribute_value` text NOT NULL,
  PRIMARY KEY (`task_id`,`attribute_key`),
  KEY `fk_tm_task_attribute_tm_task_attribute_type1` (`type_id`),
  KEY `fk_tm_task_attribute_tm_task1` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_task_attribute`
--

INSERT INTO `tm_task_attribute` (`task_id`, `attribute_key`, `type_id`, `attribute_value`) VALUES
(3, 'description', 1, 'Test'),
(3, 'description2', 2, ''),
(3, 'full_text', 2, 'Big test'),
(3, 'test_list', 3, 'Три '),
(7, 'description', 1, 'Test');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_attribute_type`
--

CREATE TABLE IF NOT EXISTS `tm_task_attribute_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `handler` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tm_task_attribute_type`
--

INSERT INTO `tm_task_attribute_type` (`id`, `title`, `handler`, `description`) VALUES
(1, 'Строка', 'TM_Attribute_AttributeType', 'Любое строковое значение'),
(2, 'Текст', 'TM_Attribute_AttributeTypeText', 'Многострочный  текст'),
(3, 'Список', 'TM_Attribute_AttributeTypeList', 'Список из возможных вариантов');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_discussion`
--

CREATE TABLE IF NOT EXISTS `tm_task_discussion` (
  `task_id` int(10) unsigned NOT NULL,
  `discussion_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`task_id`,`discussion_id`),
  KEY `fk_tm_task_discussion_tm_discussion1` (`discussion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_task_discussion`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_document`
--

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
(3, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_hash`
--

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
(NULL, 'test_list', 'Проверка списка', 3, 'Один||Два||Три ');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_task_relation`
--

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
(5, 2),
(1, 3),
(1, 4),
(6, 7),
(3, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user`
--

CREATE TABLE IF NOT EXISTS `tm_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_tm_user_tm_user_role1` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tm_user`
--

INSERT INTO `tm_user` (`id`, `login`, `password`, `role_id`, `date_create`) VALUES
(1, 'admin', '123', 1, '2011-11-16 16:26:11'),
(2, 'user', '321', 1, '2011-11-17 23:35:18'),
(4, 'test', '333', 2, '2011-11-18 00:06:27');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user_profile`
--

CREATE TABLE IF NOT EXISTS `tm_user_profile` (
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
-- Структура таблицы `tm_user_role`
--

CREATE TABLE IF NOT EXISTS `tm_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tm_user_role`
--

INSERT INTO `tm_user_role` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'test');

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
-- Ограничения внешнего ключа таблицы `tm_acl_task`
--
ALTER TABLE `tm_acl_task`
  ADD CONSTRAINT `fk_tm_acl_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_acl_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_discussion`
--
ALTER TABLE `tm_discussion`
  ADD CONSTRAINT `fk_tm_discussion_tm_discussion1` FOREIGN KEY (`parent_id`) REFERENCES `tm_discussion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_discussion_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_document_tm_document1` FOREIGN KEY (`parent_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_document_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_document_attribute`
--
ALTER TABLE `tm_document_attribute`
  ADD CONSTRAINT `fk_tm_document_attribute_tm_document_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_document_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_attribute_tm_task10` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_task_attribute_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_attribute_tm_task_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_task_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_task_document_tm_document1` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_document_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_task_relation_tm_task1` FOREIGN KEY (`parent_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_relation_tm_task2` FOREIGN KEY (`child_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
