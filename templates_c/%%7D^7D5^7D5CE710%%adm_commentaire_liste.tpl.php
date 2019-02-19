<?php /* Smarty version 2.6.18, created on 2013-10-11 12:28:04
         compiled from contenu/tpl/adm_commentaire_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'contenu/tpl/adm_commentaire_liste.tpl', 16, false),array('modifier', 'strip_tags', 'contenu/tpl/adm_commentaire_liste.tpl', 16, false),array('modifier', 'truncate', 'contenu/tpl/adm_commentaire_liste.tpl', 16, false),array('function', 'sizeof', 'contenu/tpl/adm_commentaire_liste.tpl', 23, false),array('function', 'html_options', 'contenu/tpl/adm_commentaire_liste.tpl', 42, false),array('function', 'PrintEditor', 'contenu/tpl/adm_commentaire_liste.tpl', 52, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			&nbsp;
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
			<a href="gestion.php?ob=comment&act=<?php if ($_SESSION['type'] == 'aValider'): ?>aValider<?php else: ?>liste<?php endif; ?>&com_id=<?php echo $this->_tpl_vars['cElt']->com_id; ?>
">
					<div class="<?php if ($this->_tpl_vars['cCommentaire']->com_id == $this->_tpl_vars['cElt']->com_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?> statut<?php echo $this->_tpl_vars['cElt']->com_statut+0; ?>
" style="padding-left: 20px">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->com_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
 - <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['cElt']->com_content)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100) : smarty_modifier_truncate($_tmp, 100)); ?>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Aucun commentaire</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo smarty_function_sizeof(array('liste' => $this->_tpl_vars['lElt']), $this);?>
 commentaires</div>
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
			<span class="tblEntete isCentre"><i><b><?php echo $this->_tpl_vars['cCommentaire']->com_titre; ?>
</b></i></span>
			<form action="gestion.php?ob=comment&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $this->_tpl_vars['cCommentaire']->com_id; ?>
" name="com_id" id="com_id">
				
				<div class="btnAction">
					<?php if ($this->_tpl_vars['cCommentaire']->com_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=comment&act=del&com_id=<?php echo $this->_tpl_vars['cCommentaire']->com_id; ?>
', 'la suppression')"/><?php endif; ?>
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat">&nbsp;</div>
				<label>Statut : </label><select name='com_statut' id='com_statut' class="formInput">
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['statusContrib_options'],'selected' => $this->_tpl_vars['cCommentaire']->com_statut+0), $this);?>

									</select>
				<div class="nofloat"></div>
				
				<label>Auteur : </label><input type="text" class="formDisable" value="<?php echo $this->_tpl_vars['cCommentaire']->usr_prenom; ?>
 <?php echo $this->_tpl_vars['cCommentaire']->usr_nom; ?>
"/>
				<div class="nofloat"></div>			
				<label>Article : </label><input type="text" class="formDisable" value="<?php echo $this->_tpl_vars['cCommentaire']->pg_titre; ?>
"/> <a href="gestion.php?ob=page&act=liste&pg_id=<?php echo $this->_tpl_vars['cCommentaire']->pg_id; ?>
" title="Voir l'article">( voir )</a>
				<div class="nofloat"></div>			
				<label>Commentaire : </label>
				<div class="nofloat"></div>				
				<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['cCommentaire']->com_content,'name' => 'com_content','width' => '555','height' => '300'), $this);?>

				<div class="nofloat"></div>				
				
				<label>Date de création : </label><input type="text" class="formDisable" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['cCommentaire']->com_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d/%m/%Y %H:%M")); ?>
"/>
				<div class="nofloat"></div>
				<div class="btnAction">
					<?php if ($this->_tpl_vars['cCommentaire']->com_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=comment&act=del&com_id=<?php echo $this->_tpl_vars['cCommentaire']->com_id; ?>
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

	