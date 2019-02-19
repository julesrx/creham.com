<?php /* Smarty version 2.6.18, created on 2013-10-18 14:24:27
         compiled from newsletter/tpl/adm_nl_liste.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'newsletter/tpl/adm_nl_liste.tpl', 49, false),array('function', 'PrintEditor', 'newsletter/tpl/adm_nl_liste.tpl', 69, false),array('modifier', 'date_format', 'newsletter/tpl/adm_nl_liste.tpl', 56, false),)), $this); ?>
	<div id="gauche">
		
		<div class="tblEntete">
			<a href="gestion.php?ob=nl&act=listeNL">>> Nouvelle Newsletter</a>
		</div>

		<div class="listeElt">
		<?php $this->assign('prec', ""); ?>
		<?php $_from = $this->_tpl_vars['lElt']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cElt']):
?>
			<?php if ($this->_tpl_vars['prec'] != $this->_tpl_vars['cElt']->nl_type): ?>
				<div style="padding: 3px;"><b><?php echo $this->_tpl_vars['cElt']->nl_type; ?>
</b></div>
				<?php $this->assign('prec', $this->_tpl_vars['cElt']->nl_type); ?>
			<?php endif; ?>
			<a href="gestion.php?ob=nl&act=listeNL&nl_id=<?php echo $this->_tpl_vars['cElt']->nl_id; ?>
">
					<div class="<?php if ($this->_tpl_vars['curElt']->nl_id == $this->_tpl_vars['cElt']->nl_id): ?>tblOn<?php else: ?>tblOff<?php endif; ?> statut<?php echo $this->_tpl_vars['cElt']->nl_statut+0; ?>
" style="padding-left: 20px">
						<?php echo $this->_tpl_vars['cElt']->nl_titre; ?>
			
					</div>
			</a>	
		<?php endforeach; else: ?>
			<div class="tblOff">Aucune newsletter</div>
		<?php endif; unset($_from); ?>
		</div>
		<div class="tblEntete"><?php echo $this->_tpl_vars['nb']+0; ?>
 newsletters</div>
	</div>
	<div id="centre">
		<?php if (1): ?>
		<div id="action">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "commun/tpl/adm_ok_msg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
		<div id="viewProfil">
			<span class="tblEntete isCentre">
				<?php if ($this->_tpl_vars['curElt']->nl_id): ?>
					<input type="button" value="PREVISUALISER" onclick="window.open('gestion.php?ob=nl&act=viewNL&nl_id=<?php echo $this->_tpl_vars['curElt']->nl_id; ?>
&pop=X')" class="onglet"/>
					<input type="button" value="TESTER" onclick="checkConfirmUrl('gestion.php?ob=nl&act=sendTestNL&nl_id=<?php echo $this->_tpl_vars['curElt']->nl_id; ?>
', 'le test')" class="onglet"/>
					<input type="button" value="ENVOYER" onclick="checkConfirmUrl('gestion.php?ob=nl&act=sendNL&nl_id=<?php echo $this->_tpl_vars['curElt']->nl_id; ?>
', 'l\'envoi')" class="onglet"/>
					<div style="float: right; margin-right: 20px;"><a href="javascript:void(0)" onclick="openModalPopup('gestion.php?ob=nl&act=suiviNL&nl_id=<?php echo $this->_tpl_vars['curElt']->nl_id; ?>
&pop=X', 'Suivi', 500, 800)" class="popup onglet">Suivi</a></div>
					<?php endif; ?>
			</span>
			
			<form action="gestion.php?ob=nl&act=saveNL" method="POST" id="formProfil" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $this->_tpl_vars['curElt']->nl_id; ?>
" name="nl_id" id="nl_id">
				<div class="btnAction">
					<?php if ($this->_tpl_vars['curElt']->nl_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=nl&act=delNL&nl_id=<?php echo $this->_tpl_vars['curElt']->nl_id; ?>
', 'la suppression')"/><?php endif; ?>
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat"></div>
				<label>Statut : </label><select name='nl_statut' id='nl_statut' class="formInput">
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['status_options'],'selected' => $this->_tpl_vars['curElt']->nl_statut+0), $this);?>

										</select>
					<div class="nofloat"></div>
				<label>Titre (gestion) : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['curElt']->nl_titre; ?>
" name="nl_titre" id="nl_titre"/>
				<div class="nofloat"></div>
				
				<?php if ($this->_tpl_vars['curElt']->nl_id): ?>
					<label>Créée le : </label><label><?php echo ((is_array($_tmp=$this->_tpl_vars['curElt']->nl_d_crea)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</label>
					<div class="nofloat"></div>
				<?php endif; ?>
				<label>Sujet du mail : </label><input type="text" class="formInput required" value="<?php echo $this->_tpl_vars['curElt']->nl_sujet; ?>
" name="nl_sujet" id="nl_sujet"/>
				<div class="nofloat"></div>
				<div id="tabs">
					<ul>
					    <li><a href="#niv1"><span>Corps</span></a></li>
					    <li><a href="#niv2"><span>Construction</span></a></li>				   
					</ul>
					<div id="niv1">
						<label>Corps du mail : </label>
						<div class="nofloat"></div>				
						<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['curElt']->nl_corps,'name' => 'nl_corps','width' => '555','height' => '350'), $this);?>

						<div class="nofloat"></div>
					</div>
					<div id="niv2" style="background-color: #F0F0F0;">
						<button id="recopie" class="rond" style="background-color: orange; padding: 5px;">Recopier dans le corps de la newsletter</button>
						<br/><br/>
						<div id="source">
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "newsletter/tpl/template.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						</div>
						
					</div>
				</div>
				<label>Pièce jointe :</label><input type="file" name="nl_pj" /><input type="hidden" name="nl_pj_old" value="<?php echo $this->_tpl_vars['curElt']->nl_pj; ?>
"/>
				<?php if ($this->_tpl_vars['curElt']->nl_pj): ?>
					<div class="nofloat">&nbsp;</div>
					<a href="./upload/<?php echo $this->_tpl_vars['curElt']->nl_pj; ?>
" target="_blank"><img src="./images/pdf.jpg" height="50"/></a>
					<a href="javascript:checkConfirmUrl('gestion.php?ob=nl&act=delPJ&pg_id=<?php echo $this->_tpl_vars['curElt']->nl_id; ?>
', 'la suppression')">Supprimer ?</a>
				<?php endif; ?>
				<div class="nofloat">&nbsp;</div>
				<label>Email de test :<br/><small>(séparés par ;)</small> </label><input type="text" class="formInput" value="<?php echo $this->_tpl_vars['curElt']->nl_test_mail; ?>
" name="nl_test_mail" id="nl_test_mail"/>
				<div class="nofloat"></div>
				
				
				<div class="nofloat"></div>	
				<div class="btnAction">
					<?php if ($this->_tpl_vars['curElt']->nl_id): ?><input type="button" value="Supprimer" class="btnDel" onclick="checkConfirmUrl('gestion.php?ob=nl&act=delNL&nl_id=<?php echo $this->_tpl_vars['curElt']->nl_id; ?>
', 'la suppression')"/><?php endif; ?>
					<input type="submit" value="Enregistrer" class="btnSave"/>
				</div>
				<div class="nofloat"></div>
			</form>
		</div>

		<?php endif; ?>
	</div>
	
<?php echo '
<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#formProfil").validate();
		$( "#tabs" ).tabs();

		$("#recopie").bind(\'click\', function(event) {
			event.preventDefault(); // cancel default behavior
			var a = false;
	       	a= confirm (\'Vous êtes sur le point de supprimer le contenu actuel de la newsletter. Voulez-vous continuer ?\');
	       	if (a) {
				//$(\'#nl_corps\').html($(\'#source\').html());
				CKEDITOR.instances[\'nl_corps\'].setData($(\'#source\').html());
				$("#formProfil").submit();
				//$( "#tabs" ).tabs({active: 0});
	       	}
		});

		$(".del").bind(\'click\', function(event) {
			var a = false;
	       	a= confirm (\'Vous êtes sur le point de supprimer ce bloc. Voulez-vous continuer ?\');
	       	if (a) {
				$(this).parent().remove();
	       	}
		});

		$(".edit").click (function(event) {			
			event.preventDefault(); // cancel default behavior
			var id = $(this).attr(\'id\');
			openModalPopup(\'gestion.php?ob=nl&act=editBloc&pop=X&id=\'+id,\'Edition du bloc\', 500, 600);
		});
})
</script>
'; ?>

	