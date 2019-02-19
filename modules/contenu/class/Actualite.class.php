<?php
class Actualite extends ObjectModel
{
	protected $table = 'actualite';
	
	protected $fields = array('act_id', 'act_titre', 'act_date', 'act_chapo', 'act_contenu', 'act_info', 'act_type','act_statut', 'usr_id', 'act_photo');		
	
	protected $relations = array(
		array('table' => 'categorie', 'alias' => 'c', 'identifier' => array('actualite' => 'act_type', 'categorie' => 'cat_id'), 'fields' => array('cat_id','cat_lib')));

	function getList($clause = false, $orderby = false, $limit = false) 
		{			
			$items = parent::getList($clause, $orderby, $limit);
			foreach ($items as $k=>$item)
			{
				$items[$k]->act_info = unserialize(rawurldecode($item->act_info));
			}
			return $items;
		}
	
}
	
?>
