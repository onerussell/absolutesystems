<?php
/**
 * Image Module
 *
 * @package    engine37 Catalog v3.0
 * @version    0.1
 * @since      21.01.2005
 * @copyright  2004-2005 engine37.com
 * @link       http://engine37.com
 */

require 'top.php';


    $gSmarty -> config_load('default.conf', 'mpimg');

    #Init
    include 'includes/classes/Mpimg.php';
    $mban = new Mpimg($gDb, TB.'mpimg');

    #Vars
    $action = (isset($_REQUEST['action']))    ? $_REQUEST['action']    :  '';
    $gSmarty -> assign('action', $action);

    #Main part
    try
    {

        switch ($action)
        {
            #edit categories
            case 'change':

                $def['action'] = $action;

                #add elements to form
                $form = new HTML_QuickForm('eform', 'post');
                $form -> addElement('submit', 'btnSubmit', 'Submit');
                $form -> addElement('hidden', 'action');
                $form -> addElement('text', 'name',   $gSmarty -> _config[0]['vars']['name'], array('size'=>20, 'maxlength'=>255));
                $form -> addElement('hidden', 'path', DIR_WS_IMAGE);

                $file =& $form -> addElement('file', 'image', $gSmarty -> _config[0]['vars']['image']);
                #form rules
                $form -> addRule('name', $gSmarty -> _config[0]['vars']['name'].' '.$gSmarty -> _config[0]['vars']['isreq'], 'required');

                $form -> applyFilter('name', 'trim');
                $def['action'] = $action;
                $form -> setDefaults($def);

                if ($form -> validate() && !$file -> isUploadedFile())
                    $form -> _errors['image'] = $gSmarty -> _config[0]['vars']['image'].' '.$gSmarty -> _config[0]['vars']['isreq'];

                #validate
                if ($form -> validate() && $file -> isUploadedFile())
                {
                    $form -> freeze();

                    #check originality
                    $i    = explode('.', $file -> _value['name']);
                    $ic   = $i[0];
                    $k    = 0;
                    while (file_exists(DIR_WS_IMAGE . '/' . $ic.'.'.$i[1]))
                    {
                        $ic = $i[0] . $k;
                        $k ++;
                    }
                    $file -> _value['name'] = $ic.'.'.$i[1];

                    #upload
                    $file -> moveUploadedFile($form -> _submitValues['path']);
                    $ar = array($form -> _submitValues['name'],
                                $file -> _value['name']
                               );
                    $mban -> Add($ar);
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

            #delete categories
            case 'delban':
                if (isset($_REQUEST['id']) && isset($_REQUEST['do']) && $_REQUEST['do'] == 1)
                {
                    $mban -> Del($_REQUEST['id']);
                    header("location:".CURRENT_SCP);
                }
                elseif (isset($_REQUEST['id']))
                {
                    $gSmarty -> assign( 'inf', $mban -> Get($_REQUEST['id']) );
                }
            break;

            #default output
            default:
        }

        $gSmarty  ->  assign( 'category', $mban -> GetList() );

    }
    catch (Exception $e)
    {
        echo $e -> getMessage();
        exit;
    }

    #display and close
    $mc = $gSmarty -> fetch('mods/Mpimg.tpl');
    $gSmarty -> assign('main_content', $mc);
    $gSmarty -> display('main_template.tpl');
    require 'bottom.php';
?>