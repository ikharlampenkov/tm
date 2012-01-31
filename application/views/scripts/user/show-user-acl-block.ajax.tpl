{if $taskList!==false}
    {foreach from=$taskList item=task}
        <li id="task_{$task->id}" class="task_list">
            <div class="task_block">

                <div class="task_title">
                    <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                    <a href="javascript:void(0)" onclick="
                        {if !$task->hasParent()|| $task->getChild()}
                                task.openTask('{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => $task->id, 'userId' => $user->id])}', {$task->id});
                            {else}
                            {if_allowed resource="task/edit"}
                                {if_object_allowed type="task" object="{$task}" priv="write"}
                                        task.editDialog('{$this->url(['controller' => 'task','action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => 0, 'userId' => $user->id])}{else}{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => $task->getFirstParent()->id, 'userId' => $user->id])}{/if}');
                                {/if_object_allowed}
                            {/if_allowed}
                        {/if}
                            " class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}task_green{elseif $task->getIsOver()}task_red{else}task_gray{/if}">{$task->title}</a>
                </div>


                <div class="task_action">
                    {if_allowed resource="task/showDiscussion"}
                        <a href="{$this->url(['controller' => 'task','action' => 'showDiscussion', 'idTask' => $task->id])}"><img src="/i/discussion_mini.png" alt="обсуждение" title="обсуждение" border="0"/></a>
                    {/if_allowed}
                    {if_allowed resource="task/view"}
                        &nbsp;<a href="javascript:void(0)" onclick="task.viewTask('{$this->url(['controller' => 'task', 'action' => 'view', 'id' => $task->id])}', {$task->id});"><img src="/i/task.png" alt="просмотреть" title="просмотреть" border="0"/></a>
                    {/if_allowed}
                    {if_allowed resource="task/add"}
                        &nbsp;<a href="javascript:void(0)" onclick="task.addDialog('{$this->url(['controller' => 'task', 'action' => 'add', 'parent' => {$task->id}])}', {$task->id}, '{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => $task->id, 'userId' => $user->id])}');"><img src="/i/add.png" alt="добавить задачу" title="добавить задачу" border="0"/></a>
                    {/if_allowed}
                    {if_allowed resource="task/edit"}
                        {if_object_allowed type="Task" object="{$task}" priv="write"}
                            &nbsp;<a href="javascript:void(0)" onclick="task.editDialog('{$this->url(['controller' => 'task','action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => 0, 'userId' => $user->id])}{else}{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => $task->getFirstParent()->id, 'userId' => $user->id])}{/if}');"><img src="/i/edit.png" alt="редактировать" title="редактировать" border="0"/></a>
                        {/if_object_allowed}
                    {/if_allowed}
                    {if !$task->hasParent()}
                        {if_allowed resource="task/toArchive"}
                            <a href="javascript:void(0)" onclick="task.toArchive('{$this->url(['controller' => 'task','action' => 'toArchive', 'idTask' => $task->id])}', 0, '{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => 0, 'userId' => $user->id])}')"><img src="/i/zip.gif" alt="в архив" title="в архив" border="0"/></a>
                        {/if_allowed}
                    {/if}
                    {if_allowed resource="task/delete"}
                        &nbsp;<a href="javascript:void(0)" onclick="task.deleteDialog('{$task->title}', '{$this->url(['controller' => 'task','action' => 'delete', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => 0, 'userId' => $user->id])}{else}{$this->url(['controller' => $controller,'action' => 'showUserAclBlock', 'parent' => $task->getFirstParent()->id, 'userId' => $user->id])}{/if}');" style="color: #830000"><img src="/i/delete.png" alt="удалить" title="удалить" border="0"/></a>
                    {/if_allowed}
                </div>

                <div class="task_deadline">
                    <input type="checkbox" name="data[{$task->id}][is_owner]" {if $task->user->id==$user->id}checked="checked"{/if} />
                </div>

                <div class="task_deadline">
                    <input type="checkbox" name="data[{$task->id}][is_responsible]"
                        {if $task->searchAttribute('who_responsible') && $task->getAttribute('who_responsible')->value!='-' && $task->getAttribute('who_responsible')->value==$user->id}
                           checked="checked"
                        {/if}
                            />
                </div>
                <div class="task_deadline">
                    <input type="checkbox" name="data[{$task->id}][is_executant]" {if $task->isExecutant($user)}checked="checked" {/if} />
                </div>
                <div class="task_deadline">
                    <input type="checkbox" name="data[{$task->id}][is_write]" {if $task->isWrite($user)}checked="checked" {/if} />
                </div>
                <div class="task_deadline">
                    <input type="checkbox" name="data[{$task->id}][is_read]" {if $task->isRead($user)}checked="checked" {/if} />
                </div>


            </div>
        </li>
        <ul id="subtask_{$task->id}" class="task_subtask"></ul>
    {/foreach}
{/if}