<div style="background-color:#f0f0f0; padding:5px;"><h1>ПОЛЬЗОВАТЕЛИ</h1></div><br/>


{if $action=="add" || $action=="edit"}

    <h1>{$txt}</h1>

    <form action="?page={$page}&action={$action}{if $action=="edit"}&login={$user.login}{/if}" method="post">
        <table width="100%">
            <tr>
                <td class="ttovar"  width="200">Логин</td>
                <td class="ttovar" ><input name="data[login]" value="{$user.login}"  /></td>
            </tr>
            <tr>
                <td class="ttovar" >Пароль</td>
                <td class="ttovar"><input name="data[password]" value="{$user.password}" /></td>
            </tr>
            <tr>
                <td class="ttovar" >Роль</td>
                <td class="ttovar"><select name="data[role]" >
                        {foreach from=$role_list item=role}
                            <option value="{$role}" {if isset($user) && $user.role==$role}selected="selected"{/if}>{$role}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
        </table>
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if $user_list!==false}
        <table width="100%">
        <tr>
                    <td class="ttovar" align="center" colspan="3"><a href="?page={$page}&action=add">добавить</a></td></tr>
            {foreach from=$user_list item=user}
                <tr>
                    <td class="ttovar" >{$user.login}</td>
                    <td class="ttovar" >{$user.role}</td>
                    <td class="tedit" ><a href="?page={$page}&action=edit&login={$user.login}">редактировать</a><br />
                                       <a href="?page={$page}&action=del&login={$user.login}" onclick="return confirmDelete('{$user.login}');" style="color: #830000">удалить</a> </td>
                </tr>
            {/foreach}
        </table>
    {/if}

    

{/if}