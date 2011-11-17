<?php /* Smarty version Smarty-3.0.9, created on 2011-11-17 23:50:16
         compiled from "F:\www\tm\application/views/scripts\user/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132454ec53b486c3c78-81478799%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adce21d5e4bd44928444e8e78142d735bf514e9d' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/index.tpl',
      1 => 1321548613,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132454ec53b486c3c78-81478799',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Пользователи</h1></div><br/>

<?php if ($_smarty_tpl->getVariable('userList')->value!==false){?>
<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
">добавить</a></td>
    </tr>

    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('user')->value->login;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('user')->value->role->title;?>
</td>
            <td class="tedit"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
">редактировать</a><br/>
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
');" style="color: #830000">удалить</a></td>
        </tr>
    <?php }} ?>

</table>
<?php }?>

<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Роли</h1></div><br/>

<?php if ($_smarty_tpl->getVariable('userRoleList')->value!==false){?>
<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addRole'));?>
">добавить</a></td>
    </tr>

    <?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userRoleList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('role')->value->title;?>
</td>
            <td class="tedit"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editRole','id'=>$_smarty_tpl->getVariable('role')->value->id));?>
">редактировать</a><br/>
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteRole','id'=>$_smarty_tpl->getVariable('role')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('role')->value->id;?>
');" style="color: #830000">удалить</a></td>
        </tr>
    <?php }} ?>

</table>
<?php }?>