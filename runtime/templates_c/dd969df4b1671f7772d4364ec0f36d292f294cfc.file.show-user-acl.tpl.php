<?php /* Smarty version Smarty-3.0.9, created on 2012-02-04 23:37:43
         compiled from "F:\www\tm\application/views/scripts\user/show-user-acl.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32754f2d5ed7a8fed0-24902301%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd969df4b1671f7772d4364ec0f36d292f294cfc' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/show-user-acl.tpl',
      1 => 1328373461,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32754f2d5ed7a8fed0-24902301',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
?><div style="background-color:#f0f0f0; padding:5px;">
    <h1>Права для пользователя
    <?php if ($_smarty_tpl->getVariable('user')->value->searchAttribute('name')){?>
        <?php echo $_smarty_tpl->getVariable('user')->value->getAttribute('name')->value;?>

        <?php }else{ ?>
        <?php echo $_smarty_tpl->getVariable('user')->value->login;?>

    <?php }?>
        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index'));?>
">Все пользователи</a></h1>
</div><br/>

<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div>Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</div><br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAcl','id'=>$_smarty_tpl->getVariable('user')->value->id));?>
" method="POST">

<ul>
    <li class="task_list">
        <div class="task_block_title">
            <div class="task_title">
                Название
            </div>
            <div class="task_action">
                Действия
            </div>
            <div class="task_deadline">
                Создатель
            </div>

            <div class="task_deadline">
                Ответсвенный
            </div>
            <div class="task_deadline">
                Исполнитель
            </div>
            <div class="task_deadline">
                Запись
            </div>
            <div class="task_deadline">
                Чтение
            </div>
        </div>
    </li>
</ul>

<ul id="subtask_0">
<?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
        <li id="task_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" class="task_list">
            <div class="task_block">

                <div class="task_title">
                    <img src="/i/<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>task_group.png<?php }else{ ?>task.png<?php }?>"/>&nbsp;
                    <a href="javascript:void(0)" onclick="
                        <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>
                                task.openTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);
                            <?php }else{ ?>
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                        task.editDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>0<?php }else{ ?><?php echo $_smarty_tpl->getVariable('task')->value->getFirstParent()->id;?>
<?php }?>, '<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>0,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>$_smarty_tpl->getVariable('task')->value->getFirstParent()->id,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
<?php }?>');
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <?php }?>
                            " class="<?php if ($_smarty_tpl->getVariable('task')->value->isRead($_smarty_tpl->getVariable('user')->value)||$_smarty_tpl->getVariable('task')->value->isWrite($_smarty_tpl->getVariable('user')->value)||$_smarty_tpl->getVariable('task')->value->isExecutant($_smarty_tpl->getVariable('user')->value)||$_smarty_tpl->getVariable('task')->value->user->id==$_smarty_tpl->getVariable('user')->value->id){?>task_has_access<?php }else{ ?>task_no_access<?php }?>"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</a>
                </div>


                <div class="task_action">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/showDiscussion")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/showDiscussion"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'showDiscussion','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
"><img src="/i/discussion_mini.png" alt="обсуждение" title="обсуждение" border="0"/></a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/showDiscussion"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        &nbsp;<a href="javascript:void(0)" onclick="task.viewTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);"><img src="/i/task.png" alt="просмотреть" title="просмотреть" border="0"/></a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/add")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/add"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        &nbsp;<a href="javascript:void(0)" onclick="task.addDialog('<?php ob_start();?><?php echo $_smarty_tpl->getVariable('task')->value->id;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'add','parent'=>$_tmp1));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
, '<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
');"><img src="/i/add.png" alt="добавить задачу" title="добавить задачу" border="0"/></a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/add"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            &nbsp;<a href="javascript:void(0)" onclick="task.editDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>0<?php }else{ ?><?php echo $_smarty_tpl->getVariable('task')->value->getFirstParent()->id;?>
<?php }?>, '<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>0,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>$_smarty_tpl->getVariable('task')->value->getFirstParent()->id,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
<?php }?>');"><img src="/i/edit.png" alt="редактировать" title="редактировать" border="0"/></a>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/toArchive")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/toArchive"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <a href="javascript:void(0)" onclick="task.toArchive('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'toArchive','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
', 0, '<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>0,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
')"><img src="/i/zip.gif" alt="в архив" title="в архив" border="0"/></a>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/toArchive"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php }?>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/delete")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/delete"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        &nbsp;<a href="javascript:void(0)" onclick="task.deleteDialog('<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
', '<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'delete','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>0<?php }else{ ?><?php echo $_smarty_tpl->getVariable('task')->value->getFirstParent()->id;?>
<?php }?>, '<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>0,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showUserAclBlock','parent'=>$_smarty_tpl->getVariable('task')->value->getFirstParent()->id,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
<?php }?>');" style="color: #830000"><img src="/i/delete.png" alt="удалить" title="удалить" border="0"/></a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/delete"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </div>

                <div class="task_deadline">
                    <input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_owner]" <?php if ($_smarty_tpl->getVariable('task')->value->user->id==$_smarty_tpl->getVariable('user')->value->id){?>checked="checked"<?php }?> />
                </div>

                <div class="task_deadline">
                    <input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_responsible]"
                        <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('who_responsible')&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_responsible')->value!='-'&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_responsible')->value==$_smarty_tpl->getVariable('user')->value->id){?>
                           checked="checked"
                        <?php }?>
                            />
                </div>
                <div class="task_deadline">
                    <input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_executant]" <?php if ($_smarty_tpl->getVariable('task')->value->isExecutant($_smarty_tpl->getVariable('user')->value)){?>checked="checked" <?php }?> />
                </div>
                <div class="task_deadline">
                    <input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_write]" <?php if ($_smarty_tpl->getVariable('task')->value->isWrite($_smarty_tpl->getVariable('user')->value)){?>checked="checked" <?php }?> />
                </div>
                <div class="task_deadline">
                    <input type="checkbox" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][is_read]" <?php if ($_smarty_tpl->getVariable('task')->value->isRead($_smarty_tpl->getVariable('user')->value)){?>checked="checked" <?php }?> />
                    <input type="hidden" name="data[<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
][fake]" value="1" />
                </div>


            </div>
        </li>
        <ul id="subtask_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" class="task_subtask"></ul>
    <?php }} ?>
<?php }?>
</ul>

    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>

