<?php
class bloc extends ObjectModel
{
	protected $table = 'bloc';	
	protected $fields = array('bloc_id', 'site_id', 'bloc_lib', 'bloc_content', 'bloc_type', 'bloc_position', 'bloc_ordre', 'bloc_statut');
	
}
?>