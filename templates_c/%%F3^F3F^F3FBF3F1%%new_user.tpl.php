<?php /* Smarty version 2.6.18, created on 2013-10-24 18:03:48
         compiled from securite/tpl/new_user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'securite/tpl/new_user.tpl', 18, false),)), $this); ?>


<div id="compte">
	<h1 class="titre" id="titre"><span class="pucej">&nbsp;</span> <?php if ($this->_tpl_vars['currentUser']->usr_id > 0): ?>Mon compte<?php else: ?>S'inscrire<?php endif; ?></h1>
	
	<?php if ($this->_tpl_vars['errMsg']): ?><div class="errMsg"><?php echo $this->_tpl_vars['errMsg']; ?>
</div><br/><br/><?php endif; ?>
	<?php if ($_GET['ok']): ?>
			<div class="okMsg">Vos modifications ont bien été enregistrées.</div>
		<?php endif; ?>
	<form action="<?php if ($this->_tpl_vars['currentUser']->usr_id > 0): ?>./mon-compte<?php else: ?>./inscription<?php endif; ?>" method="post" id="userForm">
		<label>Nom*</label><input type="text" class="inbox required" name="usr_nom" value="<?php echo $this->_tpl_vars['cUsr']->usr_nom; ?>
" />
		<div class="nofloat">&nbsp;</div>
		<label>Prénom*</label><input type="text" class="inbox required" name="usr_prenom" value="<?php echo $this->_tpl_vars['cUsr']->usr_prenom; ?>
" />
		<div class="nofloat">&nbsp;</div>
		<div class="petit">Vos publications seront signées par vos initiales</div>
		<div class="nofloat">&nbsp;</div>
		<label>Profession*</label><select name="usr_profession" id="usr_profession" class="inbox required">			
			 <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['profession_options'],'selected' => $this->_tpl_vars['cUsr']->usr_profession+0), $this);?>

			</select>
		<div class="nofloat">&nbsp;</div>
		<label>Courriel*<br/><div style="font-size: 0.7em; font-weight: normal">Informations confidentielles</div></label><input type="text" class="inbox required email" name="usr_login" id="usr_login"  value="<?php echo $this->_tpl_vars['cUsr']->usr_login; ?>
" />
		<div class="nofloat">&nbsp;</div>
		
		<?php if ($this->_tpl_vars['currentUser']->usr_id == 0): ?>
			<label>Confirmation du courriel*</label><input type="text" class="inbox required email" name="usr_login_conf" id="usr_login_conf"  value="" />
			<div class="nofloat">&nbsp;</div>
		<?php endif; ?>
		<label>Mot de passe*</label><input type="password" class="inbox <?php if ($this->_tpl_vars['currentUser']->usr_id == 0): ?>required<?php endif; ?>" name="usr_pwd" />
		<input type="hidden" class="" name="usr_pwd_old"  value="<?php echo $this->_tpl_vars['cUsr']->usr_pwd; ?>
" />
		<div class="nofloat">&nbsp;</div>
		
		<input type="checkbox" name="usr_inscrit_nl" value="1" class="checkbox" <?php if ($this->_tpl_vars['cUsr']->usr_inscrit_nl || ! $this->_tpl_vars['currentUser']->usr_id): ?>checked<?php endif; ?>/><span class="color">Je souhaite recevoir la newsletter</span>
		<div class="nofloat">&nbsp;</div>
		<input type="checkbox" name="usr_cgu" value="1" class="checkbox required" <?php if ($this->_tpl_vars['cUsr']->usr_cgu || ! $this->_tpl_vars['currentUser']->usr_id): ?>checked<?php endif; ?>/><span>En m'inscrivant, j'accepte les conditions d'usage de ce site collaboratif</span>
		<div class="nofloat">&nbsp;</div>
		<input type="checkbox" name="usr_carto" id="usr_carto" value="1" <?php if ($this->_tpl_vars['cUsr']->usr_carto): ?>checked<?php endif; ?> class="checkbox" /><span>J'accepte d'être répertorié sur la liste des professionnels de santé utilisant le DMP publiée sur ce site (rubrique cartographie)</span>
		<div class="nofloat">&nbsp;</div>
				
		<label>Spécialité</label><select name="usr_specialite" class="inbox">				
			 <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['specialite_options'],'selected' => $this->_tpl_vars['cUsr']->usr_specialite+0), $this);?>

		</select>
		<div class="nofloat">&nbsp;</div>
		<label class="big">Logiciel métier utilisé</label><input type="text" class="inbox small" name="usr_logiciel"  value="<?php echo $this->_tpl_vars['cUsr']->usr_logiciel; ?>
" />
		<div class="nofloat">&nbsp;</div>
		<label>Bassin*</label><select name="bas_id" id="bas_id" class="inbox ">
			<option value="">A choisir dans la liste</option>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['bassin_options'],'selected' => $this->_tpl_vars['cUsr']->bas_id+0), $this);?>

			<option value="autre">Autre</option>
		</select>
		<div class="nofloat">&nbsp;</div>
		<label>Adresse*</label><input type="text" class="inbox " name="usr_adresse" id="usr_adresse"  value="<?php echo $this->_tpl_vars['cUsr']->usr_adresse; ?>
" />
		<div class="nofloat">&nbsp;</div>
		<label>Code postal*</label><input type="text" class="inbox " name="usr_cp" id="usr_cp"  value="<?php echo $this->_tpl_vars['cUsr']->usr_cp; ?>
" />
		<div class="nofloat">&nbsp;</div>
		<label>Ville*</label><input type="text" class="inbox " name="usr_ville" id="usr_ville"  value="<?php echo $this->_tpl_vars['cUsr']->usr_ville; ?>
" />
		<div class="nofloat">&nbsp;</div>
		<label>Téléphone</label><input type="text" class="inbox tel" name="usr_tel" value="<?php echo $this->_tpl_vars['cUsr']->usr_tel; ?>
"  />
		<div class="nofloat">&nbsp;</div>
		<div class="petit">Ces informations, ainsi que votre nom, pourront être consultées dans la rubrique cartographie. Cette carte permet aux professionnels de santé et aux patients de repérer facilement les utilisateurs du DMP autour d'eux.</div>
		<div class="nofloat">&nbsp;</div>
	
		<div class="petit">*Informations à saisir obligatoirement</div>
		<div class="nofloat">&nbsp;</div>
		
		<label class="big">&nbsp;</label><input type="submit" class="submit" value="<?php if ($this->_tpl_vars['currentUser']->usr_id > 0): ?>Enregistrer<?php else: ?>Valider mon inscription<?php endif; ?>"/>
		<div class="nofloat">&nbsp;</div><div class="nofloat">&nbsp;</div>
	</form>
		
</div>

<div class="noleft"></div>


<?php echo '
<script>
	$().ready(function() {
		$(\'#usr_carto\').bind(\'change\', function() {						
			if ($(\'#usr_carto:checked\').val() == 1) 
			{
				$(\'#bas_id\').addClass(\'required\');
				$(\'#usr_adresse\').addClass(\'required\');
				$(\'#usr_cp\').addClass(\'required\');
				$(\'#usr_ville\').addClass(\'required\');
			} else 
			{
				$(\'#bas_id\').removeClass(\'required\', \'error\');
				$(\'#usr_adresse\').removeClass(\'required\', \'error\');
				$(\'#usr_cp\').removeClass(\'required\', \'error\');
				$(\'#usr_ville\').removeClass(\'required\', \'error\');
			}				
  		});
		$("#userForm").validate({
			  rules: {
				  \'usr_profession\': {
				      required: true,
				      min: 1
				    },
			    \'usr_login_conf\': {
				        equalTo: "#usr_login"
				      }
				  }
		  });		
	});
</script>
'; ?>
    