<div class="page"><h1>Добавить {if !$task->hasParent()}проект{else}задачу{/if}</h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'add'])}" method="post">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input name="data[title]" value="{$task->title}"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Супер задача</td>
            <td class="ttovar"><select name="data[parentTask]">
                <option value="">--</option>
            {if !empty($parentList)}
                {foreach from=$parentList item=parent}
                    <option value="{$parent->id}" {if $task->searchParent($parent) !== false }selected="selected"{/if}>{$parent->title}</option>
                    {if $parent->getChild()}
                    {include file="task/parent-block.tpl" subtask=$parent->getChild() task=$task wid="--"}
                    {/if}
                {/foreach}
            {/if}
            </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="{$task->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>