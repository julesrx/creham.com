<?php
////	CONTROLE SUR LES TYPES DE FICHIERS ACCEPTES
////
function controle_fichier($type, $nom_fichier)
{
	if(	($type=="image_browser"	&& preg_match("/(\.jpg|\.jpeg|\.jpe|\.png|\.gif|\.bmp|\.wbmp)$/i",$nom_fichier)) ||   // Image affichable par le navigateur
		($type=="image_gd"		&& preg_match("/(\.jpg|\.jpeg|\.png|\.gif)$/i",$nom_fichier) && function_exists("ImageCreateTrueColor")) ||   // Image modifiable par GD2
		($type=="image"			&& preg_match("/(\.jpg|\.jpeg|\.jpe|\.png|\.gif|\.bmp|\.wbmp|\.tif|\.tiff|\.psd|\.eps|\.ai|\.ps|\.svg)$/i",$nom_fichier)) ||   // Image
		($type=="word"			&& preg_match("/(\.doc|\.docx|\.docm|\.dotx|\.dotm)$/i",$nom_fichier)) ||
		($type=="excel"			&& preg_match("/(\.xls|\.xlsx|\.xlsm|\.xltx|\.xltm)$/i",$nom_fichier)) ||
		($type=="powerpoint"	&& preg_match("/(\.ppt|\.pptx|\.pptm|\.potx|\.potm|\.pps|\.ppsx)$/i",$nom_fichier)) ||
		($type=="ootext"		&& preg_match("/(\.odt|\.ott|\.sxw|\.stw)$/i",$nom_fichier)) ||   // Open Office Text
		($type=="oocalc"		&& preg_match("/(\.ods|\.ots|\.sxc|\.stc)$/i",$nom_fichier)) ||   // Open Office Calc
		($type=="oopresent"		&& preg_match("/(\.odp|\.otp|\.sxi|\.sti)$/i",$nom_fichier)) ||   // Open Office Presentation
		($type=="archive"		&& preg_match("/(\.zip|\.rar|\.7z|\.gz|\.tgz|\.gz|\.tar|\.ace|\.cab|\.iso|\.jar|\.nrg)$/i",$nom_fichier)) ||   // Archive
		($type=="pdf"			&& preg_match("/(\.pdf)$/i",$nom_fichier)) ||
		($type=="text"			&& preg_match("/(\.text|\.txt|\.rtf)$/i",$nom_fichier)) ||
		($type=="mp3"			&& preg_match("/(\.mp3)$/i",$nom_fichier)) ||
		($type=="flash"			&& preg_match("/(\.swf)$/i",$nom_fichier)) ||
		($type=="web"			&& preg_match("/(\.htm|\.html)$/i",$nom_fichier)) ||
		($type=="fichier_joint" && (controle_fichier("image_browser",$nom_fichier) || controle_fichier("video_browser",$nom_fichier) || controle_fichier("mp3",$nom_fichier) || controle_fichier("flash",$nom_fichier))) ||   // Fichier joint pouvant être intégré dans le texte
		($type=="video_browser"	&& preg_match("/(\.mp4|\.mpeg|\.mpg|\.flv|\.ogv|\.webm|\.mov|\.wmv|\.avi)$/i",$nom_fichier)) ||		// Video lisible via le navigateur
		($type=="video_wmv_avi"	&& preg_match("/(\.wmv|\.avi)$/i",$nom_fichier)) ||													// Video WMV lisible via le navigateur
		($type=="video_webm"	&& preg_match("/(\.webm)$/i",$nom_fichier)) ||														// Video WEBM lisible via le navigateur
		($type=="fichier_sensible"	&& preg_match("/(\.php|\.phtml|\.php3|\.php4|\.php5|\.shl|\.sh|\.so|\.exe|\.dat|\.conf|\.js|\.cgi|\.bat|\.src|\.dll|\.ini|\.cmd|\.drv|\.sys|\.msc|\.msi|\.wsc|\.vbs|\.vbe|\.sql|\.myd|\.myi|\.frm|\.vbs|\.mht|\.shtm|\.shtml|\.stm|\.ssi|\.vbs|\.xml|\.xsl|\.lbi|\.dwt|\.jsp|\.pif)$/i",$nom_fichier)) ||   // Fichier pouvant etre dangereux
		($type=="fichier_interdit"	&& preg_match("/(\.htaccess)$/i",$nom_fichier))   // Fichier interdit
	)
		return true;
	else
		return false;
}


////	CREATION D'UNE IMAGE REDIMENSIONNEE
////
function reduire_image($chemin_image, $chemin_enregistrement, $hauteur_maxi, $largeur_maxi, $pourcent_optimize=90)
{
	// On vérifie si gd2 est activé et si le fichier image peut être traité par gd2
	if(controle_fichier("image_gd",$chemin_image)==true && is_file($chemin_image))
	{
		// Type d'image
		if(preg_match("/(\.jpg|\.jpeg)$/i", $chemin_image))		{ $type = "jpg"; }
		elseif(preg_match("/(\.png)$/i", $chemin_image))		{ $type = "png";  $pourcent_optimize = floor($pourcent_optimize/10); }
		elseif(preg_match("/(\.gif)$/i", $chemin_image))		{ $type = "gif"; }

		// Taille de l'image d'origine
		list($largeur_old, $hauteur_old) = getimagesize($chemin_image);
		// Taille de l'image en fonction du cadre de référence
		if($largeur_old < $largeur_maxi && $hauteur_old < $hauteur_maxi)	{ $largeur = $largeur_old;  $hauteur = $hauteur_old; }
		else {
			// soit la largeur est supérieur à la hauteur, soit la hauteur est supérieur à la largeur
			if ($largeur_old > $hauteur_old)	{ $largeur = $largeur_maxi;	$hauteur = round(($largeur_maxi / $largeur_old) * $hauteur_old); }
			else								{ $hauteur = $hauteur_maxi;	$largeur = round(($hauteur_maxi / $hauteur_old) * $largeur_old); }
		}

		// Création d'une image temporaire (avec transparence pour les .png)
		$thumb = imagecreatetruecolor($largeur, $hauteur);
		if($type=="jpg")		{ $source = imagecreatefromjpeg($chemin_image); }
		elseif($type=="gif")	{ $source = imagecreatefromgif($chemin_image); }
		elseif($type=="png")
		{
			if(version_compare(PHP_VERSION,'4.3.2','>=')) {
				imagesavealpha($thumb,true);
				$trans_colour = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
				imagefill($thumb, 0, 0, $trans_colour);
			}
			$source = imagecreatefrompng($chemin_image);
		}

		// Redimensionnement
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $largeur, $hauteur, $largeur_old, $hauteur_old);
		// Envoi au navigateur de l'image  OU  Enregistrement de l'image
		if($chemin_enregistrement=="") {
			if($type=="jpg")		{ header("Content-type: image/jpeg");	imagejpeg($thumb); }
			elseif($type=="png")	{ header("Content-type: image/png");	imagepng($thumb); }
			elseif($type=="gif")	{ header("Content-type: image/gif");	imagegif($thumb); }
		}
		else {
			if($type=="jpg")		{ imagejpeg($thumb, $chemin_enregistrement, $pourcent_optimize); }
			elseif($type=="png")	{ imagepng($thumb, $chemin_enregistrement, $pourcent_optimize); }
			elseif($type=="gif")	{ imagegif($thumb, $chemin_enregistrement); }
			chmod($chemin_enregistrement,0775);
		}
		return true;
	}
}


////	TAILLE D'UN DOSSIER  (fonction récursive avec filesize() car la commande shell "du -sb --exclude 'tmp'" est un peu longue)
////
function dossier_taille($chemin_dossier)
{
	// Init
	$taille_dossier = 0;
	$chemin_dossier = rtrim($chemin_dossier,"/");//"trimer" uniquement la fin du chemin
	// Récupère la taille d'un dossier (exclue le dossier "tmp/")
	if(is_dir($chemin_dossier) && !preg_match("/stock_fichiers\/tmp/i",$chemin_dossier))
	{
		$dir = opendir($chemin_dossier);
		// Parcourt le dossier courant  ->  récupère la taille des fichiers / lance récursivement "taille_dossier()"
		while($file = readdir($dir))
		{
			if($file!="." && $file!=".."){
				$chemin_elem = $chemin_dossier."/".$file;
				if(is_file($chemin_elem))		$taille_dossier += filesize($chemin_elem);
				elseif(is_dir($chemin_elem))	$taille_dossier += dossier_taille($chemin_elem);
			}
		}
	}
	// Retourne le résultat
	return $taille_dossier;
}


////	TAILLE DU STOCK_FICHIER : ON RETIENT LA VALEUR EN SESSION DURANT 10mn MAX (600s)
////
function taille_stock_fichier($force_calcul=false)
{
	$duree_conservation = 600;//secondes
	// Récupère la taille de "PATH_STOCK_FICHIERS"  :  si on force le calcul, ou si la valeure de session n'est pas encore définie, ou si elle a expiré.. 
	if($force_calcul==true || empty($_SESSION["agora"]["taille_stock_fichier"]) || (time()-$_SESSION["agora"]["taille_stock_fichier_TIME"])>$duree_conservation){
		$_SESSION["agora"]["taille_stock_fichier"] = dossier_taille(PATH_STOCK_FICHIERS);
		$_SESSION["agora"]["taille_stock_fichier_TIME"] = time();
	}
	// retourne la valeure
	return $_SESSION["agora"]["taille_stock_fichier"];
}


////	RETOURNE UNE VALEUR EXPRIMEE EN OCTETS A PARTIR D'UNE VALEUR EXPRIMEE EN KO / MO  (CONFIG "php.ini" & CO)
////
function return_bytes($taille_maxi)
{
	$taille_maxi = strtolower(trim($taille_maxi));
	$dernier_caractere = substr($taille_maxi, -1, 1);
	if($dernier_caractere=="g")			{ return (int) $taille_maxi * 1073741824; }
	elseif($dernier_caractere=="m")		{ return (int) $taille_maxi * 1048576; }
	elseif($dernier_caractere=="k")		{ return (int) $taille_maxi * 1024; }
	else								{ return (int) $taille_maxi; }
}


////	AFFICHAGE DE LA TAILLE D'UN DOSSIER OU D'UN FICHIER (1 Mo = 1048576 octets / 1 Go = 1073741824 octets)
////
function afficher_taille($taille_octet, $afficher_libelle=true)
{
	global $trad;
	if($taille_octet >= 1073741824)		{ $taille = round(($taille_octet/1073741824),2);	if($afficher_libelle==true) $taille .= " ".$trad["giga_octet"]; }
	elseif($taille_octet >= 1048576)	{ $taille = round(($taille_octet/1048576),1);		if($afficher_libelle==true) $taille .= " ".$trad["mega_octet"]; }
	else								{ $taille = ceil($taille_octet/1024);				if($afficher_libelle==true) $taille .= " ".$trad["kilo_octet"]; }
	return $taille;
}


////	DOSSIERS ET FICHIERS POUR LA SAUVEGARDE GLOBALE
////
function dossiers_fichiers_sav($chemin_dossier)
{
	// Initialize
	$liste_fichiers = array();
	$chemin_dossier = rtrim($chemin_dossier,"/");//"trimer" uniquement la fin du chemin
	// Liste les fichiers d'un dossier
	if(is_dir($chemin_dossier))
	{
		$dir = opendir($chemin_dossier);
		// Parcour du dossier courant
		while($file = readdir($dir))
		{
			if($file!="." && $file!="..")
			{
				$chemin_elem = $chemin_dossier."/".$file;
				// Ajoute le fichier ou le dossier s'il est vide (pour l'archive de sauvegarde)
				if(is_file($chemin_elem) || (is_dir($chemin_elem) && dossier_taille($chemin_elem)==0))	$liste_fichiers[] = $chemin_elem;
				// Parcour récursivement le dossier
				if(is_dir($chemin_elem))	$liste_fichiers = array_merge($liste_fichiers, dossiers_fichiers_sav($chemin_elem));
			}
		}
	}
	// Retourne le résultat final
	return $liste_fichiers;
}


////	DOWNLOAD D'UNE GROSSE ARCHIVE (SAV & CO) : CONTROLE L'HORAIRE POUR NE PAS SATURER LE SERVEUR
////
function controle_big_download($path_dossier)
{
	if(is_file(ROOT_PATH."host.inc.php"))
	{
		$limit_debut = 9;
		$limit_fin = 20;
		$taille_limite = (50*1048576); // 50Mo !
		if(strftime("%H") > $limit_debut  &&  strftime("%H") < $limit_fin  &&  dossier_taille($path_dossier) > $taille_limite){
			global $trad;
			alert($limit_debut."h -> ".$limit_fin."h : ".$trad["download_alert"]);
			redir("index.php");
		}
	}
}


////	LIBELLE DE LA TAILLE LIMITE DES FICHIERS UPLOADES
////
function libelle_upload_max_filesize($libelle_complet=true)
{
	global $trad;
	$taille_tmp = afficher_taille(return_bytes(ini_get("upload_max_filesize")));
	if($libelle_complet==true)	return $trad["FICHIER_limite_chaque_fichier"]." ".$taille_tmp;
	else						return $taille_tmp;
}


////	SUPPRIMER DES ELEMENTS TEMPORAIRES
////
function nettoyer_tmp()
{
	// Fichiers temporaires de + de 3 heures
	$dir_tmp = opendir(PATH_TMP);
	while($file = readdir($dir_tmp)){
		$chemin_elem = PATH_TMP.$file;
		if($file!="." && $file!=".." && fileatime($chemin_elem) > 1 && fileatime($chemin_elem) < (time()-10800))	rm($chemin_elem);
	}
	// Fichiers de sauvegarde à la racine de PATH_STOCK_FICHIERS (OLD)
	$dir_tmp = opendir(PATH_STOCK_FICHIERS);
	while($file = readdir($dir_tmp)){
		if(preg_match("/(\.sql|\.tar|\.zip)$/i",$file) && preg_match("/^(backup|bdd)/i",$file))		rm(PATH_STOCK_FICHIERS.$file);
	}
}


////	CONTROLE SI DES FICHIERS ONT BIEN ETE UPLODES
////
function control_upload()
{
	if(count(@$_FILES)>0){
		$uploads = false;
		foreach($_FILES as $file)	{  if($file["error"]==0)  $uploads=true;  }
		return $uploads;
	}
}


////	SUPPRESSION PHYSIQUE D'UN FICHIER / DOSSIER  (fonction recursive)
////
function rm($cible)
{
	$cible = trim($cible,"/");
	if(is_file($cible))		{ unlink($cible); }
	elseif(is_dir($cible))
	{
		$dir = opendir($cible);
		while($elem = readdir($dir)){
			if($elem!="." && $elem!="..")	rm($cible."/".$elem);
		}
		closedir($dir);
		@rmdir($cible);
		if(is_dir($cible))	@rename($cible,"trash");//force le suppr chez free..
	}
}


////	ON RECUPERE L'EXTENSION D'UN FICHIER (en minuscule)
////
function extension($nom_fichier)
{
	return strtolower(strrchr($nom_fichier,"."));
}


////	CHMOD RECURSIF
////
function chmod_recursif($chemin)
{
	$chemin = trim($chemin,"/");
	@chmod($chemin, 0775);
	if(is_dir($chemin))
	{
		$dir = opendir($chemin);
		while($file = readdir($dir)){
			if($file!="." && $file!="..")	chmod_recursif($chemin."/".$file);
		}
	}
}


////	HEADERS TELECHARGER FICHIER
////
function headers_telecharger_fichier($content_Type="application/octet-stream")
{
	header('Expires: 0');
	header('Pragma: public');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header("Cache-Control: private", false);
	header('Content-Description: File Transfer');
	header('Content-Transfer-Encoding: binary');
	header('Content-Type: '.$content_Type);
}


////	TELECHARGER UN FICHIER
////
function telecharger($nom_fichier, $chemin_fichier, $fichier_genere_volee=false, $exit=true)
{
	// Fichier présent dans stock_fichiers OU généré à la volée ($fichier_echo)
	if($fichier_genere_volee!=false || @is_file($chemin_fichier))
	{
		// Init
		modif_php_ini();
		$ext = extension($nom_fichier);
		// Type de fichier
		if(controle_fichier("word",$nom_fichier))			{ $content_type = "application/msword"; }
		elseif(controle_fichier("excel",$nom_fichier))		{ $content_type = "application/vnd.ms-excel"; }
		elseif(controle_fichier("powerpoint",$nom_fichier))	{ $content_type = "application/vnd.ms-powerpoint"; }
		elseif(controle_fichier("ootext",$nom_fichier))		{ $content_type = "application/vnd.oasis.opendocument.text"; }
		elseif(controle_fichier("oocalc",$nom_fichier))		{ $content_type = "application/vnd.oasis.opendocument.spreadsheet"; }
		elseif(controle_fichier("oopresent",$nom_fichier))	{ $content_type = "application/vnd.oasis.opendocument.presentation"; }
		elseif($ext==".pdf")	{ $content_type = "application/pdf"; }
		elseif($ext==".zip")	{ $content_type = "application/zip"; }
		elseif($ext==".txt")	{ $content_type = "text/plain;"; }
		elseif($ext==".rtf")	{ $content_type = "application/rtf;"; }
		elseif($ext==".mp3")	{ $content_type = "audio/mpeg"; }
		elseif($ext==".mp4")	{ $content_type = "video/mp4"; }
		elseif($ext==".avi")	{ $content_type = "video/avi"; }
		elseif($ext==".flv")	{ $content_type = "video/x-flv"; }
		elseif($ext==".ogv")	{ $content_type = "video/ogg"; }
		elseif($ext==".webm")	{ $content_type = "video/webm"; }
		else					{ $content_type = "application/octet-stream"; }
		// Headers (garder 4 premières lignes pour IE!)
		headers_telecharger_fichier($content_type);
		header("Content-Disposition: attachment; filename=\"".suppr_carac_spe($nom_fichier,"fichier_win")."\";");
		if(@is_file($chemin_fichier))	header("Content-Length: ".filesize($chemin_fichier));
		// Envoi de fichier généré à la volée  /  Envoi direct (< 40Mo)  /  Envoi par tranche de 2 Mo (> 40Mo)
		if($fichier_genere_volee!=false)			{ echo($fichier_genere_volee); }
		elseif(filesize($chemin_fichier)<41943040)	{ readfile($chemin_fichier); }
		else {
			$handle = fopen($chemin_fichier, "rb");
			while(!feof($handle))	{ print fread($handle, 2097152); }
			fclose($handle);
		}
		if($exit==true)  exit;
	}
}


////	GENERER ARCHIVE ZIP
////
function creer_envoyer_archive($tab_fichiers, $nom_archive)
{
	if(count($tab_fichiers)>0)
	{
		////	CREE FICHIER VIDE POUR LES DOSSIERS VIDES
		$fichier_vide = PATH_TMP.".void";
		$fp = fopen($fichier_vide,"w");
		fwrite($fp,"void");
		fclose($fp);

		////	AJOUT VIA LA CLASS PHP "ZipArchive"  (plus rapide mais pas installée par défaut)
		if(method_exists("ZipArchive","open")  &&  version_compare(PHP_VERSION,'5.2.0','>='))
		{
			require_once ROOT_PATH."fonctions/fichierzip.inc.php";
		}
		////	AJOUT VIA LA ZIPLIB
		else
		{
			////	AJOUT DES FICHIERS ET DOSSIERS A L'ARCHIVE
			require_once PATH_DIVERS."ziplib.php";
			$zip = new zipfile();
			$zip_size = 0;
			foreach($tab_fichiers as $elem)
			{
				$size_tmp = filesize($elem["path_source"]);
				if(is_dir($elem["path_source"])) {
					$zip->addfile($fichier_vide, $elem["path_zip"]."/.void");
				}
				elseif(is_file($elem["path_source"]) && $size_tmp > 0)
				{
					$fp = fopen($elem["path_source"], 'r');
					$content = fread($fp, $size_tmp);
					fclose($fp);
					$zip->addfile($content, $elem["path_zip"]);
					$zip_size += $size_tmp;
				}
			}
			$archive_tmp = $zip->file();
			////	ENVOI DU ZIP
			headers_telecharger_fichier("application/zip");
			header('Content-Disposition: attachment; filename="'.basename($nom_archive).'"');
			header('Content-Length: '.$zip_size);
			ob_clean();
			flush();
			echo $archive_tmp;
		}
		////	SUPPR LE FICHIER VIDE..
		unlink($fichier_vide);
	}
}


////	AJOUTER DES FICHIERS JOINT
////
function ajouter_fichiers_joint($obj_tmp, $id_objet)
{
	// Init
	global $trad;
	$espace_occupe = taille_stock_fichier(true);
	// Ajoute chaque fichier joint
	foreach($_FILES as $id_input_fichier => $fichier)
	{
		if(preg_match("/fichier_joint/i",$id_input_fichier))
		{
			////	 TAILLE DU FICHIER TROP IMPORTANT / PAS ASSEZ D'ESPACE DISQUE =>  ERREUR !
			if($fichier["error"]==1 || $fichier["error"]==2)					{  alert($trad["MSG_ALERTE_taille_fichier"]." : ".$fichier["name"]);  }
			elseif(($espace_occupe+$fichier["size"]) > limite_espace_disque)	{  alert($trad["MSG_ALERTE_espace_disque"]);  break;  }
			/////	FICHIER BIEN TELECHARGE
			elseif($fichier["error"]==0)
			{
				$espace_occupe += $fichier["size"];
				////	Ajoute le fichier dans la BDD & recupère l'id pour le nom réel
				$fichier["name"] = (function_exists("mb_strtolower"))  ?  mb_strtolower($fichier["name"],"UTF-8")  :  strtolower($fichier["name"]);
				db_query("INSERT INTO  gt_jointure_objet_fichier  SET nom_fichier=".db_format($fichier["name"]).", type_objet='".$obj_tmp["type_objet"]."', id_objet='".intval($id_objet)."'");
				$fichier_tmp = db_ligne("SELECT * FROM gt_jointure_objet_fichier WHERE id_fichier='".db_last_id()."'");
				////	Ajoute le fichier dans stock_fichiers
				$chemin_fichier = PATH_OBJECT_FILE.$fichier_tmp["id_fichier"].extension($fichier["name"]);
				move_uploaded_file($fichier["tmp_name"], $chemin_fichier);
				if(controle_fichier("image_gd",$chemin_fichier)==true)	reduire_image($chemin_fichier, $chemin_fichier, 1024, 1024, 85);
				chmod($chemin_fichier,0775);
				////	Ajoute l'image / vidéo / Mp3 dans la description
				if(isset($_POST["tab_add_fichier_joint"])  &&  in_array($id_input_fichier,$_POST["tab_add_fichier_joint"])  &&  controle_fichier("fichier_joint",$fichier["name"]))
				{
					$fichier_joint_html = db_valeur("SELECT description FROM ".$obj_tmp["table_objet"]." WHERE ".$obj_tmp["cle_id_objet"]."='".$id_objet."'") . insert_fichier_joint($fichier_tmp,false);
					db_query("UPDATE ".$obj_tmp["table_objet"]." SET description=".db_format($fichier_joint_html,"editeur,slash")." WHERE ".$obj_tmp["cle_id_objet"]."='".intval($id_objet)."'");
				}
			}
		}
	}
	taille_stock_fichier(true);// Recalcule $_SESSION["agora"]["taille_stock_fichier"]
}


////	INTEGRE UN FICHIER JOINT DANS LA DESCRIPTION D'UN ELEMENT
////
function insert_fichier_joint($fichier_tmp, $insertion_javascript=true)
{
	// INIT
	$resultat		= "";
	$nom_input		= "description";
	$width_limit	= "850px";
	$chemin_fichier	= PATH_OBJECT_FILE.$fichier_tmp["id_fichier"].extension($fichier_tmp["nom_fichier"]);
	////	IMAGE
	if(controle_fichier("image_browser",$chemin_fichier)==true) {
		$resultat = "<img src='".$chemin_fichier."' style='max-width:".$width_limit."' />";
	}
	////	MP3
	elseif(controle_fichier("mp3",$chemin_fichier)==true) {
		$resultat = "<object type='application/x-shockwave-flash' data='".PATH_COMMUN."dewplayer-mini.swf?mp3=".$chemin_fichier."' width='160' height='20'><param name='wmode' value='transparent' /><param name='movie' value='".PATH_COMMUN."dewplayer-mini.swf?mp3=".$chemin_fichier."' /></object>";
	}
	////	ANIMATION FLASH
	elseif(controle_fichier("flash",$chemin_fichier)==true) {
		$resultat = "<object type='application/x-shockwave-flash' data='".$chemin_fichier."' style='max-width:".$width_limit."'><param name='movie' value='".$chemin_fichier."' /></object>";
	}
	////	VIDEO
	elseif(controle_fichier("video_browser",$chemin_fichier)==true) {
		$resultat = str_replace("\"","'", afficher_video($chemin_fichier));
	}
	////	Retourne le résultat si besoin
	if($resultat!="") {
		if($insertion_javascript==true)		return " onClick=\"tinyMCE.get('".$nom_input."').setContent(tinyMCE.get('".$nom_input."').getContent() + '<br><br>".addslashes(str_replace("\"","'",$resultat))."'); afficher('block_".$nom_input."',true);\" ";
		else								return "<br><br>".$resultat;
	}
}


////	AFFICHE FICHIERS JOINTS ($affichage = popup  /  menu_element  /  normal)
////
function affiche_fichiers_joints($obj_tmp, $id_objet, $affichage)
{
	global $trad;
	$liste_fichiers_joint = db_tableau("SELECT * FROM gt_jointure_objet_fichier WHERE type_objet='".$obj_tmp["type_objet"]."' AND id_objet='".intval($id_objet)."'");
	if(count($liste_fichiers_joint)>0)
	{
		$retour_ligne = ($affichage=="menu_element")  ?  "<br>"  :  "";
		if($affichage=="popup")		{ echo "<br><br><div style='position:fixed;bottom:0px;width:100%;text-align:center;".STYLE_FOND_OPAQUE."'><hr />"; }
		else						{ echo "<hr style='margin-top:15px' />"; }
		foreach($liste_fichiers_joint as $fichier_joint_tmp)	{ echo "<span onclick=\"redir('".PATH_DIVERS."fichier_joint_telecharger.php?id_fichier=".$fichier_joint_tmp["id_fichier"]."&module_path=".MODULE_PATH."');\" class='lien' ".infobulle($trad["telecharger"])."><img src=\"".PATH_TPL."divers/telecharger.png\" /> ".$fichier_joint_tmp["nom_fichier"]."</span> &nbsp;".$retour_ligne; }
		if($affichage=="popup")		echo "</div>";
	}
}


////	SUPPRIME FICHIER JOINT
////
function suppr_fichier_joint($id_fichier, $nom_fichier)
{
	if($id_fichier > 0) {
		db_query("DELETE FROM gt_jointure_objet_fichier WHERE id_fichier='".intval($id_fichier)."'");
		rm(PATH_OBJECT_FILE.$id_fichier.extension($nom_fichier));
		taille_stock_fichier(true);// Recalcule $_SESSION["agora"]["taille_stock_fichier"]
	}
}


////	AFFICHER VIDEO
////
function afficher_video($chemin_fichier, $width="800px", $height="450px")
{
	// INIT
	global $trad;
	$afficher_video = "<style> .player_video { width:".$width."; height:".$height."; margin:auto; ".STYLE_SHADOW." }  </style>";

	////	VIDEO WMV ou AVI  /  VIDEO WEBM  /  AUTRE FORMAT VIDEO (VIA JWPLAYER)
	////
	if(controle_fichier("video_wmv_avi",$chemin_fichier))
	{
		$afficher_video .= "<object name='Player' id='video_wmv_avi' class='player_video' type='application/x-oleobject' standby='Loading...'>";
			$afficher_video .= "<param name='FileName' value=\"".$chemin_fichier."\" />";
			$afficher_video .= "<embed type='application/x-oleobject' src=\"".$chemin_fichier."\" name='MediaPlayer' wmode='transparent' class='player_video' ShowControls='1' autostart='1'></embed>";
		$afficher_video .= "</object>";
	}
	elseif(controle_fichier("video_webm",$chemin_fichier))
	{
		$afficher_video .= "<video class='player_video' controls='controls' autoplay='autoplay'>";
			$afficher_video .= "<source src=\"".$chemin_fichier."\" type='video/webm' />";
			$afficher_video .= "HTML5 is not supported by your browser / HTML5 n'est pas pris en charge par votre navigateur";
		$afficher_video .= "</video>";
	}
	elseif(controle_fichier("video_browser",$chemin_fichier))
	{
		$flashvars = "file=../".$chemin_fichier."&amp;skin=".PATH_DIVERS."video/jwplayer_glow.zip&amp;autostart=true&amp;stretching=uniform&amp;controlbar.position=over&amp;viral.onpause=false&amp;viral.allowmenu=false&amp;viral.oncomplete=false&amp;viral.embed=false";
		$afficher_video .= "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'  class='player_video' id='video_jwplayer' name='video_jwplayer'>";
			$afficher_video .= "<param name='movie' value=\"".PATH_DIVERS."video/jwplayer.swf\">";
			$afficher_video .= "<param name='allowfullscreen' value='true'>";
			$afficher_video .= "<param name='allowscriptaccess' value='always'>";
			$afficher_video .= "<param name='flashvars' value=\"".$flashvars."\">";
			$afficher_video .= "<embed id='video_jwplayer' name='video_jwplayer' src=\"".PATH_DIVERS."video/jwplayer.swf\" class='player_video' allowscriptaccess='always' allowfullscreen='true' flashvars=\"".$flashvars."\" />";
		$afficher_video .= "</object>";
	}
	return $afficher_video;
}


////	NOM DU FICHIER REDUIT  (exple : "nom_super_super...long.png")
////
function nom_fichier_reduit($nom_fichier, $longueur_ligne=25, $longueur_max=50)
{
	// Réduction =>  X premiers caractères...10 derniers caractères
	if(strlen($nom_fichier) > $longueur_max)	$nom_fichier = substr($nom_fichier,0,($longueur_max-13))."...".substr($nom_fichier,-10);
	// Fait des retours à la ligne ?
	if(strlen($nom_fichier) > $longueur_ligne)	$nom_fichier = wordwrap($nom_fichier, $longueur_ligne, "<br>", true);
	// Renvoi le résultat
	return $nom_fichier;
}


////	MODIF DU FICHIER CONFIG.INC.PHP
////
function modif_fichier_config($fichier_config, $tab_const_modif=array(), $tab_const_suppr=array(), $tab_const_ajout=array())
{
	// Test si le fichier est accessible en écriture
	if(!is_file($fichier_config))			{ alert("config.inc.php : no access"); exit(); }
	elseif(!is_writable($fichier_config))	{ alert("config.inc.php : no write access"); exit(); }
	else
	{
		// Init
		$config_tab = file($fichier_config);
		if(count($config_tab)>1)
		{
			// Lecture de chaque ligne du fichier
			foreach($config_tab as $id_ligne => $ligne)
			{
				if(preg_match("/limite_nb_utils/i",$ligne))		$config_tab[$id_ligne] = str_replace("limite_nb_utils","limite_nb_users",$ligne);
				// Ligne courante dans le tableau de modif => modifie la ligne
				foreach($tab_const_modif as $id_constante => $valeur_constante)
				{
					if(preg_match("/".$id_constante."/i",$ligne)){
						if($valeur_constante!="true" && $valeur_constante!="false")  $valeur_constante = "\"".$valeur_constante."\"";
						$config_tab[$id_ligne] = "define(\"".$id_constante."\", ".$valeur_constante.");\n";
					}
				}
				// Ligne courante doit être effacée ?
				foreach($tab_const_suppr as $id_constante){
					if($id_constante!="" && $ligne!="" && preg_match("/".$id_constante."/i",$ligne))	$config_tab[$id_ligne] = "";
				}
			}
			// Ajout des lignes si besoin
			foreach($tab_const_ajout as $id_constante => $valeur_constante)
			{
				// Vérifie si la ligne n'est pas déjà présente & recupère la fin du fichier
				$ligne_presente = $id_ligne_fin = false;
				foreach($config_tab as $id_ligne => $ligne){
					if(preg_match("/".$id_constante."/i",$ligne))  $ligne_presente = true;
					if(preg_match("/\?>/i",$ligne))  $id_ligne_fin = $id_ligne;
				}
				if($ligne_presente==false){
					if($valeur_constante!="true" && $valeur_constante!="false")  $valeur_constante = "\"".$valeur_constante."\"";
					$config_tab[$id_ligne_fin] = "define(\"".$id_constante."\", ".$valeur_constante.");\n".$config_tab[$id_ligne_fin];
				}
			}
			// On remplace le contenu du fichier
			$contenu_config = implode("", $config_tab);
			$fp = fopen($fichier_config, "w");
			fwrite($fp, $contenu_config);
			fclose($fp);
		}
	}
}
?>