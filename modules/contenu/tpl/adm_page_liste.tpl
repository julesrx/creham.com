	<div id="gauche">
		
		<div class="tblEntete">
			<div style="float: right; padding: 2px; color: orange;">
				<button onclick="$('#postSearch').toggle();">Rechercher</button>
			</div>
			<a href="gestion.php?ob=page&act={if $smarty.session.type == 'aValider'}aValider{else}liste{/if}">>> Nouvelle Page</a>
		</div>
		<form action="gestion.php?ob=page&act=liste" method="post" id="postSearch" style="display:none">			
			<img src="images/fermer.png" onClick="$('#postSearch').hide();" align=right><br/><br/>
			<label>Terme</label><input type="text" class="text" name="search_mot" value="{$smarty.post.search_mot}"/>
			<div class="nofloat"></div>
			<label>Date</label><input type="text" class="text datepicker" name="search_date" value="{$smarty.post.search_date}"/>
			<div class="nofloat"></div>
			<label>Rubrique</label><select name='search_rub' id='search_rub' class="text">
									<option value='''>>> Choisir</option>
									{html_options options=$rubrique_options selected=$smarty.post.search_rub}
									</select>
			<div class="nofloat"></div>
			<input type="submit" value="OK">
			<div class="nofloat"></div>
		</form>
		
		<div class="listeElt">
		{assign var=prec value=""}
		{foreach from=$lElt item=cElt}
			{if $prec != $cElt->rub_id}
				<div style="padding: 3px;"><b>{$cElt->rub_lib}</b></div>
				{assign var=prec value=$cElt->rub_id}
			{/if}
			<a href="gestion.php?ob=page&act={if $smarty.session.type == 'aValider'}aValider{else}liste{/if}&pg_id={$cElt->pg_id}">
					<div class="{if $cPage->pg_id == $cElt->pg_id}tblOn{else}tblOff{/if} statut{$cElt->pg_statut+0}" style="padding-left: 20px">
						{$cElt->pg_ordre} - {$cElt->pg_titre}			
					</div>
			</a>	
		{foreachelse}
			<div class="tblOff">Aucune page</div>
		{/foreach}
		</div>
		<div class="tblEntete">{$nb+0} pages</div>
	</div>
	<div id="centre">
		{if 1}
		<div id="action">
		{include file="commun/tpl/adm_ok_msg.tpl"}
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"><i><b>{$cPage->pg_titre}</b></i></span>
			<form action="gestion.php?ob=page&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="{$cPage->pg_id}" name="pg_id" id="pg_id">
				
				<div class="btnAction">
					{if $cPage->pg_id}
						<input type="button" value="Dupliquer" class="btnSave" onclick="openModalPopup('gestion.php?ob=page&act=duplic&pg_id={$cPage->pg_id}&pop=X', 'Dupliquer cet article', '400', '400')" style="float:right"/>
						<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=page&act=del&pg_id={$cPage->pg_id}', 'la suppression')"/>
					{/if}
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
				
				<div id="tabs">
				<ul>
				    <li><a href="#niv1"><span>Page</span></a></li>
				   {*{if $cPage->pg_id} <li><a href="#niv2"><span>Ressources {if $lR}({sizeof liste=$lR}){/if}</span></a></li>{/if}*}				    
				</ul>
				
				
				
				<div id="niv1">  
					<label>Statut : </label><select name='pg_statut' id='pg_statut' class="formInput">
										{html_options options=$status_options selected=$cPage->pg_statut+0}
										</select>
					<div class="nofloat"></div>
					<label>Rubrique : </label><select name='rub_id' id='rub_id' class="formInput">
										<option>>> Choisir</option>
										{html_options options=$rubrique_options selected=$cPage->rub_id}
										</select>
					<div class="nofloat"></div>
					
					<label>Titre : </label><input type="text" class="formInput required" value="{$cPage->pg_titre}" name="pg_titre" id="pg_titre"/>
					<div class="nofloat"></div>							
					<label>Ordre : </label><input type="text" class="formInput required" value="{$cPage->pg_ordre}" name="pg_ordre" id="pg_ordre"/>
					<div class="nofloat"></div>							
					
					<input type="hidden" class="formInput required" value="{$cPage->usr_id}" name="usr_id" id="usr_id"/>
					<div class="nofloat"></div>						
					<label>Contenu : </label>
					<div class="nofloat"></div>				
					{PrintEditor innerHtml=$cPage->pg_contenu name="pg_contenu" width="80%"}
					<div class="nofloat"></div>
					<label>Date de modification : </label><input type="text" class="formDisable" value="{$cPage->pg_date_crea|date_format:"%d/%m/%Y %H:%M"}"/>
					<div class="nofloat"></div>
					<label>Illustration :<br/><small>(280px max de large)</small></label><input type="file" name="pg_photo" /><input type="hidden" name="pg_photo_old" value="{$cPage->pg_photo}"/>				
					{if $cPage->pg_photo}
						<div class="nofloat">&nbsp;</div>
						<a href="{$CFG->imgurl}{$cPage->pg_photo}" target="_blank"  title="voir"><img src="{$CFG->imgurl}{$cPage->pg_photo}" alt="voir"/></a>
						<a href="javascript:checkConfirmUrl('gestion.php?ob=page&act=delPhoto&pg_id={$cPage->pg_id}', 'la suppression')" title="supprimer"><img src="./images/icon_del.gif" alt="supprimer"/></a>
					{/if}
					<div class="nofloat">&nbsp;</div>					

				</div>
{*				
				{if $cPage->pg_id}
					<div id="niv2">
						<div id="ressListe">
							{if $lR}
								{foreach from=$lR item=cR}
									{include file="contenu/tpl/adm_ressource_item.tpl"}
								{/foreach}
							{else}
								Aucune ressource n'est associée à cette page.
							{/if}
						</div>
						
						{include file="contenu/tpl/adm_ressource_form.tpl"}									
					</div>
				{/if}
*}				
				</div>
				<div class="nofloat"></div>	
				<div class="nofloat"></div>
				<div class="btnAction">
					{if $cPage->pg_id}
						<input type="button" value="Dupliquer" class="btnSave" onclick="openModalPopup('gestion.php?ob=page&act=duplic&pg_id={$cPage->pg_id}&pop=X', 'Dupliquer cet article', '400', '400')" style="float:right"/>
						<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=page&act=del&pg_id={$cPage->pg_id}', 'la suppression')"/>
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
	$( "#tabs" ).tabs(); //{active: 1}
	$('#pg_titre').focus();
	
	$("#formProfil").validate({
		  rules: {
			  pg_legende: {
			      maxlength: 100
			    }
			  }});

	$('.ok').bind('change', function() {	  
		var item = $( this ).parent().parent();
		var id = $(item).attr('data-id');
		var res_titre = $(item).find('#res_titre');
		// appel Ajax
        $.ajax({
            url: 'gestion.php?ob=page&act=saveRes&pop=X&res_id='+id, 
            type: 'post', // la méthode indiquée dans le formulaire (get ou post)
            data: $(res_titre).serialize(), // je sérialise les données (voir plus loin), ici les $_POST
            success: function(src) { // je récupère la réponse du fichier PHP                    
                //alert(src);
                var ob = JSON.parse(src);
                //alert(ob['res_titre']);
                $(res_titre).val(ob['res_titre']);
                $(res_titre).css("background-color", "green");
                $(res_titre).animate({backgroundColor: '#fff'}, 1200);
            }
        });
	});

	$('.del').bind('click', function() {	  
		var a = false;
       a= confirm ('Confirmez-vous la suppression ?');
       if (a) {
			var item = $( this ).parent().parent();
			var id = $(item).attr('data-id');
			var res_titre = $(item).find('#res_titre');
			// appel Ajax
	        $.ajax({
	            url: 'gestion.php?ob=page&act=delRes&pop=X&res_id='+id, 
	            type: 'post', // la méthode indiquée dans le formulaire (get ou post)
	            data: $(res_titre).serialize(), // je sérialise les données (voir plus loin), ici les $_POST
	            success: function(src) { // je récupère la réponse du fichier PHP                    
	                //alert(src);
	                var ob = JSON.parse(src);
	                if (ob) $(item).fadeOut();
	            }
	        });
       }
	});
})


</script>
{/literal}
	