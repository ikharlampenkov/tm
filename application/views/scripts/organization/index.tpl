<div class="page">
    <h1 style="width: 300px;">Организации</h1>

    <div class="page_block">
        {if_allowed resource="organization/index" priv="show-attribute-hash"}
            <a href="{$this->url(['controller' => 'organization', 'action' => 'viewHash'])}">Список атрибутов</a>
        {/if_allowed}

        {if_allowed resource="organization/index" priv="show-attribute-type"}
            <a href="{$this->url(['controller' => 'organization', 'action' => 'viewAttributeType'])}">Типы атрибутов</a>
        {/if_allowed}
    </div>

</div><br/>

{if_allowed resource="organization/add"}
    <div class="sub-menu">
        <img src="/i/add.png"/>&nbsp;<a href="javascript:void(0)" onclick="organization.addDialog('{$this->url(['controller' => 'organization','action' => 'add'])}', 0, '{$this->url(['controller' => 'organization', 'action' => 'index'])}')">добавить</a>
    </div>
{/if_allowed}

<div id="organization_block">
    <table>
        <tr>
            <td class="ttovar">Название</td>
            <td class="ttovar"></td>
        </tr>

        {if $organizationList!==false}
            {foreach from=$organizationList item=organization}
                <tr>
                    <td class="ttovar {if $organization->id == $organizationId}active{/if}"><a href="{$this->url(['controller' => 'user', 'action' => 'index', 'organizationId' => $organization->id, 'userType' => $userType])}">{$organization->title}</a></td>
                    <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                        <div class="btn-group">
                            <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                            <ul class="dropdown-menu pull-right">
                                {if_allowed resource="{'organization'}/edit"}
                                    <li><a href="javascript:void(0)" onclick="organization.editDialog('{$this->url(['controller' => 'organization', 'action' => 'edit', 'id' => $organization->id])}', 0, '{$this->url(['controller' => 'organization', 'action' => 'index'])}')"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                                {/if_allowed}

                                {if $organization->user->id == $authUserId || $authUserRole == 'admin'}
                                    {if_allowed resource="{'organization'}/delete"}
                                        <li><a href="javascript:void(0)" onclick="organization.deleteDialog('{$organization->title}', '{$this->url(['controller' => 'organization', 'action' => 'delete', 'id' => $organization->id])}', 0, '{$this->url(['controller' => 'organization', 'action' => 'index'])}');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                                    {/if_allowed}
                                {/if}
                            </ul>
                        </div>
                    </td>
                </tr>
            {/foreach}
        {/if}
    </table>
</div>
