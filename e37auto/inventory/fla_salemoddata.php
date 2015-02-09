<?
	session_start();
	require_once('../inc/config.inc.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
	require_once(DIR_INC.'set_valxml.php');

	$modelsale_id = $dbh->escapeSimple($_POST['modelsale_id']);

	//данные по двигателям
	$fla_sql = "SELECT * FROM modsaleengines 
					    WHERE modelsale_id=$modelsale_id";
	$data =& $dbh->getAll($fla_sql);	
	$var_xml = "&xmlEngines=".xml_connect($data);

	//данные по оснащению 
	$fla_sql = "SELECT * FROM modelsalesequips 
				        WHERE modelsale_id=$modelsale_id";
	$data =& $dbh->getAll($fla_sql);
	$var_xml .= "&xmlEquipments=".xml_connect($data);

	//данные по трансмиссии и приводам
	$fla_sql = "SELECT * FROM modsaletechs
				        WHERE modelsale_id=$modelsale_id";
	$data =& $dbh->getAll($fla_sql);
	
	$var_xml .= "&xmlTechs=".xml_connect($data);
	$var_xml .= "&loadkey=1&";
	echo $var_xml;
?>