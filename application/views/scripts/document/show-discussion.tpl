<div class="page"><h1>Обсуждение документа: {$document->title}</h1></div><br/>

{if $discussionList!==false}

    {assign var="openul" value=false}

<ul id="comment-list" style="padding: 0; margin: 0;">
    {foreach from=$discussionList item=discussion}
        {if !$discussion->hasParent() && $openul}</ul>{assign var="openul" value=false}{/if}
        {if $discussion->hasParent() && !$openul}
        <ul style="margin-left: 20px; padding: 0px;">{assign var="openul" value=true}{/if}
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
                    <button style="font-size: 11px; height: 18px; margin: 1px; padding: 1px;" onclick="comment_reply_on({$discussion->id})">Ответить</button>
                </div>
            </div>
        </li>

    {/foreach}
</ul>

<br/><br/>
{/if}

<div id="replay_form" style="display: none;">
    <form action="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idDocument' => $document->id])}" method="post" enctype="multipart/form-data">
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
            <input id="save" name="save" type="submit" value="Отправить"/>
        </div>
    </form>

</div>


<div id="add_form">
    <form action="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idDocument' => $document->id])}" method="post" enctype="multipart/form-data">
        <div>
            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Добавить комментарий</div>
            <textarea name="data[message]"></textarea><br/>

            <div style="font-size: 14px; font-weight: bold; padding: 0px 0px 5px 0px; margin: 0px 0px 5px 0px;">Загрузить документ</div>
            <div>
                Название документа&nbsp;<input name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 300px;"/>
            </div>

            <input id="save" name="save" type="submit" value="Отправить"/>
        </div>
    </form>
</div>