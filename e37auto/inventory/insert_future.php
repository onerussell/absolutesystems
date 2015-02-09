<?
	
	session_start();
	//обновляем модель в раздел featured
	require_once('../inc/config.inc.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
	
	$modelsale_id = $dbh->escapeSimple($_POST['modelsale_id']);
	$featured_id = $dbh->escapeSimple($_POST['featured_id']);
	$diler_id = $_SESSION['diler_id'];

	
	//$sql = "UPDATE IGNORE featured
	
	$sql = "SELECT * FROM featured
 			        WHERE featured_id=$featured_id
			          AND diler_id=$diler_id"; 
    
    $data = $dbh->getAll($sql);
    
    if  ($data){
        $sql = "UPDATE featured
			       SET modelsale_id=$modelsale_id 
			     WHERE featured_id=$featured_id
			       AND diler_id=$diler_id"; ;   
    }else{
        $sql = "INSERT INTO featured
                           (featured_id, 
                            modelsale_id, 
                            diler_id)
                     VALUES ($featured_id,
				             $modelsale_id,
				             $diler_id)";   
    }
    
    
	$data = $dbh->query($sql);
	
	echo "&loadkey=1";

?>