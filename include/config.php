<?php
// Chargement des paramètres selon l'environnement
//echo getcwd();
//print_r($_SERVER);


$CFG = new stdClass();
if (@$_REQUEST['debug'] == 1) $CFG->debug = true;
else $CFG->debug = false;

$CFG->version = '1.3';
//$CFG->debug = true;

if (preg_match('/localhost/i', $_SERVER['SERVER_NAME']) || preg_match('/192/i', $_SERVER['SERVER_NAME']))  // DEV
{	
	$_SERVER['SERVER_NAME'] = "localhost";
	$installDir = "c:/TRIPTIC/PROJETS/CREHAM/HTML/";
	// paramètre Mysql
	$CFG->host = 'localhost'; 
	$CFG->uname = 'root';
	$CFG->pwd = '';
	$CFG->db = 'creham-db';
	$CFG->type = 'mysql';		
	$CFG->email_admin = "contact@triptic.biz";
	$CFG->url = "http://192.168.1.19/";
	error_reporting(E_ALL);
}
elseif (preg_match('/creham/i', $_SERVER['SERVER_NAME']) || preg_match('/cluster/i', $_SERVER['SERVER_NAME']))  // PROD
{
	if ($CFG->debug) echo getcwd();
	$installDir = "/homez.807/creham/www/";
	$CFG->host = 'mysql51-108.perso'; 
	$CFG->uname = 'crehambdd';
	$CFG->pwd = 'jrVtQzxEzY2x';
	$CFG->db = 'crehambdd';
	$CFG->type = 'mysql';
	$CFG->email_admin = "contact@creham.com";		//contact@creham.com	
	error_reporting(E_ALL);
	//error_reporting(0);
}

$CFG->email_from_name = "CREHAM";
$CFG->email_from = "contact@creham.com";
$CFG->google_code = '';
$CFG->titre_site = "CREHAM";

setlocale (LC_TIME, 'fr_FR','fra');
date_default_timezone_set('Europe/Paris');


$CFG->path_upload = $installDir."upload/";
$CFG->imgpath = $installDir."upload/images/";
$CFG->imgurl = "./upload/images/";
$CFG->docpath = $installDir."upload/documents/";
$CFG->docurl = "./upload/documents/";

require_once 'include/libs/class.phpmailer.php';
require_once 'include/libs/ThumbLib.inc.php';
include 'include/adodb5/adodb.inc.php';
$cryptinstall = "./crypt/cryptographp.fct.php";
include $cryptinstall;

include 'modules/commun/class/tplManager.class.php';
include 'modules/commun/class/Db.class.php';
include 'modules/commun/class/ObjectModel.class.php';
include 'modules/commun/class/GoogleMapADODB.php';
include 'modules/commun/class/Log.class.php';
include 'modules/commun/class/Ressource.class.php';
include 'modules/site/class/Site.class.php';
include 'modules/securite/class/User.class.php';
include 'modules/securite/class/Groupe.class.php';
include 'modules/contenu/class/Rubrique.class.php';
include 'modules/contenu/class/Categorie.class.php';
include 'modules/contenu/class/Page.class.php';
include 'modules/contenu/class/Commentaire.class.php';
include 'modules/contenu/class/Actualite.class.php';
include 'modules/newsletter/class/Newsletter.class.php';
include 'modules/newsletter/class/Suivi.class.php';

//Paramétrage global adodb
$ADODB_FETCH_MODE  = 2; 
Db::get()->SetFetchMode(ADODB_FETCH_ASSOC); 
Db::get()->debug = $CFG->debug;
 
?>