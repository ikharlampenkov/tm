<div style="background-color:#f0f0f0; padding:5px;">
    <h1>Права для пользователя
    {if $user->searchAttribute('name')}
        {$user->getAttribute('name')->value}
        {else}
        {$user->login}
    {/if}
        <a href="{$this->url(['controller' => $controller, 'action'=> 'index'])}">Все пользователи</a></h1>
</div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<table width="100%">
    <tr>
        <td class="ttovar">Задача</td>
        <td class="ttovar">Чтение</td>
        <td class="ttovar">Запись</td>
        <td class="ttovar">Исполнитель</td>
        <td class="ttovar">Ответсвенный</td>
        <td class="ttovar">Создатель</td>
    </tr>

{if $taskList !== false}
    {foreach from=$taskList item=task}
        <tr>
            <td class="ttovar">{$task->title}</td>
            <td class="ttovar"><input type="checkbox" name="data[{$task->id}][is_read]" {if $task->isRead($user)}checked="checked" {/if} /></td>
            <td class="ttovar"><input type="checkbox" name="data[{$task->id}][is_write]" {if $task->isWrite($user)}checked="checked" {/if} /></td>
            <td class="ttovar">
                <input type="checkbox" name="data[{$task->id}][is_executant]"
                    {if count($task->getExecutant())>0}
                        {foreach from=$task->getExecutant() item=iuser}
                       {if $iuser->id===$user->id}checked="checked" {/if}
                        {/foreach}
                        {else}&nbsp;
                    {/if}
                        />
            </td>
            <td class="ttovar">
                <input type="checkbox" name="data[{$task->id}][is_responsible]"
                {if $task->searchAttribute('who_responsible') && $task->getAttribute('who_responsible')->value!='-'}
                    {assign var="who_responsible" value=TM_User_User::getInstanceById($task->getAttribute('who_responsible')->value)}
                    {if $who_responsible->id==$user->id}
                       checked="checked"
                    {/if}
                {/if}
                />
            </td>
            <td class="ttovar"><input type="checkbox" name="data[{$task->id}][is_owner]" {if $task->user->id==$user->id}checked="checked"{/if} /></td>
        </tr>
    {/foreach}
{/if}

</table>