<?php /* Smarty version Smarty-3.0.9, created on 2011-11-16 10:55:43
         compiled from "/home/c/cl71252/tm.cl71252.tmweb.ru/application/views/scripts/error/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9089376284ec35e6f23cc74-21698983%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '149ff79b9b1b6edb4d853f897deb9d4cedc3b173' => 
    array (
      0 => '/home/c/cl71252/tm.cl71252.tmweb.ru/application/views/scripts/error/error.tpl',
      1 => 1321411397,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9089376284ec35e6f23cc74-21698983',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>An error occurred</h1>

<h2><?php echo $_smarty_tpl->getVariable('message')->value;?>
</h2>

<?php if ((isset($_smarty_tpl->getVariable('this',null,true,false)->value->exception))){?>

<h3>Exception information:</h3>

<p>
    <b>Message:</b> <?php echo $_smarty_tpl->getVariable('exception')->value->getMessage();?>

</p>

<h3>Stack trace:</h3>
  <pre><?php echo $_smarty_tpl->getVariable('exception')->value->getTraceAsString();?>

  </pre>

<h3>Request Parameters:</h3>
  <pre><?php echo $_smarty_tpl->getVariable('this')->value->escape(var_export($_smarty_tpl->getVariable('request')->value->getParams(),true));?>

  </pre>

<?php }?>