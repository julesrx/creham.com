<?php
class Rubrique extends ObjectModel
{
	protected $table = 'rubrique';
	protected $fields = array('rub_id', 'rub_lib', 'rub_ordre', 'rub_type', 'rub_info');		
			
	function getList($constraints = false, $order = false, $limit = false)
	{
		$items = parent::getList($constraints, $order, $limit);
		
		foreach ($items as $k=>$item)
		{
			switch ($item->rub_type)
			{
				case '1': $items[$k]->url_type = 'r'; break;
				case '2': $items[$k]->url_type = 'c'; break;
				case '3': $items[$k]->url_type = 'r'; break;
			}
			
			$items[$k]->rub_info = json_decode($items[$k]->rub_info, true);
		}
		return $items;
	}
}
	
?>