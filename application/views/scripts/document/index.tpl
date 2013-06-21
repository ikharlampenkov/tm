<div class="page">
    <h1>{if !isset($document)}Документы{else}Документ: {$document->title}{/if}</h1>

    <div class="page_block">
        {if_allowed resource="{$controller}/index" priv="show-attribute-hash"}
            <a href="{$this->url(['controller' => $controller, 'action' => 'viewHash'])}">Список атрибутов</a>
        {/if_allowed}

        {if_allowed resource="{$controller}/index" priv="show-attribute-type"}
            <a href="{$this->url(['controller' => $controller, 'action' => 'viewAttributeType'])}">Типы атрибутов</a>
        {/if_allowed}
    </div>

</div><br/>

{if isset($breadcrumbs)}
    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => 0])}">/..</a>
    {if !empty($breadcrumbs)}
        &nbsp;/
        {foreach from=$breadcrumbs item=crumb name=_crumb}
            <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $crumb->id])}">{$crumb->title}</a>
            &nbsp;/
        {/foreach}
    {/if}
    <br/>
    <br/>
{/if}


<table width="100%">

    <tr>
        <td class="ttovar" align="center" colspan="4">
            {if_allowed resource="{$controller}/addFolder"}
                <img src="/i/add.png"/>
                &nbsp;
                <a href="{$this->url(['controller' => $controller,'action' => 'addFolder'])}">добавить папку</a>
                /
            {/if_allowed}
            {if_allowed resource="{$controller}/add"}
            {if isset($parentId) && $parentId>0}
                <img src="/i/add.png"/>
                &nbsp;
                <a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить документ</a>
            {/if}
            {/if_allowed}
        </td>
    </tr>


    {if $documentList!==false}
        {foreach from=$documentList item=document}
            {if_object_allowed type="{$controller|capitalize}" object="{$document}"}
                <tr>
                    <td class="ttovar">
                        {if $document->isFolder}
                            <img src="/i/folder.png"/>
                            &nbsp;
                            <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $document->id])}">{$document->title}</a>
                        {else}
                            <img src="/i/document.png"/>
                            &nbsp;
                            {if $document->file->getName()}<a href="/files{$document->file->getSubPath()}/{$document->file->getName()}">{/if}
                            {if $document->title != ''}{$document->title}{else}Загрузить{/if}
                            {if $document->file->getName()}</a>{/if}
                        {/if}</td>
                    <td class="ttovar">{$document->datecreate|date_format:"%d.%m.%Y"}</td>
                    {if !$document->isFolder}
                        <td class="tedit">
                            {if_allowed resource="{$controller}/showDiscussion"}
                                <img src="/i/discussion_mini.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'showDiscussion', 'idDocument' => $document->id])}">обсуждение</a>
                            {/if_allowed}
                        </td>
                    {else}
                        <td class="tedit"></td>
                    {/if}
                    <td class="tedit">
                        {if_allowed resource="{$controller}/showAcl"}
                            <img src="/i/comanda.png"/>
                            &nbsp;
                            <a href="{$this->url(['controller' => $controller,'action' => 'showAcl', 'idDocument' => $document->id])}">права</a>
                        {/if_allowed}
                    </td>
                    <td class="tedit">
                        {if $document->isFolder}
                            {if_allowed resource="{$controller}/editFolder"}
                            {if_object_allowed type="{$controller|capitalize}" object="{$document}" priv="write"}
                                <img src="/i/edit.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'editFolder', 'id' => $document->id])}">редактировать</a>
                                <br/>
                            {/if_object_allowed}
                            {/if_allowed}
                            {if_allowed resource="{$controller}/deleteFolder"}
                                <img src="/i/delete.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'deleteFolder', 'id' => $document->id])}" onclick="return confirmDelete('{$document->title}');" style="color: #830000">удалить</a>
                            {/if_allowed}
                        {else}
                            {if_allowed resource="{$controller}/view"}
                                <img src="/i/document.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'view', 'id' => $document->id])}">просмотреть</a>
                                <br/>
                            {/if_allowed}
                            {if_allowed resource="{$controller}/edit"}
                            {if_object_allowed type="{$controller|capitalize}" object="{$document}" priv="write"}
                                <img src="/i/edit.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $document->id])}">редактировать</a>
                                <br/>
                            {/if_object_allowed}
                            {/if_allowed}
                            {if_allowed resource="{$controller}/delete"}
                                <img src="/i/delete.png"/>
                                &nbsp;
                                <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $document->id])}" onclick="return confirmDelete('{$document->title}');" style="color: #830000">удалить</a>
                            {/if_allowed}
                        {/if}
                    </td>

                </tr>
            {/if_object_allowed}
        {/foreach}
    {/if}

</table>