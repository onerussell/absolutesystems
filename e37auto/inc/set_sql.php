<?
	require_once('dbinit.php');
	$data = $dbh->getAll($fla_sql);	
	require_once('set_xml.php');
?>