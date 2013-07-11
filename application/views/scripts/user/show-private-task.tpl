<div style="background-color:#f0f0f0; padding:5px;">
    <h1>Задачи пользователя
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

<ul>
    <li class="task_list">
        <div class="task_block_title">
            <div class="task_title">
                Название
            </div>
            <div class="task_deadline">
                Выполнить до
            </div>
            <div class="task_deadline">
                Приоритет
            </div>
        </div>
    </li>
</ul>

<ul id="subtask_0">
{if $taskList!==false}
    {foreach from=$taskList item=task}
        {if_object_allowed type="Task" object="{$task}" priv="executant"}
            <li id="task_{$task->id}" class="task_list">
                <div class="task_block">

                    <div class="task_title">
                        <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                        <a href="javascript:void(0)" onclick="
                            {if_allowed resource="task/edit"}
                                {if_object_allowed type="Task" object="{$task}" priv="write"}
                                        task.editDialog('{$this->url(['controller' => 'task', 'action' => 'edit', 'id' => $task->id])}', 0, '{$this->url(['controller' => $controller, 'action' => 'showPrivateTask', 'parent' => 0, 'userId' => $user->id])}');
                                {/if_object_allowed}
                            {/if_allowed}
                            {if_allowed resource="task/view"}
                                    task.viewTask('{$this->url(['controller' => 'task','action' => 'view', 'id' => $task->id])}', {$task->id});
                            {/if_allowed}

                                " class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}task_green{elseif $task->getIsOver()}task_red{else}task_gray{/if}">{$task->title}</a>
                    </div>

                    <div class="task_deadline">
                        {if $task->searchAttribute('deadline')}
                            {$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}
                            {else}&nbsp;
                        {/if}
                    </div>

                    <div class="task_deadline">
                        {if $task->searchAttribute('prior')}
                            {$task->getAttribute('prior')->value}
                            {else}&nbsp;
                        {/if}
                    </div>

                </div>
            </li>
            <ul id="subtask_{$task->id}" class="task_subtask"></ul>
        {/if_object_allowed}
    {/foreach}
{/if}
</ul>