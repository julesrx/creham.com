<?php /* Smarty version 2.6.18, created on 2013-10-11 14:56:42
         compiled from contenu/tpl/publication.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'contenu/tpl/publication.tpl', 27, false),array('function', 'PrintEditor', 'contenu/tpl/publication.tpl', 41, false),)), $this); ?>
<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./ckfinder/ckfinder.js"></script>
<div id="pub">
	<h1 class="titre" id="titre">
		<?php if ($this->_tpl_vars['curPg']->pg_id > 0): ?>
			Modifier : <?php echo $this->_tpl_vars['curPg']->pg_titre; ?>

		<?php else: ?>
			Partager <?php if ($this->_tpl_vars['curRub']->rub_id == 4): ?>un évènement<?php elseif ($this->_tpl_vars['curRub']->rub_id == 3): ?>un conseil<?php elseif ($this->_tpl_vars['curRub']->rub_id == 5): ?>une expérience<?php else: ?>un usage<?php endif; ?>
		<?php endif; ?>
	</h1>
	<?php if ($this->_tpl_vars['errMsg']): ?><div class="errMsg"><?php echo $this->_tpl_vars['errMsg']; ?>
</div>
	<?php elseif ($this->_tpl_vars['okMsg']): ?><div class="okMsg"><?php echo $this->_tpl_vars['okMsg']; ?>
</div>
	<?php endif; ?>
	
	<form action="./publier-<?php echo $this->_tpl_vars['curRub']->rub_id; ?>
" method="post" id="formPub" enctype="multipart/form-data">
		<input type="hidden" name='rub_id' id='rub_id' value="<?php echo $this->_tpl_vars['curRub']->rub_id; ?>
"/>
		<?php if ($this->_tpl_vars['curPg']->pg_id > 0): ?><input type="hidden" name='pg_id' id='pg_id' value="<?php echo $this->_tpl_vars['curPg']->pg_id; ?>
"/><?php endif; ?>
		<?php if (! $this->_tpl_vars['curPg']->pg_id): ?>
			<p class="intro">Vous souhaitez <?php if ($this->_tpl_vars['curRub']->rub_id == 4): ?>communiquer un évènement<?php else: ?>partager votre expérience<?php endif; ?> ? Il vous suffit de remplir le formulaire ci-dessous. Il sera signé de vos initiales et sera publié après vérification par notre équipe éditoriale.</p>
		<?php endif; ?>
		<label>Titre de <?php if ($this->_tpl_vars['curRub']->rub_id == 4): ?>l'évènement<?php else: ?>l'article<?php endif; ?> : </label><input type="text" class="inbox required" value="<?php echo $this->_tpl_vars['curPg']->pg_titre; ?>
" name="pg_titre" id="pg_titre"/>
		<div class="nofloat"></div>
		<div class="nofloat"></div>
	<?php if ($this->_tpl_vars['curRub']->rub_id == 3): ?>
		<label>Catégorie : </label><select name='cat_id' id='cat_id' class="inbox required">
							<option>>> Choisir</option>
							<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categorie_options'],'selected' => $this->_tpl_vars['curPg']->cat_id), $this);?>

							</select>
		<div class="nofloat"></div>
	<?php endif; ?>	
				
	<?php if ($this->_tpl_vars['curRub']->rub_id == 4): ?>
		<label>Date : </label><input type="text" class="inbox required datepicker" value="<?php echo $this->_tpl_vars['curPg']->pg_date; ?>
" name="pg_date" id="pg_date"/>
		<div class="nofloat"></div>
		<label>Lieu : </label><input type="text" class="inbox required" value="<?php echo $this->_tpl_vars['curPg']->pg_lieu; ?>
" name="pg_lieu" id="pg_lieu"/>
		<div class="nofloat"></div>
		<label>Contact / Inscription : </label><input type="text" class="inbox required" value="<?php echo $this->_tpl_vars['curPg']->pg_contact; ?>
" name="pg_contact" id="pg_contact"/>		
		<div class="nofloat"></div>
		<label>Présentation : </label>
		<div class="nofloat"></div>				
		<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['curPg']->pg_contenu,'name' => 'pg_contenu','width' => '555','height' => '300'), $this);?>

		<div class="nofloat"></div>
	<?php else: ?>				
		<label>Introduction : </label>
		<div class="nofloat"></div>				
		<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['curPg']->pg_chapo,'name' => 'pg_chapo','width' => '555','height' => '200'), $this);?>

		<div class="nofloat"></div>
		
		<label>Contenu : </label>
		<div class="nofloat"></div>				
		<?php echo PrintEditor(array('innerHtml' => $this->_tpl_vars['curPg']->pg_contenu,'name' => 'pg_contenu','width' => '555','height' => '300'), $this);?>

		<div class="nofloat"></div>				
	<?php endif; ?>		
				
		
		<label>Mot-clé 1 : </label><select name='pg_mot1' id='pg_mot1' class="inbox">
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['tag_options'],'selected' => $this->_tpl_vars['curPg']->pg_mot1+0), $this);?>

										</select>
					<div class="nofloat"></div>
					<label>Mot-clé 2 : </label><select name='pg_mot2' id='pg_mot2' class="inbox">
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['tag_options'],'selected' => $this->_tpl_vars['curPg']->pg_mot2+0), $this);?>

										</select>
					<div class="nofloat"></div>
					<label>Mot-clé 3 : </label><select name='pg_mot3' id='pg_mot3' class="inbox">
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['tag_options'],'selected' => $this->_tpl_vars['curPg']->pg_mot3+0), $this);?>

										</select>
					<div class="nofloat"></div>
		<label>Illustration :<br/><small>(Formats gif, jpg, png)</small></label><input type="file" name="pg_photo" class="photo" id="photo" title="Format autorisé gif, jpg, png"/>
		<input type="hidden" name="pg_photo_old" value="<?php echo $this->_tpl_vars['curPg']->pg_photo; ?>
"/>
		<?php if ($this->_tpl_vars['curPg']->pg_photo): ?>
			<a href="<?php echo $this->_tpl_vars['CFG']->imgurl; ?>
p_<?php echo $this->_tpl_vars['curPg']->pg_photo; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['CFG']->imgurl; ?>
vign_<?php echo $this->_tpl_vars['curPg']->pg_photo; ?>
" /></a>
		<?php endif; ?>		
		<div class="nofloat">&nbsp;</div>
		
		<label>Document joint N°1 :<br/><small>(Formats .doc, .xls, .pdf)</small></label><input type="file" name="res_file1" class="res" id="res"/>
		<?php $_from = $this->_tpl_vars['lRes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cRes']):
?>
			<?php if ($this->_tpl_vars['cRes']->res_ordre == 1 && $this->_tpl_vars['cRes']->res_contenu): ?>
				<input type="hidden" name="res_id1" value="<?php echo $this->_tpl_vars['cRes']->res_id; ?>
"/>
				<input type="hidden" name="res_file1_old" value="<?php echo $this->_tpl_vars['cRes']->res_contenu; ?>
"/>
				<a href="<?php echo $this->_tpl_vars['CFG']->docurl; ?>
<?php echo $this->_tpl_vars['cRes']->res_contenu; ?>
" target="_blank"><img src="./ckfinder/skins/kama/images/icons/32/<?php echo $this->_tpl_vars['cRes']->res_mime; ?>
.gif"/> <?php echo $this->_tpl_vars['cRes']->res_titre; ?>
</a>	
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
				
		<div class="nofloat">&nbsp;</div>
		
		<label>Document joint N°2 :<br/><small>(Formats .doc, .xls, .pdf)</small></label><input type="file" name="res_file2" class="res" id="res"/>
		<?php $_from = $this->_tpl_vars['lRes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cRes']):
?>
			<?php if ($this->_tpl_vars['cRes']->res_ordre == 2 && $this->_tpl_vars['cRes']->res_contenu): ?>
				<input type="hidden" name="res_id2" value="<?php echo $this->_tpl_vars['cRes']->res_id; ?>
"/>
				<input type="hidden" name="res_file2_old" value="<?php echo $this->_tpl_vars['cRes']->res_contenu; ?>
"/>
				<a href="<?php echo $this->_tpl_vars['CFG']->docurl; ?>
<?php echo $this->_tpl_vars['cRes']->res_contenu; ?>
" target="_blank"><img src="./ckfinder/skins/kama/images/icons/32/<?php echo $this->_tpl_vars['cRes']->res_mime; ?>
.gif"/> <?php echo $this->_tpl_vars['cRes']->res_titre; ?>
</a>	
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>		
		<div class="nofloat">&nbsp;</div>
		
		<div class="btnAction">
			<a href="<?php echo $_SESSION['fromPage']; ?>
" title="retour">Annuler</a>
			<input type="submit" value="Enregistrer" class="submit"/>
			<div class="nofloat">&nbsp;</div>
		</div>
		<div class="nofloat">&nbsp;</div>
	</form>
	
</div>
<?php echo '

<script type="text/javascript" src="./scripts/additional-methods.min.js"></script>

<script>
$().ready(function() {
		// validate the comment form when it is submitted
		$("#formPub").validate({
			rules: {
				photo: {		        	
		        	extension: "gif|jpg|jpeg|png"
		      	},
		      	res: {		        	
		        	extension: "gif|jpg|jpeg|png|doc|docx|xls|xlsx|pdf|avi"
		      	}
		    }});
})
</script>
'; ?>

	