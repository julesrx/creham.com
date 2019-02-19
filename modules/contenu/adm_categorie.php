<?php
checkAdmin();


// test des parametres
if (isset($_GET['act'])){$act = $_GET['act'];
} elseif  (isset($_POST['act'])){$act = $_POST['act'];
} else 	$act = '';

switch ($act) {

	case 'del':
		delCategorie();
		listeCategorie();
		break;
	case 'save':
		saveCategorie();		
	case 'liste':
	default:
		listeCategorie();
		break;
}


function listeCategorie() 
{
	global $tpl, $lTpl, $curSid;
	$elt = new Categorie();
	$lElt = $elt->getList(false, 'cat_ordre ASC');
	$tpl->assign(array('lElt' => $lElt, 'nb' => sizeof($lElt)));
	if (!empty($_GET['cat_id']))
	{
		$cCategorie = new Categorie($_GET['cat_id']);	
		$tpl->assign(array("cCategorie" => $cCategorie));
	}
	getListeRubrique ();
	getListeStatus ();
	getListeCategorie ();
	$lTpl[] = "contenu/tpl/adm_categorie_liste.tpl";
}

function saveCategorie()
{
	global $tpl, $lTpl, $CFG;

	$elt = new Categorie();
	$cat_id = $elt->save();
	//$_GET['cat_id'] = $cat_id;
	$tpl->assign('msg', "Opération enregistrée");
}



function delCategorie()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Categorie($_GET['cat_id']);
	
	if ($elt->remove())
	{
	// rien
	}
	
	$tpl->assign('msg', "Opération enregistrée");
}



?>