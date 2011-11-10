<div style="background-color:#f0f0f0; padding:5px;"><h1>Лицензии</h1></div>

{if $license_list!==false}
<table>
{foreach from=$license_list item=license}
    <tr>
        <td>
        {if $license.img_prew}
            <a href="{$siteurl}files/{$license.img}" target="_blank"><img src="{$siteurl}files/{$license.img_prew}" alt="{$license.description|truncate:50}" border="0" /></a>
        {else}&nbsp;{/if}<br />
        <div>{$license.description}</div>
        </td>
    </tr>
{/foreach}
</table>
{/if}