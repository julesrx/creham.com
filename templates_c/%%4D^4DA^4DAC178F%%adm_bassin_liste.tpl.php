<?php /* Smarty version 2.6.18, created on 2013-12-09 10:00:10
         compiled from securite/tpl/adm_bassin_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sizeof', 'securite/tpl/adm_bassin_liste.tpl', 19, false),array('function', 'PrintEditor', 'securite/tpl/adm_bassin_liste.tpl', 37, false),array('modifier', 'intval', 'securite/tpl/adm_bassin_liste.tpl', 44, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=bassin&act=liste">>> Nouveau bassin</a>
		</div>

		<div class="listeElt">
		<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>
			<a href="gestion.php?ob=bassin&act=liste&bas_id=<?php echo $this->_tpl_vars['cElt']->bas_id; ?>
">
					<div class="<?php if ($this->_tpl_vars['selElt']->bas_id == $this->_tpl_vars['cElt']->bas_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?>">
						<b><?php echo $this->_tpl_vars['cElt']->bas_ordre; ?>
 - <?php echo $this->_tpl_vars['cElt']->bas_lib; ?>
</b>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Pas de bassin s&eacute;lectionn&eacute;</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo smarty_function_sizeof(array('liste' => $this->_tpl_vars['lElt']), $this);?>
 bassins</div>
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
	<span class="tblEntete isCentre"><i><b><?php echo $this->_tpl_vars['selElt']->bas_lib; ?>
</b></i></span>
	<form action="gestion.php?ob=bassin&act=save" method="POST" id="formProfil" enctype="multipart/form-data">
		<input type="hidden" value="<?php echo $this->_tpl_vars['selElt']->bas_id; ?>
" name="bas_id" id="bas_id">
		<div class="nofloat"></div>
		<label>Libellé : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->bas_lib; ?>
" name="bas_lib" id="bas_lib">
		<div class="nofloat"></div>
		<label>Ordre : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->bas_ordre; ?>
" name="bas_ordre" id="bas_ordre">
		<div class="nofloat"></div>
		<label>Contenu : </label>
		<div class="nofloat"></div>				
		<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['selElt']->bas_contenu,'name' => 'bas_contenu','width' => '555','height' => '300'), $this);?>

				
		<div class="nofloat"></div>
		<label>Couleur HTML (#XXXXXX) : </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->bas_couleur; ?>
" name="bas_couleur" id="bas_couleur"/>
		<div class="nofloat">&nbsp;</div>		
		<br/><br/>		
		<div id="position" style="position: relative;background: url(./upload/images/<?php echo $this->_tpl_vars['site']->site_photo; ?>
) 0 0 no-repeat; width:600px; height: 400px">
			<div id="puce" style="position: absolute; padding: 5px; color: red; border: 1px dashed red; width: 100px; height: 50px; top:<?php echo ((is_array($_tmp=$this->_tpl_vars['selElt']->bas_y)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px; left: <?php echo ((is_array($_tmp=$this->_tpl_vars['selElt']->bas_x)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
px;">positionnez sur la zone</div>					
		</div>			
		<div class="nofloat"></div>
		
		<input type="hidden" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->bas_x; ?>
" name="bas_x" id="bas_x">
		<input type="hidden" class="formInput" value="<?php echo $this->_tpl_vars['selElt']->bas_y; ?>
" name="bas_y" id="bas_y">
			
		<div class="btnAction">
			<?php if ($this->_tpl_vars['selElt']->bas_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=bassin&act=del&bas_id=<?php echo $this->_tpl_vars['selElt']->bas_id; ?>
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
	            $(\'#bas_x\').val(Math.round(xPos));
	            $(\'#bas_y\').val(Math.round(yPos));
	        },
	        stop: function(){
	        	var finalOffset = $(this).position();
	            var finalxPos = finalOffset.left;
	            var finalyPos = finalOffset.top;
			    $(\'#bas_x\').val( Math.round(finalxPos));
			    $(\'#bas_y\').val( Math.round(finalyPos));
	        }
	    });
    
</script>
'; ?>
	

	
	