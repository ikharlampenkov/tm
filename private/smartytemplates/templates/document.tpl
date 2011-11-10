<div style="background-color:#f0f0f0; padding:5px;"><h1>{$document.title}</h1></div><br/>

{if $document_list != false}
    <table width="100%" cellpadding="5" cellspacing="2">
        {foreach from=$document_list item=document}
            <tr>
                <td class="peem">
                    <div><img src="/i/page_word.png" title=""/> <a href="{$siteurl}files/{$document.file}" title="{$document.short_text}" target="_blank">{$document.title}</a></div>
                </td>
            </tr>
        {/foreach}
    </table>
{/if}