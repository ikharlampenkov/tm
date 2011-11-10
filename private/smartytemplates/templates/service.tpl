<div style="background-color:#f0f0f0; padding:5px;"><h1>Услуги</h1></div><br/>

{if $action=="view"}

    <h1>{$service.title}</h1>

    <div>{$service.description|nl2br} </div>

    {if $project_list!==false}
        <h4>Проекты</h4>
        <ul>
            {foreach from=$project_list item=project}
                <li><a href="?page=project&action=view&id={$project.id}">{$project.title}</a></li>
            {/foreach}
        </ul>
    {/if}

    {if $client_list!==false}
        <h4>Клиенты</h4>

        <table width="100%">
            {foreach from=$client_list item=client}
                <tr>
                    <td>{if $client.logo_prew}<img src="{$siteurl}files/{$client.logo_prew}"/>{else}&nbsp;{/if}</td>
                    <td class="ttovar"><a href="?page=client&action=view&id={$client.id}">{$client.title}</a></td>
                </tr>
            {/foreach}
        </table>
    {/if}

{else}

    {if $service_list!==false}
        <ul>
            {foreach from=$service_list item=service}
                <li><a href="?page={$page}&action=view&id={$service.id}">{$service.title}</a></li>
            {/foreach}
        </ul>
    {/if}

{/if}