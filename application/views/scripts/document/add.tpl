<div class="page"><h1>Добавить документ</h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'add'])}" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td class="ttovar_title">Название</td>
            <td class="ttovar"><input name="data[title]" value="{$document->title}"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Папка</td>
            <td class="ttovar"><select name="data[parentDocument]">
                <option value="">--</option>
            {if !empty($parentList)}
                {foreach from=$parentList item=parent}
                    <option value="{$parent->id}" {if is_object($document->parent) && $document->parent->id == $parent->id}selected="selected"{/if}>{$parent->title}</option>
                {/foreach}
            {/if}
            </select>
            </td>
        </tr>
        <tr>
            <td class="ttovar_title">Дата создания</td>
            <td class="ttovar"><input name="data[date_create]" value="{$document->dateCreate|date_format:"%d.%m.%Y %H:%M:%S"}" class="datepicker"/></td>
        </tr>
        <tr>
            <td class="ttovar_title">Файл</td>
            <td class="ttovar"><input type="file" name="file"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>