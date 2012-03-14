<?php /* Smarty version Smarty-3.0.9, created on 2012-03-14 00:19:56
         compiled from "F:\www\tm\application/views/scripts\organization/add.ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98274f5f81bcd3e1a6-90478390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24611f7499b6c67bb151a82978d73f9bc47862d1' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\organization/add.ajax.tpl',
      1 => 1331658140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98274f5f81bcd3e1a6-90478390',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('exception_msg',null,true,false)->value)){?>
<div id="exception" class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
        <p id="exception_message"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            Ошибка: <?php echo $_smarty_tpl->getVariable('exception_msg')->value;?>
</p>
    </div>
</div>
<br/>
<?php }?>

<form action="<?php echo $_smarty_tpl->getVariable('this')->value->url(array('controller'=>$_smarty_tpl->getVariable('controller')->value,'action'=>'add'));?>
" method="post" id="addForm">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input name="data[title]" value="<?php echo $_smarty_tpl->getVariable('organization')->value->title;?>
" class="input_ajax"/></td>
        </tr>
    <?php if ($_smarty_tpl->getVariable('attributeHashList')->value!==false){?>
        <?php  $_smarty_tpl->tpl_vars['attributeHash'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attributeHashList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attributeHash']->key => $_smarty_tpl->tpl_vars['attributeHash']->value){
?>
            <tr>
                <td class="<?php if ($_smarty_tpl->getVariable('attributeHash')->value->isRequired){?>ttovar_title_requared<?php }else{ ?>ttovar_title<?php }?>"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->title;?>
<?php if ($_smarty_tpl->getVariable('attributeHash')->value->isRequired){?>*<?php }?></td>
                <td class="ttovar"><?php echo $_smarty_tpl->getVariable('attributeHash')->value->type->getHTMLFrom($_smarty_tpl->tpl_vars['attributeHash']->value,$_smarty_tpl->getVariable('organization')->value);?>
</td>
            </tr>
        <?php }} ?>
    <?php }?>
    </table>
</form>