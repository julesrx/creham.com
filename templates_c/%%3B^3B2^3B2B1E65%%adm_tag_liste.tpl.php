<?php /* Smarty version 2.6.18, created on 2013-12-09 10:00:42
         compiled from contenu/tpl/adm_tag_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sizeof', 'contenu/tpl/adm_tag_liste.tpl', 19, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=tag&act=liste">>> Nouveau Mot-clé</a>
		</div>

		<div class="listeElt">
		<?php $this->assign('prec', ""); ?>
		<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>			
			<a href="gestion.php?ob=tag&act=liste&tag_id=<?php echo $this->_tpl_vars['cElt']->tag_id; ?>
&gstatut=<?php echo $this->_tpl_vars['cElt']->statut; ?>
">
					<div class="<?php if ($this->_tpl_vars['cTag']->tag_id == $this->_tpl_vars['cElt']->tag_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?> statut<?php echo $this->_tpl_vars['cElt']->tag_statut; ?>
" style="padding-left: 20px">
						<?php echo $this->_tpl_vars['cElt']->tag_lib; ?>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Aucun mot-clé</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo smarty_function_sizeof(array('liste' => $this->_tpl_vars['lElt']), $this);?>
 mots-clés</div>
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
			<span class="tblEntete isCentre"><i><b><?php if ($this->_tpl_vars['cTag']->tag_id > 0): ?>Mot-clé : <?php echo $this->_tpl_vars['cTag']->tag_lib; ?>
<?php else: ?>Nouveau mot-clé<?php endif; ?></b></i></span>
			<form action="gestion.php?ob=tag&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $this->_tpl_vars['cTag']->tag_id; ?>
" name="tag_id" id="tag_id">
				
				<div class="nofloat">&nbsp;</div>
				<label>Libellé : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cTag']->tag_lib; ?>
" name="tag_lib" id="tag_lib"/>
				<div class="nofloat"></div>
								
				<div class="btnAction">
					<?php if ($this->_tpl_vars['cTag']->tag_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=tag&act=del&tag_id=<?php echo $this->_tpl_vars['cTag']->tag_id; ?>
', 'la suppression')"/><?php endif; ?>
					<input type="submit" value="Enregistrer" class="btnSave"/>
					<div class="nofloat">&nbsp;</div>
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

	