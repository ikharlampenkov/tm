<?php /* Smarty version Smarty-3.0.9, created on 2011-12-13 23:01:15
         compiled from "F:\www\tm\application/views/scripts\reports/generate-report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:227634ee776cb690063-09804970%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f714e114ca7880cfd77078a29c32d0bfeac23cb7' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\reports/generate-report.tpl',
      1 => 1323792071,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '227634ee776cb690063-09804970',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_modifier_capitalize')) include 'F:\www\tm\library\Smarty\plugins\modifier.capitalize.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1>Отчет</h1></div><br/>

<div class="sub-menu">
    <img src="/i/printer.png"/>&nbsp;<a href="javascript:window.open('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'print'));?>
','','…');" onclick="">печать</a>
</div>

<ul>
    <li class="task_list">
        <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="ttovar">
            <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                Задача
            </div>

            <div style="width: 120px; float: right;">
                Кто поставил
            </div>
            <div style="width: 120px; float: right;">
                Кто принял
            </div>
            <div style="width: 120px; float: right;">
                Ответственный
            </div>
            <div style="width: 120px; float: right;">
                Исполнитель
            </div>
            <div style="width: 120px; float: right;">
                Осталось
            </div>
            <div style="width: 120px; float: right;">
                Затрачено
            </div>
            <div style="width: 120px; float: right;">
                Выполнить до
            </div>
            <div style="width: 120px; float: right;">
                Дата добавления
            </div>
            <div style="width: 200px; float: right;">
                &nbsp;
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
            <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 45px; margin: 0px; 5px;" class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>">

                <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                    <img src="/i/<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>task_group.png<?php }else{ ?>task.png<?php }?>"/>&nbsp;
                    <a href="javascript:void(0)" onclick="
                        <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>
                                reports.openTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);
                            <?php }else{ ?>
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <?php ob_start();?><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('controller')->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                        task.editDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>0<?php }else{ ?><?php echo $_smarty_tpl->getVariable('task')->value->getFirstParent()->id;?>
<?php }?>, '<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>0));?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->getFirstParent()->id));?>
<?php }?>');
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                    task.viewTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <?php }?>
                            "><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</a>
                </div>


                <div style="width: 120px; float:right;">
                    <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('who_set')&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_set')->value!='-'){?>
                        <?php $_smarty_tpl->tpl_vars["who_set"] = new Smarty_variable(TM_User_User::getInstanceById($_smarty_tpl->getVariable('task')->value->getAttribute('who_set')->value), null, null);?>
                        <?php if ($_smarty_tpl->getVariable('who_set')->value->searchAttribute('name')){?>
                            <?php echo $_smarty_tpl->getVariable('who_set')->value->getAttribute('name')->value;?>

                            <?php }else{ ?>
                            <?php echo $_smarty_tpl->getVariable('who_set')->value->login;?>

                        <?php }?>
                        <?php }else{ ?>&nbsp;
                    <?php }?>
                </div>

                <div style="width: 120px; float: right;">
                    <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('who_adopted')&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_adopted')->value!='-'){?>
                        <?php $_smarty_tpl->tpl_vars["who_adopted"] = new Smarty_variable(TM_User_User::getInstanceByLogin($_smarty_tpl->getVariable('task')->value->getAttribute('who_adopted')->value), null, null);?>
                        <?php if ($_smarty_tpl->getVariable('who_adopted')->value->searchAttribute('name')){?>
                            <?php echo $_smarty_tpl->getVariable('who_adopted')->value->getAttribute('name')->value;?>

                            <?php }else{ ?>
                            <?php echo $_smarty_tpl->getVariable('who_adopted')->value->login;?>

                        <?php }?>
                        <?php }else{ ?>&nbsp;
                    <?php }?>
                </div>


                <div style="width: 120px; float: right;">
                    <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('who_responsible')&&$_smarty_tpl->getVariable('task')->value->getAttribute('who_responsible')->value!='-'){?>
                        <?php $_smarty_tpl->tpl_vars["who_responsible"] = new Smarty_variable(TM_User_User::getInstanceById($_smarty_tpl->getVariable('task')->value->getAttribute('who_responsible')->value), null, null);?>
                        <?php if ($_smarty_tpl->getVariable('who_responsible')->value->searchAttribute('name')){?>
                            <?php echo $_smarty_tpl->getVariable('who_responsible')->value->getAttribute('name')->value;?>

                            <?php }else{ ?>
                            <?php echo $_smarty_tpl->getVariable('who_responsible')->value->login;?>

                        <?php }?>
                        <?php }else{ ?>&nbsp;
                    <?php }?>
                </div>

                <div style="width: 120px; float: right;">
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
                        <?php }else{ ?>&nbsp;
                    <?php }?>
                </div>

                <div style="width: 120px; float: right;">
                    <?php if ($_smarty_tpl->getVariable('task')->value->getLeftTime()!=0){?>
                        <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getLeftTime(),"%d");?>

                        <?php }else{ ?>0
                    <?php }?> дней
                </div>

                <div style="width: 120px; float: right;">
                    <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getExecuteTime(),"%d");?>
 дней
                </div>

                <div style="width: 120px; float:right;">
                    <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('deadline')){?>
                        <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getAttribute('deadline')->value,"%d %B %Y");?>

                        <?php }else{ ?>&nbsp;
                    <?php }?>
                </div>

                <div style="width: 120px; float: right;">
                    <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->datecreate,"%d %B %Y");?>

                </div>

                <div style="width: 200px; float: right;">
                    <?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>
                        <?php $_smarty_tpl->tpl_vars["stat"] = new Smarty_variable($_smarty_tpl->getVariable('task')->value->getTaskStatistic(), null, null);?>
                        <img src="/i/is_complite.png" title="Выполненных" alt="Выполненных"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['is_complite'];?>

                        <img src="/i/task.png" title="Не выполненных" alt="Не выполненных">&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['is_do'];?>

                        <img src="/i/is_out.png" title="Просроченных" alt="Просроченных"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['is_out'];?>

                        <img src="/i/is_problem.png" title="Проблемные" alt="Проблемные"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['is_problem'];?>

                        <img src="/i/discussion_mini.png" title="Кол-во комментариев" alt="Кол-во комментариев"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['discuss_count'];?>

                        <img src="/i/in_doc.png" title="Кол-во документов" alt="Кол-во документов"/>&nbsp;<?php echo $_smarty_tpl->getVariable('stat')->value['doc_count'];?>

                        <?php }else{ ?>&nbsp;
                    <?php }?>
                </div>

            </div>
        </li>
        <ul id="subtask_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" style="display: none; margin-left: 20px;"></ul>
    <?php }} ?>
<?php }?>
</ul>