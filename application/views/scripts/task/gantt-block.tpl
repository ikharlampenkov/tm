{if $subtask}

    {foreach from=$subtask item=parent}

    parentTask.addChildTask(new GanttTaskInfo({$parent->id}, "{$parent->title}", new Date({$parent->dateCreate|date_format:"%Y"}, {$parent->dateCreate|date_format:"%m"}, {$parent->dateCreate|date_format:"%d"}), {$parent->getEstHours()}, 40, ""));

        {if $parent->getChild()}
        {include file="task/gantt-block.tpl" subtask=$parent->getChild()}
        {/if}
    {/foreach}

{/if}