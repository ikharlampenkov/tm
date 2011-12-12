<?php /* Smarty version Smarty-3.0.9, created on 2011-12-12 20:36:57
         compiled from "F:\www\tm\application/views/scripts\reports/generate-report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:272214ee60379683c73-07133167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f714e114ca7880cfd77078a29c32d0bfeac23cb7' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\reports/generate-report.tpl',
      1 => 1323697014,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '272214ee60379683c73-07133167',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1>Отчет</h1></div><br/>

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
            <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>">

                <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                    <img src="/i/<?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()||$_smarty_tpl->getVariable('task')->value->getChild()){?>task_group.png<?php }else{ ?>task.png<?php }?>"/>&nbsp;
                    <a href="javascript:void(0)" onclick="reports.openTask('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showTaskBlock','parent'=>$_smarty_tpl->getVariable('task')->value->id));?>
', <?php echo $_smarty_tpl->getVariable('task')->value->id;?>
);"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
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
<?php }?>
                            </div>
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
                    <?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->datecreate,"%d.%m.%Y");?>

                </div>

            </div>
        </li>
        <ul id="subtask_<?php echo $_smarty_tpl->getVariable('task')->value->id;?>
" style="display: none; margin-left: 20px;"></ul>
    <?php }} ?>
<?php }?>
</ul>