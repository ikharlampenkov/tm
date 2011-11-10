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
                        <tr><td><div class="menu">Компания</div></td></tr>
                        <tr><td><a href="?page=content_page&title=about" class="menu">Обращение руководителя</a></td></tr>
                        <tr><td><a href="?page=personal" class="menu">Сотрудники</a></td></tr>
                        <tr><td><a href="?page=license" class="menu">Лицензии</a></td></tr>
                        <tr><td><a href="?page=news" class="menu">Новости и события</a></td></tr>
                        <tr><td><a href="?page=smi" class="menu">СМИ о компании</a></td></tr>
                        <tr><td><a href="?page=vacancy" class="menu">Вакансии</a></td></tr>
                        <tr><td><a href="?page=contacts" class="menu">Контактная информация</a></td></tr>

                        <tr><td><div class="menu">Услуги</div></td></tr>
                        <tr><td><a href="?page=service" class="menu">Услуги</a></td></tr>
                        <tr><td><a href="?page=service_order" class="menu">Заказ услуг</a></td></tr>

                        <tr><td><div class="menu">Клиенты</div></td></tr>
                        <tr><td><a href="?page=project" class="menu">Выполненные работы</a></td></tr>
                        <tr><td><a href="?page=client" class="menu">Информация о клиентах</a></td></tr>
                        <tr><td><a href="?page=review" class="menu">Отзывы о работе</a></td></tr>


                        <tr><td><div class="menu">Партнеры</div></td></tr>
                        <tr><td><a href="?page=partner" class="menu">Партнеры</a></td></tr>

                        <tr><td><div class="menu">Документы</div></td></tr>
                        <tr><td><a href="?page=document&root=3" class="menu">Региональное законодательство</a></td></tr>
                        <tr><td><a href="?page=document&root=5" class="menu">Федеральное законодательство</a></td></tr>
                        <tr><td><a href="?page=smi" class="menu">Публикации</a></td></tr>

                        <tr><td><div class="menu">Вопрос-ответ</div></td></tr>
                        <tr><td><a href="?page=faq" class="menu">Вопрос-ответ</a></td></tr>
                    </table>

                </td>
                <td>
                    {if isset($page) && !empty($page)}
                        {include file="$page.tpl"}
                    {/if}
                </td>
            </tr>
        </table>

    </body>
</html>