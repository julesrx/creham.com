<?php
////	CONSTANTES !
////

////	DIVERS
define("URL_AGORA_PROJECT","http://www.agora-project.net");
define("BG_DEFAULT","default@@"); //Pour distinguer les fonds d'écran par défaut
define("LARGEUR_MENU_GAUCHE",300);

////	PAR DEFAUT
if(!defined("ROOT_PATH"))			define("ROOT_PATH","../");
if(!defined("IS_MAIN_PAGE"))		define("IS_MAIN_PAGE",false);
if(!defined("CONTROLE_SESSION"))	define("CONTROLE_SESSION",true);

////	CHEMIN DES PRINCIPAUX DOSSIERS
if(is_file(ROOT_PATH."host.inc.php"))	{ require_once(ROOT_PATH."host.inc.php");  host_constants(); }
else									{ define("PATH_STOCK_FICHIERS",ROOT_PATH."stock_fichiers/"); }
define("PATH_TPL", ROOT_PATH."templates/");
define("PATH_LANG", ROOT_PATH."traduction/");
define("PATH_INC", ROOT_PATH."includes/");
define("PATH_DIVERS", ROOT_PATH."divers/");
define("PATH_COMMUN", ROOT_PATH."commun/");
define("PATH_TMP", PATH_STOCK_FICHIERS."tmp/");
define("PATH_MOD_FICHIER", PATH_STOCK_FICHIERS."gestionnaire_fichiers/");
define("PATH_MOD_FICHIER2", PATH_STOCK_FICHIERS."gestionnaire_fichiers_vignettes/");
define("PATH_PHOTOS_USER", PATH_STOCK_FICHIERS."photos_utilisateurs/");
define("PATH_PHOTOS_CONTACT", PATH_STOCK_FICHIERS."photos_contact/");
define("PATH_WALLPAPER_USER", PATH_STOCK_FICHIERS."fond_ecran/");
define("PATH_WALLPAPER", PATH_TPL."fond_ecran/");
define("PATH_OBJECT_FILE", PATH_STOCK_FICHIERS."fichiers_objet/");

////	CONSTANTES DE CONFIG.  &  MAINTENANCE DE L'AGORA ?  &  INSTRUCTION D'INTERDICTION DU CACHE
require_once PATH_STOCK_FICHIERS."config.inc.php";
if(agora_maintenance==true)	 { @header("location:".PATH_DIVERS."maintenance.html");  exit; }
session_cache_limiter("nocache");

////	INIT LE TEMPS D'EXECUTION
$mtime = explode(" ",microtime());
$starttime = $mtime[1] + $mtime[0];


////	OUVERTURE SESSION
////
@ini_set("session.gc_probability",1);			// Initialise le garbage collector (rares bugs php)
@ini_set("session.gc_divisor",1000);			// Idem
@ini_set("session.gc_maxlifetime",3600);		// Augmente la durée de session à 1 heure
$nom_session = defined("HOST_DOMAINE") ? HOST_DOMAINE : db_name;
session_name("agora_project_".$nom_session);	// connexion sur plusieurs domaines du même serveur avec le même browser
session_start();


////	RECUPERATION DES FONCTIONS
////
require_once ROOT_PATH."fonctions/db.inc.php";			// Fonctions & Connexion à la bdd
require_once ROOT_PATH."fonctions/divers.inc.php";		// Fonctions diverses
require_once ROOT_PATH."fonctions/text.inc.php";		// Fonctions de traitement des chaines de caractère
require_once ROOT_PATH."fonctions/utilisateur.inc.php";	// Fonctions sur les utilisateurs
require_once ROOT_PATH."fonctions/menu.inc.php";		// Fonctions d'affichage des menus
require_once ROOT_PATH."fonctions/objet.inc.php";		// Fonctions sur les objets (éléments ou conteneurs)
require_once ROOT_PATH."fonctions/fichier.inc.php";		// Fonctions sur la gestion des fichiers & dossiers


////	SI C'EST UN SCRIPT "EXPRESS" (ex:livecounter_verif.php) => ON SAUTE CETTE ETAPE !
////
if(!defined("GLOBAL_EXPRESS"))
{
	////	DECONNEXION DE L'AGORA  (détruit variables session & cookie connexion auto & redirige en page d'accueil si besoin. Toujours avant les redir()!)
	////
	if(!empty($_GET["deconnexion"]))
	{
		add_logs("deconnexion");
		$_SESSION = array();
		session_destroy();
		setcookie("AGORAP_LOG", "", time()-3600);
		setcookie("AGORAP_PASS", "", time()-3600);
	}
	// DECONNEXION & AFFICHAGE DE PAGE DE CONNEXION
	if(CONTROLE_SESSION==true)
	{
		// FIN DE SESSION (au bout de 4 heures / 14400sec.)
		if(@$_SESSION["user"]["id_utilisateur"]>0 && @$_SESSION["user"]["derniere_connexion"]>0 && (time()-@$_SESSION["user"]["derniere_connexion"])>14400)   redir(ROOT_PATH."index.php?deconnexion=1&msg_alerte=temps_session");
		// REINITIALISATION DU PASSWORD OU VALIDATION D'INVIT
		if(!empty($_GET["id_newpassword"]) || !empty($_GET["id_invitation"]))   redir(ROOT_PATH."index.php?deconnexion=1&".$_SERVER["QUERY_STRING"]);
		// PAS D'ESPACE SELECTIONNE
		if(empty($_SESSION["espace"]))   redir(ROOT_PATH."index.php?deconnexion=1");
	}


	////	INFOS SUR LE SITE  &  MISE A JOUR DE L'AGORA?  &  INFOS STATS?  &  FUSEAU HORAIRE
	////
	if(empty($_SESSION["agora"]))	$_SESSION["agora"] = db_ligne("SELECT * FROM gt_agora_info");
	require_once PATH_INC."mise_a_jour.inc.php";
	if(is_file(ROOT_PATH."host.inc.php"))	info_domaine_stats();
	if(version_compare(PHP_VERSION,'5.1.0','>='))	date_default_timezone_set(current_timezone());


	////	ACCES INVITE  /  IDENTIFICATION UTILISATEUR
	////
	$connexion_via_form		= (!empty($_POST["login"]) && !empty($_POST["password"]))	?  true  :  false;
	$connexion_via_cookie	= (!empty($_COOKIE["AGORAP_LOG"]) && !empty($_COOKIE["AGORAP_PASS"]) && @$_SESSION["user"]["id_utilisateur"]<1 && empty($_GET["deconnexion"]))  ?  true  :  false;//COOKIES DE CONNEXION + USER PAS IDENTIFIE
	if(empty($_SESSION["user"]) || $connexion_via_form==true || $connexion_via_cookie==true)
	{
		////	PAR DEFAUT : COMPTE INVITE 
		$_SESSION["user"] = array("id_utilisateur"=> 0,"admin_general"=> 0);

		////	CONNEXION DE L'UTILISATEUR
		if($connexion_via_form==true || $connexion_via_cookie==true)
		{
			// CONNEXION DEMANDÉ OU AUTO ?
			if($connexion_via_form==true)			{ $login=$_POST["login"];			$password_crypte=sha1_pass($_POST["password"]); }
			elseif($connexion_via_cookie==true)		{ $login=$_COOKIE["AGORAP_LOG"];	$password_crypte=$_COOKIE["AGORAP_PASS"]; }
			// IDENTIFICATION + RECUP DES INFOS
			$sql_password_crypte = "AND pass='".$password_crypte."'";
			if(is_file(ROOT_PATH."host.inc.php"))	$sql_password_crypte = sql_password($_POST["password"], $sql_password_crypte);//SHORT.C?
			$user_tmp = db_ligne("SELECT * FROM gt_utilisateur WHERE identifiant=".db_format($login)." ".$sql_password_crypte);
			// AUCUN USER CORRESPONDANT  =>  TENTE UNE IDENTIFICATION LDAP POUR UNE CREA D'UTILISATEUR A LA VOLEE..
			if(count($user_tmp)==0 && $connexion_via_form==true)	$user_tmp = ldap_connexion_creation_user($_POST["login"], $_POST["password"]);
			// ERREUR DE CONNEXION  /  VALIDATION DE L'UTILISATEUR
			if(count($user_tmp)==0)  { redir(ROOT_PATH."index.php?deconnexion=1&msg_alerte=identification"); }
			else
			{
				// COMPTE RESTREINT A DES ADRESSES IP ?
				if(controle_ip==true  &&  db_valeur("SELECT count(*) FROM gt_utilisateur WHERE id_utilisateur='".$user_tmp["id_utilisateur"]."' AND (ip_controle is null OR ip_controle LIKE '%@@".$_SERVER["REMOTE_ADDR"]."@@%')")==0)
					redir(ROOT_PATH."index.php?deconnexion=1&msg_alerte=adresseip");
				// COMPTE EN COURS D'UTILISATION SUR UN AUTRE POSTE ?  (compte utilise avec un autre IP ?)
				if(db_valeur("SELECT count(*) FROM gt_utilisateur_livecounter  WHERE  id_utilisateur='".$user_tmp["id_utilisateur"]."'  AND  date_verif > '".(time()-20)."'  AND  adresse_ip NOT LIKE '".$_SERVER["REMOTE_ADDR"]."'")>0)
					redir(ROOT_PATH."index.php?deconnexion=1&msg_alerte=dejapresent");
				// CONNEXION VALIDÉ  =>  REINITIALISE VALEURS DE SESSION
				$_SESSION = array();
				define("IDENTIFICATION_USER",true);
				$precedente_connexion = ($user_tmp["derniere_connexion"]>0)  ?  $user_tmp["derniere_connexion"]  :  strtotime(strftime("%Y-%m-%d 00:00:00")); // Aujourd'hui, si c'est la premiere connexion!
				db_query("UPDATE gt_utilisateur SET derniere_connexion='".time()."', precedente_connexion='".$precedente_connexion."' WHERE id_utilisateur='".$user_tmp["id_utilisateur"]."'");
				$_SESSION["user"]  = db_ligne("SELECT * FROM gt_utilisateur WHERE id_utilisateur='".$user_tmp["id_utilisateur"]."'");
				$_SESSION["agora"] = db_ligne("SELECT * FROM gt_agora_info");
				add_logs("connexion");
				// ENREGISTRE LOGIN & PASSWORD POUR UNE CONNEXION AUTO (31536000s=1an) ?
				if(!empty($_REQUEST["connexion_auto"])){
					setcookie("AGORAP_LOG", $login, time()+31536000);
					setcookie("AGORAP_PASS", $password_crypte, time()+31536000);
				}
			}
		}

		////	INITIALISE LA CONFIG DU NAVIGATEUR  (RESOLUTION D'ECRAN & LE NOM DU NAVIGATEUR)
		if(empty($_SESSION["cfg"]["navigateur"]))	cfg_navigateur();
	}


	////	SELECTION D'UN ESPACE  (changement d'espace  /  identification réalisé & pas d'espace select  /  page de connexion & espace deja select -> redir dans l'agora si connexion auto)
	////
	if(!empty($_GET["id_espace_acces"])  ||  (defined("IDENTIFICATION_USER") && empty($_SESSION["espace"]))  ||  (defined("IS_CONNEXION_PAGE") && !empty($_SESSION["espace"])))
	{
		////	LISTE DES ESPACES & REDIRECTION SI AUCUN..
		$liste_espaces = espaces_affectes_user();
		if(count($liste_espaces)==0)	redir(ROOT_PATH."index.php?deconnexion=1&msg_alerte=pasaccesite");

		////	SELECTIONNE UN ESPACE PRECIS (CONNEXION D'UN INVITE / SWITCH D'ESPACE PAR L'UTILISATEUR)
		if(!empty($_GET["id_espace_acces"]))
		{
			foreach($liste_espaces as $espace){
				$invite_autorise = ($_SESSION["user"]["id_utilisateur"]<1 && ($espace["password"]==@$_GET["password"] || $espace["password"]==""))  ?  true  :  false;
				if($espace["id_espace"]==$_GET["id_espace_acces"] && ($_SESSION["user"]["id_utilisateur"]>0 || $invite_autorise==true))   { $_SESSION["espace"] = $espace;  break; }
			}
		}
		////	ESPACE DE CONNEXION DE L'UTILISATEUR / ESPACE PAR DEFAUT
		elseif($_SESSION["user"]["id_utilisateur"]>0 )
		{
			if($_SESSION["user"]["espace_connexion"]!=""){
				foreach($liste_espaces as $espace_tmp)	{ if($espace_tmp["id_espace"]==$_SESSION["user"]["espace_connexion"])	$_SESSION["espace"] = $espace_tmp; }
			}
			if(empty($_SESSION["espace"]))	$_SESSION["espace"]=$liste_espaces[0];
		}

		////	ESPACE SELECTIONNE : AJOUTE LES DROITS D'ACCES, ETC.
		if(@$_SESSION["espace"]["id_espace"]>0)
		{
			// DROITS D'ACCES & MODULES & PUBLIC & CONFIG
			$_SESSION["espace"]["droit_acces"]	= droit_acces_espace($_SESSION["espace"]["id_espace"],$_SESSION["user"]);
			$_SESSION["espace"]["modules"]		= modules_espace($_SESSION["espace"]["id_espace"]);
			$_SESSION["cfg"]["espace"] = array();
			unset($_SESSION["agora"]["path_fond_ecran"]);
			// ENVOI D'INVITATION PAR MAIL  &  GROUPES D'UTILISATEUR
			$_SESSION["user"]["envoi_invitation"] = (function_exists("mail") && !empty($_SESSION["agora"]["adresse_web"]) && ($_SESSION["espace"]["droit_acces"]==2 || ($_SESSION["espace"]["invitations_users"]==1 && $_SESSION["user"]["id_utilisateur"]>0)))  ?  1  :  0;
			$_SESSION["espace"]["groupes_user_courant"] = groupes_users($_SESSION["espace"]["id_espace"],$_SESSION["user"]["id_utilisateur"]);
			// REDIRECTION VERS LE PREMIER MODULE
			redir_module_espace();
		}
	}


	////	CONTROLE D'ACCES AU MODULE COURANT  (CONTROLE DES UTILISATEURS LAMBDA. "NO_MODULE_CONTROL" -> SI LE MODULE USER N'EST PAS ACTIF ET QU'ON SOUHAITE MODIFIER SON PROFIL..)
	////
	if($_SESSION["user"]["admin_general"]!=1 && !empty($_SESSION["espace"]["modules"]) && defined("MODULE_PATH") && !defined("NO_MODULE_CONTROL"))
	{
		$acces_module = false;
		foreach($_SESSION["espace"]["modules"] as $mod_tmp)   { if($mod_tmp["module_path"]==MODULE_PATH)  $acces_module = true; }
		if($acces_module==false)	redir_module_espace();
	}


	////	LANGUE
	////
	// Langue de l'utilisateur / de l'agora / par défaut  &  Récup du fichier de traduction
	if(@$_SESSION["user"]["langue"]!="")		$langue_select = $_SESSION["user"]["langue"];
	elseif(@$_SESSION["agora"]["langue"]!="")	$langue_select = $_SESSION["agora"]["langue"];
	else										$langue_select = "francais";
	require_once PATH_LANG.$langue_select.".php";


	////	AFFICHAGE DES OBJETS : AUTEUR / TOUS / NORMAL
	////
	if(empty($_SESSION["cfg"]["espace"]["affichage_objet"]))	$_SESSION["cfg"]["espace"]["affichage_objet"]="normal";
	if(!empty($_REQUEST["affichage_objet"])){
		if($_REQUEST["affichage_objet"]=="tout" && $_SESSION["espace"]["droit_acces"]==2)			$_SESSION["cfg"]["espace"]["affichage_objet"] = "tout";
		elseif($_REQUEST["affichage_objet"]=="auteur" && $_SESSION["user"]["id_utilisateur"] > 0)	$_SESSION["cfg"]["espace"]["affichage_objet"] = "auteur";
		else																						$_SESSION["cfg"]["espace"]["affichage_objet"] = "normal";
	}


	////	IMAGE DU FOND D'ECRAN (EN SESSION)
	////
	if(empty($_SESSION["agora"]["path_fond_ecran"]))
	{
		// FOND D'ECRAN  =>  DE L'ESPACE  OU  DU SITE
		if(@$_SESSION["espace"]["fond_ecran"]!=""){
			if(preg_match("/".BG_DEFAULT."/",$_SESSION["espace"]["fond_ecran"]))	$fond_ecran_tmp  = PATH_WALLPAPER.str_replace(BG_DEFAULT,"",$_SESSION["espace"]["fond_ecran"]);
			else																	$fond_ecran_tmp  = PATH_WALLPAPER_USER.$_SESSION["espace"]["fond_ecran"];
		}else{
			if(preg_match("/".BG_DEFAULT."/",$_SESSION["agora"]["fond_ecran"]))		$fond_ecran_tmp  = PATH_WALLPAPER.str_replace(BG_DEFAULT,"",$_SESSION["agora"]["fond_ecran"]);
			else																	$fond_ecran_tmp  = PATH_WALLPAPER_USER.$_SESSION["agora"]["fond_ecran"];
		}
		$_SESSION["agora"]["path_fond_ecran"] = (is_file($fond_ecran_tmp))  ?  $fond_ecran_tmp  :  PATH_WALLPAPER."1.jpg";
	}
}
?>