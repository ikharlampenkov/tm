<?php /* Smarty version Smarty-3.0.9, created on 2011-12-16 20:27:12
         compiled from "F:\www\tm\application/views/scripts\task/add.ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167574eeb4730512334-43482184%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e1740d9f649333853250a70df0abddad0f38dbc' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/add.ajax.tpl',
      1 => 1324042029,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167574eeb4730512334-43482184',
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
        <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
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
        <td class="ttovar"><input name="data[date_create]" value="<?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->dateCreate,"%d.%m.%Y %H:%M:%S");?>
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
</table>