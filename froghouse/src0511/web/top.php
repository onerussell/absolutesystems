<?
#*************************************************************
# INIT
#*************************************************************

    #Include base functions
    define('INC_PATH', 'siteadmin/');
    require INC_PATH . 'includes/config/main.php';
    require INC_PATH . 'includes/config/generated.php';
    require INC_PATH . 'includes/libs/functions.php';

    set_magic_quotes_runtime(0);
    error_reporting(ERROR_LEVEL);
    ini_set('display_startup_errors', ERROR_DISPLAY);
    ini_set('display_errors'        , ERROR_DISPLAY);

    define('CURRENT_URL', getenv('REQUEST_URI'));
    define('CURRENT_SCP'    , getenv('SCRIPT_NAME'));
    define('CURRENT_REFERER', get_referer());

    define('IMAGE_DRIVER', 'GD');
    require INC_PATH.'includes/classes/Image_Transform.php';
    require INC_PATH.'includes/classes/Image_Transform_Driver_'.IMAGE_DRIVER.'.php';

    #PEAR and DB Init
    if (USE_LOCAL_PEAR)
    {
        define('BX', getenv('DOCUMENT_ROOT').'/includes/libs/pear/');
        chdir(INC_PATH.'includes/libs/pear/');
        include 'PEAR.php';
        include 'HTML/QuickForm.php';
        include 'HTML/QuickForm/Renderer/ArraySmarty.php';
        PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'pear_error_callback');

        include 'DB.php';
        // Database connect
        try
        {
            $gDb =& DB::connect(DB_TYPE.'://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME);
        }
        catch (Exception $exc)
        {
            sc_error($exc);
        }
        chdir(dirname(__FILE__));
    }
    else
    {
        include 'PEAR.php';
        include 'HTML/QuickForm.php';
        include 'HTML/QuickForm/Renderer/ArraySmarty.php';
        PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'pear_error_callback');
        include 'DB.php';
        try
        {
            $gDb =& DB::connect(DB_TYPE.'://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME);
        }
        catch (Exception $exc)
        {
            sc_error($exc);
        }
    }

    $gDb -> setFetchMode(DB_FETCHMODE_ASSOC);

    # Smarty initialization
    require INC_PATH.'includes/libs/smarty/Smarty.class.php';
    $gSmarty                  = new Smarty();
    $gSmarty -> compile_check = true;
    $gSmarty -> debugging     = false;
    $gSmarty -> template_dir  = 'includes/templates';
    $gSmarty -> compile_dir   = 'includes/templates_compiled';
    $gSmarty -> config_dir    = 'includes/langs/';
    $gSmarty -> plugins_dir   = array(
                                     'plugins',
                                     'includes/templates/plugins'
                                     );

    # Session config and initialization
    session_save_path('includes/sessions');
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
    }

    if (isset($_POST['UserInfo']['email']))
        $gSmarty -> assign('custom_email', $_POST['UserInfo']['email']);

    session_start();

    # / ==== Init users and check auth status ============================ \
    $gSmarty -> config_load('registration.conf');

    require INC_PATH.'includes/classes/Geografy.php';
    $geo    =& new Geografy($gDb, TB.'countries', TB.'countries_subdivisions', TB.'countries_cities');

    require INC_PATH.'includes/classes/Users.php';
    $user   =& new Users($gDb, TB.'users', TB.'countries', TB.'countries_cities', $geo, RESULTS_COUNTER);

    if (isset($_COOKIE['remember']))
    {
        $gSmarty -> assign('remember','1');
        $gSmarty -> assign('custom_email', @$_COOKIE['email']);
        if (!isset($_SESSION['UserInfoId']) || !isset($_SESSION['UserInfoSession']))
            $user -> Auth($_COOKIE, 'remember');
    }
    elseif (isset($_POST['UserInfo']['remember']))
        $gSmarty -> assign('remember','1');

    $gAuthUser = (isset($_SESSION['UserInfoId']) 
                  && isset($_SESSION['UserInfoSession'])) ? $user -> Auth($_SESSION, 'check') : false;

    $gSmarty -> assign('AuthUser', $gAuthUser);

    # \ ================================================================== /

    # Init catalog
    $gSmarty -> config_load('main.conf');

#*************************************************************
# Vars
#*************************************************************

    $gSmarty -> assign('curScriptName', CURRENT_SCP);
    $gSmarty -> assign('siteAdr'      , PATH_ROOT);
    $gSmarty -> assign('charset'      , DEF_CHARSET);
    $gSmarty -> assign('serverName'   , getenv('SERVER_NAME'));
    

    if (!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id']))
        $id = 0;
    else
        $id = $_REQUEST['id'];

    if (!isset($_REQUEST['mid']) || !is_numeric($_REQUEST['mid']))
        $mid = 0;
    else
        $mid = $_REQUEST['mid'];

    if ( !isset($_REQUEST['mod']) )
        $mod = '';
    else
        $mod = trim(strtolower($_REQUEST['mod']));
    $gSmarty -> assign('mod', $mod);

    if ( !isset($_REQUEST['action']) )
        $action = '';
    else
        $action = trim(strtolower($_REQUEST['action']));
    $gSmarty -> assign('action', $action);

    if ( !isset($_REQUEST['page']) || !is_numeric($_REQUEST['page']) )
        $page = 1;
    else
        $page = $_REQUEST['page'];

    #User Add
    
    if ($gAuthUser)
    {
        #Check user ID (for BLOG etc.)
        if ( isset($_REQUEST['uid']) && is_numeric($_REQUEST['uid']) )
        {
            $UID = $_REQUEST['uid'];
            if ($UID == $_SESSION['UserInfoId'])
                $is_user = 1;
            else
                $is_user = 0;
        }
        else
        {
            $UID     = $_SESSION['UserInfoId'];
            $is_user = 1;
        }

        $city_id    = (isset($_REQUEST['city_id']))   ? $_REQUEST['city_id']         : 0;      // - city id
       
        if (0 < $city_id)
        {
           $_SESSION['UserInfoCurrentCity'] = $city_id;
           $arr = $geo->GetCityName($_SESSION['UserInfoCurrentCity']);
           $_SESSION['UserInfoCurrentCityName'] = $arr['city_name'];
           $_SESSION['UserInfoCurrentCntrName'] = $arr['country_name'];

           $gSmarty -> assign('city_id'   , $city_id);
        }

        $UserInfoId              = $_SESSION['UserInfoId'];
        $UserInfoCurrentCityName = $_SESSION['UserInfoCurrentCityName'];
        $UserInfoCurrentCity     = $_SESSION['UserInfoCurrentCity'];
        $UserInfoCurrentCntrName = $_SESSION['UserInfoCurrentCntrName'];
        $UserInfoStatus          = $_SESSION['UserInfoStatus'];
        $UserInfoNickname        = $_SESSION['UserInfoNickname'];
        $UserInfoCity            = $_SESSION['UserInfoCity'];
        $UserInfoCityName        = $_SESSION['UserInfoCityName'];
        $UserInfoNickname        = $_SESSION['UserInfoNickname'];
        $uadmin                  = $_SESSION['UserAdmin'];

        $gSmarty -> assign('uadmin', $uadmin);

        $gSmarty -> assign('UserInfoCurrentCityName', $UserInfoCurrentCityName);
        $gSmarty -> assign('UserInfoCurrentCntrName', $UserInfoCurrentCntrName);
        $gSmarty -> assign('UserInfoCurrentCity'    , $UserInfoCurrentCity);
        $gSmarty -> assign('UserInfoStatus'         , $UserInfoStatus);
        $gSmarty -> assign('UserInfoCity'            , $UserInfoCity);
        $gSmarty -> assign('UserInfoCityName'        , $UserInfoCityName);

        $gSmarty -> assign('nickname'               , $UserInfoNickname);
        $gSmarty -> assign('is_user'                , $is_user);
        $gSmarty -> assign('uinfo'                  , array($_SESSION['UserInfoId'], $UID));
    }
?>