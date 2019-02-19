<?php
class Newsletter extends ObjectModel
{
	protected $table = 'newsletter';
	
	protected $fields = array('nl_id', 'site_id', 'nl_titre', 'nl_sujet', 'nl_corps', 'nl_pj', 'nl_d_crea', 'nl_test_mail', 'nl_statut');		
	
}
	
?>