<?php
	require("DataBase.inc");
	$error		= false;
	$sectionId	= $HTTP_GET_VARS["id"];
	$page		= (!$HTTP_GET_VARS["page"]) ? 1 : $HTTP_GET_VARS["page"];
	$startIndex = ($page - 1) * $maxRecord;	
	$maxRecord	= 18;		
	$photoStr = "";	
	if ($db_connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)) {
		$query = "SELECT * FROM photo WHERE sectionId=$sectionId ORDER BY id DESC LIMIT $startIndex, $maxRecord";
		$queryCount	  = "SELECT COUNT(id) AS count FROM photo WHERE sectionId=$sectionId";	
		if (($result = mysql_db_query(DB_NAME, $query, $db_connection)) && ($resultCount = mysql_db_query(DB_NAME, $queryCount, $db_connection))) {
			$row = mysql_fetch_object($resultCount);
			$count = (int)$row->count;
			$count = ceil($count / $maxRecord);			
			while($row = mysql_fetch_object($result)) {
		    	$path	= $row->path;
		    	$photoStr .= "<Item path=\"$path\" />";
			}
		}  else $error = true;
	} else $error = true;
	header ("Content-type: text/xml");	
	$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	$outputStr .= "<Data>";			
	if (!$error) {
		$outputStr 	.= "<Action result=\"1\">";			
		$outputStr 		.= "<ImageList count=\"$count\">";
		$outputStr 			.= $photoStr;
		$outputStr 		.= "</ImageList>";
		$outputStr 	.= "</Action>";				
	} else $outputStr .= "<Action result=\"0\">";	 
	$outputStr .= "</Data>";						 
	echo($outputStr);	
?>