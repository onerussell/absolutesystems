<?php
/**
 * Users Module
 *
 * @package    engine37 Catalog v3.0
 * @version    0.3b
 * @since      02.04.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */

require 'top.php';

if (ADMIN_PAGE_GZ)
{
    header('Content-Encoding: gzip');

    function callback2($buffer) 
    {
        return gzencode($buffer, 9);
    }

    ob_start('callback2');
    ob_implicit_flush(0);
}

require INC_PATH.'includes/classes/Geografy.php';
require INC_PATH.'includes/classes/Users.php';
require INC_PATH.'includes/classes/BOpt.php';

// ------------------------------------------------------------------------
$geo    =& new Geografy ($gDb, TB.'countries', TB.'countries_subdivisions', TB.'countries_cities');
$user   =& new Users($gDb, TB.'users', TB.'countries', TB.'countries_cities', $geo, RESULTS_COUNTER);

// ------------------------------------------------------------------------
// Input parameters check and assign to smarty object
$action     = (isset($_REQUEST['action']))    ? $_REQUEST['action']          : 'view';   // - action -
$what       = (isset($_REQUEST['what']))      ? $_REQUEST['what']            : 'list';   // - object for action -
$type       = (isset($_REQUEST['type']))      ? $_REQUEST['type']            : 'catalog';// - list type: 'catalog' or 'list' -
$pvstart    = (isset($_REQUEST['pvstart']))   ? intval($_REQUEST['pvstart']) : 0;        // - page displaciment -
$ordercol   = (isset($_REQUEST['ordercol']))  ? $_REQUEST['ordercol']        : 'name';  // - database column for ordering -
$orderdesc  = (isset($_REQUEST['orderdesc'])) ? $_REQUEST['orderdesc']       : 'asc';    // - ordering direction

$iso2_cntr  = (isset($_REQUEST['iso2_cntr'])) ? $_REQUEST['iso2_cntr']       : '';    // - country iso2 code
$city_id    = (isset($_REQUEST['city_id']))   ? $_REQUEST['city_id']         : 0;      // - city id

$code       = (isset($_REQUEST['code']))      ? intval($_REQUEST['code'])    : 0    ;    // - error code, 0 if no errors

$status_sel = (isset($_REQUEST['status_sel']))? intval($_REQUEST['status_sel']): -1 ;

// ------------------------------------------------------------------------

$uid = (isset($_REQUEST['uid'])) ? intval($_REQUEST['uid']) : 0;

// ------------------------------------------------------------------------
// Load module configuration and set smarty
$gSmarty -> config_load('users.conf');
$main_content = '';
$gSmarty -> assign('action'    , $action);
$gSmarty -> assign('what'      , $what);
$gSmarty -> assign('type'      , $type);
$gSmarty -> assign('pvstart'   , $pvstart);
$gSmarty -> assign('ordercol'  , $ordercol);
$gSmarty -> assign('orderdesc' , $orderdesc);

$gSmarty -> assign('status_sel', $status_sel);

$gSmarty -> assign('iso2_cntr' , $iso2_cntr);
$gSmarty -> assign('city_id'   , $city_id);

$UserOpt     =& new BOpt($gDb, TB . 'optcat', TB . 'optel', 'people');
$UserOptions =& $UserOpt -> GetBlock();
$gSmarty -> assign_by_ref('UserOptions', $UserOptions);

try
{
    switch ($action)
    {
        case 'change':
            if ($what == 'user') // change user info
            {
                $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';
                if ($do == 1)
                {
                    $UserInfo = $_POST['UserInfo'];
                    if (isset($_REQUEST['cancel']))
                        a_redirect($ordercol, $orderdesc, $pvstart);
                    else
                    {
                        try
                        {
                            if (empty($UserInfo['onmain']))
                                $UserInfo['onmain'] = 0;
                            $user->Change($uid, $UserInfo);
                            $hist -> Add('change', 'User "'.$_POST['UserInfo']['email'].'"');
                            a_redirect($ordercol, $orderdesc, $pvstart);
                        }
                        catch (UsersException $cexc)
                        {
                            $gSmarty -> assign('UserLastError', $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                        }
                    }
                }
                else
                {
                    try
                    {
                        $UserInfo =& $user->Get($uid);
                    }
                    catch (UsersException $cexc)
                    {
                        a_redirect($ordercol, $orderdesc, $pvstart, $cexc -> getCode());
                    }
                }
    
                $UserInfo['uid'] = $uid;
    
                $gSmarty -> assign_by_ref('UserInfo', $UserInfo);

                $cntr_ar =& $geo -> GetCountries();
                $gSmarty -> assign_by_ref('cntr_ar', $cntr_ar);

                $main_content .= $gSmarty->fetch('mods/Users.tpl');
            }
            else if ($what == 'status') // change user status
            {
                $hist -> Add('change','Status of user # '.$uid.': "'.(('1' == $_REQUEST['status']) ? 'enabled':'disabled').'"');
                $user -> ChangeStatus($uid, $_REQUEST['status']);
                a_redirect($ordercol, $orderdesc, $pvstart);
            }
    
            break;
    
        case 'add':
            if ($what == 'user') // add new user
               {
                $do = (isset($_REQUEST['do'])) ? $_REQUEST['do'] : '';
                if ($do == 1)
                {
                    if (isset($_REQUEST['cancel']))
                        a_redirect($ordercol, $orderdesc, $pvstart);
                    else
                    {
                        try
                        {
                            $user -> Add($_POST['UserInfo']);
                            $hist -> Add('add','User "'.$_POST['UserInfo']['email'].'"');
                            $gSmarty -> assign_by_ref('UserInfo',$_POST['UserInfo']);
                            a_redirect($ordercol, $orderdesc, $pvstart);
                        }
                        catch (UsersException $cexc)
                        {
                            $gSmarty -> assign('UserLastError'   , $gSmarty -> get_config_vars('UserErr_'.$cexc -> getCode()));
                            $gSmarty -> assign_by_ref('UserInfo' , $_POST['UserInfo']);
                        }
                    } 
                }
                else
                {
                    $UserInfo['iso2_cntr'] = 'US';
                    $gSmarty -> assign_by_ref('UserInfo' , $UserInfo);
                }

                $cntr_ar =& $geo -> GetCountries();
                $gSmarty -> assign_by_ref('cntr_ar', $cntr_ar);

                $main_content .= $gSmarty -> fetch('mods/Users.tpl');
               }
            break;

        case 'view':
            $what = $type;

            if ($what == 'list' || ($what == 'catalog' && 0 < $city_id)) // users list
            {
                if ($code > 0)
                    $gSmarty -> assign('UserLastError', $gSmarty -> get_config_vars('UserErr_'.$code));

                if ('list' ==  $what)
                    $UA =& $user->GetAll($pvstart, $ordercol, $orderdesc, 0, $status_sel);
                else
                    $UA =& $user->GetAll($pvstart, $ordercol, $orderdesc, $city_id, $status_sel);

                $gSmarty -> assign_by_ref('UA', $UA);

                if (0 < $city_id)
                {
                    $cycrNames =& $geo -> GetCityName($city_id);
                    $gSmarty -> assign_by_ref('cycrNames', $cycrNames);
                }

                // Generate data for paginal viewing
                if ($user -> ResOnPage() > 0)
                {
                    $cnt   = $user -> Count($city_id);
                    $pages = ceil($cnt / $user -> ResOnPage());
                    $gSmarty -> assign_by_ref('pages', $pages);
                    $pgArr = array();
                    for ($i = 0; $i < $pages; $i++)
                    {
                        $pgArr[] = $i * $user -> ResOnPage();
                    }
                    $gSmarty -> assign_by_ref('pgArr', $pgArr);
                    $gSmarty -> assign('curPage'     , floor($pvstart / $user -> ResOnPage()));
                    $gSmarty -> assign('ResOnPage'   , $user -> ResOnPage());
                }
                else
                   $gSmarty -> assign('pages',1);
    
            }
            elseif ($what == 'catalog')
            {
                if ('' != $iso2_cntr)
                {
                    $countryName = $geo -> GetCountryName($iso2_cntr);
                    $cities =& $user -> GetCities($iso2_cntr);

                    $gSmarty -> assign_by_ref('cities', $cities);
                    $gSmarty -> assign('countryName', $countryName);
                }
                else
                {
                   $countries =& $user -> GetCountries();
                   $gSmarty -> assign_by_ref('countries', $countries);
                }
            }

           $main_content .= $gSmarty->fetch('mods/Users.tpl');
    
            break;
        case 'delete':
            if ($what == 'user') // delete specified user only (his orders is not deleted)
            {
                $user -> Delete($uid);
                $hist -> Add('delete','User # '.$uid);
                a_redirect($ordercol, $orderdesc, $pvstart);
            }
            break;
    }
}
catch (Exception $exc)
{
    sc_error($exc);
}

//compile templates-------------------------------------

$gSmarty->assign_by_ref('main_content',$main_content);
$gSmarty->display('main_template.tpl');

// ------------------------------------------------------------------------
require 'bottom.php';

function a_redirect($orderCol, $orderDesc, $pvStart, $code = 0)
{
    global $type, $iso2_cntr, $city_id;
    $code    = intval($code);
    $pvStart = intval($pvStart);
    uni_redirect(CURRENT_SCP.'?action=view&what=list&ordercol='.$orderCol.'&orderdesc='.$orderDesc.'&pvstart='.$pvStart.'&code='.$code.'&type='.$type.'&city_id='.$city_id.'&iso2_cntr='.$iso2_cntr);
}
 
?>