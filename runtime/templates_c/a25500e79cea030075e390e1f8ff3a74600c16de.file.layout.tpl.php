<?php /* Smarty version Smarty-3.0.9, created on 2011-11-27 21:50:17
         compiled from "F:\www\tm\application/layouts/scripts\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71504ed24e298072d5-25143766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a25500e79cea030075e390e1f8ff3a74600c16de' => 
    array (
      0 => 'F:\\www\\tm\\application/layouts/scripts\\layout.tpl',
      1 => 1322405414,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71504ed24e298072d5-25143766',
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

    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
    <script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="/js/main.js"></script>

    <title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>

</head>

<body>

<table style="width: 100%; height: 100%;" cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
        <td style="height: 60px; vertical-align: top;">

            <table style="width: 100%; height: 60px; background-color:#69aefc;">
                <tr>
                    <td style="padding-left: 25px; vertical-align: middle;"><a href="/" style="color: #ffffff; text-decoration: none; font-size: 26px;"><?php echo $_smarty_tpl->getVariable('title')->value;?>
</a></td>
                    <td width="300" valign="middle" style="color:white">
                        Пользователь: <?php echo $_smarty_tpl->getVariable('authUser')->value;?>
 &nbsp; / &nbsp; <a href="/login/logout/" style="color:black">Выйти</a>
                    </td>
                </tr>
            </table>


        </td>
    </tr>
    <tr>
        <td>

            <table border="0" cellpadding="20" width="100%">
                <tr>
                    <td width="230">

                        <table border="0" cellpadding="10" cellspacing="10" width="100%" height="100%"
                               style="background-color:#f0f0f0">
                            <tr>
                                <td><h1>Меню:</h1></td>
                            </tr>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"task/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"task/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <tr>
                                <td><a href="/task/" class="menu">Задачи</a></td>
                            </tr>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"task/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"document/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"document/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <tr>
                                <td><a href="/document/" class="menu">Документы</a></td>
                            </tr>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"document/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"reports/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"reports/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <tr>
                                <td><a href="/reports/" class="menu">Отчеты</a></td>
                            </tr>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"reports/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"discussion/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"discussion/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <tr>
                                <td><a href="/discussion/" class="menu">Обсуждение</a></td>
                            </tr>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"discussion/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('if_allowed', array('resource'=>"user/index")); $_block_repeat=true; smarty_block_if_allowed(array('resource'=>"user/index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <tr>
                                <td><a href="/user/" class="menu">Пользователи</a></td>
                            </tr>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_if_allowed(array('resource'=>"user/index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        </table>

                    </td>
                    <td>
                    <?php echo $_smarty_tpl->getVariable('this')->value->layout()->content;?>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>


</body>
</html>
