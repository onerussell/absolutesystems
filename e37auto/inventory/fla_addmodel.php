<?
    session_start();
	//запрос на выборку по году - фирма, модель, подмодель
	require_once('../inc/config.inc.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
	require_once(DIR_INC.'set_valxml.php');

	$year_id = $dbh->escapeSimple($_POST['year_id']);

	$fla_sql = "SELECT distinct(makes.make_id), makes.make_name 
			      FROM makes,models,submodels 
			     WHERE submodels.year_id = '$year_id' AND 
				  	   submodels.model_id = models.model_id AND 
					   makes.make_id = models.make_id 
			     ORDER by makes.make_name";

	$data =& $dbh->getAll($fla_sql);	
	$var_xml = "&xmldata=".xml_connect($data);
	$var_xml .= "&loadkey=1";
	echo $var_xml;
?>