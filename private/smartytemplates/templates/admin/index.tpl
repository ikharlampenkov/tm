<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="DESCRIPTION" content="{$description}" />
        <meta name="keywords" content="{$keywords}" />
        <meta name="author-corporate" content="" />
        <meta name="publisher-email" content="" />

        <link rel="stylesheet" type="text/css" href="/css/admin.css" />

        {*<script type="text/javascript" language="javascript" src="/js/jquery.min.js" ></script>
        <script type="text/javascript" language="javascript" src="/js/main.js" ></script>*}

        <title>{$title}</title>

    </head>

    <body>

        {include file="error_msg.tpl"}

                <table style="width: 100%; height: 100%;" cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                        <td valign="top" height="40">

                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: 40px; background-color:#69aefc;">
                                <tr>
                                    <td style="font-size:26px; color: white;padding-left: 25px;" valign="middle">административная панель управения</td>
                                    <td width="300" valign="middle" style="color:white">

                                        Пользователь: {$user} &nbsp; / &nbsp; <a href="{$siteurl}?logout" style="color:black">Выйти</a>

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

                                        <table border="0" cellpadding="10" cellspacing="10" width="100%" height="100%" style="background-color:#f0f0f0">
                                            <tr><td><h1>Меню:</h1></td></tr>
                                            <tr><td><a href="?page=content_page" class="menu">Контентные страницы</a></td></tr>
                                            <tr><td><a href="?page=contacts" class="menu">Контактная информация</a></td></tr>
                                            <tr><td><a href="?page=user" class="menu">Пользователи</a></td></tr>
                                            <tr><td><a href="?page=client" class="menu">Клиенты</a></td></tr>
                                            <tr><td><a href="?page=service" class="menu">Услуги</a></td></tr>
                                            <tr><td><a href="?page=service_order" class="menu">Заказ услуг</a></td></tr>
                                            <tr><td><a href="?page=project" class="menu">Работы</a></td></tr>
                                            <tr><td><a href="?page=review" class="menu">Отзывы о работе</a></td></tr>
                                            <tr><td><a href="?page=license" class="menu">Лицензии</a></td></tr>
                                            <tr><td><a href="?page=personal" class="menu">Сотрудники</a></td></tr>
                                            <tr><td><a href="?page=vacancy" class="menu">Вакансии</a></td></tr>
                                            <tr><td><a href="?page=news" class="menu">Новости и события</a></td></tr>
                                            <tr><td><a href="?page=smi" class="menu">СМИ о компании</a></td></tr>
                                            <tr><td><a href="?page=partner" class="menu">Партнеры</a></td></tr>
                                            <tr><td><a href="?page=document" class="menu">Документы</a></td></tr>
                                            <tr><td><a href="?page=faq" class="menu">Вопрос-ответ</a></td></tr>
                                        </table>

                                    </td>
                                    <td>
                                        {if isset($page) && !empty($page)}
                                            {include file="admin/$page.tpl"}
                                        {/if}
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>

    </body>
</html>