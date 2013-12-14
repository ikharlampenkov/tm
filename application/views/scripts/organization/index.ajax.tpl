<table>
    <tr>
        <td class="ttovar">Название</td>
        <td class="ttovar"></td>
    </tr>

    {if $organizationList!==false}
        {foreach from=$organizationList item=organization}
            <tr>
                <td id="organization_{$organization->id}" class="ttovar {if $organization->id == $organizationId}active{/if}"><a href="javascript:void(0)" onclick="organization.openUser('{$this->url(['controller' => 'user', 'action' => 'index', 'userType' => $userType])}', {$organization->id})">{$organization->title}</a></td>
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
