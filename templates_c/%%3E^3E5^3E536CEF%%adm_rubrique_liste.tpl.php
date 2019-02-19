<?php /* Smarty version 2.6.18, created on 2014-01-10 10:56:01
         compiled from contenu/tpl/adm_rubrique_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sizeof', 'contenu/tpl/adm_rubrique_liste.tpl', 23, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=rubrique&act=liste">>> Nouvelle Rubrique</a>
		</div>

		<div class="listeElt">
		<?php $this->assign('prec', ""); ?>
		<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>
			<?php if ($this->_tpl_vars['prec'] != $this->_tpl_vars['cElt']->rub_type): ?>
				<div style="padding: 3px;"><b><?php if ($this->_tpl_vars['cElt']->rub_type == 1): ?>PUBLIC<?php else: ?> LOCATAIRES<?php endif; ?></b></div>
				<?php $this->assign('prec', $this->_tpl_vars['cElt']->rub_type); ?>
			<?php endif; ?>
			<a href="gestion.php?ob=rubrique&act=liste&rub_id=<?php echo $this->_tpl_vars['cElt']->rub_id; ?>
">
					<div class="<?php if ($this->_tpl_vars['cRubrique']->rub_id == $this->_tpl_vars['cElt']->rub_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?> statut<?php echo $this->_tpl_vars['cElt']->rub_statut; ?>
" style="padding-left: 20px">
						<?php echo $this->_tpl_vars['cElt']->rub_ordre; ?>
 - <?php echo $this->_tpl_vars['cElt']->rub_lib; ?>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Aucune rubrique</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo smarty_function_sizeof(array('liste' => $this->_tpl_vars['lElt']), $this);?>
 rubriques</div>
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
			<span class="tblEntete isCentre"><i><b><?php echo $this->_tpl_vars['cRubrique']->rub_lib; ?>
</b></i></span>
			<form action="gestion.php?ob=rubrique&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $this->_tpl_vars['cRubrique']->rub_id; ?>
" name="rub_id" id="rub_id">
				
				
				<label>Titre: </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cRubrique']->rub_lib; ?>
" name="rub_lib" id="rub_lib"/>
				<div class="nofloat"></div>
				<label>Ordre : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cRubrique']->rub_ordre; ?>
" name="rub_ordre" id="rub_ordre"/>
				<div class="nofloat"></div>
								
				<div class="nofloat">&nbsp;</div><div class="nofloat">&nbsp;</div>
				<div class="btnAction">
										<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat"></div>
			</form>
		</div>

		<?php endif; ?>
	</div>
	
<?php echo '
<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#formProfil").validate();
})
</script>
'; ?>

	