<div style="background-color:#f0f0f0; padding:5px;"><h1>Отзывы о работе</h1></div><br/>

{if $review_list!==false}
    <table width="100%">
        <tr>
            <td class="ttovar">Отзыв</td>
            <td class="ttovar">Название</td>
            <td class="ttovar">&nbsp;</td>
        </tr>

        {foreach from=$review_list item=review}
            <tr>
                <td class="ttovar">{if $review.img_prew}<img src="{$siteurl}files/{$review.img_prew}" alt="{$review.title}"/>{else}&nbsp;{/if}</td>
                <td class="ttovar">{$review.title}</td>
            </tr>
        {/foreach}
    </table>
{/if}