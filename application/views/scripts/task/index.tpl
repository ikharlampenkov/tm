<div class="page"><h1>Задачи</h1></div><br/>

{if $taskList!==false}
<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить</a></td>
    </tr>

    {foreach from=$taskList item=task}
        <tr>
            <td class="ttovar">{$task->title}</td>
            <td class="ttovar">{$task->datecreate|date_format:"%d.%m.%Y"}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $task->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $task->id])}" onclick="return confirmDelete('{$task->id}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}

</table>
{else}
<a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить</a>
{/if}