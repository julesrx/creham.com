<form action="" method="bloc" id="blocEdit" style="font-size: 1.3em">
	<input type="hidden" name="src_id" id="src_id" value="{$smarty.get.id}"/>
	<label><strong>Choix de la rubrique : </label></strong><select name='rub_id' id='rub_id' class="formInput">
						<option>>> Choisir</option>
						{html_options options=$rubrique_options selected=$cPage->rub_id}
						</select>
	<div class="nofloat">&nbsp;</div>
	<div id="listeArticle">
	
	</div>
</form>


{literal}
	<script>
	$().ready(function() {
		
		$('#rub_id').bind('change', function() {	  			
			
			// appel Ajax
	        $.ajax({
	            url: 'gestion.php?ob=nl&act=listeArticle&pop=X', 
	            type: 'post', // la méthode indiquée dans le formulaire (get ou post)	
	            data: $('#blocEdit').serialize(), // je sérialise les données (voir plus loin), ici les $_POST	                        
	            success: function(src) { // je récupère la réponse du fichier PHP                    
	                $('#listeArticle').html(src);	               
	            }
	        });
		});
	    
	});
	</script>
{/literal}