<div style="background-color:#f0f0f0; padding:5px;"><h1>Контактная информация</h1></div><br/>

<table width="100%">
    <tr>
        <td class="ttovar" width="200">Название</td>
        <td class="ttovar">{$contacts.title}</td>
    </tr>
    <tr>
        <td class="ttovar">Адрес</td>
        <td class="ttovar">{$contacts.address}</td>
    </tr>
    <tr>
        <td class="ttovar">Почтовый адрес</td>
        <td class="ttovar">{$contacts.address_mail}</td>
    </tr>
    <tr>
        <td class="ttovar">Телефон, факс</td>
        <td class="ttovar">{$contacts.phone}</td>
    </tr>
    <tr>
        <td class="ttovar">E-mail</td>
        <td class="ttovar">{$contacts.email}</td>
    </tr>
    <tr>
        <td class="ttovar">ИНН</td>
        <td class="ttovar">{$contacts.inn}</td>
    </tr>
    <tr>
        <td class="ttovar">КПП</td>
        <td class="ttovar">{$contacts.kpp}</td>
    </tr>
    <tr>
        <td class="ttovar">Расчетный счет</td>
        <td class="ttovar">{$contacts.current_account}</td>
    </tr>

    <tr>
        <td class="ttovar">Карта проезда</td>
        <td class="ttovar">{if $contacts.map}<img src="{$siteurl}files/{$contacts.map}" alt="Карта проезда" />{/if}
        </td>
    </tr>
</table>