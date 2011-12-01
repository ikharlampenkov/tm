<div class="page"><h1>{if !isset($discussion)}Обсуждение{else}Тема: {$discussion->title}{/if}</h1></div><br/>

{if isset($breadcrumbs)}
    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => 0])}">/..</a>
    {if !empty($breadcrumbs)}
    &nbsp;/
    {foreach from=$breadcrumbs item=crumb name=_crumb}
    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $crumb->id])}">{$crumb->title}</a>&nbsp;/
    {/foreach}
    {/if}
    <br/><br/>
{/if}


<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="4">
            {if_allowed resource="{$controller}/addTopic"}
            <a href="{$this->url(['controller' => $controller,'action' => 'addTopic'])}">добавить тему</a> /
            {/if_allowed}
            {if_allowed resource="{$controller}/add"}
            {if isset($parentId) && $parentId>0}
            <a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить комментарий</a>
            {/if}
            {/if_allowed}
        </td>
    </tr>

{if $discussionList!==false}
    {foreach from=$discussionList item=discussion}
        {if_object_allowed type="{$controller|capitalize}" object="{$discussion}"}
        <tr>
            <td class="ttovar">
                {if $discussion->isTopic()}
                    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $discussion->id])}">{$discussion->message}</a>
                {else}
                    {$discussion->message}
                {/if}</td>
            <td class="ttovar">{$discussion->datecreate|date_format:"%d.%m.%Y"}</td>
            <td class="tedit">
                {if_allowed resource="{$controller}/showAcl"}
                 <a href="{$this->url(['controller' => $controller,'action' => 'showAcl', 'idDiscussion' => $discussion->id])}">права</a>
                {/if_allowed}
            </td>
            <td class="tedit">
                {if $discussion->isTopic()}
                    {if_allowed resource="{$controller}/editTopic"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'editTopic', 'id' => $discussion->id])}">редактировать</a><br/>
                    {/if_allowed}
                    {if_allowed resource="{$controller}/deleteTopic"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'deleteTopic', 'id' => $discussion->id])}" onclick="return confirmDelete('{$discussion->id}');" style="color: #830000">удалить</a>
                    {/if_allowed}
                {else}
                    {if_allowed resource="{$controller}/edit"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $discussion->id])}">редактировать</a><br/>
                    {/if_allowed}
                    {if_allowed resource="{$controller}/delete"}
                    <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $discussion->id])}" onclick="return confirmDelete('{$discussion->id}');" style="color: #830000">удалить</a>
                    {/if_allowed}
                {/if}
            </td>

        </tr>
        {/if_object_allowed}
    {/foreach}
{/if}

</table>