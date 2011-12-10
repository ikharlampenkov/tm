<?php /* Smarty version Smarty-3.0.9, created on 2011-12-10 13:38:08
         compiled from "F:\www\tm\application/layouts/scripts\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195524ee2fe50ebb9a0-92716411%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a25500e79cea030075e390e1f8ff3a74600c16de' => 
    array (
      0 => 'F:\\www\\tm\\application/layouts/scripts\\layout.tpl',
      1 => 1323499086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195524ee2fe50ebb9a0-92716411',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_if_allowed')) include 'F:\www\tm\library\Smarty\plugins\block.if_allowed.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content="<?php echo $_smarty_tpl->getVariable('description')->value;?>
"/>
    <meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('keywords')->value;?>
"/>
    <meta name="author-corporate" content=""/>
    <meta name="publisher-email" content=""/>

    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/css/menu.css"/>

    <script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery-ui.js"></script>
    <script type="text/javascript" language="javascript" src="/js/menu.js"></script>
    <script type="text/javascript" language="javascript" src="/js/main.js"></script>
    <script type="text/javascript" language="javascript" src="/js/func.js"></script>

    <title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>

</head>

<body>

<div class="head">
    <div class="login">
        <div class="unlogged">
            Пользователь: <?php echo $_smarty_tpl->getVariable('authUser')->value;?>
<br/>
            <a href="/login/logout/" style="color: #ffffff;">Выйти</a>
        </div>
    </div>

    <div class="head_left">
        <div class="logo"><a href="/" style="color: #ffffff; text-decoration: none; font-size: 26px;"><?php echo $_smarty_tpl->getVariable('title')->value;?>
</a></div>
    </div>
</div>


<a name="top"></a>

<ul class="menu_up">
<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <a href="/task/" >Проекты</a></td>
        <span>&nbsp;</span>
        <ul class="list" id="prgms">
            <li><a href="/program-for-ipad/">Программы для iPad и iPad 2</a></li>
        </ul>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"document/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"document/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <a href="/document/">Документы</a>
        <span>&nbsp;</span>
        <ul class="list" id="prgms">
            <li><a href="/program-for-iphone/">Программы для iPhone</a></li>
        </ul>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"reports/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"reports/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <a href="/reports/">Отчеты</a>
        <span>&nbsp;</span>
        <ul class="list" id="prgms">
            <li><a href="/program-for-ipod/">Программы для iPod и iPod touch</a></li>
        </ul>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"reports/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"discussion/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"discussion/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <a href="/discussion/">Обсуждение</a>
        <span>&nbsp;</span>
        <ul class="list" id="prgms">
            <li><a href="/information/">Познавательная информация</a></li>
        </ul>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"discussion/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"user/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"user/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
           <a href="/user/">Пользователи</a>
           <span>&nbsp;</span>
           <ul class="list" id="prgms">
               <li><a href="/information/">Познавательная информация</a></li>
           </ul>
       </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"user/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</ul>

<div class="content">

    <table border="0" cellpadding="20" width="100%">
        <tr>
            <td>
            <?php echo $_smarty_tpl->getVariable('this')->value->layout()->content;?>

            </td>
        </tr>
    </table>

</div>


</body>
</html>
