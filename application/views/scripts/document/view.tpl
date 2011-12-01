<div class="page"><h1>Документ <a href="{$this->url(['controller' => $controller, 'action'=> 'index'])}">Все документы</a></h1></div><br/>

    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar">{$document->title}</td>
        </tr>
        <tr>
            <td class="ttovar_title">Папка</td>
            <td class="ttovar">{$document->parent->title}</td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar">{$document->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}</td>
        </tr>
        <tr>
            <td class="ttovar_title">Файл</td>
            <td class="ttovar">{if $document->file->getName()}<a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank">загрузить</a>{/if}</td>
        </tr>

    {if $attributeHashList!==false}
        {foreach from=$attributeHashList item=attributeHash}
        {if $document->searchAttribute($attributeHash->attributeKey)}
            <tr>
                <td class="ttovar_title">{$attributeHash->title}</td>
                <td class="ttovar">{$document->getAttribute($attributeHash->attributeKey)->value}</td>
            </tr>
        {/if}
        {/foreach}
    {/if}

    {if $taskList !== false}
        {foreach from=$taskList item=task}
            <tr>
            <td class="ttovar_title">Задачи</td>
            <td class="ttovar">{$task->title}
                {if_allowed resource="task/edit"}
                {if_object_allowed type="Task" object="{$task}" priv="write"}
                / <a href="{$this->url(['controller' => 'task','action' => 'edit', 'id' => $task->id])}">редактировать</a>
                {/if_object_allowed}
                {/if_allowed}
                {if_allowed resource="task/view"}
                {if_object_allowed type="Task" object="{$task}"}
                / <a href="{$this->url(['controller' => 'task','action' => 'view', 'id' => $task->id])}">просмотреть</a>
                {/if_object_allowed}
                {/if_allowed}
            </td>
        </tr>
        {/foreach}
    {/if}
    </table>