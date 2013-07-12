{if isset($exception_msg)}
<div id="exception" class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
        <p id="exception_message"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            Ошибка: {$exception_msg}</p>
    </div>
</div>
<br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'add'])}" method="post" id="addForm">
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
{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
        <tr>
            <td class="{if $attributeHash->isRequired}ttovar_title_requared{else}ttovar_title{/if}">{$attributeHash->title}{if $attributeHash->isRequired}*{/if}</td>
            <td class="ttovar">{$attributeHash->type->getHTMLFrom($attributeHash, $task)}{*<input name="data[attribute][{$attributeHash->attributeKey}]" value="{if $task->searchAttribute($attributeHash->attributeKey)}{$task->getAttribute($attributeHash->attributeKey)->value}{/if}"/>*}</td>
        </tr>
    {/foreach}
{/if}
</table>

<table width="100%">
    <tr>
        <td class="ttovar_title">Пользователь</td>
        <td class="ttovar" style="width: 90px;">Чтение</td>
        <td class="ttovar" style="width: 90px;">Запись</td>
        <td class="ttovar" style="width: 90px;">Исполнитель</td>
        <td class="ttovar"></td>
    </tr>

{if $userList!==false}
    {foreach from=$userList item=user}
        <tr>
            <td class="ttovar_title">{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}{$user->login}{/if}</td>
            <td class="ttovar"><input type="checkbox" name="dataacl[{$user->id}][is_read]" {if isset($taskAcl[{$user->id}])}{if $taskAcl[{$user->id}]->isRead}checked="checked"{/if}{/if} /></td>
            <td class="ttovar"><input type="checkbox" name="dataacl[{$user->id}][is_write]" {if isset($taskAcl[{$user->id}])}{if $taskAcl[{$user->id}]->isWrite}checked="checked"{/if}{/if} /></td>
            <td class="ttovar"><input type="checkbox" name="dataacl[{$user->id}][is_executant]" /></td>
            <td class="ttovar"><input type="hidden" name="dataacl[{$user->id}][fake]" /></td>
        </tr>
    {/foreach}
{/if}

</table>
</form>