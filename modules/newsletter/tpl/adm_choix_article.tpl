<br/>

<label><strong>Choix des articles :</strong></label>
<br/><br/>

{foreach from=$lP item=cP}
	{if $smarty.request.src_id == "editerLaUne"}
		<div><input type="radio" name="pg_id" value="{$cP->pg_id}"/> {$cP->pg_titre} (<a href="gestion.php?ob=page&act=liste&pg_id={$cPg->pg_id}" target="_blank">voir</a>)</div>
	{else}
		<div><input type="checkbox" name="pg_id[{$cP->pg_id}]" value="{$cP->pg_id}"/> {$cP->pg_titre} (<a href="gestion.php?ob=page&act=liste&pg_id={$cPg->pg_id}" target="_blank">voir</a>)</div>
	{/if}
	
{/foreach}
<br/><br/>
<input type="button" class="btnSave" value="Choisir ces articles"/>

{literal}
	<script>
	$().ready(function() {
		
		$('.btnSave').bind('click', function() {	  			
			// appel Ajax
	        $.ajax({
	            url: 'gestion.php?ob=nl&act=metEnForme&pop=X', 
	            type: 'post', // la méthode indiquée dans le formulaire (get ou post)	
	            data: $('#blocEdit').serialize(), // je sérialise les données (voir plus loin), ici les $_POST	                        
	            success: function(src) { // je récupère la réponse du fichier PHP		            		           
		            var item = $('#'+$('#src_id').val());                   		             
	                $(item).html(src);	
	                $( '#modal-popup' ).dialog( 'close' );               
	            }
	        });
		});
	    
	});
	</script>
{/literal}