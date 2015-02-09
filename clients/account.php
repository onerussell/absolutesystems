<?php

    include_once '_top.php';
    $gSmarty -> assign('DOMEN', DOMEN); 
#*************************************************************
# Main part
#*************************************************************
try
{
    $status_ar = array('0' => 'Administrator',
                       '1' => 'Client',
                       '2' => 'Manager',
                       '3' => 'Designer',
                       '4' => 'Programmer'
                      );
    $gSmarty -> assign_by_ref('status_ar', $status_ar); 

    $gSmarty -> assign('image_dir', DIR_NAME_IMAGE);
    $gSmarty -> assign('resize_dir', DIR_NAME_RESIZE);
	$gSmarty -> assign('resize_dir_new', DIR_NAME_RESIZE.'_new');
	$gSmarty -> assign('resize_dir_ok', DIR_NAME_RESIZE.'_ok');
	
    switch ($mod)
    {
    	#*****************************
    	#  Admin panel
    	#*****************************
    	case 'admin':
    		
            if (!isset($gSystemLogin) || '' == $gSystemLogin)
            {
                uni_redirect(PATH_ROOT);
            }
               		
    		if (0 < $uinfo['status'])
    		{
    			uni_redirect(PATH_ROOT . 'account.php');
    		}
    		

            $prj_status = isset($_GET['prj_status']) ? $_GET['prj_status'] : 1;
            $act     = (!empty($_REQUEST['act']) && 1 <= $_REQUEST['act'] && 3 >= $_REQUEST['act']) ? $_REQUEST['act'] : 0; 
    	    $pfilt   = (!empty($_REQUEST['pf']) && is_numeric($_REQUEST['pf'])) ? $_REQUEST['pf'] : 0;
    		$gSmarty -> assign('pf', $pfilt);
            $gSmarty -> assign('act', $act);

            $gSmarty -> assign_by_ref('pl', $gPg -> GetProjectsList($prj_status));

    		$what    = (!empty($_REQUEST['what']) && (1 == $_REQUEST['what'] || 2 == $_REQUEST['what'])) ? $_REQUEST['what'] : 0;	        
    		$gSmarty -> assign('what', $what);
    		
    		include CLASS_PATH . 'View/Acc/Pagging.php'; 
    		$pcnt    =   40;
    		$rcnt    =   $gHist -> GetCount( (empty($pfilt)) ? -1 : array($pfilt) , -1, $act, $what);
    		$mpage   =   new Pagging($pcnt,
                                     $rcnt,
                                     $page,
                                     PATH_ROOT.'account.php?mod=admin&amp;act='.$act.($pfilt ? '&amp;pf='.$pfilt : ''));
		    $gSmarty -> assign('rcnt', $rcnt);
            $range   =& $mpage -> GetRange();
            $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
		    $gSmarty -> assign('pagging',  $mpage  -> Make()); 	    			    
		    $gSmarty -> assign_by_ref('hist', $gHist -> GetList( (empty($pfilt)) ? -1 : array($pfilt) , -1, $range[0], $pcnt, $uid, $act, $what));
    		$gSmarty -> assign('_content', $gSmarty -> Fetch('mods/admin/_main.html'));
    	break;
    	
    	#*****************************
    	#Add && Edit Users
    	#*****************************
    	case 'add_user':
    		
            if (!isset($gSystemLogin) || '' == $gSystemLogin)
            {
                uni_redirect(PATH_ROOT);
            }    		
    		if (0 < $uinfo['status'])
    		{
    			uni_redirect(PATH_ROOT . 'account.php');
    		}
    		    
    		if (isset($_REQUEST['delp']) && 1 == $_REQUEST['delp'])	
    		{
    			$gUser -> DelPhoto($id);
    		}
            if (isset($_POST['einfo']) && 0 < count($_POST['einfo']))
            {
                try
                {                             
                    if (0 < $id)
                    {
                        $gUser   -> Change($id, $_POST['einfo']); 
                        $gHist   -> Add( 'Change User', 'Change User "'.$_POST['einfo']['login'].'" by '.$uinfo['login'], UID, $uinfo['login'], $uinfo['status'], 0, 1 );
                        $gNotify -> Send($gUser, $gPg, $gSmarty, 'Change User "'.$_POST['einfo']['login'].'" by '.$uinfo['login'], '', UID, $uinfo['login'], 0, 1 );
                        
                         //Auth
                        if (
                            $id == UID && 
                            ($uinfo['login'] != $_POST['einfo']['login'] || '' != trim($_POST['einfo']['pass'])) 
                           )
                        {
                            $gUser -> Logout();
                    	    $_POST['system_login'] = $_POST['einfo']['login'];
                            $_POST['system_pass']  = $_POST['einfo']['pass'];
                            $gUser -> CheckLogin(CURRENT_SCP, 1);
                        }
                        
                    }
                    else 
                    {
                        $id = $gUser -> Add($_POST['einfo']); 
                        $gHist -> Add( 'Add User', 'Add User "'.$_POST['einfo']['login'].'" by '.$uinfo['login'], UID, $uinfo['login'], $uinfo['status'], 0, 1 );
                        $gNotify -> Send($gUser, $gPg, $gSmarty, 'Add User "'.$_POST['einfo']['login'].'" by '.$uinfo['login'], '', UID, $uinfo['login'], 0, 1 );
                    } 
                    
                    //Add icon to user      
                    if (!empty($_FILES['upl']) && isset($_FILES['upl']['name']) && !empty($_FILES['upl']['name']))
    	            {
                        $k     = 0;
                        $errs  = array(); 
                        $tpa   = array('image/pjpeg', 'image/gif', 'image/jpeg', 'image/jpg', 'image/x-png', 'image/png', 'image/pjpeg' ); 
                
                        if (isset($_FILES['upl']) && '' != $_FILES['upl']['name'])
                        {         
                            if (!in_array($_FILES['upl']["type"], $tpa))
	                        {                        
	                         	$errs[] = 'Image '.(0 < $k ? $k : '').' - ' . 'Error file type. jpg, png && gif only';
	                        }
                        }        
                        if (isset($_FILES['upl']) && '' != $_FILES['upl']['name'] && 0 == count($errs))
	                    {                                
	                        $image = strtolower(MakeOrig($_FILES['upl']['name'], DIR_WS_IMAGE, 1));
	                        if ('' != $image)
                            {
                                i_crop_copy(50, 50, $_FILES['upl']['tmp_name'], DIR_WS_IMAGE . '/'. $image, 1);                  
                                $gUser -> AddPhoto($image, $id);
                            }
   	        	        }    				    	  	
        		    }                      
                     
                    //Add projects to user
                    $gPg -> DelAllUserProj($id);
                    if (!empty($_POST['einfo']['proj']))
                    {
                    	foreach ($_POST['einfo']['proj'] as $k => &$v)
                    	{
                    		if ($v)
                    		{
                    		    $gPg -> AddProjToUser($k, $id);
                    		}    
                    	}
                    }
                    uni_redirect(PATH_ROOT . 'account.php?mod=users&save=1');  
                }
                catch (UsersException $cexc)
                {
                    $errc = unserialize($cexc -> getMessage()); 
                    for ($i = 0; $i < count($errc); $i++)
                    {
                        if (16 <= $errc[$i] && 18 >= $errc[$i])
                        {
                            $pass_err = 1;
                        }
                        $errs[] = $gSmarty -> get_config_vars('reg'.$errc[$i]);
                    }       
                                                  
                    if (isset($pass_err))
                    {
                        $gSmarty -> assign('pass_err', $pass_err);
                    }
                    $gSmarty -> assign('id', $id);
                    $gSmarty -> assign_by_ref('errs', $errs);
                    $gSmarty -> assign_by_ref('einfo', $_POST['einfo']);
                }                        
            }
            elseif (0 < $id) 
            {
                $gSmarty -> assign('id', $id);
                $einfo =& $gUser -> Get($id);
                $einfo['proj'] =& $gPg -> GetUserProjects($id, 1);
                $gSmarty -> assign_by_ref('einfo', $einfo);
            }    		
            $gSmarty -> assign_by_ref('projects', $gPg -> GetProjectsList());
            
    		$gSmarty -> assign('_content', $gSmarty -> Fetch('mods/admin/_add_user.html'));
    	break;    	
    	
    	#*****************************
    	#  User List
    	#*****************************    	
    	case 'users':
            if (!isset($gSystemLogin) || '' == $gSystemLogin)
            {
                uni_redirect(PATH_ROOT);
            }    		
    		if (0 < $uinfo['status'])
    		{
    			uni_redirect(PATH_ROOT . 'account.php');
    		}
    		    		
    		if (!empty($_REQUEST['del']) && is_numeric($_REQUEST['del']))
    		{
    			$ui =& $gUser -> Get($_REQUEST['del']);
    			if (!empty($ui))
    			{
    			    $gHist -> Add( 'Del User', 'Delete User "'.$ui['login'].'" by '.$uinfo['login'], UID, $uinfo['login'], $uinfo['status'], 0, 1 );
    		    	$gNotify -> Send($gUser, $gPg, $gSmarty, 'Delete User "'.$ui['login'].'" by '.$uinfo['login'], '', UID, $uinfo['login'], 0, 1 );
    			    $gUser -> Delete($_REQUEST['del']);
    			}    			
    			uni_redirect( PATH_ROOT . 'account.php?mod=users' );
    		}
    		$gSmarty -> assign_by_ref('ul', $gUser -> GetUserList(-1, -1, 'status, name, lname', TB.'project_users'));
    	    $gSmarty -> assign('_content', $gSmarty -> Fetch('mods/admin/_users.html'));
    	break;

    	/******************************
    	  Projects List - for admin
    	 ******************************/      	
    	case 'projects':

            $prj_status = isset($_GET['prj_status']) ? $_GET['prj_status'] : 1;

            if (!isset($gSystemLogin) || '' == $gSystemLogin)
            {
                uni_redirect(PATH_ROOT);
            }    		
    		if (0 < $uinfo['status'])
    		{
    			uni_redirect(PATH_ROOT . 'account.php');
    		}

    		if (!empty($_REQUEST['del']) && is_numeric($_REQUEST['del']))
    		{
    			$pg =& $gPg -> GetProject($_REQUEST['del']);
    			if (!empty($pg))
    			{
    			    $gHist   -> Add( 'Delete Project', 'Delete Project "'.$pg['name'].'" by '.$uinfo['login'], UID, $uinfo['login'], $uinfo['status'], 0, 1 );
    				$gNotify -> Send( $gUser, $gPg, $gSmarty, 'Delete Project "'.$pg['name'].'" by '.$uinfo['login'], '', UID, $uinfo['login'], 0, 1 );
    			    $gPg     -> DeleteProject($_REQUEST['del']);
    			}    
    			uni_redirect(PATH_ROOT . 'account.php?mod=projects');
    		}
    	    $gSmarty -> assign('prj_status', $prj_status);
    	    $gSmarty -> assign_by_ref('pl', $gPg -> GetProjectsList($prj_status));
    	    $gSmarty -> assign('_content', $gSmarty -> Fetch('mods/admin/_projects.html'));
    	break;	
    	
    	#*****************************
    	#  Add && Edit Project
    	#*****************************     	
    	case 'add_proj':
            
    		if (!isset($gSystemLogin) || '' == $gSystemLogin)
            {
                uni_redirect(PATH_ROOT);
            }    	
    		if (!$id)
    		{
    	        if (!empty($_POST['eform']))
    	        {
    	        	$errs = array();
    	        	$fm   = $_POST['eform'];
    	        	if (empty($fm['name']))
    	        	{
    	        		$errs[] = 'Please specify project name';
    	        	}
    	        	if (0 == count($errs))
    	        	{

    	        		$id = $gPg -> EditProject(array($fm['name']));
    	        		
    	        		$gHist -> Add( 'Create Project', 'Create Project "'.$fm['name'].'" by '.$uinfo['login'], UID, $uinfo['login'], $uinfo['status'], $id, 0 );	
    	        		$gNotify -> Send( $gUser, $gPg, $gSmarty, 'Create Project "'.$fm['name'].'" by '.$uinfo['login'], '', UID, $uinfo['login'], $id, 0 );
    	        		uni_redirect(PATH_ROOT.'account.php?mod=add_proj&id='.$id);
    	        	}
    	        	$gSmarty -> assign_by_ref('errs', $errs);
    	        }
    			$gSmarty -> assign('_content', $gSmarty -> Fetch('mods/admin/_project_add.html')); 
    		}
    		else 
    		{
    			$pg =& $gPg -> GetProject($id);
    			if (empty($pg))
    			{
    				uni_redirect(PATH_ROOT . 'account.php');
    			}
    			$gSmarty -> assign('id', $id);
    			if (!empty($_POST['eform']))
    	        {
    	        	$fm   = $_POST['eform'];
    	        	$errs = array();
     	        	if (empty($fm['name']))
    	        	{
    	        		$errs[] = 'Please specify project name';
    	        	}   
    	        		        	
    	        	if (0 == count($errs))
    	        	{
    	        	    //Add users
    	        	    $gPg -> DelAllProjUsers($id);

    	        	    for ($i = 1; $i < count($status_ar); $i++ )
    	        	    {
    	        	    	foreach ($fm['usr'.$i] as $k => &$v)
    	        		    {
    	        		        if ($v)
    	        		        {
    	        		    	    $gPg -> AddProjToUser($id, $v);
    	        		        }    
    	        		    }
    	        	    } 

    	        	    $gPg -> EditProject(array($fm['name'],$fm['active']), $id);
    	        	      
    	        	    $gHist -> Add( 'Update Project', 'Update Project "'.$fm['name'].'" by '.$uinfo['login'], UID, $uinfo['login'], $uinfo['status'], $id, 0 );	
                        $gNotify -> Send( $gUser, $gPg, $gSmarty, 'Update Project "'.$fm['name'].'" by '.$uinfo['login'], '',  UID, $uinfo['login'], $id, 0 );



    	        	    uni_redirect(PATH_ROOT.'account.php?mod=projects');
    	        	}
    	        	
    	        	$gSmarty -> assign_by_ref('errs', $errs);
    	        	for ($i = 1; $i < count($status_ar); $i++)
    	        	{
    	        		$ua = array();
    	        	    if (!empty($fm['usr'.$i]))
    	        	    {
    	        	    	foreach ($fm['usr'.$i] as $k => &$v)
    	        	    	{
    	        	    		if (!empty($v) && !in_array($v, $ua))
    	        	    		{
    	        	    		    $ua[] = $v;
    	        	    		}    
    	        	    	}
    	        	    }
    	        	    $fm['usr'.$i] = $ua;
    	        	    unset($ua);
    	        	}
    	        	
    	        	$gSmarty -> assign_by_ref('eform', $fm); 
    	        }
    	        else 
    	        {
    	        	$arv =& $gPg -> GetProjectUsers($id);
    	        	for ($i = 0; $i < count($arv); $i++)
    	        	{
    	        		$pg['usr'.$arv[$i]['status']][] = $arv[$i]['uid'];
    	        	}
    	        	$gSmarty -> assign_by_ref('eform', $pg);
    	        	$gPg -> GetProjectUsers($id, 1);
    	        }

    			$gSmarty -> assign_by_ref('clients', $gUser    -> GetUserList(1, 1));
    			$gSmarty -> assign_by_ref('managers', $gUser    -> GetUserList(1, 2));
    			$gSmarty -> assign_by_ref('designers', $gUser   -> GetUserList(1, 3));
    			$gSmarty -> assign_by_ref('programmers', $gUser -> GetUserList(1, 4));

    			$gSmarty -> assign('_content', $gSmarty -> Fetch('mods/admin/_project_edit.html')); 
    		}
    		       	
    	break;
    	
    	#*****************************
    	#  Add screen
    	#*****************************      		
    	case 'add_screen':
    	    
            //check access
            if (!isset($gSystemLogin) || '' == $gSystemLogin)
            {
                uni_redirect(PATH_ROOT);
            }
            if (!$id || 1 == $uinfo['status'] || (0 != $uinfo['status']  && !$gPg -> CheckUserProject(UID, $id)))
            {
                uni_redirect(PATH_ROOT.'account.php');
            }

            $sid = (isset($_REQUEST['sid']) && is_numeric($_REQUEST['sid'])) ? $_REQUEST['sid'] : 0;
            $gSmarty -> assign('sid', $sid);
            if ($sid)
            {
            	$escr    =& $gPg -> GetScreen($sid);
                $gSmarty -> assign_by_ref('eform', $escr);
                
                if (!empty($escr['parent']))
                {
                	$pscr =& $gPg -> GetScreen($escr['parent']);
                	$escr['pname'] = $pscr['name'];
                }
                $_REQUEST['parent'] = $escr['parent'];
            }
                        
            //Get element 
            $pg =& $gPg -> GetProject($id);
            if (empty($pg))
            {
                uni_redirect(PATH_ROOT . 'account.php');	
            }            
            $gSmarty -> assign_by_ref('pg', $pg);

            if (isset($_REQUEST['back']))
            {
            	$gSmarty -> assign('back', $_REQUEST['back']);
            }
            if (!empty($_POST['eform']))
            {
            	$errs = array();
            	$fm   = $_POST['eform'];
            	$image = '';
        		
            	if ( empty($fm['name']) && empty($fm['parent']) )
        		{
        			$errs[] = 'Please specify Screen Name';
        		}
        		
        		if (!empty($_SESSION['upload_str']))
        		{
        		    $image = $_SESSION['upload_str'];
        			i_crop_copy(100, 75, DIR_WS_IMAGE  . '/'. $image, DIR_WS_IMAGE . '/resize/'. $image, 1);                  
                    i_crop_copy(200, 150, DIR_WS_IMAGE  . '/'. $image, DIR_WS_IMAGE . '/resize/m_'. $image, 1); 
                    copy(DIR_WS_IMAGE . '/resize/m_'. $image, DIR_WS_IMAGE . '/resize_new/m_'. $image);
                    WaterMark(DIR_WS_IMAGE . '/resize_new/m_'. $image, BPATH.'includes/templates/imgs/new.png');

                    unset($_SESSION['upload_str']);
                    unset($_SESSION['upload_data']);
        		}      		        	
	            elseif (!empty($_FILES['upl']) && isset($_FILES['upl']['name']) && !empty($_FILES['upl']['name']))
    	        {
                    $k     = 0;
                    $tpa   = array('image/pjpeg', 'image/gif', 'image/jpeg', 'image/jpg', 'image/x-png', 'image/png', 'image/pjpeg' ); 
                
                    if (isset($_FILES['upl']) && '' != $_FILES['upl']['name'])
                    {         
                        if (!in_array($_FILES['upl']["type"], $tpa))
	                    {                        
	                      	$errs[] = 'Image '.(0 < $k ? $k : '').' - ' . 'Error file type. jpg, png && gif only';
	                    }
                    }        
                    if (isset($_FILES['upl']) && '' != $_FILES['upl']['name'] && 0 == count($errs))
	                {                                
	                    $image = strtolower(MakeOrig($_FILES['upl']['name'], DIR_WS_IMAGE, 1));
	                    if ('' != $image)
                        {
                            move_uploaded_file($_FILES['upl']['tmp_name'], DIR_WS_IMAGE  . '/' . $image);
                            //i_crop_copy(202, 222, $_FILES['upl']['tmp_name'], DIR_WS_IMAGE . '/'. $image, 1);    
                            i_crop_copy(100, 75, DIR_WS_IMAGE  . '/'. $image, DIR_WS_IMAGE . '/resize/'. $image, 1);                  
                            i_crop_copy(200, 150, DIR_WS_IMAGE  . '/'. $image, DIR_WS_IMAGE . '/resize/m_'. $image, 1); 
                            
                            //make watermark
                            copy(DIR_WS_IMAGE . '/resize/m_'. $image, DIR_WS_IMAGE . '/resize_new/m_'. $image);
                            WaterMark(DIR_WS_IMAGE . '/resize_new/m_'. $image, BPATH.'includes/templates/imgs/new.png');
                        }
   	    	        }    				    	  	
        		}
        		elseif (!$sid) 
        		{
        			$errs[] = 'Please upload screen';
        		}

            	if (empty($errs))
            	{
            		if (!$sid)
            	    {
            	    	if ($fm['parent'])
            	    	{
            	    		$scr            =& $gPg -> GetScreen($fm['parent'], 1);
            	    		$rev            =  ($gPg -> GetSubScreenCount($id, $fm['parent']) + 1);
            	    		$fm['name']     =  'Rev'.$rev;
            	    		$nm             =  $scr['name'].' - '.'Rev'.$rev; 
            	    		$fm['mparent']  =  $scr['mparent'];
            	    		$link           =  $scr['link'].'/'.MakeLink($fm['name']);
            	    	}
            	    	else 
            	    	{
                            $rev  = 0;
            	    		$link = MakeLink($fm['name']);
            	    		$nm   = $fm['name']; 
            	    	}
            	    	$ar = array(
            		                $id,
            	    	            $fm['name'],
            	    	            $link,
            	    	            $rev, 
            	                    $fm['parent'],
            	                    $fm['mparent'],
            	                    (2 >= $uinfo['status']) ? 0 : 1
            	                   );
            		    $sid     = $gPg -> AddScreen($ar, $image);
            		    $hid     = $gHist   -> Add( 'Upload Screen', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'">Screen "'.$nm.'" uploaded by '.$uinfo['login'].'</a>', UID, $uinfo['login'], $uinfo['status'], $id, 0, (2 >= $uinfo['status']) ? 0 : $sid);	
            		    $gHist   -> AddView($uid, $hid, 0, $sid, $id, 0);
            		    $gNotify -> Send($gUser, $gPg, $gSmarty, 'Screen "'.$nm.'" uploaded by '.$uinfo['login'], 'http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid, UID, $uinfo['login'], $id, 1, (2 >= $uinfo['status']) ? 0 : $sid);  
            		    
            		    if ($sid && !empty($fm['parent']))
            		    {
            		    	$gPg -> UpdLastScreen($fm['parent'], $sid);
            		    }
            	    }
            	    else 
            	    {

            	    	$ar = array(
            	                    $fm['mparent'],
            	                    (0 == $escr['parent']) ? $fm['name'] : $escr['name'],
            	                    (0 == $escr['parent']) ? MakeLink($fm['name']) : $escr['link'],
            	                    (2 >= $uinfo['status']) ? 0 : 1
            	                    );           
            		    $gPg     -> UpdScreen($ar, $image, $sid);   
            		    
            		    
            		    if (trim($image))
            		    {
            		        /** get full screen name for log */
            		    	if (0 != $escr['parent'])
            		    	{
            		    		$scr =& $gPg -> GetScreen($escr['parent'], 1);
            		    		$nm  =  $scr['name'].' - '.$escr['name']; 
            		    	}
            		    	else
            		    	{
            		    		$nm = $escr['name'];
            		    	}
            		    	/** Save to Log */
            		    	$hid     =  $gHist -> Add( 'Update Screen', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'">Screen "'.$nm.'" updated by '.$uinfo['login'].'</a>', UID, $uinfo['login'], $uinfo['status'], $id, 1, (2 >= $uinfo['status']/* || 0 == $escr['parent']*/) ? 0 : $sid);
            		        $gHist   -> AddView($uid, $hid, 0, $sid, $id, 1);
            		        $gNotify -> Send($gUser, $gPg, $gSmarty, 'Screen updated by '.$uinfo['login'], 'http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid, UID, $uinfo['login'], $id, 1, (2 >= $uinfo['status']/* || 0 == $escr['parent']*/) ? 0 : $sid);         	    	
            		        
            		    }
            		    else
            		    {
            		    	if ($fm['mparent'] != $escr['mparent'])
            		    	{
            		    	    $hid     =  $gHist -> Add( 'Update Map', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'">Site map updated by '.$uinfo['login'].'</a>', UID, $uinfo['login'], $uinfo['status'], $id, 1, (2 >= $uinfo['status']/* || 0 == $escr['parent']*/) ? 0 : $sid);
            		            $gHist   -> AddView($uid, $hid, 0, $sid, $id, 1);
            		    	}
            		    	elseif ( 
            		    	           (empty($escr['parent']) && $escr['name'] != $fm['name']) ||
            		    	           (!empty($escr['parent']) && $escr['pname'] != $fm['pname'])
            		    	       )
            		    	{
            		    		$hid     =  $gHist -> Add( 'Update Screen Name', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'">Screen title changed to "'.(isset($fm['pname']) ? $fm['pname'] : $fm['name']).'" by '.$uinfo['login'].'</a>', UID, $uinfo['login'], $uinfo['status'], $id, 1, (2 >= $uinfo['status']/* || 0 == $escr['parent']*/) ? 0 : $sid);
            		            $gHist   -> AddView($uid, $hid, 0, $sid, $id, 1);
            		    	}
            		    }
            		    
            	    	
            		    /** Update screen name && link*/
            		    if (empty($escr['parent']) || $escr['pname'] != $fm['pname'])
            	    	{
            	    		if (empty($escr['parent']))
            	    		{
            	    		    $gPg -> UpdScreenLinks($sid, MakeLink($escr['name']), MakeLink($fm['name']));
            	    		}
            	    		else 
            	    		{
            	    			$gPg -> UpdScreenLinks($escr['parent'], MakeLink($escr['pname']), MakeLink($fm['pname']));         
            		            $gPg -> UpdScreenName($escr['parent'], $fm['pname'], MakeLink($fm['pname']));  
            	    		}
            	    	}
            	    	
            	    	
            	    	/** Update map parent*/            	    	
            	    	if ($escr['mparent'] != $fm['mparent'])
            	    	{
            	    		
            	    	    if (empty($escr['parent']))
            	    		{
            	    		    $gPg -> UpdMParent($sid, $fm['mparent']);
            	    		}
            	    		else 
            	    		{
            	    			$gPg -> UpdMParent($escr['parent'], $fm['mparent']);
             	    		}
            	    	}	
            	    	
            	    }
            	    uni_redirect( PATH_ROOT . 'account.php?sid='.$sid);
            	}
            	$gSmarty -> assign_by_ref('errs', $errs);
            	$gSmarty -> assign_by_ref('eform', $eform);
            }

            
            if (!empty($_REQUEST['parent']))
            {
            	$scc     =& $gPg -> GetScreen($_REQUEST['parent']);
            	
            	if ($scc['parent'])
            	{
            		$scc = $gPg -> GetScreen($scc['parent']);
            		$_REQUEST['parent'] = $scc['parent'];
            	}
            	$gSmarty -> assign('parent', $_REQUEST['parent']);
            	$gSmarty -> assign_by_ref('parinf', $scc);
            }
            elseif (!empty($_POST['eform']['parent']))
            {
            	$scc     =& $gPg -> GetScreen($_POST['eform']['parent']);
            	if ($scc['parent'])
            	{
            		$scc =& $gPg -> GetScreen($scc['parent']);
            		$_POST['eform']['parent'] = $scc['parent'];
            	}
            	$gSmarty -> assign('parent', $_POST['eform']['parent']);
            	$gSmarty -> assign_by_ref('parinf', $scc);
            }
            
            $gSmarty -> assign_by_ref('tops', $gPg -> GetScreens( $id, 0 ));
    		$gSmarty -> assign('_content', $gSmarty -> Fetch('mods/project/_add_screen.html')); 
    	break;	
    	
    	#*****************************
    	#  Delete screen
    	#*****************************  
    	case 'del_screen':
    	    
    		if (!empty($uinfo) && $sid && (0 == $uinfo['status'] || 2 == $uinfo['status']))
    		{
    			$scr =& $gPg -> GetScreen($sid);
    			if (empty($scr))
    			{
    				uni_redirect(PATH_ROOT . 'account.php');
    			}
    			//delete
    			$gPg -> DelScreen($sid);
    			if ($scr['parent'])
    			{
    			    //update last screen
    				$gPg -> UpdScreenLast($scr['parent']);	
    			}
    			else 
    			{
    				//set new parent screen
    				$gPg -> MakeNextAsParent($sid, $scr['name'], MakeLink($scr['name']));
    			}
    			
    			//update screen
             	$gPg -> UpdFullSort($scr['pid']);
    			
    			//unlink images
    			if (file_exists(DIR_WS_IMAGE . '/resize/m_'. $scr['image']))
    	        {
    	            unlink(DIR_WS_IMAGE . '/resize/m_'. $scr['image']);
    	        }  
    	        if (file_exists(DIR_WS_IMAGE . '/'. $scr['image']))
    	        {
    	            unlink(DIR_WS_IMAGE . '/'. $scr['image']);
    	        }	
    	        	    	
    			$gHist   -> Add( 'Delete Screen', 'Screen "'.$scr['name'].(0 == $scr['parent'] ? ' - rev0' : '').'" deleted by '.$uinfo['login'], UID, $uinfo['login'], $uinfo['status'], $scr['pid'], 0 );	
    			$gNotify -> Send($gUser, $gPg, $gSmarty, 'Screen "'.$scr['name'].(0 == $scr['parent'] ? ' - rev0' : '').'" deleted by '.$uinfo['login'], UID, $uinfo['login'], $scr['pid'], 0 );	 
    			
    			uni_redirect(PATH_ROOT . 'account.php?id='.$scr['pid']);   			
    		}
    	   	uni_redirect(PATH_ROOT . 'account.php');
    	break;
    		
    	#*****************************
    	#  Save order
    	#*****************************  
    	case 'save_order':

    		$id = $_GET['id'];
	    	$neworder = $_GET['neworder'];

            if (!isset($gSystemLogin) || '' == $gSystemLogin)
            {
                uni_redirect(PATH_ROOT);
            }

            if (!$id || 1 == $uinfo['status'] || (0 != $uinfo['status']  && !$gPg -> CheckUserProject(UID, $id)))
            {
   				uni_redirect(PATH_ROOT . 'account.php?sid='.$sid);
            }

	    	if (!empty($uinfo) && (0 == $uinfo['status'] || 2 <= $uinfo['status']) )
    		{
				$gPg -> SaveSortingOrder( $id, $neworder);
				uni_redirect(PATH_ROOT . 'account.php?id='.$id);		    		
			}

		   	uni_redirect(PATH_ROOT . 'account.php');

    	break;  

    	#*****************************
    	#  Approve screen
    	#*****************************  
    	case 'approve_screen':
    		
    		if (!empty($uinfo) && $sid)
    		{
    			
    			$scr =& $gPg -> GetScreen($sid);
    			if (empty($scr))
    			{
    				uni_redirect(PATH_ROOT . 'account.php');
    			}
    			if (0 != $uinfo['status'] && !$gPg -> CheckUserProject(UID, $scr['pid']) )
    			{
    				uni_redirect( PATH_ROOT . 'account.php?sid='.$sid );
    			}
    			$gPg   -> ApproveScreen( $sid );
    			//add watermark
    			copy(DIR_WS_IMAGE . '/resize/m_'. $scr['image'], DIR_WS_IMAGE . '/resize_ok/m_'. $scr['image']);
    			WaterMark(DIR_WS_IMAGE . '/resize_ok/m_'. $scr['image'], BPATH.'includes/templates/imgs/ok.png');
    			
    			if (!empty($scr['parent']))
    			{
    				$scrp = $gPg -> GetScreen($scr['parent']);
    				if (!empty($scrp['name']))
    				{
    				    $scr['name'] =&  $scrp['name'];
    				}
    			}
    			$hid     =  $gHist   -> Add( 'Approve Screen', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'">Screen "'.$scr['name'].'" approved as final by '.$uinfo['login'].'</a>', UID, $uinfo['login'], $uinfo['status'], $scr['pid'], 0 );	
    			$gHist   -> AddView($uid, $hid, 0, $sid, $scr['pid'], 0);
    			$gNotify -> Send($gUser, $gPg, $gSmarty, 'Screen "'.$scr['name'].'" approved as final by '.$uinfo['login'], 'http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid, UID, $uinfo['login'], $scr['pid'], 0);
    			
    			uni_redirect( PATH_ROOT . 'account.php?sid='.$sid.'&approve=1' );		
    		}
    	   	uni_redirect(PATH_ROOT . 'account.php');
    	break;  
    	
     	#*****************************
    	#  Reverese Approval screen
    	#*****************************  
    	case 'unapprove_screen':
    		
    		if (!empty($uinfo) && $sid)
    		{
    			
    			$scr =& $gPg -> GetScreen($sid);
    			if (empty($scr))
    			{
    				uni_redirect(PATH_ROOT . 'account.php');
    			}
    			if (0 != $uinfo['status'] && (!$gPg -> CheckUserProject(UID, $scr['pid']) ||  2 != $uinfo['status']))
    			{
    				uni_redirect( PATH_ROOT . 'account.php?sid='.$sid );
    			}
    			$gPg   -> ClearAprove( $sid );
			
    	    	if (!empty($scr['parent']))
    			{
    				$scrp =& $gPg -> GetScreen($scr['parent']);
    				if (!empty($scrp['name']))
    				{
    				    $scr['name'] =  $scrp['name'];
    				}
    			}
    			   			
    			$hid     =  $gHist   -> Add( 'Reverse screen approval', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'">Reverse approval for screen "'.$scr['name'].'"  by '.$uinfo['login'].'</a>', UID, $uinfo['login'], $uinfo['status'], $scr['pid'], 0 );	
    			//$gHist   -> AddView($uid, $hid, 0, $sid, $scr['pid'], 0);
    			//$gNotify -> Send($gUser, $gPg, $gSmarty, 'Screen "'.$scr['name'].'" approved as final by '.$uinfo['login'], 'http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid, UID, $uinfo['login'], $scr['pid'], 0);
    			
    			uni_redirect( PATH_ROOT . 'account.php?sid='.$sid );		
    		}
    	   	uni_redirect(PATH_ROOT . 'account.php');
    	break; 
    	   	  	
    	#*****************************
    	#  Approve screen for client view after upload
    	#*****************************  
    	case 'approve_view_screen':
    		
    		if (!empty($uinfo) && $sid)
    		{
    			
    			$scr =& $gPg -> GetScreen($sid);
    			if (empty($scr))
    			{
    				uni_redirect(PATH_ROOT . 'account.php');
    			}
    			if (0 != $uinfo['status'] && (!$gPg -> CheckUserProject(UID, $scr['pid']) || 2 != $uinfo['status']) )
    			{
    				uni_redirect( PATH_ROOT . 'account.php?sid='.$sid );
    			}
    			$gPg   -> ApproveViewScreen($sid); 
    			$gHist -> DelApproveStatus($sid);	
    			uni_redirect( PATH_ROOT . 'account.php?sid='.$sid );		
    		}
    	   	uni_redirect(PATH_ROOT . 'account.php');
    	break;      	
    	#*****************************
    	#  Default Output
    	#*****************************     	
    	default:
    	   
    		if ($sid)
    	    {    	    	
    	        //Show Screen
    	        $scr = $gPg -> GetScreen($sid);
    	        if ( empty($scr) || (1 == $scr['must_approve'] && ((!empty($uinfo) && 1 == $uinfo['status']) ||  empty($uinfo)) ) )
    	        {
    	        	uni_redirect(PATH_ROOT.'account.php');
    	        }
    	        $pg =& $gPg -> GetProject($scr['pid']);
    	        if (empty($pg))
    	        {
    	        	uni_redirect(PATH_ROOT.'account.php');
    	        }
    	       
    	        if ($scr['parent'])
    	        {
    	        	$gSmarty -> assign_by_ref('scr_parent', $gPg -> GetScreen($scr['parent']));
    	        }
               
    	        /*
    		    if (0 != $uinfo['status'] && !$gPg -> CheckUserProject(UID, $scr['pid']))
                {
                     uni_redirect(PATH_ROOT.'account.php');
                } 
                */
    	        if (!empty($gSystemLogin) && (0 == $uinfo['status'] || $gPg -> CheckUserProject(UID, $scr['pid'])))
                {
                    $gHist -> UpdView($uid, 0, 0, $sid, $scr['pid']);
                	$can_edit = 1;
                	$gSmarty -> assign('can_edit', 1);
                }
                //user status
                if (!empty($gSystemLogin))
                {
    	    	    
                	switch ($uinfo['status'])
    	    	    {
    	    	    	case '1':
    	        		    $ustatus  = array(0, 1, 2);
    	        		    $internal = 0;
    	        		    
    	        		    //update is_new flag
    	        		    if ($scr['is_new'])
    	        		    {
    	        		    	$gPg -> NoNew($sid);
    	        		    	if (file_exists(DIR_WS_IMAGE . '/resize_new/m_'. $scr['image']))
    	        		    	{
    	        		    	    unlink(DIR_WS_IMAGE . '/resize_new/m_'. $scr['image']);
    	        		    	}    
    	        		    }
    	        		break;    
    	        		case '0':
    	        		case '2':
    	        		case '3':
    	        		case '4':
    	        		default:
    	        			$internal = -1;
    	        			$ustatus  = array();					
    	        	}
                    include CLASS_PATH . 'Model/Main/BComment.php';
                    $mCom =& new BComment($gDb, TB.'comment');
                
                    //Some actions
                    if (!empty($_REQUEST['del']) && is_numeric($_REQUEST['del']) && $can_edit == 1)
                    {
                        $ci =& $mCom -> GetCommentInfo($_REQUEST['del']);
                        if (!empty($ci) && ($uinfo['status'] == 0 || $uinfo['status'] == 2/* || UID == $ci['uid']*/))	
                        {
                        	$mCom    -> DelComment($_REQUEST['del']);
                        	$gPg     -> UpdCom($sid, -1, (!$ci['internal'] && 2 >= $ci['ustatus']) ? -1 : 0);
                        	$hid      = $gHist   -> Add( 'Del Comment', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'">Delete Comment # '.$_REQUEST['del'].' by '.$uinfo['login'].'</a>', UID, $uinfo['login'], $uinfo['status'], $gPg -> GetScreenProjectID($sid), 1 );	
                            $gHist   -> AddView($uid, $hid, 0, $sid, $gPg -> GetScreenProjectID($sid), 1);
                        	$gNotify -> Send($gUser, $gPg, $gSmarty, 'Delete Comment # '.$_REQUEST['del'].' by '.$uinfo['login'], 'http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid, UID, $uinfo['login'], $gPg -> GetScreenProjectID($sid), 1); 
                        }
                        uni_redirect(PATH_ROOT . 'account.php?sid='.$sid);
                    }

                    
                    switch ($action)
                    {
                    	case 'addcom':
                        
                    		if (!isset($gSystemLogin) || '' == $gSystemLogin)
                            {
                                uni_redirect(PATH_ROOT);
                            }   
                                     		
                    		if (!empty($_POST['eform']['comment']))	
                    	    {
                    	    	//deb($_SESSION);
                    	    	$internal = (!empty($_POST['eform']['internal'])) ? 1 : 0;
                    	    	
                    	    	$attach   = '';
                    	    	if (!empty($_SESSION['upload_str'])) 
                    	    	{
                    	    		$attach = $_SESSION['upload_str'];
                    	    		unset($_SESSION['upload_str']);
                    	    	}
                    	    	
                    	    	$cid      = $mCom -> AddComment(array(
                	    	                          'uid'      => UID,
                	    	                          'ustatus'  => $uinfo['status'], 
                	    	                          'mid'      => $sid,
                	    	                          'title'    => '', 
                	    	                          'descr'    => $_POST['eform']['comment'],
                	    	                          'internal' => $internal,
                    	    	                      'attach'   => $attach
                	    	                         ));
                                                	    	                         
                    	        $gPg -> UpdCom($sid, 1, (2 < $uinfo['status'] || $internal) ? 0 : 1);
                    	        $internal = (2 < $uinfo['status']) ? 1 : $internal;
                    	       
                                //Add to history
                    	        $hid      = $gHist -> Add( 'Add Comment', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'#com_'.$cid.'">Comment #'.$cid.' by '.$uinfo['login'].(2 < $uinfo['status'] ? ' - waiting for approval' : '').'</a>', UID, $uinfo['login'], $uinfo['status'], $gPg -> GetScreenProjectID($sid), $internal, 0, (2 < $uinfo['status'] && (empty($_POST['eform']['internal']))) ? $cid : 0 );	
                                $gHist   -> AddView($uid, $hid, $cid, $sid, $gPg -> GetScreenProjectID($sid), $internal);
                    	        $gNotify -> Send($gUser, $gPg, $gSmarty, 'Comment #'.$cid.' by '.$uinfo['login'].(2 < $uinfo['status'] ? ' - waiting for approval' : ''),  'http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'#com_'.$cid, UID, $uinfo['login'], $gPg -> GetScreenProjectID($sid), $internal, $sid, $_POST['eform']['comment'] );
                    	        
                                header("location: ".PATH_ROOT . 'account.php?sid='.$sid.'#last_com');
                    	        exit;	                         
                    	    }
                        break;                		
                    }
                
                    $cl =& $mCom -> GetCommentList(TB.'admin_users', $sid, 1, $ustatus, $internal, '');
                    $gSmarty -> assign_by_ref('cl', $cl);
                }
                $gSmarty -> assign_by_ref('prevnext', $gPg -> GetPrevNext($sid, $scr['pid']));
                
                $previmage = $gPg -> GetPrevImage();
                $gSmarty -> assign_by_ref('previmage', $previmage);

                $imsize = getimagesize(DIR_WS_IMAGE.'/'.$scr['image']);
				$imsize[1] += 50;
				$gSmarty -> assign_by_ref('imsize', $imsize);
				$gSmarty -> assign('vis_comment_id', (!empty($_REQUEST['vis_comment_id'])) ? $_REQUEST['vis_comment_id'] : 0);
                $gSmarty -> assign_by_ref('scr_aprove', $gPg -> CheckScreenAprove($sid));
                $gSmarty -> assign_by_ref('scr', $scr);
                $gSmarty -> assign('cdate', date('D, F d,  Y h:i a', mktime()));
    	        
                $gSmarty -> assign_by_ref('pg', $gPg -> GetProject($scr['pid']));

				$prev_next = $gPg -> GetNextScreenId($sid,$scr['pid']);
				$gSmarty -> assign('next_screen_id',$prev_next[1]);
				$gSmarty -> assign('prev_screen_id',$prev_next[0]);

    	        $gSmarty -> assign('_content', $gSmarty -> Fetch('mods/project/_one_screen.html'));
    	    }
    		elseif ($id)
    		{
    			
    			//Show one project
                 //check access
                 /*
    			 if (0 != $uinfo['status'] && !$gPg -> CheckUserProject(UID, $id))
                 {
                     uni_redirect(PATH_ROOT.'account.php');
                 }
                 */
                 if (!empty($gSystemLogin) && (0 == $uinfo['status'] || $gPg -> CheckUserProject(UID, $id)))
                 {
                 	$gSmarty -> assign('can_edit', 1);
                 }

                 if (!empty($_REQUEST['list']))
                 {
                     $gSmarty -> assign('list', 1);	 
                 }
                 
                 //Get element
                 $pg =& $gPg -> GetProject($id);
                 if (empty($pg))
                 {
                     uni_redirect(PATH_ROOT . 'account.php');	
                 }

                 
                 if (!empty($gSystemLogin) && (0 == $uinfo['status'] || ($gPg -> CheckUserProject(UID, $id) && 2 == $uinfo['status'])))
                 {
    		         if ( !empty($_REQUEST['up']) && is_numeric($_REQUEST['up']) )
                     {
                         $gPg -> UpdSort($id, $_REQUEST['up'], 1);  
                         uni_redirect(PATH_ROOT . $pg['link'].'?list=1');  	
                     }
                     elseif ( !empty($_REQUEST['down']) && is_numeric($_REQUEST['down']) )
                     {
                 	     $gPg -> UpdSort($id, $_REQUEST['down'], -1); 
                 	     uni_redirect(PATH_ROOT . $pg['link'].'?list=1');   	              
                     }
                 }
                 
                 $gSmarty -> assign('sc_id', $sc_id);
                 //Get screens
                 $pl =& $gPg -> GetScreens($id, 0, (isset($uinfo['status']) ? $uinfo['status'] : 1));

                 
                 $gSmarty -> assign_by_ref('pg', $pg);
                
                 if ($sc_id || 'history' == $action)
                 {
                     $ca =  array();
                     for ($i = 0; $i < count($pl); $i++)
                     {
                     	 if (empty($sc_id) || $sc_id == $pl[$i]['id'])
                 	     {
                 	         $pl[$i]['first'] = 1;
                     	     $ca[] = $pl[$i];
                             $ca   = array_merge($ca, $gPg -> GetScreens($id, $pl[$i]['id'], (isset($uinfo['status']) ? $uinfo['status'] : 1) ));
                     	 }         	
                     }
                     
                     unset($pl);
                 
                     $gSmarty -> assign_by_ref('pl', $ca);
                     $gSmarty -> assign('_content', $gSmarty -> Fetch('mods/project/_history_view.html'));
                 }
                 elseif ('map' == $action)
                 {
                 	$st  = '<?xml version="1.0" encoding="utf-8"?>'."\n";
                 	$st .= '<sitemap>'."\n";
                    $st .= $gPg -> GetScreenTree($id);
                    $st .= '</sitemap>';
                    $mRep = array('"' => '&quot;', '&' => '&amp;', '>' => '&gt;', '<' => '&lt;', "'" => '&apos;', '®'=>'(R)');
                    $gSmarty -> assign('st', '<pre>'.strtr($st, $mRep).'</pre>');
                 	
                 	$gSmarty -> assign('_content', $gSmarty -> Fetch('mods/project/_map_view.html'));
                 }
                 else 
                 {        
                 	 /** Get html files info for list**/        	
                     if (!empty($_REQUEST['list']))
                     {
                         $gSmarty -> assign_by_ref('HTTP_HTML_DIR', str_replace('%project%', $pg['link'], HTTP_HTML_DIR));
						 $dir   = str_replace('%project%', $pg['link'], FTP_HTML_DIR);
                         $files = array();
						 if (file_exists($dir))
						 {
						     $dh  = opendir($dir); 
                             while (false !== ($filename = readdir($dh))) 
                             { 
                                 $files[] = $filename; 
                             }
                         }							 
                     }
                 	
                 	 $number_of_revisions = 0;
                     for ($i = 0; $i < count($pl); $i++)
                     { 
                 	     $pl[$i]['screen_count'] = $gPg -> GetSubScreenCount( $id, $pl[$i]['id'], ((isset($uinfo['status']) && 1 != $uinfo['status']) ? 0 : 1) ) + 1;
						 $number_of_revisions += $pl[$i]['screen_count'];
				     	 /** Get html files info for list**/    
						 if (!empty($_REQUEST['list']))
                         {
						     $fn = str_replace(' ', '_', $pl[$i]['name']).'.html';        
						     if (in_array($fn, $files))
							 {
							     $pl[$i]['html'] = $fn;
						     } 		 
							 elseif (in_array(strtolower($fn), $files))
							 {
							     $pl[$i]['html'] = strtolower($fn);
							 }
						 }
					 }
                 	 $gSmarty -> assign_by_ref('pl', $pl);
					 $gSmarty -> assign('number_of_screens', count($pl));
					 $gSmarty -> assign('number_of_revisions', $number_of_revisions);
                 	 $gSmarty -> assign('_content', $gSmarty -> Fetch('mods/project/_work_view.html'));
                 }   
    		}
    		else 
    		{	
    			//check access
                if (!isset($gSystemLogin) || '' == $gSystemLogin)
                {
                    uni_redirect(PATH_ROOT);
                }
                //Show projects List (main page)
                			
    			if ( 0 == $uinfo['status'])
    		    {
    			    $pl =& $gPg -> GetProjectsList();
    			    
    			    $act     = (!empty($_REQUEST['act']) && 1 <= $_REQUEST['act'] && 3 >= $_REQUEST['act']) ? $_REQUEST['act'] : 0; 
    			    $pfilt   = (!empty($_REQUEST['pf']) && is_numeric($_REQUEST['pf'])) ? $_REQUEST['pf'] : 0;
    			    $gSmarty -> assign('act', $act);
    		        $gSmarty -> assign('pf', $pfilt);
    		        
    			    $what    = (!empty($_REQUEST['what']) && (1 == $_REQUEST['what'] || 2 == $_REQUEST['what'])) ? $_REQUEST['what'] : 0;	        
    		        $gSmarty -> assign('what', $what);
                    
    		
    			    include CLASS_PATH . 'View/Acc/Pagging.php'; 
                    $pcnt    =   40;
                    $rcnt    =   $gHist -> GetCount((empty($pfilt)) ? -1 : array($pfilt), -1, $act, $what);
    			    $mpage   =   new Pagging($pcnt,
                                             $rcnt,
                                             $page,
                                             PATH_ROOT.'account.php?act='.$act.($pfilt ? '&amp;pf='.$pfilt : ''));
    			    $gSmarty -> assign('rcnt', $rcnt);
                    $range   =& $mpage -> GetRange();
                    $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
    			    $gSmarty -> assign('pagging',  $mpage  -> Make()); 	    			    
    			    $gSmarty -> assign_by_ref('hist', $gHist -> GetList( (empty($pfilt)) ? -1 : array($pfilt), -1, $range[0], $pcnt, $uid, $act, $what));
    		    }
    		    else 
    		    {
    			    $pl =& $gPg -> GetUserProjects(UID);
    			   
    			    $pa = array();
    			    for ($i = 0; $i < count($pl); $i++)
    			    {
    			    	$pa[] = $pl[$i]['project_id'];
    			    }
    			    if (!empty($pa))
    			    {
    			        $act     = (!empty($_REQUEST['act']) && 1 <= $_REQUEST['act'] && 3 >= $_REQUEST['act']) ? $_REQUEST['act'] : 0; 
    			        $pfilt   = (!empty($_REQUEST['pf']) && is_numeric($_REQUEST['pf']) && in_array($_REQUEST['pf'], $pa)) ? $_REQUEST['pf'] : 0;
    			        
    			        $gSmarty -> assign('act', $act);
  		                $what    = (!empty($_REQUEST['what']) && (1 == $_REQUEST['what'] || 2 == $_REQUEST['what'])) ? $_REQUEST['what'] : 0;	        
    		            $gSmarty -> assign('what', $what);
    		            $gSmarty -> assign('pf', $pfilt);
    		
    			    	include CLASS_PATH . 'View/Acc/Pagging.php'; 
                        $pcnt    =   40;
                        $rcnt    = $gHist -> GetCount( (empty($pfilt)) ? $pa : array($pfilt), (1 == $uinfo['status'] ? 0 : -1), $act, $what);
    			        $mpage   =   new Pagging($pcnt,
                                                 $rcnt,
                                                 $page,
                                                 PATH_ROOT.'account.php?act='.$act.($pfilt ? '&amp;pf='.$pfilt : ''));
    			    	$gSmarty -> assign('rcnt', $rcnt);
                        $range   =& $mpage -> GetRange();
                        $gSmarty -> assign('plist_c',  $range[1] - $range[0]);
    			    	$gSmarty -> assign('pagging',  $mpage  -> Make()); 
                        $gSmarty -> assign_by_ref('hist', $gHist -> GetList( (empty($pfilt)) ? $pa : array($pfilt), (1 == $uinfo['status'] ? 0 : -1), $range[0], $pcnt, $uid, $act, $what));
    			    }    
    		    }
                 
    		    
    		    $gSmarty -> assign_by_ref('pl', $pl);
    	        $gSmarty -> assign('_content', $gSmarty -> Fetch('mods/_main.html'));
    		}     
    }
	
    $gSmarty -> display('index.html');
}
catch (Exception $exc)
{
    sc_error($exc);
}

#*************************************************************
# End part
#*************************************************************
    $gDb -> disconnect();
?>