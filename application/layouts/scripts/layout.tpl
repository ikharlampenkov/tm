<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="DESCRIPTION" content="{$description}" />
        <meta name="keywords" content="{$keywords}" />
        <meta name="author-corporate" content="" />
        <meta name="publisher-email" content="" />

        <link rel="stylesheet" type="text/css" href="/css/main.css" />
        <script type="text/javascript" language="javascript" src="/js/jquery.js" ></script>
        <script type="text/javascript" language="javascript" src="/js/main.js" ></script>

        <title>{$title}</title>

    </head>

    <body>

        <table border="0" cellpadding="20" width="100%">
            <tr>
                <td width="230">

                    <table border="0" cellpadding="10" cellspacing="10" width="100%" height="100%" style="background-color:#f0f0f0">
                        <tr><td><h1>Меню:</h1></td></tr>

                        <tr><td><a href="?page=content_page&title=about" class="menu">Задачи</a></td></tr>
                        <tr><td><a href="?page=personal" class="menu">Документы</a></td></tr>
                        <tr><td><a href="?page=license" class="menu">Отчеты</a></td></tr>
                        <tr><td><a href="?page=news" class="menu">Обсуждение</a></td></tr>
                        <tr><td><a href="?page=smi" class="menu">Отчеты</a></td></tr>

                    </table>

                </td>
                <td>
                    {$this->layout()->content}
                </td>
            </tr>
        </table>

    </body>
</html>
