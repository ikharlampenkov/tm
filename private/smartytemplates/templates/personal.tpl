<div style="background-color:#f0f0f0; padding:5px;"><h1>Сотрудники</h1></div><br/>

{if $personal_list!==false}
<table>
    <tr>
       <td>Фото</td>
       <td>ФИО</td>
       <td>Отдел</td>
       <td>Должность</td>
    </tr>
{foreach from=$personal_list item=personal}
    <tr>
        <td>{if $personal.foto}<img src="{$siteurl}files/{$personal.foto_prew}" />{else}&nbsp;{/if}</td>
	<td>{$personal.fio}</td>
        <td>{$personal.department}</td>
        <td>{$personal.position}</td>
    </tr>
{/foreach}
</table>
{/if}