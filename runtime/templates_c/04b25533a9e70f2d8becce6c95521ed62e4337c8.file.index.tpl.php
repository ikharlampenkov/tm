<?php /* Smarty version Smarty-3.0.9, created on 2011-12-01 22:44:03
         compiled from "F:\www\tm\application/views/scripts\reports/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5614ed7a0c37913b2-33080832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04b25533a9e70f2d8becce6c95521ed62e4337c8' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\reports/index.tpl',
      1 => 1322753957,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5614ed7a0c37913b2-33080832',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="page"><h1>Отчеты</h1></div><br/>

<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'generateReport'));?>
">Сформировать стандартный отчет</a><br/><br/>

