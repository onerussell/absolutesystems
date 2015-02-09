<?php
/**
 * Users Sub-Module: SubSys server-script
 *
 * @package    engine37 Catalog v3.0
 * @version    0.3b
 * @since      03.04.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */
require 'top.php';
require INC_PATH.'includes/classes/SubSys.php'; 

$JsHttpRequest =& new Subsys_JsHttpRequest_Php(DEF_CHARSET); 
$iso2_cntr = (!empty($_REQUEST['iso2_cntr'])) ? $_REQUEST['iso2_cntr'] : '';

if ('' == $iso2_cntr)
   exit();

require INC_PATH.'includes/classes/Geografy.php';

try
{
    $geo    =& new Geografy ($gDb, TB.'countries', TB.'countries_subdivisions', TB.'countries_cities');
    $st_ar =& $geo -> GetCities($iso2_cntr);
}
catch (Exception $exc)
{
    sc_error($exc);
}

$city_id = (!empty($_REQUEST['city_id'])) ? intval($_REQUEST['city_id']) : 0;

$field   = (isset($_REQUEST['field'])) ? $_REQUEST['field'] : 'city_id';

$gSmarty -> assign_by_ref('city_id', $city_id);
$gSmarty -> assign_by_ref('field'  , $field);
$gSmarty -> assign_by_ref('st_ar'  , $st_ar);
$gSmarty -> display('mods/UsersCities.tpl');

// ------------------------------------------------------------------------
require 'bottom.php';
?>
