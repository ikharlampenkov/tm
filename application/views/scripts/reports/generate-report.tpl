<div class="page"><h1>Отчет</h1></div><br/>

<div class="sub-menu">
    <img src="/i/printer.png"/>&nbsp;<a href="javascript:window.open('{$this->url(['controller' => $controller,'action' => 'print'])}','','…');" onclick="">печать</a>
</div>

<ul>
    <li class="task_list">
        <div class="task_block_title">
            <div class="task_title">
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
            <div style="width: 75px; float: right;">
                Осталось
            </div>
            <div style="width: 75px; float: right;">
                Затрачено
            </div>
            <div class="task_deadline">
                Выполнить до
            </div>
            <div style="width: 120px; float: right;">
                Дата добавления
            </div>
            <div class="task_statistic">
                &nbsp;
            </div>

        </div>
    </li>
</ul>

<ul id="subtask_0">
{if $taskList!==false}
    {foreach from=$taskList item=task}
        <li id="task_{$task->id}" class="task_list">
            <div class="task_block">

                <div class="task_title">
                    <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                    <a href="javascript:void(0)" onclick="
                        {if !$task->hasParent()|| $task->getChild()}
                                reports.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});
                            {else}
                            {if_allowed resource="task/edit"}
                                {if_object_allowed type="Task" object="{$task}" priv="write"}
                                        task.editDialog('{$this->url(['controller' => 'task','action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');
                                {/if_object_allowed}
                            {/if_allowed}
                            {if_allowed resource="task/view"}
                                    task.viewTask('{$this->url(['controller' => 'task', 'action' => 'view', 'id' => $task->id])}', {$task->id});
                            {/if_allowed}
                        {/if}
                            " class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}task_green{elseif $task->getIsOver()}task_red{else}task_gray{/if}">{$task->title}</a>
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
                            <div>{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}{$user->login}{/if}{if $user->searchAttribute('position') && $user->getAttribute('position')->value != ''}, {$user->getAttribute('position')->value}{/if}</div>
                        {/foreach}
                        {else}&nbsp;
                    {/if}
                </div>

                <div style="width: 75px; float: right;">
                    {if $task->getLeftTime() != 0}
                        {$task->getLeftTime()|date_format:"%d"}
                        {else}0
                    {/if} дней
                </div>

                <div style="width: 75px; float: right;">
                    {$task->getExecuteTime()|date_format:"%d"} дней
                </div>

                <div class="task_deadline">
                    {if $task->searchAttribute('deadline')}
                        {$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}
                        {else}&nbsp;
                    {/if}
                </div>

                <div style="width: 120px; float: right;">
                    {$task->datecreate|date_format:"%d %B %Y"}
                </div>

                <div class="task_statistic">
                    {if !$task->hasParent()|| $task->getChild()}
                        {assign var="stat" value=$task->getTaskStatistic()}
                        <a href="javascript:void(0);" onclick="reports.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Выполнена');"><img src="/i/is_complite.png" title="Выполненных" alt="Выполненных" border="0"/>&nbsp;{$stat.is_complite}</a>
                        <a href="javascript:void(0);" onclick="reports.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Не выполнена');"><img src="/i/task.png" title="Не выполненных" alt="Не выполненных" border="0">&nbsp;{$stat.is_do}</a>
                        <a href="javascript:void(0);" onclick="reports.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Не выполнена');"><img src="/i/is_out.png" title="Просроченных" alt="Просроченных" border="0"/>&nbsp;{$stat.is_out}</a>
                        <a href="javascript:void(0);" onclick="reports.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Возникли вопросы');"><img src="/i/is_problem.png" title="Возникли вопросы" alt="Возникли вопросы" border="0"/>&nbsp;{$stat.is_problem}</a>

                        <img src="/i/discussion_mini.png" title="Кол-во комментариев" alt="Кол-во комментариев"/>&nbsp;{$stat.discuss_count}
                        <img src="/i/in_doc.png" title="Кол-во документов" alt="Кол-во документов"/>&nbsp;{$stat.doc_count}
                        {else}&nbsp;
                    {/if}
                </div>

            </div>
        </li>
        <ul id="subtask_{$task->id}" class="task_subtask"></ul>
    {/foreach}
{/if}
</ul>