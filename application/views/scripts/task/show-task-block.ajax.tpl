{if $taskList!==false}
    {foreach from=$taskList item=task}
        {if_object_allowed type="{$controller|capitalize}" object="{$task}"}
        <li id="task_{$task->id}" class="task_list">
            <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">

                <div style="width: 500px; float:left; margin-left: 5px;">
                    <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                    <a href="javascript:void(0)" onclick="task.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});">{$task->title}</a>
                </div>


                <div style="width: 120px; float:right;">
                    <button>Действия</button>
                    <ul id="task_action_{$task->id}" class="task_action_menu">
                        {if_allowed resource="{$controller}/showDiscussion"}
                            <li class="action"><img src="/i/discussion_mini.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id])}">обсуждение</a></li>
                        {/if_allowed}

                        {if_allowed resource="{$controller}/showAcl"}
                            <li class="action"><img src="/i/comanda.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'showAcl', 'idTask' => $task->id])}">права</a></li>
                        {/if_allowed}


                        {if_allowed resource="{$controller}/view"}
                            <li class="action"><img src="/i/task.png"/>&nbsp;<a href="javascript:void(0)" onclick="task.viewTask('{$this->url(['controller' => $controller, 'action' => 'view', 'id' => $task->id])}', {$task->id});">просмотреть</a></li>
                        {/if_allowed}

                        {if_allowed resource="{$controller}/add"}
                            <li class="action"><img src="/i/add.png"/>&nbsp;<a href="javascript:void(0)" onclick="task.addDialog('{$this->url(['controller' => $controller,'action' => 'add', 'parent' => {$task->id}])}', {$task->id}, '{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => {$task->id}])}');">добавить задачу</a></li>
                        {/if_allowed}

                        {if_allowed resource="{$controller}/edit"}
                            {if_object_allowed type="{$controller|capitalize}" object="{$task}" priv="write"}
                                <li class="action"><img src="/i/edit.png"/>&nbsp;<a href="javascript:void(0)" onclick="task.editDialog('{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');">редактировать</a></li>
                            {/if_object_allowed}
                        {/if_allowed}

                        {if_allowed resource="{$controller}/delete"}
                            <li class="action"><img src="/i/delete.png"/>&nbsp;<a href="javascript:void(0)" onclick="task.deleteDialog('{$task->title}', '{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');" style="color: #830000">удалить</a></li>
                        {/if_allowed}

                    </ul>
                </div>

                <div style="width: 120px; float:right;">
                    {if $task->searchAttribute('deadline')}
                        {$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}
                        {else}&nbsp;
                    {/if}
                </div>

                <div style="width: 200px; float: right;">
                    {if !$task->hasParent()|| $task->getChild()}
                        {assign var="stat" value=$task->getTaskStatistic()}
                        <img src="/i/is_complite.png" title="Выполненных" alt="Выполненных"/>&nbsp;{$stat.is_complite}
                        <img src="/i/task.png" title="Не выполненных" alt="Не выполненных">&nbsp;{$stat.is_do}
                        <img src="/i/is_out.png" title="Просроченных" alt="Просроченных"/>&nbsp;{$stat.is_out}
                        <img src="/i/is_problem.png" title="Проблемные" alt="Проблемные"/>&nbsp;{$stat.is_problem}
                        <img src="/i/discussion_mini.png" title="Кол-во комментариев" alt="Кол-во комментариев"/>&nbsp;{$stat.discuss_count}
                        <img src="/i/in_doc.png" title="Кол-во документов" alt="Кол-во документов"/>&nbsp;{$stat.doc_count}
                        {else}&nbsp;
                    {/if}
                </div>

            </div>
        </li>
        <ul id="subtask_{$task->id}" style="display: none; margin-left: 20px;"></ul>
        {/if_object_allowed}
    {/foreach}
{/if}