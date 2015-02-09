<?php
    include_once '_top.php';

    $raw_xml = file_get_contents("php://input");
    
/*
    $raw_xml = '<command type="getCommentsList">
	                <screen_id>69</screen_id>
                </command>';
   */
    /* 
    $raw_xml = '<command type="saveObjects">
                    <comment_id>0</comment_id>
	                <screen_id>69</screen_id>
	                <xml_descr><![CDATA[<data>test5555888</data><val1>test27999777</val1>]]></xml_descr>
	            </command>';
   */
    /*
    $raw_xml = '<command type="getComment">
          	        <comment_id>2</comment_id>
                </command>';    
    */
    
    include CLASS_PATH . 'Model/Main/VComment.php';        
    include_once 'includes/conf/messages.php';
	include_once CLASS_PATH.'Model/Main/XMLOutput.php';
	
    $gXo     =&  new XmlOutput_Model();
    $gCom    =&  new Visual_Comments_Model($gDb, TB.'vcomment', TB.'admin_users');
    
    if (empty($raw_xml))
    {
    	echo $gXo -> GetError('error_request', ERROR_REQUEST); 
    	$gDb -> disconnect();
		exit();
    }	 
    
    include_once CLASS_PATH.'Ctrl/Acc/XMLParser.php';
    $gParser =&  new XMLParser($raw_xml);
    
    $raw_xml = stripslashes($raw_xml);

    
try
{
                                                  
    $gParser -> Parse();
    
    if (empty($gParser -> document))
    {
    	echo $gXo -> GetError('error_request', ERROR_REQUEST); 
    	$gDb -> disconnect();
    	exit();
    }	
    $type = !empty($gParser -> document -> tagAttrs['type']) ? $gParser -> document -> tagAttrs['type'] : '';
    
    switch ($type)
    {    
    	
    	/** Get Comments List */
    	case 'getCommentsList':

    		$err = array();

    		if (empty($gParser -> document -> screen_id[0] -> tagData) || !is_numeric($gParser -> document -> screen_id[0] -> tagData))
    		{
    			$err[] = COMMENT_LIST_ERROR; 
    		}
            
    		$scr = $gPg -> GetScreen( $gParser -> document -> screen_id[0] -> tagData );
            if (empty($scr) && empty($err))
            {
                $err[] = COMMENT_LIST_ERROR;	
            }
            
    		/** Check && return result */
    	    if (empty($err))
    	    {
    	    	$li =& $gCom -> GetList( $gParser -> document -> screen_id[0] -> tagData );
    	    	echo $gXo -> RetResult($type, $gXo -> GetCommentsList($li), COMMENT_LIST_SUCCESS);
    	    }
    	    else 
    	    {
    		    echo $gXo -> GetError($type, implode('|', $err)); 
    	    }      	        		
    	break;

    	/** Get Comment Info */
    	case 'getComment':
    		
            if (empty($gParser -> document -> comment_id[0] -> tagData) || !is_numeric($gParser -> document -> comment_id[0] -> tagData))
    		{
    			$err[] = COMMENT_ERROR_ID;     
    		}
    		else
    		{
    		    $ci =& $gCom -> GetComment($gParser -> document -> comment_id[0] -> tagData);
    		    if (empty($ci) || empty($ci['val']))
    		    {
    		        $err[] = COMMENT_NOT_FOUND;	
    		    }
    		}
    		
    		if (empty($err))
    		{
    			echo $gXo -> RetResult($type, $gXo -> GetComment($ci), COMMENT_SUCCESS);          
    		}
            else 
    	    {
    		    echo $gXo -> GetError($type, implode('|', $err)); 
    	    }    		
    		
    	break;	
    	
    	/** Save Objects */
    	case 'saveObjects':
    	    
    		//deb($gParser -> document);
        	if (empty($gParser -> document -> screen_id[0] -> tagData) || !is_numeric($gParser -> document -> screen_id[0] -> tagData))
    		{
    			$err[] = SAVE_ERROR1; 
    		}    	    
    	    
        	if (empty($gParser -> document -> xml_descr[0] -> tagData))
    		{
    			$err[] = SAVE_ERROR2; 
    		}     		
    		
    		
    		if (empty($err))
    		{
    		    $cid = (empty($gParser -> document -> comment_id[0] -> tagData) || !is_numeric($gParser -> document -> comment_id[0] -> tagData)) ? 0 : $gParser -> document -> comment_id[0] -> tagData;
    		    $id  = $gCom -> SaveComments(
    		                          $gParser -> document -> screen_id[0] -> tagData, 
    		                          $gParser -> document -> xml_descr[0] -> tagData,
    		                          (!empty($uinfo['uid'])) ? $uinfo['uid'] : 0,
    		                          $cid
    		                         );               
    		    $st  = '<comment>
    		                <comment_id>'.$id.'</comment_id>
    		                <avatar>'.( (!empty($uinfo['image'])) ? 'http://'.DOMEN.PATH_ROOT.DIR_NAME_IMAGE.'/'.$uinfo['image'] : 'http://'.DOMEN.PATH_ROOT.'includes/templates/imgs/i-client_default.png').'</avatar>
			                <date>'.date("M j", mktime()).'</date>
			                <time>'.date("h:i A", mktime()).'</time>
			            </comment>
			           ';     
                
    		    $sid      = $gParser -> document -> screen_id[0] -> tagData;
    		    $hid      = $gHist -> Add( 'Add Visual Comment', '<a href="http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'&vis_comment_id='.$id.'">Visual Comment #'.$id.' by '.$uinfo['login'].'</a>', UID, $uinfo['login'], $uinfo['status'], $gPg -> GetScreenProjectID($sid), 0, 0, 0 );	
                $gHist   -> AddView($uid, $hid, $id, $sid, $gPg -> GetScreenProjectID($sid), 0);
                $gNotify -> Send($gUser, $gPg, $gSmarty, 'Visual Comment #'.$id.' by '.$uinfo['login'],  'http://'.DOMEN.PATH_ROOT.'account.php?sid='.$sid.'&vis_comment_id='.$id, UID, $uinfo['login'], $gPg -> GetScreenProjectID($sid), 0, $sid, '' );   
    		    
    		    echo $gXo -> RetResult($type, $st, SAVE_SUCCESS);          
    		}
            else 
    	    {
    		    echo $gXo -> GetError($type, implode('|', $err)); 
    	    }
    	break;	
    	
    	/** Default - output error */
    	default:
            
    		echo $gXo -> GetError('error_request', 'Error request'); 
    	    
    	break;	
    }
    $gDb -> disconnect();        
}
catch (Exception $exc)
{
    sc_error($exc);
}  
?>