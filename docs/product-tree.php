<?
  require_once('inc/dbinit.php');

  function recurs($id) {
    global $dbh,$sth1;
    $i=0;
    $sql = "SELECT catalog_id,
				   parent_id,
				   catalog_name
			  FROM catalog 
			 WHERE parent_id=$id";

    $sth = $dbh->query($sql);
    $count = $sth->NumRows();

    while($row = $sth->fetchRow()) {
      $sql = "SELECT catalog_id 
				FROM catalog 
			   WHERE parent_id='$row[catalog_id]'";

      $test1 = $dbh->getOne($sql);

		if($test1) {

   			$ref1 = "catalog.php?id=$row[catalog_id]";

        } else {

   			$ref1 = "product.php?id=$row[catalog_id]";

      	}

		$catalog_name = addslashes($row[catalog_name]);
        echo "['$catalog_name','$ref1',";
   		if ($count) { recurs($row[catalog_id]); }
 	    $i++;
	}
    echo"],";
  }
?>

<html>
<head>
    <link rel="StyleSheet" href="css/tree.css" type="text/css">
    <script language="JavaScript" src="js/tree.js"></script>
    <script language="JavaScript" src="js/tree_tpl.js"></script>
    <script type="text/javascript">
	<?
		echo "var TREE_ITEMS = [['Root', '\catalog.php?id=0',";
	    recurs(0);
	?>	
	];
    </script>
</head>

<body NOWRAP>
<br>
 <div id="tree">
  <script type="text/javascript">
  <!--
	new tree (TREE_ITEMS, tree_tpl);
  //-->
  </script>
 </div>
</body>
</html>
