<?php


//affichage du ou des logos des sites
$elt = new Site();
$clause = false; // tout

$lElt = $elt->getList($clause,'site_id ASC');
$tpl->assign(array('lElt'=>$lElt, 'site' => new Site($curSid)));

$lTpl[] = "home/tpl/adm_home.tpl";
?>