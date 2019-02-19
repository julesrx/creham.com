<?php /* Smarty version 2.6.18, created on 2013-11-05 10:23:38
         compiled from newsletter/tpl/adm_gabarit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'newsletter/tpl/adm_gabarit.tpl', 15, false),array('modifier', 'truncate', 'newsletter/tpl/adm_gabarit.tpl', 15, false),array('function', 'MakeLienHTML', 'newsletter/tpl/adm_gabarit.tpl', 16, false),)), $this); ?>
<?php if ($this->_tpl_vars['type'] == 'une'): ?>
	<table border="0" cellpadding="0" cellspacing="0" width="700">		
		<tr>
			<td style="width: 30px">&nbsp;</td>
			<td style="width: 180px" align="left">
			<?php if ($this->_tpl_vars['cPg']->pg_photo): ?>				
					<img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
upload/images/p_<?php echo $this->_tpl_vars['cPg']->pg_photo; ?>
" alt="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
" style="width: 160px;"/>
			<?php else: ?>&nbsp;										
			<?php endif; ?>
			</td>
			<td>
				<div><img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
images/nl/rub1.gif" alt="A la une"/></div>
				<div><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 23px"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</span></span></span></span></div>
				<div><span style="color: #807F7F;"><span style="font-family: Arial;"><span style="font-weight: normal;"><span style="font-size: 13px">
					<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['cPg']->pg_contenu)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, '...') : smarty_modifier_truncate($_tmp, 200, '...')); ?>

					<a href="<?php echo $this->_tpl_vars['CFG']->url; ?>
<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px"><u>lire la suite</u></a>
					</span></span></span></span>
				</div>
			</td>			
			<td width="30px">&nbsp;</td>
		</tr>
	</table>
<?php else: ?>
	<table border="0" cellpadding="0" cellspacing="0" width="300">
	<?php $this->assign('prec', ""); ?>
	<?php $_from = $this->_tpl_vars['lPg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cPg']):
?>
		<?php if ($this->_tpl_vars['prec'] != $this->_tpl_vars['cPg']->rub_id): ?>
			<tr>
				<td><img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
images/nl/rub<?php echo $this->_tpl_vars['cPg']->rub_id; ?>
.gif" alt="<?php echo $this->_tpl_vars['cPg']->rub_titre; ?>
"/></td>
			</tr>				
			<tr>
				<td>&nbsp;</td>
			</tr>
		<?php endif; ?>
		<?php $this->assign('prec', $this->_tpl_vars['cPg']->rub_id); ?>
		
		<tr>
			<td>
				<?php if ($this->_tpl_vars['cPg']->rub_id != 4): ?>
					<?php if ($this->_tpl_vars['cPg']->pg_photo): ?>
						<table border="0" cellpadding="0" cellspacing="0" width="300">
							<tr><td colspan="2"><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 20px"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</span></span></span></span></td></tr>
							<tr>
								<td style="width: 180px; text-align: left; vertical-align: top;">
									<img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
upload/images/p_<?php echo $this->_tpl_vars['cPg']->pg_photo; ?>
" alt="<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
" style="width: 160px;"/>
								</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2">
									<?php if ($this->_tpl_vars['cPg']->pg_chapo): ?><div><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 13px"><?php echo $this->_tpl_vars['cPg']->pg_chapo; ?>
</span></span></span></span></div><?php endif; ?>
									<div><span style="color: #807F7F;"><span style="font-family: Arial;"><span style="font-weight: normal;"><span style="font-size: 13px">
										<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['cPg']->pg_contenu)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, '...') : smarty_modifier_truncate($_tmp, 200, '...')); ?>

										<a href="<?php echo $this->_tpl_vars['CFG']->url; ?>
<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px"><u>lire la suite</u></a>
										</span></span></span></span>
									</div>	
								</td>
							</tr>							
						</table>
					<?php else: ?>
						<div><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 20px"><?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
</span></span></span></span></div>
						<div>&nbsp;</div>
						<?php if ($this->_tpl_vars['cPg']->pg_chapo): ?><div><span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 13px"><?php echo $this->_tpl_vars['cPg']->pg_chapo; ?>
</span></span></span></span></div><?php endif; ?>
						<div><span style="color: #807F7F;"><span style="font-family: Arial;"><span style="font-weight: normal;"><span style="font-size: 13px">
							<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['cPg']->pg_contenu)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, '...') : smarty_modifier_truncate($_tmp, 200, '...')); ?>

							<a href="<?php echo $this->_tpl_vars['CFG']->url; ?>
<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px"><u>lire la suite</u></a>
							</span></span></span></span>
						</div>
					<?php endif; ?>
				<?php else: ?>
					<div><span style="color: #807F7F;"><span style="font-family: Arial;"><span style="font-weight: normal;"><span style="font-size: 13px">
						<span style="color: #00539A;"><span style="font-family: Arial;"><span style="font-weight: bold;"><span style="font-size: 13px"><?php echo $this->_tpl_vars['cPg']->pg_date; ?>
 : </span></span></span></span>
						<?php echo $this->_tpl_vars['cPg']->pg_titre; ?>
						
						</span></span></span></span>
					</div>
					<div style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px">
						<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['cPg']->pg_contenu)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, '...') : smarty_modifier_truncate($_tmp, 200, '...')); ?>

						<a href="<?php echo $this->_tpl_vars['CFG']->url; ?>
<?php echo MakeLienHTML(array('lib' => $this->_tpl_vars['cPg']->pg_titre,'type' => 'p','id' => $this->_tpl_vars['cPg']->pg_id), $this);?>
" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: normal; font-size: 13px"><u>lire la suite</u></a>
					</div>
					
				<?php endif; ?>
			</td>			
			
		</tr>
	<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<?php if ($this->_tpl_vars['prec'] == 2): ?>
					<a href="<?php echo $this->_tpl_vars['CFG']->url; ?>
usages-r-2" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: bold; font-size: 13px">
						<img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
images/nl/plus.png" alt="" style="vertical-align: middle"/> Tous les usages
					</a>
				<?php elseif ($this->_tpl_vars['prec'] == 3): ?>
					<a href="<?php echo $this->_tpl_vars['CFG']->url; ?>
tous-les-conseils-pratiques-c-" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: bold; font-size: 13px">
						<img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
images/nl/plus.png" alt="" style="vertical-align: middle"/> Plus de conseils pratiques
					</a>		
				<?php elseif ($this->_tpl_vars['prec'] == 4): ?>
					<a href="<?php echo $this->_tpl_vars['CFG']->url; ?>
rendez-vous-r-4" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: bold; font-size: 13px">
						<img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
images/nl/plus.png" alt="" style="vertical-align: middle"/> Tous les rendez-vous
					</a>
				<?php elseif ($this->_tpl_vars['prec'] == 5): ?>
					<a href="<?php echo $this->_tpl_vars['CFG']->url; ?>
toutes-les-actus-r-5" target="_blank" style="color: #807F7F; font-family: Arial; font-weight: bold; font-size: 13px">
						<img src="<?php echo $this->_tpl_vars['CFG']->url; ?>
images/nl/plus.png" alt="" style="vertical-align: middle"/> Toutes les actus
					</a>
				<?php endif; ?>
			</td>
		</tr>
	</table>


<?php endif; ?>