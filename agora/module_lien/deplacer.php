<?php
////	INIT
require "commun.inc.php";

////	ON DEPLACE PLUSIEURS ELEMENTS
foreach(SelectedElemsArray("lien") as $id_lien)				{ deplacer_lien($id_lien, $_POST["id_dossier"]); }
foreach(SelectedElemsArray("lien_dossier") as $id_dossier)	{ deplacer_lien_dossier($id_dossier, $_POST["id_dossier"]); }

////		DECONNEXION À LA BDD & FERMETURE DU POPUP
reload_close();
?>