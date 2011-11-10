<div style="background-color:#f0f0f0; padding:5px;"><h1>Вакансии</h1></div><br/>

{if $action=="add" || $action=="edit"}

<h2>{$txt}</h2>

<form action="?page={$page}&action={$action}{if $action=="edit"}&id={$vacancy.id}{/if}" method="post" enctype="multipart/form-data">
    <table width="100%" cellpadding="5" cellspacing="2" style="font-size:14px">
        <tr class="ttovar">
            <td width="200">Должность</td>
            <td><input name="data[position]" value="{$vacancy.position}" /></td>
        </tr>
        <tr class="ttovar">
            <td>Требования</td>
            <td><textarea name="data[requirements]" />{$vacancy.requirements}</textarea></td>
        </tr> 
        <tr class="ttovar">
            <td>Заработная плата</td>
            <td><input name="data[salary]" value="{$vacancy.salary}" /></td>
        </tr>
        <tr class="ttovar">
            <td>Текст</td>
            <td><textarea name="data[some_text]" />{$vacancy.some_text}</textarea></td>
        </tr>
        <tr class="ttovar">
            <td>Куда присылать резюме</td>
            <td><input name="data[contact]" value="{$vacancy.contact}" /></td>
        </tr>
        <tr class="ttovar">
            <td>К кому обращаться</td>
            <td><input name="data[who]" value="{$vacancy.who}" /></td>
        </tr>
        <tr class="ttovar">
            <td>Активная</td>
            <td><input name="data[is_active]" type="checkbox" {if isset($vacancy.is_active) && $vacancy.is_active}checked="checked"{/if} style="font-size: 14px; width: 25px;" /></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить" />
</form>

{else}

{if $vacancy_list!==false}
<table width="100%" cellpadding="5" cellspacing="2" style="font-size:14px">
    <tr>
       <td class="ttovar">Должность</td>
       <td class="ttovar">Требования</td>
       <td class="ttovar">Заработная плата</td>
       <td class="ttovar">Активность</td>
       <td class="ttovar">&nbsp;</td>
    </tr>
{foreach from=$vacancy_list item=vacancy}
    <tr>
	<td class="ttovar">{$vacancy.position}</td>
        <td class="ttovar">{$vacancy.requirements}</td>
        <td class="ttovar">{$vacancy.salary}</td>
        <td class="ttovar">{$vacancy.is_active}</td>
        <td class="tedit"><a href="?page={$page}&action=edit&id={$vacancy.id}" class="tedit">редактировать</a><br/><br/>
                          <a href="?page={$page}&action=del&id={$vacancy.id}" class="tdel">удалить</a></td>
    </tr>
{/foreach}
</table>
{/if}

<a href="?page={$page}&action=add">добавить</a>


{/if}