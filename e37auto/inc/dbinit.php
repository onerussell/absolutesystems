<?

  require_once('DB.php');
  require_once('config.inc.php');
  require_once('eh.php');

  setlocale(LC_ALL,"en_US");

  //error handler 
  set_error_handler("e37_error_handler", E_ALL);

  //sql error hadler            
  PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'db_log_error'); 

  $dbh = DB::connect(MYSQL_CONNECTION_STRING, USE_PERSISTENT_CONNECTIONS);
  $dbh->setFetchMode(DB_FETCHMODE_ASSOC);

?>