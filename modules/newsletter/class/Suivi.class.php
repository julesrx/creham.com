<?php
class Suivi extends ObjectModel
{
	protected $table = 'suivi';
	
	protected $fields = array('suiv_id','nl_id', 'usr_id', 'suiv_d_envoi', 'suiv_d_visit', 'suiv_code');		
	
	public function getByCode($suiv_code) 
		{
			$sql = "SELECT suiv_id FROM suivi WHERE suiv_code = ? LIMIT 0,1";
			
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($suiv_code));						
			
			if($row = $rs->FetchRow()) //Lecture
			{
				self::__construct($row['suiv_id']);				
			}			
		}
			
	public function updateVisite($suiv_d_visit, $suiv_id) 
		{
			$sql = "UPDATE suivi SET suiv_d_visit = ? WHERE suiv_id = ?";
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($suiv_d_visit, $suiv_id));						
			
			return true;		
		}
	
	public function getList($constraints = false, $order = false, $limit = false) 
	{
		$this->addRelation(array('table' => 'user', 'alias' => 'u', 'identifier' => 'usr_id', 
								'fields' => array('usr_login', 'usr_nom', 'usr_prenom')));
		$items = parent::getList($constraints, $order, $limit);
		return $items;
	}	
}
	
?>