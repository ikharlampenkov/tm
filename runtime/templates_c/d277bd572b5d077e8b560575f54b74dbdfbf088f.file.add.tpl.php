<?php /* Smarty version Smarty-3.0.9, created on 2011-11-27 22:09:06
         compiled from "F:\www\tm\application/views/scripts\document/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94334ed252923fa6b0-97974564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd277bd572b5d077e8b560575f54b74dbdfbf088f' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\document/add.tpl',
      1 => 1322059244,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94334ed252923fa6b0-97974564',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1>Добавить документ</h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('document')->value->title;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Папка</td>
            <td class="ttovar"><select name="data[parentDocument]">
                <option value="">--</option>
            <?php if (!empty($_smarty_tpl->getVariable('parentList',null,true,false)->value)){?>
                <?php  $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('parentList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['parent']->key => $_smarty_tpl->tpl_vars['parent']->value){
?>
                    <option value="<?php echo $_smarty_tpl->getVariable('parent')->value->id;?>
" <?php if (is_object($_smarty_tpl->getVariable('document')->value->parent)&&$_smarty_tpl->getVariable('document')->value->parent->id==$_smarty_tpl->getVariable('parent')->value->id){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('parent')->value->title;?>
</option>
                <?php }} ?>
            <?php }?>
            </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('document')->value->dateCreate,"%d.%m.%Y %H:%M:%S");?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Файл</td>
            <td class="ttovar"><input type="file" name="file"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>