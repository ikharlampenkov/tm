<h1>Добавить пользователя</h1>

{if isset($exception_msg)}
    <div>Ошибка: {$exception_msg}</div>
    <br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'add'])}" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Логин</td>
            <td class="ttovar"><input type="text" name="data[login]" value="{$user->login}"/></td>
        </tr>
        <tr>
            <td class="ttovar">Пароль</td>
            <td class="ttovar"><input type="text" name="data[password]" value="{$user->password}"/></td>
        </tr>
        <tr>
            <td class="ttovar">Дата создания</td>
            <td class="ttovar"><input type="text" name="data[date_create]" value="{$smarty.now|date_format:"%d.%m.%Y %H:%M:%S"}" class="datepicker"/></td>
        </tr>
        <tr>
            <td class="ttovar">Роль</td>
            <td class="ttovar"><select name="data[role_id]">
                    {foreach from=$userRoleList item=role}
                        <option value="{$role->id}">{$role->rtitle}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar">Тип пользователя</td>
            <td class="ttovar"><select name="data[type]">
                    <option value="administrator" {if $user->type == 'administrator'}selected="selected"{/if}>Работник</option>
                    <option value="client" {if $user->type == 'client'}selected="selected"{/if}>Клиент</option>
                </select>
            </td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>