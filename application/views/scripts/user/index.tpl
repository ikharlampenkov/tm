<div class="page"><h1>Пользователи</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить</a></td>
    </tr>

{if $userList!==false}
    {foreach from=$userList item=user}
        <tr>
            <td class="ttovar">{$user->login}</td>
            <td class="ttovar">{$user->role->title}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $user->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $user->id])}" onclick="return confirmDelete('{$user->id}');" style="color: #830000">удалить</a></td>
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
            <td class="ttovar">{$role->title}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'editRole', 'id' => $role->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteRole', 'id' => $role->id])}" onclick="return confirmDelete('{$role->id}');" style="color: #830000">удалить</a></td>
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
            <td class="ttovar">{$resource->title}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'editResource', 'id' => $resource->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteResource', 'id' => $resource->id])}" onclick="return confirmDelete('{$resource->id}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}

</table>
