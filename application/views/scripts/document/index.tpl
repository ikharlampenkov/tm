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
        <td class="ttovar" align="center" colspan="4">
        {if_allowed resource="{$controller}/addFolder"}
        <a href="{$this->url(['controller' => $controller,'action' => 'addFolder'])}">добавить папку</a> / 
        {/if_allowed}
        {if_allowed resource="{$controller}/add"}
        {if isset($parentId) && $parentId>0}
        <a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить документ</a>
        {/if}
        {/if_allowed}
        </td>
    </tr>


{if $documentList!==false}
    {foreach from=$documentList item=document}
        {if_object_allowed type="{$controller|capitalize}" object="{$document}"}
        <tr>
            <td class="ttovar">
                {if $document->isFolder}
                    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $document->id])}">{$document->title}</a>
                {else}
                    {$document->title}
                {/if}</td>
            <td class="ttovar">{$document->datecreate|date_format:"%d.%m.%Y"}</td>
            {if !$document->isFolder}
            <td class="tedit">
                {if_allowed resource="{$controller}/showDiscussion"}
                 <a href="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idDocument' => $document->id])}">обсуждение</a>
                {/if_allowed}
            </td>
            {/if}
            <td class="tedit">
                {if_allowed resource="{$controller}/showAcl"}
                 <a href="{$this->url(['controller' => $controller,'action' => 'showAcl', 'idDocument' => $document->id])}">права</a>
                {/if_allowed}
            </td>
            <td class="tedit">
                {if $document->isFolder}
                    {if_allowed resource="{$controller}/editFolder"}
                    {if_object_allowed type="{$controller|capitalize}" object="{$document}" priv="write"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'editFolder', 'id' => $document->id])}">редактировать</a><br/>
                    {/if_object_allowed}
                    {/if_allowed}
                    {if_allowed resource="{$controller}/deleteFolder"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'deleteFolder', 'id' => $document->id])}" onclick="return confirmDelete('{$document->id}');" style="color: #830000">удалить</a>
                    {/if_allowed}
                {else}
                    {if_allowed resource="{$controller}/view"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'view', 'id' => $document->id])}">просмотреть</a><br/>
                    {/if_allowed}
                    {if_allowed resource="{$controller}/edit"}
                    {if_object_allowed type="{$controller|capitalize}" object="{$document}" priv="write"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $document->id])}">редактировать</a><br/>
                    {/if_object_allowed}
                    {/if_allowed}
                    {if_allowed resource="{$controller}/delete"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $document->id])}" onclick="return confirmDelete('{$document->id}');" style="color: #830000">удалить</a>
                    {/if_allowed}
                {/if}
            </td>

        </tr>
        {/if_object_allowed}
    {/foreach}
{/if}

</table>

{if_allowed resource="{$controller}/index" priv="show-attribute-hash"}
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
{/if_allowed}

{if_allowed resource="{$controller}/index" priv="show-attribute-type"}
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
{/if_allowed}