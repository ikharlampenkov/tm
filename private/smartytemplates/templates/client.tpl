<div style="background-color:#f0f0f0; padding:5px;"><h1>Информация о клиентах</h1></div><br/>

{if $action=='view'}

    <table width="100%">
        <tr>
            <td width="110">{if isset($client) && $client.logo}<img src="{$siteurl}files/{$client.logo_prew}" />{/if}</td>
            <td >{$client.title}</td>
        </tr>
    </table> 

        <div>{$client.description|nl2br}</div>  
        
        {if $project_list!==false}
            <h4>Проекты</h4>
            
            <ul>
            {foreach from=$project_list item=project}
                <li><a href="?page=project&action=view&id={$project.id}">{$project.title}</a></li>
            {/foreach}
        </ul>
    {/if}

{else}

    {if $client_list!==false}
        <table width="100%">
            {foreach from=$client_list item=client}
                <tr>
                    <td>{if $client.logo_prew}<img src="{$siteurl}files/{$client.logo_prew}"/>{else}&nbsp;{/if}</td>
                    <td class="ttovar"><a href="?page={$page}&action=view&id={$client.id}">{$client.title}</a></td>
                </tr>
            {/foreach}
        </table>
    {/if}

{/if}