<?php
//  ====================== CONFIGURATION ===============================
// ============= Access to database ======================
define('DB_TYPE',   'mysql');         // allow 'mysql','mssql','pgsql' etc. (compatible with PEAR)
define('DB_HOST',   'localhost');     // mysql-server name
define('DB_USER',   'froghouse');          // existing user of database
define('DB_PASS',   'rQBCsdfg5yhZr');              // and its password
define('DB_NAME',   'froghouse');          // name of database
define('TB',        'cat3_');         // prefix for all tables for this database

// ============= Web-server parameters =====
define('DOMEN'          , 'engine37.com');
define('PATH_ROOT'      , '/sandbox/thefroghouse/');    // Site root path
define('PATH_ROOT_ADMIN', PATH_ROOT.'siteadmin/');      //
define('BPATH'          , $_SERVER['DOCUMENT_ROOT'].'/sandbox/thefroghouse/');
                                                        // Web-server root path
define('USE_LOCAL_PEAR' , false);                       // 
define('DIR_NAME_IMAGE' , 'images');                    // Image directory name
define('DIR_WS_IMAGE'   , BPATH.DIR_NAME_IMAGE);        // Dir with uploaded images
define('DIR_NAME_IMAGECACHE', 'imagecache');            // Image cache directory name
define('DIR_NAME_IMAGECACHE2', 'imagecache2');          // Image cache2 directory name
// ============= Script parameters ================================
                                      
define('ERROR_LEVEL'      , 2047);      // PHP error reporting level
define('ERROR_DISPLAY'    , 1);         // display errors

//============================FCKEditor=======================================                                      
define('FCK_PATH', 'includes/visualeditor/');      // FCKeditor path
define('FCK_CLASSPATH', FCK_PATH.'fckeditor.php'); // FCKeditor class
define('FCK_BASEPATH', PATH_ROOT_ADMIN.FCK_PATH);  // FCKeditor BasePath                                    
// ======================= end_CONFIGURATION ==============================
?>