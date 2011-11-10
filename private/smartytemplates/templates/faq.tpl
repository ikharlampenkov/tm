<div style="background-color:#f0f0f0; padding:5px;"><h1>Вопрос-ответ</h1></div><br/>


<table width="100%" cellpadding="5" cellspacing="2">


    {if isset($faq) && $faq != false}
        <tr>
            <td class="pem"><b>{$faq.question}</b></td>
        </tr>
    {/if}

    {foreach from=$faq_list item=faq}

        <tr>
            <td class="pem">{*<img src="/img/page_word.png" /> *}<a href="javascript:showAnswer({$faq.id});">{$faq.question}</a>
                <div id="question_{$faq.id}" style="display:none;background-color: #ffffff;padding:10px;">{$faq.answer|nl2br}</div>
            </td>
        </tr>

    {/foreach}
</table>