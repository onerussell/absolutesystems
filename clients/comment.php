<?php
    include_once '_top.php';
    $idc = (isset($_REQUEST['idc']) && is_numeric($_REQUEST['idc'])) ? $_REQUEST['idc'] : 0;

    if ($idc && !empty($uinfo))
    {
        include CLASS_PATH . 'Model/Main/BComment.php';
        $mCom  =& new BComment($gDb, TB.'comment');
    	$eform =& $mCom -> GetCommentInfo($idc);

    	if (!empty($eform) && is_array($eform) && 0 < count($eform))
    	{
    		$gSmarty -> assign_by_ref('eform', $eform);
    		$gSmarty -> display('mods/_comment_hint.html');
    	}

    }  	
?>