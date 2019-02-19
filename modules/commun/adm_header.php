<?php
// gestion de l'entete

$lTpl[] = "commun/tpl/adm_header.tpl";

// liste des sites
getListeSite();


if (is_object($currentUser)) {
	$lTpl[] = "commun/tpl/adm_menu.tpl";
}

?>
