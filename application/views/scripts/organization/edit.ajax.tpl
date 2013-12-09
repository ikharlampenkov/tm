{if isset($exception_msg)}
    <div id="exception" class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p id="exception_message"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                Ошибка: {$exception_msg}</p>
        </div>
    </div>
    <br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $organization->id])}" method="post" enctype="multipart/form-data" id="editForm">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input type="text" name="data[title]" value="{$organization->title}" class="input_ajax"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input type="text" name="data[date_create]" value="{$organization->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}" class="datepicker input_ajax"/></td>
        </tr>


        {if $attributeHashList!==false}
            {foreach from=$attributeHashList item=attributeHash}
                <tr>
                    <td class="{if $attributeHash->isRequired}ttovar_title_requared{else}ttovar_title{/if}">{$attributeHash->title}{if $attributeHash->isRequired}*{/if}</td>
                    <td class="ttovar">{$attributeHash->type->getHTMLFrom($attributeHash, $organization)}{*<input name="data[attribute][{$attributeHash->attributeKey}]" value="{if $organization->searchAttribute($attributeHash->attributeKey)}{$organization->getAttribute($attributeHash->attributeKey)->value}{/if}"/>*}</td>
                </tr>
            {/foreach}
        {/if}

    </table>

</form>