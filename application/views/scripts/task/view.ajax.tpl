<div class="page"><h1>Задача</h1></div><br/>

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
    {if $task->searchAttribute($attributeHash->attributeKey)}
        <tr>
            <td class="ttovar_title">{$attributeHash->title}</td>
            <td class="ttovar"> {$task->getAttribute($attributeHash->attributeKey)->value}</td>
        </tr>
    {/if}
    {/foreach}
{/if}

{if $documentList !== false}
    {foreach from=$documentList item=document}
        <tr>
            <td class="ttovar_title">Документ</td>
            <td class="ttovar">
                <a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank">{$document->title}</a>
                {if_allowed resource="document/edit"}
                {if_object_allowed type="Document" object="{$document}" priv="write"}
                / <a href="{$this->url(['controller' => 'document','action' => 'edit', 'id' => $document->id])}">редактировать</a>
                {/if_object_allowed}
                {/if_allowed}
                {if_allowed resource="document/view"}
                {if_object_allowed type="Document" object="{$document}"}
                / <a href="{$this->url(['controller' => 'document','action' => 'view', 'id' => $document->id])}">просмотреть</a>
                {/if_object_allowed}
                {/if_allowed}
                {if_allowed resource="document/deleteLinkToDoc"}
                / <a href="{$this->url(['controller' => $controller,'action' => 'deleteLinkToDoc', 'id' => $task->id, 'doc_id' => $document->id])}">удалить</a>
                {/if_allowed}
            </td>
        </tr>
    {/foreach}
{/if}

</table>