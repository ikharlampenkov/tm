<?php

if( !isset($_SESSION)) {
  session_start() ;
}

/**
 * Подключаем общий файл конфигурации
 *
 */
include_once 'F:/www/sibnii2/private/config/simo_conf.php';

/**
 * Подключаем Smarty
 *
 */
include_once $__cfg['site.main.dir'] .  'private/classes/smarty/Smarty.class.php';

/**
 * Функция автоматически загружающая файлы с классами по необходимости
 *
 * @param string $className
 */
function autoload($className) {
  global $__cfg;

  if(file_exists($fn = $__cfg['site.main.dir'] . 'private/classes/stdclass/' . $className . '.php')) {
    include_once($fn);
  }

  if (file_exists($fn = $__cfg['site.main.dir'] . 'private/classes/stdclass/DB/' . $className . '.php')) {
  	include_once($fn);
  }

  if(file_exists($fn = $__cfg['site.main.dir'] . 'private/classes/share/' . $className . '.php')) {
    include_once($fn);
  }

  if(file_exists($fn = $__cfg['site.main.dir'] . 'private/classes/gkh/' . $className . '.php')) {
    include_once($fn);
  }

  if(file_exists($fn = $__cfg['site.main.dir'] . 'private/classes/FileManager/' . $className . '.php')) {
    include_once($fn);
  }

  if(file_exists($fn = $__cfg['site.main.dir'] . 'private/classes/sbn/' . $className . '.php')) {
    include_once($fn);
  }
}

spl_autoload_register('autoload', false);

$o_log = new StdLib_Log();
$o_log->setLogLevel($__cfg['log.level']);

?>