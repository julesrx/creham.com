<?php
// Profils Administration
// 24/10/2007 : cr�ation
// 04/12/2007 : 1.1

checkAdmin();

// test des parametres
if (isset($_GET['act'])){$act = $_GET['act'];
} elseif  (isset($_POST['act'])){$act = $_POST['act'];
} else 	$act = '';

switch ($act) {
	case 'export':
		exportUser();
		break;
	case 'delUser':
		delUser();
		break;
	case 'saveUser':
		saveUser();
		break;
	case 'viewUser':		
		afficheUser();
		break;
	case 'aValider':
	case 'liste':
		if (isset($_GET['type'])) $_SESSION['type'] = $_GET['type'];
		listAllUser();
		break;
}

function exportUser()
{
	global $tpl, $lTpl, $curSid;
	if (empty($_POST))
		$lTpl[] = 'securite/tpl/adm_export.tpl';
	else {
		$status_options = array(3 => 'non activé', 2 => 'activé', 1 => 'vérifié', 0 => 'bloqué');
	
		
		// export CSV
		ob_end_clean();
		header("Content-type: application/vnd.ms-excel");
    	header("Content-Disposition: attachment; filename=export.csv");
    	$lChp = array('usr_login', 'bas_lib', 'usr_nom', 'usr_prenom', 'usr_profession', 'usr_adresse', 'usr_cp', 'usr_ville', 'usr_tel', 'usr_statut', 'usr_cgu', 'usr_carto', 'usr_inscrit_nl',
					'usr_specialite', 'usr_logiciel', 'usr_rs', 'usr_rpps', 'usr_is_securise', 'usr_region', 'usr_dept', 'usr_filler1', 'usr_filler2', 'usr_filler3', 'usr_filler4');
    	
    	echo '"'.implode('";"', $lChp).'"'."\n";
    	
    	$u = new User();
    	$lU = $u->getList(array('t.site_id = ?' => $curSid, 'grp_id >= 2' => false), 'usr_nom ASC'); // seulement les rédacteurs et anonymes
    	if (!empty($lU))
    	{
    		foreach ($lU as $cU)
    		{
    			foreach ($lChp as $chp)
    			{
    				echo '"'.utf8_decode(nettoieNl(($chp == 'usr_statut' ? $status_options[$cU->$chp] : $cU->$chp))).'"'.';';
    			}
    			echo "\n";
    		}
    	}
    	exit;   	
	}
}

function delUser()
{
	global $tpl, $lTpl, $CFG;
	$usr_id = $_GET['usr_id'];
	// suppression des commentaires
	$c = new Commentaire();
	$c->masqueByUser($usr_id);
		
	$elt = new User();
	$elt->masque($usr_id);	
	listAllUser();
}


function saveUser() {
	global $lTpl, $tpl, $CFG, $curSid;
//	print_r($_POST);exit;
	$usr = new User($_POST['usr_id']);
	
	if (!empty($_POST['usr_id'])) 
	{
		// modification
		if (!empty($_POST['usr_pwd']) && $_POST['usr_pwd'] != $usr->usr_pwd) 
		{ 
			// changement du mot de passe
			$_POST['usr_pwd'] = md5($_POST['usr_pwd']."CodeSecret_968");
		} 
	} 
	else $_POST['usr_pwd'] = md5($_POST['usr_pwd']."CodeSecret_968");
	if (empty($_POST['grp_id'])) $_POST['grp_id'] = 2;
	if (empty($_POST['usr_statut'])) $_POST['usr_statut'] = 1;
	if (empty($_POST['site_id'])) $_POST['site_id'] = $curSid;
	
	$usr_id = $usr->save();
	
	
	$_REQUEST['usr_id'] = $usr_id;
	$tpl->assign('msg', 'Opération enregistrée');
	listAllUser();
}


// liste de tous les profils
function listAllUser() {
	global $lTpl, $tpl, $CFG, $curSid;
	$usr_id = @$_REQUEST['usr_id'];
	if ($usr_id != '')
	{		
		$l = new Log();
		$p = new Page();
		$c = new Commentaire();
				
		$tpl->assign(array(
			'cUsr' => new User($usr_id), 
			'lLog' => $lL = $l->getList(array('t.log_elt_id = ?' => $usr_id, 't.log_elt = ?' => 'user'), 'log_date DESC'),
			'lPg' => $lP = $p->getList(array('t.usr_id = ?' => $usr_id), 'pg_date_crea DESC'),
			'lCom' => $lC = $c->getList(array('t.usr_id = ?' => $usr_id), 'com_date DESC')
		));
		
	}
	$usr = new User();
	if ($_SESSION['type'] == "admin") $clause = array('grp_id = 1' => false);
	elseif ($_SESSION['type'] == "redacAValider") $clause = array('usr_statut > 1' => false);
	else $clause = array('grp_id = 2' => false, 't.site_id = ?' => $curSid);
	$lUsr = $usr->getList($clause, 'usr_nom ASC, usr_prenom ASC');	  	
	$tpl->assign('lElt', $lUsr);	
	

	// construction des listes
	getListeStatusUser();
	getListeGroupe();
	getListeOuiNon();
	$lTpl[] = 'securite/tpl/adm_alluser.tpl';
}




function determineListe() {
	global $tpl;
//	getUserStatus();
//	getListeTypeUser();
//	getListeGroupe();
//	getListeGenre();
//	getListeRegion();
//	getListeInteret();
}
?>
