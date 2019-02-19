<div style="height: 500px; width:650px; font-size: 1.2em; ">
<h1>Suivi d'envoi de <i>{$cNl->nl_titre}</i></h1>
	<div style="height: 450px; width:auto; overflow: auto">
		<table width="100%">
			<tr align="left">
				<th width="40%">Email</th><th width="30%">Date d'envoi</th><th width="30%">Date d'ouverture</th>
			</tr>
			{assign var=nbEnvoi value=0}
			{assign var=nbAffiche value=0}
			{foreach from=$lSuiv item=cSuiv}
				<tr>
					<td><b>{$cSuiv->usr_nom} {$cSuiv->usr_prenom}</b> <small>({$cSuiv->usr_login})</small></td>
					<td>{$cSuiv->suiv_d_envoi|date_format:"%d/%m/%Y %H:%I"}</td>
					<td>{$cSuiv->suiv_d_visit|date_format:"%d/%m/%Y %H:%I"}</td>
				</tr>
				{if $cSuiv->suiv_d_envoi}{assign var=nbEnvoi value=$nbEnvoi+1}{/if}
				{if $cSuiv->suiv_d_visit}{assign var=nbAffiche value=$nbAffiche+1}{/if}
			{foreachelse}
				<tr><td colspan="3">Aucun envoi</td></tr>
			{/foreach}
			<tr align="left">
				<th width="40%">Total :</th><th width="30%">{$nbEnvoi}</th><th width="30%">{$nbAffiche}</th>
			</tr>
		</table>
	</div>
</div>