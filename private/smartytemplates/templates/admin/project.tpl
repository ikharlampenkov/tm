<div style="background-color:#f0f0f0; padding:5px;"><h1>Работы</h1></div><br/>


{if $action=="add" || $action=="edit"}

    <h1>{$txt}</h1>

    <form action="?page={$page}&action={$action}{if $action=='edit'}&id={$project.id}{/if}" method="post">
        <table width="100%">
            <tr>
                <td class="ttovar">Название</td>
                <td class="ttovar"><input name="data[title]" value="{$project.title}" /></td>
            </tr>
            <tr>
                <td class="ttovar" >Клиент</td>
                <td class="ttovar" ><select name="data[client_id]">
                        {foreach from=$client_list item=client}
                            <option value="{$client.id}" {if isset($project) && $client.id==$project.client_id}selected="selected"{/if}>{$client.title}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <td class="ttovar">Текст</td>
                <td class="ttovar"><textarea name="data[description]">{$project.description}</textarea></td>
            </tr>
            <tr>
                <td class="ttovar">Завершeн</td>
                <td class="ttovar"><input type="checkbox" name="data[is_complite]" {if isset($project) && $project.is_complite}checked="checked"{/if} style="width:14px;" /></td>
            </tr>
        </table>
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>
            
{elseif $action=='service'} 
    
    <h1>Услуги для работы {$project.title} <a href="?page={$page}">все работы</a></h1>
    
    <form action="?page={$page}&action={$action}&id={$project.id}" method="post">
    {if $service_list!==false}
        <table width="100%">
            {foreach from=$service_list item=service}
                <tr>
                    <td><input type="checkbox" name="data[project][{$service.id}]" {if in_array($service.id, $service_array)}checked="checked"{/if} style="width:14px;" /></td>
                    <td class="ttovar">{$service.title}</td>
                </tr>
            {/foreach}
        </table>
    <input id="save" name="save" type="submit" value="Сохранить" />
    {/if}
    </form>

{elseif $action=='photo_view'}  
    
    <h1>Галлерея для работы {$project.title} <a href="?page={$page}">все работы</a></h1>
    
    {if $subaction=="add" || $subaction=="edit"}

    <h1>{$txt}</h1>

    <form action="?page={$page}&action=photo_view&id={$project.id}&subaction={$subaction}{if $subaction=='edit'}&img_id={$img.id}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%">
            <tr>
                <td class="ttovar">Описание</td>
                <td class="ttovar"><input name="data[description]" value="{$img.description}" /></td>
            </tr>
             <tr>
                <td class="ttovar" >Фото</td>
                <td class="ttovar" >{if isset($img) && $img.img}<img src="{$siteurl}files/{$img.img}" />{/if}
                    <input type="file"  name="img" />
                </td>
            </tr>
        </table>
        <input type="hidden" name="data[object_id]" value="{$project.id}"/>            
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if $gallery!==false}
        <table width="100%">
            {foreach from=$gallery item=img}
                <tr>
                    <td class="ttovar"><img src="{$siteurl}files/{$img.img_prew}" alt="{$img.description}"/></td>
                    <td class="ttovar">{$img.description}</td>
                    <td class="tedit"><a href="?page={$page}&action=photo_view&id={$project.id}&subaction=edit&img_id={$img.id}" class="tedit">редактировать</a><br/><br/>
                        <a href="?page={$page}&action=photo_view&id={$project.id}&subaction=del&img_id={$img.id}" class="tdel">удалить</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}
    
    <br/>
    <a href="?page={$page}&action=photo_view&id={$project.id}&subaction=add">добавить</a>

{/if}
    
    
{else}

    {if $project_list!==false}
        <table width="100%">
            {foreach from=$project_list item=project}
                <tr>
                    <td class="ttovar">{$project.title}</td>
                    <td class="tedit"><a href="?page={$page}&action=service&id={$project.id}" class="tedit">услуги</a><br/><br/>
                        <a href="?page={$page}&action=photo_view&id={$project.id}" class="tedit">фотографии</a>
                    </td>
                    <td class="tedit"><a href="?page={$page}&action=edit&id={$project.id}" class="tedit">редактировать</a><br/><br/>
                        <a href="?page={$page}&action=del&id={$project.id}" class="tdel">удалить</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}
    
    <br/>
    <a href="?page={$page}&action=add">добавить</a>

{/if}