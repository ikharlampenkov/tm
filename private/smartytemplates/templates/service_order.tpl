<div style="background-color:#f0f0f0; padding:5px;"><h1>Заказ услуг</h1></div><br/>

<form action="?page={$page}" method="post" enctype="multipart/form-order">
    <table width="100%">
        <tr>
            <td class="ttovar" width="200">Компания</td>
            <td class="ttovar"><input name="order[company]" value="" /></td>
        </tr>
        <tr>
            <td class="ttovar">ФИО</td>
            <td class="ttovar"><input name="order[fio]" value="" /></td>
        </tr>
        <tr>
            <td class="ttovar">Телефон</td>
            <td class="ttovar"><input name="order[phone]" value="" /></td>
        </tr>
        <tr>
            <td class="ttovar">E-mail</td>
            <td class="ttovar"><input name="order[email]" value="" /></td>
        </tr>
        <tr>
            <td class="ttovar">Что желаете заказать?</td>
            <td class="ttovar"><textarea name="order[what]"></textarea></td>
        </tr>

    </table>

    <input id="save" name="save" type="submit" value="Отправить" />
</form>