<div style="background-color:#f0f0f0; padding:5px;"><h1>Новости и события</h1></div><br/>

{if $action=="add_news" || $action=="edit_news"}

    <h2>{$txt}</h2>

    <form action="?page={$page}&action={$action}{if edit}&id={$news.id}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%">
            <tr>
                <td class="ttovar" width="200">Название</td>
                <td class="ttovar"><input name="data[title]" value="{$news.title}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Дата</td>
                <td class="ttovar"><input name="data[date]" value="{if isset($news.date)}{$news.date|date_format:"%d.%m.%Y"}{else}{$smarty.now|date_format:"%d.%m.%Y"}{/if}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Фото</td>
                <td class="ttovar">{if !empty($news.foto)}<img src="{$siteurl}files/{$news.foto}" alt="{$news.title}" /><br />
                    &nbsp;<a href="?page={$page}&action=del_file&id={$news.id}&field=img">удалить</a><br />{/if}
                    <input type="file"  name="img" /></td>
            </tr>
            <tr>
                <td class="ttovar">Анонс</td>
                <td class="ttovar"><textarea name="data[short_text]">{$news.short_text}</textarea></td>
            </tr>
            <tr>
                <td class="ttovar">Текст новости</td>
                <td class="ttovar"><textarea name="data[full_text]">{$news.full_text}</textarea></td>
            </tr>
        </table>
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if $news_list!==false}

        <table width="100%" cellpadding="5" border="0" style="font-size:14px;">
            <tr>
                <td class="ttovar">Фото</td>
                <td class="ttovar">Дата</td>
                <td class="ttovar">Заголовок</td>
                <td class="ttovar">Анонс</td>
                <td class="ttovar">&nbsp;</td>
            </tr>
            {foreach from=$news_list item=news}
                <tr>
                    <td class="ttovar">{if $news.foto_prew}<img src="{$siteurl}files/{$news.foto_prew}" alt="{$news.title}" />{else}&nbsp;{/if}</td>
                    <td class="ttovar">{$news.date|date_format:"%d.%m.%Y"}</td>
                    <td class="ttovar">{$news.title}</td>
                    <td class="ttovar">{$news.short_text|strip_tags:false|truncate:50}</td>
                    <td class="tedit"><a href="?page={$page}&action=edit_news&id={$news.id}" class="tedit">редактировать</a><br/><br/>
                        <a href="?page={$page}&action=del_news&id={$news.id}" class="tdel">удалить</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}

    <a href="?page={$page}&action=add_news">добавить</a>


{/if}