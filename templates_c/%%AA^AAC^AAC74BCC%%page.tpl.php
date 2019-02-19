<?php /* Smarty version 2.6.18, created on 2013-12-30 18:11:55
         compiled from contenu/tpl/page.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'MakeLienHTML', 'contenu/tpl/page.tpl', 9, false),)), $this); ?>

<article>	
	<div id="info">
		<?php echo $this->_tpl_vars['curPg']->pg_contenu; ?>

	</div>
	
<?php if ($_GET['pop'] != 1): ?>	
	<div id="tool">
		<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['curPg']->pg_titre,'id' => $this->_tpl_vars['curPg']->pg_id,'type' => 'p'), $this);?>
?pop=1" title="version imprimable" target="_blank"><img src="./images/picto-print.png" alt=""/> Imprimer la page</a>
		<hr/>
		<p align="right"><img src="./images/virgule.png" alt="" id="virgule"/></p>
		<?php if ($this->_tpl_vars['curPg']->pg_photo): ?>
			<img src="<?php echo $this->_tpl_vars['CFG']->imgurl; ?>
<?php echo $this->_tpl_vars['curPg']->pg_photo; ?>
" alt=""/>
		<?php endif; ?>
	</div>
<?php endif; ?>
	<div class="nofloat"></div>
</article>
<?php if ($_GET['pop'] == 1): ?>
	<script type="text/javascript">
<!--
	window.print();
//-->
</script>
<?php endif; ?>