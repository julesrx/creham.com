<?php
checkAdmin();

// test des parametres
if (isset($_GET['act'])){$act = $_GET['act'];
} elseif  (isset($_POST['act'])){$act = $_POST['act'];
} else 	$act = '';

switch ($act) {
	case 'del':
		delBloc();
		listeBloc();
		break;
	case 'save':
		saveBloc();		
		listeBloc();
		break;
	case 'liste':
	default:
		listeBloc();
		break;
}

function listeBloc() 
{
	global $tpl, $lTpl, $curSid;
	$elt = new Bloc();
	$clause = array('site_id = ?' => $curSid);
	
	$lElt = $elt->getList($clause, 'bloc_ordre ASC');
	$tpl->assign(array('lElt' => $lElt));
	if (!empty($_GET['bloc_id']))
	{
		$cBloc = new Bloc($_GET['bloc_id']);	
		$tpl->assign(array("cBloc" => $cBloc));
	}
	getListeStatus ();
	getListeTypeBloc ();
	getListePosition();
	$lTpl[] = "contenu/tpl/adm_bloc_liste.tpl";
}

function saveBloc()
{
	global $tpl, $lTpl, $CFG, $curSid;

	$_POST['site_id'] = $curSid;
	$elt = new Bloc();
	$bloc_id = $elt->save();
	$_GET['bloc_id'] = $bloc_id;
	$tpl->assign('msg', "Opération enregistrée");
}



function delBloc()
{
	global $tpl, $lTpl, $CFG;
	$elt = new Bloc($_GET['bloc_id']);
	
	if ($elt->remove())
	{
	// rien
	}
	
	$tpl->assign('msg', "Opération enregistrée");
}



?>