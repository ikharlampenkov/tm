<div style="background-color:#f0f0f0; padding:5px;"><h1>СМИ о компании</h1></div><br/>

{if $action=="add" || $action=="edit"}

    <h2>{$txt}</h2>

    <form action="?page={$page}&action={$action}{if edit}&id={$smi.id}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%">
            <tr>
                <td class="ttovar" width="200">Название</td>
                <td class="ttovar"><input name="data[title]" value="{$smi.title}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Дата</td>
                <td class="ttovar"><input name="data[date]" value="{if isset($smi.date)}{$smi.date|date_format:"%d.%m.%Y"}{else}{$smarty.now|date_format:"%d.%m.%Y"}{/if}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Источник</td>
                <td class="ttovar"><input name="data[source]" value="{$smi.source}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Анонс</td>
                <td class="ttovar"><textarea name="data[short_text]">{$smi.short_text}</textarea></td>
            </tr>
            <tr>
                <td class="ttovar">Текст статьи</td>
                <td class="ttovar"><textarea name="data[full_text]">{$smi.full_text}</textarea></td>
            </tr>
        </table>
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if $smi_list!==false}

        <table width="100%" cellpadding="5" border="0" style="font-size:14px;">
            <tr>
                <td class="ttovar">Дата</td>
                <td class="ttovar">Заголовок</td>
                <td class="ttovar">Анонс</td>
                <td class="ttovar">&nbsp;</td>
            </tr>
            {foreach from=$smi_list item=smi}
                <tr>
                    <td class="ttovar">{$smi.date|date_format:"%d.%m.%Y"}</td>
                    <td class="ttovar">{$smi.title}</td>
                    <td class="ttovar">{$smi.short_text|strip_tags:false|truncate:50}</td>
                    <td class="tedit"><a href="?page={$page}&action=edit&id={$smi.id}" class="tedit">редактировать</a><br/><br/>
                                      <a href="?page={$page}&action=del&id={$smi.id}" class="tdel">удалить</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}

    <br/>
    <a href="?page={$page}&action=add">добавить</a>


{/if}