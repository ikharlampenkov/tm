{if $taskList!==false}
    {foreach from=$taskList item=task}
    <li id="task_{$task->id}" class="task_list">
        <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 45px; margin: 0px; 5px;" class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">

            <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                <a href="javascript:void(0)" onclick="
                    {if !$task->hasParent()|| $task->getChild()}
                            reports.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});
                        {else}
                        {if_allowed resource="task/edit"}
                            {if_object_allowed type="{$controller|capitalize}" object="{$task}" priv="write"}
                                    task.editDialog('{$this->url(['controller' => 'task','action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');
                            {/if_object_allowed}
                        {/if_allowed}
                        {if_allowed resource="task/view"}
                                task.viewTask('{$this->url(['controller' => 'task', 'action' => 'view', 'id' => $task->id])}', {$task->id});
                        {/if_allowed}
                    {/if}
                        ">{$task->title}</a>
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
    {/foreach}
{/if}