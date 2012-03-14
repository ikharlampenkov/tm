Название</b>&nbsp;{$organization->title}<br/>

{*
<b>Дата создания</b>&nbsp;{$organization->dateCreate|date_format:"%d.%B.%Y %H:%M"}<br/>
*}

{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
        {if $organization->searchAttribute($attributeHash->attributeKey)}
        <b>{$attributeHash->title}</b>&nbsp;{$attributeHash->type->getHTML($attributeHash, $organization)}<br/>
        {/if}
    {/foreach}
{/if}