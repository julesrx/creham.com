<?php /* Smarty version 2.6.18, created on 2013-10-24 18:15:33
         compiled from newsletter/tpl/adm_choix_article.tpl */ ?>
<br/>

<label><strong>Choix des articles :</strong></label>
<br/><br/>

<?php $_from = $this->_tpl_vars['lP']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cP']):
?>
	<?php if ($_REQUEST['src_id'] == 'editerLaUne'): ?>
		<div><input type="radio" name="pg_id" value="<?php echo $this->_tpl_vars['cP']->pg_id; ?>
"/> <?php echo $this->_tpl_vars['cP']->pg_titre; ?>
 (<a href="gestion.php?ob=page&act=liste&pg_id=<?php echo $this->_tpl_vars['cPg']->pg_id; ?>
" target="_blank">voir</a>)</div>
	<?php else: ?>
		<div><input type="checkbox" name="pg_id[<?php echo $this->_tpl_vars['cP']->pg_id; ?>
]" value="<?php echo $this->_tpl_vars['cP']->pg_id; ?>
"/> <?php echo $this->_tpl_vars['cP']->pg_titre; ?>
 (<a href="gestion.php?ob=page&act=liste&pg_id=<?php echo $this->_tpl_vars['cPg']->pg_id; ?>
" target="_blank">voir</a>)</div>
	<?php endif; ?>
	
<?php endforeach; endif; unset($_from); ?>
<br/><br/>
<input type="button" class="btnSave" value="Choisir ces articles"/>

<?php echo '
	<script>
	$().ready(function() {
		
		$(\'.btnSave\').bind(\'click\', function() {	  			
			// appel Ajax
	        $.ajax({
	            url: \'gestion.php?ob=nl&act=metEnForme&pop=X\', 
	            type: \'post\', // la méthode indiquée dans le formulaire (get ou post)	
	            data: $(\'#blocEdit\').serialize(), // je sérialise les données (voir plus loin), ici les $_POST	                        
	            success: function(src) { // je récupère la réponse du fichier PHP		            		           
		            var item = $(\'#\'+$(\'#src_id\').val());                   		             
	                $(item).html(src);	
	                $( \'#modal-popup\' ).dialog( \'close\' );               
	            }
	        });
		});
	    
	});
	</script>
'; ?>