{if $taskList!==false}
    {foreach from=$taskList item=task}
        {if_object_allowed type="Task" object="{$task}" priv="executant"}
        <li id="task_task_{$task->id}" class="task_list">
            <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">

                <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                    <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                    <a href="javascript:void(0)" onclick="
                        {if !$task->hasParent()|| $task->getChild()}
                                task.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});
                            {else}
                            {if_allowed resource="task/edit"}
                                {if_object_allowed type="{$controller|capitalize}" object="{$task}" priv="write"}
                                        task.editDialog('{$this->url(['controller' => 'task', 'action' => 'edit', 'id' => $task->id])}', 0, '{$this->url(['controller' => $controller, 'action' => 'showTaskBlock', 'parent' => 0])}', 'task_');
                                {/if_object_allowed}
                            {/if_allowed}
                            {if_allowed resource="task/view"}
                                    task.viewTask('{$this->url(['controller' => 'task','action' => 'view', 'id' => $task->id])}', {$task->id});
                            {/if_allowed}
                        {/if}

                            ">{$task->title}</a>
                </div>

                <div style="width: 120px; float:right;">
                    {if $task->searchAttribute('deadline')}
                        {$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}
                        {else}&nbsp;
                    {/if}
                </div>

            </div>
        </li>
        <ul id="task_subtask_{$task->id}" style="display: none; margin-left: 20px;"></ul>
        {/if_object_allowed}
    {/foreach}
{/if}