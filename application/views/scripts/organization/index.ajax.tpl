<table>
    <tr>
        <td class="ttovar">Название</td>
        <td class="ttovar"></td>
    </tr>

    {if $organizationList!==false}
        {foreach from=$organizationList item=organization}
            <tr>
                <td class="ttovar" {if $organization->id == $organizationId}class="active"{/if}>{$organization->title}</td>
                <td class="tedit" style="width: 20px; background-color: #f7f7f7;">
                    <div class="btn-group">
                        <button style="border: 0" data-toggle="dropdown"><i class="icon-edit"></i></button>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{$this->url(['controller' => 'organization', 'action' => 'edit', 'id' => $organization->id])}"><img src="/i/edit.png"/>&nbsp;редактировать</a></li>
                            <li><a href="{$this->url(['controller' => 'organization', 'action' => 'delete', 'id' => $organization->id])}" onclick="return confirmDelete('{$organization->title}');" style="color: #830000"><img src="/i/delete.png"/>&nbsp;удалить</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        {/foreach}
    {/if}
</table>
