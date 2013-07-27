<div class="page"><h1>{if !isset($discussion)}Обсуждение{else}Тема: {$discussion->message}{/if}</h1></div><br/>

{if isset($exception_msg)}
    <div>Ошибка: {$exception_msg}</div>
    <br/>
{/if}

{if isset($breadcrumbs)}
    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => 0])}">/..</a>
    {if !empty($breadcrumbs)}
        &nbsp;/
        {foreach from=$breadcrumbs item=crumb name=_crumb}
            <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $crumb->id])}">{$crumb->message}</a>
            &nbsp;/
        {/foreach}
    {/if}
    <br/>
    <br/>
{/if}

<div class="sub-menu">
    {if_allowed resource="{$controller}/addTopic"}
        <img src="/i/add.png"/>
        &nbsp;
        <a href="{$this->url(['controller' => $controller,'action' => 'addTopic'])}">добавить тему</a>
    {/if_allowed}
    {if_allowed resource="{$controller}/add"}
    {if isset($parentId) && $parentId>0}
        /
        <img src="/i/add.png"/>
        &nbsp;
        <a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить комментарий</a>
    {/if}
    {/if_allowed}
</div>


<table>
    {if $topicList!==false}
        {foreach from=$topicList item=topic}
            {if_object_allowed type="{$controller|capitalize}" object="{$topic}"}
                <tr>
                    <td class="ttovar">
                        {if $topic->isTopic()}
                            <img src="/i/discussion_mini.png"/>
                            &nbsp;
                            <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $topic->id])}">{$topic->message}</a>
                        {else}
                            <img src="/i/comment.png"/>
                            &nbsp;{$topic->message}
                        {/if}</td>
                    <td class="ttovar discussion_date">{$topic->datecreate|date_format:"%d %B %Y"}</td>
                    <td class="tedit">
                        {if $topic->isTopic()}
                            {if_allowed resource="{$controller}/showAcl"}
                                <img src="/i/comanda.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'showAcl', 'idDiscussion' => $topic->id])}">права</a>
                                <br/>
                            {/if_allowed}
                            {if_allowed resource="{$controller}/editTopic"}
                                <img src="/i/edit.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'editTopic', 'id' => $topic->id])}">редактировать</a>
                                <br/>
                            {/if_allowed}
                            {if_allowed resource="{$controller}/deleteTopic"}
                                <img src="/i/delete.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'deleteTopic', 'id' => $topic->id])}" onclick="return confirmDelete('{$topic->message}');" style="color: #830000">удалить</a>
                            {/if_allowed}
                        {else}
                            {if_allowed resource="{$controller}/edit"}
                                <img src="/i/edit.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $topic->id])}">редактировать</a>
                                <br/>
                            {/if_allowed}
                            {if_allowed resource="{$controller}/delete"}
                                <img src="/i/delete.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $topic->id])}" onclick="return confirmDelete('{$topic->message}');" style="color: #830000">удалить</a>
                            {/if_allowed}
                        {/if}
                    </td>

                </tr>
            {/if_object_allowed}
        {/foreach}
    {/if}
</table>

{if isset($discussionList) && $discussionList !== false}

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
                                    <li style="list-style: none; padding: 0; background-color: #f7f7f7;">
                                        <a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank" style="font-size: 11px;" id="doc_info_{$document->id}" onmouseover="doc.showInfo('{$this->url(['controller' => 'document','action' => 'view', 'id' => $document->id])}', {$document->id});" onmouseout="doc.closeInfo();">{$document->title}</a>
                                        {if_allowed resource="document/edit"}
                                            /
                                            <a href="{$this->url(['controller' => 'document','action' => 'edit', 'id' => $document->id])}" style="font-size: 11px;">редактировать</a>
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

                        {if $discussion->isRequest}{if $discussion->isComplete}
                            <img src="/i/is_complite.png" title="Выполнена" alt="Выполнена" border="0"/>
                        {elseif $discussion->user->id==$authUserId}
                        <button onclick="comment_complete_rq('{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $parentId, 'is_complete' => $discussion->id])}');">Завершить</button>{/if}{/if}
                        {if $discussion->user->id==$authUserId}
                            <button onclick="comment_complete_rq('{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $discussion->id])}');">удалить</button>
                        {/if}
                    </div>
                </div>
            </li>
        {/if}

    {/foreach}
    </ul>
    <br/>
    <br/>
{/if}

<div id="replay_form" style="display: none;">
    <form action="{$this->url(['controller' => $controller,'action' => 'add'])}" method="post" enctype="multipart/form-data">
        <div>
            <div class="discussion_form_text">
                Ответить на <span id="replay_on_message"></span>
            </div>
            <textarea name="data[message]"></textarea><br/>

            <div class="discussion_form_text">Загрузить документ</div>
            <div>
                Название документа&nbsp;<input type="text" name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 300px;"/><br/>
                <textarea name="data[document_description]"></textarea>
            </div>
            <input type="hidden" name="data[parent]" value="" id="parent"/>
            <input type="hidden" name="data[topic]" value="{$parentId}"/>
            <input type="hidden" name="data[date_create]" value="{$smarty.now|date_format:"%d.%m.%Y %H:%M:%S"}"/>
            <input id="save" name="save" type="submit" value="Отправить"/>
        </div>
    </form>
</div>

{if isset($parentId) && $parentId>0}
    <div id="add_form">
        <form action="{$this->url(['controller' => $controller,'action' => 'add'])}" method="post" enctype="multipart/form-data">
            <div>
                <div class="discussion_form_text">Добавить комментарий <span style="font-weight: normal; vertical-align: top;"><input type="checkbox" name="data[is_request]" style="width: 14px;"/> заявка</span></div>
                <textarea name="data[message]"></textarea><br/>

                <div class="discussion_form_text">Лично для</div>
                <select name="data[to]">
                    <option value="" selected="selected">Всем</option>
                    {foreach from=$userList item=user}
                        <option value="{$user->id}">{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}{$user->login}{/if}</option>
                    {/foreach}
                </select>


                <div class="discussion_form_text">Загрузить документ</div>
                <div>
                    Название документа&nbsp;<input type="text" name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                    <input type="file" name="file" style="width: 300px;"/><br/>
                    <textarea name="data[document_description]"></textarea>
                </div>

                <input type="hidden" name="data[topic]" value="{$parentId}"/>
                <input type="hidden" name="data[date_create]" value="{$smarty.now|date_format:"%d.%m.%Y %H:%M:%S"}"/>
                <input id="save" name="save" type="submit" value="Отправить"/>
            </div>
        </form>
    </div>
{/if}