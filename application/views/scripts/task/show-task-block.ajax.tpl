{if $taskList!==false}
    {foreach from=$taskList item=task}
        {if_object_allowed type="{$controller|capitalize}" object="{$task}"}
            <li id="task_{$task->id}" style="list-style: none;">
                <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">

                    <div style="width: 500px; float:left; margin-left: 5px;">
                        <a href="#" onclick="task.openTask('{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});">{$task->title}</a>
                    </div>


                    <div style="width: 250px; float:right;">
                        {if_allowed resource="{$controller}/showDiscussion"}
                            <a href="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id])}">обсуждение</a>
                        {/if_allowed}

                        {if_allowed resource="{$controller}/showAcl"}
                            <a href="{$this->url(['controller' => $controller,'action' => 'showAcl', 'idTask' => $task->id])}">права</a>
                        {/if_allowed}


                        {if_allowed resource="{$controller}/view"}
                            <a href="{$this->url(['controller' => $controller,'action' => 'view', 'id' => $task->id])}">просмотреть</a>
                        {/if_allowed}

                        {if_allowed resource="{$controller}/edit"}
                            {if_object_allowed type="{$controller|capitalize}" object="{$task}" priv="write"}
                                <a href="#" onclick="task.editDialog('{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');">редактировать</a>
                            {/if_object_allowed}
                        {/if_allowed}

                        {if_allowed resource="{$controller}/delete"}
                            <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $task->id])}" onclick="return confirmDelete('{$task->title}');" style="color: #830000">удалить</a>
                        {/if_allowed}

                    </div>

                    <div style="width: 120px; float:right;">
                        {if $task->searchAttribute('deadline')}
                            {$task->getAttribute('deadline')->value|date_format:"%d %B %Y"}
                            {else}&nbsp;
                        {/if}
                    </div>

                </div>
            </li>
            <ul id="subtask_{$task->id}" style="display: none; margin-left: 20px;"></ul>
        {/if_object_allowed}
    {/foreach}
{/if}