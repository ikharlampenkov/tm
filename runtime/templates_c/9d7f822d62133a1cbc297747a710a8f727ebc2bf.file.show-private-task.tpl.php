<?php /* Smarty version Smarty-3.0.9, created on 2012-01-31 22:22:46
         compiled from "F:\www\tm\application/views/scripts\user/show-private-task.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174584f2807469ae935-09321913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d7f822d62133a1cbc297747a710a8f727ebc2bf' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/show-private-task.tpl',
      1 => 1328021322,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174584f2807469ae935-09321913',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div style="background-color:#f0f0f0; padding:5px;">
    <h1>Задачи пользователя
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

<ul>
    <li class="task_list">
        <div class="task_block_title">
            <div class="task_title">
                Название
            </div>
            <div class="task_deadline">
                Выполнить до
            </div>
            <div class="task_deadline">
                Приоритет
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
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <li id="task_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" class="task_list">
                <div class="task_block">

                    <div class="task_title">
                        <img src="/i/<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>task_group.png<?php }else{ ?>task.png<?php }?>"/>&nbsp;
                        <a href="javascript:void(0)" onclick="
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                        task.editDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', 0, '<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showPrivateTask','parent'=>0,'userId'=>$_smarty_tpl->getVariable('user')->value->id));?>
');
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                    task.viewTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                                " class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>task_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>task_red<?php }else{ ?>task_gray<?php }?>"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</a>
                    </div>

                    <div class="task_deadline">
                        <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('deadline')){?>
                            <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getAttribute('deadline')->value,"%d %B %Y");?>

                            <?php }else{ ?>&nbsp;
                        <?php }?>
                    </div>

                    <div class="task_deadline">
                        <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('prior')){?>
                            <?php echo $_smarty_tpl->getVariable('task')->value->getAttribute('prior')->value;?>

                            <?php }else{ ?>&nbsp;
                        <?php }?>
                    </div>

                </div>
            </li>
            <ul id="subtask_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" class="task_subtask"></ul>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"executant"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }} ?>
<?php }?>
</ul>