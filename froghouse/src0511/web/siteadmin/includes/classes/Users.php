<?php
/**
 * Simple interface, allowing to simple control of registered users.
 * By the current moment are supported:
 * paginal viewing, edit, delete
 * 
 * @package    engine37 Catalog v3.0
 * @version    0.3b
 * @since      25.03.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */
class Users
{
    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;

    /**
     * Users count on each page (for administration panel)
     * Set 0 if not paginal viewing is required
     * @var int
     */
    private $mResOnPage; 

    /**
     * Friends count on each page (for administration panel)
     * Set 0 if not paginal viewing is required
     * @var int
     */
    private $mFriendsOnPage = 16; 

    /**
     * Friends count on each page (for administration panel)
     * Set 0 if not paginal viewing is required
     * @var int
     */
    private $mFriendRequestsOnPage = 10; 

    /**
     * Geografy class object
     * @var mixed
     */
    private $mGeo; 

    /**
     * Access levels for Users: level => short name
     * General rule: the more value of a level, the the user is more limited
     * @var array
     */
    private $mAccessRightsLevels = array('1' => 'accepted',
                                         '2' => 'rejected',
                                         '3' => 'suspended',
                                         '0' => 'pending');

    /**
     * Database table for Users
     * @var string
     */
    private $mTable;

    /**
     * countries table
     * @var string
     */
    private $mTableCntr;

    /**
     * cities table
     * @var string
     */
    private $mTableCity;

    /**
     * Constructor. Iniatilize base class variables
     *
     * @param mixed  $dbPtr              PEAR::DB pointer
     * @param string $table              database table for Users
     * @param string $tableCntr          database table for user countries
     * @param string $tableCity          database table for user cities
     * @param mixed  $geo                Geografy class object
     * @param int    $resOnPage          Users count on each page (for administration panel)
     *                                   Set 0 if not paginal viewing is required
     * @param array  $accessRightsLevels access levels: level => short name
     *
     * @return void
     */
    public function __construct($dbPtr, $table = 'users', $tableCntr = 'countries', $tableCity = 'countries_cities', &$geo, $resOnPage = 20, $accessRightsLevels = array())
    {
        $this -> mDbPtr      =  $dbPtr;
        $this -> mTable      =  $table;
        $this -> mTableCntr  =  $tableCntr;
        $this -> mTableCity  =  $tableCity;
        $this -> mResOnPage  =  $resOnPage;
        $this -> mGeo        =& $geo;

        if (!empty($accessRightsLevels))
            $mAccessRightsLevels =& $accessRightsLevels;

    }#end constructor

    // ==================================================================

    // < Getter/ Setter methods >

    public function SetFriendsOnPage($val)
    {
        $this -> mFriendsOnPage = $val;
    }#SetFriendsOnPage

    public function FriendsOnPage()
    {
        return $this -> mFriendsOnPage;

    }#FriendsOnPage

    // -------------------------------------------------------------------

    public function SetFriendRequestsOnPage($val)
    {
        $this -> mFriendRequestsOnPage = $val;
    }#SetFriendRequestsOnPage

    public function FriendRequestsOnPage()
    {
        return $this -> mFriendsOnPage;

    }#FriendsOnPage

    // -------------------------------------------------------------------

    public function SetResOnPage($val)
    {
        $this -> mResOnPage = $val;
    }#SetResOnPage

    public function ResOnPage()
    {
        return $this -> mResOnPage;

    }#ResOnPage

    // </ Getter/Setter methods >

    // ====================================================================

    // < Change methods >

    public function InviteFriend($uid, $mess, $code)
    {
        $uid  = intval($uid);
        $code = intval($code);

        if (empty($mess['friend_name']))
           throw new UsersException(1);

        if (empty($mess['friend_email'])
            || !verify_email($mess['friend_email']))
           throw new UsersException(2);

        if (empty($code) || empty($mess['code'])
            || $code != $mess['code'])
           throw new UsersException(3);

        global $gSmarty;

        $gSmarty -> assign('youremail'  , $_SESSION['UserInfoEmail']);
        $gSmarty -> assign('yourname'   , $_SESSION['UserInfoNickname']);
        $gSmarty -> assign('friendname' , substr(text_filter($mess['friend_name']),0, 70));
        $gSmarty -> assign('friendemail', substr($mess['friend_email'],0, 40));
        $gSmarty -> assign('message'    , substr(text_filter($mess['message']), 0, 300) );

        $message = $gSmarty->fetch('mails/_invite.tpl');

        send_email2user($mess['friend_email'], SUPPORT_SITENAME.': Invite from '.$_SESSION['UserInfoNickname'], $message);
    }

    /**
     * Change user status
     *
     * @param int   $uid user id
     * @param array $status new status value
     *
     * @return void (for errors detection use try-catch)
     */
    public function ChangeStatus($uid, $status)
    {
        $data[] = intval($status);
        $data[] = intval($uid);

        $this->mDbPtr->query('UPDATE '.$this -> mTable.' 
                              SET status=? WHERE uid=?', $data);

        if (1 == $status)
        {
            $letter = $this->mDbPtr->getOne('SELECT letter FROM '.$this->mTable.'_approve_letters WHERE uid='.$uid);
            $email  = $this->mDbPtr->getOne('SELECT email FROM '.$this->mTable.' WHERE uid='.$uid);
            if ($letter && $email)
            {
                send_email2user($email, SUPPORT_SITENAME.': Thanks for registering', $letter);
                $this->mDbPtr->query('DELETE FROM '.$this->mTable.'_approve_letters WHERE uid='.$uid);
            }
        }
    }#ChangeStatus

    /**
     * Friend request
     * @param int $toid   friend id
     * @param int $fromid
     * @return int 1 if request added
                   2 if friend added (no request required)
                   (for errors detection use try-catch)
     */
    public function AddFriendRequest($toid, $fromid)
    {
        $toid   = intval($toid);
        $fromid = intval($fromid);

        $settings = $this -> GetSettings($toid);
        $flag = @$settings['Friends']['Always'];

        if (!$flag)
        {
            $res = $this -> mDbPtr -> getOne('SELECT 1
                                              FROM '.$this->mTable.'_friends_requests
                                              WHERE toid = '.$toid.'
                                                     AND fromid = '.$fromid.'
                                                     AND status = 0');

            if (!$res)
                $this -> mDbPtr -> query('INSERT INTO '.$this->mTable.'_friends_requests
                                          (toid, fromid, sendtime)
                                          VALUES ('.$toid.','.$fromid.',NOW())');
            return 1;
        }
        else
        {
            $this -> AddFriend($fromid, $toid);
            return 2;
        }

    }#AddFriendRequest

    /**
     * Add new user
     * @param array $ar values for each column: column => value.
                        Transferred columns change only.
     * @return int insert id (for errors detection use try-catch)
     */
    public function Add(&$ar)
    {
        if (empty($ar['email']) || !verify_email($ar['email']))
            throw new UsersException(4);

        if (strlen($ar['pass']) < 4)
            throw new UsersException(5);

        if ($ar['pass'] != $ar['pass2'])
            throw new UsersException(3);

        if (empty($ar['nickname']))
           throw new UsersException(6);

        $dbout = $this->mDbPtr->query('SELECT 1 FROM '.$this -> mTable.' 
                                       WHERE email=?', $ar['email']);
        if ($dbout -> numRows() > 0)
            throw new UsersException(1); // = error #1: user with this email already exists;

        $dbout = $this->mDbPtr->query('SELECT 1 FROM '.$this -> mTable.' 
                                       WHERE nickname=?', $ar['nickname']);
        if ($dbout -> numRows() > 0)
            throw new UsersException(11); // = error #11: user with this email already exists;

        unset($ar['pass2']);

        global $gSmarty;
        $gSmarty -> assign('UserInfo', $ar);
        $letter = $gSmarty -> fetch('mails/_send_reg.tpl');

        $ar['pass'] = crypt($ar['pass']);

        $columns = array('onmain',
                         'email',
                         'pass', 
                         'fname',
                         'mname',
                         'nickname',
                         'iso2_cntr',
                         'abroad_city_id',
                         'abroad_status',
                         'status',
                         'birthday',
                         'originally_from',
                         'here_for',
                         'uni_home',
                         'uni_host',
                         'languages',
                         'visited_cities',
                         'like_visit',
                         'relation_status',
                         'sexual_orientation',
                         'turn_ons',
                         'turn_offs',
                         'interested_in',
                         'quote',
                         'about_me',
                         'best_travel_story',
                         'travel_advice');

        $cnt = count($columns);
        for ($i = 0; $i < $cnt; $i++)
        {
            if (!isset($ar[$columns[$i]]))
               {
                if ($columns[$i] == 'status')
                   $ar['status'] = 0;
                 else
                   continue; // throw new UsersException(0);
               }

            if ($columns[$i] == 'birthday')
               $ar['birthday'] = strtotime($ar['birthday']['Year'].'-'.$ar['birthday']['Month'].'-'.$ar['birthday']['Day']);

            $keys[] = $columns[$i];
            $vals[] = htmlspecialchars(strip_tags($ar[$columns[$i]]));
            $phod[] = '?';
        }

        $cols = join(',', $keys);
        $row  = join(',', $phod);

        $this->mDbPtr->query('INSERT INTO '.$this -> mTable.' ' .'('.$cols.', reg_date) VALUES ('.$row.', NOW())', $vals);

        $uid = $this->mDbPtr->getOne('SELECT LAST_INSERT_ID()');

        if (0 == $ar['status'])
            $this->mDbPtr->query('INSERT INTO '.$this->mTable.'_approve_letters (uid,letter) VALUES (?,?)', array($uid, $letter));
        elseif (1 == $ar['status'])
            send_email2user($ar['email'], SUPPORT_SITENAME.': Thanks for registering', $letter);
        // send_email2user(SUPPORT_EMAIL, SUPPORT_SITENAME.': Thanks for registering', $letter);

        $admin_uid = $this->GetUidByEmail(REG_WEBM_EMAIL);
        if ($admin_uid)
        {
            $this->AddFriendRequest($uid, $admin_uid);
            require INC_PATH.'includes/classes/MC.php';
            $mc =& new MC($this->mDbPtr, TB.'mc', TB.'users', '<p><br><a><b><i><a>', $this, $this, 20);
            $mc -> Add($uid, $admin_uid, REG_WEBM_SUBJECT, REG_WEBM_MESSAGE);
        }
        return $uid;

    }#Add

    /**
     * Change all user info
     * @param int   $uid user id
     * @param array $ar new values for each column: column => value.
                        Transferred columns change only.
     * @return void (for errors detection use try-catch)
     */
    public function Change($uid, &$ar)
    {
        if (empty($ar['email']) || !verify_email($ar['email']))
            throw new UsersException(4);

        if (isset($ar['pass']))
        {
            if (strlen($ar['pass']) > 0 || strlen($ar['pass2']) > 0)
            {
                if (strlen($ar['pass']) < 4)
                    throw new UsersException(5);
       
                if ($ar['pass'] != $ar['pass2'])
                    throw new UsersException(3);
       
                $ar['pass'] = crypt($ar['pass']);
       
            }
            else
                unset($ar['pass']);
         unset($ar['pass2']);
        }

        if (isset($ar['nickname']) && 0 == strlen($ar['nickname']))
            throw new UsersException(6);

        $dbout = $this->mDbPtr->query('SELECT 1 
                                       FROM '.$this -> mTable.'
                                       WHERE uid<>\''.$uid.'\' 
                                             AND email=\''.$ar['email'].'\'');
        if ($dbout -> numRows() > 0)
            throw new UsersException(1); // = error #1: user with this nickname already exists;

        $dbout = $this->mDbPtr->query('SELECT 1 
                                       FROM '.$this -> mTable.'
                                       WHERE uid<>\''.$uid.'\' 
                                             AND nickname=\''.$ar['nickname'].'\'');
        if ($dbout -> numRows() > 0)
            throw new UsersException(11); // = error #11: user with this nickname already exists;

        $columns = array('onmain',
                         'email',
                         'pass',
                         'fname',
                         'mname',
                         'nickname',
                         'iso2_cntr',
                         'abroad_city_id',
                         'abroad_status',
                         'status',
                         'birthday',
                         'originally_from',
                         'here_for',
                         'uni_home',
                         'uni_host',
                         'languages',
                         'visited_cities',
                         'like_visit',
                         'relation_status',
                         'sexual_orientation',
                         'turn_ons',
                         'turn_offs',
                         'interested_in',
                         'quote',
                         'about_me',
                         'best_travel_story',
                         'travel_advice');

        while (list($key,$val) = each($ar))
        {
            if (!in_array($key, $columns))
               continue;

            if ('birthday' == $key)
            {
                $ar['birthday'] = strtotime($ar['birthday']['Year'].'-'.$ar['birthday']['Month'].'-'.$ar['birthday']['Day']);
                $val = $ar['birthday'];
            }
            elseif ('onmain' == $key)
            {
                $ost = $this -> GetOnMainStatus($uid);
                if (0 == $ost && 0 < $ar['onmain'])
                {
                   $val = m_time();
                   $this -> DeleteOnMainOlder();
                }
            }

            $keys[] = $key.'=?';
            $vals[] = strip_tags($val);
        }

        $cols = join(',', $keys);
        $vals[] = $uid;

        $this->mDbPtr->query('UPDATE '.$this -> mTable.'
                              SET '.$cols.' WHERE uid=?', $vals);

        if (isset($ar['status']) && 1 == $ar['status'])
        {
            $letter = $this->mDbPtr->getOne('SELECT letter FROM '.$this->mTable.'_approve_letters WHERE uid='.$uid);
            if ($letter)
            {
                send_email2user($ar['email'], SUPPORT_SITENAME.': Thanks for registering', $letter);
                $this->mDbPtr->query('DELETE FROM '.$this->mTable.'_approve_letters WHERE uid='.$uid);
            }
        }
    }#Change

    public function DeleteOnMainOlder()
    {
        $arr =& $this -> GetOnMain();
                                             
        $cnt = count($arr);
        
        if (4 <= $cnt)
            $this->mDbPtr->query('UPDATE '.$this -> mTable.'
                                  SET onmain=0 WHERE uid = '.intval($arr[3]['uid']));

    }#DeleteOnMainOlder

    /**
     * @param int $id request id
     * @param int $toid correct user id
     * @return void
     */
    public function ApproveFriend($id, $toid)
    {
        $id   = intval($id);
        $toid = intval($toid);

        $row =& $this->mDbPtr->getRow('SELECT id, toid, fromid
                                       FROM '.$this->mTable.'_friends_requests
                                       WHERE id='.$id.' AND toid ='.$toid);

        if ($row)
        {
            $this -> AddFriend($toid, $row['fromid']);
            $this -> DeleteFriendRequest($id, $row['fromid']);
        }
        else
            throw new UsersException(12);

    }#ApproveFriend

    public function UpdateSettings($uid, $settings)
    {
        //if ($settings)
        //{
            $settings = serialize($settings);

            $vals = array($settings, $uid);

            $this->mDbPtr->query('UPDATE '.$this->mTable.'
                                  SET settings = ?
                                  WHERE uid= ?', $vals);
        //}

    }#UpdateSettings

    /**
     * @param int $id request id
     * @param int $toid correct user id
     * @return void
     */
    public function DisapproveFriend($id, $toid)
    {
        $id   = intval($id);
        $toid = intval($toid);

        $this -> mDbPtr -> query('UPDATE '.$this->mTable.'_friends_requests
                                  SET status=1
                                  WHERE id='.$id.' AND toid='.$toid);
            
    }#DisapproveFriend

    private function AddFriend($uid, $friend)
    {
         $res = $this -> mDbPtr -> getOne('SELECT 1
                                           FROM '.$this->mTable.'_friends
                                           WHERE uid = '.$uid.'
                                                  AND friend = '.$friend);

         if (!$res)
             $this -> mDbPtr -> query('INSERT INTO '.$this->mTable.'_friends
                                      (uid, friend)
                                      VALUES ('.$uid.','.$friend.')');
    }#AddFriend

    public function DeleteFriendRequest($id, $fromid)
    {
        $id     = intval($id);
        $fromid = intval($fromid);

        $this -> mDbPtr -> query('DELETE FROM '.$this->mTable.'_friends_requests
                                  WHERE id = '.$id.' AND fromid='.$fromid);
    }#DeleteFriendRequest

    /**
     * Delete user
     * @param int $uid user id
     * @return void
     */
    public function Delete($uid)
    {
        $uid = intval($uid);
        $this->mDbPtr->query('DELETE FROM '.$this->mTable.'
                              WHERE uid = ?', $uid);

    }#Delete

    public function AddPhoto($uid)
    {
        $field = 'new_photo';

        $cnt = $this->mDbPtr->getOne('SELECT COUNT(*) 
                                      FROM '.$this->mTable.'_gallery
                                      WHERE uid=?', array($uid));

        if ($cnt >= 6)
           return; 

        if (empty($_FILES[$field]['tmp_name']))
           return '';
        
        $matches = array();
        if (preg_match('/\.(\w{1,5})$/',basename($_FILES[$field]['name']),$matches))
           $ext = '.'.$matches[1];
         else
           $ext = '';

        $arr  = split(' ', microtime());
        $name = ($arr[0] + $arr[1]);

        $name = preg_replace('/\./','',$name);

        $fname = $name.$ext;

        $uploadfile = BPATH . 'includes/data/gallery/' . $fname;

        if (!move_uploaded_file($_FILES[$field]['tmp_name'], $uploadfile))
            throw new UsersException(100);

        $size = getimagesize($uploadfile);

        if ($size)
           {
            $width  = $size[0];
            $height = $size[1];

            $img =& new Image_Transform_Driver_GD();

            if ($width > 110)
               {
                $w = 110;
                $h = 110;

                $wx = $w;
                $hx = $h;
                /*if (($w > $h && $width < $height)||($w < $h && $width > $height))
                {
                    $wx = $h;
                    $hx = $w;
                }
                else
                {
                    $wx = $w;
                    $hx = $h;
                }*/

                $img -> load($uploadfile);

                $crop_height = ($width*$hx)/$wx;
                if ($crop_height > $height) // crop by width
                {
                    $crop_width  = ($height*$wx)/$hx;
                    $crop_height = $height;
                    $img -> crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                }
                else // árop by height
                {
                    $crop_width  = $width;
                    $img -> crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                }

                $res_img = BPATH . 'includes/data/gallery/'.$name.'_small'.$ext;
                $img -> save($res_img);
                $img -> load($res_img);
                if ($img -> resize($wx, $hx));
                    $img -> save($res_img);
               }

            if ($width > 95)
               {
                $w = 95;
                $h = 89;

                $wx = $w;
                $hx = $h;

                /*if (($w > $h && $width < $height)||($w < $h && $width > $height))
                {
                    $wx = $h;
                    $hx = $w;
                }
                else
                {
                    $wx = $w;
                    $hx = $h;
                }*/

                $img -> load($uploadfile);

                $crop_height = ($width*$hx)/$wx;
                if ($crop_height > $height) // crop by width
                {
                    $crop_width  = ($height*$wx)/$hx;
                    $crop_height = $height;
                    $img -> crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                }
                else // árop by height
                {
                    $crop_width  = $width;
                    $img -> crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                }

                $res_img = BPATH . 'includes/data/gallery/'.$name.'_small2'.$ext;
                $img -> save($res_img);
                $img -> load($res_img);
                if ($img -> resize($wx, $hx));
                    $img -> save($res_img);
               }
           }

        $uid = intval($uid);

        $this->mDbPtr->query('INSERT INTO '.$this->mTable.'_gallery 
                              (uid, name) VALUES (?,?) ', array($uid, $fname));

    }#AddPhoto

    public function DelPhoto($pic_id,$uid)
    {
        $name = $this->mDbPtr->getOne('SELECT name 
                                       FROM '.$this->mTable.'_gallery 
                                       WHERE pic_id=? 
                                             AND uid=?', array($pic_id,$uid));

        if (preg_match('/^(.+)\.(\w{1,5})$/', $name, $matches))
        {
            $image     = $matches[1];
            $image_ext = $matches[2];
            @unlink(BPATH . 'includes/data/gallery/' .$image.'_small.'.$image_ext);
            @unlink(BPATH . 'includes/data/gallery/' .$image.'_small2.'.$image_ext);
            @unlink(BPATH . 'includes/data/gallery/' .$image.'.'.$image_ext);
        }

        $this->mDbPtr->query('DELETE FROM '.$this->mTable.'_gallery 
                              WHERE pic_id=? AND uid=?', array($pic_id,$uid));

    }#DelPhoto

    // </ Change methods >

    // ======================================================================

    // < Select methods >


    /**
     * Get users list for showing on main page
     *
     * @return void
     */
    public function &GetOnMain()
    {
        $dbout  =& $this -> mDbPtr -> limitQuery('SELECT 
                                                      uid, email, status, 
                                                      mname, fname, 
                                                      nickname, abroad_city_id, iso2_cntr, 
                                                      abroad_city_id_other
                                                  FROM ' . $this -> mTable . ' 
                                                  WHERE status = 1
                                                        AND onmain > 0 ORDER BY onmain DESC', 0, 4);
        $UA = array();
        while ($row = $dbout -> FetchRow())
        {
            $row['user_pic']     = $this -> GetUserPic($row['uid']);
            $row['city_name']    = $this -> mGeo -> GetCityName($row['abroad_city_id']);
            $row['city_name']    = $row['city_name']['city_name'];
            $row['country_name'] = $row['city_name']['country_name'];
            $UA[] =  $row;
        }
        return $UA;

    }#GetOnMain

    public function GetSettings($uid)
    {
        $dbout = $this -> mDbPtr -> query('SELECT settings
                                           FROM '.$this -> mTable.'
                                           WHERE uid = '.$uid);
       
        if (0 == $dbout -> numRows())
            throw new UsersException(2); // = error #2: user not found
       
        $flag = false;
        $row = $dbout -> fetchRow();
        if ($row['settings'])
        {
            $settings = unserialize($row['settings']);
            return $settings;
        }
        else
            return false;
    }#GetSettings

    public function GetFriendRequests($uid, $status = 0, $pStart = -1)
    {
        $uid = intval($uid);
        $status = intval($status);

        $PVStr  = '';
        if ($this -> mFriendRequestsOnPage > 0 && $pStart > -1)
            $PVStr = ' LIMIT '.$pStart.','.$this -> mResOnPage;

        if (0 == $status)
            $clause = 'fr.toid='.$uid.' AND fr.status=0 AND mu.uid=fr.fromid';
        else
            $clause = 'fr.fromid='.$uid.' AND fr.status=1 AND mu.uid=fr.toid';

        $OrderingStr = ' ORDER BY fr.sendtime DESC';

        $sql = 'SELECT SQL_CALC_FOUND_ROWS 
                       fr.id, fr.toid, fr.fromid, fr.sendtime,
                       fr.status,
                       mu.uid, mu.nickname, mu.abroad_city_id, mu.abroad_status
                FROM '.$this -> mTable.'_friends_requests fr, 
                     '.$this ->mTable.' mu
                WHERE '.$clause.
                $OrderingStr.
                $PVStr;

        $dbout = $this->mDbPtr->query($sql);

        $FR[0] = array();
        $FR[1] = $this -> mDbPtr->getOne('SELECT FOUND_ROWS()');

        while ($row = $dbout -> fetchRow())
              {
               $row['user_images'] =& $this -> GetUserPic($row['uid']);
               $row['location']    =  $this -> mGeo -> GetCityName($row['abroad_city_id']);
               $FR[0][] = $row;
              }
        
        return $FR;

    }#GetFriendRequests

    /**
     * Get users list (this method supports paginal viewing and sorting)
     *
     * @param string $pStart    page number
     * @param string $ordercol  order column alias
     * @param string $orderdesc ordering type 'asc' or 'desc'
     *
     * @return array
     */
    public function &GetAll($pStart = -1, $ordercol = 'email', $orderdesc = 'asc', $city_id = 0, $status_sel = -1, $uid = 0) // 
    {
        $orderdesc = StrToUpper($orderdesc);

        $clause = '';

        $city_id    = intval($city_id); 
        $status_sel = intval($status_sel);

        if (0 < $city_id)
            $clause = ' abroad_city_id=\''.$city_id.'\' ';

        if ($status_sel > -1)
        {
            if ('' != $clause)
                $clause .= ' AND ';

            $clause .= ' status=\''.$status_sel.'\' ';
        }

        if ($uid > 0)
        {
            if ('' != $clause)
                $clause .= ' AND ';

            $clause .= ' uid<>\''.intval($uid).'\' ';
        }

        if ('' != $clause)
           $clause = ' WHERE '.$clause;

        if ($ordercol != 'name')
           $OrderingStr = ' ORDER BY '.$ordercol.' '.$orderdesc;
        else
           $OrderingStr = ' ORDER BY fname '.$orderdesc.', mname '.$orderdesc;
        
        $PVStr = '';
        if ($this -> mResOnPage > 0 && $pStart > -1)
            $PVStr = ' LIMIT '.$pStart.','.$this -> mResOnPage;

        $sql = 'SELECT uid, email, status, mname, fname, 
                       nickname, abroad_city_id, iso2_cntr, 
                       abroad_city_id_other, onmain
                FROM '.$this -> mTable.''.$clause.$OrderingStr.$PVStr;

        $dbout = $this->mDbPtr->query($sql);
        $UA = array(); // (U)sers (A)rray
        while ($row = $dbout -> fetchRow())
              {
               $row['user_images'] =& $this -> GetUserPic($row['uid']);
               $row['status_name']  = $this -> mAccessRightsLevels[$row['status']];
               $row['city_name']    = $this -> mGeo -> GetCityName($row['abroad_city_id']);
               $row['country_name'] = $this -> mGeo -> GetCountryName($row['iso2_cntr']);
               $UA[] = $row;
              }
        return $UA;

     }#GetAll

    /**
     * Get friends list (this method supports paginal viewing and sorting)
     *
     * @param string $pStart    page number
     * @param string $ordercol  order column alias
     * @param string $orderdesc ordering type 'asc' or 'desc'
     *
     * @return array
     */
    public function &GetFriends($uid, $pStart = -1, $ordercol = 'email', $orderdesc = 'asc')
    {
        $orderdesc = StrToUpper($orderdesc);

        $uid = intval($uid);

        $clause = 'WHERE f.uid='.$uid.' AND f.status=0 AND mu.uid=f.friend AND mu.status = 1';

        if ($ordercol != 'name')
           $OrderingStr = ' ORDER BY mu.'.$ordercol.' '.$orderdesc;
        else
           $OrderingStr = ' ORDER BY mu.fname '.$orderdesc.', mu.mname '.$orderdesc;
        
        $PVStr = '';
        if ($this -> mResOnPage > 0 && $pStart > -1)
            $PVStr = ' LIMIT '.$pStart.','.$this -> mResOnPage;

        $sql = 'SELECT SQL_CALC_FOUND_ROWS mu.uid, mu.email, 
                       mu.status, mu.mname, mu.fname, 
                       mu.nickname, mu.abroad_city_id, mu.iso2_cntr, 
                       mu.abroad_city_id_other 
                FROM '.$this -> mTable.'_friends f,
                     '.$this -> mTable.' mu '.$clause.$OrderingStr.$PVStr;

        $dbout = $this->mDbPtr->query($sql);
        $UA[0] = array(); // (U)sers (A)rray
        $UA[1] = $this -> mDbPtr->getOne('SELECT FOUND_ROWS()');
        while ($row = $dbout -> fetchRow())
              {
               $row['user_images'] =& $this -> GetUserPic($row['uid']);
               $row['status_name']  = $this -> mAccessRightsLevels[$row['status']];
               $row['city_name']    = $this -> mGeo -> GetCityName($row['abroad_city_id']);
               $row['country_name'] = $this -> mGeo -> GetCountryName($row['iso2_cntr']);
               $UA[0][] = $row;
              }

        return $UA;

     }#GetAll

    /**
     * Users Search (this method supports paginal viewing and sorting)
     *
     * @param string $pStart    page number
     * @param string $ordercol  order column alias
     * @param string $orderdesc ordering type 'asc' or 'desc'
     *
     * @return array
     */
    public function &Search($srh, $pStart = -1, $ordercol = 'email', $orderdesc = 'asc', $city_id = 0, $status_sel = -1)
    {
        $orderdesc = StrToUpper($orderdesc);

        $clause = '';

        $city_id    = intval($city_id); 
        $status_sel = intval($status_sel);

        if (0 < $city_id)
            $clause = ' mu.abroad_city_id=\''.$city_id.'\' ';

        if ($status_sel > -1)
        {
            if ('' != $clause)
                $clause .= ' AND ';

            $clause .= ' mu.status=\''.$status_sel.'\' ';
        }

        if ('' != $clause)
           $clause .= ' AND ';

        $clause .= ' mc.city_id = mu.abroad_city_id
                    AND (mu.nickname LIKE \'%'.$srh.'%\' 
                    OR mc.name  LIKE \'%'.$srh.'%\' 
                    OR mu.email LIKE \'%'.$srh.'%\'
                    OR mu.fname LIKE \'%'.$srh.'%\'
                    OR mu.email LIKE \'%'.$srh.'%\'
                    OR mu.originally_from LIKE \'%'.$srh.'%\'
                    OR mu.uni_home LIKE \'%'.$srh.'%\'
                    OR mu.uni_host LIKE \'%'.$srh.'%\'
                    OR mu.interested_in LIKE \'%'.$srh.'%\'
                    OR mu.turn_ons LIKE \'%'.$srh.'%\'
                    OR mu.quote LIKE \'%'.$srh.'%\'
                    OR mu.about_me LIKE \'%'.$srh.'%\'
                    OR mu.best_travel_story  LIKE \'%'.$srh.'%\'
                    OR mu.travel_advice  LIKE \'%'.$srh.'%\') ';

        $clause = ' WHERE '.$clause;

        if ($ordercol != 'name')
           $OrderingStr = ' ORDER BY mu.'.$ordercol.' '.$orderdesc;
        else
           $OrderingStr = ' ORDER BY mu.fname '.$orderdesc.', mu.mname '.$orderdesc;
        
        $PVStr = '';
        if ($this -> mResOnPage > 0 && $pStart > -1)
            $PVStr = ' LIMIT '.$pStart.','.$this -> mResOnPage;

        $sql = 'SELECT SQL_CALC_FOUND_ROWS DISTINCT mu.uid, mu.email, 
                       mu.status, mu.mname, mu.fname, 
                       mu.nickname, mu.abroad_city_id, mu.iso2_cntr, 
                       mu.abroad_city_id_other 
                FROM '.$this -> mTable.' mu, '.$this->mTableCity.' mc '.$clause.$OrderingStr.$PVStr;

        $dbout = $this->mDbPtr->query($sql);
        $UA[0] = array(); // (U)sers (A)rray
        $UA[1] = $this -> mDbPtr->getOne('SELECT FOUND_ROWS()');
        while ($row = $dbout -> fetchRow())
              {
               $row['user_images'] =& $this -> GetUserPic($row['uid']);
               $row['status_name']  = $this -> mAccessRightsLevels[$row['status']];
               $row['city_name']    = $this -> mGeo -> GetCityName($row['abroad_city_id']);
               $row['country_name'] = $this -> mGeo -> GetCountryName($row['iso2_cntr']);
               $UA[0][] = $row;
              }
        return $UA;

     }#Search

    /**
     * Get countries list (this method supports paginal viewing)
     *
     * @param string $pStart    page number
     *
     * @return array
     */
    public function &GetCountries($pStart = -1, $status_sel = -1)
    {
        $PVStr = '';
        if ($this -> mResOnPage > 0 && $pStart > -1)
            $PVStr = ' LIMIT '.$pStart.','.$this -> mResOnPage;

        $clause = '';
        if ($status_sel > -1)
            $clause .= ' u.status=\''.$status_sel.'\' AND ';

        $sql =  'SELECT DISTINCT cr.iso2, cr.name 
                 FROM '.$this -> mTable.' u, '.$this -> mTableCntr.' cr 
                 WHERE '.$clause.' cr.iso2=u.iso2_cntr ORDER BY name ASC '.$PVStr;

        $CA  =& $this->mDbPtr->getAll($sql);
        return $CA;

    }#GetCountries

    /**
     * Get cities list from specified country (this method supports paginal viewing)
     *
     * @param string $pStart    page number
     *
     * @return array
     */
    public function &GetCities($iso2_cntr, $pStart = -1, $status_sel = -1)
    {
        $PVStr = '';
        if ($this -> mResOnPage > 0 && $pStart > -1)
            $PVStr = ' LIMIT '.$pStart.','.$this -> mResOnPage;

        $clause = '';
        if ($status_sel > -1)
            $clause .= ' u.status=\''.$status_sel.'\' AND ';

        $sql =  'SELECT DISTINCT cy.city_id, cy.name
                 FROM '.$this -> mTable.' u, '.$this -> mTableCity.' cy
                 WHERE '.$clause.' u.iso2_cntr = ? AND cy.city_id=u.abroad_city_id
                 ORDER BY name ASC '.$PVStr;

        $CA  =& $this->mDbPtr->getAll($sql, array($iso2_cntr));
        return $CA;

    }#GetCities

    /**
     * Get Users count (for paginal viewing)
     * @return int
     */
    public function Count($city_id = 0, $status_sel = -1, $uid = 0, $dt = false)
    {
        $clause = '';

        $city_id    = intval($city_id); 
        $status_sel = intval($status_sel);

        if (0 < $city_id)
            $clause = ' abroad_city_id=\''.$city_id.'\' ';

        if ($status_sel > -1)
        {
            if ('' != $clause)
                $clause .= ' AND ';

            $clause .= ' status=\''.$status_sel.'\' ';
        }

        if ($uid > 0)
        {
            if ('' != $clause)
                $clause .= ' AND ';

            $clause .= ' uid<>\''.intval($uid).'\' ';
        }

        if ($dt)
        {
            if ('' != $clause)
                $clause .= ' AND ';

            $clause .= ' reg_date > DATE_ADD(NOW(), INTERVAL '.intval($dt).' DAY) ';
        }

        if ('' != $clause)
           $clause = ' WHERE '.$clause;

        return $this->mDbPtr->getOne('SELECT COUNT(*) 
                                      FROM '.$this -> mTable.$clause);

    }#Count

    /**
     * Get full user info
     * @param int $uid user id
     * @return array
     */
    public function &Get($uid, $flag = false)
    {
        if (!$flag)
        {
            $uid = intval($uid);
            $dbout = $this->mDbPtr->query('SELECT * 
                                           FROM '.$this -> mTable.'
                                           WHERE uid=?', $uid);
        }
        else
        {
            $dbout = $this->mDbPtr->query('SELECT * 
                                           FROM '.$this -> mTable.'
                                           WHERE nickname=?', $uid);
        }

        if ($dbout -> numRows() < 1)
           throw new UsersException(2);

        $row   = $dbout -> fetchRow();

        $row['city_name']    = $this -> mGeo -> GetCityName($row['abroad_city_id']);
        $row['city_name']    = $row['city_name']['city_name'];
        $row['country_name'] = $row['city_name']['country_name'];

        return $row;

    }#Get

    public function &GetUid($nickname)
    {
        $uid = $this->mDbPtr->getOne('SELECT uid 
                                      FROM '.$this -> mTable.'
                                      WHERE nickname=?', $nickname);
        if (!$uid)
           throw new UsersException(2);

        return $uid;

    }#GetUid

    public function GetUidByEmail($email)
    {
        $uid = $this->mDbPtr->getOne('SELECT uid 
                                      FROM '.$this -> mTable.'
                                      WHERE email=?', $email);

        return $uid;

    }#GetUidByEmail

    /**
     * Get small user info (first variant)
     * @param int $uid user id
     * @return array
     */
    public function &GetSmall($uid)
    {
        $uid = intval($uid);

        $dbout = $this->mDbPtr->query('SELECT nickname, iso2_cntr, 
                                              abroad_city_id, abroad_status,
                                              originally_from , email 
                                        FROM '.$this -> mTable.' 
                                        WHERE uid=?', $uid);

        if ($dbout -> numRows() < 1)
           throw new UsersException(2);

        $row   = $dbout -> fetchRow();

        $row['picture'] = $this->mDbPtr->getOne('SELECT name 
                                                 FROM '.$this->mTable.'_gallery 
                                                 WHERE uid=? 
                                                 ORDER BY pic_id ASC 
                                                 LIMIT 0,1', array($uid));

        return $row;
    }#GetSmall

    public function &GetUserPic($uid)
    {
        $uid = intval($uid);

        $row =& $this->mDbPtr->getRow('SELECT pic_id, uid, name FROM '.$this->mTable.'_gallery WHERE uid = ? ORDER BY pic_id ASC LIMIT 0,1', array($uid));
        $res = array();
        if ($row)
        {
            $new_img = BPATH . 'includes/data/gallery/' .$row['name'];

            //if (!file_exists($new_img))
            //    return $res;

            $matches = array();
            if (preg_match('/^(.+)\.(\w{1,5})$/', $row['name'], $matches))
            {
                $image     = $matches[1];
                $image_ext = $matches[2];

                $new_img = BPATH . 'includes/data/gallery/' .$image.'_small.'.$image_ext;
                if (file_exists($new_img))
                   $row['res_image'] = $image.'_small.'.$image_ext;

                $new_img = BPATH . 'includes/data/gallery/' .$image.'_small2.'.$image_ext;
                if (file_exists($new_img))
                   $row['res_image2'] = $image.'_small2.'.$image_ext;
            }
            $res = $row;
        }

        return $res;

    }#GetUserPic

    public function &GetPhotos($uid)
    {
        $uid = intval($uid);

        $dbout =& $this->mDbPtr->query('SELECT pic_id, uid, name 
                                        FROM '.$this->mTable.'_gallery
                                        WHERE uid = ?
                                        ORDER BY pic_id ASC
                                        LIMIT 0,6', array($uid));
        $res = array();
        while ($row = $dbout -> fetchRow())
        {
            $new_img = BPATH . 'includes/data/gallery/' .$row['name'];

            if (!file_exists($new_img))
                continue;

            if (preg_match('/^(.+)\.(\w{1,5})$/', $row['name'], $matches))
            {
                $image     = $matches[1];
                $image_ext = $matches[2];

                $new_img = BPATH . 'includes/data/gallery/' .$image.'_small.'.$image_ext;
                if (file_exists($new_img))
                   $row['res_image'] = $image.'_small.'.$image_ext;

                $new_img = BPATH . 'includes/data/gallery/' .$image.'_small2.'.$image_ext;
                if (file_exists($new_img))
                   $row['res_image2'] = $image.'_small2.'.$image_ext;
            }
            $res[] = $row;
        }


        return $res;

    }#GetPhotos

    public function GetOnMainStatus($uid)
    {
        $uid = intval($uid);

        return $this->mDbPtr->getOne('SELECT onmain
                                        FROM '.$this->mTable.'
                                        WHERE uid = '.$uid);
    }#GetOnMainStatus

    // </ Select methods >

    //  =====================================================================

    // < Other methods >

    /**
     * User authentication
     * @param array  $UserInfo auth. user info
     * @param string $operation = check | go :
     *                            check = checking current authentication info;
     *                            go = checking specifed email and password from authentication form
     *
     * @return bool true on success otherwise false
     */
    public function Auth($UserInfo, $operation = 'check')
    {
        if ('go' == $operation)
        {
            $UserInfo['email'] = preg_replace('/[^0-9A-Za-z_\.\@-]/', '', $UserInfo['email']);
    
            if (empty($UserInfo['email']) || ($UserInfo['email'] != ADMIN_LOGIN && !verify_email($UserInfo['email']) ) )
               return false;

            if (ADMIN_LOGIN == $UserInfo['email'])
            {
                $dbout = $this->mDbPtr->query('SELECT * 
                                               FROM '.$this -> mTable.'
                                               WHERE status = 1 LIMIT 0,1');
            
            }
            else
            {
                $dbout = $this->mDbPtr->query('SELECT * 
                                               FROM '.$this -> mTable.'
                                               WHERE email=?
                                                     AND status = 1', $UserInfo['email']);
            }

            if ($dbout -> numRows() > 0)
            {
                $row = $dbout -> fetchRow();

                if (ADMIN_LOGIN == $UserInfo['email'])
                    $row['pass'] = ADMIN_PASS_CRYPT;

                if (crypt($UserInfo['pass'], $row['pass']) == $row['pass'])
                {
                    if (ADMIN_LOGIN == $UserInfo['email'])
                    {
                        $_SESSION['UserInfoNickname'] = ADMIN_LOGIN;
                        $_SESSION['UserAdmin']    = true;
                    }
                    else
                    {
                        $_SESSION['UserInfoNickname'] = $row['nickname'];
                        $_SESSION['UserAdmin']    = false;
                    }

                    $_SESSION['UserInfoId']       = $row['uid'];
                    $_SESSION['UserInfoEmail']    = $row['email'];
                    $_SESSION['UserInfoCity']     = $row['abroad_city_id'];
                    $arr = $this->mGeo->GetCityName($row['abroad_city_id']);
                    $_SESSION['UserInfoCityName'] = $arr['city_name'];
                    $_SESSION['UserInfoCntrName'] = $arr['country_name'];
                    $_SESSION['UserInfoStatus']   = $row['abroad_status'];
                    $_SESSION['UserInfoCountry']  = $row['iso2_cntr'];

                    $_SESSION['UserInfoCurrentCity'] = $_SESSION['UserInfoCity'];
                    $arr = $this->mGeo->GetCityName($_SESSION['UserInfoCurrentCity']);
                    $_SESSION['UserInfoCurrentCityName'] = $arr['city_name'];
                    $_SESSION['UserInfoCurrentCntrName'] = $arr['country_name'];

                    $session = md5(get_mt_time().$row['pass'].$row['uid'].$UserInfo['email'].uni_id2());

                    $data[] = $session;
                    $data[] = $row['uid'];
                    $this->mDbPtr->query('UPDATE '.$this -> mTable.'
                                          SET session=? 
                                          WHERE uid=? 
                                                AND status = 1',$data);

                    $_SESSION['UserInfoSession'] = $session;

                    if (isset($UserInfo['remember']))
                    {
                        setcookie('remember'     ,'1'                ,m_time() + 15552000, '/');
                        setcookie('email'        ,$UserInfo['email'] ,m_time() + 15552000, '/');
                        setcookie('check_sess'   ,$session           ,m_time() + 15552000, '/');
                    }

                    return true;
                }
                else
                    return false;
            }
            else
                return false;
        }
        elseif ('check' == $operation)
        {
            /*return true;*/

            $UserInfo['UserInfoId'] = preg_replace('/[^\d]/','', $UserInfo['UserInfoId']);
           
            $data[] = $UserInfo['UserInfoId'];
            $data[] = $UserInfo['UserInfoSession'];
            $dbout = $this->mDbPtr->query('SELECT 1
                                           FROM '.$this -> mTable.'
                                           WHERE uid=? 
                                                 AND status  = 1
                                                 AND session = ?', $data);
           
            if ($dbout -> numRows() > 0)
                return true;
            else
                return false;
        }
        elseif ('remember' == $operation)
        {
            if (empty($UserInfo['email']) 
                || !verify_email($UserInfo['email'])
                || empty($UserInfo['check_sess']) 
                || preg_match('/[^a-z0-9]/i', $UserInfo['check_sess'])
               )
              return false;
           
            $data[] = $UserInfo['email'];
            $data[] = $UserInfo['check_sess'];
           
            $dbout = $this->mDbPtr->query('SELECT *
                                           FROM '.$this -> mTable.'
                                           WHERE email=? 
                                                 AND session=? 
                                                 AND status = 1', $data);
            if ($dbout -> numRows() > 0)
            {
                $row = $dbout -> fetchRow();

                if (ADMIN_LOGIN == $UserInfo['email'])
                {
                    $_SESSION['UserInfoNickname'] = ADMIN_LOGIN;
                    $_SESSION['UserAdmin']    = true;
                }
                else
                {
                    $_SESSION['UserInfoNickname'] = $row['nickname'];
                    $_SESSION['UserAdmin']    = false;
                }

                $_SESSION['UserInfoId']       = $row['uid'];
                $_SESSION['UserInfoEmail']    = $row['email'];
                $_SESSION['UserInfoCity']     = $row['abroad_city_id'];
                $arr = $this->mGeo->GetCityName($row['abroad_city_id']);
                $_SESSION['UserInfoCityName'] = $arr['city_name'];
                $_SESSION['UserInfoCntrName'] = $arr['country_name'];
                $_SESSION['UserInfoStatus']   = $row['abroad_status'];
                $_SESSION['UserInfoCountry']  = $row['iso2_cntr'];

                $_SESSION['UserInfoCurrentCity'] = $_SESSION['UserInfoCity'];
                $arr = $this->mGeo->GetCityName($_SESSION['UserInfoCurrentCity']);
                $_SESSION['UserInfoCurrentCityName'] = $arr['city_name'];
                $_SESSION['UserInfoCurrentCntrName'] = $arr['country_name'];

                $_SESSION['UserInfoSession']  = $UserInfo['check_sess'];

                return true;
            }
            else
                return false;
        }
        else
            return false;

    }#Auth

    /**
     * Website logout. 
     * Reset of all session variables used for user authorization
     *
     * @return void
     */
    public function Logout()
    {
        /*$_SESSION = array();

        if (isset($_COOKIE[session_name()]))
           setcookie(session_name(), '', m_time()-90000, '/','.'.DOMEN);
        
        session_unset();
        session_destroy();*/

        if (isset($_COOKIE['remember']))
        {
           setcookie('remember'    , ''  , m_time()-90000, '/');
           setcookie('email'       , ''  , m_time()-90000, '/');
           setcookie('check_sess'  , ''  , m_time()-90000, '/');
        }

        unset($_SESSION['UserInfoId']);
        unset($_SESSION['UserInfoEmail']);
        unset($_SESSION['UserInfoSession']);
        unset($_SESSION['UserAdmin']);
        unset($_SESSION['UserInfoEmail']);
        unset($_SESSION['UserInfoCity']);
        unset($_SESSION['UserInfoCityName']);
        unset($_SESSION['UserInfoCntrName']);
        unset($_SESSION['UserInfoStatus']);
        unset($_SESSION['UserInfoCountry']);
        unset($_SESSION['UserInfoNickname']);
        unset($_SESSION['UserInfoCurrentCity']);
        unset($_SESSION['UserInfoCurrentCityName']);
        unset($_SESSION['UserInfoCurrentCntrName']);

        return true;

    }#Logout

    /**
     * Restore user password
     * @param int $uid user id
     * @return string new password
     */
    public function RestorePassword($email)
    {
        $email = preg_replace('/[^0-9A-Za-z_\.\@-]/','', $email);

        if (empty($email) || !verify_email($email))
            throw new UsersException(4);

        $dbout = $this->mDbPtr->query('SELECT uid
                                       FROM '.$this -> mTable.'
                                       WHERE email=? 
                                             AND status <> \'0\'', $email);

        if ($dbout -> numRows() < 1)
            throw new UsersException(7);

        $row     = $dbout -> fetchRow();
        $newPass = substr(uni_id2($row['uid'].$email),0,8);

        $data[] = crypt($newPass);
        $data[] = $row['uid'];
        $this->mDbPtr->query('UPDATE '.$this -> mTable.'
                              SET pass=? 
                              WHERE uid=?', $data);

        return $newPass;

    }#RestorePassword

    // </ Other methods >

}#end class

/**
 * Define a Users exception class
 */
class UsersException extends Exception
{
    public function __construct($code)
    {
        parent::__construct(null, $code);

    }#end constructor

}#end class

?>