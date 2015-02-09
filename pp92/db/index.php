<?
require_once('inc/dbinit.php');

/*
$query = "SELECT Country_str_name FROM country";
$col = $dbh->getCol($query);

echo '<select>';
foreach ($col as $value) {
  echo '<option>'.$value.'</option>';
}
echo '</select>';
*/

$query = "SELECT Feature_str_name FROM feature WHERE Country_str_code='RS' ORDER BY Feature_str_name";
$col = $dbh->getCol($query);

echo '<select>';
foreach ($col as $value) {
  echo '<option>'.$value.'</option>';
}
echo '</select>';
