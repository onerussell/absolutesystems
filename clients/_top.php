<?php
    #*************************************************************
    # INIT
    #*************************************************************
    $gCnt = 0;
    #ini_set('include_path','.:/usr/local/php5/PEAR:/www/d5dev/users/d5dev-mamba/www/htdocs/siteadmin/includes/libs/PEAR');

    #Include base functions
    define('INC_PATH', '');
    define('CLASS_PATH', INC_PATH.'includes/classes/');
    
    require INC_PATH . 'includes/config/main.php';
    require INC_PATH . 'includes/libs/main.php';

    set_magic_quotes_runtime(0);
    error_reporting(ERROR_LEVEL);
    ini_set('display_startup_errors', ERROR_DISPLAY);
    ini_set('display_errors'        , ERROR_DISPLAY);

    define('CURRENT_URL'    , getenv('REQUEST_URI'));
    define('CURRENT_SCP'    , getenv('SCRIPT_NAME'));
    define('CURRENT_REFERER', get_referer());

    require_once CLASS_PATH.'Ctrl/Storage/Main.class.php';
    
#******************************************************
#            PEAR and Database initialization
#******************************************************       

    require 'PEAR.php';
    require 'HTML/QuickForm.php';
    require 'HTML/QuickForm/Renderer/ArraySmarty.php';
    PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'pear_error_callback');

    require 'DB.php';
    $gDb =& DB::connect(DB_TYPE.'://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME); // select db type

    $gDb -> query('SET NAMES utf8');
    $gDb -> setFetchMode(DB_FETCHMODE_ASSOC);
    
#******************************************************
#            Smarty initialization
#******************************************************    


//    require CLASS_PATH . 'View/Smarty/Smarty.class.php';
//    $gSmarty                  = new Smarty();

	require('Smarty/Smarty.class.php');

error_log("111sessdsfsdf");
	$gSmarty = new Smarty();

	$gSmarty->use_sub_dirs = false;

	$smarty_basepath = BPATH;
	$gSmarty->template_dir = $smarty_basepath.'includes/templates';
	$gSmarty->compile_dir = $smarty_basepath.'files/templ';
	$gSmarty->cache_dir = $smarty_basepath.'cache';
	$gSmarty->config_dir = $smarty_basepath.'includes/conf';

    $gSmarty -> plugins_dir   = array(
                                     'plugins',
                                     );



    $gSmarty -> compile_check = true;
    $gSmarty -> debugging     = false;
error_log($gSmarty->config_dir.'/main.conf');
    $gSmarty -> config_load($gSmarty->config_dir.'/main.conf');
error_log("114sessdsfsdf");

    $glObj = array(
                   'db'     => &$gDb,
                   'smarty' => &$gSmarty
                  );

error_log("115sessdsfsdf");
    # Session config and initialization
    session_save_path('files/sessions');
    session_name(SESSION_NAME);

    if (SESSION_ID_IN_URL)
    {
        ini_set('session.use_trans_sid'   ,'1');
        ini_set('session.use_only_cookies','0');
    }
    else
    {
        ini_set('session.use_trans_sid'   ,'0');
        ini_set('session.use_only_cookies','1');
		ini_set('session.cookie_domain', '.'.DOMEN);
    }
    session_start();  // Start session

error_log("sessdsfsdf");

#*************************************************************
# Template vars
#*************************************************************   
    $gSmarty -> config_load('main.conf');

    $gSmarty -> assign('curScriptName', CURRENT_SCP);
    $gSmarty -> assign('siteAdr'      , PATH_ROOT);
    
    $gSmarty -> assign('imgDir'           , PATH_ROOT.'includes/templates/imgs/');
    $gSmarty -> assign('stlDir'           , PATH_ROOT.'includes/templates/');
    $gSmarty -> assign('jsDir'            , PATH_ROOT.'includes/templates/js/');
    
    $gSmarty -> assign('charset'      , DEF_CHARSET);
    $gSmarty -> assign('serverName'   , getenv('SERVER_NAME'));
        
#*************************************************************
# Check login and password of administrator
#*************************************************************
    # include Users class
    require CLASS_PATH.'Model/Security/Users.php';
    $gUser = new Users($gDb, array('table'        => TB . 'admin_users'),
                      					  20);
    if (!empty($_REQUEST['logout']))
    {
        $gUser -> Logout();
        uni_redirect(PATH_ROOT);
    }

	
    $check_auth = $gUser -> CheckLogin(CURRENT_SCP, 1);
    if ($check_auth >= 2)
    {
        if (isset($_POST['system_login']))
        {
            $gSmarty -> assign('check_auth', $check_auth);
        }
    }
    else
    {
        $gSystemLogin   = $_SESSION['system_login'];
        $gSystemStatus  = $_SESSION['system_status'];
        $gSystemModules = $_SESSION['system_modules'];
        $gSmarty        -> assign('system_login'  , $gSystemLogin);
        $gSmarty        -> assign('system_status' , $gSystemStatus);
        $gSmarty        -> assign('system_modules', $gSystemModules);
        define('UID', $gUser -> GetByLogin($gSystemLogin));
        $uinfo          =& $gUser -> Get(UID); 
        $gSmarty        -> assign('UserInfo', $uinfo); 
        $uid     = UID;	
        
        include_once CLASS_PATH . 'Model/Maintenance/History.class.php';
        $gHist   =& new Model_Maintenance_History($glObj, TB.'history', TB.'history_view', TB.'project');	

        include_once CLASS_PATH . 'Model/Maintenance/Notification.class.php';
        $gNotify =& new Model_Maintenance_Notification();

    }

#*************************************************************
# Vars
#*************************************************************

    $id     = (!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) ? 0 : $_REQUEST['id'];
    $sid    = (!isset($_REQUEST['sid']) || !is_numeric($_REQUEST['sid'])) ? 0 : $_REQUEST['sid'];
    $mod    = ( !isset($_REQUEST['mod']) ) ? '' : trim(strtolower($_REQUEST['mod']));
    $action = ( !isset($_REQUEST['action']) ) ? '' : trim(strtolower($_REQUEST['action']));
    $page   = (isset($_REQUEST['page']) && is_numeric($_REQUEST['page']) && 0 < $_REQUEST['page']) ? $_REQUEST['page'] : 1; 
    $sc_id  =  (!empty($_REQUEST['sc_id']) && is_numeric($_REQUEST['sc_id'])) ? $_REQUEST['sc_id'] : 0;
    
    $gSmarty -> assign('mod', $mod);
    $gSmarty -> assign('action', $action);
    
    $bc     = array();   

    require_once CLASS_PATH.'Ctrl/Image/Image_Transform.php';
    require_once CLASS_PATH.'Ctrl/Image/Image_Transform_Driver_GD.php';    
    
    include CLASS_PATH.'Model/Main/Project_Model.php';
    $gPg = new Project_Model($gDb, array('projects' => TB . 'project', 'project_users' => TB . 'project_users', 'users' => TB . 'admin_users', 'screens' => TB . 'screens'));

    //Rewrite
    if ('clients' == $mod)
    {
	    if (empty($_REQUEST['path']))
	    {
		    uni_redirect(PATH_ROOT.'index.php');
		}
    	$path = explode('/', $_REQUEST['path']);
    	$pa   = array();
    	foreach ($path as $k => $v)
    	{
    		if (!empty($v))
    		{
    			$pa[] = $v;
    		}
    	}
        unset($path);

    	if (is_array($pa))
    	{
    	    list($k, $v) = each($pa);
    		$id = $gPg -> GetProjectIDByName(strtr($v, array('_' => ' ')));
    				
    	    if ($id)
            {    
            	 list($k, $v)   = each($pa);
            	 list($k1, $v1) = each($pa);
            	 $x = 0;
            	 if ($v1 && 'rev0' != $v1)
            	 {
            	     $x = $gPg -> GetScreenIDByLink($v.'/'.$v1, $id);            	     	
            	 }
            	 if (!$x)
            	 {
            	     $x = $gPg -> GetScreenIDByLink($v, $id);
            	     
            	     if ($x)
            	     {
            	         $sid = $x;	
            	         if ('rev0' != $v1)
            	         {
            	         	$sc_id    = $sid;
            	         	$sid      = 0;
            	         }            	         
            	     }
            	     else 
            	     {
            	         $acta = array('history', 'map');
            	         if (in_array(strtolower($v), $acta)) 
                         {
                             $action = strtolower($v);	
                         }	
            	     }
            	 }
            	 else 
            	 {
            	 	 $sid = $x;
            	 }
            }
    	}
    }
   
?>