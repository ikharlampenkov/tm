<?php /* Smarty version Smarty-3.0.9, created on 2011-12-01 23:19:16
         compiled from "F:\www\tm\application/views/scripts\document/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320164ed7a904aa31e0-32876853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8cc04fe67c878561a82c1d3e92b13a42a9696e93' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\document/view.tpl',
      1 => 1322745362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320164ed7a904aa31e0-32876853',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
?><div class="page"><h1>Документ <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'index'));?>
">Все документы</a></h1></div><br/>

    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('document')->value->title;?>
</td>
        </tr>
        <tr>
            <td class="ttovar_title">Папка</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('document')->value->parent->title;?>
</td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('document')->value->dateCreate,"%d.%m.%Y %H:%M:%S");?>
</td>
        </tr>
        <tr>
            <td class="ttovar_title">Файл</td>
            <td class="ttovar"><?php if ($_smarty_tpl->getVariable('document')->value->file->getName()){?><a href="/files<?php echo $_smarty_tpl->getVariable('document')->value->file->getSubPath();?>
/<?php echo $_smarty_tpl->getVariable('document')->value->file->getName();?>
" target="_blank">загрузить</a><?php }?></td>
        </tr>

    <?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
        <?php if ($_smarty_tpl->getVariable('document')->value->searchAttribute($_smarty_tpl->getVariable('attributeHash')->value->attributeKey)){?>
            <tr>
                <td class="ttovar_title"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
</td>
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('document')->value->getAttribute($_smarty_tpl->getVariable('attributeHash')->value->attributeKey)->value;?>
</td>
            </tr>
        <?php }?>
        <?php }} ?>
    <?php }?>

    <?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
            <tr>
            <td class="ttovar_title">Задачи</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'edit','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
">редактировать</a>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value))); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'task','action'=>'view','id'=>$_smarty_tpl->getVariable('task')->value->id));?>
">просмотреть</a>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Task",'object'=>($_smarty_tpl->tpl_vars['task']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </td>
        </tr>
        <?php }} ?>
    <?php }?>
    </table>