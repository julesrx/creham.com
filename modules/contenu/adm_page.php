<?php
checkAdmin();


// test des parametres
if (isset($_GET['act'])){$act = $_GET['act'];
} elseif  (isset($_POST['act'])){$act = $_POST['act'];
} else 	$act = '';

switch ($act) {
	case 'delRes':
		delResAjax();
		break;
	case 'saveRes':
		saveResAjax();
		break;
	case 'getResAjax':
		getResAjax();
		break;
	case 'uploadRessource':
		uploadRessource();
		break;	
	case 'duplic':
		duplicPage();
		break;
	case 'delPhoto':
		delPhoto();
		break;
	case 'del':
		delPage();
		listePage();
		break;
	case 'aValider':
		$_SESSION['type'] = 'aValider';
		listePage();
		break;
	case 'save':
		savePage();		
		listePage();
		break;
	case 'liste':
	default:
		$_SESSION['type'] = 'tous';
		listePage();
		break;
}

function saveResAjax()
{
	$res = new Ressource($_REQUEST['res_id']);
	if ($res->res_id > 0)
	{
		$res->save('res_id', array('res_id' => $res->res_id, 'res_titre' => $_POST['res_titre']));
		$res = new Ressource($_REQUEST['res_id']);
		echo json_encode(array('res_titre' => $res->res_titre, 'res_id' => $res->res_id));
	}
}

function delResAjax()
{
	$res = new Ressource($_REQUEST['res_id']);
	if ($res->res_id > 0)
	{
		if ($res->remove())
			echo json_encode(true);
		else echo json_encode(false);
	}	
}

function getResAjax()
{
	global $CFG, $currentUser, $tpl, $lTpl;
	$r = new Ressource();
	$lR = $r->getList(array('elt_type = ?' => 'pg', 'elt_id = ?' => $_GET['pg_id']));
	if (!empty($lR))
	{
		foreach ($lR as $cR)
		{
			$tpl->assign('cR', $cR);
			echo $tpl->fetch('contenu/tpl/adm_ressource_item.tpl');
		}
	}
	
}

function uploadRessource()
{
	global $CFG, $currentUser, $tpl, $lTpl;
	
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	@set_time_limit(5 * 60);
	
	$targetDir = $CFG->docpath;
	$cleanupTargetDir = false; // Remove old files
	$maxFileAge = 5 * 3600; // Temp file age in seconds
	
	// Get a file name
	if (isset($_REQUEST["name"])) {
		$originName = $_REQUEST["name"];
	} elseif (!empty($_FILES)) {
		$originName = $_FILES["file"]["name"];
	} else {
		$originName = uniqid("file_");
	}
	
	// renommage du fichier mais conservation du nom pour le lien
	$lName = explode('.', $originName);
	$iName = array_reverse($lName);
	$extension = strtolower(array_shift($iName));
	$fileName = time().".".$extension;		
	
	$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
	
	// Chunking might be enabled
	$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
	$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
	
	
	// Remove old temp files	
	if ($cleanupTargetDir) {
		if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
		}
	
		while (($file = readdir($dir)) !== false) {
			$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
	
			// If temp file is current file proceed to the next
			if ($tmpfilePath == "{$filePath}.part") {
				continue;
			}
	
			// Remove temp file if it is older than the max age and is not the current file
			if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
				@unlink($tmpfilePath);
			}
		}
		closedir($dir);
	}	
	
	
	// Open temp file
	if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
	}
	
	if (!empty($_FILES)) {
		if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
		}
	
		// Read binary input stream and append it to temp file
		if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		}
	} else {	
		if (!$in = @fopen("php://input", "rb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
		}
	}
	
	while ($buff = fread($in, 4096)) {
		fwrite($out, $buff);
	}
	
	@fclose($out);
	@fclose($in);
	
	// Check if file has been uploaded
	if (!$chunks || $chunk == $chunks - 1) {
		// Strip the temp .part suffix off 
		rename("{$filePath}.part", $filePath);
	}
	
	// stockage de la ressource en BDD
	$r = new Ressource();
	$r->save('res_id', array('res_id' => null, 'elt_id' => $_GET['pg_id'], 'elt_type' => 'pg', 'res_ordre' => 1, 'res_titre' => $originName, 'res_contenu' => $fileName, 'res_mime' => $extension));
	
	// Return Success JSON-RPC response
	die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
}

function duplicPage()
{
	global $tpl, $lTpl, $curSid;
	//print_r($_POST);
	if (empty($_POST))
	{
		$s = new Site;
		getListeSite();
		echo $tpl->fetch('contenu/tpl/duplic.tpl');
	}
	else 
	{
		if(!empty($_POST['site_id'])){
			$p = new Page();
			$i = 0;
			foreach ($_POST['site_id'] as $site_id)
			{
				$p->duplique($_POST['pg_id'], $site_id);
				$i++;
			}
			$_GET['pg_id'] = $_POST['pg_id'];
			$tpl->assign('msg', 'Article dupliqué '.$i.' fois');
			listePage();
		} else 
		{
			$_GET['pg_id'] = $_POST['pg_id'];
			$tpl->assign('errMsg', 'Aucun site sélectionné pour la duplication');
			listePage();
		}
	}
}


function listePage() 
{
	global $tpl, $lTpl, $curSid;
	$elt = new Page();
	$clause = array('t.site_id = ?' => $curSid);
	if ($_SESSION['type'] == 'aValider') $clause += array('pg_statut = 2' => false);
	
	// cas de la recherche
	if (!empty($_POST['search_mot'])) $clause += array('pg_titre LIKE ?' => '%'.$_POST['search_mot'].'%');
	if (!empty($_POST['search_rub'])) $clause += array('t.rub_id =  ?' => $_POST['search_rub']);
	if (!empty($_POST['search_date'])) $clause += array('t.pg_date_crea BETWEEN ? AND ?' => date_fr_to_timestamp($_POST['search_date'].' 00:00:00'),'X' => date_fr_to_timestamp($_POST['search_date'].' 23:59:59'));
	
	$lElt = $elt->getList($clause, 'rub_ordre ASC, pg_ordre ASC');
	
	
	$tpl->assign(array('lElt' => $lElt, 'nb' => sizeof($lElt)));
	
	
	if (!empty($_GET['pg_id']))
	{
		$cPage = new Page($_GET['pg_id']);	
		$tpl->assign(array("cPage" => $cPage));

		// Ressource
		$r = new Ressource();
		$lR = $r->getList(array('elt_type = ?' => 'pg', 'elt_id = ?' => $_GET['pg_id']));
		
		$tpl->assign('lR', $lR);
		
	}
	getListeRubrique ();
	getListeStatus();
	getListeCategorie ();

	$lTpl[] = "contenu/tpl/adm_page_liste.tpl";
}

function savePage()
{
	global $tpl, $lTpl, $CFG, $curSid;
	$_POST['site_id'] = $curSid;
	//print_r($_POST);
	$_POST['pg_photo'] = uploadFile('pg_photo', 'pg_photo_old', $CFG->imgpath, time());
	if (empty($_POST['pg_date_crea'])) $_POST['pg_date_crea'] = time();
	else $_POST['pg_date_crea'] = date_fr_to_timestamp($_POST['pg_date_crea']);	
	
	if (!empty($_POST['pg_date_affiche'])) $_POST['pg_date_affiche'] = date_fr_to_timestamp($_POST['pg_date_affiche']);
		
	
	
	$elt = new Page();
	$pg_id = $elt->save();
	$_GET['pg_id'] = $pg_id;
	$tpl->assign('msg', "Opération enregistrée");
}



function delPage()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Page($_GET['pg_id']);
	
	if ($elt->remove())
	{
	// rien
	}
	
	$tpl->assign('msg', "Opération enregistrée");
}


function delPhoto()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Page($_GET['pg_id']);
	$elt->deletePhoto($_GET['pg_id']);
	listePage();
}
?>