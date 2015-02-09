<?php
/**
 * Options module
 *
 * @package    engine37 Catalog v3.0
 * @version    0.1
 * @since      13.04.2005
 * @copyright  2004-2005 engine37.com
 * @link       http://engine37.com
 */

    require 'top.php';
    require INC_PATH.'includes/classes/BOpt.php';
    $opt = new BOpt($gDb, TB . 'optcat', TB . 'optel');

    #Vars

    $bl   =  array(
                   'people'   =>  'People', 
                   'bars'     =>  'Nightlife - Bars',
                   'clubs'    =>  'Nightlife - Clubs/Discos',

                   'museums'  =>  'Culture - Museums',
                   'parks'    =>  'Culture - Parks',
                   'fests'    =>  'Culture - Festivals',
                   'trips'    =>  'Culture - Day Trips',
                   'live'     =>  'Culture - Live Performances',
                   'churches' =>  'Culture - Churches',
                   'interest' =>  'Culture - Places of Interest',
                   'shops'    =>  'Culture - Shops',

                   'quick'    =>  'Food - Quick Eats',
                   'sitdown'  =>  'Food - Sit Down Places',
                   'coffe'    =>  'Food - Coffee Shops',
                   'pubs'     =>  'Food - Pubs',

                   'hostels'    => 'Lodging - Hostels',
                   'hotels'     => 'Lodging - Hotels',
                   'apartments' => 'Lodging - Apartments',
                   'campings'   => 'Lodging - Campings',

                   'money'    =>  'Necessities - Money',
                   'health'   =>  'Necessities - Health and Safety',
                   'around'   =>  'Necessities - Getting Around',
                   'lingo'    =>  'Necessities - Local Lingo',
                   'random'   =>  'Necessities - Random'
                   );


    $action = (isset($_REQUEST['action']))    ? $_REQUEST['action']    :  '';
    $gSmarty -> assign('action', $action);

    $id     = (isset($_REQUEST['id']) && is_numeric($_REQUEST['id']))    ? $_REQUEST['id']    :  0;
    $gSmarty -> assign('id', $id);

    $cid    = (isset($_REQUEST['cid']))    ? $_REQUEST['cid']    :  0;
    $gSmarty -> assign('cid', $cid);

    #Main part
    try
    {
        switch ($action)
        {
            #edit option values
            case 'change':

                if ($id > 0)
                {
                    $def = $opt -> GetEl($id);
                    $gSmarty -> assign('id', $_REQUEST['id']);
                }
                $def['action'] = $action;
                $def['cid']    = $cid;

                #add elements to form
                $form = new HTML_QuickForm('eform', 'post');
                $form -> addElement('submit', 'btnSubmit', 'Submit');
                if ($id > 0)
                {
                   $form -> addElement('hidden', 'id');
                }
                $form -> addElement('hidden', 'action');
                $form -> addElement('hidden', 'cid');
                $form -> addElement('text', 'sortid',  'Sort', array('size'=>15, 'maxlength'=>5));
                $form -> addElement('text', 'val',      $gSmarty -> _config[0]['vars']['value'], array('size' => 30, 'maxlength' => 255));

                #Set default values
                $form -> setDefaults($def);

                #form rules
                $form -> addRule('val', $gSmarty -> _config[0]['vars']['value'].' '.$gSmarty -> _config[0]['vars']['isreq'], 'required');
                $form -> applyFilter('val', 'trim');

                #validate
                if ($form -> validate())
                {
                    $form -> freeze();
                    $opt -> AddEl($_REQUEST);
                    header("location:".CURRENT_SCP.'?cid='.$cid);
                }
                else
                {
                #render for smarty
                    $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                    $form    -> accept($renderer);
                    $gSmarty -> assign('fdata', $form -> toArray());
                }
            break;

            #delete option values
            case 'delp':
                if ($id > 0 && isset($_REQUEST['do']) && $_REQUEST['do'] == 1)
                {
                    $opt -> DelEl($_REQUEST['id']);
                    header("location:" . CURRENT_SCP.'?cid='.$cid);
                }
                elseif ($id > 0)
                {

                    $gSmarty -> assign( 'inf', $opt -> GetEl($id) );
                }
            break;


            #edit options
            case 'edit':

                if (isset($_REQUEST['cid']))
                {
                    $def = $opt -> GetCat($_REQUEST['cid']);
                    $gSmarty      -> assign('cid', $_REQUEST['cid']);
                    $def['cid']   =  $cid;
                }
                $def['action'] = $action;

                #add elements to form
                $form = new HTML_QuickForm('eform', 'post');
                $form -> addElement('submit', 'btnSubmit', 'Submit');
                if (isset($_REQUEST['cid']))
                {
                   $form -> addElement('hidden', 'cid');
                   $form -> addElement('hidden', 'id');
                }
                $form -> addElement('hidden', 'action');
                $form -> addElement('text', 'sortid',  'Sort', array('size'=>15, 'maxlength'=>5));
                $form -> addElement('text', 'name',    'Option name', array('size'=>30, 'maxlength'=>255));
                $form -> addElement('hidden', 'cname');

                $form -> addElement('select', 'block',  'Block', $bl);
                $ct   =  array('select' => 'select', 'text' => 'text' );
                $form -> addElement('select', 'ctype',  'Option type', $ct);
                $form -> setDefaults($def);

                #form rules
                $form -> addRule('name', 'Option name'.' '.$gSmarty -> _config[0]['vars']['isreq'], 'required');
                $form -> applyFilter('name', 'trim');

                #validate
                if ($form -> validate())
                {
                   $form -> freeze();
                   $opt -> AddCat($_REQUEST);
                   header("location:".CURRENT_SCP);
                }
                else
                {
                #render for smarty
                    $renderer =& new HTML_QuickForm_Renderer_ArraySmarty($tpl);
                    $form -> accept($renderer);
                    $gSmarty -> assign('fdata', $form -> toArray());
                }
            break;

            #delete option
            case 'delcat':
                if (isset($_REQUEST['cid']) && isset($_REQUEST['do']) && $_REQUEST['do'] == 1)
                {
                    $opt -> DelCat($_REQUEST['cid']);
                    header("location:".CURRENT_SCP);
                }
                elseif ($cid > 0)
                {

                    $gSmarty -> assign( 'inf', $opt -> GetCat($_REQUEST['cid']) );
                }
            break;

        }

        if ($cid == 0)
        {
            $cx =& $opt -> GetCatList();
            for ($i = 0; $i < count($cx); $i++)
                $cx[$i]['block'] = @$bl[$cx[$i]['block']];
            $gSmarty -> assign('category', $cx);
        }
        else
        {
            $gSmarty -> assign('product', $opt -> GetElList($cid));
        }

    }
    catch (Exception $e)
    {
        echo $e -> getMessage();
        exit;
    }

    #display and close
    $mc = $gSmarty -> fetch('mods/Opt.tpl');
    $gSmarty -> assign('main_content', $mc);
    $gSmarty -> display('main_template.tpl');
    require 'bottom.php';
?>

