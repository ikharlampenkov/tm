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
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'addTopic'])}">добавить тему</a> / <a href="{$this->url(['controller' => $controller,'action' => 'add'])}">добавить комментарий</a></td>
    </tr>

{if $discussionList!==false}
    {foreach from=$discussionList item=discussion}
        <tr>
            <td class="ttovar">
                {if $discussion->isTopic}
                    <a href="{$this->url(['controller' => $controller,'action' => 'index', 'parent' => $discussion->id])}">{$discussion->title}</a>
                {else}
                    {$discussion->title}
                {/if}</td>
            <td class="ttovar">{$discussion->datecreate|date_format:"%d.%m.%Y"}</td>
            <td class="tedit">
                {if $discussion->isTopic}
                    <a href="{$this->url(['controller' => $controller,'action' => 'editTopic', 'id' => $discussion->id])}">редактировать</a><br/>
                    <a href="{$this->url(['controller' => $controller,'action' => 'deleteTopic', 'id' => $discussion->id])}" onclick="return confirmDelete('{$discussion->id}');" style="color: #830000">удалить</a>
                {else}
                    <a href="{$this->url(['controller' => $controller,'action' => 'edit', 'id' => $discussion->id])}">редактировать</a><br/>
                    <a href="{$this->url(['controller' => $controller,'action' => 'delete', 'id' => $discussion->id])}" onclick="return confirmDelete('{$discussion->id}');" style="color: #830000">удалить</a>
                {/if}
            </td>

        </tr>
    {/foreach}
{/if}

</table>