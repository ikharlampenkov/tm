<div style="background-color:#f0f0f0; padding:5px;"><h1>Партнеры</h1></div><br/>


{if $action=="add" || $action=="edit"}

    <h1>{$txt}</h1>

    <form action="?page={$page}&action={$action}{if $action=='edit'}&id={$partner.id}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%">
            <tr>
                <td class="ttovar" width="200">Название</td>
                <td class="ttovar"><input name="data[title]" value="{$partner.title}" /></td>
            </tr>
             <tr>
                <td class="ttovar">Логотип</td>
                <td class="ttovar">{if isset($partner) && $partner.logo}<img src="{$siteurl}files/{$partner.logo}" alt="{$partner.title}" /><br />
                    &nbsp;<a href="?page={$page}&action=del_img&id={$partner.id}">удалить</a><br />{/if}
                    <input type="file"  name="img" />
                </td>
            </tr>
            <tr>
                <td class="ttovar">Адрес сайта</td>
                <td class="ttovar"><input name="data[site_url]" value="{$partner.site_url}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Описание</td>
                <td class="ttovar"><textarea name="data[description]">{$partner.description}</textarea></td>
            </tr>
        </table>
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if $partner_list!==false}
        <table width="100%">
            <tr>
                <td class="ttovar">Логотип</td>
                <td class="ttovar">Название</td>
                <td class="ttovar">Адрес сайта</td>
                <td class="ttovar">&nbsp;</td>
            </tr>

            {foreach from=$partner_list item=partner}
                <tr>
                    <td class="ttovar">{if $partner.logo_prew}<img src="{$siteurl}files/{$partner.logo_prew}" alt="{$partner.title}"/>{else}&nbsp;{/if}</td>
                    <td class="ttovar">{$partner.title}</td>
                    <td class="ttovar">{$partner.site_url}</td>
                    <td class="tedit"><a href="?page={$page}&action=edit&id={$partner.id}" class="tedit">редактировать</a><br/><br/>
                                      <a href="?page={$page}&action=del&id={$partner.id}" class="tdel">удалить</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}

    <br/>
    <a href="?page={$page}&action=add">добавить</a>

{/if}