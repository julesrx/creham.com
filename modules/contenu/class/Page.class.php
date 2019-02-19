<?php
class Page extends ObjectModel
{
	protected $table = 'page';
	
	protected $fields = array('pg_id', 'site_id', 'rub_id', 'cat_id', 'usr_id', 'pg_titre', 'pg_chapo', 'pg_contenu', 'pg_info','pg_ordre', 
		'pg_statut', 'pg_photo', 'pg_date_crea', 'pg_date_affiche', 'pg_mot1', 'pg_mot2', 'pg_mot3', 'pg_picto');		
	
	protected $relations = array(
		array('table' => 'rubrique', 'alias' => 'r', 'identifier' => 'rub_id', 'fields' => array('rub_id','rub_lib')),
		array('table' => 'categorie', 'alias' => 'c', 'identifier' => 'cat_id', 'fields' => array('cat_id','cat_lib')),
		array(
				'table' => 'user', 
				'alias' => 'u', 
				'identifier' => 'usr_id', 
				'fields' => array('usr_nom', 'usr_prenom'))
	);
	
	public function __construct($pg_id = false) {		
		parent::__construct($pg_id);
			if ($pg_id > 0)
			{
				if ($this->rub_id == 4){
					$tab = json_decode($this->pg_chapo, true);				
					$this->pg_date = $tab['pg_date'];
					$this->pg_lieu = $tab['pg_lieu'];
					$this->pg_contact = $tab['pg_contact'];
				}
				$this->pg_info = json_decode($this->pg_info, true);						
			}
	}
	
	public function masquer($pg_id) 
	{
		$sql = "UPDATE page SET pg_statut = 0 WHERE pg_id = ?";
		$p = Db::get()->Prepare($sql);
	    $rs = Db::get()->Execute($p,array($pg_id));
	}
	
	public function deletePhoto($pg_id) 
	{
		$sql = "UPDATE page SET pg_photo = null WHERE pg_id = ?";
		$p = Db::get()->Prepare($sql);
	    $rs = Db::get()->Execute($p,array($pg_id));
	}
	
	public function duplique($pg_id, $site_id) 
	{
		$sql = "INSERT INTO page (pg_id, site_id, rub_id, cat_id, usr_id, pg_titre, pg_chapo, pg_contenu, pg_info,pg_ordre, 
		pg_statut, pg_photo, pg_date_crea, pg_date_affiche, pg_mot1, pg_mot2, pg_mot3) 
		(SELECT null, ?, rub_id, cat_id, usr_id, pg_titre, pg_chapo, pg_contenu, pg_info,pg_ordre, 
		pg_statut, pg_photo, ?, pg_date_affiche, pg_mot1, pg_mot2, pg_mot3 FROM page WHERE pg_id = ?)";
		
		$p = Db::get()->Prepare($sql);
	    $rs = Db::get()->Execute($p,array($site_id, time(), $pg_id));
	}
	
	public function getListPageCommentaire($clause = false,$orderby = false,$limit = false) 
	{
		$sql = "SELECT t.pg_id, t.rub_id, t.cat_id, cat_lib, rub_lib, t.usr_id, usr_nom, usr_prenom, pg_titre, pg_chapo, count(com_id) as nb_com, 
				pg_date_affiche, pg_contenu, rub_info, pg_statut, pg_photo  
				FROM page t
				LEFT JOIN rubrique r ON r.rub_id = t.rub_id 
				LEFT JOIN categorie ca ON ca.cat_id = t.cat_id
				LEFT JOIN commentaire c ON c.pg_id = t.pg_id AND com_statut = 1
				LEFT JOIN user u ON t.usr_id = u.usr_id
				WHERE 1=1 ";
		
		 
		if($clause) foreach($clause as $constraint => $constraint_value) $sql.= "AND ".$constraint." ";
		$sql .= "GROUP BY t.pg_id ";
        if($orderby) $sql.= "ORDER BY ".$orderby." ";
		if($limit) $sql.= "LIMIT ".$limit." ";
		
		$p = Db::get()->Prepare($sql);
		$rs = Db::get()->Execute($p, $clause ? array_filter($clause) : array());
		$items = array();						
		while ($row = $rs->FetchRow()) //Lecture
		{			
			$item = new stdClass();
			$item->pg_id = $row['pg_id'];
			$item->pg_titre = $row['pg_titre'];
			$item->pg_contenu = $row['pg_contenu'];
			$item->pg_statut = $row['pg_statut'];
			$item->pg_photo = $row['pg_photo'];
			$item->pg_date_affiche = $row['pg_date_affiche'];
			$item->cat_lib = $row['cat_lib'];
			$item->rub_lib = $row['rub_lib'];
			$item->rub_id = $row['rub_id'];
			$item->rub_info = json_decode($row['rub_info'], true);
			$item->cat_id = $row['cat_id'];
			$item->usr_nom = $row['usr_nom'];
			$item->usr_prenom = $row['usr_prenom'];
			$item->usr_initiales = strtoupper(substr($item->usr_prenom, 0, 1).substr($item->usr_nom, 0, 1));
			$item->pg_chapo = $row['pg_chapo'];
			$item->pg_nb_com = $row['nb_com'];
			
			$tab = @json_decode($item->pg_chapo, true);				
			$item->pg_date = $tab['pg_date'];
			$item->pg_lieu = $tab['pg_lieu'];
			$item->pg_contact = $tab['pg_contact'];
			
			$items[$row['pg_id']] = $item;
		}
		return $items;
	}
	
	public function getNbOccurence() 
	{
		$listeVal = array();
		
		$sql = "SELECT COUNT(pg_mot1) as nb, pg_mot1 as id FROM page p GROUP BY pg_mot1 ";
		$p = Db::get()->Prepare($sql);
		$rs = Db::get()->Execute($p);						
		while ($row = $rs->FetchRow()) //Lecture
		{
			@$liste[$row['id']] += $row['nb'];		
		}

		$sql = "SELECT COUNT(pg_mot2) as nb, pg_mot2 as id FROM page p GROUP BY pg_mot2 ";
		$p = Db::get()->Prepare($sql);
		$rs = Db::get()->Execute($p);						
		while ($row = $rs->FetchRow()) //Lecture
		{
			@$liste[$row['id']] += $row['nb'];
		}
		
		$sql = "SELECT COUNT(pg_mot3) as nb, pg_mot3 as id FROM page p GROUP BY pg_mot3 ";
		$p = Db::get()->Prepare($sql);
		$rs = Db::get()->Execute($p);						
		while ($row = $rs->FetchRow()) //Lecture
		{
			@$liste[$row['id']] += $row['nb'];	
		}
		return $liste;
	}	
}
	
?>