<?php /* Smarty version 2.6.18, created on 2013-10-11 12:19:24
         compiled from contenu/tpl/page_bycateg.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'MakeLienHTML', 'contenu/tpl/page_bycateg.tpl', 38, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "contenu/tpl/page_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="liste">

	<?php if ($this->_tpl_vars['curPg']): ?>
		<h2 class="titre"><?php echo $this->_tpl_vars['curPg']->cat_lib; ?>
</h2>
		<h3 class="intro" id="intro"><?php echo $this->_tpl_vars['curPg']->pg_titre; ?>
</h3>
					
		<div class="text truncate" truncate="1" expand="1" truncid="1" id="toTruncate" style="">
			<?php if ($this->_tpl_vars['curPg']->pg_photo): ?>
				<div class="illus">
					<img src="./upload/images/p_<?php echo $this->_tpl_vars['curPg']->pg_photo; ?>
" alt="<?php echo $this->_tpl_vars['curPg']->pg_titre; ?>
" class="rond"/>
					<?php if ($this->_tpl_vars['curPg']->pg_info['pg_legende']): ?><?php echo $this->_tpl_vars['curPg']->pg_info['pg_legende']; ?>
<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['curPg']->pg_chapo): ?><div class="intro" id="intro"><?php echo $this->_tpl_vars['curPg']->pg_chapo; ?>
</div><?php endif; ?>
			<?php echo $this->_tpl_vars['curPg']->pg_contenu; ?>

			<?php if ($this->_tpl_vars['lRes']): ?>
				<strong>A voir :</strong><br/> 
				<?php $_from = $this->_tpl_vars['lRes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cRes']):
?>
					<a href="<?php echo $this->_tpl_vars['CFG']->docurl; ?>
<?php echo $this->_tpl_vars['cRes']->res_contenu; ?>
" target="_blank"><?php echo $this->_tpl_vars['cRes']->res_titre; ?>
</a> 			
				<?php endforeach; endif; unset($_from); ?>			
				<br/>
			<?php endif; ?>
		</div>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "contenu/tpl/tools.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div id="autre">Autres conseils dans cette catégorie</div>
	<?php endif; ?>
	
	<?php $this->assign('prec', ""); ?>
	<?php $_from = $this->_tpl_vars['lPg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cPg']):
?>
		<?php if ($this->_tpl_vars['prec'] != $this->_tpl_vars['cPg']->cat_id && ! $this->_tpl_vars['curPg']): ?>
			<h2 class="titre"><?php echo $this->_tpl_vars['cPg']->cat_lib; ?>
</h2>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['curPg']->pg_id != $this->_tpl_vars['cPg']->pg_id): ?>
			<ul class="liste">			
				<li>
					<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'cp','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" title="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</a>
					<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
#comments" class="comment"><span class="comment"><span class="puceFleche">&nbsp;</span> <?php echo $this->_tpl_vars['cPg']->pg_nb_com+0; ?>
 commentaire<?php if ($this->_tpl_vars['cPg']->pg_nb_com > 1): ?>s<?php endif; ?></a></span>
				</li>
			</ul>
		<?php endif; ?>
		<?php $this->assign('prec', $this->_tpl_vars['cPg']->cat_id); ?>
	<?php endforeach; endif; unset($_from); ?>
	
</div>

<div class="noleft"></div>

<button class="more more<?php echo $this->_tpl_vars['curRub']->rub_id; ?>
 ptSans" onclick="<?php if ($this->_tpl_vars['currentUser']->usr_id > 0): ?>location.href='./publier-<?php echo $this->_tpl_vars['curRub']->rub_id; ?>
'<?php else: ?>openModalPopup('./connexion', '', 280, 380)<?php endif; ?>">
	<span class="pucePartage">&nbsp;</span> Pour partager un conseil, c'est ici
</button>

<?php echo '
<script>
	$().ready(function() {
		
		
		// on définit la hauteur du bloc text pour que hauteur Titre + intro + text < 380px
		var hTitre = $("#titre").height();
		var hIntro = $("#intro").height();
		var hTexte = $("#toTruncate").height();
		var hListe = $("#Liste").height();
		var hToTruncate = 220-hTitre;
		if (hToTruncate > 0){
			// est-ce bien nécessaire
			if (hTitre + hTexte > 266)	$("#toTruncate").height(hToTruncate);
		} else $("#toTruncate").height(\'100\');
	});
</script>
'; ?>
 