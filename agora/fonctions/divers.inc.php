<?php
////	ENVOI DE MAIL
////
function envoi_mail($destinataires, $sujet_mail, $contenu_mail, $options="")
{
	////	INIT & OPTIONS PAR DEFAUT
	global $trad;
	$frontiere = "-----=".uniqid(mt_rand());
	if(!isset($options["message_alert"]))			$options["message_alert"] = true;
	if(!isset($options["header_footer"]))			$options["header_footer"] = true;
	if(!isset($options["afficher_dest_message"]))	$options["afficher_dest_message"] = false;
	if(!isset($options["expediteur_noreply"]))		$options["expediteur_noreply"] = false;
	if(!isset($options["notif"]))					$options["notif"] = false;
	if(!isset($options["accuse_reception"]))		$options["accuse_reception"] = false;
	if(!isset($options["fichiers_joints"]))			$options["fichiers_joints"] = true;

	////	EXPEDITEUR
	$expediteur_nom = "Agora-Project";
	$expediteur_adresse = "noreply@".str_replace("www.","",$_SERVER["SERVER_NAME"]);
/**/if(isset($_SESSION["user"]["nom"]) && $options["expediteur_noreply"]==false){
/**/	$expediteur_nom = auteur($_SESSION["user"]);
/**/	$expediteur_adresse = $_SESSION["user"]["mail"];
/**/}

	////	DESTINATAIRES
	if(is_array($destinataires)==false)		$destinataires = array($destinataires);
/**/foreach($destinataires as $dest_key => $dest_tmp){
/**/	if(is_numeric($dest_tmp))	{ $mail_tmp = user_infos($dest_tmp,"mail");   if($mail_tmp!="") $destinataires[$dest_key] = $mail_tmp; }
/**/}
	$destinataires_txt = implode(",", array_unique($destinataires));
	$destinataires_php = ($options["afficher_dest_message"]==true || count($destinataires)==1)  ?  $destinataires_txt  :  null;

	////	HEADERS
	$headers  = "From: ".$expediteur_nom."<".$expediteur_adresse.">\n";
	$headers .= "MIME-Version: 1.0\n";
	if($options["afficher_dest_message"]==false)	$headers .= "Bcc: ".$destinataires_txt."\n";
	else											$headers .= "To: ".$destinataires_txt."\n";
	if($options["accuse_reception"]==true)			$headers .= "Disposition-Notification-To: ".$_SESSION["user"]["mail"]."\nReturn-Receipt-To: ".$_SESSION["user"]["mail"]."\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"".$frontiere."\"\n";

	////	SUJET
	$sujet_mail = suppr_carac_spe($sujet_mail,"faible");
/**/if(defined("notif_modif_element"))	$sujet_mail .= " [".$trad["modif_par"]."]";

	////	MESSAGE HTML
	$message  = "--".$frontiere."\n";
	$message .= "Content-Type: text/html; charset=UTF-8\n\n";
	$message .= "<html>\n<head>\n<title>\n</title>\n</head>\n<body>\n";
/**/if($options["header_footer"]==true && isset($_SESSION["user"]["nom"]))		$message .= $trad["mail_envoye_par"]." ".auteur($_SESSION["user"])." (".$_SESSION["espace"]["nom"].") :<br><br>";
	$message .= wordwrap($contenu_mail);
/**/if($options["header_footer"]==true)											$message .= "<br><br><a href=\"".$_SESSION["agora"]["adresse_web"]."\" target='_blank'>".$_SESSION["agora"]["nom"]."</a><br>";
	$message .= "</body>\n</html>\n\n\n\n";

	////	FICHIERS JOINTS (?)
	if(control_upload() && $options["fichiers_joints"]==true)
	{
		foreach($_FILES as $fichier)
		{
			if($fichier["error"]==0 && is_file($fichier["tmp_name"]))
			{
				$message .= "--".$frontiere."\n";
				$message .= "Content-Type: ".filetype($fichier["tmp_name"])."; name=\"".$fichier["name"]."\"\n";
				$message .= "Content-Transfer-Encoding: BASE64\n";
				$message .= "Content-Disposition:attachment; filename=\"".$fichier["name"]."\"\n\n";
				$message .= chunk_split(base64_encode(file_get_contents($fichier["tmp_name"])))."\n\n";
			}
		}
	}
	$message .= "--".$frontiere."--";
	////	ENVOI DU MAIL + RAPPORT D'ENVOI SI DEMANDE
	$message_envoye = @mail($destinataires_php, $sujet_mail, $message, $headers);
	if($options["message_alert"]==true){
		$mail_envoye = ($options["notif"]==false)  ?  $trad["mail_envoye"]  :  @$trad["mail_envoye_notif"];
		if($message_envoye==true)	alert($mail_envoye." \\n\\n ".@$trad["MAIL_destinataires"]." : ".$destinataires_txt);
		else						alert($trad["mail_pas_envoye"]);
	}
	return $message_envoye;
}


////	INFOS SUR UN ESPACE
////
function info_espace($id_espace, $champ="*")
{
	if($champ=="*")	{ return db_ligne("SELECT * FROM  gt_espace WHERE id_espace='".intval($id_espace)."'"); }
	else			{ return db_valeur("SELECT ".$champ." FROM gt_espace WHERE id_espace='".intval($id_espace)."'"); }
}


////	MODULES D'UN ESPACE
////
function modules_espace($id_espace, $ajouter_agenda_perso=true)
{
	$tab_modules = db_tableau("SELECT DISTINCT  T1.*, T2.*  FROM  gt_module T1 LEFT JOIN gt_jointure_espace_module T2  ON  T1.nom=T2.nom_module  WHERE  T2.id_espace='".intval($id_espace)."' ORDER BY T2.classement asc");
	// Agenda personnel affiché si ->  affiche un utilisateur ayant activé son agenda  &&  qu'on affiche les modules accessibles par l'utilisateur  &&  que l'agenda n'a pas été déjà récupéré
	if($_SESSION["user"]["id_utilisateur"] > 0 && $_SESSION["user"]["agenda_desactive"]!="1" && $ajouter_agenda_perso==true && array_multi_search($tab_modules,"nom","agenda")==false)
		$tab_modules["agenda"] = db_ligne("SELECT * FROM gt_module WHERE nom='agenda'");
	return $tab_modules;
}


////	RE-PARAMETRAGE DE PHP POUR L'UPLOAD (ini_set() non dispo. sur wampserver & co)
////
function modif_php_ini()
{
	// + DE MEMOIRE  + DE TPS D'EXECUTION
	@ini_set("memory_limit", "512M");
	@ini_set("max_execution_time", "500");
}


////	RECHERCHE UNE VALEURE DANS UN TABLEAU MULTIDIMENTIONNEL
////
function array_multi_search($tableau, $cle, $valeur)
{
	// S'agit d'un tableau?
	if(is_array($tableau))
	{
		// Element dans le tableau courant ?
		if(array_key_exists($cle,$tableau) && in_array($valeur,$tableau))	return true;
		// Sinon Element dans un sous-tableaux ? (recherche récursive)
		foreach($tableau as $elem){
			if(is_array($elem) && array_multi_search($elem, $cle, $valeur))		return true;
		}
		// Sinon Recherche infructueuse
		return false;
	}
}


////	TRI UN TABLEAU MULTIDIMENTIONNEL (RESULTAT DE REQUETE)
////
function array_multi_sort($tableau_trier, $champ_trier, $tri="asc", $fixer_premiere_ligne=false)
{
	// Controle s'il y a plusieurs resultats dans le tableau
	if(@count($tableau_trier)<2)	{ return $tableau_trier; }
	else
	{
		// Créé un tableau temporaire avec juste la cle du tableau principal et le champ à trier
		$tableau_tmp = $tableau_retour = array();
		foreach($tableau_trier as $cle => $valeur)
		{
			if($fixer_premiere_ligne==true && !isset($cle_1er_result))	$cle_1er_result = $cle; // Retient le premier resultat
			else														$tableau_tmp[$cle] = $valeur[$champ_trier];
		}
		// Tri ascendant ou descendant
		if($tri=="asc")  asort($tableau_tmp);  else  arsort($tableau_tmp);
		// tableau de retour : Rajoute le premier résultat retenu en premier ?
		if(isset($cle_1er_result))	$tableau_retour[$cle_1er_result] = $tableau_trier[$cle_1er_result];
		// Reconstruit le tableau multidimensionnel à partir du tableau temporaire trié
		foreach($tableau_tmp as $cle => $valeur)	{ $tableau_retour[$cle]	= $tableau_trier[$cle]; }
		// Retourne le tableau trié
		return $tableau_retour;
	}
}


////	SQL TRI DES RESULTATS
////
function tri_sql($options_tri, $pre_tri="")
{
	// Affiche arbo. de dossiers + tri pas encore sélectionné   =>   vérifie si tri enregistré dans la préférence user ($_REQUEST["tri"])
	if(isset($_GET["id_dossier"]) && !isset($_REQUEST["tri"]))	pref_user("tri_dossier_".MODULE_NOM."_".$_GET["id_dossier"], "tri");
	// Tri sélectionné (si existe)  OU  tri par défaut
	$tri_select = (in_array(@$_REQUEST["tri"],$options_tri)==true)  ?  text2tab($_REQUEST["tri"])  : text2tab($options_tri[0]);
	// retourne le tri (0=champ, 1=order)  avec pré-tri si besoin  (sujets, actus)
	return "ORDER BY ".$pre_tri." ".$tri_select[0]." ".$tri_select[1];
}


////	SQL FILTRAGE ALPHABETIQUE (exemple : pour sélectionner des utilisateurs dont le nom commence par une certaine lettre)
////
function alphabet_sql($champ_selection)
{
	if(isset($_REQUEST["alphabet"]))	{ return " AND ".$champ_selection." LIKE '".$_REQUEST["alphabet"]."%' "; }
}


////	RECUPERE LES VARIABLES PASSES DANS L'URL ($variables_exclure="truc,bidule,machin")
////
function variables_get($variables_exclure="")
{
	// On passe les variables à exlure dans un tableau
	$variables_exclure = explode(",", $variables_exclure);
	if(!is_array($variables_exclure))	$variables_exclure = array($variables_exclure);
	// On recréé la liste des variables
	$retour  = "";
	foreach($_GET as $cle_tmp => $valeur_tmp)
	{
		// Ajoute la variable si elle n'est pas a exclure ET ce n'est pas une commande de suppression..
		if(!in_array($cle_tmp,$variables_exclure) && !preg_match("/suppr/i",$cle_tmp) && @!preg_match("/suppr/i",$valeur_tmp))
		{
			// Valeur simple / Valeur "Tableau"
			if(!is_array($valeur_tmp))	{ $retour .= $cle_tmp."=".$valeur_tmp."&"; }
			else						{	foreach($valeur_tmp as $valeur_tmp2)	{ $retour .= $cle_tmp."[]=".$valeur_tmp2."&"; }		}
		}
	}
	return "?".trim($retour,"&");
}


////	RECUP' LA PREFERENCE UTILISATEUR EN BDD, OU ENREGISTRE UNE NOUVELLE  =>  TRI / TYPE D'AFFICHAGE / ETC.
////
function pref_user($cle_pref_db="", $cle_pref_request="", $valeur_request_exclure="", $tableau_valeurs=false)
{
	////	$cle_db = $cle_request
	if($cle_pref_request=="")  $cle_pref_request = $cle_pref_db;
	////	NOUVELLE PREFERENCE ?   ($_REQUEST + valeur non exlue  =>  Enregistre ds BDD)
	if(isset($_REQUEST[$cle_pref_request]) && ($valeur_request_exclure=="" || $valeur_request_exclure!=@$_REQUEST[$cle_pref_request]))
	{
		// Prépare les valeurs
		$valeur_sortie = $_REQUEST[$cle_pref_request];
		$valeur_db = (is_array($_REQUEST[$cle_pref_request])==true)  ?  implode("@@",$_REQUEST[$cle_pref_request])  :  $_REQUEST[$cle_pref_request];
		// Invité / Utilisateur
		if($_SESSION["user"]["id_utilisateur"]<1)	{ $_SESSION["pref_invite"][$cle_pref_db] = $valeur_db; }
		else {
			db_query("DELETE FROM gt_utilisateur_preferences WHERE id_utilisateur='".$_SESSION["user"]["id_utilisateur"]."' AND cle=".db_format($cle_pref_db));
			db_query("INSERT INTO gt_utilisateur_preferences SET id_utilisateur='".$_SESSION["user"]["id_utilisateur"]."', cle=".db_format($cle_pref_db).", valeur=".db_format($valeur_db));
		}
	}
	////	SINON RECUPERE LA PREFERENCE (bdd ou session) ET L'ASSIGNE A $_REQUEST
	elseif(!isset($_REQUEST[$cle_pref_request]) && $cle_pref_request!="")
	{
		if($_SESSION["user"]["id_utilisateur"]<1)	$valeur_sortie = @$_SESSION["pref_invite"][$cle_pref_db];
		else										$valeur_sortie = db_valeur("SELECT valeur FROM gt_utilisateur_preferences WHERE id_utilisateur='".$_SESSION["user"]["id_utilisateur"]."' AND cle='".$cle_pref_db."'");
		if($valeur_sortie!=""){
			if($tableau_valeurs==true)		$valeur_sortie = (preg_match("/@@/",$valeur_sortie))  ?  text2tab($valeur_sortie)  :  array($valeur_sortie);
			$_REQUEST[$cle_pref_request] = $valeur_sortie;
		}
	}
	////	Retourne la préférence
	if(isset($valeur_sortie))	return $valeur_sortie;
}


////	OPTION DU MODULE ACTIVE ?
////
function option_module($option, $id_espace="")
{
	// Modules de l'espace courant ou d'un autre espace?
	$modules = ($id_espace=="")  ?  $_SESSION["espace"]["modules"] : modules_espace($id_espace);
	foreach($modules as $module)
	{
		if(@preg_match("/".$option."/i",$module["options"]))  return true;
	}
}


////	SELECTEUR DE COULEURS
////
function select_couleur($input_text, $input_couleur, $type_selection="background")
{
	// init
	$cpt = 1;
	$id_menu = uniqid(mt_rand());
	$type_selection = ($type_selection=="background")  ?  "backgroundColor"  :  "color";
	$tab_couleurs = array("ffffff","ffccc9","ffce93","fffc9e","ffffc7","9aff99","96fffb","cdffff","cbcefb","cfcfcf","fd6864","fe996b","fffe65","fcff2f","67fd9a","38fff8","68fdff","9698ed","c0c0c0","fe0000","f8a102","ffcc67","f8ff00","34ff34","68cbd0","34cdf9","6665cd","9b9b9b","cb0000","f56b00","ffcb2f","ffc702","32cb00","00d2cb","3166ff","6434fc","656565","9a0000","ce6301","cd9934","999903","009901","329a9d","3531ff","6200c9","343434","680100","963400","986536","646809","036400","34696d","00009b","303498","000000","330001","643403","663234","343300","013300","003532","010066","340096");
	// Contruit le Colorpicker
	$retour = "<div class='menu_context' style='margin-top:10px;padding:0px;' id='".$id_menu."'>";
		$retour .= "<div style='display:table-row;'>";
		foreach(array_reverse($tab_couleurs) as $color)
		{
			// Ajoute la couleur
			$retour .= "<div style='display:table-cell;background-color:#".$color.";width:15px;height:12px;cursor:pointer;padding:1px;' OnClick=\"element('".$input_text."').style.".$type_selection."='#".$color."';set_value('".$input_couleur."','#".$color."');\">&nbsp;</div>";
			// Nouvelle ligne OU incrémente le compteur
			if($cpt==9)		{ $cpt = 1;  $retour .= "</div><div style='display:table-row;'>"; }
			else			{ $cpt++; }
		}
		$retour .= "</div>";
	$retour .= "</div>";
	$retour .= "<img src=\"".PATH_TPL."divers/nuancier.png\" id='icone_".$id_menu."' /><script type='text/javascript'> menu_contextuel('".$id_menu."'); </script>";
	return $retour;
}


////	LOGO DU FOOTER / DU SITE
////
function path_logo_footer()
{
	$chemin_logo_perso = PATH_STOCK_FICHIERS.$_SESSION["agora"]["logo"];
	// Logo par défaut
	if(is_file($chemin_logo_perso)==false)	{ return PATH_TPL."divers/logo_footer.png"; }
	// Logo perso (height 80px max)
	else
	{
		if(!isset($_SESSION["logo_footer_height"])){
			list($width,$height) = getimagesize($chemin_logo_perso);
			$_SESSION["logo_footer_height"] = ($height<80) ? $height : 80;
		}
		return $chemin_logo_perso;
	}
}


////	TRI DES PERSONNES : MODIF DU TRI PAR DEFAUT EN FONCTION DU PARAMETRAGE GENERAL
////
function modif_tri_defaut_personnes($config_tri)
{
	// Si on souhaite trier par "prénom" et que le tri par défaut est "nom"  =>  Inverse "nom" et "prenom"
	if($_SESSION["agora"]["tri_personnes"]=="prenom" && preg_match("/nom@@/i",$config_tri[0])==true)
	{
		// Récupère les cle de chaque valeures
		$key_nom_asc	 = array_search("nom@@asc", $config_tri);
		$key_nom_desc	 = array_search("nom@@desc", $config_tri);
		$key_prenom_asc	 = array_search("prenom@@asc", $config_tri);
		$key_prenom_desc = array_search("prenom@@desc", $config_tri);
		// Réaffecte les valeures
		$config_tri[$key_nom_asc]		= "prenom@@asc";
		$config_tri[$key_nom_desc]		= "prenom@@desc";
		$config_tri[$key_prenom_asc]	= "nom@@asc";
		$config_tri[$key_prenom_desc]	= "nom@@desc";
	}
	return $config_tri;
}


////	TIMEZONE DU SERVEUR (Format "text" ou "num")
////
function server_timezone($type_format)
{
	global $tab_timezones;
	// Tableau de valeurs sur le temps + mois et année au bon format
	$arr = localtime(time());
	$arr[4] ++;
	$arr[5] += 1900;
	// Décalage GMT
	$decalage_gmt_secondes = @gmmktime($arr[2],$arr[1],$arr[0],$arr[4],$arr[3],$arr[5]) - time();
	$decalage_gmt_heures = round($decalage_gmt_secondes / 3600);
	// $tab_timezones  ->  cle ('Europe/Paris')  /  valeur ('1.00')
	$txt_time_zone = array_search($decalage_gmt_heures,$tab_timezones);
	if($type_format=="text")	return $txt_time_zone;
	else						return $tab_timezones[$txt_time_zone];
}
////	TIMEZONE A AFFICHER, AU FORMAT TEXTE (Timezone de l'espace / du serveur / par défaut)
////
function current_timezone()
{
	global $tab_timezones;
	if(array_search(@$_SESSION["agora"]["timezone"],$tab_timezones)!="")	return array_search(@$_SESSION["agora"]["timezone"],$tab_timezones);
	elseif(server_timezone("text")!="")										return server_timezone("text");
	else																	return "Europe/Paris";
}
////	TABLEAU DES TIMESZONES
$tab_timezones = array(
	'Kwajalein' => "-12.00",
	'Pacific/Midway' => "-11.00",
	'Pacific/Honolulu' => "-10.00",
	'America/Anchorage' => "-9.00",
	'America/Los_Angeles' => "-8.00",
	'America/Denver' => "-7.00",
	'America/Mexico_City' => "-6.00",
	'America/New_York' => "-5.00",
	'America/Guyana' => "-4.00",
	'America/Buenos_Aires' => "-3.00",
	'America/Sao_Paulo' => "-3.00",
	'Atlantic/South_Georgia' => "-2.00",
	'Atlantic/Azores' => "-1.00",
	'Europe/London' => "0",
	'Europe/Paris' => "1.00",
	'Europe/Helsinki' => "2.00",
	'Europe/Moscow' => "3.00",
	'Asia/Dubai' => "4.00",
	'Asia/Karachi' => "5.00",
	'Asia/Kolkata' => "5.30",
	'Asia/Dhaka' => "6.00",
	'Asia/Jakarta' => "7.00",
	'Asia/Hong_Kong' => "8.00",
	'Asia/Tokyo' => "9.00",
	'Australia/Sydney' => "10.00",
	'Asia/Magadan' => "11.00",
	'Pacific/Fiji' => "12.00",
	'Pacific/Tongatapu' => "13.00");


////	AJOUT D'UN LOG
////
function add_logs($action, $obj_tmp="", $id_objet="", $commentaire="")
{
	// Infos sur la session ?
	if(count($_SESSION)>0)
	{
		// INFOS DE BASE DU LOG
		$module_nom = (defined("MODULE_NOM"))  ?  MODULE_NOM  :  "";
		$sql_corps = "module=".db_format($module_nom).", date='".db_insert_date()."', id_utilisateur=".db_format(@$_SESSION["user"]["id_utilisateur"]).", id_espace=".db_format(@$_SESSION["espace"]["id_espace"]).", ip=".db_format($_SERVER["REMOTE_ADDR"]);

		// ELEMENT : AJOUTE UN COMMENTAIRE, MàJ DE LA DATE DE MOFIF, ETC.
		if($id_objet > 0)
		{
			$objet_infos = objet_infos($obj_tmp, $id_objet);
			// NOM / TITRE / ETC. : EN DEBUT DE COMMENTAIRE
			if(@$objet_infos["nom"]!="")				$commentaire_tmp = $objet_infos["nom"];
			elseif(@$objet_infos["nom_fichier"]!="")	$commentaire_tmp = $objet_infos["nom_fichier"];
			elseif(@$objet_infos["titre"]!="")			$commentaire_tmp = text_reduit($objet_infos["titre"],100);
			elseif(@$objet_infos["description"]!="")	$commentaire_tmp = text_reduit($objet_infos["description"],100);
			elseif(@$objet_infos["adresse"]!="")		$commentaire_tmp = text_reduit($objet_infos["adresse"],100);
			// COMMENTAIRE A LA SUITE
			if(isset($commentaire_tmp)){
				if($commentaire!="")	$commentaire = $commentaire_tmp." - ".$commentaire;
				else					$commentaire = $commentaire_tmp;
			}
			// DOSSIER OU ELEMENT DANS UN DOSSIER
			if(isset($objet_infos["id_dossier"]))
			{
				// Init
				global $trad,$objet;
				$objet_dossier = (isset($obj_tmp["type_contenu"]))  ?  $obj_tmp  :  $objet[$obj_tmp["type_conteneur"]];
				// Ajout/Modif/Suppr : enregistrement dans les logs du dossier conteneur (si pas racine)
				$id_dossier_parent = (isset($objet_infos["id_dossier_parent"]))  ?  $objet_infos["id_dossier_parent"]  :  $objet_infos["id_dossier"];
				if($id_dossier_parent > 1  &&  preg_match("/ajout|modif|suppr/i",$action))
					db_query("INSERT INTO  gt_logs  SET  action='modif', type_objet=".db_format(@$objet_dossier["type_objet"]).", id_objet=".db_format($id_dossier_parent).", commentaire=".db_format($trad["LOGS_".$action]." : ".$commentaire).", ".$sql_corps, false);
				// Ajoute le chemin d'accès à l'element dans le commentaire
				$commentaire .= " (".trim(chemin($objet_dossier, $objet_infos["id_dossier"], "url_virtuelle")," /").")";
			}
			// TELECHARGEMENT D'UN FICHIER : COMPTEUR ++
			if($action=="consult2")	db_query("UPDATE ".$obj_tmp["table_objet"]." SET nb_downloads=(nb_downloads + 1) WHERE ".$obj_tmp["cle_id_objet"]."='".intval($id_objet)."'", false);
			// MAJ DATE MODIF  +  $_REQUEST["notif_modif_element"] POUR L'AJOUT DANS L'ENTETE DES MAILS DE NOTIF
			if($action=="modif"){
				db_query("UPDATE ".$obj_tmp["table_objet"]." SET id_utilisateur_modif='".$_SESSION["user"]["id_utilisateur"]."', date_modif='".db_insert_date()."'  WHERE ".$obj_tmp["cle_id_objet"]."='".intval($id_objet)."'", false);
				if(!defined("notif_modif_element"))	define("notif_modif_element",true);
			}
		}

		////	AJOUTE LE LOG
		db_query("INSERT INTO  gt_logs  SET  action=".db_format($action).", type_objet=".db_format(@$obj_tmp["type_objet"]).", id_objet=".db_format($id_objet).", commentaire=".db_format($commentaire).", ".$sql_corps, false);

		////	SUPPR LES ANCIENS LOGS, SAUF LOGS DE "MODIF" CONSERVES 1 AN MAXI
		$date_log_modif  = time() - (360*86400);
		$date_log_normal = time() - (@$_SESSION["agora"]["logs_jours_conservation"]*86400);
		db_query("DELETE FROM  gt_logs  WHERE  (action not like 'modif' and UNIX_TIMESTAMP(date) < '".$date_log_normal."')  OR  (action like 'modif' and UNIX_TIMESTAMP(date) < '".$date_log_modif."')", false);
	}
}




////	JAVASCRIPT !
////
////


////	MESSAGE D'ALERT
////
function alert($text_alerte, $onload=true)
{
	echo "<script type='text/javascript'>  ".($onload==true?"window.onload=":"")." alert(\"".$text_alerte."\");  </script>";
}


////	ON DONNE UNE VALEUR A UN CHAMPS
////
function set_value($id, $valeur)
{
	return "<script type='text/javascript'>  set_value(\"".$id."\", \"".$valeur."\");  </script>";
}


////	REDIRECTION VERS UNE AUTRE PAGE
////
function redir($adresse)
{
	echo "<script type='text/javascript'>  window.location.replace(\"".$adresse."\");  </script>";
	exit();
}


////	REDIRECTION VERS UN MODULE SPECIFIQUE (espace_edit.php)  /  REDIRECTION VERS LE MODULE PAR DEFAUT DE L'ESPACE  /  SORTIE DE L'ESPACE
////
function redir_module_espace()
{
	if(isset($_GET["redir_module_path"]))			redir(ROOT_PATH.$_GET["redir_module_path"]."/");
	elseif(isset($_SESSION["espace"]["modules"]))	redir(ROOT_PATH.$_SESSION["espace"]["modules"][0]["module_path"]."/");
	else											redir(ROOT_PATH);
}


////	CHARGEMENT DE SWFOBJECT
////
function swfobject($id_objet_flash)
{
	echo "<script src=\"//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js\"></script>";
	echo "<div id=\"".$id_objet_flash."\" style='margin:0px;padding:0px;'>";
	echo "<a href='http://www.adobe.com/go/getflashplayer' target='_blank' style='color:#999;'>Téléchargez le lecteur Flash / Get flash player</a>";
	echo "</div>";
}


////	RECHARGE PAGE PRINCIPALE + FERME POPUP?
////
function reload_close($page_redir="")
{
	echo "<script type='text/javascript'>
		////	Page forcée ?  URL du parent de l'Iframe ?  URL de l'Opener du Popup ?
		if('".$page_redir."'!='')							page_redir = '".$page_redir."';
		else if(window.parent.location!=window.location)	page_redir = window.parent.location;
		else												page_redir = window.opener.location;
		////	Rechagement depuis Iframe ou Popup ?
		if(window.parent.location!=window.location)	{ window.parent.location.replace(page_redir); }
		else										{ window.opener.location.replace(page_redir);  window.close(); }
	</script>";
	exit;
}


////	ENREGISTRE LA CONFIG DU NAVIGATEUR
////	-> RECUP' EN PAGE DE CONNEXION POUR AVOIR LES VALEURS DES LA PREMIERE PAGE
////	-> RECUP' EN AJAX SI C'EST UNE CONNEXION DIRECTE AVEC ID/PASS MEMORISE
function cfg_navigateur()
{
	$_SESSION["cfg"]["resolution_width"]	= (@$_REQUEST["resolution_width"]>1024)  ?  $_REQUEST["resolution_width"]  :  1024;
	$_SESSION["cfg"]["resolution_height"]	= (@$_REQUEST["resolution_height"]>768)  ?  $_REQUEST["resolution_height"]  :  768;
	$_SESSION["cfg"]["navigateur"]			= (@$_REQUEST["navigateur"]!="")  ?  $_REQUEST["navigateur"]  :  false;
}


////	AFFICHAGE D'UNE BARRE DE STATUT (POURCENTAGE)
////
function status_bar($pourcent, $txt_barre, $txt_infobulle, $couleur_pourcent="jaune", $width_barre="width:120px;", $style_barre="")
{
	// init
	if($pourcent==0)	$pourcent = 1;
	if($couleur_pourcent!="rouge" && $pourcent>=100)	$couleur_pourcent="verte";
	$display = (preg_match("/MSIE 7/i",$_SERVER['HTTP_USER_AGENT']))  ?  "inline"  :  "inline-table";
	// Affichage
	return "<table class='table_nospace' cellpadding='0' cellspacing='0' style=\"".$width_barre.$style_barre."display:".$display.";height:18px;vertical-align:middle;background-image:url(".PATH_TPL."divers/barre_background.png);\"><tr>
				<td style=\"width:".$pourcent."%;text-align:left;background-image:url(".PATH_TPL."divers/barre_".$couleur_pourcent.".png);\">
					<span style=\"position:absolute;".$width_barre.";line-height:18px;padding:0px;margin:0px;font-size:9px;font-weight:normal;color:#000;text-align:center;cursor:help;\" ".infobulle($txt_infobulle).">".$txt_barre."</span>
					<img src=\"".PATH_TPL."divers/vide.png\" />
				</td>
				<td><img src=\"".PATH_TPL."divers/vide.png\" /></td>
			</tr></table>";
}

////	AFFICHAGE SUR SMARTPHONE ?
////
function is_mobile()
{
	return preg_match("/(android|iphone|windows phone|opera mini|blackberry|symbian|bada)/i",$_SERVER['HTTP_USER_AGENT']);
}
?>