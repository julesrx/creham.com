<?php

class ObjectModel
{
    protected $table = null;
    protected $fields = array();
    protected $custom_fields = array();
    protected $fields_values = array();
    protected $groupby = array();
    protected $relations = array();
    //Choix de la db qui doit lancer les requètes
    public $db;
    
    public function __construct($object_id = false)
    {
        if(!isset($this->db)) $this->setDb();

        if($object_id)
        {            
            if($list = $this->getList(array('t.'.$this->getIdField().' = ? ' => $object_id),false,'0,1'))
            {		        
		        if($object_record = current($list))
		       		$this->fields_values = $object_record->getFieldsValues();
            }
        }        
    }
    //Méthode à surcharger pour les objets exploitant une autre base de données
    public function setDb(){ $this->db = &Db::get(); }
    
    public function __get($field){ return isset($this->fields_values[$field]) ? (is_array($this->fields_values[$field]) ? $this->fields_values[$field] : (!empty($this->fields_values[$field]) ? $this->fields_values[$field] : false)) : false; }    
    public function __set($field,$value){ $this->fields_values[$field] = $value; }
    
    public function getIdField(){ return $this->fields[0]; }
    public function getIdValue(){ return isset($this->fields_values[$this->getIdField()]) ? $this->fields_values[$this->getIdField()] : false; }
    public function getFields(){ return $this->fields; }
    public function getFieldsValues(){ return $this->fields_values; }
    public function getRelations(){ return $this->relations; }
       
    public function replaceFieldsBy($fields = array()){ $this->fields = $fields; }
    
    public function addCustomField($field = array()){ $this->custom_fields+= $field; }
    public function addGroupBy($fields = array()){ $this->groupby+= $fields; }
    /* L'ajout de relation permet l'execution de requetes plus complexes
    Ex : $monobjet->addRelation(array(
    						array(
    							'table' => 'membre_banque',
    							'alias' => 'mb',
								'identifier' => 'mbr_id',
								'fields' => array('banq_id','banq_lib','banq_pays')
							))); 
    */
    public function addRelation($relation = array()){ $this->relations[$relation['alias']] = $relation; }
    
    public function exists(){ return $this->fields_values != array(); }
    
    /* Méthode générique pour retourner un tableau d'objets
       Ex : $monobjet->getList(array(
       			'mbr_id = ?' => 15,
       			'NOT ISNULL(mbr_identifiant)' => false,
       			'(mbr_pseudo LIKE ? OR mbr_identifiant LIKE ?)' => 'pseudotest','X' => 'pseudotest',
       		),'t.mbr_pseudo ASC','0,10');
       		
       Mettre une valeur à false, indique au constructeur de requete qu'il n'y a pas de valeur a attribuer à cette contrainte
       Mettre une clé = X , indique au constructeur de requete qu'il doit insérer la valeur sans ajouter une contrainte suplémentaire
    */
    public function getList($constraints = false, $order = false, $limit = false) 
    {
		$results = array();
		
		$sql = "SELECT  ";
		//Ajouts des champs principaux à la sélection
		foreach($this->fields as $fieldkey => $field) $sql.= "t.".(!is_int($fieldkey) ? $fieldkey : $field)."".(!is_int($fieldkey) ? " AS ".$field." " : "").",";
		//Ajouts des champs en provenances des relations
		$sql.= $this->getSqlRelationsFields($this->table, 't', $this->relations);	
		//Ajouts des champs customs
		foreach($this->custom_fields as $field_alias => $field) $sql.= $field." AS ".$field_alias.",";
		//Puis ajouts des clauses de relations		
		$sql = substr($sql,0,-1) . " FROM ".$this->table." t " . $this->getSqlRelations($this->table, 't', $this->relations) . " WHERE 1=1 ";
		//Ajout des contraintes
		if($constraints) foreach($constraints as $constraint => $constraint_value) if($constraint!='X' && $constraint!='') $sql.= "AND ".$constraint." ";
		//Ajout group by
		if(count($this->groupby) > 0) 
		{			
			$sql.= "GROUP BY ";
			foreach($this->groupby as $groupby_field) $sql.= $groupby_field.",";
			$sql = substr($sql,0,-1)." ";
		}
		//Ajout du tri
		if($order) $sql.= "ORDER BY ".$order." ";
		//Ajout de la limite 
		if($limit) $sql.= "LIMIT ".$limit." ";
        		
		//debug(get_class($this) . " > getList > SQL = ".$sql);
		 //       print_r($this->db);
		 if($this->db==NULL) print_r(debug_backtrace());
		$p = $this->db->Prepare($sql);
		if(!$res = $this->db->Execute($p,$constraints ? array_filter($constraints) : array()))
		{
			debug ('Erreur dans la requete <b>'.$sql.'</b> (' . $this->db->ErrorMsg() . ')' . print_r(debug_backtrace()));
			//exit(0);
    		return false; 	
		} 
		else while($row = $res->FetchRow())
		{
			$object_class = get_class($this);
			$object = new $object_class();
			
			//Attribution des valeurs des champs de l'objet
            foreach($this->fields as $field) $object->$field = stripslashes($row[$field]);
            //Attributions des valeurs persos
            foreach($this->custom_fields as $field => $selection) $object->$field = stripslashes($row[$field]);
			//Attribution des valeurs déterminés par les relations
			$object->setRelationValues($this->getRelations(),$row);

            $results[$row[$this->getIdField()]] = $object;				
		}			
		return $results;	
	}
	
	public function getFoundRows(){ return $this->db->GetOne('SELECT FOUND_ROWS()'); }
	
	public function save($object_id = false, $values = false) //Le paramètre est présent uniquement pour assurer la transition entre les anciens devs et les nouveaux
	{
	    $prepared_values = array();
	    if(!$values) $values = $_POST;
		
		$sql = 'INSERT INTO '.$this->table.' SET ';
		
		foreach($this->fields as $field)
		{
		    if(isset($values[$field])) 
		    {
		    	//Attribution de la valeur au champs courant de l'objet courant
		    	$this->$field = $values[$field];
		    	//Stockage pour le prepare statement
		    	$prepared_values[] = $this->$field;
		    	//Alimentation de la requète
		    	$sql.= ''.$field.' = ?,';
		    }
		}

		$sql = substr($sql,0,-1).' ON DUPLICATE KEY UPDATE ';

		foreach($this->fields as $field)
		{
		    if($field != $this->getIdField() && isset($values[$field])) 
		    {
		    	//Stockage pour le prepare statement
		    	$prepared_values[] = $values[$field];
		    	//Alimentation de la requète
		    	$sql.= ''.$field.' = ?,';
		    }
		}
		
		$sql = substr($sql,0,-1);
		debug(get_class($this)." > SAVE > sql = ".$sql);
		
		$p = $this->db->Prepare($sql);
		
		if (!$res = $this->db->Execute($p, $prepared_values)) 
		{
		    debug ('Erreur dans la requete <b>'.$sql.'</b> (' . $this->db->ErrorMsg() . ')');return false; 	
		} 		
		else 
		{
			$object_field_id = $this->getIdField();
			$object_id = $values[$object_field_id] ? $values[$object_field_id] : $this->db->Insert_ID();
			$this->$object_field_id = $object_id;
			return $object_id;
		}
	}
	
	public function remove($object_id = false) //Le paramètre est présent uniquement pour assurer la transition entre les anciens devs et les nouveaux
	{		
		$sql = "DELETE FROM ".$this->table." WHERE ".$this->getIdField()." = ? ";
		$p = $this->db->Prepare($sql);
				
		if (!$res = $this->db->Execute($p,array($this->fields_values[$this->fields[0]] ? $this->fields_values[$this->fields[0]] : $object_id))) 
		{
		    debug ('Erreur dans la requete <b>'.$sql.'</b> (' . $this->db->ErrorMsg() . ')');return false; 	
		} 
		else return true;				
	}
	
	/*Méthodes privées*/
	private function getSqlRelations($join_table,$join_alias,$relations, $i = 0)
	{	
		$sql = "";
		foreach($relations as $relation_index => $relation)
	    {		        
	        //Gestion alias
            $table_alias = isset($relation['alias']) ? $relation['alias'] : 'r'.$i;
            //Construction de la requète
	        $sql.= "LEFT JOIN ".$relation['table']." ".$table_alias." ";
	        $sql.= "ON ".$table_alias.".".(is_array($relation['identifier']) ? $relation['identifier'][$relation['table']] : $relation['identifier'])." ";
	        $sql.= "= ".$join_alias.".".(is_array($relation['identifier']) ? $relation['identifier'][$join_table] : $relation['identifier'])." ";

	        //Sous relations
	        if(isset($relation['relations'])) $sql.= $this->getSqlRelations($relation['table'], $table_alias, $relation['relations'], $i);
	        //Increment
	        $i++;
	     }
		 return $sql;
	}
	
	private function getSqlRelationsFields($join_table,$join_alias,$relations, $i = 0)
	{	
		$sql = "";
		foreach($relations as $relation_index => $relation)
	    {		        
	        //Gestion alias
            $table_alias = isset($relation['alias']) ? $relation['alias'] : 'r'.$i;            
	        //Ajouts des champs à la sélection
	        foreach($relation['fields'] as $fieldkey => $field) 
	        	$sql.= $table_alias.".".(!is_int($fieldkey) ? $fieldkey : $field)."".(!is_int($fieldkey) ? " AS ".$field." " : "").",";

	        //Sous relations
	        if(isset($relation['relations'])) $sql.= $this->getSqlRelationsFields($relation['table'], $table_alias, $relation['relations'], $i);
	        //Increment
	        $i++;
	     }
		 return $sql;
	}
	
	private function setRelationValues($relations, $values)
	{			
		//Parcourt des relations
		foreach($relations as $relation)
		{

			//Parcourt des champs à extraire
			foreach($relation['fields'] as $relation_field)
			{
				$this->fields_values[$relation_field] = stripslashes($values[$relation_field]);
				if(isset($relation['relations'])) $this->setRelationValues($relation['relations'],$values);
			}
		}
	}
}

?>
