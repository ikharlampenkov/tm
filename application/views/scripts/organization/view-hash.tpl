{if_allowed resource="{$controller}/index" priv="show-attribute-hash"}
    <div class="page"><h1>Список атрибутов для организаций</h1></div>
    <br/>
    <div class="sub-menu">
        <img src="/i/add.png"/>&nbsp;<a href="{$this->url(['controller' => $controller,'action' => 'addAttributeHash'])}">добавить</a>
    </div>
    <table width="100%">
        <tr>
            <td class="ttovar">Ключ</td>
            <td class="ttovar">Название</td>
            <td class="ttovar">Тип</td>
            <td class="ttovar">Обязательное</td>
            <td class="ttovar">Порядок сортировки</td>
            <td class="ttovar"></td>
        </tr>

        {if $attributeHashList!==false}
            {foreach from=$attributeHashList item=attributeHash}
                <tr>
                    <td class="ttovar">{$attributeHash->attributeKey}</td>
                    <td class="ttovar">{$attributeHash->title}</td>
                    <td class="ttovar">{$attributeHash->type->title}</td>
                    <td class="ttovar">{if $attributeHash->isRequired}Да{else}Нет{/if}</td>
                    <td class="ttovar">{$attributeHash->sortOrder}</td>
                    <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                        <div class="btn-group">
                            <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{$this->url(['controller' => $controller,'action' => 'editAttributeHash', 'key' => $attributeHash->attributeKey])}"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                                <li><a href="{$this->url(['controller' => $controller,'action' => 'deleteAttributeHash', 'key' => $attributeHash->attributeKey])}" onclick="return confirmDelete('{$attributeHash->title}');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            {/foreach}
        {/if}

    </table>
{/if_allowed}