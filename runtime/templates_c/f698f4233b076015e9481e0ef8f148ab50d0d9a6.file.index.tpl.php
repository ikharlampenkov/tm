<?php /* Smarty version Smarty-3.0.9, created on 2011-11-26 16:28:14
         compiled from "F:\www\tm\application/views/scripts\login/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121444ed0b12e619f12-61489000%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f698f4233b076015e9481e0ef8f148ab50d0d9a6' => 
    array (
      0 => 'F:\\www\\tm\\application/views/scripts\\login/index.tpl',
      1 => 1321550098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121444ed0b12e619f12-61489000',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="DESCRIPTION" content="<?php echo $_smarty_tpl->getVariable('description')->value;?>
" />
        <meta name="keywords" content="<?php echo $_smarty_tpl->getVariable('keywords')->value;?>
" />
        <meta name="author-corporate" content="" />
        <meta name="publisher-email" content="" />

        <style>
            body { margin: 0px; padding: 0px; font-family: tahoma; }
        </style>

        <title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>

    </head>

    <body>

            <table style="width: 100%; height: 100%;" cellpadding="10" cellspacing="10" border="0">
                <tr>
                    <td valign="middle" align="center">
                        <form method="post" action="/login/" style="margin:0px; padding:0px;">

                            <table cellpadding="10" cellspacing="0" border="0" style="background-color: #69aefc; width: 300px; height: 100px;">

                                <tr>
                                    <td></td>
                                    <td style="font-size:26px; color: white;padding-left: 25px;"></td>
                                </tr>
                                <tr>
                                    <td style="color:white">Логин: </td>
                                    <td><input name="login" type="text" style="width:190px;border:10px;font-size: 16px;" /></td>
                                </tr>
                                <tr>
                                    <td style="color:white">Пароль:</td>
                                    <td><input name="psw" type="password" style="width:190px;border:10px;font-size: 16px;" /></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" value="Войти" style="width:190px;font-size: 16px;"/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php if (isset($_smarty_tpl->getVariable('login_fail',null,true,false)->value)){?><div style="color:white; font-weight:bold; font-size:12px;"><?php echo $_smarty_tpl->getVariable('result')->value['loginFailed'];?>
</div><?php }?></td>
                                </tr>


                            </table>
                        </form>

                    </td>
                </tr>
            </table>

    </body>
</html>