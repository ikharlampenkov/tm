<div class="page"><h1>{if !isset($document)}Документы{else}Документ: {$document->title}{/if}</h1></div><br/>

{if isset($breadcrumbs)}
    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => 0])}">/..</a>
    {if !empty($breadcrumbs)}
    &nbsp;/
    {foreach from=$breadcrumbs item=crumb name=_crumb}
    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $crumb->id])}">{$crumb->title}</a>&nbsp;/
    {/foreach}
    {/if}
    <br/><br/>
{/if}


<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить</a></td>
    </tr>

{if $documentList!==false}
    {foreach from=$documentList item=document}
        <tr>
            <td class="ttovar"><a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $document->id])}">{$document->title}</a></td>
            <td class="ttovar">{$document->datecreate|date_format:"%d.%m.%Y"}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $document->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $document->id])}" onclick="return confirmDelete('{$document->id}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}

</table>


<br/>
<div class="page"><h1>Список аттрибутов для документов</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'addAttributeHash'])}">добавить</a></td>
    </tr>

{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
        <tr>
            <td class="ttovar">{$attributeHash->attributeKey}</td>
            <td class="ttovar">{$attributeHash->title}</td>
            <td class="ttovar">{$attributeHash->type->title}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'editAttributeHash', 'key' => $attributeHash->attributeKey])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteAttributeHash', 'key' => $attributeHash->attributeKey])}" onclick="return confirmDelete('{$attributeHash->attributeKey}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}

</table>


<br/>
<div class="page"><h1>Типы аттрибутов</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'addAttributeType'])}">добавить</a></td>
    </tr>

{if $attributeTypeList!==false}
    {foreach from=$attributeTypeList item=attributeType}
        <tr>
            <td class="ttovar">{$attributeType->title}</td>
            <td class="ttovar">{$attributeType->handler}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'editAttributeType', 'id' => $attributeType->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteAttributeType', 'id' => $attributeType->id])}" onclick="return confirmDelete('{$attributeType->id}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}

</table>