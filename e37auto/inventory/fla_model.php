<?
	session_start();
	//запрос на выборку по фирме, году - модель
	require_once('../inc/config.inc.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
	require_once(DIR_INC.'set_valxml.php');

	$make_id = $dbh->escapeSimple($_POST['make_id']);
	$year_id = $dbh->escapeSimple($_POST['year_id']);


	$fla_sql = "SELECT distinct(models.model_id), models.model_name 
		 	      FROM models,
				 	   submodels 
		  	     WHERE submodels.year_id=$year_id AND 
		  	  		   submodels.model_id = models.model_id AND 
		 			   models.make_id = $make_id 
			     ORDER by models.model_name";
						 

	$data =& $dbh->getAll($fla_sql);	
	$var_xml = "&xmldata=".xml_connect($data);
	$var_xml .= "&loadkey=1";
	echo $var_xml;
?>