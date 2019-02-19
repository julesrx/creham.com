<?php /* Smarty version 2.6.18, created on 2013-10-11 12:41:38
         compiled from contenu/tpl/result.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'MakeLienHTML', 'contenu/tpl/result.tpl', 19, false),array('modifier', 'ucfirst', 'contenu/tpl/result.tpl', 36, false),array('modifier', 'cat', 'contenu/tpl/result.tpl', 36, false),array('modifier', 'strtoupper', 'contenu/tpl/result.tpl', 36, false),)), $this); ?>

<div id="liste" style="width: 90% !important">
	<?php if ($this->_tpl_vars['from'] == 'publi'): ?>
		<h1 class="titre" >Mes publications</h1>
		<?php if ($this->_tpl_vars['errMsg']): ?><div class="errMsg"><?php echo $this->_tpl_vars['errMsg']; ?>
</div>
		<?php elseif ($this->_tpl_vars['okMsg']): ?><div class="okMsg"><?php echo $this->_tpl_vars['okMsg']; ?>
</div>
		<?php endif; ?>
	<?php else: ?><div class="texte" style="font-size: 1.3em;">Résultat de la recherche : "<?php echo $this->_tpl_vars['mot']; ?>
"</div>
		<br/><br/><br/>
	<?php endif; ?>
	
	<?php $this->assign('prec', ""); ?>
	<?php $_from = $this->_tpl_vars['lPg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cPg']):
?>
		<?php if ($this->_tpl_vars['prec'] != $this->_tpl_vars['cPg']->rub_id): ?>
			<h2 class="titre" style="margin-top: 20px;"><img src="./upload/images/picto/<?php echo $this->_tpl_vars['cPg']->rub_info['rub_picto']; ?>
" style="vertical-align: middle; height: 20px"/>&nbsp;<?php echo $this->_tpl_vars['cPg']->rub_lib; ?>
</h2>
		<?php endif; ?>
		<ul class="liste">			
			<li>
				<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" title="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</a>
				<?php if ($this->_tpl_vars['from'] == 'publi'): ?><small>(<?php if ($this->_tpl_vars['cPg']->pg_statut == 1): ?>En ligne<?php else: ?>En validation<?php endif; ?>)</small><?php endif; ?>
				<a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
#comments" class="comment"><span class="comment"><span class="puceFleche">&nbsp;</span> <?php echo $this->_tpl_vars['cPg']->pg_nb_com+0; ?>
 commentaire<?php if ($this->_tpl_vars['cPg']->pg_nb_com > 1): ?>s<?php endif; ?></a></span>
				<?php if ($this->_tpl_vars['from'] == 'publi'): ?>
					<button class="btnOk" onclick="location.href='./modifier-<?php echo $this->_tpl_vars['cPg']->pg_id; ?>
'" title="Modifier cette publication">Modifier</button>
					<button class="btnDel" onclick="checkConfirmUrl('./supprimer-<?php echo $this->_tpl_vars['cPg']->pg_id; ?>
', 'la suppression de cette publication')">Supprimer</button>
				<?php endif; ?>
			</li>
		</ul>
		
		<?php $this->assign('prec', $this->_tpl_vars['cPg']->rub_id); ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php if ($this->_tpl_vars['lPro']): ?>
		<h2 class="titre">CARTOGRAPHIE</h2>
		<?php $_from = $this->_tpl_vars['lPro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cUser']):
?>		
		<ul>			
			<li>
				<a href="<?php echo MakeLienHTML(array('lib' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['cUser']->usr_prenom)) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)))) ? $this->_run_mod_handler('cat', true, $_tmp, '-') : smarty_modifier_cat($_tmp, '-')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['cUser']->usr_nom) : smarty_modifier_cat($_tmp, $this->_tpl_vars['cUser']->usr_nom)))) ? $this->_run_mod_handler('strtoupper', true, $_tmp) : strtoupper($_tmp)),'type' => 'carte','id' => $this->_tpl_vars['cUser']->usr_id), $this);?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['cUser']->usr_prenom)) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['cUser']->usr_nom)) ? $this->_run_mod_handler('strtoupper', true, $_tmp) : strtoupper($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['cUser']->usr_prenom)) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['cUser']->usr_nom)) ? $this->_run_mod_handler('strtoupper', true, $_tmp) : strtoupper($_tmp)); ?>
</a>				
			</li>
		</ul>		
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
</div>

<div class="noleft"></div>