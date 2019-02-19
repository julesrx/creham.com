	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=tag&act=liste">>> Nouveau Mot-clé</a>
		</div>

		<div class="listeElt">
		{assign var=prec value=""}
		{foreach from=$lElt item=cElt}			
			<a href="gestion.php?ob=tag&act=liste&tag_id={$cElt->tag_id}&gstatut={$cElt->statut}">
					<div class="{if $cTag->tag_id == $cElt->tag_id}tblOn{else}tblOff{/if} statut{$cElt->tag_statut}" style="padding-left: 20px">
						{$cElt->tag_lib}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucun mot-clé</div>
		{/foreach}
		</div>
		<div class="tblEntete">{sizeof liste=$lElt} mots-clés</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"><i><b>{if $cTag->tag_id > 0}Mot-clé : {$cTag->tag_lib}{else}Nouveau mot-clé{/if}</b></i></span>
			<form action="gestion.php?ob=tag&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$cTag->tag_id}" name="tag_id" id="tag_id">
				
				<div class="nofloat">&nbsp;</div>
				<label>Libellé : </label><input type="text" class="formInput required" value="{$cTag->tag_lib}" name="tag_lib" id="tag_lib"/>
				<div class="nofloat"></div>
								
				<div class="btnAction">
					{if $cTag->tag_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=tag&act=del&tag_id={$cTag->tag_id}', 'la suppression')"/>{/if}
					<input type="submit" value="Enregistrer" class="btnSave"/>
					<div class="nofloat">&nbsp;</div>
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
	