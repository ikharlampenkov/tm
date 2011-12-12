<div class="page"><h1>Отчет</h1></div><br/>

<ul>
    <li class="task_list">
        <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="ttovar">
            <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                Задача
            </div>

            <div style="width: 120px; float: right;">
                Кто поставил
            </div>
            <div style="width: 120px; float: right;">
                Кто принял
            </div>
            <div style="width: 120px; float: right;">
                Ответственный
            </div>
            <div style="width: 120px; float: right;">
                Исполнитель
            </div>
            <div style="width: 120px; float: right;">
                Осталось
            </div>
            <div style="width: 120px; float: right;">
                Затрачено
            </div>
            <div style="width: 120px; float: right;">
                Выполнить до
            </div>
            <div style="width: 120px; float: right;">
                Дата добавления
            </div>

        </div>
    </li>
</ul>

<ul id="subtask_0">
{if $taskList!==false}
    {foreach from=$taskList item=task}
        <li id="task_{$task->id}" class="task_list">
            <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">

                <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                    <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                    <a href="javascript:void(0)" onclick="reports.openTask('{$this->url(['controller' => $controller, 'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});">{$task->title}</a>
                </div>


                <div style="width: 120px; float:right;">
                    {if $task->searchAttribute('who_set') && $task->getAttribute('who_set')->value!='-'}
                        {assign var="who_set" value=TM_User_User::getInstanceById($task->getAttribute('who_set')->value)}
                        {if $who_set->searchAttribute('name')}
                            {$who_set->getAttribute('name')->value}
                            {else}
                            {$who_set->login}
                        {/if}
                        {else}&nbsp;
                    {/if}
                </div>

                <div style="width: 120px; float: right;">
                    {if $task->searchAttribute('who_adopted') && $task->getAttribute('who_adopted')->value!='-'}
                        {assign var="who_adopted" value=TM_User_User::getInstanceByLogin($task->getAttribute('who_adopted')->value)}
                        {if $who_adopted->searchAttribute('name')}
                            {$who_adopted->getAttribute('name')->value}
                            {else}
                            {$who_adopted->login}
                        {/if}
                        {else}&nbsp;
                    {/if}
                </div>


                <div style="width: 120px; float: right;">
                    {if $task->searchAttribute('who_responsible') && $task->getAttribute('who_responsible')->value!='-'}
                        {assign var="who_responsible" value=TM_User_User::getInstanceById($task->getAttribute('who_responsible')->value)}
                        {if $who_responsible->searchAttribute('name')}
                            {$who_responsible->getAttribute('name')->value}
                            {else}
                            {$who_responsible->login}
                        {/if}
                        {else}&nbsp;
                    {/if}
                </div>

                <div style="width: 120px; float: right;">
                    {if count($task->getExecutant())>0}
                        {foreach from=$task->getExecutant() item=user}
                            <div>{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}{$user->login}{/if}{if $user->searchAttribute('position') && $user->getAttribute('position')->value != ''}, {$user->getAttribute('position')->value}{/if}
                            </div>
                        {/foreach}
                        {else}&nbsp;
                    {/if}
                </div>

                <div style="width: 120px; float: right;">
                    {if $task->getLeftTime() != 0}
                        {$task->getLeftTime()|date_format:"%d"}
                        {else}0
                    {/if} дней
                </div>

                <div style="width: 120px; float: right;">
                    {$task->getExecuteTime()|date_format:"%d"} дней
                </div>

                <div style="width: 120px; float:right;">
                    {if $task->searchAttribute('deadline')}
                        {$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}
                        {else}&nbsp;
                    {/if}
                </div>

                <div style="width: 120px; float: right;">
                    {$task->datecreate|date_format:"%d.%m.%Y"}
                </div>

            </div>
        </li>
        <ul id="subtask_{$task->id}" style="display: none; margin-left: 20px;"></ul>
    {/foreach}
{/if}
</ul>