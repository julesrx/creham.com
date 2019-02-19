<?php
checkAdmin();


// test des parametres
if (isset($_GET['act'])){$act = $_GET['act'];
} elseif  (isset($_POST['act'])){$act = $_POST['act'];
} else 	$act = '';

switch ($act) {
	case 'del':
		delRubrique();
		listeRubrique();
		break;
	case 'save':
		saveRubrique();		
	case 'liste':
	default:
		listeRubrique();
		break;
}


function listeRubrique() 
{
	global $tpl, $lTpl;
	$elt = new Rubrique();
	$lElt = $elt->getList(false, 'rub_type ASC, rub_ordre ASC');
	$tpl->assign('lElt', $lElt);
	if (!empty($_GET['rub_id']))
	{
		$tpl->assign(array("cRubrique" => $cRub = new Rubrique($_GET['rub_id'])));
	}
	getListeTypeRubrique();
	$lTpl[] = "contenu/tpl/adm_rubrique_liste.tpl";
}

function saveRubrique()
{
	global $tpl, $lTpl, $CFG;
	
	$elt = new Rubrique();
	
	// traitement des pictos
	$rub_picto = uploadFile('rub_picto', 'rub_picto_old', $CFG->imgpath.'picto/', time());
	$rub_effet = uploadFile('rub_effet', 'rub_effet_old', $CFG->imgpath.'picto/', time()+1);
	$_POST['rub_info'] = json_encode(array('rub_picto' => $rub_picto, 'rub_effet' => $rub_effet));
	
	$rub_id = $elt->save();
	$_GET['rub_id'] = $rub_id;
	$tpl->assign('msg', "Opération enregistrée");
}



function delRubrique()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Rubrique($_GET['rub_id']);
	
	if ($elt->remove())
	{
		$tpl->assign('msg', "Opération enregistrée");
	}
	
	
}
?>