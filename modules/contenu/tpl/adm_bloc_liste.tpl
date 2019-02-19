	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=bloc&act=liste">>> Nouveau bloc</a>
		</div>

		<div class="listeElt">
		{assign var=prec value=""}
		{foreach from=$lElt item=cElt}
			{if $prec != $cElt->rub_id}
				<div style="padding: 3px;"><b>{$cElt->rub_lib}</b></div>
				{assign var=prec value=$cElt->rub_id}
			{/if}
			<a href="gestion.php?ob=bloc&act=liste&bloc_id={$cElt->bloc_id}">
					<div class="{if $cBloc->bloc_id == $cElt->bloc_id}tblOn{else}tblOff{/if} statut{$cElt->bloc_statut+0}" style="padding-left: 20px">
						{$cElt->bloc_position} - {$cElt->bloc_ordre} - {$cElt->bloc_lib}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucun bloc</div>
		{/foreach}
		</div>
		<div class="tblEntete">{sizeof liste=$lElt} blocs</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"><i><b>{$cBloc->bloc_titre}</b></i></span>
			<form action="gestion.php?ob=bloc&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$cBloc->bloc_id}" name="bloc_id" id="bloc_id">
				
				<div class="btnAction">
					{if $cBloc->bloc_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=bloc&act=del&bloc_id={$cBloc->bloc_id}', 'la suppression')"/>{/if}
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
				<label>Statut : </label><select name='bloc_statut' id='bloc_statut' class="formInput">
									{html_options options=$status_options selected=$cBloc->bloc_statut+0}
									</select>
				<div class="nofloat"></div>
				
				<label>Titre : </label><input type="text" class="formInput" value="{$cBloc->bloc_lib}" id="bloc_lib" name="bloc_lib"/>
				<div class="nofloat"></div>			
		
				<label>Contenu : </label>
				<div class="nofloat"></div>				
				{PrintEditor innerHtml=$cBloc->bloc_content name="bloc_content" width="555" height="300"}
				<div class="nofloat"></div>				
				<label>Type : </label><select name='bloc_type' id='bloc_type' class="formInput">
									{html_options options=$bloc_options selected=$cBloc->bloc_type+0}
									</select>
				<div class="nofloat"></div>
				<label>Position : </label><select name='bloc_position' id='bloc_position' class="formInput">
									{html_options options=$position_options selected=$cBloc->bloc_position+0}
									</select>
				<div class="nofloat"></div>
				<label>Ordre : </label><input type="text" class="formInput" value="{$cBloc->bloc_ordre}" id="bloc_ordre" name="bloc_ordre"/>
				<div class="nofloat"></div>			

				<div class="btnAction">
					{if $cBloc->bloc_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=bloc&act=del&bloc_id={$cBloc->bloc_id}', 'la suppression')"/>{/if}
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
		// validate the bloc form when it is submitted
		$("#formProfil").validate();
		$('#div_fr').show();

})
</script>
{/literal}
	