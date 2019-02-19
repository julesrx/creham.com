<?php /* Smarty version 2.6.18, created on 2013-10-02 18:44:04
         compiled from contenu/tpl/page_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'MakeLienHTML', 'contenu/tpl/page_liste.tpl', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "contenu/tpl/page_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="liste">
	<h1 class="titre">
		<?php if ($this->_tpl_vars['curRub']->rub_id == 4): ?>Tous les évènements
		<?php elseif ($this->_tpl_vars['curRub']->rub_id == 5): ?>Toutes les actus
		<?php else: ?>Tous les articles<?php endif; ?>
	</h1>
	<ul class="liste">		
		<?php $_from = $this->_tpl_vars['lPg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cPg']):
?>		
				<li>					
					<?php if ($this->_tpl_vars['curRub']->rub_id == 4): ?>
						<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" title="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
">
							<span class="puce">&nbsp;</span> <span class="bleu"><?php echo $this->_tpl_vars['cPg']->pg_date; ?>
</span> : <?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
 <?php if ($this->_tpl_vars['cPg']->pg_lieu): ?>(<?php echo $this->_tpl_vars['cPg']->pg_lieu; ?>
)<?php endif; ?>
						</a>
					<?php else: ?>
						<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" title="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</a>
						<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
#comments" class="comment"><span class="puceFleche">&nbsp;</span> <?php echo $this->_tpl_vars['cPg']->pg_nb_com+0; ?>
 commentaire<?php if ($this->_tpl_vars['cPg']->pg_nb_com > 1): ?>s<?php endif; ?></a>
					<?php endif; ?>
				</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>

<div class="noleft"></div>

<button class="more more<?php echo $this->_tpl_vars['curRub']->rub_id; ?>
 ptSans" onclick="<?php if ($this->_tpl_vars['currentUser']->usr_id > 0): ?>location.href='./publier-<?php echo $this->_tpl_vars['curRub']->rub_id; ?>
'<?php else: ?>openModalPopup('./connexion', '', 280, 380)<?php endif; ?>">
	<span class="pucePartage">&nbsp;</span> Pour partager <?php if ($this->_tpl_vars['curRub']->rub_id == 4): ?>un évènement<?php elseif ($this->_tpl_vars['curRub']->rub_id == 5): ?>une expérience<?php else: ?>un usage<?php endif; ?>, c'est ici
</button>