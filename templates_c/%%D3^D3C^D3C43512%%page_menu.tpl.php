<?php /* Smarty version 2.6.18, created on 2013-10-02 17:35:32
         compiled from contenu/tpl/page_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'MakeLienHTML', 'contenu/tpl/page_menu.tpl', 8, false),)), $this); ?>
<div id="ssmenu">
<?php if ($this->_tpl_vars['curRub']->rub_id == 2): ?> 	<div class="titre rondTop">Derniers articles</div>
	<ul class="liste rondBas">
		<?php $this->assign('i', 1); ?>
		<?php $_from = $this->_tpl_vars['lPg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cPg']):
?>
			<?php if ($this->_tpl_vars['i'] <= 3): ?>
				<li><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" title="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
"><span class="puceg left">&nbsp;</span><span class="left item <?php if ($this->_tpl_vars['cPg']->pg_id == $this->_tpl_vars['curPg']->pg_id): ?>on<?php endif; ?>"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</span></a><br class="noleft"/></li>
			<?php endif; ?>
			<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>	
	<div class="more rondTop rondBas"><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['curRub']->rub_lib,'type' => 'r','id' => $this->_tpl_vars['curRub']->rub_id), $this);?>
" title="<?php echo $this->_tpl_vars['curRub']->rub_lib; ?>
"><span class="puceplus">&nbsp;</span> <span <?php if (! $this->_tpl_vars['curPg']->pg_id): ?>class="on"<?php endif; ?>>Tous les articles</span></a></div>
<?php elseif ($this->_tpl_vars['curRub']->rub_id == 5): ?> 	<div class="titre rondTop">Dernières actus</div>
	<ul class="liste rondBas">
		<?php $this->assign('i', 1); ?>
		<?php $_from = $this->_tpl_vars['lPg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cPg']):
?>
			<?php if ($this->_tpl_vars['i'] <= 4): ?>
				<li><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" title="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
"><span class="puceg left">&nbsp;</span><span class="left item <?php if ($this->_tpl_vars['cPg']->pg_id == $this->_tpl_vars['curPg']->pg_id): ?>on<?php endif; ?>"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</span></a><br class="noleft"/></li>
			<?php endif; ?>
			<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>	
	<div class="more rondTop rondBas"><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['curRub']->rub_lib,'type' => 'r','id' => $this->_tpl_vars['curRub']->rub_id), $this);?>
" title="<?php echo $this->_tpl_vars['curRub']->rub_lib; ?>
"><span class="puceplus">&nbsp;</span> <span <?php if (! $this->_tpl_vars['curPg']->pg_id): ?>class="on"<?php endif; ?>>Toutes les actus</span></a></div>
<?php elseif ($this->_tpl_vars['curRub']->rub_id == 6): ?> 	<div class="titre rondTop">Editeurs</div>
	<ul class="liste rondBas">
		<?php $_from = $this->_tpl_vars['lPg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cPg']):
?>
			<li><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" title="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
"><span class="puceg left">&nbsp;</span><span class="left item <?php if ($this->_tpl_vars['cPg']->pg_id == $this->_tpl_vars['curPg']->pg_id): ?>on<?php endif; ?>"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</span></a><br class="noleft"/></li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>	
		
	
<?php elseif ($this->_tpl_vars['curRub']->rub_id == 3): ?> 	<div class="titre rondTop">Par catégorie</div>
	<ul class="liste rondBas">
		<?php $_from = $this->_tpl_vars['lCateg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cCateg']):
?>
			<li><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cCateg']->cat_lib,'type' => 'c','id' => $this->_tpl_vars['cCateg']->cat_id), $this);?>
" title="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
"><span class="puceg left">&nbsp;</span><span class="left item <?php if ($this->_tpl_vars['curCateg']->cat_id == $this->_tpl_vars['cCateg']->cat_id): ?>on<?php endif; ?>"><?php echo $this->_tpl_vars['cCateg']->cat_lib; ?>
</span></a><br class="noleft"/></li>			
		<?php endforeach; endif; unset($_from); ?>
	</ul>	
	<div class="more rondTop rondBas"><a href="<?php echo MakeLienHTML(array('lib' => 'Tous les conseils pratiques','type' => 'c','id' => ''), $this);?>
" title="<?php echo $this->_tpl_vars['curRub']->rub_lib; ?>
"><span class="puceplus">&nbsp;</span> <span <?php if (! $this->_tpl_vars['curPg']->pg_id && ! $this->_tpl_vars['curCateg']->cat_id): ?>class="on"<?php endif; ?>>Tous les conseils<br/>pratiques</span></a></div>
<?php endif; ?>
</div>