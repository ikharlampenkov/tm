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
