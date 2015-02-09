<?

  require_once('DB.php');
  require_once('config.inc.php');
  require_once('error_handler.php');

  $timecorr = 0;
  $erroremail = 'max@4all2date.com';

  setlocale(LC_ALL,"en_US");

  //error handler
  set_error_handler("e37_error_handler", E_ALL);

  //sql error hadler            
  PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'db_log_error'); 


  function send_error($subject, $body='') {

    $error_mail = 'max@4all2date.com';
	$ip = $_SERVER[REMOTE_ADDR];
    $linkip = "http://ws.arin.net/cgi-bin/whois.pl?queryinput=$ip";
    mail("$error_mail","$subject","$body \n IP : $linkip  \n Host : [".@gethostbyaddr($ip)."] \n Agent : [$_SERVER[HTTP_USER_AGENT]] \n Page : [$_SERVER[REQUEST_URI]] \n Referrer : [$_SERVER[HTTP_REFERER]]");
  }


  $dbh = DB::connect(MYSQL_CONNECTION_STRING, USE_PERSISTENT_CONNECTION);
  $dbh->setFetchMode(DB_FETCHMODE_ASSOC);

?>