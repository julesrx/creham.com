<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty sizeof modifier plugin
 *
 * Type:     modifier<br>
 * Name:     sizeof<br>
 * Purpose:  retourne la taille d'un tableau
 * @param array
 * @return string
 */
function smarty_function_sizeof($params)
{    
	//print_r($params);
	return sizeof($params['liste']);
}

?>
