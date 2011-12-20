<?php /* Smarty version Smarty-3.0.9, created on 2011-12-11 20:16:15
         compiled from "F:\www\tm\application/views/scripts\document/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:101304ee4ad1fa85895-32100647%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61d9f692ec4792b55bf6399e0d4acc7c792ca669' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\document/edit.tpl',
      1 => 1322757108,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101304ee4ad1fa85895-32100647',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1>Редактировать документ</h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
" method="post">
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
            <td class="ttovar"><?php if ($_smarty_tpl->getVariable('document')->value->file->getName()){?><a href="/files<?php echo $_smarty_tpl->getVariable('document')->value->file->getSubPath();?>
/<?php echo $_smarty_tpl->getVariable('document')->value->file->getName();?>
" target="_blank">загрузить</a><?php }?><input type="file" name="file"/></td>
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
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->type->getHTMLFrom($_smarty_tpl->tpl_vars['attributeHash']->value,$_smarty_tpl->getVariable('document')->value);?>
</td>
            </tr>
        <?php }} ?>
    <?php }?>

    <?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
            <tr>
            <td class="ttovar_title">Задачи</td>
            <td class="ttovar">
                <?php echo $_smarty_tpl->getVariable('task')->value->title;?>

                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
">редактировать</a>
            </td>
        </tr>
        <?php }} ?>
    <?php }?>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>