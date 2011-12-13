{if_allowed resource="{$controller}/index" priv="show-attribute-hash"}
<div class="page"><h1>Список атрибутов для задач</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="6"><a href="{$this->url(['controller' => $controller,'action' => 'addAttributeHash'])}">добавить</a></td>
    </tr>
    <tr>
        <td class="ttovar">Ключ</td>
        <td class="ttovar">Название</td>
        <td class="ttovar">Тип</td>
        <td class="ttovar">Обязательное</td>
        <td class="ttovar">Порядок сортировки</td>
        <td class="ttovar"></td>
    </tr>

    {if $attributeHashList!==false}
        {foreach from=$attributeHashList item=attributeHash}
            <tr>
                <td class="ttovar">{$attributeHash->attributeKey}</td>
                <td class="ttovar">{$attributeHash->title}</td>
                <td class="ttovar">{$attributeHash->type->title}</td>
                <td class="ttovar">{if $attributeHash->isRequired}Да{else}Нет{/if}</td>
                <td class="ttovar">{$attributeHash->sortOrder}</td>
                <td class="tedit">
                    <a href="{$this->url(['controller' => $controller,'action' => 'editAttributeHash', 'key' => $attributeHash->attributeKey])}">редактировать</a><br/>
                    <a href="{$this->url(['controller' => $controller,'action' => 'deleteAttributeHash', 'key' => $attributeHash->attributeKey])}" onclick="return confirmDelete('{$attributeHash->title}');" style="color: #830000">удалить</a>
                </td>
            </tr>
        {/foreach}
    {/if}

</table>
{/if_allowed}