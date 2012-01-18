
Название</b>&nbsp;{$task->title}<br/>

<b>Супер задача</b>&nbsp;
{if count($task->parent)>0}
    {foreach from=$task->parent item=parent}
        {$parent->title}
    {/foreach}
{/if}
<br/>

<b>Дата создания</b>&nbsp;{$task->dateCreate|date_format:"%d.%B.%Y %H:%M"}<br/>

{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
        {if $task->searchAttribute($attributeHash->attributeKey)}
        <b>{$attributeHash->title}</b>&nbsp;{$attributeHash->type->getHTML($attributeHash, $task)}<br/>
        {/if}
    {/foreach}
{/if}

{if $documentList !== false}
    {foreach from=$documentList item=document}
    <b>Документ</b>&nbsp;<a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank">{$document->title}</a><br/>
    {/foreach}
{/if}