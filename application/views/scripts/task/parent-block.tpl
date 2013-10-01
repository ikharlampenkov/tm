{if $subtask}

    {foreach from=$subtask item=parent}
    <option value="{$parent->id}" {if $task->getParent() != null && $task->getParent()->getId() == $parent->id}selected="selected"{/if}>{$wid} {$parent->title}</option>
        {if $parent->getChild()}
        {include file="task/parent-block.tpl" subtask=$parent->getChild() wid=$wid|cat:'--' task=$task}
        {/if}
    {/foreach}

{/if}

