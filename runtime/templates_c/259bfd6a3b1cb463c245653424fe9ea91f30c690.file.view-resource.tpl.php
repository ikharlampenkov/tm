<?php /* Smarty version Smarty-3.0.9, created on 2012-01-30 22:52:00
         compiled from "F:\www\tm\application/views/scripts\user/view-resource.tpl" */ ?>
<?php /*%%SmartyHeaderCode:245554f26bca0b4a860-97780222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '259bfd6a3b1cb463c245653424fe9ea91f30c690' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\user/view-resource.tpl',
      1 => 1323797670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245554f26bca0b4a860-97780222',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-resource")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-resource"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Ресурсы</h1></div><br/>


<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3">
            <img src="/i/add.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'addResource'));?>
">добавить</a></td>
    </tr>

<?php if ($_smarty_tpl->getVariable('userResourceList')->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userResourceList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value){
?>
        <tr>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('resource')->value->rtitle;?>
</td>
            <td class="ttovar"><?php echo $_smarty_tpl->getVariable('resource')->value->title;?>
</td>
            <td class="tedit">
                <img src="/i/edit.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'editResource','id'=>$_smarty_tpl->getVariable('resource')->value->id));?>
">редактировать</a><br/>
                <img src="/i/delete.png"/>&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'deleteResource','id'=>$_smarty_tpl->getVariable('resource')->value->id));?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->getVariable('resource')->value->rtitle;?>
');" style="color: #830000">удалить</a></td>
        </tr>
    <?php }} ?>
<?php }?>

</table>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>($_smarty_tpl->getVariable('controller')->value)."/index",'priv'=>"show-resource"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
