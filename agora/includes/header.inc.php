<!DOCTYPE html>
<html lang="<?php echo $trad["HEADER_HTTP"]; ?>">
<head>
	<!--  AGORA-PROJECT is under the GNU General Public License (http://www.gnu.org/licenses/gpl.html)  -->
	<title><?php echo $_SESSION["agora"]["nom"]; ?></title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta name="application-name" content="Agora-Project">
	<meta name="application-url" content="http://www.agora-project.net">
	<meta http-equiv="content-language" content="<?php echo $trad["HEADER_HTTP"]; ?>" />
	<meta name="Description" content="<?php echo $_SESSION["agora"]["description"]." - ".@$_SESSION["espace"]["description"]; ?>">
	<link rel="icon" type="image/gif" href="<?php echo PATH_TPL; ?>divers/icone.gif" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<!-- SI ON EST EN MODE DECONNECTÉ, DECOMMENTER LES 2 LIGNES SUIVANTES
	<script src="<?php echo PATH_COMMUN; ?>jquery/jquery.min.js"></script>
	<script src="<?php echo PATH_COMMUN; ?>jquery/jquery-ui.min.js"></script>
	-->
	<script src="<?php echo PATH_COMMUN; ?>jquery/floating.js"></script>
	<script src="<?php echo PATH_COMMUN; ?>jquery/placeholder.js"></script>
	<script src="<?php echo PATH_COMMUN; ?>javascript_2.16.4.js"></script><!-- toujours après Jquery!! -->
	<?php
	////	STYLE CSS  &&  EDITION DES ELEMENTS DANS UN POPUP OU IFRAME ?  &&  PLUGIN JQUERY "PLACEHOLDER" POUR LES ANCIENS NAVIGATEURS ?
	include_once PATH_TPL."style.css.php";
	echo "<script type='text/javascript'>  edition_popup='".@$_SESSION["agora"]["edition_popup"]."';  </script>";
	if(defined("PLACEHOLDER"))	echo "<script type='text/javascript'>  $(document).ready(function(){ $('input,textarea').placeholder(); });  </script>";
	?>
</head>


<body>
	<?php
	////	IMAGE BACKGROUND ("str_replace" POUR LA PAGE DE CONNEXION..)
	if(IS_MAIN_PAGE==true)	echo "<div class='img_background'><img src=\"".str_replace("../",ROOT_PATH,$_SESSION["agora"]["path_fond_ecran"])."\" class='noprint'/></div>";
	?>

	<div id="infobulle" class="infobulle noprint">&nbsp;</div>
	<div id="div_loading" class="img_loading"><img src="<?php echo PATH_TPL."divers/".LOADING_IMG; ?>" /></div>

	<div id="page_fantome" class="page_fantome">
		<button onClick="page_fantome_close();" id="page_fantome_fermer" class="button page_fantome_fermer"><?php echo $trad["fermer"]; ?> <img src="<?php echo PATH_TPL; ?>divers/supprimer.png" /></button>
		<div class="page_fantome_table">
			<div id="page_fantome_contenu"></div>
			<iframe id="page_fantome_iframe" name="page_fantome_iframe" allowtransparency="true" frameborder="0">NO IFRAME</iframe>
		</div>
	</div>