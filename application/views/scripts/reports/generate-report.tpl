<div class="page"><h1>Отчет</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar">Задача</td>
        <td class="ttovar" style="width: 130px;">Дата добавления</td>
        <td class="ttovar" style="width: 130px;">Выполнить до</td>
        <td class="ttovar" style="width: 130px;">Затрачено</td>
        <td class="ttovar" style="width: 130px;">Осталось</td>
        <td class="ttovar">Исполнитель</td>
        <td class="ttovar">Ответственный</td>
        <td class="ttovar">Кто принял</td>
    </tr>

    {*{if $task->searchAttribute('state')}{$task->getAttribute('state')->value}{else}Не выполнено{/if}*}

{if $taskList!==false}
    {foreach from=$taskList item=task}
        <tr>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->title}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->datecreate|date_format:"%d.%m.%Y"}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('deadline')}{$task->getAttribute('deadline')->value|date_format:"%d.%m.%Y"}{/if}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->getExecuteTime()|date_format:"%H:%M"}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->getLeftTime()|date_format:"%H:%M"}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">
                {if count($task->getExecutant())>0}
                    {foreach from=$task->getExecutant() item=user}
                        <div>{$user->login}</div>
                    {/foreach}
                {/if}
            </td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('who_responsible') && $task->getAttribute('who_responsible')->value!='-'}{TM_User_User::getInstanceById($task->getAttribute('who_responsible')->value)->login}{/if}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('who_adopted')}{$task->getAttribute('who_adopted')->value}{/if}</td>
        </tr>
        {include file="reports/taskblock.tpl" subtask=$task->getChild() wid="20"}
    {/foreach}
{/if}

</table>