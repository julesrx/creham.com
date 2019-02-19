<?php
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1'); // PHP >= 4.3
ini_set('session.use_trans_sid', '0');

session_start();
ob_start();

include_once 'include/config.php';

$ob = @$_REQUEST['ob'];
$act = @$_REQUEST['act'];

$tpl = new tplManager();
$tpl->assign('CFG', $CFG);
$tpl->register_function("getMeta", "getMeta");
$tpl->register_function("MakeLienHTML", "MakeLienHTML");
$tpl->register_function("autoSearch", "autoSearch");
$tpl->register_function("PrintEditor", "PrintEditor");

include 'include/common.php';

// identification du site à afficher
$site_code =  $_SERVER['REQUEST_URI']; // reçoit /dmp81/...
$site = new Site();
$site->getByCode($site_code);
$tpl->assign('site', $site);
global $site;

if ($ob == 'logout') {
	session_destroy();	
	header('location: '.$site->site_url);
}
// récupération de l'utilisateur
$currentUser = objDepuisSession('user');
if ($currentUser)
	objDansSession('user', $currentUser);

$tpl->assign('currentUser', $currentUser);

$lTpl = array();

if (@$_REQUEST['pop'] == 'X')
	header('Content-Type: text/html; charset: UTF-8');
else
	include('modules/commun/header.php');


switch ($ob) {
	case 'e':
		include('modules/commun/espace.php');
		break;	
	case 'c':
		include('modules/commun/contact.php');
		break;	
	case 'n':
		include('modules/newsletter/newsletter.php');
		break;		
	case 'carto':
	case 'u':
		include('modules/securite/user.php');
		break;
	case 'p':
		include('modules/contenu/page.php');
		break;
	default:
		include('modules/home/home.php');
		break;
}

if (@$_REQUEST['pop'] != 'X' && @$_REQUEST['pop'] != 'G')
	$lTpl[] = 'commun/tpl/footer.tpl';

//production de la page
foreach ($lTpl as $t) {
	$tpl->display($t);
}
ob_end_flush();
?>