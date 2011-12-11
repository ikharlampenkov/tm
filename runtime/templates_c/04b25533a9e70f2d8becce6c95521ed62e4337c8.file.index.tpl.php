<?php /* Smarty version Smarty-3.0.9, created on 2011-12-11 23:21:36
         compiled from "F:\www\tm\application/views/scripts\reports/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320864ee4d89061f9f0-82959961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04b25533a9e70f2d8becce6c95521ed62e4337c8' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\reports/index.tpl',
      1 => 1323620492,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320864ee4d89061f9f0-82959961',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="page"><h1>Аналитика</h1></div><br/>

<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'generateReport'));?>
">Сформировать стандартный отчет</a><br/><br/>

