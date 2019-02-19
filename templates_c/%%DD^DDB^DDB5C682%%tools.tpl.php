<?php /* Smarty version 2.6.18, created on 2013-10-02 17:35:32
         compiled from contenu/tpl/tools.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'contenu/tpl/tools.tpl', 16, false),array('function', 'PrintEditor', 'contenu/tpl/tools.tpl', 33, false),)), $this); ?>
<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./ckfinder/ckfinder.js"></script>

<?php if ($this->_tpl_vars['errMsg']): ?><div class="errMsg"><?php echo $this->_tpl_vars['errMsg']; ?>
</div>
<?php elseif ($this->_tpl_vars['okMsg']): ?><div class="okMsg"><?php echo $this->_tpl_vars['okMsg']; ?>
</div>
<?php endif; ?>

<div class="tools">
	<a name="comments"></a>
	<a href="javascript:void(0)" class="btcomment <?php if ($this->_tpl_vars['taille'] > 0): ?>voirComment<?php endif; ?>"><span class="puceFleche">&nbsp;</span> <?php echo $this->_tpl_vars['taille']; ?>
 commentaire<?php if ($this->_tpl_vars['taille'] > 1): ?>s<?php endif; ?></a>
	<div id="comments" style="display: none">
		<?php $_from = $this->_tpl_vars['lCom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cCom']):
?>
		<div class="item">
			<div class="lib ptSans">
				<span class="pseudo"><?php echo $this->_tpl_vars['cCom']->usr_initiales; ?>
</span>
				<span class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['cCom']->com_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d %B %Y") : smarty_modifier_date_format($_tmp, "%d %B %Y")); ?>
</span>
			</div>
			<div class="tComment ptSans">
				<?php echo $this->_tpl_vars['cCom']->com_content; ?>

			</div>
		</div>
		<?php endforeach; endif; unset($_from); ?>
		
	</div>
	<a href="javascript:void(0)" <?php if ($this->_tpl_vars['currentUser']->usr_id > 0): ?>class="reagir"<?php else: ?>onclick="openModalPopup('./connexion', '', 280, 380)"<?php endif; ?> ><span class="puceFleche">&nbsp;</span> réagir</a>
<?php if ($this->_tpl_vars['currentUser']->usr_id > 0): ?>	
	<a name="reagir"></a>
	<div id="pub">		
		<form action="./reagir-<?php echo $this->_tpl_vars['curPg']->pg_id; ?>
" method="post" id="reaction" style="display: none;">
			<br/>
			<p>Nous vous invitons à laisser un commentaire sur cet article en remplissant ce formulaire. Il sera signé de vos initiales et sera publié après vérification par notre équipe éditoriale.</p>
			<br/>
			<?php echo PrintEditor(array('innerHtml' => $_POST['com_content'],'name' => 'com_content','width' => '555','height' => '300'), $this);?>

			<div class="nofloat"></div>	
			<div class="btnAction">
				<a href="javascript:void(0)" onclick="$('#reaction').toggle();" title="retour">Annuler</a>
				<input type="submit" value="Enregistrer" class="submit"/>
				<div class="nofloat">&nbsp;</div>
			</div>
		<div class="nofloat">&nbsp;</div>
		</form>
	</div>
<?php endif; ?>
	
</div>

<?php echo '
<script>
	$().ready(function() {
		//affichage direct des commentaires
		var URI = location.href; // local url without hash
		var regComment = new RegExp("#comments", "g");
		if (URI.match(regComment)) {
			$(\'#comments\').show();
		}
		var regReagir = new RegExp("#reagir", "g");
		if (URI.match(regReagir)) {
			$(\'#reaction\').show();
		}
	})
</script>
'; ?>
