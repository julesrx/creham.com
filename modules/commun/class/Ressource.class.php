<?php
class Ressource extends ObjectModel
{
	protected $table = 'ressource';
	
	protected $fields = array('res_id','elt_id', 'elt_type', 'res_ordre', 'res_titre', 'res_contenu', 'res_mime');		

	function removeByElt($elt_id, $elt_type)
	{
		$sql = "DELETE FROM ressource WHERE elt_id = ? AND elt_type = ?";
		$p = Db::get()->Prepare($sql);
	    $rs = Db::get()->Execute($p,array($elt_id, $elt_type));	
	}
		
}
	
?>
