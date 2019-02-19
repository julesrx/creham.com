<?php
	class Db
	{
		//Objet ADODB
		private $DB;
		
		//Singleton
		private static $instance;
				
		public function __construct()
		{
			global $CFG;
			
			$this->DB = &ADONewConnection($CFG->type);
			//Lancement de la connexion
			if(!$this->DB->Connect($CFG->host, $CFG->uname, $CFG->pwd, $CFG->db))
			{
				echo "Connexion impossible : " . $CFG->db;exit(0);
			}
		}
		
		public function __destruct()
		{
			$this->DB->Close();
		}
		
		//Accesseur de l'instance de la classe qui est en mesure de fournir un object ADODB
		public static function get()
		{
			if(!isset(self::$instance)) self::$instance = new Db();
			return self::$instance->getDb();
		}
		
		//Accesseur de l'objet ADODB
		public function getDb() 
		{ 
			return $this->DB; 
		}
		
	}
?>