-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Хост: db.hosting.risp.ru:3606
-- Время создания: Дек 07 2011 г., 09:27
-- Версия сервера: 5.0.67
-- Версия PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `dnevnik_gkh_gilishnik`
--

--
-- Дамп данных таблицы `content_page`
--

INSERT INTO `content_page` (`id`, `page_title`, `title`, `description`, `content`, `file`) VALUES
(47, 'main', 'Главная страница', '', '<div class=\\"rzdtitle\\">\r\n	Раскрытие информации</div>\r\n<br />\r\n<div id=\\"accordion\\">\r\n	<h3>\r\n		<a href=\\"#\\">Общая информация об управляющей организации</a></h3>\r\n	<div>\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=about&amp;spage=about\\" title=\\"Общая информация\\">Общая информация</a><br />\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=rekvizit\\">Реквизиты</a><br />\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=perechen_domov\\">Перечень домов, находящихся в управлении</a><br />\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=perechen_domov_rastorgnutie\\">Перечень домов, в отношении которых договора были расторгнуты</a></div>\r\n	<h3>\r\n		<a href=\\"#\\">Основные показатели финансово-хозяйственной деятельности управляющей организации</a></h3>\r\n	<div>\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=financial_statements&amp;spage=reports\\" title=\\"Бухгалтерская отчетность\\">Бухгалтерская отчетность</a><br />\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=income&amp;spage=reports\\" title=\\"Доходы\\">Отчет о прибылях и убытках</a></div>\r\n	<h3>\r\n		<a href=\\"#\\">Сведения о выполняемых работах по содержанию и ремонту общего имущества в многоквартирном доме</a></h3>\r\n	<div>\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=uslugi_obshie\\" title=\\"Услуги по содержанию и ремонту общего имущества\\">Услуги по содержанию и ремонту общего имущества</a><br />\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=uslugi_tceli\\" title=\\"Услуги, связанные с достижением целей управления\\">Услуги, связанные с достижением целей управления</a><br />\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=perechen_dogovorov\\" title=\\"Перечень договоров\\">Перечень договоров</a></div>\r\n	<h3>\r\n		<a href=\\"#\\">Порядок и условия оказания услуг по содержанию и ремонту общего имущества</a></h3>\r\n	<div>\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=dogovor&amp;spage=about\\" title=\\"Договор\\">Договор управления МКД</a><br />\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=pril_k_dog&amp;spage=about\\" title=\\"Приложение к договору управления многоквартирным домом\\">Приложение к договору управления многоквартирным домом</a><br />\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=snizenie_plati\\" title=\\"Сведения о снижении платы\\">Сведения о снижении платы</a></div>\r\n	<h3>\r\n		<a href=\\"#\\">Сведения о стоимости работ (услуг) по содержанию и ремонту общего имущества в многоквартирном доме</a></h3>\r\n	<div>\r\n		<a class=\\"rascr_text\\" href=\\"#\\" title=\\"Перечень услуг и работ по содержанию общего имущества на 2011год\\">Перечень услуг и работ по содержанию общего имущества на 2011год</a></div>\r\n	<h3>\r\n		<a href=\\"#\\">Сведения о ценах (тарифах) на коммунальные ресурсы</a></h3>\r\n	<div>\r\n		<a class=\\"rascr_text\\" href=\\"?page=content_page&amp;title=gkh&amp;spage=rates\\">Действующие тарифы</a></div>\r\n</div>\r\n', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
