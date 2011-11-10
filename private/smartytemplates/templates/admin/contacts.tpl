<div style="background-color:#f0f0f0; padding:5px;"><h1>Контактная информация</h1></div><br/>

<form action="?page={$page}" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td class="ttovar" width="200">Название</td>
            <td class="ttovar"><input name="data[title]" value="{$contacts.title}" /></td>
        </tr>
        <tr>
            <td class="ttovar">Адрес</td>
            <td class="ttovar"><input name="data[address]" value="{$contacts.address}" /></td>
        </tr>
         <tr>
            <td class="ttovar">Почтовый адрес</td>
            <td class="ttovar"><input name="data[address_mail]" value="{$contacts.address_mail}" /></td>
        </tr>
         <tr>
            <td class="ttovar">Телефон, факс</td>
            <td class="ttovar"><input name="data[phone]" value="{$contacts.phone}" /></td>
        </tr>
         <tr>
            <td class="ttovar">E-mail</td>
            <td class="ttovar"><input name="data[email]" value="{$contacts.email}" /></td>
        </tr>
         <tr>
            <td class="ttovar">ИНН</td>
            <td class="ttovar"><input name="data[inn]" value="{$contacts.inn}" /></td>
        </tr>
         <tr>
            <td class="ttovar">КПП</td>
            <td class="ttovar"><input name="data[kpp]" value="{$contacts.kpp}" /></td>
        </tr>
        <tr>
            <td class="ttovar">Расчетный счет</td>
            <td class="ttovar"><textarea name="data[current_account]">{$contacts.current_account}</textarea></td>
        </tr>

        <tr>
            <td class="ttovar">Карта проезда</td>
            <td class="ttovar">{if isset($contacts) && $contacts.map}<img src="{$siteurl}files/{$contacts.map}" /><br />
                &nbsp;<a href="?page={$page}&action=del_map">удалить</a><br />{/if}
                <input type="file"  name="map" />
            </td>
        </tr>
    </table>

    <input type="hidden" name="data[id]" value="{$contacts.id}" />
    <input id="save" name="save" type="submit" value="Сохранить" />
</form>