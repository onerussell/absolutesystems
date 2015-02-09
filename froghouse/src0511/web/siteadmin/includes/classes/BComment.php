<?php
/**
 * Base comments class
 *
 * @package    engine37 Catalog v3.0
 * @version    0.3b
 * @since      22.03.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */

class BComment
{
    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;    #PEAR::DB pointer
    private $mCtable;   #table with comments
    private $mLink;     #page link

    public function __construct($dbPtr, $ctable = 'comments', $mlink = '')
    {
        $this -> mDbPtr  = $dbPtr;
        $this -> mCtable = $ctable;
        $this -> mLink   = $mlink;
    }#end constructor


    /**
    * Set Link method
    * @param string $link
    * @return bool true
    */
    function SetLink($link = '')
    {
        $this-> mLink = $link;

    }#SetLink


#***************************************************
#    Edit methods
#***************************************************
    /**
    * Add and Update comments in dB
    * @param array $ar with values
    * @param int $id - comment id for Update (if Update)
    * @return bool true
    */
    public function AddComment($ar)
    {

        $st = '<p><br><a><b><i><a>';
        if ( !isset($ar['id']) || $ar['id'] == 0 || !is_numeric($ar['id']) )
        {
            if (!isset($ar['pdate']))
            {
                $ar['pdate'] = mktime();
            }
            $sql  =  'INSERT INTO '.$this -> mCtable.' SET
                      uid      = "'.$ar['uid'].'",
                      mid      = "'.$ar['mid'].'",
                      title    = "'.strip_tags(addslashes($ar['title']), $st).'",
                      descr    = "'.strip_tags(addslashes($ar['descr']), $st).'",
                      pdate    = "'.$ar['pdate'].'"';
            if (isset($ar['rate']))
            {
                $sql .= ', rate = "'.$ar['rate'].'"';
            }
        }
        else
        {

            if (!isset($ar['pdatee']))
            {
                $ar['pdatee'] = mktime();
            }
            $sql  =  'UPDATE '.$this -> mCtable.' SET
                      uid      = "'.$ar['uid'].'",
                      mid      = "'.$ar['mid'].'",
                      title    = "'.strip_tags(addslashes($ar['title']), $st).'",
                      descr    = "'.strip_tags(addslashes($ar['descr']), $st).'",
                      pdatee   = "'.$ar['pdatee'].'"';

            if (isset($ar['rate']))
            {
                $sql .= ', rate = "'.$ar['rate'].'"';
            }
            if (isset($ar['pdate']))
            {
                $sql .= ', pdate = "'.$ar['pdate'].'"';
            }

            $sql .= ' WHERE id = "'.$ar['id'].'"';
        }
        $this -> mDbPtr -> query($sql);

        return true;
    }#AddComment


    /**
    * Delete comments from dB (without "check UID" !!!)
    *
    * @param int $id - comment ID
    * @param int $mid - message ID. If (id == 0 && mid <> 0) - delete all comments for message
    * @return bool true
    */
    function DelComment($id = 0, $mid = 0)
    {
        if (($id == 0 || !is_numeric($id)) && ($mid == 0 || !is_numeric($mid)))
        {
            global $gSmarty;
            throw new Exception($gSmarty -> _config[0]['vars']['errdel'].' [id = '.$id.', mid = '.$mid.']');
        }

        if ($id > 0)
            $sql = 'DELETE FROM '.$this -> mCtable.' WHERE id = "'.$id.'"';
        else
            $sql = 'DELETE FROM '.$this -> mCtable.' WHERE mid = "'.$mid.'"';
        $this -> mDbPtr -> query($sql);
        return true;

    }#DelComment

    /**
    * Update text activity
    *
    * @param int $id  - page ID
    * @return bool - only true
    */
    public function ActiveComment($id = 0)
    {
        if (!is_numeric($id))
            $id = 0;

        $sql = 'UPDATE '.$this -> mCtable.' set active = NOT active WHERE id = "'.$id.'"';

        $this -> mDbPtr -> query($sql);

        return true;
    }#ActiveComment

#***************************************************
#    Select methods
#***************************************************


    /**
    * Get Comments List for Message (MID)
    *
    * @param int $mid     - Message ID
    * @param int $active  - if 1 - show only active elements, if 0 - show all
    * @param string $sort - sort output by this field (default: "pdate DESC")
    * @param int $first   - start for output limit
    * @param int $cnt     - count of output values
    * @return array - hash with values
    */
    function &GetCommentList($mid = 0, $active = 1, $sort = '', $first = 0, $cnt = 0)
    {
        if (!is_numeric($mid) || $mid == 0)
            return array();


        $sql = 'SELECT id, uid, mid, title, descr, pdate, pdatee, rate
                FROM '.$this -> mCtable.'
                WHERE mid = "'.$mid.'"';
        if ($active == 1)
            $sql .= ' AND active = 1';
        if (trim($sort) == '')
            $sort = ' ORDER BY pdate ASC';
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
            $row['descr']     = stripslashes($row['descr']);
            $row['pdate']     = date("l dS", $row["pdate"]).' of '. date("F Y h:i A", $row["pdate"]);   #date("l dS of F Y h:i A", $row["pdate"]);
            $row['pdatee']    = date("l dS", $row["pdatee"]).' of '. date("F Y h:i A", $row["pdatee"]); #date("l dS of F Y h:i A", $row["pdatee"]);#last edit date

            $row['link']      = $link.'id='.$row['id'];
            $row['link_del']  = $link.'id='.$row['id'].'&action=del_com';
                $row['link_ed']   = $link.'id='.$row['id'].'&action=edit_com';
            $res[]            = $row;
        }
        return $res;

    }#GetCommentList


    /**
    * Get count of comments for Message (by MID field)
    *
    * @param int $mid     - Message ID
    * @param int $active  - if 1 - select only active elements, if 0 - select all
    * @return int - count of products
    */
    public function &GetCommentCount($mid = 0, $active = 1)
    {
        if ( !is_numeric($mid) || $mid == 0 ) return 0;

        $sql = 'SELECT COUNT(id) AS pc FROM '.$this -> mCtable.' WHERE mid = "'.$mid.'"';

        if ($active == 1)
            $sql .= ' AND active = 1';

        $db  =& $this -> mDbPtr -> query($sql);
        $row =  $db -> fetchRow();
        return  $row['pc'];

    }#GetCommentCount


    /**
    * Get comment by Comment ID
    *
    * @param int $id - comment id
    * @return array - hash with product values
    */
    public function &GetCommentInfo($id = 0)
    {
        $sql = 'SELECT id, title, descr, pdate, pdatee, active, uid, rate
                FROM ' . $this -> mCtable . ' WHERE id = "'.$id.'"';

        $db  =& $this -> mDbPtr -> query($sql);

        if ($db -> numRows() == 0)
        {
            return false;
            #global $gSmarty;
            #throw new Exception($gSmarty -> _config[0]['vars']['errnfound'].' [id = '.$id.']');
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
        $row['link']      = $link.'id='.$row['id'];
        $row['link_del']  = $link.'id='.$row['id'].'&action=del_com';
        return $row;

    }#GetPageInfo



}#BComment