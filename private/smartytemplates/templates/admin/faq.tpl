<div style="background-color:#f0f0f0; padding:5px;"><h1>Вопросы и ответы</h1></div><br/>

{if $action=="add" || $action=="edit"}

<h2>{$txt}</h2>

<form action="?page={$page}&action={$action}&id={if $action=="edit"}{$faq.id}{/if}" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td class="ttovar" width="200">Вопрос</td>
            <td class="ttovar"><input name="data[question]" value="{$faq.question}" /></td>
        </tr>
        <tr>
            <td class="ttovar">Ответ</td>
            <td class="ttovar"><textarea name="data[answer]">{$faq.answer}</textarea></td>
        </tr>
        <tr>
            <td class="ttovar">Дата</td>
            <td class="ttovar"><input name="data[вфеу]" value="{if isset($faq.date)}{$faq.date|date_format:"%d.%m.%Y"}{else}{$smarty.now|date_format:"%d.%m.%Y"}{/if}" /></td>
        </tr>
        <tr>
            <td class="ttovar">Публиковать</td>
            <td class="ttovar"><input type="checkbox" name="data[is_moderate]" {if isset($faq.is_moderate) && $faq.is_moderate}checked="checked"{/if} style="width: 14px;" /></td>
        </tr>
        <tr>
            <td class="ttovar">Часто задаваемый вопрос</td>
            <td class="ttovar"><input type="checkbox" name="data[is_frequent]" {if isset($faq.is_frequent) && $faq.is_frequent}checked="checked"{/if} style="width: 14px;" /></td>
        </tr>
    </table>
    <input type="hidden" name="data[is_folder]" value="0" />
    <input id="save" name="save" type="submit" value="Сохранить" />
</form>

{else}


{if $faq_list!==false}
<table width="100%" cellpadding="5" cellspacing="2" style="font-size: 14px">
    <tr>
       <td class="ttovar">Вопрос</td>
       <td class="ttovar">Ответ</td>
       <td class="ttovar">Публиковать</td>
       <td class="ttovar">ЧАВО</td>
       <td class="ttovar">&nbsp;</td>
    </tr>
{foreach from=$faq_list item=faq}
    <tr>
        <td class="ttovar">{$faq.question|truncate:100}</td>
	<td class="ttovar">{$faq.answer|truncate:200}</td>  
        <td class="ttovar">{if $faq.is_moderate}Да{else}Нет{/if}</td>
        <td class="ttovar">{if $faq.is_frequent}Да{else}Нет{/if}</td>
        <td class="tedit"><a href="?page={$page}&action=edit&id={$faq.id}" class="tedit">редактировать</a><br/><br/>
                        <a href="?page={$page}&action=del&id={$faq.id}" class="tdel">удалить</a></td>
    </tr>
{/foreach}
</table>
{/if}

<br/>
<a href="?page={$page}&action=add">добавить</a>


{/if}