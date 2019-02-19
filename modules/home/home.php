<?php 

/*
$p = new Page();
global $lRubrique;
foreach ($lRubrique as $cRub) // définie dans header 
{
	$lElt[$cRub->rub_id] = $p->getListPageCommentaire(array('pg_statut = 1' => false, 't.rub_id = ?'=> $cRub->rub_id, 't.site_id = ?' => $site->site_id), 'pg_date_affiche ASC', '0,2'); // liste des conseils
}

$tpl->assign(array('lHome' => $lElt));
*/
// liste actualité
$a = new Actualite();
$lActu = $a->getList(array('act_statut = 1' => false, 'act_date <= ?' => time()), 'act_date DESC', '0, 10'); // 10 max
$tpl->assign(array('lActu' => $lActu));

$lTpl[] = "home/tpl/home.tpl";



?>