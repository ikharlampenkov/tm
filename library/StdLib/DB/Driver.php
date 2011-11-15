<?php

/**
 * Абстрактный класс для драйверов Базы Данных.
 * Родоначальник иерархии, определяет интерфейс.
 *
 */
abstract class StdLib_DB_Driver
{

 abstract public function __construct();

 abstract public function connect($dsn);

 abstract public function query($sql, $mode = 1);

 abstract public function setDB($db_name);

 abstract public function setCharset($charset);

 abstract public function prepareString($string);

 abstract public function getNextId($table, $idname);

 abstract public function getLastInsertId();

 abstract public function __destruct();

}
?>