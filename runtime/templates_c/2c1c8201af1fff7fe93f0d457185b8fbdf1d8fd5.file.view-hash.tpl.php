<?php /* Smarty version Smarty-3.0.9, created on 2012-01-30 00:35:15
         compiled from "F:\www\tm\application/views/scripts\task/view-hash.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129514f2583534b6f68-47788588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c1c8201af1fff7fe93f0d457185b8fbdf1d8fd5' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\task/view-hash.tpl',
      1 => 1323796460,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129514f2583534b6f68-47788588',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-hash")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-attribute-hash"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<div class="page"><h1>Список атрибутов для задач</h1></div><br/>

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
