	<div id="gauche">
		
		<div class="tblEntete">			
			<a href="gestion.php?ob=actu&act={if $smarty.session.type == 'aValider'}aValider{else}liste{/if}">>> Nouvelle Actualité</a>
		</div>
		
		
		<div class="listeElt">
		{assign var=prec value=""}
		{foreach from=$lElt item=cElt}
			{if $prec != $cElt->rub_id}
				<div style="padding: 3px;"><b>{$cElt->rub_lib}</b></div>
				{assign var=prec value=$cElt->rub_id}
			{/if}
			<a href="gestion.php?ob=actu&act={if $smarty.session.type == 'aValider'}aValider{else}liste{/if}&act_id={$cElt->act_id}">
					<div class="{if $cActualite->act_id == $cElt->act_id}tblOn{else}tblOff{/if} statut{$cElt->act_statut+0}" style="padding-left: 20px">
						{$cElt->act_date|date_format:"%d/%m/%Y"} - {$cElt->act_titre}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucune actualité</div>
		{/foreach}
		</div>
		<div class="tblEntete">{$nb+0} actualités</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"><i><b>{$cActualite->act_titre}</b></i></span>
			<form action="gestion.php?ob=actu&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$cActualite->act_id}" name="act_id" id="act_id">
				
				<div class="btnAction">
					{if $cActualite->act_id}						
						<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=actu&act=del&act_id={$cActualite->act_id}', 'la suppression')"/>
					{/if}
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
				
				<div id="tabs">
							
				
					<div id="niv1">  
						<label>Statut : </label><select name='act_statut' id='act_statut' class="formInput">
											{html_options options=$status_options selected=$cActualite->act_statut+0}
											</select>
						<div class="nofloat"></div>
						<label>Titre : </label><input type="text" class="formInput required" value="{$cActualite->act_titre}" name="act_titre" id="act_titre"/>
						<div class="nofloat"></div>		
						<label>Catégorie : </label><select name='act_type' id='act_type' class="formInput">
								<option value=""></option>
								{html_options options=$categorie_options selected=$cActualite->act_type}
						</select>
						<div class="nofloat"></div>
						<label>Chapo : </label>
						<div class="nofloat"></div>				
						{PrintEditor innerHtml=$cActualite->act_chapo name="act_chapo" width="80%"}
						<div class="nofloat"></div>
						<label style="width: 100% !important; max-width: 500px">Contenu (à compléter si non liée à un programme) : </label>
						<div class="nofloat"></div>				
						{PrintEditor innerHtml=$cActualite->act_contenu name="act_contenu" width="80%"}
						<div class="nofloat"></div>
								
						<label>Date de publication : </label><input type="text" class="formInput required datepicker" value="{$cActualite->act_date|date_format:"%d/%m/%Y"}" name="act_date" id="act_date"/>
						<div class="nofloat"></div>
						<input type="hidden" class="formInput required" value="{$cActualite->usr_id}" name="usr_id" id="usr_id"/>
						<label>Illustration:</label><input type="file" name="act_photo" /><input type="hidden" name="act_photo_old" value="{$cActualite->act_photo}"/>				
						{if $cActualite->act_photo}
							<div class="nofloat">&nbsp;</div>
							<a href="./upload/images/p_{$cActualite->act_photo}" target="_blank"  title="voir"><img src="./upload/images/vign_{$cActualite->act_photo}" alt="voir"/></a>
							<a href="javascript:checkConfirmUrl('gestion.php?ob=page&act=delPhoto&act_id={$cActualite->act_id}', 'la suppression')" title="supprimer"><img src="./images/icon_del.gif" alt="supprimer"/></a>
						{/if}
						<div class="nofloat">&nbsp;</div>
					</div>
				
				</div>
				<div class="nofloat"></div>	
				<div class="nofloat"></div>
				<div class="btnAction">
					{if $cActualite->act_id}
						<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=actu&act=del&act_id={$cActualite->act_id}', 'la suppression')"/>
					{/if}
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
			</form>
		</div>

		{/if}
	</div>
	
{literal}
<script>
$().ready(function() {
	
	$("#formProfil").validate({
		  rules: {
			  mention2: {
			      maxlength: 30
			    }
			  }});

	
})


</script>
{/literal}
	