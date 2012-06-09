{*include file="organization/index.tpl"*}


<div class="page">
    <h1>Пользователи</h1>

    <div class="page_block">
    {if_allowed resource="{$controller}/index" priv="show-attribute-hash"}
        <a href="{$this->url(['controller' => $controller, 'action' => 'viewHash'])}">Список атрибутов</a>
    {/if_allowed}

    {if_allowed resource="{$controller}/index" priv="show-attribute-type"}
        <a href="{$this->url(['controller' => $controller, 'action' => 'viewAttributeType'])}">Типы атрибутов</a>
    {/if_allowed}

    {if_allowed resource="{$controller}/index" priv="show-resource"}
        <a href="{$this->url(['controller' => $controller, 'action' => 'viewResource'])}">Ресурсы</a>
    {/if_allowed}
    </div>
</div><br/>

<h3>Сотрудники</h3>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3">
            <img src="/i/add.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить</a></td>
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
            <td class="tedit">
                <img src="/i/task.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'showPrivateTask', 'userId' => $user->id])}">задачи</a><br/>
                <img src="/i/comanda.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'showUserAcl', 'id' => $user->id])}">права</a><br/>
                <img src="/i/edit.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $user->id])}">редактировать</a><br/>
                <img src="/i/delete.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $user->id])}" onclick="return confirmDelete('{$user->login}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}
</table>

<h3>Клиенты</h3>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3">
            <img src="/i/add.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить</a></td>
    </tr>
    <tr>
        <td class="ttovar">ФИО</td>
        <td class="ttovar">Логин</td>
        <td class="ttovar">Роль</td>
        <td class="ttovar"></td>
    </tr>

{if $userListClient!==false}
    {foreach from=$userListClient item=user}
        <tr>
            <td class="ttovar">{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}-{/if}</td>
            <td class="ttovar">{$user->login}</td>
            <td class="ttovar">{$user->role->rtitle}</td>
            <td class="tedit">
                <img src="/i/task.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'showPrivateTask', 'userId' => $user->id])}">задачи</a><br/>
                <img src="/i/comanda.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'showUserAcl', 'id' => $user->id])}">права</a><br/>
                <img src="/i/edit.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $user->id])}">редактировать</a><br/>
                <img src="/i/delete.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $user->id])}" onclick="return confirmDelete('{$user->login}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}
</table>


<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Роли</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3">
            <img src="/i/add.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'addRole'])}">добавить</a></td>
    </tr>

{if $userRoleList!==false}
    {foreach from=$userRoleList item=role}
        <tr>
            <td class="ttovar"><img src="/i/group.png"/>&nbsp;{$role->rtitle}</td>
            <td class="ttovar">{$role->title}</td>
            <td class="tedit"><img src="/i/comanda.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'showRoleAcl', 'idRole' => $role->id])}">права</a></td>
            <td class="tedit">
                <img src="/i/edit.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'editRole', 'id' => $role->id])}">редактировать</a><br/>
                <img src="/i/delete.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'deleteRole', 'id' => $role->id])}" onclick="return confirmDelete('{$role->rtitle}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}
</table>