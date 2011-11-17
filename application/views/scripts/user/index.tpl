<div style="background-color:#f0f0f0; padding:5px;"><h1>Пользователи</h1></div><br/>

{if $userList!==false}
<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="?page=&action=add">добавить</a></td>
    </tr>

    {foreach from=$userList item=user}
        <tr>
            <td class="ttovar">{$user->login}</td>
            <td class="ttovar">{$user->role->title}</td>
            <td class="tedit"><a href="?page=&action=edit&login={$user->id}">редактировать</a><br/>
                <a href="?page=&action=del&login={$user->id}" onclick="return confirmDelete('{$user->id}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}

</table>
{/if}