<?

//database login info

  define('USE_PERSISTENT_CONNECTIONS', true);
  define('DB_SERVER', "localhost");
  define('DB_DATABASE', "globalcities");
  define('DB_USERNAME', "globalcities");
  define('DB_PASSWORD', "12termidor");
  define('MYSQL_CONNECTION_STRING','mysql://' . DB_USERNAME . ':' . DB_PASSWORD . '@' .DB_SERVER . '/' . DB_DATABASE);

  // settings about mailing the error messages to admin        
  define("SEND_ERROR_MAIL", true);                            
  define("ADMIN_ERROR_MAIL", "max@4all2date.com");          
  define("SENDMAIL_FROM", "errors@4all2date.com");            


  define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT'].'/o/');
  define("INC_DIR", $_SERVER['DOCUMENT_ROOT'].'/inc/');

?>
