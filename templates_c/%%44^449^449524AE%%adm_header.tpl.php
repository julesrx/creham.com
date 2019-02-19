<?php /* Smarty version 2.6.18, created on 2013-12-30 18:12:10
         compiled from commun/tpl/adm_header.tpl */ ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
<title>Administration</title>
<meta name="robots" content="noindex, nofollow"/>
<meta content="triptic" name="author"/>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.css" />
<link href="./css/adm_style.css" rel="stylesheet" type="text/css"  media="screen"/>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="./scripts/jquery.validate.min.js"></script>

<script type="text/javascript" src="./scripts/adm_fonction.js"></script>  
<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="./scripts/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript">
<?php echo '
$(function() {
	
	$(\'.formDisable\').bind(\'click\', function() {	  
		$(this).blur();
	});
	$(\'#rub_id\').change(function() {	  
		if ($(this).val() == 3) {$(\'#choixCateg\').show(); $(\'#choixDate\').hide();$(\'#choixIntro\').show();}
		else if ($(this).val() == 4) {$(\'#choixCateg\').hide(); $(\'#choixDate\').show();$(\'#choixIntro\').hide();}
		else {$(\'#choixCateg\').hide(); $(\'#choixDate\').hide();$(\'#choixIntro\').show();}
	});
	$( ".datepicker" ).datepicker( jQuery.datepicker.regional[ "fr" ] );
	// masque de saisie
	$(".tel").mask("99 99 99 99 99");
});
'; ?>

</script>
</head>

<body>
<div id="modal-popup"></div>
<div id="principal">
	<div id="header"><span>Interface d'administration du site <?php echo $this->_tpl_vars['CFG']->titre_site; ?>
</span></div>