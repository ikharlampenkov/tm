<div class="page"><h1>Обсуждение задачи: {$task->title}</h1></div><br/>

{if $discussionList!==false}

    {assign var="openul" value=false}

<ul id="comment-list">
    {foreach from=$discussionList item=discussion}
        {if is_null($discussion->toUser) || $discussion->toUser->id==$authUserId || $discussion->user->id==$authUserId}
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
                                    {*
                                    {if_allowed resource="{$controller}/deleteLinkToDoc"}
                                        / <a href="{$this->url(['controller' => $controller,'action' => 'deleteLinkToDoc', 'id' => $task->id, 'doc_id' => $document->id])}">удалить</a>
                                    {/if_allowed}
                                    *}
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                {/if}
                <div class="discussion_info">
                    {if $discussion->user->searchAttribute('name')}{$discussion->user->getAttribute('name')->value}{else}{$discussion->user->login}{/if} {$discussion->datecreate|date_format:"%d.%m.%Y"}
                    <button onclick="comment_reply_on({$discussion->id})">Ответить</button>
                    {if $discussion->isRequest}{if $discussion->isComplete}<img src="/i/is_complite.png" title="Выполнена" alt="Выполнена" border="0"/>{elseif $discussion->user->id==$authUserId}<button onclick="comment_complete_rq('{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id, 'is_complete' => $discussion->id])}');">Завершить</button>{/if}{/if}
                    {if $discussion->user->id==$authUserId}<button onclick="comment_complete_rq('{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id, 'delete' => $discussion->id])}');">удалить</button> {/if}
                </div>
            </div>
        </li>
        {/if}

    {/foreach}
</ul>

<br/><br/>
{/if}

<div id="replay_form" style="display: none;">
    <form action="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id])}" method="post" enctype="multipart/form-data">
        <div>
            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">
                Ответить на <span id="replay_on_message"></span>
            </div>
            <textarea name="data[message]"></textarea><br/>

            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Загрузить документ</div>
            <div>
                Название документа&nbsp;<input name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 300px;"/><br/>
                <textarea name="data[document_description]"></textarea>
            </div>
            <input type="hidden" name="data[parent]" value="" id="parent"/>
            <input id="save" name="save" type="submit" value="Отправить"/>
        </div>
    </form>

</div>


<div id="add_form">
    <form action="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idTask' => $task->id])}" method="post" enctype="multipart/form-data">
        <div>
            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Добавить комментарий <span style="font-weight: normal; vertical-align: top;"><input type="checkbox" name="data[is_request]" style="width: 14px;" /> заявка</span></div>
            <textarea name="data[message]"></textarea><br/>

            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Лично для</div>
            <select name="data[to]">
                <option value="" selected="selected">Всем</option>
                {foreach from=$userList item=user}
                    <option value="{$user->id}">{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}{$user->login}{/if}</option>
                {/foreach}
            </select>


            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Загрузить документ</div>
            <div>
                Название документа&nbsp;<input name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 300px;"/><br/>
                <textarea name="data[document_description]"></textarea>
            </div>

            <input id="save" name="save" type="submit" value="Отправить"/>
        </div>
    </form>
</div>