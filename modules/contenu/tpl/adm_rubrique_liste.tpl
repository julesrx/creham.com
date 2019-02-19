	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=rubrique&act=liste">>> Nouvelle Rubrique</a>
		</div>

		<div class="listeElt">
		{assign var="prec" value=""}
		{foreach from=$lElt item=cElt}
			{if $prec != $cElt->rub_type}
				<div style="padding: 3px;"><b>{if $cElt->rub_type == 1}PUBLIC{else} LOCATAIRES{/if}</b></div>
				{assign var="prec" value=$cElt->rub_type}
			{/if}
			<a href="gestion.php?ob=rubrique&act=liste&rub_id={$cElt->rub_id}">
					<div class="{if $cRubrique->rub_id == $cElt->rub_id}tblOn{else}tblOff{/if} statut{$cElt->rub_statut}" style="padding-left: 20px">
						{$cElt->rub_ordre} - {$cElt->rub_lib}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucune rubrique</div>
		{/foreach}
		</div>
		<div class="tblEntete">{sizeof liste=$lElt} rubriques</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"><i><b>{$cRubrique->rub_lib}</b></i></span>
			<form action="gestion.php?ob=rubrique&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$cRubrique->rub_id}" name="rub_id" id="rub_id">
				
				
				<label>Titre: </label><input type="text" class="formInput required" value="{$cRubrique->rub_lib}" name="rub_lib" id="rub_lib"/>
				<div class="nofloat"></div>
				<label>Ordre : </label><input type="text" class="formInput required" value="{$cRubrique->rub_ordre}" name="rub_ordre" id="rub_ordre"/>
				<div class="nofloat"></div>
				{*<label>Portée : </label><select name='rub_type' id='rub_type' class="formInput">
										{html_options options=$type_options selected=$cRubrique->rub_type}
										</select>
				<div class="nofloat"></div>
				*}
				
				<div class="nofloat">&nbsp;</div><div class="nofloat">&nbsp;</div>
				<div class="btnAction">
					{* {if $cRubrique->rub_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=rubrique&act=del&rub_id={$cRubrique->rub_id}', 'la suppression')"/>{/if} *}
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat"></div>
			</form>
		</div>

		{/if}
	</div>
	
{literal}
<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#formProfil").validate();
})
</script>
{/literal}
	