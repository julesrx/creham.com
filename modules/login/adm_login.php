<?php
// gestion du login administrateur

switch ($act) {
	case 'check':
		checkLogin();
		break;
	default:
		login();
		break;
}



// affichage du login
function login() {
	global $tpl, $lTpl;
	$lTpl[] = "login/tpl/adm_login.tpl";
}

// vérification
function checkLogin() {
	global $tpl, $lTpl;
	$usr = new User();
	$usr_pwd = md5($_POST['usr_pwd']."CodeSecret_968");
//	echo $usr_pwd;exit;
	$usr->verifieUser($_POST['usr_email'], $usr_pwd);
	
	if ($usr->usr_id == '' || $usr->grp_id != 1) { // erreur d'identification ou mauvais groupe
		$tpl->assign('errMsg', 'Erreur d\'identification');
		$lTpl[] = "login/tpl/adm_login.tpl";
	} else {
		objDansSession('usr', $usr);		
		// sélection du site
		$elt = new Site();
		$clause = false; // tout
		$lElt = $elt->getList($clause,'site_id ASC');
		if (sizeof($lElt) == 1)
		{
			$cSite = current($lElt);
			header('location: gestion.php?ob=home&site_id='.$cSite->site_id); // on redirige vers le seul site
			exit;
		}
		else
		{
			header('location: gestion.php?ob=home');
			exit;
		}
	}	
}
?>