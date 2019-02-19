<?php
function debug($content){
	global $CFG, $nbSQL;	
	if ($CFG->debug) echo "<!-- nbSQL = ".$nbSQL++."**************\n $content \n**************\n\n -->";	
//	if ($CFG->debug) echo "**************\n $content \n**************\n\n<br/>";	
}
// stockage d'un objet sérialisé dans la session
function objDansSession($nomObj, $obj) {
         debug( "ObjDansSession : $nomObj");
//         echo "ObjDansSession : $nomObj => ";
//         print_r($obj);
         $_SESSION[$nomObj] = serialize($obj);                               
}

// stockage d'un objet sérialisé dans la session
function objDepuisSession($nomObj) {
//	print_r($_SESSION);
	debug( "objDepuisSession : $nomObj");
    if (array_key_exists($nomObj, $_SESSION)){
			$obj = unserialize( $_SESSION[$nomObj]);
    } else {
        	$obj = false;	
    }        
//    print_r($obj);
    return $obj;
}

// verifie sur l'utilisateur est administrateur
function checkAdmin() {
	global $currentUser;
//	print_r($currentUser);
	if (in_array($currentUser->grp_id, array(1, 2, 3, 4))) 
		return true;
	else {
		// d�connexion et retour login
		header('location: gestion.php?ob=logout');
	}
}

// génération d'un mot de passe aléatoire
function generePassword($size, $isNum=0, $isReadable = 1) {
    // Initialisation des caractères utilisables
    $undeux = array(1, 2);
    $charactersC = array("a", "e", "i", "u", "y");
    $charactersV = array("b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "q", "r", "s", "t", "v", "w", "x", "z");
    $characters = array_merge($charactersV, $charactersC);        	
    $num = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
    $password = '';
    $nb = 0;
//    if ($isNum != 0) $size = $size - $isNum;
// 	alternance voyelle consonne en premier
    $pair = array_rand($undeux);    
    for($i=0;$i<$size;$i++)  {
        if ($isNum) $password .= $num[array_rand($num)];
        elseif ($isReadable) {

        	if ($pair) $password .= ($i%2) ? $charactersV[array_rand($charactersV)] : $charactersC[array_rand($charactersC)];
        	else $password .= ($i%2) ? $charactersC[array_rand($charactersC)] : $charactersV[array_rand($charactersV)];
        } else {
        	$password .= $characters[array_rand($characters)];
        }
        //$password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
		
    return $password;
}

function shuffle_assoc($list) { 
  if (!is_array($list)) return $list; 

  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array(); 
  foreach ($keys as $key) 
    $random[$key] = $list[$key]; 

  return $random; 
} 


function getListeTheme() {
	global $tpl;
	$elt = new Theme();
	$lElt = $elt->getList(false,'th_ordre ASC');
	if (sizeof($lElt) != 0) {
		foreach ($lElt as $cElt) {
			$options[$cElt->th_id] = $cElt->th_titre_fr;
		}
	} else {
		$options[0] = 'Auncun thème d&eacute;fini';
	}
	$tpl->assign('theme_options', $options);
}
function getListeRubrique() {
	global $tpl;
	$elt = new Rubrique();
	$lElt = $elt->getList(false,'rub_type ASC, rub_ordre ASC');
	if (sizeof($lElt) != 0) {
		foreach ($lElt as $cElt) {
			$options[$cElt->rub_id] = $cElt->rub_lib;
		}
	} else {
		$options[0] = 'Auncune rubrique d&eacute;finie';
	}
	$tpl->assign('rubrique_options', $options);
}

function getListeSite() {
	global $tpl, $currentUser;
	$elt = new Site();
	$clause = false; // tout
	
	$lElt = $elt->getList($clause,'site_id ASC');
	if (sizeof($lElt) != 0) {
		$options[0] = '>> site';
		foreach ($lElt as $cElt) {
			$options[$cElt->site_id] = $cElt->site_lib;
		}
	} else {
		$options[0] = 'Auncun site d&eacute;fini';
	}
	
	$tpl->assign('site_options', $options);
}

function getListeTag($site_id) {
	global $tpl ;
	$elt = new Tag();
	$clause = array('t.site_id = ?' => $site_id);
	
	$lElt = $elt->getList($clause,'tag_lib ASC');
	if (sizeof($lElt) != 0) {
		$options[0] = '>> mot-clé';
		foreach ($lElt as $cElt) {
			$options[$cElt->tag_id] = $cElt->tag_lib;
		}
	} else {
		$options[0] = 'Auncun mot-clé d&eacute;fini';
	}
	$tpl->assign('tag_options', $options);
}

// construit la liste des Groupes
function getListeGroupe() {
	global $tpl;
	$elt = new Groupe();
	$lElt = $elt->getList(false,'t.grp_id ASC');
	if (sizeof($lElt) != 0) {
		foreach ($lElt as $cElt) {
			$options[$cElt->grp_id] = $cElt->grp_lib;
		}
	} else {
		$options[0] = 'Auncun groupe d&eacute;fini';
	}
	$tpl->assign('groupe_options', $options);
}

function getListeRegion() {
	global $tpl;
	$elt = new Region();
	$lElt = $elt->getList(false,'t.region_lib ASC');
	if (sizeof($lElt) != 0) {
		foreach ($lElt as $cElt) {
			$options[$cElt->region_id] = utf8_encode($cElt->region_lib);
		}
	} else {
		$options[0] = 'Auncune region d&eacute;finie';
	}
	$tpl->assign('region_options', $options);
}

function getListeDepartement() {
	global $tpl;
	$elt = new Departement();
	$lElt = $elt->getList(false,'t.dpt_ordre ASC');
	if (sizeof($lElt) != 0) {
		foreach ($lElt as $cElt) {
			$options[$cElt->dpt_id] = $cElt->dpt_num.' - '.utf8_encode($cElt->dpt_lib);
		}
	} else {
		$options[0] = 'Auncun département d&eacute;fini';
	}
	$tpl->assign('dept_options', $options);
}

function getListeCategorie() {
	global $tpl;
	$elt = new Categorie();
	$lElt = $elt->getList(false,'cat_ordre ASC');
	if (sizeof($lElt) != 0) {
		foreach ($lElt as $cElt) {
			$options[$cElt->cat_id] = $cElt->cat_lib;
		}
	} else {
		$options[0] = 'Auncune catégorie d&eacute;finie';
	}
	$tpl->assign('categorie_options', $options);
}
function getListeBassin() {
	global $tpl, $curSid;
	$elt = new Bassin();
	$lElt = $elt->getList( (empty($curSid) ? false : array('site_id = ?' => $curSid)) ,'bas_ordre ASC');
	if (sizeof($lElt) != 0) {
		foreach ($lElt as $cElt) {
			$options[$cElt->bas_id] = $cElt->bas_lib;
		}
	} else {
		$options[0] = 'Auncun bassin d&eacute;finie';
	}
	$tpl->assign('bassin_options', $options);
}
// récupère la liste des professions 
function getListeProfession () {
	global $tpl, $profession_options;
	$profession_options = array("A choisir dans la liste", "Administratif","Aides-soignantes, auxiliaires de puériculture et ambulanciers","Assistant de service social","Assistants maternels et assistants familiaux","Audioprothésiste","Autres professionnels des domaines sanitaire et social","Autres professionnels hors des domaines sanitaire et social","Chiropracteur","Chirurgien-Dentiste","Diététicien","Dirigeants des ES sanitaires et sociaux, représentants légaux de personne morale","Educateurs et aides familiaux","Ergothérapeute","Infirmier","Manipulateur d'électroradiologie médicale","Masseur-kinésithérapeute","Médecin","Opticien-lunetier","Orthésiste pour l'appareillage des personnes handicapées","Orthophoniste","Orthoptiste","Ostéopathe","Particuliers accueillant des personnes âgées ou handicapées","Pédicure-Podologue","Personnels d'établissements sanitaires et sociaux","Personnels pédagogiques occasionnels des accueils collectifs de mineurs, permanents des lieux de vie","Pharmacien","Préparateurs en pharmacie","Préparateurs en pharmacie hospitalière","Prothésiste pour l'appareillage des personnes handicapées","Psychologue","Psychomotricien","Psychothérapeute","Sage-femme","Technicien de laboratoire médical","Transporteurs sanitaires");
	sort($profession_options);
	$tpl->assign('profession_options', $profession_options);
}
// récupère la liste des spécialités 
function getListeSpecialite () {
	global $tpl, $spec_options;
	$spec_options = array("A choisir dans la liste", "AIDE MEDICALE URGENTE OU MEDECINE D'URGENCE","CHIRURGIE UROLOGIQUE","ENDOCRINOLOGIE ET METABOLISMES","EVALUATION ET TRAITEMENT DE LA DOULEUR","CHIRURGIE DE LA FACE ET DU COU","GYNECOLOGIE MEDICALE ET OBSTETRIQUE","DERMATOLOGIE ET VENEREOLOGIE","ANATOMIE ET CYTOLOGIE PATHOLOGIQUES","CHIRURGIE ORTHOPEDIQUE ET TRAUMATOLOGIQUE","GERIATRIE / GERONTOLOGIE","FOETOPATHOLOGIE","BIOCHIMIE HORMONALE ET METABOLIQUE","ADDICTOLOGIE / TOXICOMANIES ET ALCOOLOGIE","CANCEROLOGIE","ANGEIOLOGIE / MEDECINE VASCULAIRE","ACUPUNCTURE","CHIRURGIE GENERALE","CHIRURGIE MAXILLO-FACIALE ET STOMATOLOGIE","BIOLOGIE MEDICALE","BIOLOGIE MOLECULAIRE","CYTOGENETIQUE HUMAINE","GENETIQUE MEDICALE","ANDROLOGIE","GYNECOLOGIE MEDICALE","GASTRO-ENTEROLOGIE ET HEPATOLOGIE","ALLERGOLOGIE","CHIRURGIE PLASTIQUE, RECONSTRUCTRICE ET ESTHETIQUE","CHIRURGIE THORACIQUE ET CARDIO-VASCULAIRE","CHIRURGIE INFANTILE","CHIRURGIE VASCULAIRE","BIOLOGIE DES AGENTS INFECTIEUX","CHIRURGIE VISCERALE ET DIGESTIVE","ANESTHESIE-REANIMATION","CARDIOLOGIE ET MALADIES VASCULAIRES","DERMATOPATHOLOGIE","AUTRES","BIOLOGIE","CADRE ADMINISTRATIF","DIRECTEUR","DIRECTEUR ADJOINT","DISTRIBUTION","GYNECOLOGIE-OBSTETRIQUE / OBSTETRIQUE","HEMATOLOGIE","HEMATOLOGIE BIOLOGIQUE","HEMATOLOGIE OPTION MALADIES DU SANG","HEMATOLOGIE OPTION ONCO-HEMATOLOGIE","HEMOBIOLOGIE-TRANSFUSION / TECHNOLOGIE TRANSFUSIONNELLE","HOPITAL","HYDROLOGIE ET CLIMATOLOGIE MEDICALE","IMMUNOLOGIE ET IMMUNOPATHOLOGIE","INDUSTRIE","INFIRMIER ANESTHESISTE","INFIRMIER CADRE DE SANTE","INFIRMIER COORDINATEUR DE SOIN","INFIRMIER COORDINATEUR EN EHPAD","INFIRMIER D'ACCUEIL ET D'ORIENTATION","INFIRMIER DE BLOC OPERATOIRE","INFIRMIER DE LABORATOIRE","INFIRMIER DE L'EDUCATION NATIONALE","INFIRMIER DE PREMIERS RECOURS","INFIRMIER DE SANTE AU TRAVAIL","INFIRMIER DE SANTE PUBLIQUE","INFIRMIER DIPLOME D'ETAT","INFIRMIER DIPLOME D'ETAT","INFIRMIER DIRECTEUR DE SOIN","INFIRMIER EN PSYCHIATRIE","INFIRMIER EN SOINS INTENSIFS ET REANIMATION","INFIRMIER EXPERT EN CANCEROLOGIE","INFIRMIER EXPERT EN DIABETOLOGIE","INFIRMIER EXPERT EN DOULEUR","INFIRMIER EXPERT EN ENDOSCOPIE","INFIRMIER EXPERT EN NEPHROLOGIE ET DIALYSE","INFIRMIER EXPERT EN REEDUCATION ET READAPTATION","INFIRMIER EXPERT EN SOINS PALLIATIFS","INFIRMIER EXPERT EN TABACOLOGIE","INFIRMIER EXPERT EN UROLOGIE","INFIRMIER EXPERT HYGIENISTE","INFIRMIER FORMATEUR","INFIRMIER PRESTATAIRE DE SANTE","INFIRMIER RECHERCHE CLINIQUE","INFIRMIER SAPEUR-POMPIER","INFIRMIER SPECIALISTE CLINIQUE","INFIRMIER STOMATHERAPEUTE","INFIRMIERE PUERICULTRICE","INFORMATICIEN","INGENIEUR","MEDECINE AEROSPATIALE","MEDECINE DE CATASTROPHE","MEDECINE DE LA DOULEUR ET MEDECINE PALLIATIVE","MEDECINE DE LA REPRODUCTION","MEDECINE DE LA REPRODUCTION ET GYNECOLOGIE MEDICALE","MEDECINE DU SPORT","MEDECINE DU TRAVAIL","MEDECINE GENERALE","MEDECINE INTERNE","MEDECINE LEGALE ET EXPERTISES MEDICALES","MEDECINE NUCLEAIRE","MEDECINE PENITENTIAIRE","MEDECINE PHYSIQUE ET DE READAPTATION","NEONATOLOGIE","NEPHROLOGIE","NEUROCHIRURGIE","NEUROLOGIE","NEUROLOGIE ET PSYCHIATRIE","NEUROPATHOLOGIE","NUTRITION","ONCOLOGIE OPTION MEDICALE","ONCOLOGIE OPTION ONCO-HEMATOLOGIE","ONCOLOGIE OPTION RADIOTHERAPIE","OPHTALMOLOGIE","OPHTALMOLOGIE ET OTO-RHINO-LARYNGOLOGIE","ORL et CHIRUGIE CERVICO-FACIALE","ORTHOPEDIE DENTO-MAXILLO-FACIALE","OTO-RHINO-LARYNGOLOGIE","PATHOLOGIE INFECTIEUSE ET TROPICALE, CLINIQUE ET BIOLOGIQUE","PEDIATRIE","PHARMACIE","PHARMACOCINETIQUE ET METABOLISME DES MEDICAMENTS","PHARMACOLOGIE CLINIQUE ET EVAL.DES THERAPEUTIQUES","PHONIATRIE","PNEUMOLOGIE","PRATIQUES MEDICO JUDICIAIRES","PSYCHIATRIE","PSYCHIATRIE DE L'ENFANT ET DE L'ADOLESCENT","RADIO-DIAGNOSTIC ET IMAGERIE MEDICALE","RADIO-DIAGNOSTIQUE ET RADIO-THERAPIE","RADIOPHARMACIE ET RADIOBIOLOGIE","REANIMATION MEDICALE","RECHERCHE MEDICALE","RHUMATOLOGIE","SAGE-FEMME DE PMI","SAGE-FEMME HOPITALIERE","SAGE-FEMME LIBERALE","SAGE-FEMME SALARIEE D'UN ETABLISSEMENT PRIVE","SANTE PUBLIQUE ET MEDECINE SOCIALE","SECRETAIRE","SPECIALITE SANS QUALIFICATION","STOMATOLOGIE","TOXICOLOGIE BIOLOGIQUE");
	$tab = array_map('strtolower', $spec_options);
	$spec_options = array_map('ucfirst', $tab);
	sort($spec_options);
	$tpl->assign('specialite_options', $spec_options);
}

// récupère la liste des status Contrib 
function getListeStatusContrib () {
	global $tpl;
	$status_options = array('1'=> 'Validée', '0'=>'Hors ligne', '2' => 'A valider');
	$tpl->assign('statusContrib_options', $status_options);
}
// récupère la liste des status 
function getListeStatus () {
	global $tpl;
	$status_options = array('1'=> 'En ligne', '0'=>'Hors ligne');
	$tpl->assign('status_options', $status_options);
}

function getListeTypeRubrique () {
	global $tpl;
	$status_options = array('1'=> 'Public', '2'=>'Locataires');
	$tpl->assign('type_options', $status_options);
}

function getListeTypeBloc () {
	global $tpl;
	$status_options = array('1'=> 'HTML', '2'=>'fonction PHP');
	$tpl->assign('bloc_options', $status_options);
}

function getListePosition () {
	global $tpl;
	$status_options = array('d'=> 'Droite');
	$tpl->assign('position_options', $status_options);
}

// récupère la liste des status User
function getListeStatusUser () {
	global $tpl;
	$status_options = array(3 => 'non activé', 2 => 'activé', 1 => 'vérifié', 0 => 'bloqué', '4' => 'supprimé');
	$tpl->assign('statusUser_options', $status_options);
}

function getListeOuiNon () {
	global $tpl;
	$status_options = array("Oui" => "Oui", "Non" => "Non");
	$tpl->assign('ouinon_options', $status_options);
}
// récupère la liste des civilites 
function getListeCivilite () {
	global $tpl;
	$civilite_options = array('Mme'=> 'Mme', 'Melle'=>'Melle', 'M' => 'M');
	$tpl->assign('civilite_options', $civilite_options);
}

function upload($photo, $photo_old, $path, $tabInfo, $isDel = TRUE) {
	global $_FILES, $_POST, $CFG;
//	print_r($_FILES);
	$options = array('resizeUp' => true, 'jpegQuality' => 100);
	
	if (isset($_POST[$photo_old])) $art_photo_old = $_POST[$photo_old];
	else $art_photo_old = '';
	if(isset($_FILES[$photo]['name']) && $_FILES[$photo]['name'] != ""){
			
		$fname = $_FILES[$photo]['name'];
		$ftype = $_FILES[$photo]['type'];
		$fsize = $_FILES[$photo]['size'];
		$ftemp = $_FILES[$photo]['tmp_name'];
		$art_photo =  $fname;
		
		if (move_uploaded_file($ftemp, $path.$art_photo ) || is_file($path.$art_photo)) {			
			$lName = explode('.', $art_photo);
			$iName = array_reverse($lName);
			$extension = strtolower(array_shift($iName));
			$newName = time().".".$extension;		
			rename($path.$art_photo, $path.$newName);
			
			$art_photo = $newName;
			
			try {
     			$thumb = PhpThumbFactory::create($path.$art_photo, $options);     			
			} catch (Exception $e){
		     	// handle error here however you'd like
		     	echo "erreur :".$e->getMessage();
			}
			// recadrage selon param
			foreach ($tabInfo as $prefix=>$lSize) {
//				print_r($thumb->getCurrentDimensions()); exit;
				$dim = $thumb->getCurrentDimensions();
				if (empty($lSize[0])) { // pas de largeur définie
					$lSize[0] = $dim['width']*$lSize[1] / $dim['height'];
				}
				if (empty($lSize[1])) { // pas de hauteur définie
					$lSize[1] = $dim['height']*$lSize[0] / $dim['width'];
				}
				
				$thumb->adaptiveResize(ceil($lSize[0]), ceil($lSize[1]));
				$thumb->save($path.$prefix.$art_photo);		
			}
			if ($isDel) unlink($path.$art_photo);
		} else 
			$art_photo = '';	
	} elseif ($art_photo_old != '')
		$art_photo = $art_photo_old;
	else
		$art_photo = '';
	
	return $art_photo;
}

function uploadFile($photo, $photo_old, $path, $time = '') {
	global $_FILES, $_POST, $CFG;
//	print_r($_FILES);
	
	if (isset($_POST[$photo_old])) $art_photo_old = $_POST[$photo_old];
	else $art_photo_old = '';
	if(isset($_FILES[$photo]['name']) && $_FILES[$photo]['name'] != ""){
			
		$fname = $_FILES[$photo]['name'];
		$ftype = $_FILES[$photo]['type'];
		$fsize = $_FILES[$photo]['size'];
		$ftemp = $_FILES[$photo]['tmp_name'];
		$art_photo =  $fname;
	
		if (move_uploaded_file($ftemp, $path.$art_photo ) || is_file($path.$art_photo)) {		
			$lName = explode('.', $art_photo);
			$iName = array_reverse($lName);
			$extension = strtolower(array_shift($iName));
			if (empty($time)) $time = time();
			$newName = $time.".".$extension;		
			rename($path.$art_photo, $path.$newName);
			
			$art_photo = $newName;
		} else 
			$art_photo = '';	
	} elseif ($art_photo_old != '')
		$art_photo = $art_photo_old;
	else
		$art_photo = '';
	
	return $art_photo;
}

// fonction de léger cryptage d'un id selon fonction bijective
function encrypt($id) {
	$val = 1287954*$id + 15698;
	return $val;
}

// fonction de léger décryptage d'un id selon fonction bijective
function decrypt($val) {
	$id = ($val - 15698) / 1287954;
	return $id;
}

function prepare_mail($body, $usr_id = false, $nl_id = false)
{
	global $tpl, $lTpl, $CFG;
		
	if ($usr_id) $code = sha1(time().@$usr_id.@$nl_id);
	else $code = false;
	
	$tpl->assign(array('code' => $code, 'content' => $body));
	
	return $tpl->fetch('commun/tpl/mail.tpl');
}

// fonction qui supprime les nouvelles lignes et les retours chariots
function nettoieNl($string) {
	return str_replace(chr(13), ' ',str_replace(chr(10), ' ',$string));
}

// fonction d'envoi d'un email
function envoie_mail($from, $fromName, $sujet, $body, $dest_mail, $toProcessed= false, $pj_file = false, $pj_name = false, $cci_mail = '', $notif='', $replyTo='') { 
	global $CFG, $tpl;
	
	if ($toProcessed) // on stocke le mail pour l'envoyer en asynchrone
	{
		$p = new ProcessMail();
		
		return $p->save('id', array(
			'id' => null, 
			'usr_id' => @$toProcessed['usr_id'], 
			'nl_id' => @$toProcessed['nl_id'], 
			'dest_mail' => $dest_mail, 
			'sujet' => $sujet, 
			'corps' => prepare_mail($body, @$toProcessed['usr_id'], @$toProcessed['nl_id']), 
			'pj_file' => $pj_file, 
			'pj_name' => $pj_name, 
			'code' => sha1(time().@$toProcessed['usr_id'].@$toProcessed['nl_id']), 
			'src_mail' => $from, 
			'src_nom' => $fromName, 
			'date_envoi' => time(), 
			'erreur' => null));
	}
	else // envoi synchrone 
	{
		
		$mail = new phpmailer();	
		$mail->IsHTML(true);
		$mail->IsMail();
		$mail->From = $from;
		$mail->FromName = $fromName;
		$mail->Subject = stripslashes($sujet);
		if ($notif != '') $mail->AddCustomHeader('Disposition-Notification-To: '.$notif.'');
		if ($replyTo != '') $mail->AddReplyTo($replyTo);
		
		// prépare le mail si pas déjà fait
		if (preg_match('/DOCTYPE/i', $body)) $mail->Body = $body; // déjà fait
		else $mail->Body = prepare_mail($body) ;
	
		if ($cci_mail != '') $mail->AddBCC($cci_mail);
	  	// PJ
	  	if ($pj_file) $mail->AddAttachment($pj_file, $pj_name, 'base64','application/octet-stream');
		
		if (is_array($dest_mail)){
			foreach($dest_mail as $destMail){
				$mail->AddAddress($destMail);
				$isSent = $mail->send(); 
	  			$mail->ClearAddresses();	
			}
		}		
		else 
		{
			$mail->AddAddress($dest_mail);
			$isSent = $mail->send(); 
	  		$mail->ClearAddresses();
		}
		
		return $isSent;	
	}
}

function date_fr_to_timestamp($date_fr) {
	if($date_fr != '') {
		$tab_date=explode(" ",$date_fr);  // date & heure       
	        list($d, $m, $y) = explode('/', $tab_date[0], 3);
	        if (!empty($tab_date[1]))
	        	@list($h, $i, $s) = explode(':', $tab_date[1], 3);
	        else $h = $i = $s = 0;
	        $date_timestamp = mktime($h, $i, $s, $m, $d, $y);
	} else {
		$date_timestamp = '';
	}
//	echo $date_timestamp;
	return ($date_timestamp);
}

// retourne les metas
// retourne les metas
function getMeta()
{
	global $meta, $CFG, $tpl, $site;

	switch ($meta['type'])
	{		
		case 'categ':
			$title = 'Conseils pratiques : '.$meta['elt']->cat_lib;
			$desc = 'Conseils pratiques : '.$meta['elt']->cat_lib;
			break;
		case 'page':
			$title = $meta['elt']->pg_titre;
			$desc = substr(strip_tags($meta['elt']->pg_contenu), 0, 200);
			break;
		case 'rubrique':
			$title = $meta['elt']->rub_lib;
			$desc = $meta['elt']->rub_lib;
			break;
		case 'static':
			$title = $meta['elt']['title'];
			$desc = $meta['elt']['desc'];
			break;
		default:
			$title = $site->site_info['site_title'];
			$desc = $site->site_info['site_desc'];
			break;
	}
		
	$tpl->assign('meta', $meta['elt']);
	
	echo "<title>".strip_tags($title)."</title>
<meta name=\"description\" content=\"".strip_tags($desc)."\"/>";
}

function MakeLienHTML ($params) {
	$lib = $params['lib'];

	echo stringToUrl($lib).'-'.$params['type'].'-'.$params['id'];
}

function stringToUrl($string) {
		// MAJUSCULE
 
		$sIn = mb_strtoupper($string , "UTF-8");
		// SUPPRIME LES ACCENTS
		$sIn = str_replace(    Array('Â','Ä','À','Ç','È','É','Ê','Ë','ŒÎ','Ï','Ô','Ö','Ù','Û','Ü'),
                                       Array('A','A','A','C','E','E','E','E','I','I','O','O','U','U','U' ),$sIn );
		// SUPPRIME TOUT CE QUI N'EST PAS UNE LETTRE OU UN TIRRET
		$sIn = preg_replace('`[^A-Z[:space:]\'0-9-]`', '', $sIn);
		// REMPLACE LES ESPACE
		$sIn = preg_replace('`[[:space:]\']{1,}`', '-', trim($sIn));
 
 
		// SUPPRIME LETTRES REPETES
		//$sIn = preg_replace( '`(.)\1`', '$1', $sIn );
		// TEST SUR TIRET EN FIN DE CHAINE
		if($sIn{strlen($sIn)-1} == "-" ) $sIn = substr($sIn, 0, strlen($sIn)-1);
		// MINUSCULE
		$sIn = strtolower($sIn);
 
		// tronque si trop long
		$sIn = substr($sIn, 0, 70);
		// SORTIE
		return $sIn;
	}

function PrintEditor ($params) { 
	global $CFG, $currentUser;
	
    extract($params); 

    if(empty($width)) {
    	$width = "350";
        } 
    if(empty($height)) {
    	$height = "400";
        } 
    if(empty($innerHtml)) {
    	$innerHtml = "";
        } 
    if(empty($name)) {
    	$name = "";
        } 
	echo '<div class="editeur" style="width:'.$width.';height: '.$height.'">';
	echo '<textarea name="'.$name.'"  id="'.$name.'" class="ckeditor">'.$innerHtml.'</textarea>';
    echo '</div>'; 
    echo '<script>
	    var editor = CKEDITOR.replace( \''.$name.'\' );
	    CKEDITOR.config.height = \''.$height.'\';//hauteur fenêtre
		CKEDITOR.config.width = \''.$width.'\';//largeur fenêtre
		CKEDITOR.config.enterMode = CKEDITOR.ENTER_P;
	    CKEDITOR.stylesSet.add( \'my_styles\',
			[
			    { name : \'Orange\', element : \'span\', attributes : { \'class\' : \'couleur\' } }
			]);
		 CKEDITOR.config.toolbar = \'Full\';
 
		 CKEDITOR.config.toolbar_Full =
			[
				{ name: \'document\', items : [ \'Maximize\' ] },
				{ name: \'clipboard\', items : [ \'PasteText\' ] },
				{ name: \'styles\', items : [ \'Styles\' ] },
				{ name: \'basicstyles\', items : [ \'Bold\',\'Italic\',\'Underline\',\'RemoveFormat\' ] },
				{ name: \'paragraph\', items : [ \'NumberedList\',\'BulletedList\',\'-\',\'Outdent\',\'Indent\', \'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\' ] },
				{ name: \'links\', items : [ \'Link\',\'Unlink\' ] },
				{ name: \'insert\', items : [ \'Image\',\'MediaEmbed\', \'Table\' ] },
				{ name: \'src\', items : [ \'Source\' ] }				
			];
		var finder = new CKFinder( { width : 600 } );
		finder.basePath = "/ckfinder/";
		finder.baseHref = "'.$CFG->url.'";
	    CKFinder.setupCKEditor( editor, finder ) ;
	</script>';  
    
}


function autoSearch($params) {
	$search = $params['search']; // id du champs de saisie
	$init_search = $params['init_search']; // valeur par défaut du champ de saisie à l'affichage
	$id = $params['id']; // id du champs à remplir
	$init_id = $params['init_id']; // valeur par défaut du champs	
	$ajax_url = $params['ajax_url']; // url appelée et qui génère la liste ul li
	$js_fonction = $params['js_fonction']; // optionel, commande javascrit à exécuter après avoir récupéré l'ID rechercher
	$class = @$params['class'];
	?>
		<input type="text" name="<?php echo $search;?>" id="<?php echo $search;?>" value="<?php echo $init_search;?>" class="<?php echo $class;?>">
		<input type="hidden" name="<?php echo $id;?>" id="<?php echo $id;?>" value="<?php echo $init_id;?>">
		<div id="<?php echo $search;?>_update" class="update"></div>
		<script type="text/javascript" language="javascript" charset="utf-8">
		// <![CDATA[													
		  	$(document).ready(function() {
			    $("#<?php echo $search;?>").autocomplete({minLength: 3,
			    source: '<?php echo $ajax_url?>',
	    		select: function(event, ui) { 
	    			//alert (li.id);
	    			$('<?php echo $id;?>').value = li.id;
		    		<?php echo $js_fonction;  ?>
			    }
			});
			  });
		// ]]>
		</script>

	<?php	
}

// liste des traductions
$trad['contact'] = array('fr' => 'contact', 'uk' => 'contact');
$trad['fiche'] = array('fr' => 'Fiche Technique', 'uk' => 'Technical sheet');
$trad['nom'] = array('fr' => 'Nom', 'uk' => 'Surname');
$trad['prenom'] = array('fr' => 'Prénom', 'uk' => 'Firt Name');
$trad['tel'] = array('fr' => 'Téléphone', 'uk' => 'Phone');
$trad['entreprise'] = array('fr' => 'Société', 'uk' => 'Company');
$trad['adresse'] = array('fr' => 'Adresse', 'uk' => 'Address');
$trad['cp'] = array('fr' => 'CP', 'uk' => 'Postal code');
$trad['ville'] = array('fr' => 'Ville', 'uk' => 'City');
$trad['nature'] = array('fr' => 'Votre demande concerne', 'uk' => 'What is your question about');
$trad['grillage'] = array('fr' => 'Grillage', 'uk' => 'Grillage UK');
$trad['cloture'] = array('fr' => 'Clôture', 'uk' => 'Cloture UK');
$trad['portail'] = array('fr' => 'Portail', 'uk' => 'Porail UK');
$trad['equip'] = array('fr' => 'Equipement sportif', 'uk' => 'Equip UK');
$trad['decoupe'] = array('fr' => 'Découpe jet d\'eau', 'uk' => 'Découpe UK');
$trad['thermo'] = array('fr' => 'Thermo-laquage', 'uk' => 'Thermo UK');
$trad['code'] = array('fr' => 'Recopiez le code', 'uk' => 'Copy the code');
$trad['message'] = array('fr' => 'Message', 'uk' => 'Message');
$trad['envoyer'] = array('fr' => 'Envoyer', 'uk' => 'Send');
$trad['sentOK'] = array('fr' => 'Votre message a bien été envoyé à nos services. Merci.', 'uk' => '');
$trad['plan'] = array('fr' => 'Plan d\'accès & Contact', 'uk' => 'Map & Contact');
$tpl->assign('trad', $trad);

// constante
define('OP_SAVE', 'Opération enregistrée.')
?>