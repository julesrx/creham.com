<?php /* Smarty version 2.6.18, created on 2013-10-11 12:57:22
         compiled from securite/tpl/cartographie.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'securite/tpl/cartographie.tpl', 5, false),array('modifier', 'ucfirst', 'securite/tpl/cartographie.tpl', 27, false),array('modifier', 'strtoupper', 'securite/tpl/cartographie.tpl', 27, false),array('modifier', 'intval', 'securite/tpl/cartographie.tpl', 82, false),array('function', 'MakeLienHTML', 'securite/tpl/cartographie.tpl', 8, false),)), $this); ?>
<div id="cartographie">
	<div id="pres">
		<div class="item" onclick="$('.tohide').hide();$('#activite').toggle()"><span class="puce"></span> Activité DMP</div>
		<div id="activite" class="decal tohide" <?php if ($_GET['m'] != 'activite' && $this->_tpl_vars['isGoogle']): ?> style="display: none"<?php endif; ?>>
			<div style="color: #00539A;">(Données depuis 2012 au <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
)</div>
			<div class="bassins">
				<?php $_from = $this->_tpl_vars['lBas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cBassin']):
?>
					<div class="titre" style="color:<?php echo $this->_tpl_vars['cBassin']->bas_couleur; ?>
"</div><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cBassin']->bas_lib,'type' => 'b','id' => $this->_tpl_vars['cBassin']->bas_id), $this);?>
?m=activite" title="voir la carte">&gt; <?php echo $this->_tpl_vars['cBassin']->bas_lib; ?>
</a></div>
					<div class="desc"><?php echo $this->_tpl_vars['cBassin']->bas_contenu; ?>
</div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		</div>
		
		<div class="item" onclick="$('.tohide').hide();$('#pro').toggle()"><span class="puce"></span> Professionnels de santé</div>
		<div id="pro" <?php if ($_GET['m'] != 'pro'): ?> style="display: none"<?php endif; ?> class="decal  tohide">
			<div >
				<?php if ($this->_tpl_vars['lUser']): ?>
					<?php $this->assign('prec', ""); ?>
					<?php $_from = $this->_tpl_vars['lUser']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cUser']):
?>
						<?php if ($this->_tpl_vars['cUser']->bas_id != $this->_tpl_vars['prec']): ?>
							<?php if ($this->_tpl_vars['prec'] != ""): ?></div><?php endif; ?>
							<div class="titreBassin" style="color:<?php echo $this->_tpl_vars['cUser']->bas_couleur; ?>
" onclick="$('.pros').hide();"><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cUser']->bas_lib,'type' => 'b','id' => $this->_tpl_vars['cUser']->bas_id), $this);?>
?m=pro" title="voir la carte">&gt; <?php echo $this->_tpl_vars['cUser']->bas_lib; ?>
</a></div>
							
							<div class="pros" <?php if ($this->_tpl_vars['cBas_id'] != $this->_tpl_vars['cUser']->bas_id): ?>style="display: none"<?php endif; ?> id="pro_<?php echo $this->_tpl_vars['cUser']->bas_id; ?>
">						
						<?php endif; ?>
						<div class="lnkTips" id="lnk_<?php echo $this->_tpl_vars['cUser']->usr_id; ?>
" my-data="<?php echo $this->_tpl_vars['cUser']->usr_id; ?>
">
							<a href="#" id="pro_open_<?php echo $this->_tpl_vars['cUser']->usr_id; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['cUser']->usr_prenom)) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['cUser']->usr_nom)) ? $this->_run_mod_handler('strtoupper', true, $_tmp) : strtoupper($_tmp)); ?>
</a>
						</div>
						<?php $this->assign('prec', $this->_tpl_vars['cUser']->bas_id); ?>				
					<?php endforeach; endif; unset($_from); ?>
					</div>
				<?php endif; ?>
			</div>	
		</div>
		
		<div class="item" onclick="$('.tohide').hide();$('#etab').toggle(); $('#infoEtab').toggle()"><span class="puce"></span> Etablissements de santé</div>
		<div id="etab" <?php if ($_GET['m'] != 'etab'): ?>style="display: none"<?php endif; ?> class="decal tohide">
			<div class="bassins">
				<?php $this->assign('prec', ""); ?>
				<?php $_from = $this->_tpl_vars['lEtab']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cEtab']):
?>
					<?php if ($this->_tpl_vars['cEtab']->bas_id != $this->_tpl_vars['prec']): ?>
						<?php if ($this->_tpl_vars['prec'] != ""): ?></div><?php endif; ?>
						<div class="titre" style="color:<?php echo $this->_tpl_vars['cEtab']->bas_couleur; ?>
"><a href="<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cEtab']->bas_lib,'type' => 'b','id' => $this->_tpl_vars['cEtab']->bas_id), $this);?>
?m=etab" title="voir la carte">&gt; <?php echo $this->_tpl_vars['cEtab']->bas_lib; ?>
</a></div>
						<div class="desc">						
					<?php endif; ?>
					<div class="lnkTips" id="lnk_<?php echo $this->_tpl_vars['cEtab']->etab_id; ?>
" my-data="<?php echo $this->_tpl_vars['cEtab']->etab_id; ?>
"><a href="javascript:void(0)" id="etab_open_<?php echo $this->_tpl_vars['cEtab']->etab_id; ?>
"><?php echo $this->_tpl_vars['cEtab']->etab_lib; ?>
</a></div>
					<?php $this->assign('prec', $this->_tpl_vars['cEtab']->bas_id); ?>				
				<?php endforeach; endif; unset($_from); ?>
				</div>
			</div>							
		</div>
		
		<?php if (! $this->_tpl_vars['isGoogle']): ?>
			<div class="info rond tohide" id="infoEtab" style="display: none">
				<div class="puceInfo" style="position: absolute; top: 10px; left: 10px;"></div>
				Passez votre souris sur la carte pour obtenir des informations sur les établissements de santé (pratiques du DMP, site internet...)
			</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['isGoogle']): ?>
			<div class="info rond" id="infoEtab2">
			<div class="puceInfo" style="position: absolute; top: 10px; left: 10px;"></div>
			Cliquez sur la carte pour obtenir des informations sur les professionnels et les établissements de santé (pratiques du DMP, site internet, coordonnées...)
			</div>
		<?php endif; ?>
	</div>
	
	
<?php if ($this->_tpl_vars['isGoogle']): ?>
	<?php if ($this->_tpl_vars['map']): ?>
		<?php echo $this->_tpl_vars['map']->printHeaderJS(); ?>

		<?php echo $this->_tpl_vars['map']->printMapJS(); ?>

		<?php echo $this->_tpl_vars['map']->printMap(); ?>
 
		<?php echo $this->_tpl_vars['map']->printOnLoad(); ?>

	<?php else: ?>
		Aucun résultat ne correspond à vos critères de recherche.
	<?php endif; ?> 

<?php else: ?>	
	<div id="carte" style="position: relative; background: url(./upload/images/<?php echo $this->_tpl_vars['site']->site_photo; ?>
) 0 0 no-repeat;">
						<?php $_from = $this->_tpl_vars['lBas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cBassin']):
?>
				<button onclick="location.href='<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cBassin']->bas_lib,'type' => 'b','id' => $this->_tpl_vars['cBassin']->bas_id), $this);?>
'" title="Voir la carte du <?php echo $this->_tpl_vars['cBassin']->bas_lib; ?>
" style="position: absolute; width: 100px; height: 50px; top:<?php echo ((is_array($_tmp=$this->_tpl_vars['cBassin']->bas_y)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; left: <?php echo ((is_array($_tmp=$this->_tpl_vars['cBassin']->bas_x)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; background: none;"><?php echo $this->_tpl_vars['cBassin']->bassin_lib; ?>
</button>
			<?php endforeach; endif; unset($_from); ?>
	
						<?php $_from = $this->_tpl_vars['lEtab']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>
				<?php if ($this->_tpl_vars['cElt']->etab_id != $this->_tpl_vars['selElt']->etab_id): ?>
					<img src="./images/info.png" style="position: absolute; top:<?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->etab_y)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; left: <?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->etab_x)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px;"  
						class="tips" id="<?php echo $this->_tpl_vars['cElt']->etab_id; ?>
" title="tips<?php echo $this->_tpl_vars['cElt']->etab_id; ?>
"	<?php if ($this->_tpl_vars['cElt']->etab_url): ?>alt="cliquez pour accéder au site internet de cet établissement" onclick="window.open('<?php echo $this->_tpl_vars['cElt']->etab_url; ?>
');"<?php endif; ?>/>
					<span class="etab" style="position: absolute; top:<?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->etab_liby)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; left: <?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->etab_libx)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px;"><?php echo $this->_tpl_vars['cElt']->etab_lib; ?>
</span>
					<div id="tips<?php echo $this->_tpl_vars['cElt']->etab_id; ?>
" style="display: none">
						<?php if ($this->_tpl_vars['cElt']->etab_logo): ?><img src="./upload/images/l_<?php echo $this->_tpl_vars['cElt']->etab_logo; ?>
" width="50" class=""/><?php endif; ?>
						<div class='titre'><?php echo $this->_tpl_vars['cElt']->etab_lib; ?>
</div>
						<div class='desc'><?php echo $this->_tpl_vars['cElt']->etab_contenu; ?>
</div>
						<a href='<?php echo $this->_tpl_vars['cElt']->etab_url; ?>
' target='blank'><?php echo $this->_tpl_vars['cElt']->etab_url; ?>
</a>
					</div>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>					
	</div>
<?php endif; ?>	
	<div class="nofloat">&nbsp;</div>	
	<?php if ($this->_tpl_vars['currentUser']->usr_id && $this->_tpl_vars['currentUser']->usr_carto): ?>
		<button class="more moreCarto ptSans" onclick="location.href='./mon-compte'">
			<span class="pucePartage">&nbsp;</span> Vous êtes professionnel de santé et utilisateur du DMP, vous souhaitez modifier vos coordonnées, cliquez ici
		</button>
	<?php elseif (! $this->_tpl_vars['currentUser']->usr_carto): ?>
		<button class="more moreCarto ptSans" onclick="location.href='./mon-compte'">
			<span class="pucePartage">&nbsp;</span> Vous êtes professionnel de santé et utilisateur du DMP, vous souhaitez apparaître sur le site, cliquez ici
		</button>
	<?php else: ?>
		<button class="more moreCarto ptSans" onclick="location.href='./inscription'">
			<span class="pucePartage">&nbsp;</span> Vous êtes professionnel de santé et utilisateur du DMP, vous souhaitez apparaître sur le site, inscrivez-vous ici
		</button>
	<?php endif; ?>

</div>
