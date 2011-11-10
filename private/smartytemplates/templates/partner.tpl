<div style="background-color:#f0f0f0; padding:5px;"><h1>Партнеры</h1></div><br/>

{if $action=='view'}

    <table width="100%">
        <tr>
            <td width="110">{if isset($partner) && $partner.logo}<img src="{$siteurl}files/{$partner.logo_prew}" />{/if}</td>
            <td>{if $partner.site_url}<a href="http://{$partner.site_url}/" >{$partner.title}</a>{else}{$partner.title}{/if}</td>
        </tr>
    </table> 

    <div>{$partner.description|nl2br}</div>      

{else}

    {if $partner_list!==false}
        <table width="100%">
            {foreach from=$partner_list item=partner}
                <tr>
                    <td width="150">{if $partner.logo_prew}<img src="{$siteurl}files/{$partner.logo_prew}"/>{else}&nbsp;{/if}</td>
                    <td class="ttovar"><a href="?page={$page}&action=view&id={$partner.id}">{$partner.title}</a></td>
                </tr>
            {/foreach}
        </table>
    {/if}

{/if}