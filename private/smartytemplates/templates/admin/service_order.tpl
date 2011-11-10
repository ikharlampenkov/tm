<div style="background-color:#f0f0f0; padding:5px;"><h1>Заказ услуг</h1></div><br/>


{if $action=="edit"}

    <h1>{$txt}</h1>

    <form action="?page={$page}&action={$action}&id={$order.id}" method="post" enctype="multipart/form-data">
        <table width="100%">
            <tr>
                <td class="ttovar">Дата</td>
                <td class="ttovar"><input name="data[date]" value="{$order.date|date_format:"%d.%m.%Y"}" /></td>
            </tr>
            <tr>
                <td class="ttovar" width="200">Компания</td>
                <td class="ttovar"><input name="data[company]" value="{$order.company}" /></td>
            </tr>
            <tr>
                <td class="ttovar">ФИО</td>
                <td class="ttovar"><input name="data[fio]" value="{$order.fio}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Телефон</td>
                <td class="ttovar"><input name="data[phone]" value="{$order.phone}" /></td>
            </tr>
            <tr>
                <td class="ttovar">E-mail</td>
                <td class="ttovar"><input name="data[email]" value="{$order.email}" /></td>
            </tr>
            <tr>
                <td class="ttovar">Что желаете заказать?</td>
                <td class="ttovar"><textarea name="data[what]">{$order.what}</textarea></td>
            </tr>

        </table>

        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>

{else}

    <form action="?page={$page}" method="post">
        <table width="100%">
            <tr>
                <td class="ttovar" width="200">E-mail для рассылки</td>
                <td class="ttovar"><input name="email[email]" value="{$order_email.email}" /> </td>
            </tr>
        </table>
        <input type="hidden" name="email[id]" value="{$order_email.id}" />    
        <input id="save" name="save" type="submit" value="Сохранить" />
    </form>
    <br/><br/>

    {if $order_list!==false}
        <table width="100%">
            <tr>
                <td class="ttovar">Дата</td>
                <td class="ttovar">Компания</td>
                <td class="ttovar">ФИО</td>
                <td class="ttovar">Что хотели заказать?</td>
                <td class="ttovar">&nbsp;</td>
            </tr>

            {foreach from=$order_list item=order}
                <tr>
                    <td class="ttovar">{$order.date|date_format:"%d.%m.%Y"}</td>
                    <td class="ttovar">{$order.company}</td>
                    <td class="ttovar">{$order.fio}</td>
                    <td class="ttovar">{$order.what|truncate:100}</td>
                    <td class="tedit"><a href="?page={$page}&action=edit&id={$order.id}" class="tedit">редактировать</a><br/><br/>
                        <a href="?page={$page}&action=del&id={$order.id}" class="tdel">удалить</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}

{/if}