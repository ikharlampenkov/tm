<?php /* Smarty version Smarty-3.0.9, created on 2011-12-09 19:06:30
         compiled from "F:\www\tm\application/views/scripts\error/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:327284ed0999f23df86-26155230%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eab985864bf219a2a8625f0f974cae75ef5615e5' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\error/error.tpl',
      1 => 1321366230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '327284ed0999f23df86-26155230',
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