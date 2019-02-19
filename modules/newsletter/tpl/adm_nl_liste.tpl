	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=nl&act=listeNL">>> Nouvelle Newsletter</a>
		</div>

		<div class="listeElt">
		{assign var=prec value=""}
		{foreach from=$lElt item=cElt}
			{if $prec != $cElt->nl_type}
				<div style="padding: 3px;"><b>{$cElt->nl_type}</b></div>
				{assign var=prec value=$cElt->nl_type}
			{/if}
			<a href="gestion.php?ob=nl&act=listeNL&nl_id={$cElt->nl_id}">
					<div class="{if $curElt->nl_id == $cElt->nl_id}tblOn{else}tblOff{/if} statut{$cElt->nl_statut+0}" style="padding-left: 20px">
						{$cElt->nl_titre}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucune newsletter</div>
		{/foreach}
		</div>
		<div class="tblEntete">{$nb+0} newsletters</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre">
				{if $curElt->nl_id}
					<input type="button" value="PREVISUALISER" onclick="window.open('gestion.php?ob=nl&act=viewNL&nl_id={$curElt->nl_id}&pop=X')" class="onglet"/>
					<input type="button" value="TESTER" onclick="checkConfirmUrl('gestion.php?ob=nl&act=sendTestNL&nl_id={$curElt->nl_id}', 'le test')" class="onglet"/>
					<input type="button" value="ENVOYER" onclick="checkConfirmUrl('gestion.php?ob=nl&act=sendNL&nl_id={$curElt->nl_id}', 'l\'envoi')" class="onglet"/>
					<div style="float: right; margin-right: 20px;"><a href="javascript:void(0)" onclick="openModalPopup('gestion.php?ob=nl&act=suiviNL&nl_id={$curElt->nl_id}&pop=X', 'Suivi', 500, 800)" class="popup onglet">Suivi</a></div>
					{/if}
			</span>
			
			<form action="gestion.php?ob=nl&act=saveNL" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$curElt->nl_id}" name="nl_id" id="nl_id">
				<div class="btnAction">
					{if $curElt->nl_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=nl&act=delNL&nl_id={$curElt->nl_id}', 'la suppression')"/>{/if}
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat"></div>
				<label>Statut : </label><select name='nl_statut' id='nl_statut' class="formInput">
										{html_options options=$status_options selected=$curElt->nl_statut+0}
										</select>
					<div class="nofloat"></div>
				<label>Titre (gestion) : </label><input type="text" class="formInput required" value="{$curElt->nl_titre}" name="nl_titre" id="nl_titre"/>
				<div class="nofloat"></div>
				
				{if $curElt->nl_id}
					<label>Créée le : </label><label>{$curElt->nl_d_crea|date_format:"%d/%m/%Y"}</label>
					<div class="nofloat"></div>
				{/if}
				<label>Sujet du mail : </label><input type="text" class="formInput required" value="{$curElt->nl_sujet}" name="nl_sujet" id="nl_sujet"/>
				<div class="nofloat"></div>
				<div id="tabs">
					<ul>
					    <li><a href="#niv1"><span>Corps</span></a></li>
					    <li><a href="#niv2"><span>Construction</span></a></li>				   
					</ul>
					<div id="niv1">
						<label>Corps du mail : </label>
						<div class="nofloat"></div>				
						{PrintEditor innerHtml=$curElt->nl_corps name="nl_corps" width="555" height="350"}
						<div class="nofloat"></div>
					</div>
					<div id="niv2" style="background-color: #F0F0F0;">
						<button id="recopie" class="rond" style="background-color: orange; padding: 5px;">Recopier dans le corps de la newsletter</button>
						<br/><br/>
						<div id="source">
							{include file="newsletter/tpl/template.tpl"}
						</div>
						
					</div>
				</div>
				<label>Pièce jointe :</label><input type="file" name="nl_pj" /><input type="hidden" name="nl_pj_old" value="{$curElt->nl_pj}"/>
				{if $curElt->nl_pj}
					<div class="nofloat">&nbsp;</div>
					<a href="./upload/{$curElt->nl_pj}" target="_blank"><img src="./images/pdf.jpg" height="50"/></a>
					<a href="javascript:checkConfirmUrl('gestion.php?ob=nl&act=delPJ&pg_id={$curElt->nl_id}', 'la suppression')">Supprimer ?</a>
				{/if}
				<div class="nofloat">&nbsp;</div>
				<label>Email de test :<br/><small>(séparés par ;)</small> </label><input type="text" class="formInput" value="{$curElt->nl_test_mail}" name="nl_test_mail" id="nl_test_mail"/>
				<div class="nofloat"></div>
				
				
				<div class="nofloat"></div>	
				<div class="btnAction">
					{if $curElt->nl_id}<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=nl&act=delNL&nl_id={$curElt->nl_id}', 'la suppression')"/>{/if}
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
		$( "#tabs" ).tabs();

		$("#recopie").bind('click', function(event) {
			event.preventDefault(); // cancel default behavior
			var a = false;
	       	a= confirm ('Vous êtes sur le point de supprimer le contenu actuel de la newsletter. Voulez-vous continuer ?');
	       	if (a) {
				//$('#nl_corps').html($('#source').html());
				CKEDITOR.instances['nl_corps'].setData($('#source').html());
				$("#formProfil").submit();
				//$( "#tabs" ).tabs({active: 0});
	       	}
		});

		$(".del").bind('click', function(event) {
			var a = false;
	       	a= confirm ('Vous êtes sur le point de supprimer ce bloc. Voulez-vous continuer ?');
	       	if (a) {
				$(this).parent().remove();
	       	}
		});

		$(".edit").click (function(event) {			
			event.preventDefault(); // cancel default behavior
			var id = $(this).attr('id');
			openModalPopup('gestion.php?ob=nl&act=editBloc&pop=X&id='+id,'Edition du bloc', 500, 600);
		});
})
</script>
{/literal}
	