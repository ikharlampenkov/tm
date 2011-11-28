<div class="page"><h1>Обсуждение задачи: {$task->title}</h1></div><br/>

{if $discussionList!==false}
    {foreach from=$discussionList item=discussion}
        {if_object_allowed type="{$controller}" object="{$discussion}"}
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