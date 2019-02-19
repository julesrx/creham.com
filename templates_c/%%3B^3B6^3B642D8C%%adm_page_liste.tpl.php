<?php /* Smarty version 2.6.18, created on 2014-02-18 17:46:19
         compiled from contenu/tpl/adm_page_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'contenu/tpl/adm_page_liste.tpl', 17, false),array('function', 'PrintEditor', 'contenu/tpl/adm_page_liste.tpl', 90, false),array('modifier', 'date_format', 'contenu/tpl/adm_page_liste.tpl', 92, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			<div style="float: right; padding: 2px; color: orange;">
				<button onclick="$('#postSearch').toggle();">Rechercher</button>
			</div>
			<a href="gestion.php?ob=page&act=<?php if ($_SESSION['type'] == 'aValider'): ?>aValider<?php else: ?>liste<?php endif; ?>">>> Nouvelle Page</a>
		</div>
		<form action="gestion.php?ob=page&act=liste" method="post" id="postSearch" style="display:none">			
			<img src="images/fermer.png" onClick="$('#postSearch').hide();" align=right><br/><br/>
			<label>Terme</label><input type="text" class="text" name="search_mot" value="<?php echo $_POST['search_mot']; ?>
"/>
			<div class="nofloat"></div>
			<label>Date</label><input type="text" class="text datepicker" name="search_date" value="<?php echo $_POST['search_date']; ?>
"/>
			<div class="nofloat"></div>
			<label>Rubrique</label><select name='search_rub' id='search_rub' class="text">
									<option value='''>>> Choisir</option>
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['rubrique_options'],'selected' => $_POST['search_rub']), $this);?>

									</select>
			<div class="nofloat"></div>
			<input type="submit" value="OK">
			<div class="nofloat"></div>
		</form>
		
		<div class="listeElt">
		<?php $this->assign('prec', ""); ?>
		<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>
			<?php if ($this->_tpl_vars['prec'] != $this->_tpl_vars['cElt']->rub_id): ?>
				<div style="padding: 3px;"><b><?php echo $this->_tpl_vars['cElt']->rub_lib; ?>
</b></div>
				<?php $this->assign('prec', $this->_tpl_vars['cElt']->rub_id); ?>
			<?php endif; ?>
			<a href="gestion.php?ob=page&act=<?php if ($_SESSION['type'] == 'aValider'): ?>aValider<?php else: ?>liste<?php endif; ?>&pg_id=<?php echo $this->_tpl_vars['cElt']->pg_id; ?>
">
					<div class="<?php if ($this->_tpl_vars['cPage']->pg_id == $this->_tpl_vars['cElt']->pg_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?> statut<?php echo $this->_tpl_vars['cElt']->pg_statut+0; ?>
" style="padding-left: 20px">
						<?php echo $this->_tpl_vars['cElt']->pg_ordre; ?>
 - <?php echo $this->_tpl_vars['cElt']->pg_titre; ?>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Aucune page</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo $this->_tpl_vars['nb']+0; ?>
 pages</div>
	</div>
	<div id="centre">
		<?php if (1): ?>
		<div id="action">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "commun/tpl/adm_ok_msg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre"><i><b><?php echo $this->_tpl_vars['cPage']->pg_titre; ?>
</b></i></span>
			<form action="gestion.php?ob=page&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $this->_tpl_vars['cPage']->pg_id; ?>
" name="pg_id" id="pg_id">
				
				<div class="btnAction">
					<?php if ($this->_tpl_vars['cPage']->pg_id): ?>
						<input type="button" value="Dupliquer" class="btnSave" onclick="openModalPopup('gestion.php?ob=page&act=duplic&pg_id=<?php echo $this->_tpl_vars['cPage']->pg_id; ?>
&pop=X', 'Dupliquer cet article', '400', '400')" style="float:right"/>
						<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=page&act=del&pg_id=<?php echo $this->_tpl_vars['cPage']->pg_id; ?>
', 'la suppression')"/>
					<?php endif; ?>
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
				
				<div id="tabs">
				<ul>
				    <li><a href="#niv1"><span>Page</span></a></li>
				   				    
				</ul>
				
				
				
				<div id="niv1">  
					<label>Statut : </label><select name='pg_statut' id='pg_statut' class="formInput">
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['status_options'],'selected' => $this->_tpl_vars['cPage']->pg_statut+0), $this);?>

										</select>
					<div class="nofloat"></div>
					<label>Rubrique : </label><select name='rub_id' id='rub_id' class="formInput">
										<option>>> Choisir</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['rubrique_options'],'selected' => $this->_tpl_vars['cPage']->rub_id), $this);?>

										</select>
					<div class="nofloat"></div>
					
					<label>Titre : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cPage']->pg_titre; ?>
" name="pg_titre" id="pg_titre"/>
					<div class="nofloat"></div>							
					<label>Ordre : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cPage']->pg_ordre; ?>
" name="pg_ordre" id="pg_ordre"/>
					<div class="nofloat"></div>							
					
					<input type="hidden" class="formInput required" value="<?php echo $this->_tpl_vars['cPage']->usr_id; ?>
" name="usr_id" id="usr_id"/>
					<div class="nofloat"></div>						
					<label>Contenu : </label>
					<div class="nofloat"></div>				
					<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['cPage']->pg_contenu,'name' => 'pg_contenu','width' => "80%"), $this);?>

					<div class="nofloat"></div>
					<label>Date de modification : </label><input type="text" class="formDisable" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['cPage']->pg_date_crea)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d/%m/%Y %H:%M")); ?>
"/>
					<div class="nofloat"></div>
					<label>Illustration :<br/><small>(280px max de large)</small></label><input type="file" name="pg_photo" /><input type="hidden" name="pg_photo_old" value="<?php echo $this->_tpl_vars['cPage']->pg_photo; ?>
"/>				
					<?php if ($this->_tpl_vars['cPage']->pg_photo): ?>
						<div class="nofloat">&nbsp;</div>
						<a href="<?php echo $this->_tpl_vars['CFG']->imgurl; ?>
<?php echo $this->_tpl_vars['cPage']->pg_photo; ?>
" target="_blank"  title="voir"><img src="<?php echo $this->_tpl_vars['CFG']->imgurl; ?>
<?php echo $this->_tpl_vars['cPage']->pg_photo; ?>
" alt="voir"/></a>
						<a href="javascript:checkConfirmUrl('gestion.php?ob=page&act=delPhoto&pg_id=<?php echo $this->_tpl_vars['cPage']->pg_id; ?>
', 'la suppression')" title="supprimer"><img src="./images/icon_del.gif" alt="supprimer"/></a>
					<?php endif; ?>
					<div class="nofloat">&nbsp;</div>					

				</div>
				
				</div>
				<div class="nofloat"></div>	
				<div class="nofloat"></div>
				<div class="btnAction">
					<?php if ($this->_tpl_vars['cPage']->pg_id): ?>
						<input type="button" value="Dupliquer" class="btnSave" onclick="openModalPopup('gestion.php?ob=page&act=duplic&pg_id=<?php echo $this->_tpl_vars['cPage']->pg_id; ?>
&pop=X', 'Dupliquer cet article', '400', '400')" style="float:right"/>
						<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=page&act=del&pg_id=<?php echo $this->_tpl_vars['cPage']->pg_id; ?>
', 'la suppression')"/>
					<?php endif; ?>
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
			</form>
		</div>

		<?php endif; ?>
	</div>
	
<?php echo '
<script>
$().ready(function() {
	$( "#tabs" ).tabs(); //{active: 1}
	$(\'#pg_titre\').focus();
	
	$("#formProfil").validate({
		  rules: {
			  pg_legende: {
			      maxlength: 100
			    }
			  }});

	$(\'.ok\').bind(\'change\', function() {	  
		var item = $( this ).parent().parent();
		var id = $(item).attr(\'data-id\');
		var res_titre = $(item).find(\'#res_titre\');
		// appel Ajax
        $.ajax({
            url: \'gestion.php?ob=page&act=saveRes&pop=X&res_id=\'+id, 
            type: \'post\', // la méthode indiquée dans le formulaire (get ou post)
            data: $(res_titre).serialize(), // je sérialise les données (voir plus loin), ici les $_POST
            success: function(src) { // je récupère la réponse du fichier PHP                    
                //alert(src);
                var ob = JSON.parse(src);
                //alert(ob[\'res_titre\']);
                $(res_titre).val(ob[\'res_titre\']);
                $(res_titre).css("background-color", "green");
                $(res_titre).animate({backgroundColor: \'#fff\'}, 1200);
            }
        });
	});

	$(\'.del\').bind(\'click\', function() {	  
		var a = false;
       a= confirm (\'Confirmez-vous la suppression ?\');
       if (a) {
			var item = $( this ).parent().parent();
			var id = $(item).attr(\'data-id\');
			var res_titre = $(item).find(\'#res_titre\');
			// appel Ajax
	        $.ajax({
	            url: \'gestion.php?ob=page&act=delRes&pop=X&res_id=\'+id, 
	            type: \'post\', // la méthode indiquée dans le formulaire (get ou post)
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
'; ?>

	