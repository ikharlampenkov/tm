<?php /* Smarty version Smarty-3.0.9, created on 2011-12-12 22:42:13
         compiled from "F:\www\tm\application/views/scripts\task/show-acl.tpl" */ ?>
<?php /*%%SmartyHeaderCode:259434ee620d50665d8-03663229%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e1b5eddbfc16005ebf0ebf9ed0b507e23404eb5' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/show-acl.tpl',
      1 => 1323697090,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '259434ee620d50665d8-03663229',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Права для задачи <?php echo $_smarty_tpl->getVariable('task')->value->title;?>
 <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index'));?>
">Все задачи</a></h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showAcl','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
" method="post">
<table width="100%">
   <tr>
       <td class="ttovar_title">Пользователь</td>
       <td class="ttovar" style="width: 90px;">Чтение</td>
       <td class="ttovar" style="width: 90px;">Запись</td>
       <td class="ttovar" style="width: 90px;">Исполнитель</td>
       <td class="ttovar"></td>
   </tr>

<?php if ($_smarty_tpl->getVariable('userList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
        <tr>
            <td class="ttovar_title"><?php if ($_smarty_tpl->getVariable('user')->value->searchAttribute('name')){?><?php echo $_smarty_tpl->getVariable('user')->value->getAttribute('name')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('user')->value->login;?>
<?php }?></td>
            <td class="ttovar"><input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
][is_read]" <?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp2=ob_get_clean();?><?php if (isset($_smarty_tpl->getVariable('taskAcl',null,true,false)->value[$_tmp1])&&$_smarty_tpl->getVariable('taskAcl')->value[$_tmp2]->isRead){?>checked="checked"<?php }?> /></td>
            <td class="ttovar"><input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
][is_write]" <?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp4=ob_get_clean();?><?php if (isset($_smarty_tpl->getVariable('taskAcl',null,true,false)->value[$_tmp3])&&$_smarty_tpl->getVariable('taskAcl')->value[$_tmp4]->isWrite){?>checked="checked"<?php }?> /></td>
            <td class="ttovar"><input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
][is_executant]" <?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp5=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp6=ob_get_clean();?><?php if (isset($_smarty_tpl->getVariable('taskAcl',null,true,false)->value[$_tmp5])&&$_smarty_tpl->getVariable('taskAcl')->value[$_tmp6]->isExecutant){?>checked="checked"<?php }?> /></td>
            <td class="ttovar"></td>
        </tr>
    <?php }} ?>
<?php }?>

</table>
        <input id="save" name="save" type="submit" value="Сохранить"/>
</form>