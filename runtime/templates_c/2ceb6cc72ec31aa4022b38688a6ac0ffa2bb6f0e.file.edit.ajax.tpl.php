<?php /* Smarty version Smarty-3.0.9, created on 2013-07-28 22:10:17
         compiled from "F:\www\tm\application/views/scripts\task/edit.ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2081751f53459810691-40978546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ceb6cc72ec31aa4022b38688a6ac0ffa2bb6f0e' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/edit.ajax.tpl',
      1 => 1375024208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2081751f53459810691-40978546',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div id="exception" class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
        <p id="exception_message"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</p>
    </div>
</div>
<br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
" method="post" enctype="multipart/form-data" id="editForm">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Тип задачи</td>
            <td class="ttovar">
                <select name="data[type]" class="input_ajax">
                <?php  $_smarty_tpl->tpl_vars['task_type'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['task_type_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskTypeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task_type']->key => $_smarty_tpl->tpl_vars['task_type']->value){
 $_smarty_tpl->tpl_vars['task_type_key']->value = $_smarty_tpl->tpl_vars['task_type']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['task_type_key']->value;?>
" <?php if ($_smarty_tpl->getVariable('task')->value->type==$_smarty_tpl->tpl_vars['task_type_key']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['task_type']->value;?>
</option>
                <?php }} ?>

                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input type="text" name="data[title]" value="<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
" class="input_ajax"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Супер задача</td>
            <td class="ttovar"><select name="data[parentTask]" class="input_ajax">
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
                    <?php if ($_smarty_tpl->getVariable('parent')->value->getChild()){?>
                    <?php $_template = new Smarty_Internal_Template("task/parent-block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('subtask',$_smarty_tpl->getVariable('parent')->value->getChild());$_template->assign('task',$_smarty_tpl->getVariable('task')->value);$_template->assign('wid',"--"); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                    <?php }?>
                <?php }} ?>
            <?php }?>
            </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input type="text" name="data[date_create]" value="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->dateCreate,"%d.%m.%Y %H:%M:%S");?>
" class="datepicker input_ajax"/></td>
        </tr>

    <?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
            <tr>
                <td class="<?php if ($_smarty_tpl->getVariable('attributeHash')->value->isRequired){?>ttovar_title_requared<?php }else{ ?>ttovar_title<?php }?>"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
<?php if ($_smarty_tpl->getVariable('attributeHash')->value->isRequired){?>*<?php }?></td>
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
" target="_blank" id="doc_info_<?php echo $_smarty_tpl->getVariable('document')->value->id;?>
" onmouseover="doc.showInfo('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'view','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('document')->value->id;?>
);"><?php echo $_smarty_tpl->getVariable('document')->value->title;?>
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
                Название&nbsp;<input type="text" name="data[document_title]" value="" style="width: 210px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 200px;"/><br/>
                <textarea name="data[document_description]"></textarea>
            </td>
        </tr>
    </table>

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
                <td class="ttovar"><input type="checkbox" name="dataacl[<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
][is_read]" <?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp2=ob_get_clean();?><?php if (isset($_smarty_tpl->getVariable('taskAcl',null,true,false)->value[$_tmp1])&&$_smarty_tpl->getVariable('taskAcl')->value[$_tmp2]->isRead){?>checked="checked"<?php }?> /></td>
                <td class="ttovar"><input type="checkbox" name="dataacl[<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
][is_write]" <?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp4=ob_get_clean();?><?php if (isset($_smarty_tpl->getVariable('taskAcl',null,true,false)->value[$_tmp3])&&$_smarty_tpl->getVariable('taskAcl')->value[$_tmp4]->isWrite){?>checked="checked"<?php }?> /></td>
                <td class="ttovar"><input type="checkbox" name="dataacl[<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
][is_executant]" <?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp5=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<?php $_tmp6=ob_get_clean();?><?php if (isset($_smarty_tpl->getVariable('taskAcl',null,true,false)->value[$_tmp5])&&$_smarty_tpl->getVariable('taskAcl')->value[$_tmp6]->isExecutant){?>checked="checked"<?php }?> /></td>
                <td class="ttovar"><input type="hidden" name="dataacl[<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
][fake]" /></td>
            </tr>
        <?php }} ?>
    <?php }?>

    </table>


</form>