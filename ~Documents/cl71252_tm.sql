-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 26 2011 г., 14:38
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tm_discussion`
--

INSERT INTO `tm_discussion` (`id`, `message`, `date_create`, `is_first`, `is_message`, `topic_id`, `parent_id`, `user_id`) VALUES
(1, 'Второй проект', '2011-11-26 14:11:31', 0, 0, NULL, NULL, 1),
(2, 'Первая задача', '2011-11-26 14:30:00', 0, 0, NULL, NULL, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `tm_document`
--

INSERT INTO `tm_document` (`id`, `title`, `date_create`, `user_id`, `file`, `is_folder`, `parent_id`) VALUES
(18, 'Второй проект', '2011-11-26 14:11:31', 1, 'Vtoroy_proekt', 1, NULL),
(19, 'Первая задача', '2011-11-26 14:30:00', 1, 'Pervaya_zadacha', 1, 18);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `tm_task`
--

INSERT INTO `tm_task` (`id`, `title`, `user_id`, `date_create`) VALUES
(6, 'Второй проект', 1, '2011-11-26 14:11:25'),
(7, 'Первая задача', 1, '2011-11-26 14:29:53');

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

--
-- Дамп данных таблицы `tm_task_attribute`
--

INSERT INTO `tm_task_attribute` (`task_id`, `attribute_key`, `type_id`, `attribute_value`, `is_fill`) VALUES
(7, 'description', 1, '', 0),
(7, 'description2', 2, '', 0),
(7, 'full_text', 2, '', 0),
(7, 'test_list', 3, 'Один', 0),
(7, 'Срок', 4, '26.11.2011 14:30:36', 0);

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
(6, 18),
(7, 19);

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
(6, 7);

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
-- Структура таблицы `tm_user_role`
--

DROP TABLE IF EXISTS `tm_user_role`;
CREATE TABLE IF NOT EXISTS `tm_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tm_user_role`
--

INSERT INTO `tm_user_role` (`id`, `title`) VALUES
(1, 'admin'),
(3, 'chief'),
(4, 'manager');

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
  ADD CONSTRAINT `tm_document_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `tm_document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_document_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
