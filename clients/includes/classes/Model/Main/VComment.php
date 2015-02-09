<?php
/**
 * Visual comments
 *
 * @package    5Dev Catalog v3.0
 * @version    0.3b
 * @since      22.03.2006
 * @copyright  2004-2006 5Dev.com
 * @link       http://5dev.com
 */

class Visual_Comments_Model
{
    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;    #PEAR::DB pointer
    private $mCtable;   #table with comments
	private $mUtable;   #table with users
	
    public function __construct($dbPtr, $ctable = 'vcomments', $utable = 'admin_users')
    {
        $this -> mDbPtr  = $dbPtr;
        $this -> mCtable = $ctable;
        $this -> mUtable = $utable;
    }#end constructor	
	
    
#***************************************************
#    Edit methods
#***************************************************

    /**
     * Save comments
     *
     * @param int $rev - revision ID
     * @param string $val - comment text
     * @param int $id - comment ID (0 - for add, numeric - for edit)
     * @return bool true
     */
    public function SaveComments($rev, $val, $uid, $id = 0)
    {
    	if (!$id)
    	{
    		$sql = 'INSERT INTO '.$this -> mCtable.' (rev, val, uid, pdate) VALUES(?, ?, ?, ?)';
    		$this -> mDbPtr -> query($sql, array($rev, $val, $uid, mktime()));
    		$id  = $this -> mDbPtr -> getOne('SELECT LAST_INSERT_ID()');
    		
    	}
    	else
    	{
    		$sql = 'UPDATE '.$this -> mCtable.' SET val = ?, pdate = ? WHERE id = ? AND rev = ?';
    		$this -> mDbPtr -> query($sql, array($val, mktime(), $id, $rev));
    	}
    	return $id;
    }/** SaveComments */
    
    
    /**
     * Get comments list for revision
     *
     * @param int $rev - revision ID
     * @return array with comments ID
     */
    public function GetList($rev)
    {
    	$sql = 'SELECT c.id, c.pdate, u.image FROM '.$this -> mCtable.' c 
    	        LEFT JOIN '.$this -> mUtable.' u ON u.uid = c.uid  
    	        WHERE c.rev = ?';
    	$db  = $this -> mDbPtr -> query($sql, array($rev));
    	$r   = array();
    	while ($row = $db -> FetchRow())
    	{
    		$row['date']  = date("M j", $row['pdate']);
    		$row['time']  = date("h:i A", $row['pdate']);
    		
    		$r[] = $row;
    	}
    	return $r;
    }/** GetList */
    

    public function GetComment($id)
    {
        $sql = 'SELECT * FROM '.$this -> mCtable.' WHERE id = ?';
        $db  = $this -> mDbPtr -> query($sql, array($id));
        $r   = array();
        if 	($row = $db -> FetchRow())
        {
        	$r = $row;
        }
        return $r;
    }/** GetComment */
    
    

}/** Visual_Comments_Model */
?>