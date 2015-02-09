<?
	
	session_start();
	//Добавляем|обновляем новую модель (DataGrid)
	require_once('../inc/config.inc.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
    
	$diler_id = $_SESSION['diler_id'];
	if ($_POST['modelsale_id']) $modelsale_id = validData($_POST['modelsale_id'], $dbh);
	else $modelsale_id = validData('', $dbh);
	$year_id = validData($_POST['year_id'], $dbh);
	//$diler_id = $dbh->escapeSimple($_POST['diler_id']);
	$make_id = validData($_POST['make_id'], $dbh);
	$submodel_id = validData($_POST['submodel_id'], $dbh);
	$model_id = validData($_POST['model_id'], $dbh);
	$model_name = validData($_POST['model_name'], $dbh);
	$submodel_name	= validData($_POST['submodel_name'], $dbh);
	$modelsale_mile	= validData($_POST['modelsale_mile'], $dbh);
	$modelsale_price = validData($_POST['modelsale_price'], $dbh);
	$modelsale_status = validData($_POST['modelsale_status'], $dbh);
	$modelsale_title = validData($_POST['modelsale_title'], $dbh);
	$modelsale_vin	= validData($_POST['modelsale_vin'], $dbh);
	$modelsale_pic	= validData($_POST['modelsale_pic'], $dbh);
	$modelsale_description = validData($_POST['modelsale_description'], $dbh);
	if ($_POST['ebay_id'] && @$_POST['ebay_id'] != "undefined"){
		$ebay_id = validData($_POST['ebay_id'], $dbh);
	} else $ebay_id = 'null';
	
	if ($_POST['ebay_end_time']) $ebay_end_time	= validData($_POST['ebay_end_time'], $dbh);
	else $ebay_end_time	= validData('', $dbh);
	//оснащение
	$sgl_equips = validData($_POST['sgl_equips'], $dbh);
	//трансмиссия + тип привода
	$modsaltech_trans = validData($_POST['modsaltech_trans'], $dbh);
	$modsaltech_drive = validData($_POST['modsaltech_drive'], $dbh);
	//типы двигателей новой модели
	$sgl_engines = validData($_POST['sgl_engines'], $dbh);
		
	//основная таблица REPLACE
	$sql = 	"REPLACE INTO modelsales 
		           VALUES ($modelsale_id,
		                   $diler_id, 
			      		   $year_id,
					       $make_id,
					       $model_id, 
			    		   $submodel_id,
					       $model_name,
					       $submodel_name,
					       $modelsale_mile,
					       $modelsale_price,
					       $modelsale_status,
					       $modelsale_title,
			    		   $modelsale_vin,
					       $modelsale_pic,
					       $ebay_end_time,
					       $ebay_id,
					       $modelsale_description)";
									
	$data = $dbh->query($sql);
	$modelsale_id = mysql_insert_id();
	
	// тех. оснащение
	$sql = 	"REPLACE INTO modelsalesequips 
		      	   VALUES ('modelsalesequips_id', 
			    		   $modelsale_id,
					       $sgl_equips)";
									
	$data = $dbh->query($sql);


	//трансмиссия + тип привода
	$sql = 	"REPLACE INTO modsaletechs 
			       VALUES ('',
					       $modelsale_id, 
					       $modsaltech_trans,
					       $modsaltech_drive)";
									
	$data = $dbh->query($sql);

	//типы двигателей новой модели
	$sql = 	"REPLACE INTO modsaleengines 
				   VALUES ('', 
			       		   $modelsale_id, 
					       $sgl_engines)"; 
						
	$data = $dbh->query($sql);
	
	if ($modelsale_status == 'available') {
		$mail_sql = "SELECT userId 
		               FROM wish_list 
		    	      WHERE firmId = $make_id 
		    	        AND diler_id=$diler_id
			    	    AND modelId = $model_id
				        AND submodel = $submodel_name
				        AND fromYear <= $year_id
				        AND toYear >= $year_id";
		$data = $dbh->getAll($mail_sql);
	
		if (sizeof($data) > 0){
			$where = '';
			for($i=0; $i<sizeof($data); $i++){
				
				$where .= "id=".$data[$i]['userId'];
				if ($i < sizeof($data) - 1) $where .= ' OR ';
				
			}
			
			$mail_sql = "SELECT mail 
			               FROM users 
			   	          WHERE ".$where;
				      
			$data = $dbh->getAll($mail_sql);	
			
			$mailStr = '<html>';
			$mailStr .=	'<head>';
			$mailStr .=		'<meta http-equiv="Content-Type" content="text/html">';
			$mailStr .= 	'<title>WHOLESALE AUTO SALES</title>';
			$mailStr .= 	'<style type="text/css"><!--';
			$mailStr .= 	'TD {font-family: arial,geneva,sans-serif; font-size: 9pt}';
			$mailStr .= 	'.text {font-family: arial,geneva,sans-serif; font-size: 9pt}';	
			$mailStr .= 	'--></style>';	
			$mailStr .= '</head>';
			$mailStr .= '<body>';	
			$mailStr .= '</body>';
			$mailStr .= '<B>' . $model_name . ' ' . $submodel_name . '</B><BR>';		
			$mailStr .= '<A HREF="http://www.foxautowholesale.com/car.php?car='.$modelsale_id.'">http://www.foxautowholesale.com/car.php?car='.$modelsale_id.'</A>';
			$mailStr .= '</html>';
			
			for($i=0; $i<sizeof($data); $i++)
			{
				$mail	= $data[$i]['mail'];
				$from	= "info@foxautowholesale.com";
				$subject= "WHOLESALE AUTO SALES";
				$headers= "From: $from\nMIME-Version: 1.0\nContent-Type: text/html;";	
				$result = mail($mail, $subject, $mailStr, $headers);	
			}
		}
	}
	
	echo "&loadkey=1&$modelsale_id=".$modelsale_id;
	
	function validData($in, $dbh){ 
		if (is_int($in) || is_double($in)) {
			return $in;
		} elseif (is_bool($in)) {
			return $in ? 1 : 0;
		} elseif (is_null($in)) {
			return 'NULL';
		} else {
			return "'" . $dbh->escapeSimple($in) . "'";
		}
	}  
?>