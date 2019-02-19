<?php /* Smarty version 2.6.18, created on 2013-12-30 18:11:49
         compiled from commun/tpl/footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'MakeLienHTML', 'commun/tpl/footer.tpl', 4, false),)), $this); ?>
<?php if ($_REQUEST['ob'] != '' && $_GET['pop'] != 1): ?>
	<footer class="" style="text-align: right">
		<?php $_from = $this->_tpl_vars['lMenu']['3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cMenu']):
?>
			<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cMenu']->pg_titre,'id' => $this->_tpl_vars['cMenu']->pg_id,'type' => 'p'), $this);?>
" title=""><?php echo $this->_tpl_vars['cMenu']->pg_titre; ?>
</a>
		<?php endforeach; endif; unset($_from); ?>
	</footer>
<?php endif; ?>

</div><!-- Fin de main -->
</body>
</html>