<?php /* Smarty version Smarty-3.0.9, created on 2012-01-30 22:44:40
         compiled from "F:\www\tm\application/views/scripts\user/child-task-block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30884f26bae88ef048-09043419%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6bd98d280a796f3cda2e89c2cc5268822c64cab8' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/child-task-block.tpl',
      1 => 1327938277,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30884f26bae88ef048-09043419',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('subtask')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('subtask')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
        <tr>
            <td class="ttovar"><img src="/i/<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>task_group.png<?php }else{ ?>task.png<?php }?>"/>&nbsp;<?php echo $_smarty_tpl->getVariable('wid')->value;?>
<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</td>
            <td class="ttovar"><input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_read]" <?php if ($_smarty_tpl->getVariable('task')->value->isRead($_smarty_tpl->getVariable('user')->value)){?>checked="checked" <?php }?> /></td>
            <td class="ttovar"><input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_write]" <?php if ($_smarty_tpl->getVariable('task')->value->isWrite($_smarty_tpl->getVariable('user')->value)){?>checked="checked" <?php }?> /></td>
            <td class="ttovar">
                <input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_executant]"
                    <?php if (count($_smarty_tpl->getVariable('task')->value->getExecutant())>0){?>
                        <?php  $_smarty_tpl->tpl_vars['iuser'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('task')->value->getExecutant(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['iuser']->key => $_smarty_tpl->tpl_vars['iuser']->value){
?>
                       <?php if ($_smarty_tpl->getVariable('iuser')->value->id===$_smarty_tpl->getVariable('user')->value->id){?>checked="checked" <?php }?>
                        <?php }} ?>
                        <?php }else{ ?>&nbsp;
                    <?php }?>
                        />
            </td>
            <td class="ttovar">
                <input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_responsible]"
                    <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('who_responsible')&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_responsible')->value!='-'&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_responsible')->value==$_smarty_tpl->getVariable('user')->value->id){?>
                       checked="checked"
                    <?php }?>
                        />
            </td>
            <td class="ttovar"><input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_owner]" <?php if ($_smarty_tpl->getVariable('task')->value->user->id==$_smarty_tpl->getVariable('user')->value->id){?>checked="checked"<?php }?> /></td>
        </tr>
        <?php if ($_smarty_tpl->getVariable('task')->value->getChild()){?>
        <?php $_template = new Smarty_Internal_Template("user/child-task-block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('subtask',$_smarty_tpl->getVariable('task')->value->getChild());$_template->assign('wid',($_smarty_tpl->getVariable('wid')->value).('--'));$_template->assign('user',$_smarty_tpl->getVariable('user')->value); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php }?>
    <?php }} ?>
<?php }?>