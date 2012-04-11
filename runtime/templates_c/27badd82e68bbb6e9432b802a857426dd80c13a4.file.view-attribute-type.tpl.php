<?php /* Smarty version Smarty-3.0.9, created on 2012-03-14 00:17:26
         compiled from "F:\www\tm\application/views/scripts\organization/view-attribute-type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:67174f5f81267deaa6-00797315%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27badd82e68bbb6e9432b802a857426dd80c13a4' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\organization/view-attribute-type.tpl',
      1 => 1323796460,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67174f5f81267deaa6-00797315',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-type")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-type"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<div class="page"><h1>Типы атрибутов</h1></div><br/>

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
