<?php
define('INC_PATH',''); // path for 'require' and 'include'
// =========================================================================
// Base PHP Configuration
// Include base configuration
require INC_PATH.'includes/config/main.php';
require INC_PATH.'includes/config/generated.php';
set_magic_quotes_runtime(0);
error_reporting(ERROR_LEVEL);
ini_set('display_startup_errors', ERROR_DISPLAY);
ini_set('display_errors'        , ERROR_DISPLAY);

// Session config and initialization
// session_save_path(INC_PATH.'includes/sessions');
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

define('CURRENT_URL', getenv('REQUEST_URI'));
define('CURRENT_SCP', getenv('SCRIPT_NAME'));
// =========================================================================
// Include base functions
require INC_PATH.'includes/libs/functions.php';

// =========================================================================
// Administration panel work only through SSL
if (SSL_ONLY && ( !isset($_SERVER['HTTPS']) || 'on' != $_SERVER['HTTPS']) )
    uni_redirect(CURRENT_URL, 3);

// =========================================================================
// PEAR and Database initialization
if (USE_LOCAL_PEAR)
{
    define('BX', getenv('DOCUMENT_ROOT').'/siteadmin/includes/libs/pear/');
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
    // Database connect
    try
    {
        $gDb =& DB::connect(DB_TYPE.'://'.DB_USER.':'.DB_PASS.'@'.DB_HOST.'/'.DB_NAME); // select db type
    }
    catch (Exception $exc)
    {
        sc_error($exc);
    }
}

$gDb -> setFetchMode(DB_FETCHMODE_ASSOC);

// =========================================================================
// Smarty initialization
require INC_PATH.'includes/libs/smarty/Smarty.class.php';
$gSmarty                  = new Smarty();
$gSmarty -> compile_check = true;
$gSmarty -> debugging     = false;    
$gSmarty -> template_dir  = INC_PATH.'includes/templates';
$gSmarty -> compile_dir   = INC_PATH.'includes/templates_compiled';
$gSmarty -> config_dir    = INC_PATH.'includes/langs';

$gSmarty -> config_load('default.conf','Authentication');

// =========================================================================
// Base Program variables
// 'siteAdr', 'redirectLocation' etc. is not variable or array elements names
// That is templates constants.
$gSmarty -> assign('siteAdr'          , PATH_ROOT); // Base web-path
$gSmarty -> assign('siteAdmin'        , PATH_ROOT_ADMIN.'includes/');
$gSmarty -> assign('redirectLocation' , CURRENT_URL);
$gSmarty -> assign('curScriptName'    , CURRENT_SCP);
$gSmarty -> assign('charset'          , DEF_CHARSET);
$gSmarty -> assign('supportSiteName'  , SUPPORT_SITENAME);
$gSmarty -> assign('supportEmail'     , SUPPORT_EMAIL);

// ========================================================================
// Check login and password of administrator
require INC_PATH.'includes/classes/AdminPanel.php';
session_start();  // Start session
$admin_obj  =& new AdminPanel();
$check_auth =  $admin_obj -> CheckLogin();

if ($check_auth >= 2)
{
    if (empty($_POST['redirectLocation']))
        $_POST['redirectLocation'] = CURRENT_URL;

    sc_exit(false);

    if ($check_auth == 2)
        $admin_obj -> AuthForm('', $_POST['redirectLocation']);
    else
        $admin_obj -> AuthForm($gSmarty -> get_config_vars('badAuth'), $_POST['redirectLocation']);

    exit();
}
else
    $gSystemLogin = $_SESSION['system_login'];


// =========================================================================
// Create History object for logging of all operations
require INC_PATH.'includes/classes/History.php';
try
{
    $hist =& new History($gDb, $gSystemLogin, TB.'history', RESULTS_COUNTER);

    $last_info =& $hist -> GetLastAccess($gSystemLogin, 'admin auth');
    $gSmarty -> assign('lastIP'  , $last_info['ip']);
    $gSmarty -> assign('lastDate', $last_info['date']);
    if ($check_auth == 1)
        $hist -> Add('admin auth','');
}
catch (Exception $exc) 
{
    sc_error($exc);
}

// =========================================================================
// Extended Program variables
// 'siteAdr', 'redirectLocation' etc. is not variable or array elements names
// That is templates constants.
$gSmarty->assign('systemLogin', $gSystemLogin);

if (defined('SID') && strlen(SID) > 0)
{
    $gSmarty -> assign('SIDQ','?'.SID);
    $gSmarty -> assign('SIDA','&'.SID);
}

?>