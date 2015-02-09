<?php
error_log("asasd");    
    require '_top.php';

    if ('' == $mod && isset($gSystemLogin) && '' != $gSystemLogin)
	{
	    uni_redirect(PATH_ROOT.'account.php'.(0 == $uinfo['status'] ? '?mod=admin' : ''));
	}
#*************************************************************
# Main part
#*************************************************************
    
                    
                      
try
{         
    switch ($mod)
    {
        #**********************************
        #           Profile page
        #**********************************        
        case 'profile':
            
            if (0 == $id)
            {
                $id = UID;
            }
           
            $pi =& $gUser -> Get($id);          
              
            $templ = '_admin_profile.tpl';
            $gSmarty -> assign_by_ref('pi', $pi);
            $gSmarty -> assign('content', $gSmarty -> fetch('mods/'.$templ));          
            $templ =  'index.tpl';  
        break;
        
        #***********************************
        #  Restore password
        #***********************************
       #Forgot
        case 'forgot':

            if (isset($_POST['UserInfo']) && 0 < count($_POST['UserInfo']))
            {
            	$forgoterr = array();

                if(
                      !isset($_POST['UserInfo']['email']) ||
                      !$gUser -> EmailValidate($_POST['UserInfo']['email'])   
                  )
                {
                    $forgoterr[] = 2;
                }

                if (0 == count($forgoterr))
                {
                	$u = $gUser -> Get( $gUser -> GetByEmail($_POST['UserInfo']['email']) );
                	if (!isset($u['email']) || $u['email'] != trim($_POST['UserInfo']['email']))
                	{
                		$forgoterr[] = 3;
                	}
                	else
                	{
                		$newPass = $gUser -> RestorePassword($u['uid'], $u['email']);
                		$gSmarty -> assign('newPass', $newPass);
                		$gSmarty -> assign('login',   $u['login']);
                		$gSmarty -> assign('SUPPORT_SITENAME', SUPPORT_SITENAME);

                		include CLASS_PATH.'Ctrl/Mail/libmail.php';
                        $m = new Mail;
                        $m -> From( SUPPORT_EMAIL );
                        $m -> Subject('Password restore system '.SUPPORT_SITENAME);
                        $m -> Priority(3);

                        $descr  = $gSmarty -> fetch('mails/newpass.tpl');
                        #deb($descr);
                        $m -> Body( $descr);
                        $m -> To( $u['email'] );
                        $m -> Send();

                		#all ok
                        uni_redirect(PATH_ROOT."index.php?mod=forgot&send=ok", 1);
                	}
                }

                $gSmarty -> assign_by_ref('forgoterr', $forgoterr);
                $gSmarty -> assign_by_ref('UserInfo',$_POST['UserInfo']);
            }
            if (isset($_REQUEST['send']) && 'ok' == $_REQUEST['send'])
            {
                $gSmarty -> assign('send', 1);
            }
            $templ = 'mods_main/_forgot.html';

        break;
                
        #******************************************************
        #            Main page
        #******************************************************
        default:        
            if (isset($gSystemLogin) && '' != $gSystemLogin)
	        { 
	        	uni_redirect(PATH_ROOT.'account.php'.(0 == $uinfo['status'] ? '?mod=admin' : ''));
	        }
	        #content  
	                   
        break;        
    }
   
}
catch (Exception $exc)
{
    sc_error($exc);
}
    
    #Display template
    if (!isset($templ))
    {
        $templ =  'login.html';
    }
    $gSmarty -> display($templ);

#*************************************************************
# End part
#*************************************************************
    $gDb -> disconnect();
    #echo 'Запросов '.$gCnt; 
?>