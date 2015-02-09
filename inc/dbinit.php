<?

  require_once('DB.php');

  setlocale(LC_ALL,"en_US");

  $dbh = DB::connect(MYSQL_CONNECTION_STRING, USE_PERSISTENT_CONNECTIONS);
  $dbh->setFetchMode(DB_FETCHMODE_ASSOC);

?>