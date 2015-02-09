<?
	//запрос на выборку по субмодели - прибамбасы
	//(магнитофон, кондиционер и т.д.)
	$submodel_id = $dbh->escapeSimple($_POST['submodel_id']);
	
	$fla_sql = "SELECT * FROM submodequips 
						WHERE submodel_id = '$submodel_id'";
			    
	require_once('inc/set_sql.php');
?>