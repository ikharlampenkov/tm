<?php /* Smarty version Smarty-3.0.9, created on 2011-12-12 22:07:49
         compiled from "F:\www\tm\application/views/scripts\reports/taskblock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177584ee618c54b7fc7-50983122%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '878aac74c2c7f880c6cdab81b82d590b0a9efe29' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\reports/taskblock.tpl',
      1 => 1323702464,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177584ee618c54b7fc7-50983122',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><?php if ($_smarty_tpl->getVariable('subtask')->value){?>
    <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('subtask')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
    <tr>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>" style="padding-left: <?php echo $_smarty_tpl->getVariable('wid')->value;?>
px;"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</td>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->datecreate,"%d %B %Y");?>
</td>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('deadline')){?><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getAttribute('deadline')->value,"%d %B %Y");?>
<?php }?></td>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getExecuteTime(),"%d");?>
 дней</td>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><?php if ($_smarty_tpl->getVariable('task')->value->getLeftTime()!=0){?><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getLeftTime(),"%d");?>
<?php }else{ ?>0<?php }?> дней</td>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>">
            <?php if (count($_smarty_tpl->getVariable('task')->value->getExecutant())>0){?>
                <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('task')->value->getExecutant(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
                    <div><?php if ($_smarty_tpl->getVariable('user')->value->searchAttribute('name')){?><?php echo $_smarty_tpl->getVariable('user')->value->getAttribute('name')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('user')->value->login;?>
<?php }?><?php if ($_smarty_tpl->getVariable('user')->value->searchAttribute('position')&&$_smarty_tpl->getVariable('user')->value->getAttribute('position')->value!=''){?>, <?php echo $_smarty_tpl->getVariable('user')->value->getAttribute('position')->value;?>
<?php }?></div>
                <?php }} ?>
            <?php }?>
        </td>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('who_responsible')&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_responsible')->value!='-'){?>
            <?php $_smarty_tpl->tpl_vars["who_responsible"] = new Smarty_variable(TM_User_User::getInstanceById($_smarty_tpl->getVariable('task')->value->getAttribute('who_responsible')->value), null, null);?>
            <?php if ($_smarty_tpl->getVariable('who_responsible')->value->searchAttribute('name')){?>
                <?php echo $_smarty_tpl->getVariable('who_responsible')->value->getAttribute('name')->value;?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('who_responsible')->value->login;?>

            <?php }?>
            <?php }else{ ?>&nbsp;
        <?php }?></td>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('who_adopted')&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_adopted')->value!='-'){?>
            <?php $_smarty_tpl->tpl_vars["who_adopted"] = new Smarty_variable(TM_User_User::getInstanceByLogin($_smarty_tpl->getVariable('task')->value->getAttribute('who_adopted')->value), null, null);?>
            <?php if ($_smarty_tpl->getVariable('who_adopted')->value->searchAttribute('name')){?>
                <?php echo $_smarty_tpl->getVariable('who_adopted')->value->getAttribute('name')->value;?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('who_adopted')->value->login;?>

            <?php }?>
            <?php }else{ ?>&nbsp;
        <?php }?></td>
        <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('who_set')&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_set')->value!='-'){?>
            <?php $_smarty_tpl->tpl_vars["who_set"] = new Smarty_variable(TM_User_User::getInstanceById($_smarty_tpl->getVariable('task')->value->getAttribute('who_set')->value), null, null);?>
            <?php if ($_smarty_tpl->getVariable('who_set')->value->searchAttribute('name')){?>
                <?php echo $_smarty_tpl->getVariable('who_set')->value->getAttribute('name')->value;?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('who_set')->value->login;?>

            <?php }?>
            <?php }else{ ?>&nbsp;
        <?php }?></td>
    </tr>
        <?php if ($_smarty_tpl->getVariable('task')->value->getChild()){?>
        <?php $_template = new Smarty_Internal_Template("reports/taskblock.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('subtask',$_smarty_tpl->getVariable('task')->value->getChild());$_template->assign('wid',$_smarty_tpl->getVariable('wid')->value+20); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php }?>
    <?php }} ?>
<?php }?>