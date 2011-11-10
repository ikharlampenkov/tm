<div style="background-color:#f0f0f0; padding:5px;"><h1>Вакансии</h1></div>

<br/>

{if $vacancy_list!==false}

<table cellpadding="10">
    <tr>
       <td class="pom"><b>Должность<b></td>
       <td class="pom"><b>Требования<b></td>
       <td class="pom"><b>Заработная плата<b></td>
       <td class="pom"><b>Куда присылать резюме<b></td>
       <td class="pom"><b>К кому обращаться<b></td>
    </tr>
{foreach from=$vacancy_list item=vacancy}
    <tr>
	<td class="pem">{$vacancy.position}</td>
        <td class="pem">{$vacancy.requirements}</td>
        <td class="pem">{$vacancy.salary}</td>
        <td class="pem">{$vacancy.contact}</td>
        <td class="pem">{$vacancy.who}</td>
    </tr>
{/foreach}
</table>

{/if}