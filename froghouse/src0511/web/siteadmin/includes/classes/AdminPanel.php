<?php
/**
 * Class encapsulate various base methods for work with Administration Panel
 *
 * @package    engine37 Catalog v3.0
 * @version    1.1a
 * @since      25.12.2005
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */
class AdminPanel
{

    public function __construct()
    {

    }#end constructor

    /**
     * Check current administrator session or make session
     *
     * @return int 0 on success session. 1 if specified login and password is correct. 2 on bad session. 3 on bad login or password
     */
    public function CheckLogin()
    {
        if (strlen(session_id()) <= 0 || empty($_SESSION['system_login']) || empty($_SESSION['system_session']))
        {
            $_SESSION['system_login']   = '';
            $_SESSION['system_session'] = '';

            if (!empty($_POST['system_login']) && !empty($_POST['system_pass']))
            {
                if (preg_match('/^\w+$/',$_POST['system_login']) && preg_match('/^\w+$/i',$_POST['system_pass'])
                    && ADMIN_LOGIN == $_POST['system_login'] && crypt($_POST['system_pass'], ADMIN_PASS_CRYPT) == ADMIN_PASS_CRYPT)
                {
                    $_SESSION['system_login']   = $_POST['system_login'];
                    $_SESSION['system_session'] = md5('hgJa31a'.$_POST['system_login'].'xNmz1ap'.session_id().'9iVcaY'.ADMIN_PASS_CRYPT.'piKnvB');
                    return 1;
                }
                else
                    return 3;
            }
            else
                return 2;
        }
        else
        {
            // Generate check value
            $compValue = md5('hgJa31a'.ADMIN_LOGIN.'xNmz1ap'.session_id().'9iVcaY'.ADMIN_PASS_CRYPT.'piKnvB');
            if (ADMIN_LOGIN == $_SESSION['system_login'] && $_SESSION['system_session'] == $compValue)
                return 0;
            else
                return 2;
        }
    }#CheckLogin

    /**
     * Check current administrator session or make session
     *
     * @param string $authMessage      message, for example 'Bad username'
     * @param string $redirectLocation url where the user after successful authorization should be redirected
     *
     * @return void
     */
    public function AuthForm($authMessage = '', $redirectLocation = CURRENT_URL)
    {
        global $gSmarty;

        if (isset($_POST['system_login']))
            $gSmarty -> assign('systemLogin', $_POST['system_login']);

        $gSmarty -> assign('authMessage'     , $authMessage);
        $gSmarty -> assign('redirectLocation', $redirectLocation);
        $gSmarty -> display('mods/AdminPanelAuthentication.tpl');

    }#AuthForm
}

?>