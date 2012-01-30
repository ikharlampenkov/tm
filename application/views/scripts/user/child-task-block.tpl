{if $subtask !== false}
    {foreach from=$subtask item=task}
        <tr>
            <td class="ttovar"><img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;{$wid}{$task->title}</td>
            <td class="ttovar"><input type="checkbox" name="data[{$task->id}][is_read]" {if $task->isRead($user)}checked="checked" {/if} /></td>
            <td class="ttovar"><input type="checkbox" name="data[{$task->id}][is_write]" {if $task->isWrite($user)}checked="checked" {/if} /></td>
            <td class="ttovar">
                <input type="checkbox" name="data[{$task->id}][is_executant]"
                    {if count($task->getExecutant())>0}
                        {foreach from=$task->getExecutant() item=iuser}
                       {if $iuser->id===$user->id}checked="checked" {/if}
                        {/foreach}
                        {else}&nbsp;
                    {/if}
                        />
            </td>
            <td class="ttovar">
                <input type="checkbox" name="data[{$task->id}][is_responsible]"
                    {if $task->searchAttribute('who_responsible') && $task->getAttribute('who_responsible')->value!='-' && $task->getAttribute('who_responsible')->value==$user->id}
                       checked="checked"
                    {/if}
                        />
            </td>
            <td class="ttovar"><input type="checkbox" name="data[{$task->id}][is_owner]" {if $task->user->id==$user->id}checked="checked"{/if} /></td>
        </tr>
        {if $task->getChild()}
        {include file="user/child-task-block.tpl" subtask=$task->getChild() wid=$wid|cat:'--' user=$user}
        {/if}
    {/foreach}
{/if}