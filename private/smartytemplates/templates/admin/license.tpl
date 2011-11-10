<div style="background-color:#f0f0f0; padding:5px;"><h1>Лицензии</h1></div><br/>

{if $action=="add" || $action=="edit"}

    <h2>{$txt}</h2>

    <form action="?page={$page}&action={$action}{if $action=="edit"}&id={$license.id}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%" cellpadding="5" cellspacing="2" style="font-size:14px">
            <tr>
                <td class="pem">Лицензия</td>
                <td class="pem">{if !empty($license.img)}<img src="{$siteurl}temp_files/{$license.img}" /><br />
                    &nbsp;<a href="?page={$page}&action=del_file&id={$license.id}&field=img">удалить</a><br />{/if}
                    <input type="file"  name="img" /></td>
            </tr>
            <tr class="pem">
                <td width="200">Описание</td>
                <td><textarea name="data[description]">{$license.description}</textarea></td>
            </tr>
        </table>
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if $license_list!==false}
        <table width="100%" >
            <tr>
                <td class="ttovar">Лицензия</td>
                <td class="ttovar">Описание</td>
                <td class="ttovar">&nbsp;</td>
            </tr>
            {foreach from=$license_list item=license}
                <tr>
                    <td class="ttovar">{if $license.img_prew}<img src="{$siteurl}files/{$license.img_prew}" />{else}&nbsp;{/if}</td>
                    <td class="ttovar">{$license.description|truncate:50}</td>
                    <td class="tedit"><a href="?page={$page}&action=edit&id={$license.id}" class="tedit">редактировать</a><br/><br/>
                                       <a href="?page={$page}&action=del&id={$license.id}" class="tdel">удалить</a></td>
                </tr>
            {/foreach}
        </table>
    {/if}


    <a href="?page={$page}&action=add">добавить</a>

{/if}