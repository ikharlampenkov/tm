<div class="page"><h1>Редактировать {if !$task->hasParent()}проект{elseif $task->getChild()}группу задач{else}задачу{/if}</h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $task->id])}" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Тип задачи</td>
            <td class="ttovar">
                <select name="data[type]">
                {foreach from=$taskTypeList item=task_type key=task_type_key}
                    <option value="{$task_type_key}" {if $task->type == $task_type_key}selected="selected"{/if}>{$task_type}</option>
                {/foreach}

                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input type="text" name="data[title]" value="{$task->title}"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Супер задача</td>
            <td class="ttovar"><select name="data[parentTask]">
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
            <td class="ttovar"><input type="text" name="data[date_create]" value="{$task->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}" class="datepicker"/></td>
        </tr>

    {if $attributeHashList!==false}
        {foreach from=$attributeHashList item=attributeHash}
            <tr>
                <td class="{if $attributeHash->isRequired}ttovar_title_requared{else}ttovar_title{/if}">{$attributeHash->title}{if $attributeHash->isRequired}*{/if}</td>
                <td class="ttovar">{$attributeHash->type->getHTMLFrom($attributeHash, $task)}{*<input type="text" name="data[attribute][{$attributeHash->attributeKey}]" value="{if $task->searchAttribute($attributeHash->attributeKey)}{$task->getAttribute($attributeHash->attributeKey)->value}{/if}"/>*}</td>
            </tr>
        {/foreach}
    {/if}

    {if $documentList !== false}
        {foreach from=$documentList item=document}
            <tr>
                <td class="ttovar_title">Документ</td>
                <td class="ttovar">
                    <a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank">{$document->title}</a>
                    {if_allowed resource="document/edit"}
                        / <a href="{$this->url(['controller' => 'document','action' => 'edit', 'id' => $document->id])}">редактировать</a>
                    {/if_allowed}
                    {if_allowed resource="{$controller}/deleteLinkToDoc"}
                        / <a href="{$this->url(['controller' => $controller,'action' => 'deleteLinkToDoc', 'id' => $task->id, 'doc_id' => $document->id])}">удалить</a>
                    {/if_allowed}
                </td>
            </tr>
        {/foreach}
    {/if}
        <tr>
            <td class="ttovar_title">Документ</td>
            <td class="ttovar">
                Название документа&nbsp;<input type="text" name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 300px;"/>
            </td>
        </tr>

    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>