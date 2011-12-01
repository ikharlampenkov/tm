{if $subtask}
    {foreach from=$subtask item=task}
    <tr>
        <td class="ttovar" style="padding-left: {$wid}px;">{$task->title}</td>
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
        {if $task->getChild()}
        {include file="reports/taskblock.tpl" subtask=$task->getChild() wid=$wid+20}
        {/if}
    {/foreach}
{/if}