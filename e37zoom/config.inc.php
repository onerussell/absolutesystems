<?

//database login info

  define('USE_PERSISTENT_CONNECTIONS','true');
  define('DB_SERVER', 'localhost');
  define('DB_DATABASE', 'celeb6_celebration');
  define('DB_USERNAME', 'celeb6_celebrati');
  define('DB_PASSWORD', '12weddingx13');
  define('MYSQL_CONNECTION_STRING','mysql://' . DB_USERNAME . ':' . DB_PASSWORD . '@' .DB_SERVER . '/' . DB_DATABASE);

// settings about mailing the error messages to admin        

  define("SEND_ERROR_MAIL", true);                            
  define("ADMIN_ERROR_MAIL", 'max@engine37.com');          
  define("SENDMAIL_FROM", 'errors@'.$_SERVER['SERVER_NAME']); 
  
  define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT'].'/e37zoom/');
  define("INC_DIR", $_SERVER['DOCUMENT_ROOT'].'/inc/');

?>
