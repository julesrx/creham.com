<?php

class Poste extends ObjectModel
{
    protected $table = 'poste';    
    protected $fields = array('pst_id','pst_lib', 'pst_ip', 'pst_type');
    
	function getByIp($pst_ip = '') 
		{
			if ($pst_ip != '') 
			{
				$sql = 'SELECT pst_id FROM poste WHERE pst_ip = ? LIMIT 0,1';
				debug("Poste > AFFICHE > SQL = ".$sql);

				$p  = Db::get()->Prepare($sql); //Préparation
				$rs = Db::get()->Execute($p,array($pst_ip)); //Execution
				
				if($row = $rs->FetchRow()) self::__construct($row['pst_id']);								
			}
		}
    
}

?>