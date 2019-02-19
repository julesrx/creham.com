<?php

switch($act) {
	case 'delPhoto':
		delPhoto();
		break;	
	case 'del':
		delSite();
		listSite();
		afficheSite();
		break;
	case 'save':
		saveSite();
		listSite();
		afficheSite();
		break;
	default:
		listSite();
		afficheSite();
		break;
	
}

function delPhoto()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Site($_GET['site_id']);
	$elt->deletePhoto($_GET['site_id']);
	listeSite();
}


// suppression d'un Site
function delSite() {
	global $lTpl, $tpl, $CFG;
	$elt_id = $_GET['site_id'];

	
	if (0) {
		$nb=sizeof($lRub);
		if ($nb == 1)
			$tpl->assign('errMsg', 'Suppression impossible : '.$nb.' rubrique est rattach&eacute;e à ce thème.');
		else
			$tpl->assign('errMsg', 'Suppression impossible : '.$nb.' rubriques sont rattach&eacute;es à ce thème.');
	} else {
		$elt = new Site();
		$elt->remove($elt_id);
		$tpl->assign('msg', 'Suppression effectu&eacute;e.');
	}
}

// sauvegarde du théme
function saveSite() {
	global $lTpl, $tpl, $CFG;
	
	$_POST['site_photo'] = uploadFile('site_photo', 'site_photo_old', $CFG->imgpath);	
	//print_r($_POST);
	$elt = new Site();
	$elt_id = $elt->save();

	$_GET['site_id'] = $elt_id;
	$tpl->assign('msg', OP_SAVE);
}

// liste des thémes
function listSite() {
	global $lTpl, $tpl, $CFG, $curSid;
	$elt = new Site();
	$lElt = $elt->getList(false,'site_id ASC');

	$tpl->assign('lElt', $lElt);
	$tpl->assign('nb', sizeof($lElt));
}

// affichage du Site
function afficheSite() {
	global $lTpl, $tpl, $CFG, $currentUser;
	
	$site_id = @$_GET['site_id'];
	// cas de la selection d'un Site
	if ($site_id != '') {
		// affichage
		$elt = new Site($site_id);
	} else 
		$elt = new Site();
//	print_r($elt);
	$tpl->assign('selElt', $elt);
	
	// gestion du statut du site
	$tpl->assign('site_statut_options', array(1=> 'En production', 2 => 'En maintenance transactionnelle', 3 => 'En maintenance totale'));
	
	

	$lTpl[] = 'site/tpl/adm_site.tpl';	
}
?>
