<div class="page"><h1>Редактировать документ</h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $document->id])}" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input type="text" name="data[title]" value="{$document->title}"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Папка</td>
            <td class="ttovar"><select name="data[parentDocument]">
                <option value="">--</option>
            {if !empty($parentList)}
                {foreach from=$parentList item=parent}
                    <option value="{$parent->id}" {if is_object($document->parent) && $document->parent->id == $parent->id}selected="selected"{/if}>{$parent->title}</option>
                {/foreach}
            {/if}
            </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input type="text" name="data[date_create]" value="{$document->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}" readonly="readonly"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Файл</td>
            <td class="ttovar">{if $document->file->getName()}<a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank">загрузить</a>{/if}<input type="file" name="file"/></td>
        </tr>

    {if $attributeHashList!==false}
        {foreach from=$attributeHashList item=attributeHash}
            <tr>
                <td class="ttovar_title">{$attributeHash->title}</td>
                <td class="ttovar">{$attributeHash->type->getHTMLFrom($attributeHash, $document)}{*<input name="data[attribute][{$attributeHash->attributeKey}]" value="{if $document->searchAttribute($attributeHash->attributeKey)}{$document->getAttribute($attributeHash->attributeKey)->value}{/if}"/>*}</td>
            </tr>
        {/foreach}
    {/if}

    {if $taskList !== false}
        {foreach from=$taskList item=task}
            <tr>
            <td class="ttovar_title">Задачи</td>
            <td class="ttovar">
                {$task->title}
                / <a href="{$this->url(['controller' => 'task','action' => 'edit', 'id' => $task->id])}">редактировать</a>
            </td>
        </tr>
        {/foreach}
    {/if}
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>