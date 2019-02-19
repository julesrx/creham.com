<?php

// test des parametres
switch (@$act) {
	case 'new':
		editRessource();
		break;
	case 'del':
		delRessource();
		break;
	case 'save':
		saveRessource();
		break;
	case 'liste':
		listeRessource();
		break;
}

function delRessource()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Ressource(@$_GET['res_id']);
	$elt->remove();
	// redirection vers la bonne page
	if ($elt->elt_type == 'pg') {$ob = 'page'; $id = 'pg_id';}
	else {$ob = 'projet'; $id = 'proj_id';}
	header('location: gestion.php?ob='.$ob.'&'.$id.'='.$elt->elt_id);
}

function editRessource()
{
	global $tpl, $lTpl, $CFG;
	$tpl->assign('cRes', new Ressource(@$_GET['res_id']));
	$lTpl[] = "commun/tpl/adm_ressource.tpl";
}

function saveRessource()
{
	global $tpl, $lTpl, $CFG;
	$res = new Ressource();
	$_POST['res_contenu'] = upload('res_contenu', 'res_contenu_old', $CFG->path_upload, array('t3_' => array(800),'vign_' => array(50,50)));
	$res->save();
	if ($_POST['elt_type'] == 'pg') {$ob = 'page'; $id = 'pg_id';}
	else {$ob = 'projet'; $id = 'proj_id';}
	// redirection vers la bonne page
	header('location: gestion.php?ob='.$ob.'&'.$id.'='.$_POST['elt_id']);
	$lTpl[] = "commun/tpl/adm_ressource.tpl";
}



?>