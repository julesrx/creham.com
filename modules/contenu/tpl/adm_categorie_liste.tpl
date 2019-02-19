	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=categ&act=liste">>> Nouvelle Catégorie</a>
		</div>

		<div class="listeElt">
		{assign var=prec value=""}
		{foreach from=$lElt item=cElt}
			{if $prec != $cElt->rub_id}
				<div style="padding: 3px;"><b>{$cElt->rub_lib}</b></div>
				{assign var=prec value=$cElt->rub_id}
			{/if}
			<a href="gestion.php?ob=categ&act=liste&cat_id={$cElt->cat_id}&gstatut={$cElt->statut}">
					<div class="{if $cCategorie->cat_id == $cElt->cat_id}tblOn{else}tblOff{/if} statut{$cElt->cat_statut}" style="padding-left: 20px">
						{$cElt->cat_ordre} - {$cElt->cat_lib}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucune catégorie</div>
		{/foreach}
		</div>
		<div class="tblEntete">{sizeof liste=$lElt} catégories</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"><i><b>{if $cCategorie->cat_id > 0}Catégorie : {$cCategorie->cat_lib}{else}Nouvelle catégorie{/if}</b></i></span>
			<form action="gestion.php?ob=categ&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$cCategorie->cat_id}" name="cat_id" id="cat_id">
				
				<div class="nofloat">&nbsp;</div>
				<label>Titre : </label><input type="text" class="formInput required" value="{$cCategorie->cat_lib}" name="cat_lib" id="cat_lib"/>
				<div class="nofloat"></div>
				<label>Ordre : </label><input type="text" class="formInput required" value="{$cCategorie->cat_ordre}" name="cat_ordre" id="cat_ordre"/>
				<div class="nofloat"></div>				
								
				<div class="btnAction">
					{if $cCategorie->cat_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=categ&act=del&cat_id={$cCategorie->cat_id}', 'la suppression')"/>{/if}
					<input type="submit" value="Enregistrer" class="btnSave"/>
					<div class="nofloat">&nbsp;</div>
				</div>

				<div class="nofloat"></div>	


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
		$('#div_fr').show();

})
</script>
{/literal}
	