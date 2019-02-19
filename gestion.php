<?php
// gestion du back
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1'); // PHP >= 4.3
ini_set('session.use_trans_sid', '0');
session_start();
ob_start();
require ('include/config.php');
$tpl = new tplManager();
require ('include/common.php');

// test des parametres
$ob = @$_REQUEST['ob'];
$act = @$_REQUEST['act'];
$pop = @$_REQUEST['pop'];

// récupération de l'utilisateur
$currentUser = objDepuisSession('usr');
if ($currentUser)
	objDansSession('usr', $currentUser);

if ($ob == 'logout') {
	session_destroy();	
}


$tpl->register_function("MakeLienHTML", "MakeLienHTML"); 
$tpl->register_function("PrintEditor", "PrintEditor");

$tpl->assign('currentUser', $currentUser);
$tpl->assign('CFG',$CFG);

$lTpl = array();
	
if (!empty($_REQUEST['site_id']) && $ob == 'home') 
	objDansSession('site_id', @$_REQUEST['site_id']);

	
$curSid = objDepuisSession('site_id');
$tpl->assign('curSid', $curSid);
	
if ($pop == 'X')
	header('Content-Type: text/html; charset: UTF-8');
elseif ($pop == '1')
	require ('modules/commun/adm_pop_header.php'); 
else
	require ('modules/commun/adm_header.php'); // sauf appel ajax
$tpl->assign('pop', $pop);
$tpl->assign('ob', $ob);

// redirection si fin de session
if (!empty($ob) && empty($currentUser) && $ob != "login") {
	header('location: '.$CFG->url);
}

// production du contenu central
switch ($ob) {
	case 'bloc':
		include('modules/commun/adm_bloc.php');
		break;
	case 'categ':
		include('modules/contenu/adm_categorie.php');
		break;	
	case 'profil':
		include('modules/securite/adm_profil.php');
		break;
	case 'home':
		include('modules/home/adm_home.php');
		break;
	case 'nl':
		include('modules/newsletter/adm_newsletter.php');
		break;
	case 'rubrique':
		include('modules/contenu/adm_contenu.php');
		break;
	case 'actu':
		include('modules/contenu/adm_actu.php');
		break;
		
	case 'page':
		include('modules/contenu/adm_page.php');
		break;	
	case 'site':
		include('modules/site/adm_site.php');
		break;		
	case 'logout':
		header('location: gestion.php');
		break;
	case 'login':	
	default :			
		if (@$currentUser->usr_id > 0)	include('modules/home/adm_home.php');
		else include('modules/login/adm_login.php');		
		break;
}

$tpl->assign('currentUser', $currentUser);
if ($pop != 'X')
	require ('modules/commun/adm_footer.php');// sauf appel ajax

//production de la page
foreach ($lTpl as $t) {
	$tpl->display($t);
}

ob_end_flush();
?>