<div class="page"><h1>Добавить тему</h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'addTopic'])}" method="post">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input name="data[message]" value="{$discussion->message}"/></td>
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
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="{$discussion->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}" class="datepicker"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>