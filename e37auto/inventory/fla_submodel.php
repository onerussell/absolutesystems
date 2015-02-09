<?
	session_start();
	//запрос на выборку по фирме, году - модель
	require_once('../inc/config.inc.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
	require_once(DIR_INC.'set_valxml.php');
	
	$model_id = $dbh->escapeSimple($_POST['model_id']);
	$year_id = $dbh->escapeSimple($_POST['year_id']);
	
	$fla_sql = "SELECT * FROM submodels 
						WHERE submodels.year_id='$year_id' AND 
							  submodels.model_id = '$model_id' 
						ORDER by submodels.submodel_name";
	
	$data =& $dbh->getAll($fla_sql);
	
	$var_xml = "&xmldata=".xml_connect($data);
	$var_xml .= "&loadkey=1";
	echo $var_xml;
?>