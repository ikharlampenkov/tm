<div class="page"><h1>Добавить сообщение</h1></div><br/>

{if isset($exception_msg)}
    <div>Ошибка: {$exception_msg}</div>
    <br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'add'])}" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Сообщение</td>
            <td class="ttovar"><textarea name="data[message]">{$discussion->message}</textarea></td>
        </tr>
        <tr>
            <td class="ttovar_title">Тема</td>
            <td class="ttovar"><select name="data[topic]">
                    <option value="">--</option>
                    {if !empty($topicList)}
                        {foreach from=$topicList item=topic}
                            <option value="{$topic->id}" {if is_object($discussion->topic) && $discussion->topic->id == $topic->id}selected="selected"{/if}>{$topic->message}</option>
                        {/foreach}
                    {/if}
                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Ответ на:</td>
            <td class="ttovar"><select name="data[parent]">
                    <option value="">--</option>
                    {if !empty($parentList)}
                        {foreach from=$parentList item=parent}
                            <option value="{$parent->id}" {if is_object($discussion->parent) && $discussion->parent->id == $parent->id}selected="selected"{/if}>{$parent->message}</option>
                        {/foreach}
                    {/if}
                </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input type="text" name="data[date_create]" value="{$discussion->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}" class="datepicker"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Документ</td>
            <td class="ttovar">
                Название документа&nbsp;<input type="text" name="data[document_title]" value="" style="width: 310px;"/>&nbsp;&nbsp;
                <input type="file" name="file" style="width: 300px;"/><br/>
                <textarea name="data[document_description]"></textarea>
            </td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>