<?php /* Smarty version Smarty-3.0.9, created on 2011-12-12 23:59:31
         compiled from "F:\www\tm\application/views/scripts\index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:244354ee632f3d7bcb4-97843193%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2aac6fcce9bb0e3eeaf67af4b08b5d77457fb5f' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\index/index.tpl',
      1 => 1323709167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244354ee632f3d7bcb4-97843193',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?>

<table>
    <tr>
        <td style="width: 50%">
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-task")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-task"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="index_block">
                <div class="index_block_title" style="">
                    <span style="vertical-align: middle;">Мои задачи</span>
                </div>
                <div class="index_block_content">

                    <ul id="subtask_0">
                        <?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
                            <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                    <li id="task_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" class="task_list">
                                        <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>">

                                            <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                                                <img src="/i/<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>task_group.png<?php }else{ ?>task.png<?php }?>"/>&nbsp;
                                                <a href="javascript:void(0)" onclick="task.viewTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</a>
                                            </div>

                                            <div style="width: 120px; float:right;">
                                                <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('deadline')){?>
                                                    <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getAttribute('deadline')->value,"%d %B %Y");?>

                                                    <?php }else{ ?>&nbsp;
                                                <?php }?>
                                            </div>

                                        </div>
                                    </li>
                                    <ul id="subtask_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" style="display: none; margin-left: 20px;"></ul>
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php }} ?>
                        <?php }?>
                    </ul>


                </div>
            </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-task"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </td>
        <td style="width: 50%">
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-discussion")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-discussion"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="index_block">
                <div class="index_block_title" style="">
                    <span style="vertical-align: middle;">Личные сообщения</span>
                </div>
                <div class="index_block_content">

                    <ul id="comment-list" style="padding: 0; margin: 0;">
                        <?php if ($_smarty_tpl->getVariable('discussionList')->value!==false){?>
                            <?php  $_smarty_tpl->tpl_vars['discussion'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discussionList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discussion']->key => $_smarty_tpl->tpl_vars['discussion']->value){
?>
                                <li style="list-style: none; padding: 5px; background-color: #f7f7f7;">
                                    <div style="padding: 5px;">
                                        <div style="font-size: 12px; line-height: 16px;" id="message_<?php echo $_smarty_tpl->getVariable('discussion')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
</div>
                                        <?php if (count($_smarty_tpl->getVariable('discussion')->value->document)>0){?>
                                            <div style="">
                                                <ul style="padding: 0; margin: 0;">
                                                    <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discussion')->value->document; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
?>
                                                        <li style="list-style: none; padding: 0px; background-color: #f7f7f7;">
                                                            <a href="/files<?php echo $_smarty_tpl->getVariable('document')->value->file->getSubPath();?>
/<?php echo $_smarty_tpl->getVariable('document')->value->file->getName();?>
" target="_blank" style="font-size: 11px;" id="doc_info_<?php echo $_smarty_tpl->getVariable('document')->value->id;?>
" onmouseover="doc.showInfo('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'view','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('document')->value->id;?>
);"><?php echo $_smarty_tpl->getVariable('document')->value->title;?>
</a>
                                                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"document/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"document/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                                                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'edit','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
" style="font-size: 11px;">редактировать</a>
                                                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                        </li>
                                                    <?php }} ?>
                                                </ul>
                                            </div>
                                        <?php }?>
                                        <div style="color: #555555; font-size: 11px; line-height: 15px; margin: 5px 0px 0px 0px;">
                                            <?php if ($_smarty_tpl->getVariable('discussion')->value->user->searchAttribute('name')){?><?php echo $_smarty_tpl->getVariable('discussion')->value->user->getAttribute('name')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('discussion')->value->user->login;?>
<?php }?> <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('discussion')->value->datecreate,"%d.%m.%Y");?>

                                        </div>
                                    </div>
                                </li>
                            <?php }} ?>
                        <?php }?>
                    </ul>


                </div>
            </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-discussion"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </td>
    </tr>
    <tr>
        <td style="width: 50%">
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-reports")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-reports"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="index_block">
                <div class="index_block_title" style="">
                    <span style="vertical-align: middle;">Отчет</span>
                </div>
                <div class="index_block_content">

                </div>
            </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-reports"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </td>
        <td style="width: 50%">

        </td>
    </tr>
</table>

