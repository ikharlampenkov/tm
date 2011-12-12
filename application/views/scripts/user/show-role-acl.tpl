<div style="background-color:#f0f0f0; padding:5px;"><h1>Права для роли {$role->rtitle} <a href="{$this->url(['controller' => $controller, 'action'=> 'index'])}">Все роли</a></h1></div><br/>

{if isset($exception_msg)}
<div>Ошибка: {$exception_msg}</div><br/>
{/if}

<form action="{$this->url(['controller' => $controller, 'action' => 'showRoleAcl', 'idRole' => $role->id])}" method="post">
<table width="100%">
   <tr>
       <td class="ttovar_title">Ресурс</td>
       <td class="ttovar" style="width: 90px;">Разрешение</td>
       <td class="ttovar">Уточнение привелегий</td>
   </tr>

{if $userResourceList!==false}
    {foreach from=$userResourceList item=resource}
        <tr>
            <td class="ttovar_title">{$resource->title}</td>
            <td class="ttovar"><input type="checkbox" name="data[{$resource->id}][is_allow]" {if isset($roleAcl[{$resource->id}]) && $roleAcl[{$resource->id}]->isAllow}checked="checked"{/if} /></td>
            <td class="ttovar"><input name="data[{$resource->id}][privileges]" value="{if isset($roleAcl[{$resource->id}])}{$roleAcl[{$resource->id}]->privileges}{else}show{/if}"/></td>
        </tr>
    {/foreach}
{/if}

</table>
        <input id="save" name="save" type="submit" value="Сохранить"/>
</form>