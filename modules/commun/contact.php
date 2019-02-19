<?php
switch ($act)
{
	case 'send':
	default:
		afficheContact();
		break;
}

function afficheContact()
{
	global $tpl, $lTpl, $CFG, $site;
	$tpl->assign('site', $site);	
	
	if (!empty($_POST)) 
	{		
		//if (!chk_crypt($_POST['code']))
		if (0)
		{
		 	$tpl->assign(array('errMsg' => 'Code de vérification incorrect.'));
		}
		else 
		{
			// mail à l'admin
			$sujet = "[CREHAM] Demande d'informations";
			$body = "Nous avons reçu sur le site internet le ".date('d/m/Y H:i').", les informations suivantes :<br><br>";
			
			foreach ($_POST as $k=>$v){
				if (!in_array($k, array('act', 'x', 'y', 'pop', 'Type', 'ob', 'code'))) {
					if (is_array($v)) {
						foreach ($v as $kk => $vv) {
							$body .= "<b>$k $kk =</b> ".nl2br($vv)." <br>";
						}
					} else 
						$body .= "<b>$k =</b> ".nl2br($v)." <br>";				
				}
			}
			if (isset($site->site_info['email_admin'])) $lDest = explode(';', $site->site_info['email_admin']);
			else $lDest = $CFG->email_admin;
			
			envoie_mail($CFG->email_from, $CFG->email_from_name, $sujet, stripslashes($body), $lDest);
		}				
	}
		
	$lTpl[] = "commun/tpl/contact.tpl";
}


?>
