-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 14 2011 г., 22:44
-- Версия сервера: 5.1.50
-- Версия PHP: 5.3.8-ZS5.5.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sibnii`
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
  `date` datetime NOT NULL,
  `is_first` tinyint(1) NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tm_discussion_tm_discussion1` (`parent_id`),
  KEY `fk_tm_discussion_tm_user1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Структура таблицы `tm_user`
--

DROP TABLE IF EXISTS `tm_user`;
CREATE TABLE IF NOT EXISTS `tm_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_tm_user_tm_user_role1` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD CONSTRAINT `fk_tm_acl_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_acl_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_document_discussion_tm_document1` FOREIGN KEY (`tm_document_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_document_discussion_tm_discussion1` FOREIGN KEY (`tm_discussion_id`) REFERENCES `tm_discussion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_task_attribute_tm_task10` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_document_attribute_tm_document_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_document_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_task`
--
ALTER TABLE `tm_task`
  ADD CONSTRAINT `fk_tm_task_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_task_attribute`
--
ALTER TABLE `tm_task_attribute`
  ADD CONSTRAINT `fk_tm_task_attribute_tm_task_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_task_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_attribute_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_task_discussion`
--
ALTER TABLE `tm_task_discussion`
  ADD CONSTRAINT `fk_tm_task_discussion_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_discussion_tm_discussion1` FOREIGN KEY (`discussion_id`) REFERENCES `tm_discussion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_task_document`
--
ALTER TABLE `tm_task_document`
  ADD CONSTRAINT `fk_tm_task_document_tm_document1` FOREIGN KEY (`document_id`) REFERENCES `tm_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_document_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tm_user_tm_user_role1` FOREIGN KEY (`role_id`) REFERENCES `tm_user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_user_profile`
--
ALTER TABLE `tm_user_profile`
  ADD CONSTRAINT `fk_tm_user_profile_tm_user1` FOREIGN KEY (`user_id`) REFERENCES `tm_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
