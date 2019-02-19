<?php

$p = new Page;
$lElt[1] = $p->getList(array('pg_statut = 1' => false, 't.rub_id = 1'=> false, 't.site_id = ?' => $site->site_id), 'pg_ordre ASC'); // présentation
$lElt[2] = $p->getList(array('pg_statut = 1' => false, 't.rub_id = 2'=> false, 't.site_id = ?' => $site->site_id), 'pg_ordre ASC'); // accès
$lElt[3] = $p->getList(array('pg_statut = 1' => false, 't.rub_id = 3'=> false, 't.site_id = ?' => $site->site_id), 'pg_ordre ASC'); // Mention
$lElt[4] = $p->getList(array('pg_statut = 1' => false, 't.rub_id = 4'=> false, 't.site_id = ?' => $site->site_id), 'pg_ordre ASC'); // Espace de travail

$tpl->assign(array(
	'lMenu' => $lElt	
	));
	
$lTpl[] = 'commun/tpl/header.tpl';

?>