<div class="page"><h1>Задача <a href="{$this->url(['controller' => $controller, 'action'=> 'index'])}">Все задачи</a></h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar_title">Название</td>
        <td class="ttovar">{$task->title}</td>
    </tr>
    <tr>
        <td class="ttovar_title">Супер задача</td>
        <td class="ttovar">
        {if count($task->parent)>0}
            {foreach from=$task->parent item=parent}
                {$parent->title}
            {/foreach}
        {/if}
        </td>
    </tr>
    <tr>
        <td class="ttovar_title">Дата создания</td>
        <td class="ttovar">{$task->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}</td>
    </tr>

{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
        <tr>
            <td class="ttovar_title">{$attributeHash->title}</td>
            <td class="ttovar">{if $task->searchAttribute($attributeHash->attributeKey)}{$task->getAttribute($attributeHash->attributeKey)->value}{/if}</td>
        </tr>
    {/foreach}
{/if}

{if $documentList !== false}
    {foreach from=$documentList item=document}
        <tr>
            <td class="ttovar_title">Документ</td>
            <td class="ttovar">
                <a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank">{$document->title}</a>
                / <a href="{$this->url(['controller' => 'document','action' => 'edit', 'id' => $document->id])}">редактировать</a>
                / <a href="{$this->url(['controller' => $controller,'action' => 'deleteLinkToDoc', 'id' => $task->id, 'doc_id' => $document->id])}">удалить</a>
            </td>
        </tr>
    {/foreach}
{/if}

</table>