<form action="gestion.php?ob=page&act=duplic" method="post">
	<input type="hidden" name="pg_id" value="{$smarty.get.pg_id}"/>
	<div>Sélectionner les sites vers lesquels dupliquer la page en cours :</div>
	<div>&nbsp;</div>
	{foreach from=$site_options item=site_lib key=site_id}
		{if $site_id > 0 && $site_id != $curSid}
			<div>
				<input type="checkbox" value="{$site_id}" name="site_id[]" /> <strong>{$site_lib}</strong>
			</div>
		{/if}
	{/foreach}
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<input type="submit" value="Dupliquer" class="btnSave" />
</form>