<?php /* Smarty version 2.6.18, created on 2013-12-30 18:12:34
         compiled from home/tpl/adm_home.tpl */ ?>

	<div id="centreLogin" align="center">
		<br/>
		<br/>
		<br/>
		<h1>Bienvenue sur l'interface d'administration du site <?php echo $this->_tpl_vars['CFG']->titre_site; ?>
</h1>
		
		<br/>
		<br/>
		<?php if (! $this->_tpl_vars['curSid']): ?>
			<h2>choix du site</h2><br/><br/>
			<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cSite']):
?>
				<p><a href="gestion.php?ob=home&site_id=<?php echo $this->_tpl_vars['cSite']->site_id; ?>
" style="font-size: 2.5em">&gt; <?php echo $this->_tpl_vars['cSite']->site_lib; ?>
</a></p>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<h2 style="font-size: 2.5em"><?php echo $this->_tpl_vars['site']->site_lib; ?>
</h2>
		<?php endif; ?>
	</div>
	

	