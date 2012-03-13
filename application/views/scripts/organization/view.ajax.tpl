<div class="page"><h1>Организация</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar_title">Название</td>
        <td class="ttovar">{$organization->title}</td>
    </tr>
    {*
    <tr>
        <td class="ttovar_title">Дата создания</td>
        <td class="ttovar">{$organization->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}</td>
    </tr>
*}

{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
    {if $organization->searchAttribute($attributeHash->attributeKey)}
        <tr>
            <td class="ttovar_title">{$attributeHash->title}</td>
            <td class="ttovar"> {$organization->getAttribute($attributeHash->attributeKey)->value}</td>
        </tr>
    {/if}
    {/foreach}
{/if}

</table>