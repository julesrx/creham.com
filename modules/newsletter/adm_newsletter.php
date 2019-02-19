<?php

$tpl->assign(array('site' => new Site($curSid)));


switch ($act)
{
	case 'metEnForme':
		miseEnForme();
		break;
	case 'listeArticle':		
	case 'editBloc':
		editBloc();
		break;
	case 'suiviNL':
		suiviNL();		
		break;
	case 'viewNL':
		viewNL();		
		break;
	case 'sendTestNL':
		sendNL(true);
		listeNL();
		break;		
	case 'sendNL':
		sendNL();
		listeNL();
		break;
	case 'delNL':
		delNL();
		listeNL();
		break;
	case 'saveNL':
		saveNL();
		listeNL();
		break;		
	case 'listeNL':
	default:
		listeNL();
		break;
}

function miseEnForme()
{
	global $tpl, $lTpl;
	
	//print_r($_POST);
	$p = new Page();
	if (!empty($_POST['pg_id']))
	{
		if (is_array($_POST['pg_id'])) // Cas des rubriques classiques
		{
			$lPg = $p->getListPageCommentaire(array('t.pg_id IN ('.implode(',', $_POST['pg_id']).')' => false));
			$tpl->assign(array('type' => 'rub', 'lPg' => $lPg));				
		}
		else // A La une 
		{
			$tpl->assign(array('type' => 'une', 'cPg' => new Page($_POST['pg_id'])));
		}
		
	}
	
	echo $tpl->fetch("newsletter/tpl/adm_gabarit.tpl");
	
}
function editBloc()
{
	global $tpl, $lTpl, $curSid;
	
	if (@$_POST['rub_id']) {
		$p = new Page();
		$lP = $p->getList(array('t.site_id = ?' => $curSid, 't.rub_id = ?' => $_POST['rub_id'], 'pg_statut = 1' => false), 'rub_ordre ASC, pg_date_crea DESC');
		$tpl->assign(array('lP' => $lP));
		echo $tpl->fetch('newsletter/tpl/adm_choix_article.tpl');
		
	} else {
		getListeRubrique();	
		$lTpl[] = "newsletter/tpl/adm_edit_bloc.tpl";	
	}
	
	
	
	
}

function suiviNL()
{
	global $tpl, $lTpl;
	$suiv = new Suivi();
	//recherche des envois
	$lSuiv = $suiv->getList(array('nl_id = ?' => $_GET['nl_id']));
	//print_r($lSuiv);
	$tpl->assign(array('cNl' => new Newsletter($_GET['nl_id']), 'lSuiv' => $lSuiv));
	echo $tpl->fetch("newsletter/tpl/adm_nl_suivi.tpl");
}


function sendNL($isTest = false)
{
	global $tpl, $lTpl, $CFG, $curSid, $currentUser;
	$nl_id = $_GET['nl_id'];
	$nl = new Newsletter($nl_id);
	$i = 0;
	
	// test PJ
	$pj_file = $pj_name = false;
	
	if ($nl->nl_pj != '') // A FAIRE : mettre en place pour prod	
	{
		if (file_exists($CFG->path_upload.$nl->nl_pj))
		{
			$pj_file = $CFG->path_upload.$nl->nl_pj;
			$pj_name = $nl->nl_pj;
		}
	}
	
	if ($isTest) // test seulement
	{
		$tpl->assign(array('nl' => $nl, 'code' => $code = sha1(time().$currentUser->usr_login.$nl->nl_id)));
		
		$body = $tpl->fetch('newsletter/tpl/mail.tpl');
		
		// destinataire
		$lDest = explode(';', $nl->nl_test_mail);
		
		if (sizeof($lDest) > 0)
		{
			if (envoie_mail($CFG->email_admin, utf8_decode($CFG->titre_site), $nl->nl_sujet, $body, $lDest, false, $pj_file, $pj_name))
			{
				$i = sizeof($lDest);
			}
		}	
	}
	else 
	{
		// liste des inscrits
		$insc = new User();
		$suiv = new Suivi();
		$lInsc = $insc->getList(array('t.site_id = ?' => $curSid, 'usr_statut > 0 ' => false, 'usr_inscrit_nl = 1' => false)); 
		$i = 0;
		if (count($lInsc) > 0)
		{
			$mail = new ProcessMail();	
			foreach ($lInsc as $cInsc)
			{
				
				$code = sha1(time().$cInsc->usr_login.$nl->nl_id);
				$tpl->assign(array('cInsc' => $cInsc, 'nl' => $nl, 'code' => $code));
				$body = $tpl->fetch('newsletter/tpl/mail.tpl');
				
				$mail->save('id', array('id' => null, 
										'usr_id' => $cInsc->usr_id,
										'nl_id' => $nl->nl_id,
										'dest_mail' => $cInsc->usr_login, 
										'sujet' => $nl->nl_sujet, 
										'corps' => $body, 
										'pj_file' => $pj_file, 
										'pj_name' => $pj_name, 
										'code' => $code,
										'src_mail' => $CFG->email_from, 
										'src_nom' => $CFG->titre_site, 
										'date_envoi' => time(), 
										'erreur' => null));
				$i++;
			}
		}
	}
	$tpl->assign('msg', "Envoi à $i destinataires");
}

function viewNL()
{
	global $tpl, $lTpl, $CFG;
	$nl_id = $_GET['nl_id'];
	$nl = new Newsletter($nl_id);
	
	$tpl->assign(array('nl' => $nl));
	echo $tpl->fetch('newsletter/tpl/mail.tpl');
}

function saveNL()
{
	global $tpl, $lTpl, $CFG, $curSid;
	$elt = new Newsletter();
	$_POST['site_id'] = $curSid;
	if (empty($_POST['nl_d_crea'])) $_POST['nl_d_crea'] = time();
	$_POST['nl_pj'] = uploadFile('nl_pj', 'nl_pj_old', $CFG->path_upload); 
	$_GET['nl_id'] = $elt->save();
	$tpl->assign('msg', 'opération enregistrée');
}

function delNL()
{
	global $tpl, $lTpl;
	$elt = new Newsletter($_GET['nl_id']);	
	$elt->remove();
	$tpl->assign('msg', 'opération enregistrée');
}

function listeNL()
{
	global $tpl, $lTpl, $curSid;
	
	getListeStatus();
	
	$elt = new Newsletter();
	$lElt = $elt->getList(array('site_id = ?' => $curSid), 'nl_d_crea DESC');
	$tpl->assign(array('lElt'=> $lElt, 'nb' => sizeof($lElt)));
	
	// cas d'une sélection
	if (!empty($_GET['nl_id']))
	{
		$rec = new Newsletter($_GET['nl_id']);
		$tpl->assign('curElt', $rec);		
	}
	
	$lTpl[]  = 'newsletter/tpl/adm_nl_liste.tpl';
}


?>