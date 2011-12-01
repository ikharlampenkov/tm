<div class="page"><h1>Отчет</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar">Задача</td>
        <td class="ttovar" style="width: 130px;">Дата добавления</td>
        <td class="ttovar" style="width: 130px;">Срок</td>
        <td class="ttovar">Исполнитель</td>
        <td class="ttovar">Статус</td>
    </tr>

{if $taskList!==false}
    {foreach from=$taskList item=task}
        <tr>
            <td class="ttovar">{$task->title}</td>
            <td class="ttovar">{$task->datecreate|date_format:"%d.%m.%Y"}</td>
            <td class="ttovar">{if $task->searchAttribute('deadline')}{$task->getAttribute('deadline')->value|date_format:"%d.%m.%Y"}{/if}</td>
            <td class="ttovar">
                {if count($task->getExecutant())>0}
                    {foreach from=$task->getExecutant() item=user}
                        <div>{$user->login}</div>
                    {/foreach}
                {/if}
            </td>
            <td class="ttovar">{if $task->searchAttribute('state')}{$task->getAttribute('state')->value}{/if}</td>
        </tr>
        {include file="reports/taskblock.tpl" subtask=$task->getChild() wid="20"}
    {/foreach}
{/if}

</table>