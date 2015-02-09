<?php
/**
 * Main functions library
 * 
 * @package    engine37 Catalog v3.0
 * @version    1.1a
 * @since      25.12.2005
 * @copyright  2004-2005 engine37.com
 * @link       http://engine37.com
 */

// {{{ pear_error_callback()

/**
 * PEAR Error handling function. Generate exception.
 *
 * @param object $errorPbj
 * @return void
 */
function pear_error_callback($errorObj) 
{
    throw new Exception($errorObj->message.'<br /><br />'.$errorObj->userinfo);
}

// }}}
// {{{ get_referer()

function get_referer($onlyMyHost = true)
{
    $ref = getenv('HTTP_REFERER');
    if ($ref)
    {
        if ($onlyMyHost)
        {
            $out = p_url($ref);
            $ref = $out['path'].$out['query'];
        }
    }
    else
        $ref = '/';

    return $ref;
}

// }}}
// {{{ sc_exit()

/**
 * Normal exit
 *
 * @param bool $callExit call exit() after function execution
 * @return void
 */
function sc_exit($callExit = true)
{
    global $gDb;
    @$gDb -> disconnect();

    $_SESSION = array();

    if (isset($_COOKIE[session_name()]))
       setcookie(session_name(), '', m_time()-90000, '/');

    session_unset();
    session_destroy();

    if ($callExit)
        exit();
}

// }}}
// {{{ sc_error()

/**
 * Standard function for display of errors
 *
 * @param string $mess       message of error
 * @param string $addMess    additional information about error
 * @param string $fName      script name
 * @param string $lineNumber number of line in script
 *
 * @return string
 */
function sc_error(&$mess, $addMess = '', $fName = '', $lineNumber = '')
{
    $trace = '';
    if (is_object($mess))
    {
        $trace  = $mess -> getTrace();
        $newArr = array();
        for ($i = 0; $i < count($trace); $i++)
        {
            if (preg_match('/(pear|db\.php)/i', @$trace[$i]['file']) )
               continue;
               
            $newArr[] = $trace[$i];
        }

        $trace      = '<pre>'.print_r($newArr,true).'</pre>';
        $lineNumber = $mess -> getLine();
        $fName      = $mess -> getFile();
        $mess       = $mess -> getMessage();
    }

    $matches = array();
    if (preg_match('/^\@(.+)$/', $mess, $matches)) 
       {
        global $gLang;
        $mess = $gLang[$matches[1]];
       }

    if (!empty($fName))
        $mess .= '<br /><br />file: '.$fName.'<br />line: '.$lineNumber;
     else
        $mess .= '<br /><br />script: '.getenv('SCRIPT_NAME');

    $mess = '<font color="#000000"><b>' . $mess . '<br /><br />';

    if (!empty($addMess))
       $mess .= $addMess . '<br /><br />';

    $mess .=  '<small><font color="#ff0000">STOP</font></small>'
            .'<br /><br /></b></font>'.$trace;

    if (FATAL_ERROR_DISP == 1)
        die($mess);
    else
    {
        admin_notify('Fatal Error', $mess);
        uni_redirect(PATH_ROOT.'TechnicalError.html', 2);
    }
}

// }}}
// {{{ uni_id2()

/**
 * Generate random string value (through md5) based on unique information.
 * Initial unique information is supplemented with random numbers
 *
 * @param string $info unique information for encryption
 *
 * @return string
 */
function uni_id2($info = '')
{
    $length = SALT_LENGTH;
    $chars = '0123456789abcdef';
    $salt  = '';
    mt_srand((double)microtime()*1000000);
    while ($length--) 
    {
        $salt .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    
    return md5($salt.$info.mt_rand(0,1000000).get_mt_time());
}


// }}}
// {{{ uni_id()

/**
 * Generate random string value (through md5) based on unique information.
 * Result string includes additional information for subsequent comparison.
 *
 * @param string $info unique information for encryption
 *
 * @return string
 *
 * @see auto_login()
 */
function uni_id($info = '')
{
    $length = SALT_LENGTH;
    $chars  = '0123456789abcdef';
    $salt   = '';
    mt_srand((double)microtime()*1000000);
    while ($length--) 
    {
        $salt .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    
    return $salt.md5($salt.$info);
}

// }}}
// {{{ randval()

/**
 * Generate random unique integer value dependent on current time
 *
 * @return int
 */
function randval()
{
   return (int)date('n').date('j').date('y').date('h').date('i').date('s').rand(99,2);
}         

// }}}
// {{{ uni_redirect()

/**
 * Universal function for redirect. Auto-update urls if use_trans_id is on.
 *
 * @param string $url       url for redirect
 * @param int    $flag      type of redirect: 1,3 - through HTTP Header, 2,4 - through meta-tag. 3,4 - auto-update url with https (SSL Only)
 * @param int    $useSID    update url with session id: 0 - never, 1 - if no host in url, 2 - always
 * @param string $addParams this string is put in url end
 *
 * @return void
 */
function uni_redirect($url, $flag = 1, $useSID = 1, $addParams = '') // 
{
    $url = add_sid($url,$useSID);
    if ('' != $addParams)
    {
        $purl   = parse_url($url);

        if (3 == $flag || 4 == $flag)
            $scheme = 'https://';
        else
            $scheme = (!empty($purl['scheme'])) ? $purl['scheme'].'://' : '';

        $host   = (!empty($purl['host'])) ?$purl['host'] : '';
        $port   = (!empty($purl['port'])) ?$purl['port'] : '';
        $path   = (!empty($purl['path'])) ?$purl['path'] : '/';


        $url    = $scheme.$host.$port.$path.'?';
        
        $url   .= (!empty($purl['query'])) ? $purl['query'].'&' : '';
        $url   .= $addParams;
    }

    if (1 == $flag || 3 == $flag)
        header('Location: '.$url);
     else
        echo '<html><head><meta http-equiv="Refresh" content="0; url='.$url.'" /></head></html>';

    exit();
}

// }}}
// {{{ add_sid()

/**
 * Add session id in url if it is required
 *
 * @param string $url     url
 * @param int    $useSID  0 - no , 1 - if no host, 2 - always
 *
 * @return string result url
 *
 * @see uni_redirect()
 */
function add_sid($url, $useSID = 1) // 
{
    $purl   = parse_url($url);
    $scheme = (!empty($purl['scheme']))  ? $purl['scheme'].'://' : '';
    $host   = (!empty($purl['host']))    ? $purl['host']         : '';
    $port   = (!empty($purl['port']))    ? $purl['port']         : '';
    $path   = (!empty($purl['path']))    ? $purl['path']         : '/';
                   
    $url = $scheme.$host.$port.$path;

    if (defined('SID') && strlen(SID) > 0 
        && (2 == $useSID || 1 == $useSID && empty($host) ) )
    {
        if (!empty($purl['query']) && preg_match('/'.SID.'/',$purl['query']))
           $url = $url.'?'.$purl['query'];
        else 
           $url = (!empty($purl['query'])) ? $url.'?'.$purl['query'].'&'.SID : $url.'?'.SID;
    }
    else
       $url = (!empty($purl['query'])) ? $url.'?'.$purl['query'] : $url;

    return $url;
}

// }}}
// {{{ get_mt_time()

/**
 * Time in seconds including micro seconds.
 *
 * @return string time in seconds: example 5.234232432
 *
 * @see microtime()
 */
function get_mt_time()
{
    $arr = split(' ',microtime());
    return ($arr[0] + $arr[1]);
}

// }}}
// {{{ m_time()

/**
 * Hides and supplements corresponding PHP-function mktime().
 * Can be used for global shift of time zone.
 *
 * @return int UNIX-time in seconds
 *
 * @see mktime()
 */
function m_time()
{
    return mktime();
}

// }}}
// {{{ auto_login()

/**
 * Used for automatic users authorization by check of the crypted information transmitted in url.
 *
 * @param string $authInfo crypted information (MD5)
 * @param string $str      unique user information
 *
 * @return bool true on success otherwise false

 * @see uni_id()
 */
function auto_login($authInfo, $str) 
{
    $salt = substr($authInfo, 0, SALT_LENGTH);
    $auth = substr($authInfo, SALT_LENGTH);

    if (md5($salt.$str) == $auth)
        return false;
     else
        return true;
}


// }}}
// {{{ admin_notify()

/**
 * Send email to admin (with email ADMIN_EMAIL)
 *
 * @param string $source  message subject
 * @param string $message message text
 *
 * @return void
 *
 * @see includes/config/main.ini
 */
function admin_notify($source, $message)
{
    $headers = '';
    $headers .= 'From: '.SUPPORT_SITENAME.' Notification <'.SUPPORT_EMAIL.">\n";
    $headers .= 'Content-Type: text/html; charset='.DEF_CHARSET."\n"; 
    @mail(ADMIN_EMAIL,'New notify: '.$source, $message, $headers);
}

// }}}
// {{{ send_email2user()

/**
 * Send message to specified email
 *
 * @param string $email   user email
 * @param string $source  message subject
 * @param string $message message text
 *
 * @return void
 */
function send_email2user($email, $source, $message)
{
    $headers = '';
    $headers .= 'From: '.SUPPORT_SITENAME.' Support <'.SUPPORT_EMAIL.">\n";
    $headers .= 'Content-Type: text/html; charset='.DEF_CHARSET."\n"; 
    @mail($email,$source, $message, $headers);
}

// }}}
// {{{ p_url()

/**
 * Parse url. Hides and supplements corresponding PHP-function.
 *
 * @param string $email email for checking
 *
 * @return array with urls parts: scheme, host, port, path, query. 
 *              All these array elements is defined
 */
function p_url($url)
{
    $url = parse_url($url);
    $url['scheme'] = (!empty($url['scheme'])) ? $url['scheme'].'://' : '';
    $url['host']   = (!empty($url['host']))   ? $url['host']         : '';
    $url['port']   = (!empty($url['port']))   ? $url['port']         : '';
    $url['path']   = (!empty($url['path']))   ? $url['path']         : '/';
    $url['query']  = (!empty($url['query']))  ? $url['query']        : '';
    return $url;
}


// }}}
// {{{ verify_email()

/**
 * Verify Email
 *
 * @param string $email email for checking
 *
 * @return bool false if bad email or true if email is correct
 */
function verify_email($email)
{
    if (preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)|(\.$)|:/',$email)||
        (!preg_match('/^.+\@localhost$/',$email) &&
        !preg_match('/^.+\@\[?(\w|[-.])+\.[a-zA-Z]{2,4}|[0-9]{1,3}\]?$/',$email))
       )
        return false;

    return true;
}

// }}}
// {{{ page404()

/**
 * Show message and send 404 Error to browser
 *
 * @param string $mess Shown which will be shown
 *
 * @return void
 */
function page404($mess = '')
{
    header('HTTP/1.0 404');
    echo '<html><body>'.$mess.'</body></html>';
    exit();
}

// }}}
// {{{ curlget()

/**
 * Get url through cURL
 *
 * @return mixed false on error or string otherwise
 */
function curlget ($url, $ua=false, $timeout=60, $method='get' ,$proxy=false)
{
    if($ua === false) $ua = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; Q312461)';

    if ($method=='post')
       {
        $purl = parse_url($url);
        $scheme=!empty($purl['scheme'])?$purl['scheme'].'://':'';
        $host = !empty($purl['host'])?$purl['host']:'';
        $port = !empty($purl['port'])?$purl['port']:'';
        $path = !empty($purl['path'])?$purl['path']:'/';
        $query= !empty($purl['query'])?$purl['query']:'';

        $headers = array('Connection: Keep-Alive');
        $url=$scheme.$host.$port.$path;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $scheme.$host);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$query);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); 

        if ($proxy!==false)
           curl_setopt($ch, CURLOPT_PROXY,$proxy);

        curl_setopt($ch, CURLOPT_POST, 1); // set POST method 
       }
     else
       {
        $refAr = parse_url($url);
        $scheme=!empty($refAr['scheme'])?$refAr['scheme'].'://':'';
        $headers = array('Connection: Keep-Alive');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $scheme . $refAr['host']);
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); 
  
        if ($proxy!==false)
          curl_setopt($ch, CURLOPT_PROXY,$proxy);
       } 
    $result = curl_exec($ch);
    if (!$ch) return false;
    curl_close($ch);
    return $result;
}

// }}}

function text_filter($mess, $tags = '' , $flag = true)
{
     $mess = StripSlashes($mess);
     $mess = preg_replace('/<br.*?>/is', "\n",$mess);
     $mess = preg_replace("/\r\n/","\n",$mess);
     $mess = preg_replace("/^\n+(.+?)\n+$/is","\\1",$mess);
     $mess = preg_replace("/\n{3,}/is","\n\n",$mess);
     $mess = strip_tags($mess, $tags);
     $mess = trim($mess);
     if ($flag)
         $mess = nl2br(htmlspecialchars($mess));

     return $mess;
}

?>