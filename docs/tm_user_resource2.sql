-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2013 г., 21:41
-- Версия сервера: 5.5.23
-- Версия PHP: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Дамп данных таблицы `tm_user_resource`
--

INSERT INTO `tm_user_resource` (`title`, `rtitle`) VALUES
('organization/addAttributeType', 'Организации/Добавить тип атрибута'),
('organization/editAttributeType', 'Организации/Редактировать тип атрибута'),
('organization/deleteAttributeType', 'Организации/Удалить тип атрибута'),
('organization/addAttributeHash', 'Организации/Добавить новый атрибут'),
('organization/editAttributeHash', 'Организации/Редактировать список атрибутов'),
('organization/deleteAttributeHash', 'Организации/Удалить атрибут из списка'),
('organization/viewAttributeType', 'Организации/Показать типы атрибутов'),
('organization/viewHash', 'Организации/Показать список атрибутов');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
