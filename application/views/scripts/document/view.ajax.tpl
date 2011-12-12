<b>Папка</b>&nbsp;{$document->parent->title}<br/>
<b>Дата создания</b>&nbsp;{$document->dateCreate|date_format:"%d.%m.%Y %H:%M"}<br/>

{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
        {if $document->searchAttribute($attributeHash->attributeKey)}
        <b>{$attributeHash->title}</b>&nbsp;{$document->getAttribute($attributeHash->attributeKey)->value}<br/>
        {/if}
    {/foreach}
{/if}

{if $taskList !== false}
    {foreach from=$taskList item=task}
    <b>Задачи</b>&nbsp;{$task->title}<br/>
    {/foreach}
{/if}