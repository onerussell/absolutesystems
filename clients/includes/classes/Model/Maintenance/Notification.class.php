<?php

include CLASS_PATH . 'Ctrl/Mail/libmail.php';

/**
 * Notification class
 * 
 * @package    Engine 37 catalog 3.1
 * @version    1.0
 * @since      24.10.2007
 * @copyright  2007 Engine 37 Team
 * @link       http://www.engine 37.com
 */
class Model_Maintenance_Notification
{
    
    public function __construct()
    {

    }

    public function Send(&$gUsers, &$gPg, &$gSmarty,
                         $action, $what, $uid, $uname, $project_id = 0, $internal = 0, $screen_id = 0, $comment = '')
    {
        //get Admins
        $al =& $gUsers -> GetUserList(1, 0);
        
        //get Other Users (for project with id = $project_id)
        $ol      = array();

        if ($internal) {
        	$subject = $subject.'[INTERNAL]'.$action;
	} else {
        	$subject = $action;
	}
       

        if (!empty($project_id))
        {
            $pn =  $gPg -> GetProject($project_id);
            if (!empty($pn))
            {
            	$ol =& $gPg -> GetProjectUsers($project_id);
            	$subject = '['.$pn['name'].'] '.$subject;
            }
        }   
        
        //prepare content
        $gSmarty -> assign('text', $action);
        $gSmarty -> assign('link', $what);
        $gSmarty -> assign('user', $uname);
        $gSmarty -> assign('user_id', $uid);
        $gSmarty -> assign('comment', $comment);
        $gSmarty -> assign('IP', getenv('REMOTE_ADDR'));
        
        
        $content_admin   = $gSmarty -> fetch('mails/mail_admin.tpl');
        $content_client  = $gSmarty -> fetch('mails/mail_clients.tpl');
        $content_manager = $gSmarty -> fetch('mails/mail_manager.tpl');
        $content_other   = $gSmarty -> fetch('mails/mail_other.tpl');
                
        //prepare  mails 
        //for admin
        $mA = new Mail;
        $mA -> From( 'do_not_reply@engine37.com' );
        $mA -> Subject($subject);
        $mA -> Priority(3);
        $mA -> Body( $mA -> Safe($content_admin) );
        
        //for clients
		
        if (!empty($project_id) && !$internal)
        {
         
			$mC = new Mail;
            $mC -> From( 'do_not_reply@engine37.com' );
            $mC -> Subject($subject);
            $mC -> Priority(3);
            $mC -> Body( $mA -> Safe($content_client) );        
        }
        
        //for managers
        $mM = new Mail;
        $mM -> From( 'do_not_reply@engine37.com' );
        $mM -> Subject($subject);
        $mM -> Priority(3);
        $mM -> Body( $mA -> Safe($content_manager) );  

        //for other users
        $mO = new Mail;
        $mO -> From( 'do_not_reply@engine37.com' );
        $mO -> Subject($subject);
        $mO -> Priority(3);
        $mO -> Body( $mA -> Safe($content_other) ); 
                    
            
        $ms = array();

        $curU = $gUsers -> Get(UID);
        if (!empty($curU))
        {
            $ms[] = $curU['email'];
        }
        
        //send to Admins
        foreach ($al as $k => &$v)
        {
        	if (!in_array($v['email'], $ms))
            {
                $mA   -> To( $v['email'] );
                $mA   -> Send();
                $mA   -> ClearTo();
                $ms[] =  $v['email'];
            } 
        }
        	
        //send to other users
        foreach ($ol as $k => &$v)
        {
		if (0 < strpos('_'.$v['email'],'empty')) {continue;}
        	if (1 == $v['status'] && !$internal && !empty($project_id) && !empty($mC))
        	{
        		//clients
        	    if (!in_array($v['email'], $ms))
                {
                    $mC   -> To( $v['email'] );
                    $mC   -> Send();
                    $mC   -> ClearTo();
                    $ms[] =  $v['email'];
                }  
        	}
        	elseif (1 != $v['status']) 
        	{
        		//other users
        	    if (!in_array($v['email'], $ms))
                {
                    if (2 == $v['status'])
                    {
                	    $mM -> To( $v['email'] );
                        $mM -> Send();
                        $mM -> ClearTo();
                        $ms[] = $v['email'];                    	
                    }
                    else
                    {
                	    $mO -> To( $v['email'] );
                        $mO -> Send();
                        $mO -> ClearTo();
                        $ms[] = $v['email'];
                    }    
                }         		
        	}

        }        
    
    	return true;
    }
}#Model_Maintenance_Notification