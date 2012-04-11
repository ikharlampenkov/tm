-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 14 2012 г., 00:29
-- Версия сервера: 5.1.50
-- Версия PHP: 5.3.9-ZS5.6.0

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
-- Структура таблицы `tm_department`
--

DROP TABLE IF EXISTS `tm_department`;
CREATE TABLE IF NOT EXISTS `tm_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `organization_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tm_department_tm_organization1` (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tm_organization`
--

DROP TABLE IF EXISTS `tm_organization`;
CREATE TABLE IF NOT EXISTS `tm_organization` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tm_organization`
--

INSERT INTO `tm_organization` (`id`, `title`) VALUES
(1, 'ООО "ИнвойсГрупп"'),
(2, 'ООО "ИнвойсГрупп"');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_organization_attribute`
--

DROP TABLE IF EXISTS `tm_organization_attribute`;
CREATE TABLE IF NOT EXISTS `tm_organization_attribute` (
  `organization_id` int(10) unsigned NOT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `attribute_value` text NOT NULL,
  `attribute_order` int(10) unsigned NOT NULL DEFAULT '0',
  `is_fill` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`organization_id`,`attribute_key`),
  KEY `fk_tm_organization_attribute_tm_organization1` (`organization_id`),
  KEY `fk_tm_organization_attribute_tm_organization_hash1` (`attribute_key`),
  KEY `fk_tm_organization_attribute_tm_organization_attribute_type1` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_organization_attribute`
--

INSERT INTO `tm_organization_attribute` (`organization_id`, `attribute_key`, `type_id`, `attribute_value`, `attribute_order`, `is_fill`) VALUES
(2, 'inn', 1, '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tm_organization_attribute_type`
--

DROP TABLE IF EXISTS `tm_organization_attribute_type`;
CREATE TABLE IF NOT EXISTS `tm_organization_attribute_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `handler` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `tm_organization_attribute_type`
--

INSERT INTO `tm_organization_attribute_type` (`id`, `title`, `handler`, `description`) VALUES
(1, 'Строка', 'TM_Attribute_AttributeType', 'Любое строковое значение'),
(2, 'Текст', 'TM_Attribute_AttributeTypeText', 'Многострочный  текст'),
(3, 'Список', 'TM_Attribute_AttributeTypeList', 'Список из возможных вариантов');

-- --------------------------------------------------------

--
-- Структура таблицы `tm_organization_hash`
--

DROP TABLE IF EXISTS `tm_organization_hash`;
CREATE TABLE IF NOT EXISTS `tm_organization_hash` (
  `organization_id` int(10) unsigned DEFAULT NULL,
  `attribute_key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `list_value` text,
  `list_order` varchar(255) NOT NULL DEFAULT '',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`attribute_key`),
  KEY `fk_tm_organization_hash_tm_organization_attribute_type1` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tm_organization_hash`
--

INSERT INTO `tm_organization_hash` (`organization_id`, `attribute_key`, `title`, `type_id`, `list_value`, `list_order`, `required`, `sort_order`) VALUES
(NULL, 'inn', 'ИНН', 1, ' ', '', 0, 1000);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tm_department`
--
ALTER TABLE `tm_department`
  ADD CONSTRAINT `fk_tm_department_tm_organization1` FOREIGN KEY (`organization_id`) REFERENCES `tm_organization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_organization_attribute`
--
ALTER TABLE `tm_organization_attribute`
  ADD CONSTRAINT `fk_tm_organization_attribute_tm_organization_hash1` FOREIGN KEY (`attribute_key`) REFERENCES `tm_organization_hash` (`attribute_key`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_organization_attribute_tm_organization1` FOREIGN KEY (`organization_id`) REFERENCES `tm_organization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_organization_attribute_tm_organization_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_organization_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tm_organization_hash`
--
ALTER TABLE `tm_organization_hash`
  ADD CONSTRAINT `fk_tm_organization_hash_tm_organization_attribute_type1` FOREIGN KEY (`type_id`) REFERENCES `tm_organization_attribute_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
