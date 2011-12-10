<?php /* Smarty version Smarty-3.0.9, created on 2011-12-10 13:37:27
         compiled from "F:\www\tm\application/views/scripts\user/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69834ee2304c70cbf2-54969502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adce21d5e4bd44928444e8e78142d735bf514e9d' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/index.tpl',
      1 => 1323451314,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69834ee2304c70cbf2-54969502',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="page"><h1>Пользователи</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
">добавить</a></td>
    </tr>
    <tr>
        <td class="ttovar">Логин</td>
        <td class="ttovar">Роль</td>
        <td class="ttovar"></td>
    </tr>

<?php if ($_smarty_tpl->getVariable('userList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('user')->value->login;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('user')->value->role->rtitle;?>
</td>
            <td class="tedit"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
">редактировать</a><br/>
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('user')->value->login;?>
');" style="color: #830000">удалить</a></td>
        </tr>
    <?php }} ?>
<?php }?>
</table>


<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Роли</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addRole'));?>
">добавить</a></td>
    </tr>

<?php if ($_smarty_tpl->getVariable('userRoleList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userRoleList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('role')->value->rtitle;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('role')->value->title;?>
</td>
            <td class="tedit"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showRoleAcl','idRole'=>$_smarty_tpl->getVariable('role')->value->id));?>
">права</a></td>
            <td class="tedit"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editRole','id'=>$_smarty_tpl->getVariable('role')->value->id));?>
">редактировать</a><br/>
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteRole','id'=>$_smarty_tpl->getVariable('role')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('role')->value->rtitle;?>
');" style="color: #830000">удалить</a></td>
        </tr>
    <?php }} ?>
<?php }?>
</table>


<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Ресурсы</h1></div><br/>


<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addResource'));?>
">добавить</a></td>
    </tr>

<?php if ($_smarty_tpl->getVariable('userResourceList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userResourceList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('resource')->value->rtitle;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('resource')->value->title;?>
</td>
            <td class="tedit"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editResource','id'=>$_smarty_tpl->getVariable('resource')->value->id));?>
">редактировать</a><br/>
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteResource','id'=>$_smarty_tpl->getVariable('resource')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('resource')->value->rtitle;?>
');" style="color: #830000">удалить</a></td>
        </tr>
    <?php }} ?>
<?php }?>

</table>


<br/>
<div class="page"><h1>Список аттрибутов для пользователей</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="4"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addAttributeHash'));?>
">добавить</a></td>
    </tr>

<?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->attributeKey;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->type->title;?>
</td>
            <td class="tedit">
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editAttributeHash','key'=>$_smarty_tpl->getVariable('attributeHash')->value->attributeKey));?>
">редактировать</a><br/>
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteAttributeHash','key'=>$_smarty_tpl->getVariable('attributeHash')->value->attributeKey));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
');" style="color: #830000">удалить</a>
            </td>
        </tr>
    <?php }} ?>
<?php }?>

</table>

<br/>
<div class="page"><h1>Типы аттрибутов</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addAttributeType'));?>
">добавить</a></td>
    </tr>

<?php if ($_smarty_tpl->getVariable('attributeTypeList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['attributeType'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeTypeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeType']->key => $_smarty_tpl->tpl_vars['attributeType']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeType')->value->title;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeType')->value->handler;?>
</td>
            <td class="tedit">
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editAttributeType','id'=>$_smarty_tpl->getVariable('attributeType')->value->id));?>
">редактировать</a><br/>
                <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteAttributeType','id'=>$_smarty_tpl->getVariable('attributeType')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('attributeType')->value->title;?>
');" style="color: #830000">удалить</a>
            </td>
        </tr>
    <?php }} ?>
<?php }?>

</table>
