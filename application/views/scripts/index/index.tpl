{*{$this->action('index', 'task')}*}

<table>
    <tr>
        <td style="width: 50%">
        {if_allowed resource="{$controller}/index" priv="show-my-task"}
            <div class="index_block">
                <div class="index_block_title" style="">
                    <span style="vertical-align: middle;">Мои задачи</span>
                </div>
                <div class="index_block_content">

                    <ul id="subtask_0">
                        {if $taskList!==false}
                            {foreach from=$taskList item=task}
                                {if_object_allowed type="Task" object="{$task}" priv="executant"}
                                    <li id="task_{$task->id}" class="task_list">
                                        <div style="padding: 5px 0px 5px; 5px; width: 100%; height: 30px; margin: 0px; 5px;" class="{if $task->searchAttribute('state') && $task->getAttribute('state')->value=='Выполнена'}ttovar_green{elseif $task->getIsOver()}ttovar_red{else}ttovar{/if}">

                                            <div style="width: 500px; float:left; margin-left: 5px; vertical-align: middle;">
                                                <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                                                <a href="javascript:void(0)" onclick="task.viewTask('{$this->url(['controller' => 'task','action' => 'view', 'id' => $task->id])}', {$task->id});">{$task->title}</a>
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
                    </ul>


                </div>
            </div>
        {/if_allowed}
        </td>
        <td style="width: 50%">
        {if_allowed resource="{$controller}/index" priv="show-my-discussion"}
            <div class="index_block">
                <div class="index_block_title" style="">
                    <span style="vertical-align: middle;">Личные сообщения</span>
                </div>
                <div class="index_block_content">

                    <ul id="comment-list" style="padding: 0; margin: 0;">
                        {if $discussionList!==false}
                            {foreach from=$discussionList item=discussion}
                                <li style="list-style: none; padding: 5px; background-color: #f7f7f7;">
                                    <div style="padding: 5px;">
                                        <div style="font-size: 12px; line-height: 16px;" id="message_{$discussion->id}">{$discussion->message}</div>
                                        {if count($discussion->document) > 0}
                                            <div style="">
                                                <ul style="padding: 0; margin: 0;">
                                                    {foreach from=$discussion->document item=document}
                                                        <li style="list-style: none; padding: 0px; background-color: #f7f7f7;">
                                                            <a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank" style="font-size: 11px;" id="doc_info_{$document->id}" onmouseover="doc.showInfo('{$this->url(['controller' => 'document','action' => 'view', 'id' => $document->id])}', {$document->id});">{$document->title}</a>
                                                            {if_allowed resource="document/edit"}
                                                                / <a href="{$this->url(['controller' => 'document','action' => 'edit', 'id' => $document->id])}" style="font-size: 11px;">редактировать</a>
                                                            {/if_allowed}
                                                        </li>
                                                    {/foreach}
                                                </ul>
                                            </div>
                                        {/if}
                                        <div style="color: #555555; font-size: 11px; line-height: 15px; margin: 5px 0px 0px 0px;">
                                            {if $discussion->user->searchAttribute('name')}{$discussion->user->getAttribute('name')->value}{else}{$discussion->user->login}{/if} {$discussion->datecreate|date_format:"%d.%m.%Y"}
                                        </div>
                                    </div>
                                </li>
                            {/foreach}
                        {/if}
                    </ul>


                </div>
            </div>
        {/if_allowed}
        </td>
    </tr>
    <tr>
        <td style="width: 50%">
        {if_allowed resource="{$controller}/index" priv="show-my-reports"}
            <div class="index_block">
                <div class="index_block_title" style="">
                    <span style="vertical-align: middle;">Отчет</span>
                </div>
                <div class="index_block_content">

                </div>
            </div>
        {/if_allowed}
        </td>
        <td style="width: 50%">

        </td>
    </tr>
</table>

{*
show,show-my-task,show-my-discussion,show-my-reports
*}