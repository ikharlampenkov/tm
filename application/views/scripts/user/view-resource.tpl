{if_allowed resource="{$controller}/index" priv="show-resource"}
<br/>
<div style="background-color:#f0f0f0; padding:5px;"><h1>Ресурсы</h1></div><br/>


<table width="100%">
    <tr>
        <td class="ttovar" align="center" colspan="3"><a href="{$this->url(['controller' => $controller,'action' => 'addResource'])}">добавить</a></td>
    </tr>

{if $userResourceList!==false}
    {foreach from=$userResourceList item=resource}
        <tr>
            <td class="ttovar">{$resource->rtitle}</td>
            <td class="ttovar">{$resource->title}</td>
            <td class="tedit"><a href="{$this->url(['controller' => $controller,'action' => 'editResource', 'id' => $resource->id])}">редактировать</a><br/>
                <a href="{$this->url(['controller' => $controller,'action' => 'deleteResource', 'id' => $resource->id])}" onclick="return confirmDelete('{$resource->rtitle}');" style="color: #830000">удалить</a></td>
        </tr>
    {/foreach}
{/if}

</table>
{/if_allowed}