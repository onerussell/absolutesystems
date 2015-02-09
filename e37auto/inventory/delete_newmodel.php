<?

	session_start();
	require_once('../inc/config.inc.php');
    require_once(DIR_INC.'dbinit.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once('inc/delete.php');
	
	
	$modelsale_id = $dbh->quoteSmart($_POST['modelsale_id']);
	$diler_id = $_SESSION['diler_id'];
	
	$sql = "SELECT modelsale_pic 
  		  	  FROM modelsales 
		 	 WHERE modelsale_id=$modelsale_id
			   AND diler_id=$diler_id";

	$data = $dbh->getAll($sql);
	//удаляем картинки	
	$photos = explode(",", $data[0]['modelsale_pic']);
     if ($photos[0]){
         for ($i=0; $i<sizeof($photos); $i++){
            $fileName = $photos[$i];
            require('inc/delete_Img.php');
        }   
        
    }
	//удаляем записи из таблиц
	delete_newmodels("modelsales", $modelsale_id, $dbh);
	delete_newmodels("modelsalesequips", $modelsale_id, $dbh);
	delete_newmodels("modsaleengines", $modelsale_id, $dbh);
	delete_newmodels("modsaletechs", $modelsale_id, $dbh);
	echo "&loadkey=1&";
?>