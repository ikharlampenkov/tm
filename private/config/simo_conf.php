<?php

/**
 * Настройки системы
 *
 * @author Moris
 * @package simo
 */

$__cfg['db.dsn'] = 'mysqli://root:2BGxPIIB@localhost/sibnii2';
$__cfg['site.main.dir'] = 'F:/www/sibnii2/';
$__cfg['db.driver.path'] = $__cfg['site.main.dir'] . 'private/classes/stdclass/DB/';
$__cfg['db.driver.debug'] = true;

$__cfg['log.path'] = $__cfg['site.main.dir'] . 'private/logs/';
$__cfg['log.level'] = 2;

$__cfg['system.debug'] = true;

$__cfg['smarty.templates'] = $__cfg['site.main.dir'] . 'private/smartytemplates/templates/';
$__cfg['smarty.compile']   = $__cfg['site.main.dir'] . 'private/smartytemplates/templates_c/';
$__cfg['smarty.cache']     = $__cfg['site.main.dir'] . 'private/smartytemplates/cache/';
$__cfg['smarty.compile_check'] = true;
$__cfg['smarty.debug'] = false;

$__cfg['smarty.default.title'] = 'SibNII2';
$__cfg['smarty.default.desc'] = '';
$__cfg['smarty.default.keyword'] = '';

//$__cfg['smarty.encoding'] = 'windows-1251';
$__cfg['smarty.encoding'] = 'utf-8';

$__cfg['site.dir'] = $__cfg['site.main.dir'] . 'public_html/';
$__cfg['site.url'] = 'http://www.sibnii2/';

$__cfg['temp.dir'] = $__cfg['site.main.dir'] . 'private/temp/';
$__cfg['file.upload.dir'] = $__cfg['site.main.dir'] . 'public_html/files/';

?>