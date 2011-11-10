<div style="background-color:#f0f0f0; padding:5px;"><h1>Документы</h1></div><br/>


{if $action=="add" || $action=="edit"}

    <h2>{$txt}</h2>
    <a href="?page={$page}"><< Назад</a>

    <form action="?page={$page}&action={$action}&id={if $action=="edit"}{$document.id}{/if}" method="post" enctype="multipart/form-data">
        <table cellpadding="5" border="0" style="font-size:14px;">
            <tr>
                <td class="ttovar" width="200">Название</td>
                <td class="ttovar"><input name="data[title]" value="{$document.title}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Краткое описание</td>
                <td class="ttovar"><textarea name="data[short_text]">{$document.short_text}</textarea></td>
            </tr>
            <tr>
                <td class="ttovar">Родительский элемент</td>
                <td class="ttovar"><select name="data[parrent_id]">
                        <option value="0" {if isset($document.parent_id) && $document.parent_id==0}selected="selected"{/if}>корень</option>
                        {foreach from=$folder_list item=folder}
                            <option value="{$folder.id}" {if isset($document.parent_id) && $document.parent_id==$folder.id}selected="selected"{/if}>{$folder.title}</option>
                        {/foreach}
                    </select></td>
            </tr>
            <tr>
                <td class="ttovar">Файл</td>
                <td class="ttovar">{if !empty($document.file)}<a href={$siteurl}temp_files/{$document.file}>Файл</a><br />{/if}
                    <input type="file"  name="data[file]" /></td>
            </tr>
        </table>
        <input type="hidden" name="data[is_folder]" value="0" />
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{elseif $action=="add_folder" || $action=="edit_folder"}
    <a href="?page={$page}"><< Назад</a>
    <form action="?page={$page}&action={$action}&id={if $action=="edit_folder"}{$document.id}{/if}" method="post" enctype="multipart/form-data">
        <table cellpadding="5" border="0" style="font-size:14px;">
            <tr>
                <td class="ttovar" width="200">Название</td>
                <td class="ttovar"><input name="data[title]" value="{$document.title}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Родительский элемент</td>
                <td class="ttovar"><select name="data[parrent_id]">
                        <option value="0" {if isset($document.parent_id) && $document.parent_id==0}selected="selected"{/if}>корень</option>
                        {foreach from=$folder_list item=folder}
                            <option value="{$folder.id}" {if isset($document.parent_id) && $document.parent_id==$folder.id}selected="selected"{/if}>{$folder.title}</option>
                        {/foreach}
                    </select></td>
            </tr>
        </table>
        <input type="hidden" name="data[short_text]" value="" />
        <input type="hidden" name="data[is_folder]" value="1" />
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if isset($path_to_document)}
        <div>
            <a href="?page={$page}"><< Назад</a>
            {section name=path_doc loop=count($path_to_document) step=-1}
                <a href="?page={$page}&root={$path_to_document[path_doc].id}">{$path_to_document[path_doc].title}</a>{if !$smarty.section.path_doc.last} / {/if}
            {/section}
        </div><br />
    {/if}



    {if $document_list!==false}
        <table width="100%">
            <tr>
                <td class="ttovar">Название</td>
                <td class="ttovar">Краткое описание</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            {foreach from=$document_list item=document}
                <tr>
                    <td class="ttovar">{if $document.is_folder==1}<a href="?page={$page}&root={$document.id}">{$document.title|truncate:100}</a>{else}{$document.title|truncate:100}{/if}</td>
                    <td class="ttovar">{$document.short_text|truncate:200}</td>
                    <td class="tedit"><a href="?page={$page}&action={if $document.is_folder==1}edit_folder{else}edit{/if}&id={$document.id}" class="tedit">редактировать</a><br/><br/>
                        <a href="?page={$page}&action={if $document.is_folder==1}del_folder{else}del{/if}&id={$document.id}" class="tdel">удалить</a></td>
                </tr>
            {/foreach}
        </table>
    {/if}

    <br/>
    <a href="?page={$page}&action=add">добавить</a>

{/if}