<?php /* Smarty version Smarty-3.0.9, created on 2011-12-09 22:18:33
         compiled from "F:\www\tm\application/views/scripts\task/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320054ee226c91660c7-21851619%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'beb79dd40dcd398ad1e9c74e1cde3178471f73b3' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/index.tpl',
      1 => 1323443910,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320054ee226c91660c7-21851619',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_modifier_capitalize')) include 'F:\www\tm\library\Smarty\plugins\modifier.capitalize.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1><?php if (!isset($_smarty_tpl->getVariable('task',null,true,false)->value)){?>Проекты<?php }else{ ?><?php if (!$_smarty_tpl->getVariable('task')->value->hasParent()){?>Проект<?php }elseif($_smarty_tpl->getVariable('task')->value->getChild()){?>Группа задач<?php }else{ ?>Задача:<?php }?> <?php echo $_smarty_tpl->getVariable('task')->value->title;?>
<?php }?></h1></div><br/>

<?php if (isset($_smarty_tpl->getVariable('breadcrumbs',null,true,false)->value)){?>
<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','parent'=>0));?>
">/..</a>
    <?php if (!empty($_smarty_tpl->getVariable('breadcrumbs',null,true,false)->value)){?>
    &nbsp;/
        <?php  $_smarty_tpl->tpl_vars['crumb'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('breadcrumbs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['crumb']->key => $_smarty_tpl->tpl_vars['crumb']->value){
?>
        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','parent'=>$_smarty_tpl->getVariable('crumb')->value->id));?>
"><?php echo $_smarty_tpl->getVariable('crumb')->value->title;?>
</a>&nbsp;/
        <?php }} ?>
    <?php }?>
<br/><br/>
<?php }?>

<table width="100%">
<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <tr>
        <td class="ttovar" align="center" colspan="5"><a href="#" onclick="task.addDialog('<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
')">добавить</a></td>
    </tr>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/add"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <tr>
        <td class="ttovar">Название</td>
        <td class="ttovar" style="width: 130px;">Выполнить до</td>
        <td class="ttovar" colspan="3">Действия</td>
    </tr>

<?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
        <?php ob_start();?><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('controller')->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value))); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <tr>
                <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index','parent'=>$_smarty_tpl->getVariable('task')->value->id));?>
"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</a></td>
                <td class="<?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')&&$_smarty_tpl->getVariable('task')->value->getAttribute('state')->value=='Выполнена'){?>ttovar_green<?php }elseif($_smarty_tpl->getVariable('task')->value->getIsOver()){?>ttovar_red<?php }else{ ?>ttovar<?php }?>"><?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('deadline')){?><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getAttribute('deadline')->value,"%d %B %Y");?>
<?php }?></td>
                <td class="tedit">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showDiscussion")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showDiscussion"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showDiscussion','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
">обсуждение</a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showDiscussion"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </td>
                <td class="tedit">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'showAcl','idTask'=>$_smarty_tpl->getVariable('task')->value->id));?>
">права</a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/showAcl"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </td>
                <td class="tedit">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
">просмотреть</a><br/>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <?php ob_start();?><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('controller')->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>$_tmp2,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>$_tmp2,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
">редактировать</a><br/>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>$_tmp2,'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'delete','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('task')->value->title;?>
');" style="color: #830000">удалить</a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/delete"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </td>
            </tr>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>$_tmp1,'object'=>($_smarty_tpl->tpl_vars['task']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }} ?>
<?php }?>

</table>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-hash")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-hash"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<br/>
<div class="page"><h1>Список аттрибутов для задач</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="6"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addAttributeHash'));?>
">добавить</a></td>
    </tr>
    <tr>
        <td class="ttovar">Ключ</td>
        <td class="ttovar">Название</td>
        <td class="ttovar">Тип</td>
        <td class="ttovar">Обязательное</td>
        <td class="ttovar">Порядок сортировки</td>
        <td class="ttovar"></td>
    </tr>

    <?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
            <tr>
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->attributeKey;?>
</td>
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
</td>
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->type->title;?>
</td>
                <td class="ttovar"><?php if ($_smarty_tpl->getVariable('attributeHash')->value->isRequired){?>Да<?php }else{ ?>Нет<?php }?></td>
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->sortOrder;?>
</td>
                <td class="tedit">
                    <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editAttributeHash','key'=>$_smarty_tpl->getVariable('attributeHash')->value->attributeKey));?>
">редактировать</a><br/>
                    <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteAttributeHash','key'=>$_smarty_tpl->getVariable('attributeHash')->value->attributeKey));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
');" style="color: #830000">удалить</a>
                </td>
            </tr>
        <?php }} ?>
    <?php }?>

</table>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-hash"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-type")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<br/>
<div class="page"><h1>Типы аттрибутов</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addAttributeType'));?>
">добавить</a></td>
    </tr>

    <?php if ($_smarty_tpl->getVariable('attributeTypeList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['attributeType'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeTypeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeType']->key => $_smarty_tpl->tpl_vars['attributeType']->value){
?>
            <tr>
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeType')->value->title;?>
</td>
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeType')->value->handler;?>
</td>
                <td class="tedit">
                    <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editAttributeType','id'=>$_smarty_tpl->getVariable('attributeType')->value->id));?>
">редактировать</a><br/>
                    <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteAttributeType','id'=>$_smarty_tpl->getVariable('attributeType')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('attributeType')->value->title;?>
');" style="color: #830000">удалить</a>
                </td>
            </tr>
        <?php }} ?>
    <?php }?>

</table>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-type"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
