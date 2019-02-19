<?php 


switch ($act)
{
	case 'view':
		viewNL();
		break;
	case 'suivi':
		saveSuivi();
		break;
	default:
		afficheInscription();
		break;
}

function viewNL()
{
	global $tpl, $lTpl, $currentUser, $site;
	
	$nl = new Newsletter($_GET['nl_id']);
	$tpl->assign(array('nl' => $nl));
	$lTpl[] = 'newsletter/tpl/mail.tpl';
}

function saveSuivi()
{	
	$suiv = new Suivi();
	// recherche de l'entrée de suivi pour le code $_GET['code']
	$suiv->getByCode($_GET['code']);	
	// s'il existe, enregistrer la date de visite
	if ($suiv->suiv_id > 0)
	{
		$suiv->updateVisite(time(), $suiv->suiv_id);
	}	
	// génére un pixel vide
	ob_end_clean();
	header ("Content-type: image/png");
	$image = imagecreate(1,1);
 
	$orange = imagecolorallocate($image, 255, 128, 0);
	imagecolortransparent($image, $orange); // On rend le fond orange transparent 
	imagepng($image);
}

function afficheInscription()
{
	global $tpl, $lTpl, $currentUser, $site;
	
	if (!empty($_POST['email'])){
		$u = new User();
		// on créé un membre anonyme
		$_POST['usr_id'] = null;
		$_POST['usr_login'] = $_POST['email'];
		$_POST['usr_pwd'] = md5(generePassword(8, false, TRUE)."CodeSecret_968");
		$_POST['grp_id'] = 3; // anonyme
		$_POST['usr_nom'] = "Anonyme"; 
		$_POST['usr_inscrit_nl'] = 1; // inscrit
		$_POST['site_id'] = $site->site_id;
		
		if ($usr_id = $u->save())
		{
			$tpl->assign('okMsg', "Votre inscription est enregistrée.");			
		} else {
			$tpl->assign('errMsg', "Une erreur est survenue : enregistrement impossible, votre courriel est déjà enregistré.");
		}		
	}
	if (!empty($_POST['desinscrit'])){
		$u = new User();
		$u->inscrit(0, $currentUser->usr_id);
		$tpl->assign('okMsg', "Votre déinscription est enregistrée.");
	}
	if (!empty($_POST['inscrit'])){
		$u = new User();
		$u->inscrit(1, $currentUser->usr_id);
		$tpl->assign('okMsg', "Votre inscription est enregistrée.");
	}
	
	// liste des NL
	$n = new Newsletter();
	$lN = $n->getList(array('t.site_id = ?' => $site->site_id, 'nl_statut = 1' => false), 'nl_d_crea DESC');
	
	$tpl->assign(array('cUsr' => new User(@$currentUser->usr_id), 'lNews' => @$lN));
	
	$lTpl[] = "newsletter/tpl/inscription.tpl";
}

?>