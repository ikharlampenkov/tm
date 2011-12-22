<?php /* Smarty version Smarty-3.0.9, created on 2011-12-12 23:17:10
         compiled from "F:\www\tm\application/views/scripts\task/view.ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:319254ee62906802a25-78208125%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e85890420778f7b3acc25aec3607b18a444fbc3c' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/view.ajax.tpl',
      1 => 1323706192,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '319254ee62906802a25-78208125',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include 'F:\www\tm\library\Smarty\plugins\modifier.date_format.php';
if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
if (!is_callable('smarty_block_if_object_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_object_allowed.php';
?><div class="page"><h1>Задача</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar_title">Название</td>
        <td class="ttovar"><?php echo $_smarty_tpl->getVariable('task')->value->title;?>
</td>
    </tr>
    <tr>
        <td class="ttovar_title">Супер задача</td>
        <td class="ttovar">
        <?php if (count($_smarty_tpl->getVariable('task')->value->parent)>0){?>
            <?php  $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('task')->value->parent; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['parent']->key => $_smarty_tpl->tpl_vars['parent']->value){
?>
                <?php echo $_smarty_tpl->getVariable('parent')->value->title;?>

            <?php }} ?>
        <?php }?>
        </td>
    </tr>
    <tr>
        <td class="ttovar_title">Дата создания</td>
        <td class="ttovar"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('task')->value->dateCreate,"%d.%m.%Y %H:%M:%S");?>
</td>
    </tr>

<?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
    <?php if ($_smarty_tpl->getVariable('task')->value->searchAttribute($_smarty_tpl->getVariable('attributeHash')->value->attributeKey)){?>
        <tr>
            <td class="ttovar_title"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('task')->value->getAttribute($_smarty_tpl->getVariable('attributeHash')->value->attributeKey)->value;?>
</td>
        </tr>
    <?php }?>
    <?php }} ?>
<?php }?>

<?php if ($_smarty_tpl->getVariable('documentList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('documentList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
?>
        <tr>
            <td class="ttovar_title">Документ</td>
            <td class="ttovar">
                <a href="/files<?php echo $_smarty_tpl->getVariable('document')->value->file->getSubPath();?>
/<?php echo $_smarty_tpl->getVariable('document')->value->file->getName();?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('document')->value->title;?>
</a>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"document/edit")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"document/edit"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Document",'object'=>($_smarty_tpl->tpl_vars['document']->value),'priv'=>"write")); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Document",'object'=>($_smarty_tpl->tpl_vars['document']->value),'priv'=>"write"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'edit','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
">редактировать</a>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Document",'object'=>($_smarty_tpl->tpl_vars['document']->value),'priv'=>"write"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/edit"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"document/view")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"document/view"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_object_allowed', array('type'=>"Document",'object'=>($_smarty_tpl->tpl_vars['document']->value))); $_block_repeat=true; smarty_block_if_object_allowed(array('type'=>"Document",'object'=>($_smarty_tpl->tpl_vars['document']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>'document','action'=>'view','id'=>$_smarty_tpl->getVariable('document')->value->id));?>
">просмотреть</a>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_object_allowed(array('type'=>"Document",'object'=>($_smarty_tpl->tpl_vars['document']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/view"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"document/deleteLinkToDoc")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"document/deleteLinkToDoc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                / <a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteLinkToDoc','id'=>$_smarty_tpl->getVariable('task')->value->id,'doc_id'=>$_smarty_tpl->getVariable('document')->value->id));?>
">удалить</a>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/deleteLinkToDoc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </td>
        </tr>
    <?php }} ?>
<?php }?>

</table>