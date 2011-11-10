<div style="background-color:#f0f0f0; padding:5px;"><h1>СМИ о компании</h1></div><br/>

{if $action=='view_smi'}

    <div>{$smi.date|date_format:"%d.%m.%Y"}&nbsp;{$smi.title}</div><br />
    <div>{$smi.full_text}</div>

    <br/><br/>
    <a href="{$siteurl}?page=smi" >Все статьи</a>

{else}

    {foreach from=$smi_list item=smi}
        <div>{$smi.date|date_format:"%d.%m.%Y"}&nbsp;<b>{$smi.title}</b></div>
        <div>{$smi.short_text}</div>
    {if $smi.full_text}<a href="{$siteurl}?page=smi&action=view_smi&id={$smi.id}">подробнее...</a><br/>{/if}
    <br/>
{/foreach}

{/if}