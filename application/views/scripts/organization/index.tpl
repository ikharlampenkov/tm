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

</div><br />

{if_allowed resource="organization/add"}
    <div class="sub-menu">
        <img src="/i/add.png" />&nbsp;<a href="javascript:void(0)" onclick="organization.addDialog('{$this->url(['controller' => 'organization','action' => 'add'])}', 0, '{$this->url(['controller' => 'organization','action' => 'showTaskBlock', 'parent' => 0])}')">добавить</a>
    </div>
{/if_allowed}

<div class="well" style="padding: 8px 0;">
    <ul class="nav nav-list">
        {if $organizationList !== false}
            {foreach from=$organizationList item=organization}
                <li {if $organization->id == $organizationId}class="active"{/if}>
                    <a href="/menu/index/menuId/{$organization->id}/">{$organization->title}</a>
                    <span class="edit"><a href="{$this->url(['controller' => 'menu', 'action' => 'editmenu', 'id' => $organization->id])}"><i class="icon-pencil"></i></a></span>
                    <span class="del"><a href="{$this->url(['controller' => 'menu', 'action' => 'deletemenu', 'id' => $organization->id])}" onclick="return confirmDelete('{$organization->title}');"><i class="icon-remove"></i></a></span>
                </li>
            {/foreach}
        {/if}
    </ul>
</div>

