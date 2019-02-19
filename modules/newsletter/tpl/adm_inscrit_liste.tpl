	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=nl&act=listeInsc">>> Nouvel abonné</a>
		</div>

		<div class="listeElt">
		{assign var=prec value=""}
		{foreach from=$lElt item=cElt}
			{if $prec != $cElt->insc_type}
				<div style="padding: 3px;"><b>{$cElt->insc_type}</b></div>
				{assign var=prec value=$cElt->insc_type}
			{/if}
			<a href="gestion.php?ob=nl&act=listeInsc&insc_id={$cElt->insc_id}">
					<div class="{if $curElt->insc_id == $cElt->insc_id}tblOn{else}tblOff{/if} statut{$cElt->insc_statut}" style="padding-left: 20px">
						{$cElt->insc_email}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucun abonné</div>
		{/foreach}
		</div>
		<div class="tblEntete">{$nb+0} abonnés</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"></span>
			<form action="gestion.php?ob=nl&act=saveInsc" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$curElt->insc_id}" name="insc_id" id="insc_id">
				
				<label>Email : </label><input type="text" class="formInput required" value="{$curElt->insc_email}" name="insc_email" id="insc_email"/>
				<div class="nofloat"></div>
				<label>Inscrit le : </label><input type="text" class="formInput" value="{$curElt->insc_date|date_format:"%d/%m/%Y"}" name="insc_date" id="insc_date"/>
				<div class="nofloat"></div>
				<label>Catégorie : </label><select name='insc_type' id='insc_type' class="formInput">
									{html_options options=$type_options selected=$curElt->insc_type	}
									</select>
				<div class="nofloat"></div>
				<label>Nouvelle catégorie : </label><input type="text" class="formInput" value="" name="new_type" id="new_type"/>
				<div class="nofloat"></div>
				
				<div class="nofloat"></div>	
				<div align="right">
					<input type="button" value="Supprimer" style="width: 60px; margin-right: 5px; " onclick="checkConfirmUrl('gestion.php?ob=nl&act=delInsc&insc_id={$curElt->insc_id}', 'la suppression')">
					<input type="submit" value="Enregistrer" style="width: 60px; margin-right: 5px;">
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
	