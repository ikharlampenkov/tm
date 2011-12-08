<?php /* Smarty version Smarty-3.0.9, created on 2011-11-27 20:44:29
         compiled from "F:\www\tm\application/views/scripts\user/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:101994ed23ebd48d858-99359090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf63e52ea490f00ef5ea4d14d7f03ebe28a52e44' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/edit.tpl',
      1 => 1321546724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101994ed23ebd48d858-99359090',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>Редактировать пользователя</h1>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Логин</td>
            <td class="ttovar"><input name="data[login]" value="<?php echo $_smarty_tpl->getVariable('user')->value->login;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar">Пароль</td>
            <td class="ttovar"><input name="data[password]" value="<?php echo $_smarty_tpl->getVariable('user')->value->password;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="<?php echo $_smarty_tpl->getVariable('user')->value->datecreate;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar">Роль</td>
            <td class="ttovar"><select name="data[role_id]">
            <?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userRoleList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value){
?>
                <option value="<?php echo $_smarty_tpl->getVariable('role')->value->id;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->role->id==$_smarty_tpl->getVariable('role')->value->id){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('role')->value->title;?>
</option>
            <?php }} ?>
            </select>
            </td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>