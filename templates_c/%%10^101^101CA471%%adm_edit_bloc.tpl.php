<?php /* Smarty version 2.6.18, created on 2013-10-15 14:15:06
         compiled from newsletter/tpl/adm_edit_bloc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'newsletter/tpl/adm_edit_bloc.tpl', 5, false),)), $this); ?>
<form action="" method="bloc" id="blocEdit" style="font-size: 1.3em">
	<input type="hidden" name="src_id" id="src_id" value="<?php echo $_GET['id']; ?>
"/>
	<label><strong>Choix de la rubrique : </label></strong><select name='rub_id' id='rub_id' class="formInput">
						<option>>> Choisir</option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['rubrique_options'],'selected' => $this->_tpl_vars['cPage']->rub_id), $this);?>

						</select>
	<div class="nofloat">&nbsp;</div>
	<div id="listeArticle">
	
	</div>
</form>


<?php echo '
	<script>
	$().ready(function() {
		
		$(\'#rub_id\').bind(\'change\', function() {	  			
			
			// appel Ajax
	        $.ajax({
	            url: \'gestion.php?ob=nl&act=listeArticle&pop=X\', 
	            type: \'post\', // la méthode indiquée dans le formulaire (get ou post)	
	            data: $(\'#blocEdit\').serialize(), // je sérialise les données (voir plus loin), ici les $_POST	                        
	            success: function(src) { // je récupère la réponse du fichier PHP                    
	                $(\'#listeArticle\').html(src);	               
	            }
	        });
		});
	    
	});
	</script>
'; ?>