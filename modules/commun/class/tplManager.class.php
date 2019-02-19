<?php
define('SMARTY_DIR', './include/libs/');
require(SMARTY_DIR . 'Smarty.class.php');
     
class tplManager extends Smarty {
     
	function tplManager() { 

		
		$this->Smarty();
     	$this->template_dir = './modules/';
     	$this->compile_dir = './templates_c/';
     	$this->config_dir = '.';
     	$this->cache_dir = './cache/';     
     	$this->caching = false;
     }
     
    }
?>