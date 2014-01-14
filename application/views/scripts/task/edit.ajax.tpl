{if isset($exception_msg)}
    <div id="exception" class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
            <p id="exception_message"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                Ошибка: {$exception_msg}</p>
        </div>
    </div>
    <br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $task->id])}" method="post" enctype="multipart/form-data" id="editForm">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Тип задачи</td>
            <td class="ttovar">
                <select name="data[type]" class="input_ajax">
                    {foreach from=$taskTypeList item=task_type key=task_type_key}
                        <option value="{$task_type_key}" {if $task->type == $task_type_key}selected="selected"{/if}>{$task_type}</option>
                    {/foreach}

                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input type="text" name="data[title]" value="{$task->title}" class="input_ajax"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Супер задача</td>
            <td class="ttovar"><select name="data[parentTask]" class="input_ajax">
                    <option value="">--</option>
                    {if !empty($parentList)}
                        {foreach from=$parentList item=parent}
                            <option value="{$parent->id}" {if $task->getParent() != null && $task->getParent()->getId() == $parent->id}selected="selected"{/if}>{$parent->title}</option>
                            {if $parent->getChild()}
                                {include file="task/parent-block.tpl" subtask=$parent->getChild() task=$task wid="--"}
                            {/if}
                        {/foreach}
                    {/if}
                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input type="text" name="data[date_create]" value="{$task->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}" class="input_ajax" readonly="readonly"/></td>
        </tr>
        {if $authUserRole == 'admin' || $authUserRole == 'adminsystem'}
            <tr>
                <td class="ttovar_title">VIP-клиент</td>
                <td class="ttovar"><input type="checkbox" name="data[is_vip]" {if $task->isVip == true}checked="checked"{/if} /></td>
            </tr>
        {else}
            <input type="hidden" name="data[is_vip]" value="{if $task->isVip == true}on{/if}"/>
        {/if}

        {if $attributeHashList!==false}
            {foreach from=$attributeHashList item=attributeHash}
                <tr>
                    <td class="{if $attributeHash->isRequired}ttovar_title_requared{else}ttovar_title{/if}">{$attributeHash->title}{if $attributeHash->isRequired}*{/if}</td>
                    <td class="ttovar">{$attributeHash->type->getHTMLFrom($attributeHash, $task)}{*<input type="text" name="data[attribute][{$attributeHash->attributeKey}]" value="{if $task->searchAttribute($attributeHash->attributeKey)}{$task->getAttribute($attributeHash->attributeKey)->value}{/if}"/>*}</td>
                </tr>
            {/foreach}
        {/if}

        {if $documentList !== false}
            {foreach from=$documentList item=document}
                <tr>
                    <td class="ttovar_title">Документ</td>
                    <td class="ttovar">
                        <a href="/files{$document->file->getSubPath()}/{$document->file->getName()}" target="_blank" id="doc_info_{$document->id}" onmouseover="doc.showInfo('{$this->url(['controller' => 'document','action' => 'view', 'id' => $document->id])}', {$document->id});">{$document->title}</a>
                        / <a href="{$this->url(['controller' => 'document','action' => 'edit', 'id' => $document->id])}">редактировать</a>
                        / <a href="{$this->url(['controller' => $controller,'action' => 'deleteLinkToDoc', 'id' => $task->id, 'doc_id' => $document->id])}">удалить</a>
                    </td>
                </tr>
            {/foreach}
        {/if}
        <tr>
            <td class="ttovar_title">Документ</td>
            <td class="ttovar">
                Название&nbsp;<input type="text" name="data[document_title]" value="" style="width: 210px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 200px;"/><br/>
                <textarea name="data[document_description]"></textarea>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td class="ttovar_title">Пользователь</td>
            <td class="ttovar" style="width: 90px;">Чтение</td>
            <td class="ttovar" style="width: 90px;">Запись</td>
            <td class="ttovar" style="width: 90px;">Исполнитель</td>
            <td class="ttovar"></td>
        </tr>

        {if $userList!==false}
            {foreach from=$userList item=user}
                <tr>
                    <td class="ttovar_title">{if $user->searchAttribute('name')}{$user->getAttribute('name')->value}{else}{$user->login}{/if}</td>
                    <td class="ttovar"><input type="checkbox" name="dataacl[{$user->id}][is_read]" {if isset($taskAcl[{$user->id}]) && $taskAcl[{$user->id}]->isRead}checked="checked"{/if} /></td>
                    <td class="ttovar"><input type="checkbox" name="dataacl[{$user->id}][is_write]" {if isset($taskAcl[{$user->id}]) && $taskAcl[{$user->id}]->isWrite}checked="checked"{/if} /></td>
                    <td class="ttovar"><input type="checkbox" name="dataacl[{$user->id}][is_executant]" {if isset($taskAcl[{$user->id}]) && $taskAcl[{$user->id}]->isExecutant}checked="checked"{/if} /></td>
                    <td class="ttovar"><input type="hidden" name="dataacl[{$user->id}][fake]"/></td>
                </tr>
            {/foreach}
        {/if}

    </table>


</form>