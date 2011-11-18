<h1>Редактировать пользователя</h1>

<form action="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $user->id])}" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Логин</td>
            <td class="ttovar"><input name="data[login]" value="{$user->login}"/></td>
        </tr>
        <tr>
            <td class="ttovar">Пароль</td>
            <td class="ttovar"><input name="data[password]" value="{$user->password}"/></td>
        </tr>
        <tr>
            <td class="ttovar">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="{$user->datecreate}"/></td>
        </tr>
        <tr>
            <td class="ttovar">Роль</td>
            <td class="ttovar"><select name="data[role_id]">
            {foreach from=$userRoleList item=role}
                <option value="{$role->id}" {if $user->role->id==$role->id}selected="selected"{/if}>{$role->title}</option>
            {/foreach}
            </select>
            </td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>