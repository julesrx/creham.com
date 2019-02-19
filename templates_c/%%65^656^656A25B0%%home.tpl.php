<?php /* Smarty version 2.6.18, created on 2014-02-18 18:39:27
         compiled from home/tpl/home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'MakeLienHTML', 'home/tpl/home.tpl', 13, false),)), $this); ?>
<a href="/" title="retour accueil"><img src="./images/logocreham.gif" alt="Créham" id="homeLogo"></a>
<span id="titre">une équipe pluridisciplinaire</span>
<hr/>
<p id="baseline">Urbanisme, paysage, sociologie et développement local</p>
<hr/>
<img src="./upload/images/home.jpg" alt="" id="homeImg"/>
<hr/>
<p id="metier">Etude,<img src="./images/pixel.gif" alt="" width="8"/>conseil,<img src="./images/pixel.gif" alt="" width="7"/>assistance à maîtrise d'ouvrage et maîtrise d'oeuvre</p>
<hr/>
<nav id="homeNav">
	<img src="./images/virgule.png" alt="" id="virgule"/>
	<?php $_from = $this->_tpl_vars['lMenu']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cMenu']):
?>
		<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cMenu']->pg_titre,'id' => $this->_tpl_vars['cMenu']->pg_id,'type' => 'p'), $this);?>
" title=""><?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>
	
</nav>
<footer class="">
	<a href="/contact" title="contactez-nous"><img src="./images/picto-contact.png" alt=""/> contact</a>
	<?php $_from = $this->_tpl_vars['lMenu']['2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cMenu']):
?>
		<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cMenu']->pg_titre,'id' => $this->_tpl_vars['cMenu']->pg_id,'type' => 'p'), $this);?>
" title=""><img src="./images/picto-acces.png" alt=""/> <?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>	
	<?php $_from = $this->_tpl_vars['lMenu']['4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cMenu']):
?>
		<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cMenu']->pg_titre,'id' => $this->_tpl_vars['cMenu']->pg_id,'type' => 'p'), $this);?>
"  title="<?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
" <?php if ($this->_tpl_vars['curPg']->pg_id == $this->_tpl_vars['cMenu']->pg_id): ?>class="on"<?php endif; ?>><img src="./images/picto-espace.png" alt=""/> <?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>
	
	<span class="mention">
		<?php $_from = $this->_tpl_vars['lMenu']['3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cMenu']):
?>
			<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cMenu']->pg_titre,'id' => $this->_tpl_vars['cMenu']->pg_id,'type' => 'p'), $this);?>
" title=""><?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
</a>
		<?php endforeach; endif; unset($_from); ?>
	</span>
</footer>