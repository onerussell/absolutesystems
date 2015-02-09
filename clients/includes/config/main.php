<?php
//  ====================== CONFIGURATION ===============================
// ============= Access to database ======================
define('DB_TYPE',   'mysql');         // allow 'mysql','mssql','pgsql' etc. (compatible with PEAR)
define('DB_MYSQL_VER', 4.1);              // MySQL Version
define('DB_HOST',   'localhost');     // mysql-server name
define('DB_USER',   'engine37_e37');          // existing user of database
define('DB_PASS',   'XP{Gvar-=9+.');              // and its password
define('DB_NAME',   'engine37_e37');          // name of database
define('TB',        'cat3_');         // prefix for all tables for this database

// ============= Web-server parameters =====
define('DOMEN'          , 'engine37.com');
define('PATH_ROOT'      , '/clients/');    // Site root path
define('BPATH'          , $_SERVER['DOCUMENT_ROOT'].PATH_ROOT);
                                                        // Web-server root path

define('DIR_NAME_DATA' , 'files/upload');                    // Image directory name
define('DIR_WS_DATA'   , BPATH.DIR_NAME_DATA);        // Dir with uploaded images

// ============= Script parameters ================================
define('DEF_CHARSET',   'iso-8859-1');
define('SUPPORT_SITENAME', 'e37Project');
define('ADMIN_EMAIL',   'max@engine37.com');
define('SUPPORT_EMAIL', 'max@engine37.com');
define('ADMIN_LOGIN', 'admin');
define('FATAL_ERROR_DISP', 1);


define('ENCODING_PHP', 'CP1251');
define('RESULTS_COUNTER', 20);
define('ERROR_LEVEL'      , 2047);      // PHP error reporting level
define('ERROR_DISPLAY'    , 0);         // display errors

define('DIR_NAME_IMAGE' , 'files/images');                     // Image directory name
define('DIR_WS_IMAGE'   , BPATH.DIR_NAME_IMAGE);               // Dir with upload images
define('DIR_NAME_IMAGECACHE', 'files/images/imagecache');      // Image cache directory name

define('DIR_NAME_RESIZE', '/resize');                   // Image cache directory name
define('DIR_NAME_RESIZE2', '/resize2');                 // Image cache directory name

define('SESSION_NAME'     , 'cat3id');  // Default session name
define('SESSION_ID_IN_URL', false);     // Use session id in url

define('SSL_ONLY'         , false);     // SSL Only
                                        // for check use function 'crypt'
define('SALT_LENGTH'      , 9);         // used in functions 'uni_id', 'uni_id2'

                                        // default charset

define('TIME_OFFSET', 0);
define('SMARTY_ERROR_REPORTING', 0);
define('SMARTY_DEBUG', 0);
define('IMG_DRIVER', 'GD');

define('FTP_HTML_DIR', '/var/www/site06/sandbox/%project%/assets/design_html/');
define('HTTP_HTML_DIR', 'http://engine37.com/sandbox/%project%/assets/design_html/');

// ======================= end_CONFIGURATION ==============================
?>