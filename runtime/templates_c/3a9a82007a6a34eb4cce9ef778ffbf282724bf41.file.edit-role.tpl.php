<?php /* Smarty version Smarty-3.0.9, created on 2011-11-27 19:31:48
         compiled from "F:\www\tm\application/views/scripts\user/edit-role.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134434ed22db46f5ce0-03877931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a9a82007a6a34eb4cce9ef778ffbf282724bf41' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/edit-role.tpl',
      1 => 1321549146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134434ed22db46f5ce0-03877931',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>Редактировать роль</h1>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editRole','id'=>$_smarty_tpl->getVariable('role')->value->id));?>
" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Название</td>
            <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('role')->value->title;?>
"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>