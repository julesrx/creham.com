<?php /* Smarty version 2.6.18, created on 2013-11-05 10:55:08
         compiled from securite/tpl/adm_etablissement_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sizeof', 'securite/tpl/adm_etablissement_liste.tpl', 18, false),array('function', 'html_options', 'securite/tpl/adm_etablissement_liste.tpl', 37, false),array('function', 'PrintEditor', 'securite/tpl/adm_etablissement_liste.tpl', 43, false),array('modifier', 'intval', 'securite/tpl/adm_etablissement_liste.tpl', 70, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=etab&amp;act=liste">>> Nouvel établissement</a>
		</div>

		<div class="listeElt">
		<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>
			<a href="gestion.php?ob=etab&amp;act=liste&amp;etab_id=<?php echo $this->_tpl_vars['cElt']->etab_id; ?>
">
					<div class="<?php if ($this->_tpl_vars['selElt']->etab_id == $this->_tpl_vars['cElt']->etab_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?>">
						<b><?php echo $this->_tpl_vars['cElt']->etab_lib; ?>
</b>			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Pas d'établissement s&eacute;lectionn&eacute;</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo smarty_function_sizeof(array('liste' => $this->_tpl_vars['lElt']), $this);?>
 établissements</div>
	</div>
	<div id="centre">
		<div id="action">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "commun/tpl/adm_ok_msg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
		
<div id="viewProfil">
	<span class="tblEntete isCentre"><i><b><?php echo $this->_tpl_vars['selElt']->etab_lib; ?>
</b></i></span>
	<form action="gestion.php?ob=etab&amp;act=save" method="POST" id="formProfil" enctype="multipart/form-data">
		<input type="hidden" value="<?php echo $this->_tpl_vars['selElt']->etab_id; ?>
" name="etab_id" id="etab_id">		
		<div class="btnAction">
			<?php if ($this->_tpl_vars['selElt']->etab_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=etab&amp;act=del&amp;etab_id=<?php echo $this->_tpl_vars['selElt']->etab_id; ?>
', 'la suppression')"><?php endif; ?>
			<input type="submit" value="Enregistrer" class="btnSave">
		</div>
		<label>Nom* : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_lib; ?>
" name="etab_lib" id="etab_lib" onchange="$('#libEtab').text($(this).val())"/>
		<div class="nofloat"></div>
		<label>Bassin* : </label><select name='bas_id' id='bas_id' class="formInput">
							<option>>> Choisir</option>
							<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['bassin_options'],'selected' => $this->_tpl_vars['selElt']->bas_id), $this);?>

							</select>
		<div class="nofloat"></div>
				
		<label>Description libre : </label>
		<div class="nofloat"></div>				
		<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['selElt']->etab_contenu,'name' => 'etab_contenu','width' => "65%",'height' => '100'), $this);?>

		<div class="nofloat"></div>
		<label>Url : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_url; ?>
" name="etab_url" id="etab_url">
		<div class="nofloat"></div>
		<label>Adresse :<br/><small><a href="javascript:void(0)" onclick="window.open('http://maps.google.com/maps?f=q&source=s_q&hl=fr&geocode=&q='+escape($('#etab_adresse_geoloc').val())+'&ie=iso-8859-1&z=16')" >(&gt; vérifier)</a></small></label><textarea rows="3" class="formInput" name="etab_adresse_geoloc" id="etab_adresse_geoloc"><?php echo $this->_tpl_vars['selElt']->etab_adresse_geoloc; ?>
</textarea>
		
		<div class="nofloat"></div>
		<label>Logo :</label><input type="file" name="etab_logo" /><input type="hidden" name="etab_logo_old" value="<?php echo $this->_tpl_vars['selElt']->etab_logo; ?>
"/>				
		<?php if ($this->_tpl_vars['selElt']->etab_logo): ?>
			<div class="nofloat">&nbsp;</div>
			<a href="./upload/images/l_<?php echo $this->_tpl_vars['selElt']->etab_logo; ?>
" target="_blank"  title="voir"><img src="./upload/images/vign_<?php echo $this->_tpl_vars['selElt']->etab_logo; ?>
" alt="voir"/></a>
			<a href="javascript:checkConfirmUrl('gestion.php?ob=etab&amp;act=delPhoto&amp;etab_id=<?php echo $this->_tpl_vars['selElt']->etab_id; ?>
', 'la suppression')" title="supprimer"><img src="./images/icon_del.gif" alt="supprimer"/></a>
		<?php endif; ?>
		<div class="nofloat">&nbsp;</div>
		<label>Contact (email) :</label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_mail; ?>
" name="etab_mail" id="etab_mail"/>
		<div class="nofloat"></div>	
		<label>Messagerie sécurisée : </label><select class="formInput" name="etab_is_securise"><option></option><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['ouinon_options'],'selected' => $this->_tpl_vars['selElt']->etab_is_securise), $this);?>
</select>
		<div class="nofloat"></div>
		
		<input type="hidden" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_x; ?>
" name="etab_x" id="etab_x">
		<input type="hidden" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_y; ?>
" name="etab_y" id="etab_y">
		<input type="hidden" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_libx; ?>
" name="etab_libx" id="etab_libx">
		<input type="hidden" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_liby; ?>
" name="etab_liby" id="etab_liby">
		<label>Positionnement :</label>	
		<div class="nofloat"></div>
		
		<div id="position" style="position: relative;background: url(./upload/images/<?php echo $this->_tpl_vars['site']->site_photo; ?>
) 0 0 no-repeat; width:600px; height: 400px">
			<img src="./images/info.png" id="puce" style="position: absolute; top:<?php echo ((is_array($_tmp=$this->_tpl_vars['selElt']->etab_y)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; left: <?php echo ((is_array($_tmp=$this->_tpl_vars['selElt']->etab_x)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px;" title="Cliquer et déplacer la puce sur la carte"/>
			<span id="libEtab" class="etab" style="position: absolute; top:<?php echo ((is_array($_tmp=$this->_tpl_vars['selElt']->etab_liby)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; left: <?php echo ((is_array($_tmp=$this->_tpl_vars['selElt']->etab_libx)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px;" title="Cliquer et déplacer le titre sur la carte"><?php echo $this->_tpl_vars['selElt']->etab_lib; ?>
</span>
			
						<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>
				<?php if ($this->_tpl_vars['cElt']->etab_id != $this->_tpl_vars['selElt']->etab_id): ?>
					<img src="./images/info.png" style="position: absolute; top:<?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->etab_y)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; left: <?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->etab_x)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px;"/>
					<span class="etab" style="position: absolute; top:<?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->etab_liby)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; left: <?php echo ((is_array($_tmp=$this->_tpl_vars['cElt']->etab_libx)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px;"><?php echo $this->_tpl_vars['cElt']->etab_lib; ?>
</span>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			
		</div>			
		<div class="nofloat"></div>
		
		<label>Filler1 : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_filler1; ?>
" name="etab_filler1" id="etab_filler1"/>
		<div class="nofloat"></div>
		<label>Filler2 : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_filler2; ?>
" name="etab_filler2" id="etab_filler2"/>
		<div class="nofloat"></div>
		<label>Filler3 : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_filler3; ?>
" name="etab_filler3" id="etab_filler3"/>
		<div class="nofloat"></div>
		<label>Filler4 : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->etab_filler4; ?>
" name="etab_filler4" id="etab_filler4"/>
		<div class="nofloat"></div>
	
		
		
		
		
		<div class="btnAction">
			<?php if ($this->_tpl_vars['selElt']->etab_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=etab&amp;act=del&amp;etab_id=<?php echo $this->_tpl_vars['selElt']->etab_id; ?>
', 'la suppression')"><?php endif; ?>
			<input type="submit" value="Enregistrer" class="btnSave">
		</div>

		<div class="nofloat"></div>
	</form>
</div>

	</div>

<?php echo '	
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(\'#puce\').draggable(
	    {
	        containment: $(\'#position\'),
	        drag: function(){
	        	var offset = $(this).position();
	            var xPos = offset.left;
	            var yPos = offset.top;
	            $(\'#etab_x\').val(Math.round(xPos));
	            $(\'#etab_y\').val(Math.round(yPos));
	        },
	        stop: function(){
	        	var finalOffset = $(this).position();
	            var finalxPos = finalOffset.left;
	            var finalyPos = finalOffset.top;
			    $(\'#etab_x\').val( Math.round(finalxPos));
			    $(\'#etab_y\').val( Math.round(finalyPos));
	        }
	    });
$(\'#libEtab\').draggable(
	    {
	        containment: $(\'#position\'),
	        stop: function(){
	        	var finalOffset = $(this).position();
	            var finalxPos = finalOffset.left;
	            var finalyPos = finalOffset.top;
			    $(\'#etab_libx\').val( Math.round(finalxPos));
			    $(\'#etab_liby\').val( Math.round(finalyPos));
	        }
	    });	    
</script>
'; ?>
	