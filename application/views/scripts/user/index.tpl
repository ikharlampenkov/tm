<div class="page"><h1>Пользователи</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить</a></td>
    </tr>
    <tr>
        <td class="ttovar">ФИО</td>
        <td class="ttovar">Логин</td>
        <td class="ttovar">Роль</td>
        <td class="ttovar"></td>
    </tr>

{if $userList!==false}
    {foreach from=$userList item=user}
        <tr>
            <td class="ttovar">{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}-{/if}</td>
            <td class="ttovar">{$user->login}</td>
            <td class="ttovar">{$user->role->rtitle}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $user->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $user->id])}" onclick="return confirmDelete('{$user->login}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}
</table>


<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Роли</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'addRole'])}">добавить</a></td>
    </tr>

{if $userRoleList!==false}
    {foreach from=$userRoleList item=role}
        <tr>
            <td class="ttovar">{$role->rtitle}</td>
            <td class="ttovar">{$role->title}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'showRoleAcl', 'idRole' => $role->id])}">права</a></td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'editRole', 'id' => $role->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteRole', 'id' => $role->id])}" onclick="return confirmDelete('{$role->rtitle}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}
</table>


<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Ресурсы</h1></div><br/>


<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'addResource'])}">добавить</a></td>
    </tr>

{if $userResourceList!==false}
    {foreach from=$userResourceList item=resource}
        <tr>
            <td class="ttovar">{$resource->rtitle}</td>
            <td class="ttovar">{$resource->title}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'editResource', 'id' => $resource->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteResource', 'id' => $resource->id])}" onclick="return confirmDelete('{$resource->rtitle}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}

</table>


<br/>
<div class="page"><h1>Список атрибутов для пользователей</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="4"><a href="{$this->url(['controller' => $controller,'action' => 'addAttributeHash'])}">добавить</a></td>
    </tr>

{if $attributeHashList!==false}
    {foreach from=$attributeHashList item=attributeHash}
        <tr>
            <td class="ttovar">{$attributeHash->title}</td>
            <td class="ttovar">{$attributeHash->attributeKey}</td>
            <td class="ttovar">{$attributeHash->type->title}</td>
            <td class="tedit">
                <a href="{$this->url(['controller' => $controller,'action' => 'editAttributeHash', 'key' => $attributeHash->attributeKey])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteAttributeHash', 'key' => $attributeHash->attributeKey])}" onclick="return confirmDelete('{$attributeHash->title}');" style="color: #830000">удалить</a>
            </td>
        </tr>
    {/foreach}
{/if}

</table>

<br/>
<div class="page"><h1>Типы атрибутов</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'addAttributeType'])}">добавить</a></td>
    </tr>

{if $attributeTypeList!==false}
    {foreach from=$attributeTypeList item=attributeType}
        <tr>
            <td class="ttovar">{$attributeType->title}</td>
            <td class="ttovar">{$attributeType->handler}</td>
            <td class="tedit">
                <a href="{$this->url(['controller' => $controller,'action' => 'editAttributeType', 'id' => $attributeType->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteAttributeType', 'id' => $attributeType->id])}" onclick="return confirmDelete('{$attributeType->title}');" style="color: #830000">удалить</a>
            </td>
        </tr>
    {/foreach}
{/if}

</table>
