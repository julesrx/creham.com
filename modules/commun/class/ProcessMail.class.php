<?php
class ProcessMail extends ObjectModel
{
	protected $table = 'process_mail';
	
	protected $fields = array('id', 'usr_id', 'nl_id', 'dest_mail', 'sujet', 'corps', 'pj_file', 'pj_name', 'code', 'src_mail', 'src_nom', 'date_envoi', 'erreur');		
	
}
	
?>