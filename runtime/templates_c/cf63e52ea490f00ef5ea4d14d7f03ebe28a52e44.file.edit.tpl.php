<?php /* Smarty version Smarty-3.0.9, created on 2013-09-10 22:28:54
         compiled from "F:\www\tm\application/views/scripts\user/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10487519ba29ce5a9f6-56708163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf63e52ea490f00ef5ea4d14d7f03ebe28a52e44' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/edit.tpl',
      1 => 1375199864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10487519ba29ce5a9f6-56708163',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><h1>Редактировать пользователя</h1>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
    <div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div>
    <br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
" method="post">
    <table>
        <tr>
            <td class="ttovar_title">Логин</td>
            <td class="ttovar"><input type="text" name="data[login]" value="<?php echo $_smarty_tpl->getVariable('user')->value->login;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar">Пароль</td>
            <td class="ttovar"><input type="text" name="data[password]" value="<?php echo $_smarty_tpl->getVariable('user')->value->password;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar">Дата создания</td>
            <td class="ttovar"><input type="text" name="data[date_create]" value="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('user')->value->datecreate,"%d.%m.%Y %H:%M");?>
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
" <?php if ($_smarty_tpl->getVariable('user')->value->role->id==$_smarty_tpl->getVariable('role')->value->id){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('role')->value->rtitle;?>
</option>
                    <?php }} ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar">Тип пользователя</td>
            <td class="ttovar"><select name="data[type]">
                    <option value="administrator" <?php if ($_smarty_tpl->getVariable('user')->value->type=='administrator'){?>selected="selected"<?php }?>>Работник</option>
                    <option value="client" <?php if ($_smarty_tpl->getVariable('user')->value->type=='client'){?>selected="selected"<?php }?>>Клиент</option>
                </select>
            </td>
        </tr>
        <?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
            <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
                <tr>
                    <td class="ttovar_title"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
</td>
                    <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->type->getHTMLFrom($_smarty_tpl->tpl_vars['attributeHash']->value,$_smarty_tpl->getVariable('user')->value);?>
</td>
                </tr>
            <?php }} ?>
        <?php }?>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>