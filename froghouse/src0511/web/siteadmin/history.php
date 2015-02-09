<?php
/**
 * History Module
 *
 * @package    engine37 Catalog v3.0
 * @version    0.2b
 * @since      25.12.2005
 * @copyright  2004-2005 engine37.com
 * @link       http://engine37.com
 */

require 'top.php';
$main_content = '';
// ------------------------------------------------------------------------
// Input parameters check and assign to smarty object
$action     = (isset($_REQUEST['action']))     ? $_REQUEST['action']          : 'view'; // - action -
$what       = (isset($_REQUEST['what']))       ? $_REQUEST['what']            : 'list'; // - object for action -
$pvstart    = (isset($_REQUEST['pvstart']))    ? intval($_REQUEST['pvstart']) :  0;     // - page displaciment -
$start_date = (isset($_REQUEST['start_date'])) ? $_REQUEST['start_date']      : -1;     // - database column for ordering -
$end_date   = (isset($_REQUEST['end_date']))   ? $_REQUEST['end_date']        : -1;     // - ordering direction

$gSmarty -> assign('action'    , $action);
$gSmarty -> assign('what'      , $what);
$gSmarty -> assign('pvstart'   , $pvstart);
$gSmarty -> assign('start_date', $start_date);
$gSmarty -> assign('end_date'  , $end_date);

$_REQUEST['log_id'] = (isset($_REQUEST['log_id'])) ? intval($_REQUEST['log_id']) : 0;

try 
{
    switch ($action)
    {
        case 'view':
            if ($what == 'list') // users list
            {
                $HA =& $hist->GetAll($pvstart, $start_date, $end_date);
        
                $gSmarty->assign_by_ref('HA', $HA);
               
                // Generate data for paginal viewing
                if ($hist->ResOnPage() > 0)
                {
                    $cnt   =& $hist->Count($start_date, $end_date);
                    $pages =  ceil($cnt / $hist->ResOnPage());
               
                    $gSmarty->assign_by_ref('pages', $pages);
                    $pg_arr = array();
                    for ($i = 0; $i < $pages; $i++)
                    {
                        $pg_arr[] = $i * $hist->ResOnPage();
                    }
                    $gSmarty->assign_by_ref('pgArr',$pg_arr);
                    $gSmarty->assign('curPage',floor($pvstart / $hist->ResOnPage() ));
                    $gSmarty->assign('ResOnPage',$hist->ResOnPage());
                   }
                else
                   $gSmarty->assign('pages',1);
               
                $main_content .= $gSmarty->fetch('mods/History.tpl');
            }
        
            break;
        case 'delete':
            if ($what == 'record') // delete specified record
            {
                $hist -> DeleteRecord($_REQUEST['log_id']);
                a_redirect($start_date,$end_date,$pvstart);
            }
            else if ($what == 'all')
            {
                $hist -> DeleteAll();
                a_redirect($start_date, $end_date, $pvstart);
            }
            break;
        
        default:
            a_redirect($start_date, $end_date, $pvstart);
            break;
    }
}
catch (Exception $exc) 
{
    sc_error($exc);
}

//compile templates-------------------------------------

$gSmarty->assign_by_ref('main_content', $main_content);
$gSmarty->display('main_template.tpl');

// ------------------------------------------------------------------------
require 'bottom.php';

function a_redirect($startDate, $endDate, $pvStart)
{
    uni_redirect(CURRENT_SCP.'?action=view&what=list&start_date='.$startDate.'&end_date='.$endDate.'&pvstart='.$pvStart);
}
?>