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

{if $task->searchAttribute('state')}{$task->getAttribute('state')->value}{else}Не выполнено{/if}

{if $taskList!==false}
    {foreach from=$taskList item=task}
        <tr>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->title}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->datecreate|date_format:"%d.%m.%Y"}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('deadline')}{$task->getAttribute('deadline')->value|date_format:"%d.%m.%Y"}{/if}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{$task->getExecuteTime()|date_format:"%d"} дней</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->getLeftTime() != 0}{$task->getLeftTime()|date_format:"%d"}{else}0{/if} дней</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">
                {if count($task->getExecutant())>0}
                    {foreach from=$task->getExecutant() item=user}
                        <div>{$user->login}</div>
                    {/foreach}
                {/if}
            </td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('who_responsible') && $task->getAttribute('who_responsible')->value!='-'}{TM_User_User::getInstanceById($task->getAttribute('who_responsible')->value)->login}{/if}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('who_adopted')}{$task->getAttribute('who_adopted')->value}{/if}</td>
            <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">{if $task->searchAttribute('who_set') && $task->getAttribute('who_set')->value!='-'}{TM_User_User::getInstanceById($task->getAttribute('who_set')->value)->login}{/if}</td>
        </tr>
    {include file="reports/taskblock.tpl" subtask=$task->getChild() wid="20"}
    {/foreach}
{/if}

</table>