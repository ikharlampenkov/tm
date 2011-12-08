<div class="page"><h1>Добавить ресурс</h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller,'action' => 'addResource'])}" method="post">
    <table>
        <tr>
            <td class="ttovar" width="200">Название</td>
            <td class="ttovar"><input name="data[title]" value="{$resource->title}"/></td>
        </tr>
        <tr>
            <td class="ttovar" width="200">Русское название</td>
            <td class="ttovar"><input name="data[rtitle]" value="{$resource->rtitle}"/></td>
        </tr>
    </table>
    <input id="save" name="save" type="submit" value="Сохранить"/>
</form>