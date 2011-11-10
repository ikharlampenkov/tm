<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="/css/main.css" />
        <script type="text/javascript" language="javascript" src="/js/jquery.js" ></script>
        <script type="text/javascript" language="javascript" src="/js/main.js" ></script>

        <title>{$title}</title>
    </head>

    <body>

        <table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
            <tr>
                <td height="188">
                    <div style="background-image: url('/i/verhfon.jpg'); width:100%; height: 188px">
                        <div style="background-image: url('/i/levfon.jpg'); background-repeat: no-repeat; background-position: right; width:100%; height: 188px">
                            <img src="1px.gif" width="1" height="1" />
                        </div>
                    </div>
                </td>
                <td width="995" height="188">
                    <img src="/i/logo.jpg" width="995" height="188" />
                </td>
                <td>
                    <div style="background-image: url('/i/verhfon.jpg'); width:100%; height: 188px">
                        <div style="background-image: url('/i/pravfon.jpg'); background-repeat: no-repeat; width:100%; height: 188px">
                            <img src="/i/1px.gif" width="1" height="1" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="/i/1px.gif" width="1" height="1" />
                </td>
                <td height="58" align="center">
                    <table style="width: 780px; height: 58px; padding: 0px; vertical-align: middle" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="smenu"><a href="?page=content_page&title=about" class="smenu">КОМПАНИЯ</a></td>
                            <td width="13"><img src="/i/sepmenu.gif" /></td>
                            <td class="smenu"><a href="?page=service" class="smenu">УСЛУГИ</a></td>
                            <td width="13"><img src="/i/sepmenu.gif" /></td>
                            <td class="smenu"><a href="?page=client" class="smenu">КЛИЕНТЫ</a></td>
                            <td width="13"><img src="/i/sepmenu.gif" /></td>
                            <td class="smenu"><a href="?page=partner" class="smenu">ПАРТНЕРЫ</a></td>
                            <td width="13"><img src="/i/sepmenu.gif" /></td>
                            <td class="smenu"><a href="?page=faq" class="smenu">ВОПРОС-ОТВЕТ</a></td>
                            <td width="13"><img src="/i/sepmenu.gif" /></td>
                            <td class="smenu"><a href="?page=document&root=3" class="smenu">ДОКУМЕНТЫ</a></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <img src="/i/1px.gif" width="1" height="1" />
                </td>
            </tr>
            <tr>
                <td>
                    <img src="/i/1px.gif" width="1" height="1" />
                </td>
                <td height="30" align="center">
                    Приносим извинения, сайт находится на стадии разработки.
                </td>
                <td>
                    <img src="/i/1px.gif" width="1" height="1" />
                </td>
            </tr>
            <tr>
                <td>
                    <img src="/i/1px.gif" width="1" height="1" />
                </td>
                <td>
                    {if isset($page) && !empty($page)}
                        {include file="$page.tpl"}
                    {else}
                        <img src="/i/telo.jpg" />
                    {/if}
                </td>
                <td>
                    <img src="/i/1px.gif" width="1" height="1" />
                </td>
            </tr>
            <tr>
                <td style="background-image: url('/i/nizfon.jpg');">
                    <img src="/i/1px.gif" width="1" height="1" />
                </td>
                <td>
                    <img src="/i/niz.jpg" />
                </td>
                <td style="background-image: url('/i/nizfon.jpg');">
                    <img src="/i/1px.gif" width="1" height="1" />
                </td>
            </tr>
        </table>

    </body>

</html>
