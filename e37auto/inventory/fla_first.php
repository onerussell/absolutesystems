<?
//	session_start();
	require_once('../inc/config.inc.php');
    require_once(DIR_INC.'dbinit.php');
//	require_once(DIR_INC.'valid_sess.php');
	require_once(DIR_INC.'set_valxml.php');
    
	$diler_id = 3;
/*
	//справочник по двигателям
	$fla_sql = "SELECT * FROM engines";
	$data = $dbh->getAll($fla_sql);	
	$var_xml .= "&xmlEngines=".urlencode(xml_connect($data));
	//справочник по оснащению
	$fla_sql = "SELECT * FROM equipments";
	$data = $dbh->getAll($fla_sql);
	$var_xml .= "&xmlEquipments=".urlencode(xml_connect($data));

*/
	//запрос на выборку всех фирм в которых есть модели в инвентории
	$fla_sql = "SELECT distinct(ma.make_name), ma.make_id
	              FROM modelsales m,
    			       makes ma 
		  	     WHERE ma.make_id=m.make_id
		  	       AND m.diler_id=$diler_id 
		  	  	 ORDER by ma.make_name";
						 
	
	
	$data = $dbh->getAll($fla_sql);
	//получаем кол-во моделей каждой фирмы
	for($i = 0; $i < count($data); $i++)
	{
		$make_id = $data[$i]['make_id'];
		$sql = "SELECT ceil(count(*)) as c 
              	  FROM modelsales 
             	 WHERE diler_id=$diler_id
				   AND make_id=$make_id";

		$data_count = $dbh->getAll($sql);
		$data[$i]['make_name'] .= " (".$data_count[0]['c'].")";
		
	}
	
			

//	$var_xml .= "&xmlMakes=".xml_connect($data);
//	$var_xml .= "&loadkey=1&";
	echo xml_connect($data);
?>                                     