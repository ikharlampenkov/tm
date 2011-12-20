{if $taskList!==false}
    {foreach from=$taskList item=task}
        {if_object_allowed type="{$controller|capitalize}" object="{$task}"}
        <li id="task_{$task->id}" class="task_list">
            <div class="task_block">

                <div class="task_title">
                    <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                    <a href="javascript:void(0)" onclick="
                        {if !$task->hasParent()|| $task->getChild()}
                            task.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});
                        {else}
                            {if_allowed resource="{$controller}/edit"}
                                {if_object_allowed type="{$controller|capitalize}" object="{$task}" priv="write"}
                                        task.editDialog('{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');
                                {/if_object_allowed}
                            {/if_allowed}
                            {if_allowed resource="{$controller}/view"}
                            task.viewTask('{$this->url(['controller' => $controller, 'action' => 'view', 'id' => $task->id])}', {$task->id});
                            {/if_allowed}
                        {/if}
                            " class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}task_green{elseif $task->getIsOver()}task_red{else}task_gray{/if}">{$task->title}</a>
                </div>


                <div class="task_action">
                    {if_allowed resource="{$controller}/showDiscussion"}
                        <a href="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id])}"><img src="/i/discussion_mini.png" alt="обсуждение" title="обсуждение" border="0"/></a>
                    {/if_allowed}
                    {if_allowed resource="{$controller}/showAcl"}
                        &nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'showAcl', 'idTask' => $task->id])}"><img src="/i/comanda.png" alt="права" title="права" border="0"/></a>
                    {/if_allowed}
                    {if_allowed resource="{$controller}/view"}
                        &nbsp;<a href="javascript:void(0)" onclick="task.viewTask('{$this->url(['controller' => $controller, 'action' => 'view', 'id' => $task->id])}', {$task->id});"><img src="/i/task.png" alt="просмотреть" title="просмотреть" border="0"/></a>
                    {/if_allowed}
                    {if_allowed resource="{$controller}/add"}
                        &nbsp;<a href="javascript:void(0)" onclick="task.addDialog('{$this->url(['controller' => $controller, 'action' => 'add', 'parent' => {$task->id}])}', {$task->id}, '{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => {$task->id}])}');"><img src="/i/add.png" alt="добавить задачу" title="добавить задачу" border="0"/></a>
                    {/if_allowed}
                    {if_allowed resource="{$controller}/edit"}
                        {if_object_allowed type="{$controller|capitalize}" object="{$task}" priv="write"}
                            &nbsp;<a href="javascript:void(0)" onclick="task.editDialog('{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');"><img src="/i/edit.png" alt="редактировать" title="редактировать" border="0"/></a>
                        {/if_object_allowed}
                    {/if_allowed}
                    {if_allowed resource="{$controller}/delete"}
                        &nbsp;<a href="javascript:void(0)" onclick="task.deleteDialog('{$task->title}', '{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');" style="color: #830000"><img src="/i/delete.png" alt="удалить" title="удалить" border="0"/></a>
                    {/if_allowed}

                    {*
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
                    *}
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
                        <img src="/i/is_complite.png" title="Выполненных" alt="Выполненных"/>&nbsp;{$stat.is_complite}
                        <img src="/i/task.png" title="Не выполненных" alt="Не выполненных">&nbsp;{$stat.is_do}
                        <img src="/i/is_out.png" title="Просроченных" alt="Просроченных"/>&nbsp;{$stat.is_out}
                        <img src="/i/is_problem.png" title="Возникли вопросы" alt="Возникли вопросы"/>&nbsp;{$stat.is_problem}
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