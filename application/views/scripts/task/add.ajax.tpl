{if isset($exception_msg)}
<div id="exception" class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
        <p id="exception_message"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            Ошибка: {$exception_msg}</p>
    </div>
</div>
<br/>
{/if}


<table width="100%">
    <tr>
        <td class="ttovar_title">Тип задачи</td>
        <td class="ttovar">
            <select name="data[type]" class="input_ajax">
            {foreach from=$taskTypeList item=task_type key=task_type_key}
                <option value="{$task_type_key}" {if $task->type == $task_type_key}selected="selected"{/if}>{$task_type}</option>
            {/foreach}

            </select>
        </td>
    </tr>
    <tr>
        <td class="ttovar_title">Название</td>
        <td class="ttovar"><input name="data[title]" value="{$task->title}" class="input_ajax"/></td>
    </tr>
    <tr>
        <td class="ttovar_title">Супер задача</td>
        <td class="ttovar"><select name="data[parentTask]" class="input_ajax">
            <option value="">--</option>
        {if !empty($parentList)}
            {foreach from=$parentList item=parent}
                <option value="{$parent->id}" {if $task->searchParent($parent) !== false }selected="selected"{/if}>{$parent->title}</option>
                {if $parent->getChild()}
                {include file="task/parent-block.tpl" subtask=$parent->getChild() task=$task wid="--"}
                {/if}
            {/foreach}
        {/if}
        </select>
        </td>
    </tr>
    <tr>
        <td class="ttovar_title">Дата создания</td>
        <td class="ttovar"><input name="data[date_create]" value="{$task->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}" class="datepicker input_ajax"/></td>
    </tr>
</table>