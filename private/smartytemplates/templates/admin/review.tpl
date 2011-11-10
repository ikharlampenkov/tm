<div style="background-color:#f0f0f0; padding:5px;"><h1>Отзывы о работе</h1></div><br/>


{if $action=="add" || $action=="edit"}

    <h1>{$txt}</h1>

    <form action="?page={$page}&action={$action}{if $action=='edit'}&id={$review.id}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%">
            <tr>
                <td class="ttovar" width="200">Название</td>
                <td class="ttovar"><input name="data[title]" value="{$review.title}" /></td>
            </tr>
             <tr>
                <td class="ttovar">Отзыв</td>
                <td class="ttovar">{if isset($review) && $review.img}<img src="{$siteurl}files/{$review.img}" alt="{$review.title}" /><br />
                    &nbsp;<a href="?page={$page}&action=del_img&id={$review.id}">удалить</a><br />{/if}
                    <input type="file"  name="img" />
                </td>
            </tr>
            <tr>
                <td class="ttovar">Клиент</td>
                <td class="ttovar"><select name="data[client_id]">
                        {foreach from=$client_list item=client}
                            <option value="{$client.id}" {if isset($review) && $client.id==$review.client_id}selected="selected"{/if}>{$client.title}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            <tr>
                <td class="ttovar">Проект</td>
                <td class="ttovar"><select name="data[project_id]">
                        {foreach from=$project_list item=project}
                            <option value="{$project.id}" {if isset($review) && $project.id==$review.project_id}selected="selected"{/if}>{$project.title}</option>
                        {/foreach}
                    </select>
                </td>
            </tr>
        </table>
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if $review_list!==false}
        <table width="100%">
            <tr>
                <td class="ttovar">Отзыв</td>
                <td class="ttovar">Название</td>
                <td class="ttovar">&nbsp;</td>
            </tr>
            
            {foreach from=$review_list item=review}
                <tr>
                    <td class="ttovar">{if $review.img_prew}<img src="{$siteurl}files/{$review.img_prew}" alt="{$review.title}"/>{else}&nbsp;{/if}</td>
                    <td class="ttovar">{$review.title}</td>
                    <td class="tedit"><a href="?page={$page}&action=edit&id={$review.id}" class="tedit">редактировать</a><br/><br/>
                                      <a href="?page={$page}&action=del&id={$review.id}" class="tdel">удалить</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}
    
    <br/>
    <a href="?page={$page}&action=add">добавить</a>

{/if}