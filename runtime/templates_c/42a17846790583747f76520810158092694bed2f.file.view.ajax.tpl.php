<?php /* Smarty version Smarty-3.0.9, created on 2012-02-04 23:57:32
         compiled from "F:\www\tm\application/views/scripts\document/view.ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146864f2d637cd6cac1-67100826%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42a17846790583747f76520810158092694bed2f' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\document/view.ajax.tpl',
      1 => 1323620138,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146864f2d637cd6cac1-67100826',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><b>Папка</b>&nbsp;<?php echo $_smarty_tpl->getVariable('document')->value->parent->title;?>
<br/>
<b>Дата создания</b>&nbsp;<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('document')->value->dateCreate,"%d.%m.%Y %H:%M");?>
<br/>

<?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
        <?php if ($_smarty_tpl->getVariable('document')->value->searchAttribute($_smarty_tpl->getVariable('attributeHash')->value->attributeKey)){?>
        <b><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
</b>&nbsp;<?php echo $_smarty_tpl->getVariable('document')->value->getAttribute($_smarty_tpl->getVariable('attributeHash')->value->attributeKey)->value;?>
<br/>
        <?php }?>
    <?php }} ?>
<?php }?>

<?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
    <b>Задачи</b>&nbsp;<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
<br/>
    <?php }} ?>
<?php }?>