<?php /* Smarty version Smarty-3.0.9, created on 2011-11-28 23:10:53
         compiled from "F:\www\tm\application/views/scripts\task/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89904ed3b28d01a052-68746954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd38489d51cc8581c50e133eb48215d3ee5d17ae2' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/edit.tpl',
      1 => 1322290839,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89904ed3b28d01a052-68746954',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1>Редактировать задачу</h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Супер задача</td>
            <td class="ttovar"><select name="data[parentTask]">
                <option value="">--</option>
            <?php if (!empty($_smarty_tpl->getVariable('parentList',null,true,false)->value)){?>
                <?php  $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('parentList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['parent']->key => $_smarty_tpl->tpl_vars['parent']->value){
?>
                    <option value="<?php echo $_smarty_tpl->getVariable('parent')->value->id;?>
" <?php if ($_smarty_tpl->getVariable('task')->value->searchParent($_smarty_tpl->tpl_vars['parent']->value)!==false){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('parent')->value->title;?>
</option>
                <?php }} ?>
            <?php }?>
            </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->dateCreate,"%d.%m.%Y %H:%M:%S");?>
"/></td>
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
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->type->getHTMLFrom($_smarty_tpl->tpl_vars['attributeHash']->value,$_smarty_tpl->getVariable('task')->value);?>
</td>
            </tr>
        <?php }} ?>
    <?php }?>

    <?php if ($_smarty_tpl->getVariable('documentList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('documentList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
?>
            <tr>
            <td class="ttovar_title">Документ</td>
            <td class="ttovar">
                <a href="/files<?php echo $_smarty_tpl->getVariable('document')->value->file->getSubPath();?>
/<?php echo $_smarty_tpl->getVariable('document')->value->file->getName();?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('document')->value->title;?>
</a>
                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'edit','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
">редактировать</a>
                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteLinkToDoc','id'=>$_smarty_tpl->getVariable('task')->value->id,'doc_id'=>$_smarty_tpl->getVariable('document')->value->id));?>
">удалить</a>
            </td>
        </tr>
        <?php }} ?>
    <?php }?>
        <tr>
            <td class="ttovar_title">Документ</td>
            <td class="ttovar">
                Название документа&nbsp;<input name="data[document_title]" value="" style="width: 310px;" />&nbsp;&nbsp;
		        <input type="file" name="file" style="width: 300px;"/>
            </td>
        </tr>

    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>