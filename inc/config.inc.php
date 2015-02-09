<?

//database info

  define('USE_PERSISTENT_CONNECTIONS', 'true');
  define('DB_SERVER', 'localhost');
  define('DB_DATABASE', 'engine37_engine37');
  define('DB_USERNAME', 'engine37_engine3');
  define('DB_PASSWORD', 'f8tvATDfFRAsbRHY');
  define('MYSQL_CONNECTION_STRING','mysql://' . DB_USERNAME . ':' . DB_PASSWORD . '@' .DB_SERVER . '/' . DB_DATABASE);

//directory structure

  define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT'].'/pic/');
  define("INC_DIR", $_SERVER['DOCUMENT_ROOT'].'/inc/');
  define("CACHE_DIR", $_SERVER['DOCUMENT_ROOT'].'/cache/');


//mail settings
  define('CONTACT_MAIL_TO','info@engine37.com');
  define('CONTACT_MAIL_FROM','info@engine37.com');
      
  define('CONTACT_MAIL_SUBJECT','[E37 CONTACT FORM]');

?>
