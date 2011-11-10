<div style="background-color:#f0f0f0; padding:5px;"><h1>Контентные страницы</h1></div><br/>


{if $action=="add" || $action=="edit"}

    <h1>{$txt}</h1>

    <form action="?page={$page}&action={$action}{if $action=='edit'}&id={$conpage.id}{/if}" method="post">
        <table width="100%">
            <tr>
                <td class="ttovar">Название страницы (англ)</td>
                <td class="ttovar"><input name="data[page_title]" value="{$conpage.page_title}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Название страницы</td>
                <td class="ttovar"><input name="data[title]" value="{$conpage.title}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Текст</td>
                <td class="ttovar"><textarea name="data[content]">{$conpage.content}</textarea></td>
            </tr>
        </table>
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    {if $conpage_list!==false}
        <table width="100%">
            {foreach from=$conpage_list item=conpage}
                <tr>
                    <td class="ttovar">{$conpage.title}</td>
                    <td class="tedit"><a href="?page={$page}&action=edit&id={$conpage.id}" class="tedit">редактировать</a><br/><br/>
                        <a href="?page={$page}&action=del&id={$conpage.id}" class="tdel">удалить</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}

    <a href="?page={$page}&action=add">добавить</a>

{/if}