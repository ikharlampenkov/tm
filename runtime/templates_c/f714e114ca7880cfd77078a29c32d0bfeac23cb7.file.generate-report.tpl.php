<?php /* Smarty version Smarty-3.0.9, created on 2011-12-01 22:41:23
         compiled from "F:\www\tm\application/views/scripts\reports/generate-report.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162424ed7a02376eca2-09225398%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f714e114ca7880cfd77078a29c32d0bfeac23cb7' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\reports/generate-report.tpl',
      1 => 1322754080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162424ed7a02376eca2-09225398',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
?><div class="page"><h1>Отчет</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar">Задача</td>
        <td class="ttovar" style="width: 130px;">Дата добавления</td>
        <td class="ttovar" style="width: 130px;">Срок</td>
        <td class="ttovar">Исполнитель</td>
        <td class="ttovar">Статус</td>
    </tr>

<?php if ($_smarty_tpl->getVariable('taskList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('taskList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</td>
            <td class="ttovar"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->datecreate,"%d.%m.%Y");?>
</td>
            <td class="ttovar"><?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('deadline')){?><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->getAttribute('deadline')->value,"%d.%m.%Y");?>
<?php }?></td>
            <td class="ttovar">
                <?php if (count($_smarty_tpl->getVariable('task')->value->getExecutant())>0){?>
                    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('task')->value->getExecutant(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
                        <div><?php echo $_smarty_tpl->getVariable('user')->value->login;?>
</div>
                    <?php }} ?>
                <?php }?>
            </td>
            <td class="ttovar"><?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute('state')){?><?php echo $_smarty_tpl->getVariable('task')->value->getAttribute('state')->value;?>
<?php }?></td>
        </tr>
        <?php $_template = new Smarty_Internal_Template("reports/taskblock.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('subtask',$_smarty_tpl->getVariable('task')->value->getChild());$_template->assign('wid',"20"); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php }} ?>
<?php }?>

</table>