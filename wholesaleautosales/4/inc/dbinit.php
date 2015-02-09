<?

  function db_log_error($error_obj) {

	echo "System error. Code: 0015. Please report this problem to <a href='mailto:support@engine37.com'>support@engine37.com</a>. Thank you.<br><br>";
	$ip = $_SERVER[REMOTE_ADDR];
    echo '['.$ip.']-['.$_SERVER[REQUEST_URI].']-['.@gethostbyaddr($ip).']-['.$_SERVER[HTTP_REFERER].']-['.$_SERVER[HTTP_USER_AGENT].']  '.$error_obj->message.' '.$error_obj->userinfo;
    exit();

  }

  setlocale(LC_ALL,"en_US");
  require_once("DB.php");
  PEAR::setErrorHandling(PEAR_ERROR_CALLBACK,'db_log_error'); // debug
//  PEAR::setErrorHandling(PEAR_ERROR_DIE);                   // release
  $dbh = DB::connect("mysql://wholesaleauto:dst34hgs_11@localhost/wholesaleauto",true);
  $dbh -> setFetchMode(DB_FETCHMODE_ASSOC);

?>