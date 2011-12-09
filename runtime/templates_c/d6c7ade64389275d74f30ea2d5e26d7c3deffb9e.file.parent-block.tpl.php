<?php /* Smarty version Smarty-3.0.9, created on 2011-12-09 19:29:06
         compiled from "F:\www\tm\application/views/scripts\task/parent-block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:295794ee1ff12a1d646-26854069%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6c7ade64389275d74f30ea2d5e26d7c3deffb9e' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/parent-block.tpl',
      1 => 1323432815,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '295794ee1ff12a1d646-26854069',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('subtask')->value){?>

    <?php  $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('subtask')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['parent']->key => $_smarty_tpl->tpl_vars['parent']->value){
?>
    <option value="<?php echo $_smarty_tpl->getVariable('parent')->value->id;?>
" <?php if ($_smarty_tpl->getVariable('task')->value->searchParent($_smarty_tpl->tpl_vars['parent']->value)!==false){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('wid')->value;?>
 <?php echo $_smarty_tpl->getVariable('parent')->value->title;?>
</option>
        <?php if ($_smarty_tpl->getVariable('parent')->value->getChild()){?>
        <?php $_template = new Smarty_Internal_Template("task/parent-block.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('subtask',$_smarty_tpl->getVariable('parent')->value->getChild());$_template->assign('wid',($_smarty_tpl->getVariable('wid')->value).('--'));$_template->assign('task',$_smarty_tpl->getVariable('task')->value); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php }?>
    <?php }} ?>

<?php }?>

