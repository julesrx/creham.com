<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./ckfinder/ckfinder.js"></script>
<div id="pub">
	<h1 class="titre" id="titre">
		{if $curPg->pg_id > 0}
			Modifier : {$curPg->pg_titre}
		{else}
			Partager {if $curRub->rub_id == 4}un évènement{elseif $curRub->rub_id == 3}un conseil{elseif $curRub->rub_id == 5}une expérience{else}un usage{/if}
		{/if}
	</h1>
	{if $errMsg}<div class="errMsg">{$errMsg}</div>
	{elseif $okMsg}<div class="okMsg">{$okMsg}</div>
	{/if}
	
	<form action="./publier-{$curRub->rub_id}" method="post" id="formPub" enctype="multipart/form-data">
		<input type="hidden" name='rub_id' id='rub_id' value="{$curRub->rub_id}"/>
		{if $curPg->pg_id > 0}<input type="hidden" name='pg_id' id='pg_id' value="{$curPg->pg_id}"/>{/if}
		{if !$curPg->pg_id}
			<p class="intro">Vous souhaitez {if $curRub->rub_id == 4}communiquer un évènement{else}partager votre expérience{/if} ? Il vous suffit de remplir le formulaire ci-dessous. Il sera signé de vos initiales et sera publié après vérification par notre équipe éditoriale.</p>
		{/if}
		<label>Titre de {if $curRub->rub_id == 4}l'évènement{else}l'article{/if} : </label><input type="text" class="inbox required" value="{$curPg->pg_titre}" name="pg_titre" id="pg_titre"/>
		<div class="nofloat"></div>
		<div class="nofloat"></div>
	{if $curRub->rub_id == 3}
		<label>Catégorie : </label><select name='cat_id' id='cat_id' class="inbox required">
							<option>>> Choisir</option>
							{html_options options=$categorie_options selected=$curPg->cat_id}
							</select>
		<div class="nofloat"></div>
	{/if}	
				
	{if $curRub->rub_id == 4}
		<label>Date : </label><input type="text" class="inbox required datepicker" value="{$curPg->pg_date}" name="pg_date" id="pg_date"/>
		<div class="nofloat"></div>
		<label>Lieu : </label><input type="text" class="inbox required" value="{$curPg->pg_lieu}" name="pg_lieu" id="pg_lieu"/>
		<div class="nofloat"></div>
		<label>Contact / Inscription : </label><input type="text" class="inbox required" value="{$curPg->pg_contact}" name="pg_contact" id="pg_contact"/>		
		<div class="nofloat"></div>
		<label>Présentation : </label>
		<div class="nofloat"></div>				
		{PrintEditor innerHtml=$curPg->pg_contenu name="pg_contenu" width="555" height="300"}
		<div class="nofloat"></div>
	{else}				
		<label>Introduction : </label>
		<div class="nofloat"></div>				
		{PrintEditor innerHtml=$curPg->pg_chapo name="pg_chapo" width="555" height="200"}
		<div class="nofloat"></div>
		
		<label>Contenu : </label>
		<div class="nofloat"></div>				
		{PrintEditor innerHtml=$curPg->pg_contenu name="pg_contenu" width="555" height="300"}
		<div class="nofloat"></div>				
	{/if}		
				
		
		<label>Mot-clé 1 : </label><select name='pg_mot1' id='pg_mot1' class="inbox">
										{html_options options=$tag_options selected=$curPg->pg_mot1+0}
										</select>
					<div class="nofloat"></div>
					<label>Mot-clé 2 : </label><select name='pg_mot2' id='pg_mot2' class="inbox">
										{html_options options=$tag_options selected=$curPg->pg_mot2+0}
										</select>
					<div class="nofloat"></div>
					<label>Mot-clé 3 : </label><select name='pg_mot3' id='pg_mot3' class="inbox">
										{html_options options=$tag_options selected=$curPg->pg_mot3+0}
										</select>
					<div class="nofloat"></div>
		<label>Illustration :<br/><small>(Formats gif, jpg, png)</small></label><input type="file" name="pg_photo" class="photo" id="photo" title="Format autorisé gif, jpg, png"/>
		<input type="hidden" name="pg_photo_old" value="{$curPg->pg_photo}"/>
		{if $curPg->pg_photo}
			<a href="{$CFG->imgurl}p_{$curPg->pg_photo}" target="_blank"><img src="{$CFG->imgurl}vign_{$curPg->pg_photo}" /></a>
		{/if}		
		<div class="nofloat">&nbsp;</div>
		
		<label>Document joint N°1 :<br/><small>(Formats .doc, .xls, .pdf)</small></label><input type="file" name="res_file1" class="res" id="res"/>
		{foreach from=$lRes item=cRes}
			{if $cRes->res_ordre == 1 && $cRes->res_contenu}
				<input type="hidden" name="res_id1" value="{$cRes->res_id}"/>
				<input type="hidden" name="res_file1_old" value="{$cRes->res_contenu}"/>
				<a href="{$CFG->docurl}{$cRes->res_contenu}" target="_blank"><img src="./ckfinder/skins/kama/images/icons/32/{$cRes->res_mime}.gif"/> {$cRes->res_titre}</a>	
			{/if}
		{/foreach}
				
		<div class="nofloat">&nbsp;</div>
		
		<label>Document joint N°2 :<br/><small>(Formats .doc, .xls, .pdf)</small></label><input type="file" name="res_file2" class="res" id="res"/>
		{foreach from=$lRes item=cRes}
			{if $cRes->res_ordre == 2 && $cRes->res_contenu}
				<input type="hidden" name="res_id2" value="{$cRes->res_id}"/>
				<input type="hidden" name="res_file2_old" value="{$cRes->res_contenu}"/>
				<a href="{$CFG->docurl}{$cRes->res_contenu}" target="_blank"><img src="./ckfinder/skins/kama/images/icons/32/{$cRes->res_mime}.gif"/> {$cRes->res_titre}</a>	
			{/if}
		{/foreach}		
		<div class="nofloat">&nbsp;</div>
		
		<div class="btnAction">
			<a href="{$smarty.session.fromPage}" title="retour">Annuler</a>
			<input type="submit" value="Enregistrer" class="submit"/>
			<div class="nofloat">&nbsp;</div>
		</div>
		<div class="nofloat">&nbsp;</div>
	</form>
	
</div>
{literal}

<script type="text/javascript" src="./scripts/additional-methods.min.js"></script>

<script>
$().ready(function() {
		$('#pg_titre').focus();
		// validate the comment form when it is submitted
		$("#formPub").validate({
			rules: {
				photo: {		        	
		        	extension: "gif|jpg|jpeg|png"
		      	},
		      	res: {		        	
		        	extension: "gif|jpg|jpeg|png|doc|docx|xls|xlsx|pdf|avi"
		      	}
		    }});
})
</script>
{/literal}
	
