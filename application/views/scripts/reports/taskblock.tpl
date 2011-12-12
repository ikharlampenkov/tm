{if $subtask}
    {foreach from=$subtask item=task}
    <tr>
        <td class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}" style="padding-left: {$wid}px;">{$task->title}</td>
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
        {if $task->getChild()}
        {include file="reports/taskblock.tpl" subtask=$task->getChild() wid=$wid+20}
        {/if}
    {/foreach}
{/if}