<?php

	class Site extends ObjectModel
	{
		protected $table = 'site';
		
		protected $fields = array('site_id','site_lib','site_code','site_info', 'site_photo', 'site_url');
		
			
		public function save()
		{
			$_POST['site_info'] = rawurlencode(serialize($_POST));			
			return parent::save();
		}
		
		public function getList($clause = false, $orderby = false, $limit = false)
		{
			if($items = parent::getList($clause,$orderby,$limit))
			{				
				foreach($items as $item_id => $item)
				{
                   	if($item->site_info)
                   	{
                   		$items[$item_id]->site_info = unserialize(rawurldecode($item->site_info));                   		
                   	}
                   	else $items[$item_id]->site_info = array();                   	                   	
				}
				return $items;
			}
			else return false;
		}
		
		public function deletePhoto($site_id) 
		{
			$sql = "UPDATE site SET site_photo = null WHERE site_id = ?";
			$p = Db::get()->Prepare($sql);
		    $rs = Db::get()->Execute($p,array($site_id));
		}
		
		// recherche du site correspondant à dmpXX
		public function getByCode($site_code) 
		{
			// on reçoit /dmpXX/xxx
			$tmp = explode('/', $site_code);
			if (!preg_match('/dmp/', $tmp[1])) $tmp[1] = 'ghi'; // par défaut
			
//			print_r($tmp); exit;
			$sql = "SELECT site_id FROM site WHERE site_code = ? LIMIT 0,1";
			
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($tmp[1]));						
			
			if($row = $rs->FetchRow()) //Lecture
			{
				if (!($row['site_id'] > 0)) $row['site_id'] = 1;
				self::__construct($row['site_id']);				
			}			
		}
	}
	
?>
