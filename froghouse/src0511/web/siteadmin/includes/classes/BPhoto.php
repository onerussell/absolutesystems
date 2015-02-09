<?php
/**
 * Base information class
 *
 * @package    engine37 Catalog v3.0
 * @version    0.3b
 * @since      22.03.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */

class BPhoto
{
    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;    #PEAR::DB pointer
    private $mTtable;   #table with texts
    private $mLink;     #page link

    public function __construct($dbPtr, $ttable = 'photo', $mlink = '')
    {
        $this -> mDbPtr  = $dbPtr;
        $this -> mTtable = $ttable;
        $this -> mLink   = $mlink;
    }#end constructor


#***************************************************
#    Edit methods
#***************************************************
    /**
    * Add and Update photo in dB
    * @param array $ar with values
    * @param int $id - page id for Update (if Update)
    * @return bool true
    */
    public function Add($ar)
    {
        $st = '<p><br><a><b><i><a>';
        if ( !isset($ar['id']) || $ar['id'] == 0 || !is_numeric($ar['id']) )
        {
            if (!isset($ar['pdate']))
            {
                $ar['pdate'] = mktime();
            }
            $sql  =  'INSERT INTO '.$this -> mTtable.' SET
                      uid      = "'.$ar['uid'].'",
                      title    = "'.strip_tags(addslashes($ar['title']), $st).'",
                      image    = "'.$ar['image'].'",
                      cached   = "'.$ar['cached'].'",
                      pdate    = "'.$ar['pdate'].'"';
        }
        else
        {
            if (!isset($ar['pdatee']))
            {
                $ar['pdatee'] = mktime();
            }
            $sql  =  'UPDATE '.$this -> mTtable.' SET
                      uid      = "'.$ar['uid'].'",
                      title    = "'.strip_tags(addslashes($ar['title']), $st).'",
                      pdatee   = "'.$ar['pdatee'].'"';
            if (isset($ar['pdate']))
            {
                $sql .= ', pdate = "'.$ar['pdate'].'"';
            }

            $sql .= ' WHERE id = "'.$ar['id'].'"';
        }
        $this -> mDbPtr -> query($sql);

        return true;
    }#Add


    /**
    * Delete photo from dB
    *
    * @param int $id - page ID
    * @return bool true
    */
    function Del($id = 0)
    {
        if ($id == 0 || !is_numeric($id))
        {
            global $gSmarty;
            throw new Exception($gSmarty -> _config[0]['vars']['errdel'].' [id = '.$id.']');
        }
        $inf =& $this -> GetInfo($id);
        if (isset($inf['image']))
        {
            #delete image from imagecategory and cache
            if (file_exists(DIR_WS_IMAGE . '/' . $inf['image']))
                @unlink(DIR_WS_IMAGE . '/' . $inf['image']);
            if (file_exists(DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $inf['image']))
                @unlink(DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $inf['image']);
        }

        $sql = 'DELETE FROM '.$this -> mTtable.' WHERE id = "'.$id.'"';

        $this -> mDbPtr -> query($sql);
        return true;

    }#Del


    /**
    * Update photo activity
    *
    * @param int $id  - page ID
    * @return bool - only true
    */
    public function Active($id = 0)
    {
        if (!is_numeric($id))
            $id = 0;

        $sql = 'UPDATE '.$this -> mTtable.' set active = NOT active WHERE id = "'.$id.'"';

        $this -> mDbPtr -> query($sql);

        return true;
    }#ActivePage


#***************************************************
#    Select methods
#***************************************************


    /**
    * Get photo List for User (by UID field)
    *
    * @param int $uid     - User ID
    * @param int $active  - if 1 - show only active elements, if 0 - show all
    * @param string $sort - sort output by this field (default: "pdate DESC")
    * @param int $first   - start for output limit
    * @param int $cnt     - count of output values
    * @return array - hash with values
    */
    function &GetList($uid = 0, $active = 1, $sort = '', $first = 0, $cnt = 0)
    {
        if (!is_numeric($uid) || $uid == 0)
            return array();


        $sql = 'SELECT id, title, image, cached, pdate, pdatee, active
                FROM '.$this -> mTtable.'
                WHERE uid = "'.$uid.'"';
        if ($active == 1)
            $sql .= ' AND active = 1';
        if (trim($sort) == '')
            $sort = ' ORDER BY pdate DESC';
        else
            $sort = ' ORDER BY ' . $sort;
        $sql.= $sort;

        if ($cnt > 0)
            $db =& $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
        else
            $db =& $this -> mDbPtr -> query($sql);

        $link = $this -> mLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';

        $res = array();
        while ($row = $db -> fetchRow())
        {
            $row['title']     = stripslashes($row['title']);
            $row['pdate']     = date("l dS", $row["pdate"]).' of '. date("F Y h:i A", $row["pdate"]);   #date("l dS of F Y h:i A", $row["pdate"]);
            $row['pdatee']    = date("l dS", $row["pdatee"]).' of '. date("F Y h:i A", $row["pdatee"]); #date("l dS of F Y h:i A", $row["pdatee"]);#last edit date
            $row['link']      = $link.'mid='.$row['id'];
            $row['link_add']  = $link.'mid='.$row['id'].'&action=addcom';
            $res[]            = $row;
        }
        return $res;

    }#GetList


    /**
    * Get count of photo for User (by UID field)
    *
    * @param int $uid     - User ID
    * @param int $active  - if 1 - select only active elements, if 0 - select all
    * @return int - count of products
    */
    public function &GetCount($uid = 0, $active = 1)
    {
        if ( !is_numeric($uid) || $uid == 0 ) return 0;

        $sql = 'SELECT COUNT(id) AS pc FROM '.$this -> mTtable.' WHERE uid = "'.$uid.'"';
        if ($active == 1)
            $sql .= ' AND active = 1';

        $db  =& $this -> mDbPtr -> query($sql);
        $row =  $db -> fetchRow();
        return  $row['pc'];

    }#GetCount


    /**
    * Get photo for User by Page ID
    *
    * @param int $id - page id
    * @return array - hash with product values
    */
    public function &GetInfo($id = 0, $uid = 0, $wouser = 0)
    {

        if ($wouser == 0)
        {
            $sql = 'SELECT id, title, image, cached, pdate, pdatee, active, uid
                    FROM ' . $this -> mTtable . ' WHERE id = "'.$id.'" AND uid = "'.$uid.'"';
        }
        else
        {
            $sql = 'SELECT id, title, image, cached, pdate, pdatee, active, uid
                    FROM ' . $this -> mTtable . ' WHERE id = "'.$id.'"';
        }

        $db  =& $this -> mDbPtr -> query($sql);

        if ($db -> numRows() == 0)
        {
            $r = array();
            return $r;
        }

        $link = $this -> mLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';

        $row              = $db -> fetchRow();
        $row['title']     = stripslashes($row['title']);

        $row['pdate']     = date("l dS", $row["pdate"]).' of '. date("F Y h:i A", $row["pdate"]);   #date("l dS of F Y h:i A", $row["pdate"]);
        $row['pdatee']    = date("l dS", $row["pdatee"]).' of '. date("F Y h:i A", $row["pdatee"]); #date("l dS of F Y h:i A", $row["pdatee"]);#last edit date


        if ($wouser == 0)
        {
            $row['link']      = $link.'mid='.$row['id'];
            $row['link_del']  = $link.'mid='.$row['id'].'&action=del';
        }
        else
        {
            $row['link']      = $link.'mid='.$row['id'].'&uid='.$row['uid'];
        }
        return $row;

    }#GetInfo


    #*******************************************
    #                   Search
    #*******************************************
    /**
    * Prepare data for search
    *
    * @param string $sstr   - search request
    * @param string $stype  - search type
    * @return true only
    */
    public function PrepSearch($sstr = '', $stype = 'or')
    {
        $this -> mStype = $stype;        #type
        $this -> mSstr  = trim($sstr);   #search string
        $this -> StrToAr();              #prepare search array

    }#PrepSearch


    /**
    * Prepare search array - explode search string
    *
    * @param void
    * @return array with field list
    */
    private function StrToAr()
    {
        $res  = array();
        if ($this->mSstr <> '')
        {
            $res = explode(' ', $this -> mSstr);
            for ($i = 0; $i < count($res); $i++)
                $res[$i] = addslashes(trim($res[$i]));
        }
        $this -> mSar = $res;
        return $res;
    }# StrToAr


    /**
    * prepare search list for select query
    *
    * @param array $sf - array with fields for search
    * @return string with field list
    */
    private function FormSQ($sf = array())
    {
        $st = '';
        if ($this -> mStype == 'all')
        {
            for ($j = 0; $j < count($sf); $j++)
            {
                $st.='(';
                for ($j = 0; $j < count($sf); $j++)
                {
                    if ($j > 0)
                    {
                        $st .= ' '.'or'.' ';
                    }
                    $st .= $sf[$j] . ' like "%" "' . $this -> mSstr . '" "%"';
                }
                $st .= ')';
            }
        }
        else
        {
            for ($i=0; $i < count($this -> mSar); $i++)
            {
                if ($st <> '')
                    $st.=' '.$this -> mStype.' ';
                $st.='(';
                for ($j = 0; $j < count($sf); $j++)
                {
                    if ($j > 0)
                        $st .= ' '.'or'.' ';
                    $st .= $sf[$j] . ' like "%" "' . $this -> mSar[$i] . '" "%"';
                }
                $st .= ')';
            }
        }

        $st = '('.$st.')';
        #echo $st;
        return $st;

    }#Form


    /**
    * Search results count
    *
    * @param void
    * @return int CNT
    */
    public function &SearchCnt()
    {

        $st  = $this -> FormSQ(array('title'));
        $sql = 'select count(distinct(id)) as pc
                from '.$this -> mTtable.'
                where '.$st.' and active = 1';

        $db   =& $this -> mDbPtr -> query($sql);
        $row =  $db -> fetchRow();
        return  $row['pc'];

    }#SearchCnt


    /**
    * Search pages
    *
    * @param void
    * @return array - hash with products values and product count value
    */
    public function &Search($first = 0, $cnt = 0)
    {

        $st  = $this -> FormSQ(array('title'));
        $sql = 'select distinct(id)
                from '.$this -> mTtable.'
                where '.$st.' and active = 1';

        if ($cnt == 0)
        {
            $db   =& $this -> mDbPtr -> query($sql);
        }
        else
        {
            $db =& $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
        }

        $res = array();
        while ($row = $db -> fetchRow())
        {
            $res[]  = $this -> GetInfo($row['id'], 0, 1);
        }

        return $res;
    }#Search


}#BPhoto