{if $taskList!==false}
    {foreach from=$taskList item=task}
        {if_object_allowed type="Task" object="{$task}" priv="executant"}
        <li id="task_task_{$task->id}" class="task_list">
            <div class="task_block">

                <div class="task_title">
                    <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                    <a href="javascript:void(0)" onclick="
                        {if !$task->hasParent()|| $task->getChild()}
                                task.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});
                            {else}
                            {if_allowed resource="task/edit"}
                                {if_object_allowed type="Task" object="{$task}" priv="write"}
                                        task.editDialog('{$this->url(['controller' => 'task', 'action' => 'edit', 'id' => $task->id])}', 0, '{$this->url(['controller' => $controller, 'action' => 'showTaskBlock', 'parent' => 0])}', 'task_');
                                {/if_object_allowed}
                            {/if_allowed}
                            {if_allowed resource="task/view"}
                                    task.viewTask('{$this->url(['controller' => 'task','action' => 'view', 'id' => $task->id])}', {$task->id});
                            {/if_allowed}
                        {/if}

                            " class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}task_green{elseif $task->getIsOver()}task_red{else}task_gray{/if}">{$task->title}</a>
                </div>

                <div class="task_deadline">
                    {if $task->searchAttribute('deadline')}
                        {$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}
                        {else}&nbsp;
                    {/if}
                </div>

            </div>
        </li>
        <ul id="task_subtask_{$task->id}" class="task_subtask"></ul>
        {/if_object_allowed}
    {/foreach}
{/if}