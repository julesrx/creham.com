<?php
//////////////////////////////////////////////////////////////////////////////////////////////
// 	Adresse du calendrier: http://[adresse_agora]/webcal/[identifiant_utilisateur]/     //
//////////////////////////////////////////////////////////////////////////////////////////////

// 	G�N�RATION DU CONTENU DU FICHIER ICS
$cat_affichee=$_GET['cat']; // Avant, on sauvegarde la s�lection de cat�gorie � afficher
unset($_GET['cat']); // On d�sactive temporairement la cat�gorie s�lectionn�e, pour que tous les evts soient pris en compte

$agenda_tmp=$AGENDAS_AFFICHES[$id_agenda];
$liste_evenements = liste_evenements($agenda_tmp["id_agenda"], (time()-(86400*30)), (time()+(86400*3650))); // T-30jours => T+10ans
$fichier_ical = fichier_ical($liste_evenements);

$_GET['cat']=$cat_affichee; // Maintenant on r�tabli la cat�gorie s�lectionn�e, pour l'affichage des agendas suivants.


//// 	OBTENTION DES INFOS DU PROPRI�TAIRE DU CALENDRIER
$agenda_infosutilisateur = db_ligne("SELECT * FROM gt_utilisateur WHERE id_utilisateur='".$agenda_tmp["id_utilisateur"]."'");


////	CR�ATION DU DOSSIER DE L'UTILISATEUR PROPRI�TAIRE (si inexistant)
$chemin_dossier = "../webcal/".$agenda_infosutilisateur["identifiant"]."";
if (!file_exists($chemin_dossier)) 
	{ mkdir("$chemin_dossier", 0700); }


//// 	PROTECTION DU DOSSIER
$htaccess_file = realpath("$chemin_dossier")."/.htaccess";

// Cr�ation du fichier .htaccess
$htaccess_content  = 'Deny from all'."\n";
//$htaccess_content .= '<Files ~ "\.(ics)$">'."\n";
//$htaccess_content .= 'Deny from all'."\n";
//$htaccess_content .= '</Files>'."\n";
$fp = fopen($htaccess_file, "w");
fwrite($fp, $htaccess_content);
fclose($fp);


////	G�N�RATION DU FICHIER ICAL
$nom_fichier = "calendar.ics";
// Cr�ation du fichier ical
$fichier_tmp = "$chemin_dossier/$nom_fichier";
if(file_exists($fichier_tmp)) 
	{ unlink($fichier_tmp); }

$fp = fopen($fichier_tmp, "w");
fwrite($fp, $fichier_ical);
fclose($fp);


?>
