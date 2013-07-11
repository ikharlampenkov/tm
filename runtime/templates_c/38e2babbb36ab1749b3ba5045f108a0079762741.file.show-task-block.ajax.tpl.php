<?php /* Smarty version Smarty-3.0.9, created on 2012-02-05 20:09:58
         compiled from "F:\www\tm\application/views/scripts\task/show-task-block.ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15124f2e7fa66747b4-03397147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38e2babbb36ab1749b3ba5045f108a0079762741' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/show-task-block.ajax.tpl',
      1 => 1328371775,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15124f2e7fa66747b4-03397147',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_capitalize')) include 'F:\www\tm\library\Smarty\plugins\modifier.capitalize.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
        <?php ob_start();?><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('controller')->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value))); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <li id="task_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
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
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <?php ob_start();?><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('controller')->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>$_tmp2,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>$_tmp2,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                        task.editDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>0<?php }else{ ?><?php echo $_smarty_tpl->getVariable('task')->value->getFirstParent()->id;?>
<?php }?>, '<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>0));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->getFirstParent()->id));?>
<?php }?>');
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>$_tmp2,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                    task.viewTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <?php }?>
                            " class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>task_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>task_red<?php }else{ ?>task_gray<?php }?>"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</a>
                </div>


                <div class="task_action">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showDiscussion")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showDiscussion"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showDiscussion','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
"><img src="/i/discussion_mini.png" alt="обсуждение" title="обсуждение" border="0"/></a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showDiscussion"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        &nbsp;<a href="javascript:void(0)" onclick="task.viewTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);"><img src="/i/task.png" alt="просмотреть" title="просмотреть" border="0"/></a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        &nbsp;<a href="javascript:void(0)" onclick="task.addDialog('<?php ob_start();?><?php echo $_smarty_tpl->getVariable('task')->value->id;?>
<?php $_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add','parent'=>$_tmp3));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
, '<?php ob_start();?><?php echo $_smarty_tpl->getVariable('task')->value->id;?>
<?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_tmp4));?>
');"><img src="/i/add.png" alt="добавить задачу" title="добавить задачу" border="0"/></a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <?php ob_start();?><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('controller')->value);?>
<?php $_tmp5=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>$_tmp5,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>$_tmp5,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            &nbsp;<a href="javascript:void(0)" onclick="task.editDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>0<?php }else{ ?><?php echo $_smarty_tpl->getVariable('task')->value->getFirstParent()->id;?>
<?php }?>, '<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>0));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->getFirstParent()->id));?>
<?php }?>');"><img src="/i/edit.png" alt="редактировать" title="редактировать" border="0"/></a>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>$_tmp5,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/toArchive")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/toArchive"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <a href="javascript:void(0)" onclick="task.toArchive('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'toArchive','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
', 0, '<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>0));?>
')"><img src="/i/zip.gif" alt="в архив" title="в архив" border="0"/></a>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/toArchive"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php }?>
                    <?php if ($_smarty_tpl->getVariable('task')->value->user->id==$_smarty_tpl->getVariable('authUserId')->value||$_smarty_tpl->getVariable('task')->value->user->title=='admin'){?>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        &nbsp;<a href="javascript:void(0)" onclick="task.deleteDialog('<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
', '<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>0<?php }else{ ?><?php echo $_smarty_tpl->getVariable('task')->value->getFirstParent()->id;?>
<?php }?>, '<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>0));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->getFirstParent()->id));?>
<?php }?>');" style="color: #830000"><img src="/i/delete.png" alt="удалить" title="удалить" border="0"/></a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php }?>
                </div>

                <div class="task_deadline">
                    <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('deadline')){?>
                        <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getAttribute('deadline')->value,"%d %B %Y");?>

                        <?php }else{ ?>&nbsp;
                    <?php }?>
                </div>

                <div class="task_statistic">
                    <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>
                        <?php $_smarty_tpl->tpl_vars["stat"] = new Smarty_variable($_smarty_tpl->getVariable('task')->value->getTaskStatistic(), null, null);?>
                        <a href="javascript:void(0);" onclick="task.openTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
, true, '', 'Выполнена');"><img src="/i/is_complite.png" title="Выполненных" alt="Выполненных" border="0"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['is_complite'];?>
</a>
                        <a href="javascript:void(0);" onclick="task.openTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
, true, '', 'Не выполнена');"><img src="/i/task.png" title="Не выполненных" alt="Не выполненных" border="0">&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['is_do'];?>
</a>
                        <a href="javascript:void(0);" onclick="task.openTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
, true, '', 'Не выполнена');"><img src="/i/is_out.png" title="Просроченных" alt="Просроченных" border="0"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['is_out'];?>
</a>
                        <a href="javascript:void(0);" onclick="task.openTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
, true, '', 'Возникли вопросы');"><img src="/i/is_problem.png" title="Возникли вопросы" alt="Возникли вопросы" border="0"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['is_problem'];?>
</a>

                        <img src="/i/discussion_mini.png" title="Кол-во комментариев" alt="Кол-во комментариев"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['discuss_count'];?>

                        <img src="/i/in_doc.png" title="Кол-во документов" alt="Кол-во документов"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['doc_count'];?>

                        <?php }else{ ?>&nbsp;
                    <?php }?>
                </div>

            </div>
        </li>
        <ul id="subtask_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" class="task_subtask"></ul>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }} ?>
<?php }?>