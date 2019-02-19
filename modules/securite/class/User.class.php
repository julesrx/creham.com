<?php
	class User extends ObjectModel
	{
		protected $table = 'user';
		
		protected $fields = array('usr_id','grp_id','usr_login','usr_pwd','bas_id', 'usr_nom', 'usr_prenom', 'usr_profession', 'usr_adresse', 'usr_cp', 'usr_ville', 'usr_tel', 'usr_statut', 'usr_cgu', 'usr_carto', 'usr_inscrit_nl',
									'usr_specialite', 'usr_logiciel', 'usr_rs', 'usr_rpps', 'usr_is_securise', 'usr_region', 'usr_dept', 'usr_filler1', 'usr_filler2', 'usr_filler3', 'usr_filler4', 'site_id' );		
		
		
		public function verifieUser($usr_login, $usr_pwd) 
		{
			$sql = "SELECT usr_id FROM user WHERE usr_login = ? AND usr_pwd = ? LIMIT 0,1";
			debug("User > AFFICHE > SQL = $sql");
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($usr_login,$usr_pwd));						
			
			if($row = $rs->FetchRow()) //Lecture
			{
				self::__construct($row['usr_id']);				
			}			
		}				
		
		public function getByLogin($usr_login) 
		{
			$sql = "SELECT usr_id FROM user WHERE usr_login = ? LIMIT 0,1";
			debug("User > AFFICHE > SQL = $sql");
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($usr_login));						
			
			if($row = $rs->FetchRow()) //Lecture
			{
				self::__construct($row['usr_id']);				
			}			
		}	
		
		public function saveNewPwd($usr_pwd, $usr_id) 
		{
			$sql = "UPDATE user SET usr_pwd = ?WHERE usr_id = ? ";
			debug("User > AFFICHE > SQL = $sql");
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($usr_pwd, $usr_id));						
			return true;
		}

		public function inscrit($usr_inscrit_nl, $usr_id) 
		{
			$sql = "UPDATE user SET usr_inscrit_nl = ? WHERE usr_id = ? ";
			debug("User > AFFICHE > SQL = $sql");
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($usr_inscrit_nl, $usr_id));						
			return true;
		}
		
		public function masque($usr_id) 
		{
			$sql = "UPDATE user SET usr_statut = 4 WHERE usr_id = ? ";
			debug("User > AFFICHE > SQL = $sql");
			
			$p = Db::get()->Prepare($sql);
			$rs = Db::get()->Execute($p,array($usr_id));						
			return true;
		}
		
	}
	
?>
