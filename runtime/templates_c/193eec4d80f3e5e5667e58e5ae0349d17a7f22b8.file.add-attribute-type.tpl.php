<?php /* Smarty version Smarty-3.0.9, created on 2011-11-27 20:10:54
         compiled from "F:\www\tm\application/views/scripts\document/add-attribute-type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:325164ed236de3e9d96-58081345%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '193eec4d80f3e5e5667e58e5ae0349d17a7f22b8' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\document/add-attribute-type.tpl',
      1 => 1321889303,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '325164ed236de3e9d96-58081345',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="page"><h1>Добавить тип атрибута</h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addAttributeType'));?>
" method="post">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('type')->value->title;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Описание</td>
            <td class="ttovar"><input name="data[description]" value="<?php echo $_smarty_tpl->getVariable('type')->value->description;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Обработчик</td>
            <td class="ttovar"><input name="data[handler]" value="<?php echo $_smarty_tpl->getVariable('type')->value->handler;?>
"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>