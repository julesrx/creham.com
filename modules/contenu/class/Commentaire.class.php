<?php
class Commentaire extends ObjectModel
{
	protected $table = 'commentaire';	
	protected $fields = array('com_id', 'pg_id', 'usr_id', 'com_content', 'com_date', 'com_statut');
	protected $relations = array(
			array(
				'table' => 'page', 
				'alias' => 'p', 
				'identifier' => 'pg_id', 
				'fields' => array('pg_titre'), 
				'relations' => array(
					array(
						'table' => 'rubrique', 
						'alias' => 'r', 
						'identifier' => 'rub_id', 
						'fields' => array()
					)
				)
			),
		array(
				'table' => 'user', 
				'alias' => 'u', 
				'identifier' => 'usr_id', 
				'fields' => array('usr_nom', 'usr_prenom'))
	);

	public function getList($clause = false,$orderby = false,$limit = false) 
	{
		$items = parent::getList($clause, $orderby, $limit);
		foreach ($items as $k=>$item)
		{
			$items[$k]->usr_initiales = strtoupper(substr($item->usr_prenom, 0, 1).substr($item->usr_nom, 0, 1));
		}
		return $items;
	}
	
	public function masqueByUser($usr_id) 
		{
			$sql = "UPDATE commentaire SET com_statut = 0 WHERE usr_id = ? ";
			debug("User > AFFICHE > SQL = $sql");
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($usr_id));						
			return true;
		}
}
?>