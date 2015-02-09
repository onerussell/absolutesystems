<?php
/**
 * Users Class
 * @package   engine37 catalog 3.1
 * @version   0.1a
 * @since     01.02.2007
 * @copyright 2004-2007 engine37 Team
 * @link      http://engine37.com
*/

class Users
{
    public $LastError = 0; // Last Error Code
    public $ResOnPage = 0; // = 0 if not paginal viewing is required

    private $AccessRightsLevels = array('0' => 'Administrator',
                                        '1' => 'Client',
                                        '2' => 'Manager',
                                        '3' => 'Designer',
                                        '4' => 'Programmer'
                                        );
                                       // general rule: 
                                       //   more value of a level, 
                                      //   is user is more limited

    /**
     * Table with users
     *
     * @var string
     */
    private $mTable = 'users';     
    
    /**
     * Database pointer
     *
     * @var pointer
     */
    private $mDbPtr;
    
    public function __construct($dbPtr, $table, $resOnPage = 0)
    {
        $this -> mTable            = $table['table'];     
        $this -> ResOnPage         = $resOnPage;
        $this -> mDbPtr            = $dbPtr;
    }

    /**
     * Change user status
     *
     * @param int   $uid user id
     * @param array $status new status value
     *
     * @return void
     */
    public function ChangeStatus($uid, $status)
    {
        $sql =   'UPDATE '.$this -> mTable.' 
                  SET status=? 
                  WHERE uid=?';
        $this -> mDbPtr -> query($sql, array($status, $uid));
    }#ChangeStatus

    
    /**
     * Change one table field ('active' for example)
     *
     * @return true or false
     */
    public function ChgField($fld = '', $val = '', $uid = 0, $nc = 0)
    {
        if (0 == $uid || !is_numeric($uid) || '' == $fld)
        {
            return false;
        }
        $sql = 'UPDATE '.$this -> mTable.' SET '.$fld.' = '.((1 == $nc) ? $val : '"'.$val.'"').' WHERE uid = ?';
        $db  = $this -> mDbPtr -> query($sql, array($uid));
        return true;    
    }#ChgField
    
    
    public function Delete($uid)
    {
        $ci =& $this -> Get($uid);
        if (0 < count($ci))
        {
            $sql = 'DELETE FROM '.$this -> mTable.' WHERE uid=?';
            $this -> mDbPtr -> query($sql, array($uid));
            return true;
        }
        else 
        {    
            return false;    
        }
    }#Delete

    
    public function &Get($uid)
    {
         $sql = 'SELECT * 
                 FROM '.$this -> mTable.'
                 WHERE uid = ? AND is_deleted = 0';
         $db  = $this -> mDbPtr -> query($sql, array($uid));
         $r   = array();
         if ($row = $db -> FetchRow())
         {
             $r = $row;
         }
         return $r;
    }#Get
    
    public function GetLogin($uid)
    {
    	$sql = 'SELECT login FROM '.$this -> mTable.' WHERE uid = ? AND is_deleted = 0';
    	$r   = $this -> mDbPtr -> getOne($sql, array($uid));	
    	return $r;
    }#GetLogin
    
    /**
     * Get User Low Info
     *
     * @param int $uid
     * @return array with user info
     */
    public function &GetLowInfo($uid = 0)    
    {
        $sql = 'SELECT login, name, lname FROM '.$this -> mTable.' WHERE uid = ?';
         $db  = $this -> mDbPtr -> query($sql, array($uid));
         $r   = array();
         if ($row = $db -> FetchRow())
         {
             $r = $row;
         }
         return $r;
    }#GetLowInfo
    
    
    /**
     * Get user ID by login
     *
     * @param string $login
     * @return int User ID
     */
    public function GetByLogin($login)
    {
         $sql = 'SELECT uid 
                 FROM '.$this -> mTable.' 
                 WHERE login = ? AND is_deleted = 0';
         $db  = $this -> mDbPtr -> query($sql, array($login));
         $r   = 0;
         if ($row = $db -> FetchRow())
         {
             $r = $row['uid'];
         }
         return $r;
    }#GetByLogin
   
    /**
     * Get user ID by email
     *
     * @param string $email
     * @return int User ID
     */     
    function GetByEmail($email)
    {
         $sql = 'SELECT uid 
                 FROM '.$this -> mTable.' 
                 WHERE email = ?';
         $db  = $this -> mDbPtr -> query($sql, array($email));
         $r   = 0;
         if ($row = $db -> FetchRow())
         {
             $r = $row['uid'];
         }
         return $r;
    }#GetByEmail
       
    public function CheckLoginName($login = '')
    {
        $sql = 'SELECT 1 
                FROM '.$this -> mTable.' 
                WHERE login = ? AND is_deleted = 0';

        $db  = $this -> mDbPtr -> query($sql, $login);

        if (0 < $db -> NumRows() || empty($login))
        {
            return true;
        }
        else 
            return false;        
    }#CheckLoginName
    
    
    public function Add($ar = array())
    {

        $errs = array();

        if (!isset($ar['status']) || 0 > $ar['status'] || 4 < $ar['status'])
           $errs[] = 19;
        
        if (empty($ar['login']))
           $errs[] = 1;
        elseif (3 > strlen($ar['login']))
            $errs[] = 2; 
        elseif (20 < strlen($ar['login']))
            $errs[] = 3; 
        elseif (!preg_match('/^[a-z\d_ ]+$/i', $ar['login']))
            $errs[] = 4;
        else
        {
            $dbout = $this->mDbPtr->query('SELECT 1 
                                           FROM '.$this -> mTable.' 
                                           WHERE login=?', $ar['login']);

            if ($dbout -> numRows() > 0)
                $errs[] = 5;
        }

        if (empty($ar['email']))
           $errs[] = 6;
        elseif (!$this -> EmailValidate($ar['email']))
           $errs[] = 7;
        elseif (64 < strlen($ar['email']))
           $errs[] = 8;
        else
        {
            $dbout = $this->mDbPtr->query('SELECT 1 FROM '.$this -> mTable.' 
                                           WHERE email=?', $ar['email']);
            if ($dbout -> numRows() > 0)
                $errs[] = 9; 
        }

        if (empty($ar['name']))
           $errs[] = 10;
        elseif (2 > strlen($ar['name']))
           $errs[] = 11;
        elseif (100 < strlen($ar['name']))
           $errs[] = 12;

        if (empty($ar['lname']))
           $errs[] = 13;
        elseif (2 > strlen($ar['lname']))
           $errs[] = 14;
        elseif (100 < strlen($ar['lname']))
           $errs[] = 15;

        if (empty($ar['pass']) || empty($ar['pass2']) || strlen($ar['pass']) < 4)
            $errs[] = 16;
        elseif (20 < strlen($ar['pass']))
            $errs[] = 17;
        elseif ($ar['pass'] != $ar['pass2'])
            $errs[] = 18;
        
        if (!empty($errs))
        {
            throw new UsersException($errs);
        }
      
        $bx = array($ar['login'], 
                    crypt($ar['pass']), 
                    $ar['name'], 
                    $ar['lname'],
                    $ar['email'],
                    $ar['status']
                   );          
        $sql = 'INSERT INTO '.$this -> mTable.' SET
                login     = ?, 
                pass      = ?, 
                name      = ?,
                lname     = ?,
                email     = ?,
                status    = ?
                ';
        $this -> mDbPtr -> query($sql, $bx); 
        
        $sql = 'SELECT LAST_INSERT_ID()';
        $id  = $this -> mDbPtr -> getOne($sql);
       
        return $id;  
    }
    
    
    public function Change($uid, &$ar)
    {

        $errs = array();
        if (!isset($ar['status']) || 0 > $ar['status'] || 4 < $ar['status'])
           $errs[] = 19;
        
        if (empty($ar['login']))
           $errs[] = 1;
        elseif (3 > strlen($ar['login']))
            $errs[] = 2; 
        elseif (20 < strlen($ar['login']))
            $errs[] = 3; 
        elseif (!preg_match('/^[a-z\d_ ]+$/i', $ar['login']))
            $errs[] = 4;
        else
        {
            $dbout = $this->mDbPtr->query('SELECT 1 
                                           FROM '.$this -> mTable.' 
                                           WHERE login = ? AND uid <> ?', array($ar['login'], $uid));

            if ($dbout -> numRows() > 0)
                $errs[] = 5;
        }

        if (empty($ar['email']))
           $errs[] = 6;
        elseif (!$this -> EmailValidate($ar['email']))
           $errs[] = 7;
        elseif (64 < strlen($ar['email']))
           $errs[] = 8;
        else
        {
            $dbout = $this->mDbPtr->query('SELECT 1 FROM '.$this -> mTable.' 
                                           WHERE email = ? AND uid <> ?', array($ar['email'], $uid));
            if ($dbout -> numRows() > 0)
                $errs[] = 9; 
        }

        if (empty($ar['name']))
           $errs[] = 10;
        elseif (2 > strlen($ar['name']))
           $errs[] = 11;
        elseif (100 < strlen($ar['name']))
           $errs[] = 12;

        if (empty($ar['lname']))
           $errs[] = 13;
        elseif (2 > strlen($ar['lname']))
           $errs[] = 14;
        elseif (100 < strlen($ar['lname']))
           $errs[] = 15;

        if (!empty($ar['pass']) && !empty($ar['pass2'])) 
        {  
            if (strlen($ar['pass']) < 4)
                $errs[] = 16;
            elseif (20 < strlen($ar['pass']))
                $errs[] = 17;
            elseif ($ar['pass'] != $ar['pass2'])
                $errs[] = 18;
        }
        if (!empty($errs))
        {
            throw new UsersException($errs);
        }        

        $bx = array($ar['login'], 
                    $ar['name'], 
                    $ar['lname'],
                    $ar['email'],
                    $ar['status'],
                    $uid
                   );            
        $sql = 'UPDATE ' . $this -> mTable . ' SET 
                login = ?, '.
                ((0 < strlen($ar['pass'])) ? 'pass=\''.crypt($ar['pass']).'\', ' : '').'
                name      = ?,
                lname     = ?,
                email     = ?,
                status    = ?,
                checksum  = ""
                WHERE uid = ?';
        $this -> mDbPtr -> query($sql, $bx);  
                    
        return true;
    }#Change

    
    /**
     * Get elemnts count
     *
     * @param int $status - if == -1 - select all, else with status == $status 
     * @return unknown
     */
    public function Count($status = -1)
    {
        $sql = 'SELECT COUNT(*) AS cnt FROM '.$this -> mTable.' WHERE is_deleted = 0';
        if (0 <= $status)
        { 
           $sql .= ' AND status = '.$status; 
        }

        $db  = $this -> mDbPtr -> query($sql);
        $r   = array();
        if ($row = $db -> FetchRow())
        {
            $r = $row;
        }
        return $row['cnt'];
    } 

    
    /**
     * Get list of users 
     *
     * @param int $active - 1 - only active, -1 - all, 0- not active
     * @param int $status - users status
     * @param string $sort  - order by $sort
     * @param int $first - first element (for limit)
     * @param int $cnt - count of elements (for limit)
     * @param int $with_admin - if == 1 - select administrators too (for select "by status")
     * @return array with values
     */
    public function &GetUserList($active = 1, $status = -1, $sort = '', $first = 0, $cnt = 0, $with_admin = 0)
    {
        $r = array();
        $sql = 'SELECT u.* FROM '.$this -> mTable.' u 
                WHERE 1';
        if (1 == $active || 0 == $active)
        {      
            $sql .=  ' AND u.active = '.$active;     
        }
        if (0 <= $status && 4 >= $status)
        {
            $sql .= ' AND (u.status = '.$status.($with_admin ? ' OR u.status = 0' : '').')';
        }
        elseif (-2 == $status)
        {
            $sql .= ' AND u.status <> 0';
        }
        
        $sql .= ('' == $sort) ? ' ORDER BY u.name, u.lname, u.uid' : ' ORDER BY '.$sort;

        if (0 < $cnt)
        {
            $db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
        }
        else 
        {
            $db = $this -> mDbPtr -> query($sql);
        }   
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;              
    }#GetUserList
    
    
    /**
     * Check current administrator session or make session
     *
     * $module string access admin module
     * $mainpart - if  == 1  - it's main part of the Site (show all modules)
     *
     * @return int 0 on success session. 1 if specified login and password is correct. 2 on bad session. 3 on bad login or password
     */
    public function CheckLogin($module, $mainpart = 0)
    {
        if (preg_match(':/([^/]+\.[^/]+)$:', $module, $matches))
           {
            $module = $matches[1];
           }
        if (strlen(session_id()) <= 0 
            || empty($_SESSION['system_uid']) 
            || empty($_SESSION['system_login']) 
            || empty($_SESSION['system_session']) 
            || !isset($_SESSION['system_status']) 
            || (0 < $_SESSION['system_status'] && empty($_SESSION['system_modules']) && 0 == $mainpart)
           )
        {
            $_SESSION['system_uid']     = 0;
            $_SESSION['system_login']   = '';
            $_SESSION['system_session'] = '';
            $_SESSION['system_status']  = 0;
            $_SESSION['system_modules'] = '';
    
            $wlogin = 0;
            if (isset($_COOKIE['checksum']) && isset($_COOKIE['login']))
            {
            	$sql = 'SELECT uid, pass, status, modules, active, login FROM '.$this -> mTable.' 
            	        WHERE login = ? AND checksum = ?';
                $dbout = $this -> mDbPtr -> query($sql, array($_COOKIE['login'], $_COOKIE['checksum']));
                if ($dbout -> NumRows())
                {
                    $wlogin = 1;	
                }
            }   

                       
            if ((!empty($_POST['system_login']) 
                && !empty($_POST['system_pass'])) || $wlogin)
            {
                if (!$wlogin)
                {
                    $sql = 'SELECT uid, pass, status, modules, active, login 
                        FROM '.$this -> mTable.'
                        WHERE login = ?
                        AND status <= 4
                        AND is_deleted = 0';
                    $dbout = $this -> mDbPtr -> query($sql, array($_POST['system_login']));
                }

                if (0 == $dbout -> NumRows())
                   return 3;

                $row = $dbout -> FetchRow();
               

                if ($wlogin || (isset($_POST['system_pass']) && crypt($_POST['system_pass'], $row['pass']) == $row['pass']
                    && (0 == $row['status'] || preg_match('/;'.$module.';/', $row['modules']) || $mainpart == 1))
                   )
                {
                    if (0 != $row['active'] &&  0 != $row['status'])
                    {
                        
                    }
                    
                    $_SESSION['system_uid']     = $row['uid'];
                    $_SESSION['system_login']   = $row['login'];
                    $_SESSION['system_session'] = md5('pLmz2a4'.$row['login'].'pN5'.$row['status'].'1gh'.session_id().'O7dNm4s'.$row['pass'].'KxJxnz');
                    $_SESSION['system_status']  = $row['status'];
                    $_SESSION['system_modules'] = $row['modules'];

                    if ((isset($_POST['remember']) && 1 == $_POST['remember']) || $wlogin)
                    {
                    	// Save checksum for Autologin 
                    	$checksum = md5(rand(111111, 999999).$row['login'].'tu3'.$row['status'].'qx8'.session_id().mktime().$row['pass']);
                        $sql       = 'UPDATE '.$this -> mTable.' SET checksum = ? WHERE uid = ?';
                        $this -> mDbPtr -> query($sql, array($checksum, $row['uid']));
                        
                        setcookie('checksum', $checksum, mktime() + 31536000/12, null, '.'.DOMEN); 
                        setcookie('login', $_SESSION['system_login'], mktime() + 31536000/12, null, '.'.DOMEN);   
                    }                       
                    // die('ok');
                    // if (!empty($_POST['redirectLocation']))
                    //   uni_redirect($_POST['redirectLocation']);
                    return 1;
                }
                else
                    return 3;
            }
            else
                return 2;
        }
        else
        {

            $sql = 'SELECT pass, status, modules 
                    FROM '.$this -> mTable.'
                    WHERE login = ?
                    AND status <= 4 AND is_deleted = 0';
            $dbout = $this -> mDbPtr -> query($sql, array($_SESSION['system_login']));

            if (0 == $dbout -> NumRows())
               return 2;

            $row = $dbout -> FetchRow();
            // Generate check value
            $compValue = md5('pLmz2a4'.$_SESSION['system_login'].'pN5'.$row['status'].'1gh'.session_id().'O7dNm4s'.$row['pass'].'KxJxnz');

            if ($_SESSION['system_session'] == $compValue
                && (0 == $row['status'] 
                    || preg_match('/;'.$module.';/', $row['modules']) || $mainpart == 1)
               )
                return 0;
            else
                return 2;
        }
    }#CheckLogin
    
    
    /**
     * Check current administrator session or make session
     *
     * @param string $authMessage      message, for example 'Bad username'
     * @param string $redirectLocation url where the user after successful authorization should be redirected
     *
     * @return void
     */
    public function AuthForm($authMessage = '', $redirectLocation = CURRENT_URL)
    {
        global $gSmarty;
    
        if (isset($_POST['system_login']))
            $gSmarty -> assign('systemLogin', $_POST['system_login']);
    
        $gSmarty -> assign('authMessage'     , $authMessage);
        $gSmarty -> assign('redirectLocation', $redirectLocation);
        $gSmarty -> display('admin_auth.html');
        exit();
    }#AuthForm
    
    /**
     * Logout method
     *
     * @return false
     */
    public function Logout()
    {
         unset($_SESSION['system_uid']);
         unset($_SESSION['system_login']);
         unset($_SESSION['system_session']);
         unset($_SESSION['system_status']);
         unset($_SESSION['system_modules']);
         
         setcookie('checksum', '',0, null, '.'.DOMEN); 
         setcookie('login', '', 0, null, '.'.DOMEN);         
         return true;
    }#Logout
    
    
    /**
     * Restore user password
     * @param int $uid user id
     * @param string $email user email
     * @return string new password
     */
    public function RestorePassword($uid, $email)
    {
        $newPass = substr(uni_id2($uid.$email),0,8);

        $data[] = crypt($newPass);
        $data[] = $uid;
        $this->mDbPtr->query('UPDATE '.$this -> mTable.'
                              SET pass = ?
                              WHERE uid = ?', $data);

        return $newPass;

    }#RestorePassword
    
    
    /**
     * Email validate method
     *
     * @param string $email
     * @return bool true or false
     */
    public function EmailValidate ($email)
    {
        if (ereg("([[:alnum:]\.\-]+)(\@[[:alnum:]\.\-]+\.+)", $email)) 
            return true;
        else 
            return false;
    }#EmailValidate 
    
    /**
     * Add photo to user
     *
     * @param string $image
     * @param int $id - user ID
     * @return bool true
     */
    public function AddPhoto($image, $id)
    {
    	$sql = 'UPDATE '.$this -> mTable.' SET image = ? WHERE uid = ?';
    	$this -> mDbPtr -> query($sql, array($image, $id));
    	return true;
    }#AddPhoto
    
  
    public function DelPhoto($id)
    {
    	$sql = 'UPDATE '.$this -> mTable.' SET image = ? WHERE uid = ?';
    	$this -> mDbPtr -> query($sql, array("", $id));
    	return true;    	
    }#DelPhoto
    
}#end Users class


/**
 * Define a Users exception class
 */
class UsersException extends Exception
{
    public function __construct($code)
    {
        if (is_array($code))
        {
           $text = serialize($code);
           $code = -1;
        }
        else
           $text = null;

        parent::__construct($text, $code);

    }#end constructor

}#end class
?>