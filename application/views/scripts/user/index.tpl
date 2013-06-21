{*include file="organization/index.tpl"*}


<div class="page">
    <h1>Пользователи / {if $userType == 'administrator'}Работники{elseif $userType == 'client'}Клиенты{/if}</h1>

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


<div class="sub-menu">
    <img src="/i/add.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить</a>
</div>

<table width="100%">
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
            <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                <div class="btn-group">
                    <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{$this->url(['controller' => $controller,'action' => 'showPrivateTask', 'userId' => $user->id])}"><img src="/i/task.png"/>&nbsp;задачи</a></li>
                        <li><a href="{$this->url(['controller' => $controller,'action' => 'showUserAcl', 'id' => $user->id])}"><img src="/i/comanda.png"/>&nbsp;права</a></li>
                        <li><a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $user->id])}"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                        <li><a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $user->id])}" onclick="return confirmDelete('{$user->login}');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    {/foreach}
{/if}
</table>


<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Роли</h1></div><br/>

<div class="sub-menu">
    <img src="/i/add.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'addRole'])}">добавить</a>
</div>

<table width="100%">
{if $userRoleList!==false}
    {foreach from=$userRoleList item=role}
        <tr>
            <td class="ttovar"><img src="/i/group.png"/>&nbsp;{$role->rtitle}</td>
            <td class="ttovar">{$role->title}</td>
            <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                <div class="btn-group">
                    <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{$this->url(['controller' => $controller,'action' => 'showRoleAcl', 'idRole' => $role->id])}"><img src="/i/comanda.png"/>&nbsp;права</a></li>
                        <li><a href="{$this->url(['controller' => $controller,'action' => 'editRole', 'id' => $role->id])}"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                        <li><a href="{$this->url(['controller' => $controller,'action' => 'deleteRole', 'id' => $role->id])}" onclick="return confirmDelete('{$role->rtitle}');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    {/foreach}
{/if}
</table>