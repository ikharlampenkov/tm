<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content="{$description}"/>
    <meta name="keywords" content="{$keywords}"/>
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

    <title>{$title}</title>

</head>

<body>

<div class="head">
    <div class="login">
        <div class="unlogged">
            Пользователь: {$authUser}<br/>
            <a href="/login/logout/" style="color: #ffffff;">Выйти</a>
        </div>
    </div>

    <div class="head_left">
        <div class="logo"><a href="/" style="color: #ffffff; text-decoration: none; font-size: 26px;">{$title}</a></div>
    </div>
</div>


<a name="top"></a>

<ul class="menu_up">
{if_allowed resource="task/index"}
    <li>
        <a href="/task/" >Проекты</a></td>
        <span>&nbsp;</span>
        <ul class="list" id="prgms">
            <li><a href="/program-for-ipad/">Программы для iPad и iPad 2</a></li>
        </ul>
    </li>
{/if_allowed}
{if_allowed resource="document/index"}
    <li>
        <a href="/document/">Документы</a>
        <span>&nbsp;</span>
        <ul class="list" id="prgms">
            <li><a href="/program-for-iphone/">Программы для iPhone</a></li>
        </ul>
    </li>
{/if_allowed}
{if_allowed resource="reports/index"}
    <li>
        <a href="/reports/">Отчеты</a>
        <span>&nbsp;</span>
        <ul class="list" id="prgms">
            <li><a href="/program-for-ipod/">Программы для iPod и iPod touch</a></li>
        </ul>
    </li>
{/if_allowed}
{if_allowed resource="discussion/index"}
    <li>
        <a href="/discussion/">Обсуждение</a>
        <span>&nbsp;</span>
        <ul class="list" id="prgms">
            <li><a href="/information/">Познавательная информация</a></li>
        </ul>
    </li>
{/if_allowed}
{if_allowed resource="user/index"}
    <li>
           <a href="/user/">Пользователи</a>
           <span>&nbsp;</span>
           <ul class="list" id="prgms">
               <li><a href="/information/">Познавательная информация</a></li>
           </ul>
       </li>
{/if_allowed}
</ul>

<div class="content">

    <table border="0" cellpadding="20" width="100%">
        <tr>
            <td>
            {$this->layout()->content}
            </td>
        </tr>
    </table>

</div>


</body>
</html>
