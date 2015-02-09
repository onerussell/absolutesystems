<?php
/**
 * Base comments class
 *
 * @package    cogs
 * @version    0.3b
 * @since      22.03.2006
 * @copyright  2004-2008 engine37.com
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
    private $mStable;   #table with screens
    private $mLink;     #page link

    public function __construct($dbPtr, $ctable = 'comments', $mlink = '')
    {
        $this -> mDbPtr  = $dbPtr;
        $this -> mCtable = $ctable;
        $this -> mStable = 'cat3_screens';

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
            $br = array(
                        $ar['uid'],
                        $ar['ustatus'],
                        $ar['mid'],
                        strip_tags(addslashes($ar['title']), $st),
                        strip_tags(addslashes($ar['descr']), $st),
                        $ar['internal'],
                        $ar['attach']
                       );
            $sql  =  'INSERT INTO '.$this -> mCtable.' (uid, ustatus, mid, title, descr, internal, attach, pdate) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, '.mktime().')';
            $this -> mDbPtr -> query($sql, $br);
            $ar['id'] = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
        }
        else
        {
            $br = array(
                       strip_tags(addslashes($ar['title']), $st),
                       strip_tags(addslashes($ar['descr']), $st),
                       $ar['internal'],
                       $ar['id']
                       );
            $sql  =  'UPDATE '.$this -> mCtable.' SET
                      title    = ?,
                      descr    = ?,
                      internal = ?,
                      pdatee   = '.mktime().
                      ' WHERE id = ?';
            $this -> mDbPtr -> query($sql, $br);          
        }
        return $ar['id'];
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
            return false;
        }

        if ($id > 0)
        {
            $sql = 'DELETE FROM '.$this -> mCtable.' WHERE id = '.(int)$id;
        }
        else
        {
            $sql = 'DELETE FROM '.$this -> mCtable.' WHERE mid = '.(int)$mid;
        }
        $this -> mDbPtr -> query($sql);
        return true;

    }#DelComment

    
    public function DeleteAttach($id)
    {
    	$sql = 'SELECT attach FROM '.$this -> mCtable.' WHERE id = ?';
    	$at  = $this -> mDbPtr -> getOne($sql, array($id));
    	if (!empty($at))
    	{
            $fn = DIR_WS_IMAGE . '/' . $at;
            if (file_exists($fn))
            {
            	unlink( $fn );      
            }
    		$sql = 'UPDATE '.$this -> mCtable.' SET attach = "" WHERE id = ?';
    		$this -> mDbPtr -> query($sql, $id);
    	}
    	return true;
    }/** DeleteAttach */
    
    
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

    
    public function AproveComment($id, $ustatus)
    {
    	$sql = 'UPDATE '.$this -> mCtable.' SET ustatus = ? WHERE id = ?';
    	$this -> mDbPtr -> query($sql, array($ustatus, $id));
    }#AproveComment
    
#***************************************************
#    Select methods
#***************************************************


    /**
    * Get Comments List for screen (MID)
    *
    * @param int $mid     - Screen ID
    * @param int $active  - if 1 - show only active elements, if 0 - show all
    * @param string $sort - sort output by this field (default: "pdate DESC")
    * @param int $first   - start for output limit
    * @param int $cnt     - count of output values
    * @return array - hash with values
    */
    function &GetCommentList($users_table, $mid = 0, $active = 1, $ustatus = array(), $internal = -1, $sort = '', $first = 0, $cnt = 0)
    {

        $sql = 'SELECT c.*, u.name, u.lname, u.login, u.image, u.status
                FROM '.$this -> mCtable.' c
                LEFT JOIN '.$users_table.' u ON (u.uid = c.uid AND u.active = 1)
                WHERE c.mid = ?';
        if ($active == 1)
            $sql .= ' AND c.active = 1';
            
        if (!empty($ustatus))
        {
        	$t = '';
        	foreach ($ustatus as $k => &$v)
        	{
        		$t .= ($t ? ' OR ' : '') . ' c.ustatus = '.$v;
        	}
        	if ($t)
        	{
        		$sql .= ' AND ('.$t.')';
        	}
        }
        if (-1 != $internal)    
        {
        	$sql .= ' AND c.internal = '.(int)$internal;
        }
        if (trim($sort) == '')
            $sort = ' ORDER BY c.pdate ASC';
        else
            $sort = ' ORDER BY ' . $sort;
        $sql.= $sort;

        if ($cnt > 0)
            $db =& $this -> mDbPtr -> limitQuery($sql, $first, $cnt, array($mid));
        else
            $db =& $this -> mDbPtr -> query($sql, array($mid));


        $res = array();
        while ($row = $db -> fetchRow())
        {
            $row['title']     = stripslashes($row['title']);
            $row['descr']     = stripslashes($row['descr']);
            $row['pdate']     = date("l dS", $row["pdate"]).' of '. date("F Y h:i A", $row["pdate"]);   #date("l dS of F Y h:i A", $row["pdate"]);
            $row['pdatee']    = date("l dS", $row["pdatee"]).' of '. date("F Y h:i A", $row["pdatee"]); #date("l dS of F Y h:i A", $row["pdatee"]);#last edit date
            $res[]            = $row;
        }
        return $res;

    }#GetCommentList

    
    
    /**
    * Get count of comments for Screen (by MID field)
    *
    * @param int $mid     - Screen ID
    * @param int $active  - if 1 - select only active elements, if 0 - select all
    * @return int - count of products
    */
    public function &GetCommentCount($mid = 0, $active = 1)
    {
        if ( !is_numeric($mid) || $mid == 0 ) return 0;

        $sql = 'SELECT COUNT(id) FROM '.$this -> mCtable.' WHERE mid = ?';

        if ($activeactive == 1)
            $sql .= ' AND active = 1';

        $r  =& $this -> mDbPtr -> getOne($sql, array($mid));
        return  $r;

    }#GetCommentCount



    /*
    * Get comment by Comment ID
    *
    * @param int $id - comment id
    * @return array - hash with product values
    */
    public function &GetCommentInfo($id = 0)
    {
        $sql = 'SELECT comment.*, screen.image FROM ' . $this -> mCtable . ' AS comment,'. $this -> mStable. ' AS screen WHERE comment.id = ? AND comment.mid = screen.id';

        $db  =& $this -> mDbPtr -> query($sql, $id);

        $row = array();

        $row = $db -> fetchRow();

        $row['title'] = stripslashes($row['title']);
        $row['descr'] = stripslashes($row['descr']);
        $row['pdate'] = date("l dS", $row["pdate"]).' of '. date("F Y h:i A", $row["pdate"]);   #date("l dS of F Y h:i A", $row["pdate"]);
        $row['pdatee'] = date("l dS", $row["pdatee"]).' of '. date("F Y h:i A", $row["pdatee"]); #date("l dS of F Y h:i A", $row["pdatee"]);#last edit date
        $row['image'] = stripslashes($row['image']);

        return $row;

    }#GetCommentInfo



}#BComment