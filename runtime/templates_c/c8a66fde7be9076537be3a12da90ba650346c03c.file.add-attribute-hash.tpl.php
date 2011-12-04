<?php /* Smarty version Smarty-3.0.9, created on 2011-12-01 22:03:34
         compiled from "F:\www\tm\application/views/scripts\task/add-attribute-hash.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69564ed7974648fe88-88514115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8a66fde7be9076537be3a12da90ba650346c03c' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/add-attribute-hash.tpl',
      1 => 1321889539,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69564ed7974648fe88-88514115',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="page"><h1>Добавить атрибут</h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addAttributeHash'));?>
" method="post">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Ключ</td>
            <td class="ttovar"><input name="data[attribute_key]" value="<?php echo $_smarty_tpl->getVariable('hash')->value->attributeKey;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Описание</td>
            <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('hash')->value->title;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Тип</td>
            <td class="ttovar">
                <select name="data[type_id]">
                <?php  $_smarty_tpl->tpl_vars['attributeType'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeTypeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeType']->key => $_smarty_tpl->tpl_vars['attributeType']->value){
?>
                    <option value="<?php echo $_smarty_tpl->getVariable('attributeType')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('attributeType')->value->title;?>
</option>
                <?php }} ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Список значений (через ||) </td>
            <td class="ttovar"><input name="data[list_value]" value="<?php echo $_smarty_tpl->getVariable('hash')->value->listValue;?>
"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>