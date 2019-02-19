<?php /* Smarty version 2.6.18, created on 2014-01-06 14:04:44
         compiled from securite/tpl/adm_alluser.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'securite/tpl/adm_alluser.tpl', 11, false),array('modifier', 'myucfirst', 'securite/tpl/adm_alluser.tpl', 11, false),array('function', 'sizeof', 'securite/tpl/adm_alluser.tpl', 19, false),array('function', 'html_options', 'securite/tpl/adm_alluser.tpl', 50, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=profil&act=liste">>> Nouvel utilisateur</a>
		</div>

		<div class="listeElt">
		<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>
			<a href="gestion.php?ob=profil&act=liste&usr_id=<?php echo $this->_tpl_vars['cElt']->usr_id; ?>
">
					<div class="<?php if ($this->_tpl_vars['cUsr']->usr_id == $this->_tpl_vars['cElt']->usr_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?> statut<?php echo $this->_tpl_vars['cElt']->usr_statut+0; ?>
">
						<b><?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->usr_nom)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->usr_prenom)) ? $this->_run_mod_handler('myucfirst', true, $_tmp) : smarty_modifier_myucfirst($_tmp)); ?>
</b> <small>(<?php echo $this->_tpl_vars['cElt']->usr_login; ?>
)</small>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Pas d'utilisateur s&eacute;lectionn&eacute;</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo smarty_function_sizeof(array('liste' => $this->_tpl_vars['lElt']), $this);?>
 utilisateurs</div>
	</div>
	<div id="centre">
		<div id="action">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "commun/tpl/adm_ok_msg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
		
<div id="viewProfil">
	<span class="tblEntete isCentre"><i><b><?php if ($this->_tpl_vars['cUsr']->usr_id): ?>Utilisateur : <?php echo ((is_array($_tmp=$this->_tpl_vars['cUsr']->usr_nom)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['cUsr']->usr_prenom)) ? $this->_run_mod_handler('myucfirst', true, $_tmp) : smarty_modifier_myucfirst($_tmp)); ?>
<?php else: ?>Nouvel utilisateur<?php endif; ?></b></i></span>
	<form action="gestion.php?ob=profil&act=saveUser" method="POST" id="formProfil" enctype="multipart/form-data">
		<input type="hidden" value="<?php echo $this->_tpl_vars['cUsr']->usr_id; ?>
" name="usr_id" id="usr_id">
		<input type="hidden" value="1" name="usr_statut" id="usr_statut">
		<div class="btnAction">
			<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=profil&act=delUser&usr_id=<?php echo $this->_tpl_vars['cUsr']->usr_id; ?>
', 'la suppression')">
			<input type="submit" value="Enregistrer" class="btnSave">
		</div>
		<div class="nofloat"></div>
		
		<div id="tabs">
			<div id="niv1">
				<label>Nom : </label><input type="text" class="formInput" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['cUsr']->usr_nom)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
" name="usr_nom" id="usr_nom">
				<div class="nofloat"></div>
				<label>Prénom : </label><input type="text" class="formInput" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['cUsr']->usr_prenom)) ? $this->_run_mod_handler('myucfirst', true, $_tmp) : smarty_modifier_myucfirst($_tmp)); ?>
" name="usr_prenom" id="usr_prenom">
				<div class="nofloat"></div>	
				<label>Identifiant : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['cUsr']->usr_login; ?>
" name="usr_login" id="usr_login">
				<div class="nofloat"></div>
				<label>Mot de passe : </label><input type="password" class="formInput" value="<?php echo $this->_tpl_vars['cUsr']->usr_pwd; ?>
" name="usr_pwd" id="usr_pwd">
				<input type="hidden" value="<?php echo $this->_tpl_vars['cUsr']->usr_pwd; ?>
" name="usr_pwd_old" id="usr_pwd_old">
				<div class="nofloat"></div>
				<label>Groupe : </label><select name=grp_id class="formInput">
								<option></option>
							  <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupe_options'],'selected' => $this->_tpl_vars['cUsr']->grp_id), $this);?>

							</select>
				<div class="nofloat"></div>				
			</div>
			
		</div>
				
		<div class="nofloat"></div>
					
		<div class="btnAction">
			<input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=profil&act=delUser&usr_id=<?php echo $this->_tpl_vars['cUsr']->usr_id; ?>
', 'la suppression')">
			<input type="submit" value="Enregistrer" class="btnSave">
		</div>

		<div class="nofloat"></div>
	</form>
</div>

	</div>
	

	