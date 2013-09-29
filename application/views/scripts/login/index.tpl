<!DOCTYPE html>
<html class="login-page">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/main.css" />

    <script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="/js/bootstrap.min.js"></script>

    <title>{$title}</title>
</head>
<body class="login-page">
<div id="login">
    <form method="post" id="login-form" action="/login/">

        <div style="padding-left: 0;">
            <h1 style="text-align: center; padding-top: 0; margin: 0;" class="left">&nbsp;&nbsp;<a href="#">{$title}</a></h1>
        </div>
        <div class="clear"></div>
        <div class="padding20"></div>

        {if isset($login_fail)}
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Внимание!</strong> {$result.loginFailed}
            </div>
        {/if}

        Логин
        <div class="padding10"></div>
        <input name="login" type="text" />

        <div class="padding10"></div>

        Пароль
        <div class="padding10"></div>
        <input type="password" name="psw" />

        <div class="padding20"></div>
        <input type="submit" class="btn btn-large btn-primary" value="Войти" />
    </form>
</div>
</body>
</html>