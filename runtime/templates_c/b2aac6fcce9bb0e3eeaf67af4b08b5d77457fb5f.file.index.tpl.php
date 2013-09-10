<?php /* Smarty version Smarty-3.0.9, created on 2013-08-04 22:09:24
         compiled from "F:\www\tm\application/views/scripts\index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:382151f524f79b6714-47170453%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2aac6fcce9bb0e3eeaf67af4b08b5d77457fb5f' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\index/index.tpl',
      1 => 1375199864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '382151f524f79b6714-47170453',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?>

<div class="container">

<div class="row">
    <div class="span6">

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-task")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-task"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="index_block">
                <div class="index_block_title" style="">
                    <span style="vertical-align: middle;">Мои задачи</span>
                </div>
                <div class="index_block_content">

                    <ul id="task_subtask_0">
                        <?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
                            <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                    <li id="task_task_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" class="task_list">
                                        <div class="task_block">

                                            <div class="task_title">
                                                <img src="/i/<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>task_group.png<?php }else{ ?>task.png<?php }?>"/>&nbsp;
                                                <a href="javascript:void(0)" onclick="
                                                <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>
                                                    task.openTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);
                                                <?php }else{ ?>
                                                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                                        task.editDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', 0, '<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>0));?>
', 'task_');
                                                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                                        task.viewTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);
                                                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                <?php }?>

                                                        " class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>task_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>task_red<?php }else{ ?>task_gray<?php }?>"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</a>
                                            </div>

                                            <div class="task_deadline">
                                                <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('deadline')){?>
                                                    <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getAttribute('deadline')->value,"%d %B %Y");?>

                                                <?php }else{ ?>&nbsp;
                                                <?php }?>
                                            </div>

                                        </div>
                                    </li>
                                    <ul id="task_subtask_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" class="task_subtask"></ul>
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php }} ?>
                        <?php }?>
                    </ul>


                </div>
            </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-task"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    </div>
    <div class="span6">

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-discussion")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-discussion"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="index_block">
                <div class="index_block_title" style="">
                    <span style="vertical-align: middle;">Сообщения и заявки</span>
                </div>
                <div class="index_block_content">

                    <?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(false, null, null);?>

                    <ul id="comment-list" style="padding: 0; margin: 0;">
                        <?php if ($_smarty_tpl->getVariable('discussionList')->value!==false){?>
                        <?php  $_smarty_tpl->tpl_vars['discussion'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discussionList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discussion']->key => $_smarty_tpl->tpl_vars['discussion']->value){
?>
                        <?php if (!$_smarty_tpl->getVariable('discussion')->value->hasParent()&&$_smarty_tpl->getVariable('openul')->value){?></ul><?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(false, null, null);?><?php }?>
                    <?php if ($_smarty_tpl->getVariable('discussion')->value->hasParent()&&!$_smarty_tpl->getVariable('openul')->value){?>
                    <ul class="discussion_submessage"><?php $_smarty_tpl->tpl_vars["openul"] = new Smarty_variable(true, null, null);?><?php }?>
                        <li class="discussion_list">
                            <div class="discussion_block">
                                <div id="message_<?php echo $_smarty_tpl->getVariable('discussion')->value->id;?>
" class="<?php if ($_smarty_tpl->getVariable('discussion')->value->isRequest&&!$_smarty_tpl->getVariable('discussion')->value->isComplete){?>discussion_message_request<?php }else{ ?>discussion_message<?php }?>"><?php echo $_smarty_tpl->getVariable('discussion')->value->message;?>
</div>
                                <?php if (count($_smarty_tpl->getVariable('discussion')->value->document)>0){?>
                                    <div>
                                        <ul>
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

                                                        /
                                                        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'edit','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
" style="font-size: 11px;">редактировать</a>
                                                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                                </li>
                                            <?php }} ?>
                                        </ul>
                                    </div>
                                <?php }?>
                                <div class="discussion_info">
                                    <?php if ($_smarty_tpl->getVariable('discussion')->value->user->searchAttribute('name')){?><?php echo $_smarty_tpl->getVariable('discussion')->value->user->getAttribute('name')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('discussion')->value->user->login;?>
<?php }?> <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('discussion')->value->datecreate,"%d.%m.%Y");?>

                                    <button onclick="comment_reply_on2(<?php echo $_smarty_tpl->getVariable('discussion')->value->id;?>
, <?php echo $_smarty_tpl->getVariable('discussion')->value->user->id;?>
, <?php echo $_smarty_tpl->getVariable('discussion')->value->getTask()->id;?>
);">Ответить</button>
                                    <?php if ($_smarty_tpl->getVariable('discussion')->value->isRequest){?><?php if ($_smarty_tpl->getVariable('discussion')->value->isComplete){?>
                                        <img src="/i/is_complite.png" title="Выполнена" alt="Выполнена" border="0"/>
                                    <?php }elseif($_smarty_tpl->getVariable('discussion')->value->user->id==$_smarty_tpl->getVariable('authUserId')->value){?>
                                    <button onclick="comment_complete_rq('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','idTask'=>$_smarty_tpl->getVariable('task')->value->id,'is_complete'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
');">Завершить</button><?php }?><?php }?>
                                    <?php if ($_smarty_tpl->getVariable('discussion')->value->user->id==$_smarty_tpl->getVariable('authUserId')->value){?>
                                        <button onclick="comment_complete_rq('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','idTask'=>$_smarty_tpl->getVariable('task')->value->id,'delete'=>$_smarty_tpl->getVariable('discussion')->value->id));?>
');">удалить</button>
                                    <?php }?>
                                </div>
                            </div>
                        </li>
                        <?php }} ?>
                        <?php }?>
                    </ul>

                    <div id="replay_form" style="display: none;">
                        <form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index'));?>
" method="post" enctype="multipart/form-data">
                            <div>
                                <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">
                                    Ответить на <span id="replay_on_message"></span>
                                </div>
                                <textarea name="data[message]"></textarea><br/>

                                <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Загрузить документ</div>
                                <div>
                                    Название документа&nbsp;<input name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                                    <input type="file" name="file" style="width: 300px;"/>
                                </div>
                                <input type="hidden" name="data[parent]" value="" id="parent"/>
                                <input type="hidden" name="data[to]" value="" id="to_user">
                                <input type="hidden" name="data[task]" value="" id="to_task">
                                <input id="save" name="save" type="submit" value="Отправить"/>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-my-discussion"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </div>
</div>

<div class="row">
    <div class="span6">

    </div>
    <div class="span6">
    </div>
</div>
</div>


