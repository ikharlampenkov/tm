<h1>Редактировать роль</h1>

<form action="{$this->url(['controller' => $controller,'action' => 'editRole', 'id' => $role->id])}" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Название</td>
            <td class="ttovar"><input name="data[title]" value="{$role->title}"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>