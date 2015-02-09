<?

//database login info

  define('USE_PERSISTENT_CONNECTIONS', true);
  define('DB_SERVER', localhost);
  define('DB_DATABASE', wholesaleauto);
  define('DB_USERNAME', wholesaleauto);
  define('DB_PASSWORD', dst34hgs_11);
  define('MYSQL_CONNECTION_STRING','mysql://' . DB_USERNAME . ':' . DB_PASSWORD . '@' .DB_SERVER . '/' . DB_DATABASE);

  define("IS_WARNING_FATAL", false);                            
  define("DEBUGGING", false);                                   
  // settings about mailing the error messages to admin        
  define("SEND_ERROR_MAIL", true);                            
  define("ADMIN_ERROR_MAIL", 'max@engine37.com');          
  define("SENDMAIL_FROM", 'errors@engine37.com');            
  ini_set("sendmail_from", SENDMAIL_FROM); 
  
  
  define('DIR_UPLOAD', $_SERVER['DOCUMENT_ROOT'].'/e37auto/upload/valid/');
  define('DIR_INC', $_SERVER['DOCUMENT_ROOT'].'/e37auto/inc/');
  
  define('USER_PAGE', 25);
  define('WISHLIST_PAGE', 25);
  define('INVENTORY_PAGE', 4);                   
?>
