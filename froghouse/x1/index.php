<?

  $x = $_GET['x'];
  $images = array();
  $images[] = "frog2.jpg";
  $images[] = "frog3.jpg";

  echo "<a href=".$_SERVER[PHP_SELF]."?x=1>Sample1</a> | <a href=".$_SERVER[PHP_SELF]."?x=2>Sample2</a><hr>";

  switch ($x) { 
    case 1: echo "<img src=".$images[0].">";
    case 2: echo "<img src=".$images[1].">";
    default: echo "<img src=".$images[0].">";
  }

?>
