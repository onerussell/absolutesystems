<?
	
	function delete_newmodels($tab, $modelsale_id, $dbh){
		$sql = "DELETE FROM $tab 
  			    	  WHERE modelsale_id=$modelsale_id";
		$data = $dbh->query($sql);
	}
?>