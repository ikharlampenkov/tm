<?php /* Smarty version Smarty-3.0.9, created on 2011-12-12 21:44:53
         compiled from "F:\www\tm\application/views/scripts\user/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157114ee61364f39438-18022967%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '585d38bf3619a7c446eb41d960008834815cae65' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/add.tpl',
      1 => 1323700989,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157114ee61364f39438-18022967',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><h1>Добавить пользователя</h1>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Логин</td>
            <td class="ttovar"><input name="data[login]" value=""/></td>
        </tr>
        <tr>
            <td class="ttovar">Пароль</td>
            <td class="ttovar"><input name="data[password]" value=""/></td>
        </tr>
        <tr>
            <td class="ttovar">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="<?php echo smarty_modifier_date_format(time(),"%d.%m.%Y %H:%M:%S");?>
" class="datepicker"/></td>
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
"><?php echo $_smarty_tpl->getVariable('role')->value->title;?>
</option>
            <?php }} ?>
            </select>
            </td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>