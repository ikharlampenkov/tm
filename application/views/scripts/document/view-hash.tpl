{if_allowed resource="{$controller}/index" priv="show-attribute-hash"}
<br/>
<div class="page"><h1>Список атрибутов для документов</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3">
            <img src="/i/add.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'addAttributeHash'])}">добавить</a></td>
    </tr>

{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
        <tr>
            <td class="ttovar">{$attributeHash->attributeKey}</td>
            <td class="ttovar">{$attributeHash->title}</td>
            <td class="ttovar">{$attributeHash->type->title}</td>
            <td class="tedit">
                <img src="/i/edit.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'editAttributeHash', 'key' => $attributeHash->attributeKey])}">редактировать</a><br/>
                <img src="/i/delete.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'deleteAttributeHash', 'key' => $attributeHash->attributeKey])}" onclick="return confirmDelete('{$attributeHash->title}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}

</table>
{/if_allowed}