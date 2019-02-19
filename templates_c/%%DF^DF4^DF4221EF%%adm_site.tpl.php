<?php /* Smarty version 2.6.18, created on 2014-01-06 13:59:30
         compiled from site/tpl/adm_site.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sizeof', 'site/tpl/adm_site.tpl', 15, false),array('function', 'PrintEditor', 'site/tpl/adm_site.tpl', 44, false),)), $this); ?>
	<div id="gauche">
		<div class="tblEntete"><a href="gestion.php?ob=site&act=new" style="float:right"><b>>> Nouveau site</b></a></div>

		<div class="listeElt">
		<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>			
			<a href="gestion.php?ob=site&act=view&site_id=<?php echo $this->_tpl_vars['cElt']->site_id; ?>
">
				<div class="<?php if ($this->_tpl_vars['selElt']->site_id == $this->_tpl_vars['cElt']->site_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?>" style="padding-left: 10px;">
					<?php echo $this->_tpl_vars['cElt']->site_lib; ?>

				</div>
			</a>
		<?php endforeach; else: ?>
			<div class="tblOff">Pas de site</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo smarty_function_sizeof(array('liste' => $this->_tpl_vars['lElt']), $this);?>
 site<?php if (sizeof ( $this->_tpl_vars['lElt'] ) > 1): ?>s<?php endif; ?></div>
	</div>
	 
	<div id="centre">
		<div id="action">		
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "commun/tpl/adm_ok_msg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>			
		</div>

		<div id="viewMessage">
			<span class="tblEntete isCentre"><i><b><?php if ($this->_tpl_vars['selElt']->site_id): ?>Site : <?php echo $this->_tpl_vars['selElt']->site_lib; ?>
<?php else: ?>Nouveau site<?php endif; ?></b></i></span>
			<div><?php if (isset ( $this->_tpl_vars['lockMsg'] )): ?><?php echo $this->_tpl_vars['lockMsg']; ?>
<?php endif; ?></div>
			<form action="gestion.php?ob=site&act=save" method="POST" id="formSite" class="retrait" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $this->_tpl_vars['selElt']->site_id; ?>
" name="site_id" id="site_id">
				
				<label>Libellé : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['selElt']->site_lib; ?>
" name="site_lib" id="site_lib"/>
				<div class="nofloat"></div>
				<label>Url : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['selElt']->site_url; ?>
" name="site_url" id="site_url"/>
				<div class="nofloat"></div>
				<label>Code google : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['selElt']->site_info['google_code']; ?>
" name="google_code" id="google_code"/>
				<div class="nofloat"></div>
				<label>Email de notification :<br/><small>(liste séparée par ;)</small> </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['selElt']->site_info['email_admin']; ?>
" name="email_admin" id="email_admin"/>
				<div class="nofloat">&nbsp;</div>
				<label>Meta Title : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['selElt']->site_info['site_title']; ?>
" name="site_title" id="site_title"/>
				<div class="nofloat"></div>			
				<label>Meta Description : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['selElt']->site_info['site_desc']; ?>
" name="site_desc" id="site_desc"/>
				<div class="nofloat"></div>

				<label>Contact : </label>
				<div class="nofloat"></div>				
				<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['selElt']->site_info['site_contact'],'name' => 'site_contact','width' => "90%",'height' => '200'), $this);?>

				<div class="nofloat"></div>				
				<br/><br/>
				<div class="btnAction">
					<input type="submit" value="Enregistrer" class="btnSave">
				</div>

			</form>
			
		</div>
		
			<script type="text/javascript">				
				<?php echo '$(\'#formSite\').validate();'; ?>
				
			</script>
		

	</div>
	

	