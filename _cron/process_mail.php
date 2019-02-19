<?php
chdir( dirname ( __FILE__ ) ); // se met dans le répertoire du script
chdir('..');

require ('include/config.php');
$tpl = new tplManager();
require ('include/common.php');

$log_id = time();
$l = new Log();
//$l->save('', time(), 'Début traitement mail', 'mail', $log_id);

$m = new ProcessMail();
$lM = $m->getList(false, false, '0,50'); // on limite les envois par paquet de 50
$t = sizeof($lM);
$i = 0;
if (sizeof($lM) > 0)
{
	foreach ($lM as $cM)
	{		
		// envoi du mail		
		if ($ok = envoie_mail($cM->src_mail, utf8_decode($cM->src_nom), $cM->sujet, $cM->corps, $cM->dest_mail, false, $cM->pj_file, $cM->pj_name))
		//if (1)
		{
			if ($cM->nl_id > 0) // enregistrement du suivi NL
			{
				$s = new Suivi();
				$s->save('suiv_id', array('suiv_id' => null, 'nl_id' => $cM->nl_id, 'usr_id' => $cM->usr_id, 'suiv_d_envoi' => time(), 'suiv_d_visit' => '', 'suiv_code' => $cM->code));
			}
			
			// on purge la table de process
			$m->id = $cM->id;
			$m->remove();
			$i++;
		}	
	}
}

//$l->save('', time(), "envoi de $i mails sur $t", 'mail', $log_id);