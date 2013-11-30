<div class="page"><h1>Редактировать атрибут</h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'editAttributeHash', 'key' => $hash->attributeKey])}" method="post">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Ключ</td>
            <td class="ttovar"><input name="data[attribute_key]" value="{$hash->attributeKey}"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Описание</td>
            <td class="ttovar"><input name="data[title]" value="{$hash->title}"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Тип</td>
            <td class="ttovar">
                <select name="data[type_id]">
                {foreach from=$attributeTypeList item=attributeType}
                    <option value="{$attributeType->id}" {if $attributeType->id == $hash->type->id}selected="selected"{/if}>{$attributeType->title}</option>
                {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Список значений (через ||) </td>
            <td class="ttovar"><input name="data[list_value]" value="{$hash->getValueList(true)}"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Список для сортировки значений (через ||)</td>
            <td class="ttovar"><input type="text" name="data[list_order]" value="{$hash->getListOrder(true)}"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Обязательное</td>
            <td class="ttovar"><input type="checkbox" name="data[required]" {if $hash->isRequired}checked="checked" {/if} style="width: 14px;"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Порядок сортировки</td>
            <td class="ttovar"><input type="text" name="data[sort_order]" value="{$hash->sortOrder}"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>