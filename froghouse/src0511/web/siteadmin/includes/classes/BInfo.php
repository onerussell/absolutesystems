<?php
/**
 * Second Base information class
 *
 * @package    engine37 Catalog v3.0
 * @version    0.3b
 * @since      22.03.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */

class BInfo
{
    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;    #PEAR::DB pointer
    private $mTtable;   #table with texts
    private $mAtable;   #table with additional values
    private $mLink;     #page link
    private $mAdiField; #Additional fields list

    private $mBlock;    #Page block (if we use one table for 2 and more blocks)

    public function __construct($dbPtr, $ttable = 'texts', $mlink = '', $atable = '', $block = 0)
    {
        $this -> mDbPtr  = $dbPtr;
        $this -> mTtable = $ttable;
        $this -> mAtable = $atable;
        $this -> mLink   = $mlink;
        $this -> mBlock  = $block;
    }#end constructor


#***************************************************
#    Edit methods
#***************************************************

    /**
    * Set mLink field
    * @param string $mlink
    * @return true
    */
    public function SetLink($mlink)
    {
        $this -> mLink   = $mlink;
        return true;
    }#SetLink


    /**
    * Add and Update text page in dB
    * @param array $ar with values
    * @return element ID
    */
    public function AddPage($ar, $image = '', $cached = 0)
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
                      cityid   = "'.$ar['cityid'].'",
                      title    = "'.strip_tags(addslashes($ar['title']), $st).'",
                      descr    = "'.strip_tags(addslashes($ar['descr']), $st).'",
                      pdate    = "'.$ar['pdate'].'",
                      block    = "'.$this -> mBlock.'",
                      rate     = "'.$ar['rate'].'",
                      ratec    = 1
                      ';
            $this -> mDbPtr -> query($sql);

            $sql     = "SELECT LAST_INSERT_ID()";
            $ar['id'] = $this -> mDbPtr -> getOne($sql);
        }
        else
        {
            if (!isset($ar['pdatee']))
            {
                $ar['pdatee'] = mktime();
            }
            $sql  =  'UPDATE '.$this -> mTtable.' SET
                      title    = "'.strip_tags(addslashes($ar['title']), $st).'",
                      descr    = "'.strip_tags(addslashes($ar['descr']), $st).'",
                      rate     = "'.$ar['rate'].'",
                      pdatee   = "'.$ar['pdatee'].'"';
            if (isset($ar['pdate']))
            {
                $sql .= ', pdate = "'.$ar['pdate'].'"';
            }

            $sql .= ' WHERE id = "'.$ar['id'].'"';
            $this -> mDbPtr -> query($sql);
        }
        #image
        if ($image <> '')
        {
            $this -> DelImage($ar['id']);
            $sql = 'UPDATE '.$this -> mTtable.' SET image = "'.$image.'", cached = "'.$cached.'" WHERE id = "'.$ar['id'].'"';
            $this -> mDbPtr -> query($sql);
        }
        #additional fields
        $this -> AddAdi($ar);

        return $ar['id'];
    }#AddPage

    /**
    * Update Page Rating
    * @param int id - page ID
    * @param int rate - one page rate
    * @return true (if all ok) or false
    */
    public function UpdRate($id = 0, $rate = 0, $zn = 0)
    {
        if ($id == 0 || $rate == 0)
            return false;

        $sql = 'SELECT rate, ratec FROM '.$this -> mTtable.' WHERE id = "'.$id.'"';
        $db  = $this -> mDbPtr -> query($sql);
        if ($row = $db -> FetchRow())
        {
            if ($zn == 0)
            {
                $rx  = ($row['rate'] * $row['ratec'] + $rate) / ($row['ratec'] + 1);
                $sql = 'UPDATE '.$this -> mTtable.' SET rate = "'.floor($rx).'", ratec = ratec + 1 WHERE id = "'.$id.'"';
                $this -> mDbPtr -> query($sql);
            }
            else
            {
                if ($row['ratec'] > 1)
                {
                    $rx  = ($row['rate'] * $row['ratec'] - $rate) / ($row['ratec'] - 1);
                    $sql = 'UPDATE '.$this -> mTtable.' SET rate = "'.floor($rx).'", ratec = ratec - 1 WHERE id = "'.$id.'"';
                    $this -> mDbPtr -> query($sql);
                }
            }

            return true;
        }
        else
            return false;

    }#UpdRate

    /**
    * Delete texts from dB
    *
    * @param int $id - page ID
    * @return bool true
    */
    function DelPage($id = 0)
    {
        if ($id == 0 || !is_numeric($id))
        {
            global $gSmarty;
            throw new Exception($gSmarty -> _config[0]['vars']['errdel'].' [id = '.$id.']');
        }
        $this -> DelImage($id);
        $sql  =  'DELETE FROM '.$this -> mTtable.' WHERE id = "'.$id.'"';

        $this -> mDbPtr -> query($sql);

        #additional fields
        $this -> DelAdi($id);

        return true;

    }#DelPage


    /**
    * Delete image for page
    *
    * @param int $id - page ID
    * @return bool - true if delete else false
    */
    public function DelImage($id = 0)
    {
        if (!is_numeric($id) || $id == 0)
            return false;

        $sql = 'SELECT image FROM '.$this -> mTtable.' WHERE id = "'.$id.'"';

        $db =& $this -> mDbPtr -> query($sql);
        if ($db -> numRows() > 0)
        {
            $row = $db -> fetchRow();
            #delete image from imagecategory and cache
            if (file_exists(DIR_WS_IMAGE . '/' . $row['image']))
                @unlink(DIR_WS_IMAGE . '/' . $row['image']);
            if (file_exists(DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $row['image']))
                @unlink(DIR_WS_IMAGE . '/' . DIR_NAME_IMAGECACHE . '/' . $row['image']);

            #delete from DB
            $sql = 'UPDATE  '.$this -> mTtable.' SET image = "", cached = "0" WHERE id = "'.$id.'"';
            $this -> mDbPtr -> query($sql);
            return true;
        }
        else
            return false;

    }#DelImage


    /**
    * Update text activity
    *
    * @param int $id  - page ID
    * @return bool - only true
    */
    public function ActivePage($id = 0)
    {
        if (!is_numeric($id))
            $id = 0;

        $sql = 'UPDATE '.$this -> mTtable.' set active = NOT active WHERE id = "'.$id.'"';

        $this -> mDbPtr -> query($sql);

        return true;
    }#ActivePage

    /**
    * Set Page block
    * @param int block
    * @return bool true
    */
    public function SetPageBlock($block = 0)
    {
        $this -> mBlock = $block;
    }#SetPageBlock

#***************************************************
#    Select methods
#***************************************************


    /**
    * Get Pages List for User (by CITY ID field)
    *
    * @param int $cityid     - City ID
    * @param int $active  - if 1 - show only active elements, if 0 - show all
    * @param string $sort - sort output by this field (default: "pdate DESC")
    * @param int $first   - start for output limit
    * @param int $cnt     - count of output values
    * @return array - hash with values
    */
    function &GetPageList($cityid = 0, $active = 1, $sort = '', $first = 0, $cnt = 0, $psort = '1a')
    {
        if (!is_numeric($cityid) || $cityid == 0)
            return array();

        $sql = 'SELECT id, uid, cityid, title, descr, pdate, pdatee, active, rate, ratec
                FROM '.$this -> mTtable.'
                WHERE cityid = "'.$cityid.'" AND block = "'.$this -> mBlock.'"
                ';
        if ($active == 1)
            $sql .= ' AND active = 1';

        switch ($psort)
        {
            case '1a': $psort = 'pdate DESC'; break;
            case '1b': $psort = 'pdate ASC';  break;
            case '2a': $psort = 'rate  DESC'; break;
            case '2b': $psort = 'rate  ASC';  break;
            case '3a': $psort = 'title DESC'; break;
            case '3b': $psort = 'title ASC';  break;
            default  : $psort = 'pdate DESC'; break;
        }
        $sql .= ' ORDER BY ' . $psort;

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
            $row['descr']     = stripslashes($row['descr']);
            $row['pdate']     = date("l dS", $row["pdate"]).' of '. date("F Y h:i A", $row["pdate"]);   #date("l dS of F Y h:i A", $row["pdate"]);
            $row['pdatee']    = date("l dS", $row["pdatee"]).' of '. date("F Y h:i A", $row["pdatee"]); #date("l dS of F Y h:i A", $row["pdatee"]);#last edit date
            $row['link']      = $link.'mid='.$row['id'];
            $row['link_del']  = $link.'mid='.$row['id'].'&action=del';
            $res[]            = $row;
        }
        return $res;

    }#GetPageList


    /**
    * Get count of pages  for User (by CITY ID field)
    *
    * @param int $cityid     - City ID
    * @param int $active  - if 1 - select only active elements, if 0 - select all
    * @return int - count of products
    */
    public function &GetPageCount($cityid = 0, $active = 1)
    {
        if ( !is_numeric($cityid) || $cityid == 0 ) return 0;

        $sql = 'SELECT COUNT(id) AS pc FROM '.$this -> mTtable.' WHERE cityid = "'.$cityid.'" AND block = "'.$this -> mBlock.'"';
        if ($active == 1)
            $sql .= ' AND active = 1';

        $db  =& $this -> mDbPtr -> query($sql);
        $row =  $db -> fetchRow();
        return  $row['pc'];

    }#GetPageCount

    public function GetPageCountDt($cityid = 0, $active = 1, $dt = 604800)
    {
        if ( !is_numeric($cityid) || $cityid == 0 )
           return 0;

        $sql = 'SELECT COUNT(*) FROM '.$this -> mTtable.' WHERE cityid = "'.$cityid.'"' ;
        if ($active == 1)
            $sql .= ' AND active = 1';

        $sql .= ' AND pdate > '.(m_time() - 604800);

        return $this -> mDbPtr -> getOne($sql);

    }#GetPageCount

    /**
    * Get page for User by Page ID
    *
    * @param int $id - page id
    * @param int $cityid - city id
    * @return array - hash with product values
    */
    public function &GetPageInfo($id = 0, $cityid = 0, $wocity = 0)
    {

        if ($wocity == 0)
        {
            $sql = 'SELECT id, title, descr, pdate, pdatee, active, uid, cityid, image, cached, rate, ratec, block
                    FROM ' . $this -> mTtable . ' WHERE id = "'.$id.'" AND cityid = "'.$cityid.'"';
        }
        else
        {
            $sql = 'SELECT id, title, descr, pdate, pdatee, active, uid, cityid, image, cached, rate, ratec, block
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
        $row['descr']     = stripslashes($row['descr']);
        $row['pdate']     = date("l dS", $row["pdate"]).' of '. date("F Y h:i A", $row["pdate"]);   #date("l dS of F Y h:i A", $row["pdate"]);
        $row['pdatee']    = date("l dS", $row["pdatee"]).' of '. date("F Y h:i A", $row["pdatee"]); #date("l dS of F Y h:i A", $row["pdatee"]);#last edit date

        if ($wocity == 0)
        {
            $row['link']      = $link.'mid='.$row['id'];
            $row['link_del']  = $link.'mid='.$row['id'].'&action=del';
        }
        else
        {
            global $ptypes;
            foreach ($ptypes as $key => $value)
            {
                if ($value['id'] == $row['block'])
                {
                    $bl = $key;
                }
            }
            $row['link']      = $link.'mid='.$row['id'].'&block='.$bl.'&city_id='.$row['cityid'];
        }
        $row['adi']       = $this -> GetAdi($id);
        return $row;

    }#GetPageInfo



#***************************************************
#    Additional Fields
#***************************************************

    /**
    * Set additional fields array
    *
    * @param array $ar - array with fields
    * @return true only
    */
    public function SetAdi($ar = array())
    {
        #array format
        # $ar = array(
        #                array('id' => 0, 'name' => 'Price', 'type' => 'text'),
        #                array('id' => 1, 'name' => 'Music', 'type' => 'select', 'vals' => array(0 => '1', 1 => '2', 2 => '3'))
        #            );

        $this -> mAdiField = $ar;
        return true;
    }#SetAdi


    /**
    * Get additional fields array
    *
    * @return array with values
    */
    public function GetAdiFld($ar = array())
    {
        return $this -> mAdiField;
    }#GetAdiFld

    /**
    * Add and Update additional  fields in dB
    * @param array $ar with values
    * @return bool true
    */
    public function AddAdi($ar)
    {
        if (count($this -> mAdiField) == 0 || !isset($ar['id']))
            return true;

        $this -> DelAdi($ar['id']);

        for ($i = 0; $i < count($this -> mAdiField); $i++)
        {
            if (isset($ar['fld' . $this -> mAdiField[$i]['id']]))
            {
                $sql = 'INSERT INTO ' . $this -> mAtable .' SET
                        mid = "'.$ar['id'].'", fid = "'.$this -> mAdiField[$i]['id'].'",
                        val = "'.addslashes($ar['fld' . $this -> mAdiField[$i]['id']]).'"';
                #echo $sql;
                $this -> mDbPtr -> query($sql);
            }
        }
        #die;
        return true;
    }#AddAdi

    /**
    * Delete additional fields for page
    *
    * @param int $id - page id
    * @return true or false
    */
    public function DelAdi($id = 0)
    {
        if (count($this -> mAdiField) == 0 || !is_numeric($id) || $id == 0)
            return false;

        $sql = 'DELETE FROM ' . $this -> mAtable .' WHERE mid = "'.$id.'"';
        #echo $sql;die;
        $db  =& $this -> mDbPtr -> query($sql);
        return true;
    }#DelAdi


    /**
    * Get additional fields
    *
    * @param int $id - page id
    * @return array - hash with values
    */
    public function GetAdi($id  = 0)
    {
        $res = array();
        if (count($this -> mAdiField) == 0 || !is_numeric($id) || $id == 0)
            return true;

        $sql = 'SELECT fid, val FROM ' . $this -> mAtable .' WHERE mid = "'.$id.'" ORDER BY fid';
        $db  =& $this -> mDbPtr -> query($sql);
        while ($row = $db -> FetchRow())
        {
            $res[] = array('id'   => $row['fid'],
                           'name' => $this -> mAdiField[$row['fid']]['name'],
                           'val'  => stripslashes($row['val']));
        }
        return $res;
    }#GetAdi


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

        $st  = $this -> FormSQ(array('title', 'descr'));
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

        $st  = $this -> FormSQ(array('title', 'descr'));
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
            $res[]  = $this -> GetPageInfo($row['id'], 0, 1);
        }

        return $res;
    }#Search


}#Btext