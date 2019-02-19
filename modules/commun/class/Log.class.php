<?php

	class Log extends ObjectModel
	{
		protected $table = 'log';
		
		protected $fields = array('log_id', 'log_date', 'log_action', 'log_elt', 'log_elt_id', 'log_old', 'log_new');		
		
		public function save($log_id, $log_date, $log_action, $log_elt, $log_elt_id, $log_old = '', $log_new = '') 
		{
			$values = array('log_id' => $log_id, 'log_date' => $log_date, 'log_action' => $log_action, 'log_elt' => $log_elt, 
  						   'log_elt_id' => $log_elt_id, 'log_old' => $log_old, 'log_new' => $log_new);
			
			parent::save($log_id,$values);
		}
	}

?>