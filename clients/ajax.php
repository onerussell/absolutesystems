<?php
    include '_top.php';
	
    include CLASS_PATH . 'Ctrl/Ajax/JsHttpRequest.php';
    new JsHttpRequest("utf-8");

	#$_REQUEST = unserialize('a:7:{s:6:"cat3id";s:26:"dpq6u145hciv02dt6mp0a6igl6";s:3:"mod";s:7:"saveCom";s:3:"idc";s:3:"554";s:5:"descr";s:5:"Test4";s:8:"internal";s:1:"0";s:6:"aprove";s:1:"1";s:10:"del_attach";s:1:"0";}');
    $mod    = (!empty($_REQUEST['mod'])) ? $_REQUEST['mod'] : '';
    $status = (!empty($_REQUEST['status'])) ? $_REQUEST['status'] : 1;
    $st     = '';
	
   
    /*
	$fl = fopen('files/data/tt.txt', 'w');
	fputs($fl, print_r(serialize($_REQUEST), 1)."\n");
	fputs($fl, print_r($_REQUEST, 1)."\n");
	fclose($fl);
    */   
	   
    switch ($mod)
    {
    	case 'getList':	
    	
    		$icnt   = (!empty($_REQUEST['icnt'])) ? $_REQUEST['icnt'] : 0;
    		$icnt   += 1; 

    		$ul =& $gUser     -> GetUserList(1, $status, '', TB.'project_users');
    		$st =  '<span id="usr_'.$icnt.'" style="padding: 0px;"><select name="eform[usr'.$status.']['.$icnt.']" ><option value="0"> ---</option>';
    		foreach ($ul as $k => $v)
    		{
    			$st .= '<option value="'.$v['uid'].'">'.$v['name'].' '.$v['lname'].'['.$v['login'].']'.'</option>';
    		}
    		$st .=  '</select> <a href="javascript:DelBlock('."'".$icnt."'".');">Delete</a>
    		         <div class="spacer s20"><!-- --></div>
    		         </span>
    	        	';
    	    echo $st;

    	break;
    	
    	case 'getCom':
    	    
    		$idc = (isset($_REQUEST['idc']) && is_numeric($_REQUEST['idc'])) ? $_REQUEST['idc'] : 0;
    		if ($idc && !empty($uinfo))
    		{
    		    include CLASS_PATH . 'Model/Main/BComment.php';
                $mCom  =& new BComment($gDb, TB.'comment');
    		    $eform =& $mCom -> GetCommentInfo($idc);

    		    if (!empty($eform) && (0 == $uinfo['status'] || 2 == $uinfo['status'] /*|| UID == $eform['uid']*/))
    		    {
    		    	$gSmarty -> assign_by_ref('eform', $eform);
    		    	$st = $gSmarty -> Fetch('mods/project/_edit_com.html');
    		    }
    		}
    		
    	break;
    	
    	case 'saveCom':

    		$idc = (isset($_REQUEST['idc']) && is_numeric($_REQUEST['idc'])) ? $_REQUEST['idc'] : 0;
    		if ($idc && !empty($uinfo))
    		{

    		    include CLASS_PATH . 'Model/Main/BComment.php';
                $mCom  =& new BComment($gDb, TB.'comment');
    		    $eform =& $mCom -> GetCommentInfo($idc);

    		    if (!empty($eform) && (0 == $uinfo['status'] || 2 == $uinfo['status'] /*|| UID == $eform['uid']*/))
    		    {
    		    	$internal = (!empty($_REQUEST['internal'])) ? $_REQUEST['internal'] : 0;
    		    	if (2 < $uinfo['status'])
    		    	{
    		    		$internal = $eform['internal'];
    		    	}
    		    	$ar = array(
    		    	            'title'    => '',
    		    	            'descr'    => (!empty($_REQUEST['descr'])) ? $_REQUEST['descr'] : '',
    		    	            'internal' => $internal,
    		    	            'id'       => $idc,  
    		    	           );
					if (!empty($_REQUEST['del_attach']) && 1 == $_REQUEST['del_attach']) 
    		    	{
    		    		$mCom -> DeleteAttach($idc);          
    		    	}
    		    	$mCom -> AddComment($ar);      
    					
    		    	if ((0 == $uinfo['status'] || 2 == $uinfo['status']) && !empty($_REQUEST['aprove'])) 
    		    	{
					 
//		    		    error_log('updatecom');    	    
    		    		$mCom  -> AproveComment($idc, $uinfo['status']);
    		    		$gHist -> AproveComment($idc); 
    		    		if (!$internal)
    		    		{
    		    	       
							$gPg     -> UpdCom($eform['mid'], 0, 1);   
    		    	        $login   = $gUser -> GetLogin($eform['uid']);  
    		    	        $proj_id = $gPg -> GetScreenProjectID($eform['mid']);
    		    	        
                            							
							$hid     = $gHist   -> Add( 'Add Comment', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$eform['mid'].'#com_'.$idc.'">Comment #'.$idc.' by '.$login.'</a>', $eform['uid'], $login, $eform['ustatus'], $proj_id, 0 );	 

							$gHist   -> AddView($uid, $hid, $idc, $eform['mid'], $proj_id, 0);
    		    	        $gNotify -> Send($gUser, $gPg, $gSmarty, 'Comment #'.$idc.' by '.$login.'', 'http://'.DOMEN.PATH_ROOT.'account.php?sid='.$eform['mid'].'#com_'.$idc, UID, $login, $proj_id, 0, $eform['mid'], (!empty($_REQUEST['descr'])) ? $_REQUEST['descr'] : '' );
						}    
    		    	}
    		    	elseif ($eform['internal'] || $internal)
    		    	{
    		    		$gPg -> UpdCom($eform['mid'], 0, ($eform['internal'] > $internal) ? 1 : -1);
    		    	}
    		    	
    		    	$eform =& $mCom -> GetCommentInfo($idc);
    		    	$gSmarty -> assign_by_ref('eform', $eform);
    		    	
	    		    error_log('ustatus='.$eform['ustatus'] );    	    
    		    	$GLOBALS['_RESULT']['efm'] = 2;
    		    	if ( 2 < $eform['ustatus'] )
    		    	{
    		    		$GLOBALS['_RESULT']['efm'] = 3;
    		    	}
    		    	elseif ( $eform['internal'] )
    		    	{
    		    	    $GLOBALS['_RESULT']['efm'] =  1;
    		    	}
	    		    error_log('before redirect');    	    
    		    	$st = $gSmarty -> Fetch('mods/project/_one_com.html');
    		    }
    		}
    		
    	break;
    		
    	default:
    }
    
    $GLOBALS['_RESULT']['resu'] = $st;

?>