{if_allowed resource="{$controller}/index" priv="show-attribute-type"}
    <div class="page"><h1>Типы атрибутов</h1></div>
    <br/>
    <div class="sub-menu">
        <img src="/i/add.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'addAttributeType'])}">добавить</a>
    </div>
    <table width="100%">
        <tr>
            <td class="ttovar">Название</td>
            <td class="ttovar">Класс</td>
            <td class="ttovar"></td>
        </tr>

        {if $attributeTypeList!==false}
            {foreach from=$attributeTypeList item=attributeType}
                <tr>
                    <td class="ttovar">{$attributeType->title}</td>
                    <td class="ttovar">{$attributeType->handler}</td>
                    <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                        <div class="btn-group">
                            <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{$this->url(['controller' => $controller, 'action' => 'editAttributeType', 'id' => $attributeType->id])}"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                                <li><a href="{$this->url(['controller' => $controller, 'action' => 'deleteAttributeType', 'id' => $attributeType->id])}" onclick="return confirmDelete('{$attributeType->title}');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            {/foreach}
        {/if}

    </table>
{/if_allowed}