<?php /* Smarty version Smarty-3.0.9, created on 2011-11-27 18:32:31
         compiled from "F:\www\tm\application/views/scripts\user/add-role.tpl" */ ?>
<?php /*%%SmartyHeaderCode:325204ed21fcfa90fb9-95327514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7c015ab2dd17ab93e491d900e20533cb56ba737' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/add-role.tpl',
      1 => 1321549209,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '325204ed21fcfa90fb9-95327514',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>Добавить роль</h1>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addRole'));?>
" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Название</td>
            <td class="ttovar"><input name="data[title]" value=""/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>