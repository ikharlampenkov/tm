<?php /* Smarty version Smarty-3.0.9, created on 2011-12-24 15:03:09
         compiled from "F:\www\tm\application/views/scripts\task/info.ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183744ef5873d905580-33812669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3712ced9e81411446eb44fc4a1ca6dcae799e57c' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/info.ajax.tpl',
      1 => 1324713634,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183744ef5873d905580-33812669',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?>
Название</b>&nbsp;<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
<br/>

<b>Супер задача</b>&nbsp;
<?php if (count($_smarty_tpl->getVariable('task')->value->parent)>0){?>
    <?php  $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('task')->value->parent; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['parent']->key => $_smarty_tpl->tpl_vars['parent']->value){
?>
        <?php echo $_smarty_tpl->getVariable('parent')->value->title;?>

    <?php }} ?>
<?php }?>
<br/>

<b>Дата создания</b>&nbsp;<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->dateCreate,"%d.%B.%Y %H:%M");?>
<br/>

<?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
        <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute($_smarty_tpl->getVariable('attributeHash')->value->attributeKey)){?>
        <b><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
</b>&nbsp;<?php echo $_smarty_tpl->getVariable('attributeHash')->value->type->getHTML($_smarty_tpl->tpl_vars['attributeHash']->value,$_smarty_tpl->getVariable('task')->value);?>
<br/>
        <?php }?>
    <?php }} ?>
<?php }?>

<?php if ($_smarty_tpl->getVariable('documentList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('documentList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
?>
    <b>Документ</b>&nbsp;<a href="/files<?php echo $_smarty_tpl->getVariable('document')->value->file->getSubPath();?>
/<?php echo $_smarty_tpl->getVariable('document')->value->file->getName();?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('document')->value->title;?>
</a><br/>
    <?php }} ?>
<?php }?>