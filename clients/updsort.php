<?php
    include_once '_top.php';

    $sql = 'SELECT id FROM '.TB.'project';
    $dbx  = $gDb -> query($sql);
    while ($rowx = $dbx -> FetchRow())
    {
    	$sql = 'SELECT id FROM '.TB.'screens WHERE parent = 0 AND pid = ? ORDER BY sortid';
    	$db2 = $gDb -> query($sql, $rowx['id']); 
    	$k   = 1;
    	while ($row2 = $db2 -> FetchRow())
    	{
    	    $sql = 'UPDATE '.TB.'screens SET sortid = ? WHERE id = ?';
    	    $gDb -> query($sql, array($k, $row2['id']));

    	    $sql = 'UPDATE '.TB.'screens SET sortid = ? WHERE parent = ?';
    	    $gDb -> query($sql, array($k, $row2['id']));
    	    
    	    $k ++;
    	}
    }
?>