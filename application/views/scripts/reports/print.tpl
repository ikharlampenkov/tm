<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content="{$description}"/>
    <meta name="keywords" content="{$keywords}"/>
    <meta name="author-corporate" content=""/>
    <meta name="publisher-email" content=""/>

    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui-timepicker-addon.css"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/css/menu.css"/>

    <script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery-ui.js"></script>
    <script type="text/javascript" language="javascript" src="/js/i18n/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery-ui.timepicker.js"></script>
    <script type="text/javascript" language="javascript" src="/js/i18n/jquery.ui.timepicker-ru.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" language="javascript" src="/js/menu.js"></script>
    <script type="text/javascript" language="javascript" src="/js/main.js"></script>
    <script type="text/javascript" language="javascript" src="/js/func.js"></script>

    <title>{$title}</title>

</head>

<body>

<div class="content">

    <script type="text/javascript">
        window.print();
    </script>

    <table width="100%">
        <tr>
            <td class="ttovar">Задача</td>
            <td class="ttovar" style="width: 120px;">Дата добавления</td>
            <td class="ttovar" style="width: 120px;">Выполнить до</td>
            <td class="ttovar" style="width: 120px;">Затрачено</td>
            <td class="ttovar" style="width: 120px;">Осталось</td>
            <td class="ttovar">Исполнитель</td>
            <td class="ttovar">Ответственный</td>
            <td class="ttovar">Кто принял</td>
            <td class="ttovar">Кто поставил</td>
        </tr>

    {if $taskList!==false}
        {foreach from=$taskList item=task}
            <tr>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->title}</td>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->datecreate|date_format:"%d %B %Y"}</td>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('deadline')}{$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}{/if}</td>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->getExecuteTime()|date_format:"%d"} дней</td>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->getLeftTime() != 0}{$task->getLeftTime()|date_format:"%d"}{else}0{/if} дней</td>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">
                    {if count($task->getExecutant())>0}
                        {foreach from=$task->getExecutant() item=user}
                            <div>{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}{$user->login}{/if}{if $user->searchAttribute('position') && $user->getAttribute('position')->value != ''}, {$user->getAttribute('position')->value}{/if}</div>
                        {/foreach}
                    {/if}
                </td>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('who_responsible') && $task->getAttribute('who_responsible')->value!='-'}
                    {assign var="who_responsible" value=TM_User_User::getInstanceById($task->getAttribute('who_responsible')->value)}
                    {if $who_responsible->searchAttribute('name')}
                        {$who_responsible->getAttribute('name')->value}
                        {else}
                        {$who_responsible->login}
                    {/if}
                    {else}&nbsp;
                {/if}</td>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('who_adopted') && $task->getAttribute('who_adopted')->value!='-'}
                    {assign var="who_adopted" value=TM_User_User::getInstanceByLogin($task->getAttribute('who_adopted')->value)}
                    {if $who_adopted->searchAttribute('name')}
                        {$who_adopted->getAttribute('name')->value}
                        {else}
                        {$who_adopted->login}
                    {/if}
                    {else}&nbsp;
                {/if}</td>
                <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('who_set') && $task->getAttribute('who_set')->value!='-'}
                    {assign var="who_set" value=TM_User_User::getInstanceById($task->getAttribute('who_set')->value)}
                    {if $who_set->searchAttribute('name')}
                        {$who_set->getAttribute('name')->value}
                        {else}
                        {$who_set->login}
                    {/if}
                    {else}&nbsp;
                {/if}</td>
            </tr>
        {include file="reports/taskblock.tpl" subtask=$task->getChild() wid="20"}
        {/foreach}
    {/if}

    </table>

</div>

</body>
</html>