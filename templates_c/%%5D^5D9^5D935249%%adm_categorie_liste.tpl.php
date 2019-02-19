<?php /* Smarty version 2.6.18, created on 2013-12-09 09:59:34
         compiled from contenu/tpl/adm_categorie_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sizeof', 'contenu/tpl/adm_categorie_liste.tpl', 23, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=categ&act=liste">>> Nouvelle Catégorie</a>
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
			<a href="gestion.php?ob=categ&act=liste&cat_id=<?php echo $this->_tpl_vars['cElt']->cat_id; ?>
&gstatut=<?php echo $this->_tpl_vars['cElt']->statut; ?>
">
					<div class="<?php if ($this->_tpl_vars['cCategorie']->cat_id == $this->_tpl_vars['cElt']->cat_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?> statut<?php echo $this->_tpl_vars['cElt']->cat_statut; ?>
" style="padding-left: 20px">
						<?php echo $this->_tpl_vars['cElt']->cat_ordre; ?>
 - <?php echo $this->_tpl_vars['cElt']->cat_lib; ?>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Aucune catégorie</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo smarty_function_sizeof(array('liste' => $this->_tpl_vars['lElt']), $this);?>
 catégories</div>
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
			<span class="tblEntete isCentre"><i><b><?php if ($this->_tpl_vars['cCategorie']->cat_id > 0): ?>Catégorie : <?php echo $this->_tpl_vars['cCategorie']->cat_lib; ?>
<?php else: ?>Nouvelle catégorie<?php endif; ?></b></i></span>
			<form action="gestion.php?ob=categ&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $this->_tpl_vars['cCategorie']->cat_id; ?>
" name="cat_id" id="cat_id">
				
				<div class="nofloat">&nbsp;</div>
				<label>Titre : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cCategorie']->cat_lib; ?>
" name="cat_lib" id="cat_lib"/>
				<div class="nofloat"></div>
				<label>Ordre : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cCategorie']->cat_ordre; ?>
" name="cat_ordre" id="cat_ordre"/>
				<div class="nofloat"></div>				
								
				<div class="btnAction">
					<?php if ($this->_tpl_vars['cCategorie']->cat_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=categ&act=del&cat_id=<?php echo $this->_tpl_vars['cCategorie']->cat_id; ?>
', 'la suppression')"/><?php endif; ?>
					<input type="submit" value="Enregistrer" class="btnSave"/>
					<div class="nofloat">&nbsp;</div>
				</div>

				<div class="nofloat"></div>	


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
		$(\'#div_fr\').show();

})
</script>
'; ?>

	