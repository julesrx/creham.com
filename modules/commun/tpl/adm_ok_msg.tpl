{if $msg}
<div id="okMsg">{$msg}</div>
{literal}
	<script>
		$('#okMsg').fadeOut(5000);
	</script>
{/literal}
{/if}
{if $errMsg}
<div id="errMsg">{$errMsg}</div>
{literal}
	<script>
		$('#errMsg').fadeOut(5000);
	</script>
{/literal}
{/if}
		
		
		