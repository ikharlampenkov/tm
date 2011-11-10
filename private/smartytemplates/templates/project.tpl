<div style="background-color:#f0f0f0; padding:5px;"><h1>Выполненные работы</h1></div><br/>

{if $action=="view"}

    <h1>{$project.title}</h1>

    <div>Клиент: {$client.title}</div><br/>

    <div>{$project.description|nl2br}</div>


    

    {if $service_list!==false}
        <h4>Услуги</h4>
        
        <ul>
            {foreach from=$service_list item=service}
                <li><a href="?page=service&action=view&id={$service.id}">{$service.title}</a></li>
            {/foreach}
        </ul>
    {/if}

    

    {if $gallery!==false}
        <h4>Галлерея проекта</h4>
        
        <table width="100%">
            {foreach from=$gallery item=img}
                <tr>
                    <td><img src="{$siteurl}files/{$img.img_prew}" alt="{$img.description}"/></td>
                </tr>
            {/foreach}
        </table>
    {/if}   

{else}

    {if $project_list!==false}
        <ul>
            {foreach from=$project_list item=project}
                <li><a href="?page={$page}&action=view&id={$project.id}">{$project.title}</a></li>
            {/foreach}
        </ul>
    {/if}

{/if}