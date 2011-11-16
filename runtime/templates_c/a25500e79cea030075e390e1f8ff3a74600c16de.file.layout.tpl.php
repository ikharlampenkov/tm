<?php /* Smarty version Smarty-3.0.9, created on 2011-11-15 22:52:22
         compiled from "F:\www\tm\application/layouts/scripts\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103034ec28ab6948924-10917247%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a25500e79cea030075e390e1f8ff3a74600c16de' => 
    array (
      0 => 'F:\\www\\tm\\application/layouts/scripts\\layout.tpl',
      1 => 1321372329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103034ec28ab6948924-10917247',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="DESCRIPTION" content="<?php echo $_smarty_tpl->getVariable('description')->value;?>
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
                        Пользователь:  &nbsp; / &nbsp; <a href="/login/logout/" style="color:black">Выйти</a>
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

                            <tr>
                                <td><a href="/task/" class="menu">Задачи</a></td>
                            </tr>
                            <tr>
                                <td><a href="/document/" class="menu">Документы</a></td>
                            </tr>
                            <tr>
                                <td><a href="/reports/" class="menu">Отчеты</a></td>
                            </tr>
                            <tr>
                                <td><a href="/discussion/" class="menu">Обсуждение</a></td>
                            </tr>
                            <tr>
                                <td><a href="/user/" class="menu">Пользователи</a></td>
                            </tr>

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
