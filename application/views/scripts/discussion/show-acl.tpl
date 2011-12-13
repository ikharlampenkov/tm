<div style="background-color:#f0f0f0; padding:5px;"><h1>Права для обсуждения {$discussion->title} <a href="{$this->url(['controller' => $controller, 'action'=> 'index'])}">Все обсуждения</a></h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller, 'action' => 'showAcl', 'idDiscussion' => $discussion->id])}" method="post">
<table width="100%">
   <tr>
       <td class="ttovar_title">Пользователь</td>
       <td class="ttovar" style="width: 90px;">Чтение</td>
       <td class="ttovar" style="width: 90px;">Запись</td>
       <td class="ttovar"></td>
   </tr>

{if $userList!==false}
    {foreach from=$userList item=user}
        <tr>
            <td class="ttovar_title">{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}{$user->login}{/if}</td>
            <td class="ttovar"><input type="checkbox" name="data[{$user->id}][is_read]" {if isset($discussionAcl[{$user->id}]) && $discussionAcl[{$user->id}]->isRead}checked="checked"{/if} /></td>
            <td class="ttovar"><input type="checkbox" name="data[{$user->id}][is_write]" {if isset($discussionAcl[{$user->id}]) && $discussionAcl[{$user->id}]->isWrite}checked="checked"{/if} /></td>
            <td class="ttovar"></td>
        </tr>
    {/foreach}
{/if}

</table>
        <input id="save" name="save" type="submit" value="Сохранить"/>
</form>