<?php /* Smarty version Smarty-3.0.9, created on 2011-11-17 14:18:55
         compiled from "/home/c/cl71252/tm.cl71252.tmweb.ru/application/views/scripts/user/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5921706174ec4df66a6f9e1-34731212%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72c46283e7270d1aa68f658773680e79764e70e5' => 
    array (
      0 => '/home/c/cl71252/tm.cl71252.tmweb.ru/application/views/scripts/user/index.tpl',
      1 => 1321510724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5921706174ec4df66a6f9e1-34731212',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Пользователи</h1></div><br/>

<?php if ($_smarty_tpl->getVariable('userList')->value!==false){?>
        <table width="100%">
        <tr>
                    <td class="ttovar" align="center" colspan="3"><a href="?page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
&action=add">добавить</a></td></tr>
            <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
                <tr>
                    <td class="ttovar" ><?php echo $_smarty_tpl->tpl_vars['user']->value['login'];?>
</td>
                    <td class="ttovar" ><?php echo $_smarty_tpl->tpl_vars['user']->value['role'];?>
</td>
                    <td class="tedit" ><a href="?page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
&action=edit&login=<?php echo $_smarty_tpl->tpl_vars['user']->value['login'];?>
">редактировать</a><br />
                                       <a href="?page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
&action=del&login=<?php echo $_smarty_tpl->tpl_vars['user']->value['login'];?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->tpl_vars['user']->value['login'];?>
');" style="color: #830000">удалить</a> </td>
                </tr>
            <?php }} ?>
        </table>
    <?php }?>