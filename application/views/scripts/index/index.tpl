{*{$this->action('index', 'task')}*}

<table>
<tr>
    <td style="width: 49%">
    {if_allowed resource="{$controller}/index" priv="show-my-task"}
        <div class="index_block">
            <div class="index_block_title" style="">
                <span style="vertical-align: middle;">Мои задачи</span>
            </div>
            <div class="index_block_content">

                <ul id="task_subtask_0">
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
                                                        {if_object_allowed type="{$controller|capitalize}" object="{$task}" priv="write"}
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
                </ul>


            </div>
        </div>
    {/if_allowed}
    </td>
    <td style="width: 50%;">
    {if_allowed resource="{$controller}/index" priv="show-my-discussion"}
        <div class="index_block">
            <div class="index_block_title" style="">
                <span style="vertical-align: middle;">Сообщения и заявки</span>
            </div>
            <div class="index_block_content">

                {assign var="openul" value=false}

            <ul id="comment-list" style="padding: 0; margin: 0;">
                {if $discussionList!==false}
                    {foreach from=$discussionList item=discussion}
                        {if !$discussion->hasParent() && $openul}</ul>{assign var="openul" value=false}{/if}
                        {if $discussion->hasParent() && !$openul}
                        <ul class="discussion_submessage">{assign var="openul" value=true}{/if}
                        <li class="discussion_list">
                            <div class="discussion_block">
                                <div id="message_{$discussion->id}" class="{if $discussion->isRequest && !$discussion->isComplete}discussion_message_request{else}discussion_message{/if}">{$discussion->message}</div>
                                {if count($discussion->document) > 0}
                                    <div>
                                        <ul>
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
                                <div class="discussion_info">
                                    {if $discussion->user->searchAttribute('name')}{$discussion->user->getAttribute('name')->value}{else}{$discussion->user->login}{/if} {$discussion->datecreate|date_format:"%d.%m.%Y"}
                                    <button onclick="comment_reply_on2({$discussion->id}, {$discussion->user->id}, {$discussion->getTask()->id});">Ответить</button>
                                    {if $discussion->isRequest}{if $discussion->isComplete}<img src="/i/is_complite.png" title="Выполнена" alt="Выполнена" border="0"/>{elseif $discussion->user->id==$authUserId}<button onclick="comment_complete_rq('{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id, 'is_complete' => $discussion->id])}');">Завершить</button>{/if}{/if}
                                    {if $discussion->user->id==$authUserId}<button onclick="comment_complete_rq('{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id, 'delete' => $discussion->id])}');">удалить</button> {/if}
                                </div>
                            </div>
                        </li>
                    {/foreach}
                {/if}
            </ul>

                <div id="replay_form" style="display: none;">
                    <form action="{$this->url(['controller' => $controller, 'action' => 'index'])}" method="post" enctype="multipart/form-data">
                        <div>
                            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">
                                Ответить на <span id="replay_on_message"></span>
                            </div>
                            <textarea name="data[message]"></textarea><br/>

                            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Загрузить документ</div>
                            <div>
                                Название документа&nbsp;<input name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                                <input type="file" name="file" style="width: 300px;"/>
                            </div>
                            <input type="hidden" name="data[parent]" value="" id="parent"/>
                            <input type="hidden" name="data[to]" value="" id="to_user">
                            <input type="hidden" name="data[task]" value="" id="to_task">
                            <input id="save" name="save" type="submit" value="Отправить"/>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    {/if_allowed}
    </td>
</tr>
<tr>
    <td colspan="2">
    {if_allowed resource="{$controller}/index" priv="show-my-reports"}
        <div class="index_block">
            <div class="index_block_title" style="">
                <span style="vertical-align: middle;">Отчет</span>
            </div>
            <div class="index_block_content">

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
                    {if $taskListReports!==false}
                        {foreach from=$taskListReports item=task}
                            <li id="task_{$task->id}" class="task_list">
                                <div class="task_block">

                                    <div class="task_title">
                                        <img src="/i/{if !$task->hasParent()|| $task->getChild()}task_group.png{else}task.png{/if}"/>&nbsp;
                                        <a href="javascript:void(0)" onclick="
                                            {if !$task->hasParent()|| $task->getChild()}
                                                    reports.openTask('{$this->url(['controller' => 'reports','action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id});
                                                {else}
                                                {if_allowed resource="task/edit"}
                                                    {if_object_allowed type="Task" object="{$task}" priv="write"}
                                                            task.editDialog('{$this->url(['controller' => 'task','action' => 'edit', 'id' => $task->id])}', {if !$task->hasParent()}0{else}{$task->getFirstParent()->id}{/if}, '{if !$task->hasParent()}{$this->url(['controller' => 'reports', 'action' => 'showTaskBlock', 'parent' => 0])}{else}{$this->url(['controller' => $controller,'action' => 'showTaskBlock', 'parent' => $task->getFirstParent()->id])}{/if}');
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
                                            <a href="javascript:void(0);" onclick="reports.openTask('{$this->url(['controller' => 'reports', 'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Выполнена');"><img src="/i/is_complite.png" title="Выполненных" alt="Выполненных" border="0"/>&nbsp;{$stat.is_complite}</a>
                                            <a href="javascript:void(0);" onclick="reports.openTask('{$this->url(['controller' => 'reports', 'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Не выполнена');"><img src="/i/task.png" title="Не выполненных" alt="Не выполненных" border="0">&nbsp;{$stat.is_do}</a>
                                            <a href="javascript:void(0);" onclick="reports.openTask('{$this->url(['controller' => 'reports', 'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Не выполнена');"><img src="/i/is_out.png" title="Просроченных" alt="Просроченных" border="0"/>&nbsp;{$stat.is_out}</a>
                                            <a href="javascript:void(0);" onclick="reports.openTask('{$this->url(['controller' => 'reports', 'action' => 'showTaskBlock', 'parent' => $task->id])}', {$task->id}, true, '', 'Возникли вопросы');"><img src="/i/is_problem.png" title="Возникли вопросы" alt="Возникли вопросы" border="0"/>&nbsp;{$stat.is_problem}</a>

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