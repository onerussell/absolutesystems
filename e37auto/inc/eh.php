<?


function db_log_error($error_obj) {

	echo "System error. Please report this problem to <a href='mailto:support@engine37.com'>support@engine37.com</a>. Thank you.";
	$ip = $_SERVER['REMOTE_ADDR'];
    error_log('['.$ip.']-['.$_SERVER[REQUEST_URI].']-['.@gethostbyaddr($ip).']-['.$_SERVER[HTTP_REFERER].']-['.$_SERVER[HTTP_USER_AGENT].']  '.$error_obj->message.' '.$error_obj->userinfo);
    error_log('['.$ip.']-['.$_SERVER[REQUEST_URI].']-['.@gethostbyaddr($ip).']-['.$_SERVER[HTTP_REFERER].']-['.$_SERVER[HTTP_USER_AGENT].']  '.$error_obj->message.' '.$error_obj->userinfo,1, ADMIN_ERROR_MAIL);
    exit();

}


function e37_error_handler($errNo, $errStr, $errFile, $errLine)  {
                                                            
  $backtrace = dbg_get_backtrace(2);                         

  // error message to be displayed, logged or mailed  , E_ALL       

  $error_message = "\nERRNO: $errNo \nTEXT: " . $errStr . " \n" . 
               "LOCATION: " . $errFile . ", line " . $errLine . ", at " . 
               date("F j, Y, g:i a") . "\nShowing backtrace:\n" . 
               $backtrace . "\n\n";


  if ( $errNo != E_NOTICE ) {

  if (SEND_ERROR_MAIL == true)    
      error_log($error_message, 1, ADMIN_ERROR_MAIL, "From: " . 
                 SENDMAIL_FROM . "\r\nTo: " . ADMIN_ERROR_MAIL);  

  }

  if ($errNo == E_USER_ERROR) {
    exit();         
  }

}               

// builds backtrace message
function dbg_get_backtrace($irrelevantFirstEntries)
{                 
  $s = '';        
  $MAXSTRLEN = 64;
  $traceArr = debug_backtrace();
  for ($i = 0; $i < $irrelevantFirstEntries; $i++)
    array_shift($traceArr);
  $tabs = sizeof($traceArr) - 1;
  foreach($traceArr as $arr)
  {               
    $tabs -= 1;                                              
    if (isset($arr['class']))                                
       $s .= $arr['class'] . '.';                            
    $args = array();                                         
    if (!empty($arr['args']))                                
    foreach($arr['args']as $v)                               
    {                                                        
       if (is_null($v))                                      
         $args[] = 'null';                                   
       else if (is_array($v))                                
         $args[] = 'Array[' . sizeof($v).']';                
       else if (is_object($v))                               
         $args[] = 'Object:' . get_class($v);                
       else if (is_bool($v))                                 
         $args[] = $v ? 'true' : 'false';                    
       else                                                  
       {                                                     
         $v = (string)@$v;                                   
         $str = htmlspecialchars(substr($v, 0, $MAXSTRLEN)); 
         if (strlen($v) > $MAXSTRLEN)                        
           $str .= '...';                                    
         $args[] = "\"" . $str . "\"";                       
       }                                                     
    }                                                        
    $s .= $arr['function'] . '(' . implode(', ', $args) . ')';
    $Line = (isset($arr['line']) ? $arr['line']: "unknown"); 
    $File = (isset($arr['file']) ? $arr['file']: "unknown"); 
    $s .= sprintf(" # line %4d, file: %s", $Line, $File, $File);
    $s .= "\n";                                              
  }                                                          
  return $s;                                                 
} 

?>
