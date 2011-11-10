<div style="background-color:#f0f0f0; padding:5px;"><h1>Новости и события</h1></div><br/>

{if $action=='view_news'}

    <div>{$news.date|date_format:"%d.%m.%Y"}&nbsp;{$news.title}</div><br />
    <div>{$news.full_text}</div>

    <br/><br/>
    <a href="{$siteurl}?page=news" >Все новости</a>

{else}

    {foreach from=$news_list item=news}
        <div>
            {if $news.foto_prew}<img src="{$siteurl}files/{$news.foto_prew}" alt="{$news.title}" />{/if}
            <div>{$news.date|date_format:"%d.%m.%Y"}&nbsp;<b>{$news.title}</b></div>
            <div>{$news.short_text}</div>
        {if $news.full_text}<a href="{$siteurl}?page=news&action=view_news&id={$news.id}">подробнее...</a><br/>{/if}
    </div>
    <br/>
{/foreach}

{/if}