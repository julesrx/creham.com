<?php 
global $meta;

$c = new Categorie();
$lCat = $c->getList(false, 'cat_ordre ASC');
$tpl->assign(array('lCateg' => $lCat));


switch ($act)
{
	case 'supprimer':
		supprimerPubli();
		break;
	case 'modifier':
		modifierPubli();
		break;	
	case 'gere':
		gerePubli();
		break;	
	case 'comment':
		saveComment();
		break;	
	
	case 'choix':
		$lTpl[] = "contenu/tpl/choix.tpl";		
		break;	
	case 'publier':
		publier();
		break;	
	case 'search':
		search();
		break;
	case 'nuage':
		viewNuage();
		break;
	case 'byCateg':
		viewbyCateg();
		break;
	case 'rub':
		viewByRub();
		break;
	default:
		viewPage();	
		break;
}

function supprimerPubli()
{
	global $tpl, $lTpl, $site, $currentUser;
	$p = new Page($_GET['pg_id']);
	
	if ($p->usr_id != $currentUser->usr_id) {header('location: ./deconnexion'); exit;}
	
	$p->masquer($_GET['pg_id']);
	
	$tpl->assign('okMsg', "Votre publication est supprimée.");				
				
	gerePubli();	
}

function modifierPubli()
{
	global $tpl, $lTpl, $site, $currentUser;
	$p = new Page($_GET['pg_id']);
	$r = new Ressource();
	if ($p->usr_id != $currentUser->usr_id) {header('location: ./deconnexion'); exit;}
	
	$tpl->assign(array(
			'curPg' => $p,
			'curRub'=> new Rubrique($p->rub_id),
			'auteur' => strtoupper(substr($currentUser->usr_prenom, 0, 1).substr($currentUser->usr_nom, 0, 1)),
			'lRes' => $lR = $r->getList(array('elt_type = ?' => 'pg', 'elt_id = ?' => $_GET['pg_id']))
		));
				
	getListeCategorie ();
	$lTpl[] = "contenu/tpl/publication.tpl";	
}
function gerePubli()
{
	global $tpl, $lTpl, $site, $currentUser;
	
	// par auteur
	$p = new Page;
	$lPage = $p->getListPageCommentaire(
		array('pg_statut > 0' => false, 
			't.site_id = ?' => $site->site_id, 
			't.usr_id = ?' => $currentUser->usr_id),
		'rub_ordre ASC'
		);	
	$mot = "Mes publications";	
	$tpl->assign(
		array(
			'lPg' => $lPage, 
			'mot' => $mot,
			'from' => 'publi'
	));
	$lTpl[] = "contenu/tpl/result.tpl";
}

function saveComment()
{
	global $tpl, $lTpl, $site, $currentUser;
	if (!$currentUser) {
		header('location: ./logout');
	} else 
	{
		$pg_id = $_GET['pg_id'];
		$p = new Page($pg_id);
		$c = new Commentaire();
		$_POST['com_id'] = null;
		$_POST['pg_id'] = $pg_id;
		$_POST['usr_id'] = $currentUser->usr_id;
		$_POST['com_date'] = time();
		$_POST['com_statut'] = 2; // à valider
		
		if ($com_id = $c->save())
		{
			$tpl->assign('okMsg', "Votre commentaire est enregistré.<br/>Il sera validé par nos modérateurs dans les meilleurs délais.");
			$_POST = array();
		} else {
			$tpl->assign('errMsg', "Une erreur est survenue : enregistrement impossible");
		}
		// on redirige vers la bonne page
		if ($p->rub_id == 3)
		{		
			viewbyCateg();
		}
		else 
		{
			viewPage();
		}
	}
}


function publier()
{
	global $tpl, $lTpl, $CFG, $site, $currentUser;
	
	//print_r($_POST); exit;
	if (!$currentUser) {
		header('location: ./logout');
	} else 
	{
		getListeTag($site->site_id);
		//print_r($_GET);	
		if (!empty($_POST)) {
			$_POST['rub_id'] = $_GET['rub_id']; 
			$_POST['usr_id'] = $currentUser->usr_id;
			$_POST['site_id'] = $site->site_id;
			$_POST['pg_statut'] = 2; // à valider
			$_POST['pg_date_crea'] = time();
			$_POST['pg_date_affiche'] = $_POST['pg_date_crea'];
			
			// cas des évènements
			if ($_POST['rub_id'] == 4) {
				$_POST['pg_chapo'] = json_encode(array('pg_date' => $_POST['pg_date'], 'pg_lieu' => $_POST['pg_lieu'], 'pg_contact' => $_POST['pg_contact']));
			}
			
			$_POST['pg_photo'] = upload('pg_photo', 'pg_photo_old', $CFG->imgpath, array("p_" => array(160), 'vign_' => array(62, 42)));
			
			$p = new Page();
			if ($pg_id = @$p->save())
			{
				$tpl->assign('okMsg', "Votre publication est enregistrée.<br/>Elle sera validée par nos modérateurs dans les meilleurs délais.");

				// sauvegarde des ressources éventuelles
				$r = new Ressource();
				if(isset($_FILES['res_file1']['name']) && $_FILES['res_file1']['name'] != ""){				
					$res_file1 = uploadFile('res_file1', 'res_file1_old', $CFG->docpath, time());
					$lName = explode('.', $res_file1);
					$iName = array_reverse($lName);
					$extension = strtolower(array_shift($iName));
					$r->save('res_id', array('res_id' => $_POST['res_id1'], 'elt_id' => $pg_id, 'elt_type' => 'pg', 'res_ordre' => 1, 'res_titre' => $_FILES['res_file1']['name'], 'res_contenu' => $res_file1, 'res_mime' => $extension));
				}
				
				if(isset($_FILES['res_file2']['name']) && $_FILES['res_file2']['name'] != ""){
					$res_file2 = uploadFile('res_file2', 'res_file2_old', $CFG->docpath, time()+10);
					$lName = explode('.', $res_file2);
					$iName = array_reverse($lName);
					$extension = strtolower(array_shift($iName));
					$r->save('res_id', array('res_id' => $_POST['res_id2'], 'elt_id' => $pg_id, 'elt_type' => 'pg', 'res_ordre' => 2, 'res_titre' => $_FILES['res_file2']['name'], 'res_contenu' => $res_file2, 'res_mime' => $extension));
				}
				
				if (empty($_POST['pg_id'])) $_POST = array();
				
			} else {
				$tpl->assign('errMsg', "Une erreur est survenue : enregistrement impossible");
			}
		}
		if (!empty($_POST['pg_id'])) // cas de la modif
		{
			gerePubli();	
		}
		else 
		{
			$tpl->assign(array(
				'curRub'=> new Rubrique($_GET['rub_id']),
				'auteur' => strtoupper(substr($currentUser->usr_prenom, 0, 1).substr($currentUser->usr_nom, 0, 1))
			));
			getListeCategorie ();
			$lTpl[] = "contenu/tpl/publication.tpl";
		}
	}	
}


function search(){
	global $tpl, $lTpl, $site;
	//print_r($_GET);
	$p = new Page();
		
	if (isset($_GET['tag_id']) && is_numeric($_GET['tag_id']))
	{
		// recherche par tag
		$lPage = $p->getListPageCommentaire(
			array('pg_statut = ?' => 1, 
				't.site_id = ?' => $site->site_id, 
				'(pg_mot1 = '.$_GET['tag_id'].' OR pg_mot2 = '.$_GET['tag_id'].' OR pg_mot3 = '.$_GET['tag_id'].')' => false),
			'rub_ordre ASC'
			);
		$t = new Tag($_GET['tag_id']);
		$mot = $t->tag_lib;	
		
	} elseif (isset($_POST['mot']))
	{
		$mot = preg_replace('/;/', '', $_POST['mot']); // évite l'injection ?
		//echo $mot;
		// recherche dans les articles
		$lPage = $p->getListPageCommentaire(
			array('pg_statut = ?' => 1, 
				't.site_id = ?' => $site->site_id, 
				'(pg_titre LIKE "%'.$mot.'%" OR pg_chapo LIKE "%'.$mot.'%" OR pg_contenu LIKE "%'.$mot.'%")' => false),
			'rub_ordre ASC'
			);
		
		// recherche dans les professionnels
		$p = new User();
		$lP = $p->getList(
			array('usr_statut = 1' => false, 
				't.site_id = ?' => $site->site_id, 
				'(usr_nom LIKE "%'.$mot.'%")' => false),
			'usr_nom ASC'
			);
		$tpl->assign('lPro', $lP);
	}
	$tpl->assign(array('lPg' => $lPage, 'mot' => $mot));
	$lTpl[] = "contenu/tpl/result.tpl";
}


function viewNuage(){
	global $tpl, $lTpl, $site;
	$p = new Page();
	$lMot = $p->getNbOccurence();

	$t = new Tag();
	
	$tpl->assign(array(
		'lMot' => $lMot, 
		'lTag' => $l = $t->getList(array('site_id = ?' => $site->site_id)),
		'taille' => sizeof($lMot))
	);
	//print_r($l);
	$lTpl[] = "contenu/tpl/nuage.tpl";
}

function viewPage(){
	global $tpl, $lTpl, $site, $meta;

	$pg = new Page($_GET['pg_id']);
	
	// recupération des commentaires
	$com = new Commentaire();
	$lCom = $com->getList(array('t.com_statut = 1' => false, 't.pg_id = ?' => $pg->pg_id), 'com_date DESC');
	$tpl->assign('lCom', $lCom);
	$tpl->assign('taille', sizeof($lCom));
		
	$rub = new Rubrique($pg->rub_id);
	$lPg = $pg->getList(array('t.site_id = ?' => $site->site_id, 'pg_statut = ?' => 1, 'r.rub_id = ?' => $pg->rub_id), 'pg_ordre ASC');
	
	// les ressources rattachées
	$r = new Ressource();
	$lRes = $r->getList(array('elt_id = ?' => $_GET['pg_id'], 'elt_type = ?' => 'pg'));
	
	$meta = array('elt'=>$pg, 'type' => 'page');
	//print_r($meta);
	
	$tpl->assign(array(
		'curPg' => $pg, 
		'lPg' => $lPg, 
		'curRub' => $rub,
		'lRes' => @$lRes
	));
	$_SESSION['curRub_id'] = $rub->rub_id;
	
	$lTpl[] = "contenu/tpl/page.tpl";
}

function viewByRub(){
	global $tpl, $lTpl, $site, $meta;
	$rub = new Rubrique($_GET['rub_id']);
		
	$pg = new Page();
	$lPg = $pg->getListPageCommentaire(array('t.site_id = ?' => $site->site_id, 'pg_statut = ?' => 1, 'r.rub_id = ?' => $_GET['rub_id']), 'pg_date_affiche DESC');
			
	$meta = array('elt'=>$rub, 'type' => 'rubrique');
	
	$tpl->assign (array(
		'curRub' => $rub, 
		'lPg' => $lPg
	));
	
	
	$_SESSION['curRub_id'] = $rub->rub_id;
	
	$lTpl[] = "contenu/tpl/page_liste.tpl"; 
}

function viewbyCateg(){
	global $tpl, $lTpl, $site, $meta;
	$_GET['rub_id'] = 3;
	$rub = new Rubrique($_GET['rub_id']);
	$pg = new Page();
	if (!empty($_GET['pg_id'])) {
		$pg = new Page($_GET['pg_id']);
		$tpl->assign('curPg', $pg);

		// recupération des commentaires
		$com = new Commentaire();
		$lCom = $com->getList(array('t.com_statut = 1' => false, 't.pg_id = ?' => $pg->pg_id), 'com_date DESC');
		$tpl->assign('lCom', $lCom);		
		$tpl->assign('taille', sizeof($lCom));
		
		// les ressources rattachées
		$r = new Ressource();
		$lRes = $r->getList(array('elt_id = ?' => $_GET['pg_id'], 'elt_type = ?' => 'pg'));
			
		
		$cat_id = $pg->cat_id;
	} else $cat_id = $_GET['id'];
	
	
	if (!empty($cat_id)) $clause = array('t.cat_id = ?' => $cat_id);
	else $clause = array();
	
	$lPg = $pg->getListPageCommentaire($clause + array('pg_statut = ?' => 1, 't.site_id = ?' => $site->site_id, 'r.rub_id = ?' => $_GET['rub_id']), 'cat_ordre ASC, pg_ordre ASC');
			
	$meta = array('elt'=> $curCateg = new Categorie($cat_id), 'type' => 'categ');
	
	$tpl->assign (array(
		'curRub' => $rub, 
		'lPg' => $lPg, 
		'curCateg' => $curCateg,
		'lRes' => @$lRes
	));
	
	$_SESSION['curRub_id'] = $rub->rub_id;
	
	$lTpl[] = "contenu/tpl/page_bycateg.tpl";
	
}

?>