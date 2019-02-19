<?php
checkAdmin();


// test des parametres
if (isset($_GET['act'])){$act = $_GET['act'];
} elseif  (isset($_POST['act'])){$act = $_POST['act'];
} else 	$act = '';

switch ($act) {

	case 'del':
		delTag();
		listeTag();
		break;
	case 'save':
		saveTag();		
	case 'liste':
	default:
		listeTag();
		break;
}


function listeTag() 
{
	global $tpl, $lTpl, $curSid;
	$elt = new Tag();
	$lElt = $elt->getList(array('t.site_id = ?' => $curSid), 'tag_lib ASC');
	$tpl->assign(array('lElt' => $lElt, 'nb' => sizeof($lElt)));
	if (!empty($_GET['tag_id']))
	{
		$cTag = new Tag($_GET['tag_id']);	
		$tpl->assign(array("cTag" => $cTag));
	}

	$lTpl[] = "contenu/tpl/adm_tag_liste.tpl";
}

function saveTag()
{
	global $tpl, $lTpl, $CFG, $curSid;

	$elt = new Tag();
	$_POST['site_id'] = $curSid;
	$tag_id = $elt->save();
	//$_GET['tag_id'] = $tag_id;
	$tpl->assign('msg', "Opération enregistrée");
}



function delTag()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Tag($_GET['tag_id']);
	
	if ($elt->remove())
	{
	// rien
	}
	
	$tpl->assign('msg', "Opération enregistrée");
}



?>