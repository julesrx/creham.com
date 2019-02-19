<?php /* Smarty version 2.6.18, created on 2013-12-12 17:02:43
         compiled from contenu/tpl/adm_actu_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'contenu/tpl/adm_actu_liste.tpl', 17, false),array('function', 'html_options', 'contenu/tpl/adm_actu_liste.tpl', 50, false),array('function', 'PrintEditor', 'contenu/tpl/adm_actu_liste.tpl', 62, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">			
			<a href="gestion.php?ob=actu&act=<?php if ($_SESSION['type'] == 'aValider'): ?>aValider<?php else: ?>liste<?php endif; ?>">>> Nouvelle Actualité</a>
		</div>
		
		
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
			<a href="gestion.php?ob=actu&act=<?php if ($_SESSION['type'] == 'aValider'): ?>aValider<?php else: ?>liste<?php endif; ?>&act_id=<?php echo $this->_tpl_vars['cElt']->act_id; ?>
">
					<div class="<?php if ($this->_tpl_vars['cActualite']->act_id == $this->_tpl_vars['cElt']->act_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?> statut<?php echo $this->_tpl_vars['cElt']->act_statut+0; ?>
" style="padding-left: 20px">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->act_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
 - <?php echo $this->_tpl_vars['cElt']->act_titre; ?>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Aucune actualité</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo $this->_tpl_vars['nb']+0; ?>
 actualités</div>
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
			<span class="tblEntete isCentre"><i><b><?php echo $this->_tpl_vars['cActualite']->act_titre; ?>
</b></i></span>
			<form action="gestion.php?ob=actu&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $this->_tpl_vars['cActualite']->act_id; ?>
" name="act_id" id="act_id">
				
				<div class="btnAction">
					<?php if ($this->_tpl_vars['cActualite']->act_id): ?>						
						<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=actu&act=del&act_id=<?php echo $this->_tpl_vars['cActualite']->act_id; ?>
', 'la suppression')"/>
					<?php endif; ?>
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
				
				<div id="tabs">
							
				
					<div id="niv1">  
						<label>Statut : </label><select name='act_statut' id='act_statut' class="formInput">
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['status_options'],'selected' => $this->_tpl_vars['cActualite']->act_statut+0), $this);?>

											</select>
						<div class="nofloat"></div>
						<label>Titre : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cActualite']->act_titre; ?>
" name="act_titre" id="act_titre"/>
						<div class="nofloat"></div>		
						<label>Catégorie : </label><select name='act_type' id='act_type' class="formInput">
								<option value=""></option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categorie_options'],'selected' => $this->_tpl_vars['cActualite']->act_type), $this);?>

						</select>
						<div class="nofloat"></div>
						<label>Chapo : </label>
						<div class="nofloat"></div>				
						<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['cActualite']->act_chapo,'name' => 'act_chapo','width' => "80%"), $this);?>

						<div class="nofloat"></div>
						<label style="width: 100% !important; max-width: 500px">Contenu (à compléter si non liée à un programme) : </label>
						<div class="nofloat"></div>				
						<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['cActualite']->act_contenu,'name' => 'act_contenu','width' => "80%"), $this);?>

						<div class="nofloat"></div>
								
						<label>Date de publication : </label><input type="text" class="formInput required datepicker" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['cActualite']->act_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
" name="act_date" id="act_date"/>
						<div class="nofloat"></div>
						<input type="hidden" class="formInput required" value="<?php echo $this->_tpl_vars['cActualite']->usr_id; ?>
" name="usr_id" id="usr_id"/>
						<label>Illustration:</label><input type="file" name="act_photo" /><input type="hidden" name="act_photo_old" value="<?php echo $this->_tpl_vars['cActualite']->act_photo; ?>
"/>				
						<?php if ($this->_tpl_vars['cActualite']->act_photo): ?>
							<div class="nofloat">&nbsp;</div>
							<a href="./upload/images/p_<?php echo $this->_tpl_vars['cActualite']->act_photo; ?>
" target="_blank"  title="voir"><img src="./upload/images/vign_<?php echo $this->_tpl_vars['cActualite']->act_photo; ?>
" alt="voir"/></a>
							<a href="javascript:checkConfirmUrl('gestion.php?ob=page&act=delPhoto&act_id=<?php echo $this->_tpl_vars['cActualite']->act_id; ?>
', 'la suppression')" title="supprimer"><img src="./images/icon_del.gif" alt="supprimer"/></a>
						<?php endif; ?>
						<div class="nofloat">&nbsp;</div>
					</div>
				
				</div>
				<div class="nofloat"></div>	
				<div class="nofloat"></div>
				<div class="btnAction">
					<?php if ($this->_tpl_vars['cActualite']->act_id): ?>
						<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=actu&act=del&act_id=<?php echo $this->_tpl_vars['cActualite']->act_id; ?>
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
	
	$("#formProfil").validate({
		  rules: {
			  mention2: {
			      maxlength: 30
			    }
			  }});

	
})


</script>
'; ?>

	