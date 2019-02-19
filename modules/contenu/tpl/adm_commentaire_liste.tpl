	<div id="gauche">
		
		<div class="tblEntete">
			&nbsp;
		</div>

		<div class="listeElt">
		{assign var=prec value=""}
		{foreach from=$lElt item=cElt}
			{if $prec != $cElt->rub_id}
				<div style="padding: 3px;"><b>{$cElt->rub_lib}</b></div>
				{assign var=prec value=$cElt->rub_id}
			{/if}
			<a href="gestion.php?ob=comment&act={if $smarty.session.type == 'aValider'}aValider{else}liste{/if}&com_id={$cElt->com_id}">
					<div class="{if $cCommentaire->com_id == $cElt->com_id}tblOn{else}tblOff{/if} statut{$cElt->com_statut+0}" style="padding-left: 20px">
						{$cElt->com_date|date_format:"%d/%m/%Y"} - {$cElt->com_content|strip_tags|truncate:100}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucun commentaire</div>
		{/foreach}
		</div>
		<div class="tblEntete">{sizeof liste=$lElt} commentaires</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"><i><b>{$cCommentaire->com_titre}</b></i></span>
			<form action="gestion.php?ob=comment&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$cCommentaire->com_id}" name="com_id" id="com_id">
				
				<div class="btnAction">
					{if $cCommentaire->com_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=comment&act=del&com_id={$cCommentaire->com_id}', 'la suppression')"/>{/if}
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
				<label>Statut : </label><select name='com_statut' id='com_statut' class="formInput">
									{html_options options=$statusContrib_options selected=$cCommentaire->com_statut+0}
									</select>
				<div class="nofloat"></div>
				
				<label>Auteur : </label><input type="text" class="formDisable" value="{$cCommentaire->usr_prenom} {$cCommentaire->usr_nom}"/>
				<div class="nofloat"></div>			
				<label>Article : </label><input type="text" class="formDisable" value="{$cCommentaire->pg_titre}"/> <a href="gestion.php?ob=page&act=liste&pg_id={$cCommentaire->pg_id}" title="Voir l'article">( voir )</a>
				<div class="nofloat"></div>			
				<label>Commentaire : </label>
				<div class="nofloat"></div>				
				{PrintEditor innerHtml=$cCommentaire->com_content name="com_content" width="555" height="300"}
				<div class="nofloat"></div>				
				
				<label>Date de création : </label><input type="text" class="formDisable" value="{$cCommentaire->com_date|date_format:"%d/%m/%Y %H:%M"}"/>
				<div class="nofloat"></div>
				<div class="btnAction">
					{if $cCommentaire->com_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=comment&act=del&com_id={$cCommentaire->com_id}', 'la suppression')"/>{/if}
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
	