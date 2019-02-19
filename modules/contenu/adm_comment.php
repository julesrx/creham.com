<?php
checkAdmin();

// test des parametres
if (isset($_GET['act'])){$act = $_GET['act'];
} elseif  (isset($_POST['act'])){$act = $_POST['act'];
} else 	$act = '';

switch ($act) {
	case 'del':
		delCommentaire();
		listeCommentaire();
		break;
	case 'aValider':
		$_SESSION['type'] = 'aValider';
		listeCommentaire();
		break;
	case 'save':
		saveCommentaire();		
		listeCommentaire();
		break;
	case 'liste':
	default:
		$_SESSION['type'] = 'tous';
		listeCommentaire();
		break;
}

function listeCommentaire() 
{
	global $tpl, $lTpl, $curSid;
	$elt = new Commentaire();
	$clause = array('p.site_id = ?' => $curSid);
	if ($_SESSION['type'] == 'aValider') $clause += array('com_statut = 2' => false);
	$lElt = $elt->getList($clause, 'rub_ordre ASC, pg_date_crea DESC, com_date DESC');
	$tpl->assign(array('lElt' => $lElt, 'nb' => sizeof($lElt)));
	if (!empty($_GET['com_id']))
	{
		$cCommentaire = new Commentaire($_GET['com_id']);	
		$tpl->assign(array("cCommentaire" => $cCommentaire));
	}
	getListeRubrique ();
	getListeStatusContrib ();
	getListeCategorie ();
	$lTpl[] = "contenu/tpl/adm_commentaire_liste.tpl";
}

function saveCommentaire()
{
	global $tpl, $lTpl, $CFG;

	$elt = new Commentaire();
	$com_id = $elt->save();
	$_GET['com_id'] = $com_id;
	$tpl->assign('msg', "Opération enregistrée");
}



function delCommentaire()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Commentaire($_GET['com_id']);
	
	if ($elt->remove())
	{
	// rien
	}
	
	$tpl->assign('msg', "Opération enregistrée");
}



?>