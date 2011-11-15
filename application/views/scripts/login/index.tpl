
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="DESCRIPTION" content="{$description}" />
        <meta name="keywords" content="{$keywords}" />
        <meta name="author-corporate" content="" />
        <meta name="publisher-email" content="" />

        <style>
            body { margin: 0px; padding: 0px; font-family: tahoma; }
        </style>

        <title>{$title}</title>

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
                                    <td>{if isset($login_fail)}<div style="color:white; font-weight:bold; font-size:12px;">Невервный логин и пароль.</div>{/if}</td>
                                </tr>


                            </table>
                        </form>

                    </td>
                </tr>
            </table>

    </body>
</html>