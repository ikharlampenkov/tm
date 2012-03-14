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
    <img src="/i/add.png"/>&nbsp;<a href="javascript:void(0)" onclick="task.addDialog('{$this->url(['controller' => 'organization','action' => 'add'])}', 0, '{$this->url(['controller' => 'organization','action' => 'showTaskBlock', 'parent' => 0])}')">добавить</a>
</div>
{/if_allowed}

