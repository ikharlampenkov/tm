{if $exception}
<script>
function closeErrorMsg()
{ldelim}
 o_errorblock = document.getElementById("errorblock");
 o_errorblock.style.display = "none";
{rdelim}
</script>
<div style="background-color:#ffffd7; border : 1px solid Black; font-size:12px; color:#000000; width:400px;" id="errorblock">
<div>Сообщение об ошибке: {$e_message}</div>
<div>Код ошибки: {$e_code}</div>
<input type="button" value="Закрыть" onclick="closeErrorMsg();">
</div>
{/if}