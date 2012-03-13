<?php /* Smarty version Smarty-3.0.9, created on 2012-03-13 21:22:42
         compiled from "F:\www\tm\application/layouts/scripts\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:277664f27fbee1de472-19513435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a25500e79cea030075e390e1f8ff3a74600c16de' => 
    array (
      0 => 'F:\\www\\tm\\application/layouts/scripts\\layout.tpl',
      1 => 1331645462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '277664f27fbee1de472-19513435',
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
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui-timepicker-addon.css"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/css/menu.css"/>

    <script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery-ui.js"></script>
    <script type="text/javascript" language="javascript" src="/js/i18n/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery-ui.timepicker.js"></script>
    <script type="text/javascript" language="javascript" src="/js/i18n/jquery.ui.timepicker-ru.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery.form.js"></script>
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
<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"index/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"index/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <img src="/i/house.png" alt="Начальная" style="float: left;"/>&nbsp;<a href="/">Начальная</a></td>
        <span>&nbsp;</span>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"index/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <img src="/i/task_big.png" alt="Проекты" style="float: left;"/>&nbsp;<a href="/task/">Проекты</a></td>
        <span>&nbsp;</span>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"document/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"document/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <img src="/i/doc_big.png" alt="Документы" style="float: left;"/>&nbsp;<a href="/document/">Документы</a>
        <span>&nbsp;</span>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"reports/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"reports/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <img src="/i/report_big.png" alt="Аналитика" style="float: left;"/>&nbsp;<a href="/reports/">Аналитика</a>
        <span>&nbsp;</span>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"reports/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"discussion/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"discussion/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <img src="/i/discussion_big.png" alt="Обсуждение" style="float: left;"/>&nbsp;<a href="/discussion/">Обсуждение</a>
        <span>&nbsp;</span>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"discussion/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"user/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"user/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <li>
        <img src="/i/user_big.png" alt="Пользователи" style="float: left;"/>&nbsp;<a href="/user/">Пользователи</a>
        <span>&nbsp;</span>
    </li>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"user/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</ul>

<div class="content">

    <table border="0" cellpadding="10" width="100%">
        <tr>
            <td>
            <?php echo $_smarty_tpl->getVariable('this')->value->layout()->content;?>

            </td>
        </tr>
    </table>

</div>


</body>
</html>
