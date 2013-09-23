-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 01 2011 г., 13:43
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
-- Ограничения внешнего ключа таблицы `tm_acl_role`
--
ALTER TABLE `tm_acl_role`
  ADD CONSTRAINT `tm_acl_role_ibfk_1` FOREIGN KEY (`tm_user_role_id`) REFERENCES `tm_user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_acl_role_ibfk_2` FOREIGN KEY (`tm_user_resource_id`) REFERENCES `tm_user_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_task_attribute`
--
ALTER TABLE `tm_task_attribute`
  ADD CONSTRAINT `tm_task_attribute_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tm_task_attribute_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `tm_task_attribute_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tm_task_hash`
--
ALTER TABLE `tm_task_hash`
  ADD CONSTRAINT `fk_tm_task_hash_tm_task1` FOREIGN KEY (`task_id`) REFERENCES `tm_task` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_task_hash_tm_task_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_task_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
