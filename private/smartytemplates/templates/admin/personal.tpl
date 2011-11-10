<div style="background-color:#f0f0f0; padding:5px;"><h1>Персонал</h1></div><br/>


{if $action=="add" || $action=="edit"}

<h2>{$txt}</h2>

<form action="?page={$page}&action={$action}{if $action=="edit"}&id={$personal.id}{/if}" method="post" enctype="multipart/form-data">
    <table width="100%" cellpadding="5" cellspacing="2" style="font-size:14px">
        <tr class="ttovar">
            <td width="200">ФИО</td>
            <td><input name="data[fio]" value="{$personal.fio}" /></td>
        </tr>
        <tr class="ttovar">
            <td>Фото</td>
            <td>{if !empty($personal.foto)}<img src="{$siteurl}files/{$personal.foto}" alt="{$personal.fio}" /><br />
                &nbsp;<a href="?page={$page}&action=del_file&id={$personal.id}&field=img">удалить</a><br />{/if}
                <input type="file"  name="img" /></td>
        </tr>
        <tr class="ttovar">
            <td>Отдел</td>
            <td><input name="data[department]" value="{$personal.department}" /></td>
        </tr>
        <tr class="ttovar">
            <td>Должность</td>
            <td><input name="data[position]" value="{$personal.position}" /></td>
        </tr>
        <tr class="ttovar">
            <td>Круг решаемых вопросов</td>
            <td><textarea name="data[competence]" >{$personal.competence}</textarea></td>
        </tr>
        <tr class="ttovar">
            <td>Контакты</td>
            <td><textarea name="data[contact]" >{$personal.contact}</textarea></td>
        </tr>
        <tr class="ttovar">
            <td>Прочая информация</td>
            <td><textarea name="data[other]" >{$personal.other}</textarea></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить" />
</form>

{else}

{if $personal_list!==false}
<table width="100%" cellpadding="5" cellspacing="2" style="font-size:14px">
    <tr>
       <td class="ttovar">Фото</td>
       <td class="ttovar">ФИО</td>
       <td class="ttovar">Отдел</td>
       <td class="ttovar">Должность</td>
       <td class="ttovar">&nbsp;</td>
    </tr>
{foreach from=$personal_list item=personal}
    <tr>
        <td class="ttovar">{if $personal.foto_prew}<img src="{$siteurl}files/{$personal.foto_prew}" alt="{$personal.fio}" />{else}&nbsp;{/if}</td>
	<td class="ttovar">{$personal.fio}</td>
        <td class="ttovar">{$personal.department}</td>
        <td class="ttovar">{$personal.position}</td>
        <td class="tedit"><a href="?page={$page}&action=edit&id={$personal.id}" class="tedit">редактировать</a><br /><br />
                           <a href="?page={$page}&action=del&id={$personal.id}" class="tdel">удалить</a></td>
    </tr>
{/foreach}
</table>
{/if}

<a href="?page={$page}&action=add">добавить</a>



{/if}