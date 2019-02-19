<?php 

// Espace Equipe

switch($act)
{
	case 'welcome':
		$tpl->assign('welcome', true);
	case 'confirmation':
		$lTpl[] = "securite/tpl/actions.tpl";
		break;	
	case 'confirm':
		confirm();
		break;	
	case 'carto':
		cartographie();
		break;	
	case 'google':
		cartographie(true);
		break;	
	case 'lost':
		lostPwd();
		break;
	case 'view':
		viewUser();
		break;
	case 'new':
		newUser();
		break;
	case 'login':
		afficheLogin();
		break;
	default:
		
		break;
}

function confirm() 
{
	global $tpl, $lTpl, $currentUser, $CFG, $site;
	$usr_id = decrypt($_GET['code']);
	$u = new User($usr_id);
	if ($u->usr_id > 0)
	{
		objDansSession('user', $u);
		header('location: ./confirmation');
	} else {
		$tpl->assign('err', "Votre code d'activation a expiré, merci de renouveler votre inscription");
		$lTpl[] = "securite/tpl/notify_user.tpl";	
	}	
}

function cartographie($isGoogle = false)
{
	global $tpl, $lTpl, $currentUser, $CFG, $site, $profession_options, $spec_options;
	
	getListeProfession(); // pour récupérer $profession_options
	getListeSpecialite();

	// liste des bassins
	$b = new Bassin();
	$lBas = $b->getList(array('t.site_id = ?' => $site->site_id), 'bas_ordre ASC');
	
	// liste des étab
	$elt = new Etablissement();
	$lEtab = $elt->getList(array('b.site_id = ?' => $site->site_id), 'bas_ordre ASC, etab_lib ASC');

	// liste des professionnels
	$u = new User();
	$lUser = $u->getList(array('usr_carto = 1' => false, 'usr_statut = 1'=> false, 't.grp_id = 2' => false, 'b.site_id = ?' => $site->site_id, 't.bas_id != ?' => 'autre'), 'bas_ordre ASC, usr_nom ASC');
		
	if ($isGoogle)
	{
		$clause = array();
		if (!empty($_GET['bas_id'])) $clause = array('t.bas_id = ?' => $_GET['bas_id']);
		
		$lUserCarto = $u->getList($clause + array('usr_carto = 1' => false, 'usr_statut = 1'=> false, 't.grp_id = 2' => false, 'b.site_id = ?' => $site->site_id, 't.bas_id != ?' => 'autre'), 'bas_ordre ASC, usr_nom ASC');
		$lEtabCarto = $elt->getList($clause + array('b.site_id = ?' => $site->site_id), 'bas_ordre ASC, etab_lib ASC');
		
		
		$tpl->assign(array('cUsr_id' => @$_GET['usr_id'], 'cBas_id' => @$_GET['bas_id'] ));
		
		//on crée notre carte
		$map = new GoogleMapAPI('map','tutoriel_map');
		$map->_minify_js = true;
		
		//taille de la map
		$map->setHeight("460");
		$map->setWidth("420");
		//on desactive la barre de coté?
		$map->disableSidebar();
		//DesActive les  boutons(map/satellite/hybrid).
		$map->disableTypeControls();
		//Quel est le type de carte par defaut ? (map/satellite/hybrid)
		$map->setMapType('map'); // default
		//On déssactive les boutons pour afficher la direction d'un point a l'autre
		$map->disableDirections();
		// Permet de definir le zoom automatiquement afin de voir tous les marqueurs d'un coup.
		$map->enableZoomEncompass();
		$map->enableOnLoad(false);
	
		
		//CREATION DES MARQUEURS
		$lElt = array();
		$nb = 0;
		// etablissement
		if (!empty($lEtabCarto)) {
			foreach ($lEtabCarto as $cEtab) {
				$adr = null;
				// adresse
				$adr = $cEtab->etab_adresse_geoloc;			
				//echo $adr;
				// libellé
				$lib = $cEtab->etab_lib;
				$contenu = ($cEtab->etab_logo ? '<img src="./upload/images/l_'.$cEtab->etab_logo.'" width="50" class=""/>':'').
					'<div class="titre">'.$cEtab->etab_lib.'</div>'.
					'<div class="desc">'.$cEtab->etab_contenu.'</div>'.
					'<a href="'.$cEtab->etab_url.'" target="blank">'.$cEtab->etab_url.'</a>';
				
				if ($adr) {				
					//$marker_id = $map->addMarkerByAddress($adr, $lib, $contenu, '', $CFG->url.'images/info.png');
					$marker_id = $map->addMarkerByAddress($adr, $lib, $contenu, '', $CFG->url.'images/info.png');
					//$marker_id = $map->addMarkerByAddress($adr, $lib, $contenu);
					$map->addMarkerOpener($marker_id, 'etab_open_'.$cEtab->etab_id);
				}
				$nb++;				
			}
		}
		// professionnels
		if (!empty($lUserCarto)) {
			foreach ($lUserCarto as $cUser) {
				$adr = null;
				// adresse
				if ($cUser->usr_adresse != '')
					$adr = $cUser->usr_adresse.', '.$cUser->usr_cp.', '.$cUser->usr_ville;					
				//echo $adr;
				// libellé
				$lib = ucfirst($cUser->usr_prenom).' '.strtoupper($cUser->usr_nom);
				$contenu = '<div class="stitre">Nom : '.strtoupper($cUser->usr_nom).'</div>'.
					'<div class="stitre">Prénom : '.ucfirst($cUser->usr_prenom).'</div>'.
					//'<div class="stitre">Profession : '.ucfirst($profession_options[$cUser->usr_profession]).'</div>'.
					'<div class="stitre">Spécialité : '.ucfirst($spec_options[$cUser->usr_specialite]).'</div>'.
					'<div class="stitre">Adresse : '.$cUser->usr_adresse.' '.$cUser->usr_cp.' '.$cUser->usr_ville.'</div>'.
					'<div class="stitre">Téléphone : '.$cUser->usr_tel.'</div>';
				
				
				if ($adr) {				
					$marker_id = $map->addMarkerByAddress($adr, $lib, $contenu, '', $site->site_url.'images/info-pro.png');
					//$marker_id = $map->addMarkerByAddress($adr, $lib, $contenu);
					$map->addMarkerOpener($marker_id, 'pro_open_'.$cUser->usr_id);
				}
				$nb++;				
			}
		}
		
	
		if ($nb) $tpl->assign('map', $map);			
	}
	
	
	$tpl->assign(array(
		'isGoogle' => $isGoogle,
		'lBas' => $lBas,
		'lEtab' => $lEtab,
		'lUser' => $lUser
	));
	
	$lTpl[] = "securite/tpl/cartographie.tpl";
}


function lostPwd() 
{
	global $tpl, $lTpl, $currentUser, $CFG, $site;
	if (!empty($_POST['email']))
	{
		$u = new User();		
		$u->getByLogin($_POST['email']);
		
		if ($u->usr_id > 0) // existe
		{
			$newPwd = generePassword(8, false, TRUE);
			$u->saveNewPwd(md5($newPwd."CodeSecret_968"), $u->usr_id);
			$body = "Bonjour,<br/>Nous avons le plaisir de vous adresser votre nouveau mot de passe pour accéder au site DMP dans le ".$site->site_lib."  :<br/><br/><center><strong>$newPwd</strong></center><br/>";						
			$body .= getSignature();
			
			$isSent = envoie_mail($CFG->email_from, utf8_decode($CFG->email_from_name), 'Votre nouveau mot de passe', $body, $_POST['email']);
			
			$l = new Log();
			if ($isSent) {
				$tpl->assign('okMsg', "Un nouveau mot de passe a été envoyé à l'adresse : ".$_POST['email']);
				$l->save(null, time(), 'Nouveau mot de passe envoyé à '.$_POST['email'], 'user', $u->usr_id, '', $body);		
			}
			else {
				$tpl->assign('errMsg', "Une erreur est survenue lors de l'envoi vers : ".$_POST['email']);
				$l->save(null, time(), 'Envoi impossible vers '.$_POST['email'], 'user', $u->usr_id, '', $isSent);
			}

			
			
		} else $tpl->assign('errMsg', "Une erreur est survenue.");
		
		
	}
	$lTpl[] = "securite/tpl/perdu.tpl";
}
function viewUser() 
{
	global $tpl, $lTpl, $currentUser;
	
	
	if (!empty($_POST)){ // sauvegarde
		$u = new User();
		
		if (!empty($_POST['usr_pwd'])) $_POST['usr_pwd'] = md5($_POST['usr_pwd']."CodeSecret_968");
		else $_POST['usr_pwd'] = $_POST['usr_pwd_old'];
		
		$u->save();		
		objDansSession('user', new User($currentUser->usr_id));
		header('location: ./mon-compte?ok=1'); exit;		
	} else {
		getListeProfession();
		getListeSpecialite();
		getListeBassin();
		
		$u = new User($currentUser->usr_id);
		$tpl->assign('cUsr', $u);
		$lTpl[] = "securite/tpl/new_user.tpl";	
	}
}	
	
	
function afficheLogin()
{
	global $tpl, $lTpl;
	$errMsg = '';
	
	if (!empty($_POST)) // connexion
	{		
		$u = new User();
		$u->verifieUser($_POST['login'], md5($_POST['pwd']."CodeSecret_968"));
		if ($u->usr_id > 0)
		{
			objDansSession('user', $u);
			if (!empty($_SESSION['fromPage'])) { header('location: '.$_SESSION['fromPage'].'#reagir'); exit;} // on retourne à la page					
			elseif (!empty($_SESSION['curRub_id'])) {header('location: ./publier-'.$_SESSION['curRub_id']); exit;} // on publie directement dans la bonne rubrique
			else 	{ header('location: ./bienvenue'); exit;} // message de bienvenue 
		}
		else {			
			header('location: ./erreur-connexion');
		}		
	} else {
		// on met en session la provenance
		if (@$_REQUEST['pop'] && !preg_match('/perdu/', $_SERVER['HTTP_REFERER'] )) $_SESSION['fromPage'] = $_SERVER['HTTP_REFERER'];
		$lTpl[] = "securite/tpl/login.tpl";
	}
		
}

function newUser()
{
	global $tpl, $lTpl, $currentUser, $CFG, $site;
	$errMsg = '';
	//print_r($_POST);
	//print_r($currentUser);
	
	getListeProfession();
	getListeSpecialite();
	getListeBassin();
	
	
	if (!empty($_POST))
	{
		$u = new User();
		
		// recherche login existant
		$liste = $u->getList(array('usr_login = ?'=> $_POST['usr_login']));
		if (!empty($liste))	
			$errMsg = "Un compte existe déjà avec ce courriel.";
			
		if (empty($errMsg)) {
			if (!empty($_POST['usr_pwd'])) $_POST['usr_pwd'] = md5($_POST['usr_pwd']."CodeSecret_968");
			else $_POST['usr_pwd'] = $_POST['usr_pwd_old'];
			if (@$currentUser->usr_id > 0) $_POST['usr_id'] = $currentUser->usr_id;
			
			if (empty($_POST['usr_carto'])) $_POST['usr_carto'] = 0;
			if (empty($_POST['usr_inscrit_nl'])) $_POST['usr_inscrit_nl'] = 0;
			
			$_POST['grp_id'] = 2; // rédacteur
			$_POST['site_id'] = $site->site_id;
			
			$usr_id = @$u->save();
			
			if (empty($usr_id)) // erreur à l'enregistrement
			{
				$nu = new stdClass();
				foreach ($_POST as $k=>$v)
					{						
						$nu->$k = $v;
					}
				$tpl->assign(array('errMsg' => 'Une erreur est survenue lors de l\'enregistrement de votre profil.' , 'cUsr' => $nu));
				$lTpl[] = "securite/tpl/new_user.tpl";				
			} else {				
				// notification vers le membre
				if (empty($_POST['usr_id'])) {					
					// envoi du nouveau mot de passe			
					$body = "<p>Bonjour,</p>
					<p>Vous venez de vous inscrire sur le site du DMP dans le ".$site->site_lib." et nous vous en remercions.</p>
					<p>Pour confirmer votre inscription, merci de cliquer sur ce lien :<br/><br/>
					<strong><a href='".$site->site_url."confirm-".encrypt($usr_id)."'>".$site->site_url."confirm-".encrypt($usr_id)."</a></strong></p>";
					$body .= getSignature();
					envoie_mail($CFG->email_from, utf8_decode($CFG->email_from_name), 'Valider votre inscription sur le site DMP dans le '.$site->site_lib, $body, $_POST['usr_login']);					
				}
							
				if (@$currentUser->usr_id > 0)
				{				
					viewUser();	
				}				
				else {						
					$lTpl[] = "securite/tpl/notif_user.tpl";
				}
			}
			
		} else 
		{
			$u = new stdClass();
				
			foreach ($_POST as $k=>$v)
			{
				$u->$k = $v;
			}
			$tpl->assign(array('errMsg' => $errMsg, 'cUsr' => $u));
			$lTpl[] = "securite/tpl/new_user.tpl";
		}
	} else 
	{
		// on met en session la provenance
		$_SESSION['fromPage'] = $_SERVER['HTTP_REFERER'];
		$lTpl[] = "securite/tpl/new_user.tpl";
	}
}

function getSignature()
{
	global $CFG, $site;
	return "<p>Cordialement,<br/>
					<strong>L'équipe projet DMP<br/><br/>
					GCS Télésanté Midi-Pyrénées</strong><br/>
					10 Chemin du raisin, 31200 Toulouse<br/>
					Tel: 05.67.20.74.04<br/>
					E-mail : dmp@telesante-midipyrenees.fr<br/>
					Web : https://www.telesante-midipyrenees.fr<br/>					
					<img src='".$site->site_url."images/logo-telesante-mipy.png' alt='TéléSanté MidyPyrénées'/>
					</p>";	
}
?>