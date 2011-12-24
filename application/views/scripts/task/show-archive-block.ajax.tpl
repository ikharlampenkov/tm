{if $taskList!==false}
    {foreach from=$taskList item=task}
        {if_object_allowed type="{$controller|capitalize}" object="{$task}"}
        <li id="task_{$task->id}" class="task_list">
            <div class="task_block">

                <div class="task_title">
                    <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                    <a href="javascript:void(0)" id="task_info_{$task->id}"
                        {if !$task->hasParent()|| $task->getChild()}
                       onclick="task.openTask('{$this->url(['controller' => $controller,'action' => 'showArchiveBlock', 'parent' => $task->id])}', {$task->id});"
                            {else}
                       onmouseover="task.showInfo('{$this->url(['controller' => $controller, 'action' => 'info', 'id' => $task->id])}', {$task->id});"
                        {/if}

                       class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}task_green{elseif $task->getIsOver()}task_red{else}task_gray{/if}">{$task->title}</a>
                </div>


                <div class="task_action">
                    {if_allowed resource="{$controller}/view"}
                        &nbsp;<a href="javascript:void(0)" onclick="task.viewTask('{$this->url(['controller' => $controller, 'action' => 'view', 'id' => $task->id])}', {$task->id});"><img src="/i/task.png" alt="просмотреть" title="просмотреть" border="0"/></a>
                    {/if_allowed}

                    {if !$task->hasParent()}
                        {if_allowed resource="{$controller}/fromArchive"}
                            <a href="javascript:void(0)" onclick="task.fromArchive('{$this->url(['controller' => $controller,'action' => 'fromArchive', 'idTask' => $task->id])}', 0, '{$this->url(['controller' => $controller,'action' => 'showArchiveBlock', 'parent' => 0])}')"><img src="/i/zip.gif" alt="в архив" title="в архив" border="0"/></a>
                        {/if_allowed}
                    {/if}
                    &nbsp;
                </div>

                <div class="task_deadline">
                    {if $task->searchAttribute('deadline')}
                        {$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}
                        {else}&nbsp;
                    {/if}
                </div>

                <div class="task_statistic">
                    {if !$task->hasParent()|| $task->getChild()}
                        {assign var="stat" value=$task->getTaskStatistic()}
                        <a href="javascript:void(0);" onclick="task.openTask('{$this->url(['controller' => $controller,'action' => 'showArchiveBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Выполнена');"><img src="/i/is_complite.png" title="Выполненных" alt="Выполненных" border="0"/>&nbsp;{$stat.is_complite}</a>
                        <a href="javascript:void(0);" onclick="task.openTask('{$this->url(['controller' => $controller,'action' => 'showArchiveBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Не выполнена');"><img src="/i/task.png" title="Не выполненных" alt="Не выполненных" border="0">&nbsp;{$stat.is_do}</a>
                        <a href="javascript:void(0);" onclick="task.openTask('{$this->url(['controller' => $controller,'action' => 'showArchiveBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Не выполнена');"><img src="/i/is_out.png" title="Просроченных" alt="Просроченных" border="0"/>&nbsp;{$stat.is_out}</a>
                        <a href="javascript:void(0);" onclick="task.openTask('{$this->url(['controller' => $controller,'action' => 'showArchiveBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Возникли вопросы');"><img src="/i/is_problem.png" title="Возникли вопросы" alt="Возникли вопросы" border="0"/>&nbsp;{$stat.is_problem}</a>

                        <img src="/i/discussion_mini.png" title="Кол-во комментариев" alt="Кол-во комментариев"/>&nbsp;{$stat.discuss_count}
                        <img src="/i/in_doc.png" title="Кол-во документов" alt="Кол-во документов"/>&nbsp;{$stat.doc_count}
                        {else}&nbsp;
                    {/if}
                </div>

            </div>
        </li>
        <ul id="subtask_{$task->id}" class="task_subtask"></ul>
        {/if_object_allowed}
    {/foreach}
{/if}