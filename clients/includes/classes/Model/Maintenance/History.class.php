<?php
/**
 * History class
 * 
 * @package    Engine 37 catalog 3.1
 * @version    1.0
 * @since      24.10.2006
 * @copyright  2006 Engine 37 Team
 * @link       http://Engine 37.com
 */
class Model_Maintenance_History
{
    /**
     * PEAR::DB
     * @var DB_common
     */
    private $mDbPtr;

    
    /**
     * Time offset
     * @var int
     */
    private $mTimeOffset;

    /**
     * History table
     * @var string
     */
    private $mTableH;

    /**
     * Show table
     *
     * @var string
     */
    private $mTbView;
    
    /**
     * Projects table
     *
     * @var string
     */
    private $mTbProject;
    
    
    public function __construct(&$glObj, 
                                $tableH = 'history', 
                                $tbView = 'history_view', 
                                $tbProject = 'project', 
                                $timeOffset = 0)
    {
        $this -> mDbPtr      =& $glObj['db'];
        $this -> mTableH     =  $tableH;
        $this -> mTbView     =  $tbView;
        $this -> mTbProject  =  $tbProject; 
        $this -> mPages      =& $glObj['page'];
    }



    /**
     * Delete message from history
     * @param int $log_id record id
     * @return void
     */
    public function DeleteRecord($log_id)
    {
        $log_id = intval($log_id);
        $this->mDbPtr->query('DELETE FROM '.$this->mTableH.' 
                              WHERE log_id = ?', $log_id);

    }


    /**
     *Add new message to history
     *
     * @param string $action action, for example 'Delete'
     * @param string $what   for example 'user'
     * @param int $uid - user ID
     * @param string $uname - username
     * @param int $project_id - project ID (for project history)
     * @param int $internal - `1` for internal messages (else `0`) 
     * @param int $screen_id - screen ID (for screen history)
     *
     * @return void
     */
    public function Add($action, $what, $uid, $uname, $ustatus, $project_id = 0, $internal = 0, $screen_id = 0, $comment_id = 0)
    {
        /** Add to History */
    	$data = array($action, 
                      $what, 
                      getenv('REMOTE_ADDR'), 
                      $uid, 
                      $uname,
                      $ustatus,
                      $project_id,
                      $internal, 
                      $screen_id,
                      $comment_id
                      );

        $this -> mDbPtr -> query('INSERT INTO '.$this->mTableH.'
                             (action,what, pdate, ip, uid, uname, ustatus, project_id, internal, screen_id, comment_id) 
                              VALUES (?, ?, '.mktime().', ?, ?, ?, ?, ?, ?, ?, ?)', $data);
								
//								$fl = fopen('files/data/tt.txt', 'w');
//	                            fputs($fl, print_r($this -> mDbPtr , 1)."\n");
//	                            fclose($fl);
								
		$sql = "SELECT LAST_INSERT_ID()";
		$history_id = $this -> mDbPtr -> getOne($sql); 
        return $history_id;		
    }/* Add */

 
    /**
     * Get Messages 
     *
     * @param int $project_id - array of the projects ID, `-1` for all projects  
     * @param int $internal - `-1` - get all, 0 - get public, 1 - get internal 
     * @param int $first - first message (for pagging)
     * @param int $cnt - count of the messages (for pagging)
     */
    public function GetList($projects = -1, $internal = -1, $first = 0, $cnt = 0, $uid = 0, $act = 0, $ustatus = 0)
    {


    	$sql = 'SELECT h.*, p.name AS pname, v.view
	   	        FROM '.$this -> mTableH.' h 
	  	        LEFT JOIN '.$this -> mTbView.' v ON (v.hid = h.log_id AND v.uid = '.$uid.')   
    	        LEFT JOIN '.$this -> mTbProject.' p ON (h.project_id > 0 AND h.project_id = p.id)
    	        WHERE h.log_id = h.log_id


    	        ';

    	$sql = 'SELECT h.*, v.*
	   	        FROM '.$this -> mTbView.' v 
    	        LEFT JOIN '.$this -> mTableH.' h ON (h.log_id = v.hid AND 
h.uid=v.uid)
    	        WHERE h.uid ='.$uid.'


    	        ';


$sql ='
 SELECT DISTINCT h.* , v.view, v.cid
FROM '.$this -> mTableH.' AS h
LEFT JOIN '.$this -> mTbView.' AS v ON (h.log_id = v.hid AND v.uid = '.$uid.') WHERE 1=1';


    	$sql = 'SELECT h.*, p.name AS pname, v.view , v.cid 
    	        FROM '.$this -> mTableH.' h 
    	        LEFT JOIN '.$this -> mTbView.' v ON (v.hid = h.log_id AND v.uid = '.$uid.') 
    	        LEFT JOIN '.$this -> mTbProject.' p ON (h.project_id > 0 AND h.project_id = p.id)
    	        WHERE h.log_id = h.log_id
    	        ';




    	if (is_array($projects))
    	{
    		$st = '';
    		foreach ($projects as $k => &$v)
    		{
    			$st .= (!$st ? '' : ' OR ').'h.project_id='.(int)$v;
    		}
    		if ($st)
    		{
    			$sql .= ' AND ('.$st.')';
    		} 		
    	}

       	if ($act)
    	{
    		switch ($act)
    		{
    			case 1:
    				$sql .= ' AND h.action = "Upload Screen"';
    			break;

    			case 2:
    				$sql .= ' AND h.action = "Add Comment"';
    			break;

    			case 3: 
    				$sql .= ' AND h.action = "Approve Screen"';
    			break;	
    		}
    	}

    	if ($ustatus)
    	{
    		switch ($ustatus)
    		{
    			case 1:
    				//in 
    				$sql .= ' AND h.ustatus = 1';
    			break;

    			case 2:
    				//out
    				$sql .= ' AND h.ustatus <> 1';
    			break;	
    		}
    	}
    	
    	if (-1 != $internal)
    	{
    		$sql .= ' AND h.internal = '.(int)$internal;
    	}
    	$sql .= ' ORDER BY h.pdate DESC';

    	if ($cnt)
    	{
    		$db = $this -> mDbPtr -> limitQuery($sql, $first, $cnt);
    	}
    	else 
    	{
    		$db = $this -> mDbPtr -> query($sql);
    	}
    	$r = array();
    	while ($row = $db -> FetchRow())
    	{
    	    //TODO:вынксти в smarty plugin ... презентационная логика
    		if ($row['pdate'] > mktime(0, 0, 0, date("m"), date("d"), date("Y")))
    		{
    		    $row['pdate'] = 'Today, '.date('h:i a', $row['pdate']);
    		}
    		else
    		{
    			$row['pdate'] = date('D, F d,  Y h:i a', $row['pdate']);
    		}

    		$row['what']  = (!empty($row['pname']) ? '['.stripslashes($row['pname']).'] ' : '') . stripslashes($row['what']);
    		$row['uname'] = stripslashes($row['uname']);

    	    if ('Add Comment' == $row['action'])
            {
            	$st = substr($row['what'], strpos($row['what'], '#com_')+5, strlen($row['what']));
            	$st = substr($st, 0, strpos($st, '"'));
            	$row['commentid'] = $st;
            	//$row['what'] = str_replace('">', '" '.'onmouseover="ajax_showTooltip(\''.PATH_ROOT.'comment.php?idc='.$st.'\',this);return false" onmouseout="ajax_hideTooltip()"'.'>', $row['what']);
//            	error_log(var_export($row,true));
            }


    		$r[] = $row;
    	}

    	return $r;
    }/** GetList **/
    
    
    public function GetCount($projects = -1, $internal = -1, $act = 0, $ustatus = 0)
    {
    	$sql = 'SELECT COUNT(log_id) FROM '.$this -> mTableH.' WHERE log_id = log_id';
        
    	if ($act)
    	{
    		switch ($act)
    		{
    			case 1:
    				$sql .= ' AND action = "Upload Screen"';
    			break;

    			case 2:
    				$sql .= ' AND action = "Add Comment"';
    			break;

    			case 3: 
    				$sql .= ' AND action = "Approve Screen"';
    			break;	
    		}
    	}
    	
    	if (is_array($projects))
    	{
    		$st = '';
    		foreach ($projects as $k => &$v)
    		{
    			$st .= (!$st ? '' : ' OR ').'project_id='.(int)$v;
    		}
    		if ($st)
    		{
    			$sql .= ' AND ('.$st.')';
    		} 		
    	}
    	
        
    	if ($ustatus)
    	{
    		switch ($ustatus)
    		{
    			case 1:
    				//in 
    				$sql .= ' AND ustatus = 1';
    			break;

    			case 2:
    				//out
    				$sql .= ' AND ustatus <> 1';
    			break;	
    		}
    	}
    	    	
    	if (-1 != $internal)
    	{
    		$sql .= ' AND internal = '.(int)$internal;
    	}
    	

    	$c = $this -> mDbPtr -> getOne($sql);
    	return $c;
    }/** GetCount **/
    

    /**
     * Clear all history
     * @return void
     */
    public function DeleteAll()
    {
        $this->mDbPtr->query('TRUNCATE '.$this->mTableH);

    }

    
    /**
     * Delete approve status from history (update screen_id to 0)
     *
     * @param unknown_type $screen_id
     * @return bool true
     */
    public function DelApproveStatus($screen_id)
    {
    	$sql = 'UPDATE '.$this -> mTableH.' SET screen_id = 0 WHERE screen_id = ?';
    	$this -> mDbPtr -> query($sql, $screen_id);
    	return true;
    }#DelApproveStatus
    
    
    public function AproveComment($comment_id)
    {
     	$sql = 'UPDATE '.$this -> mTableH.' SET comment_id = 0 WHERE comment_id = ?';
    	$this -> mDbPtr -> query($sql, $comment_id);
    	return true;   	
    }/** AproveComment */
    
    
    /**
     * Add item to View History table
     *
     * @param int $uid - user ID
     * @param int $hid - history ID
     * @param int $cid - commentary ID
     * @param int $sid - screen ID
     * @param int $pid - project ID
     * @param int $internal - history internal status
     * @return true
     */
    public function AddView($uid, $hid, $cid, $sid = 0, $pid = 0, $internal = 0)
    {
		global $gUser, $gPg;
		
		$al =& $gUser -> GetUserList(1, 0);
        if (!empty($pid))
        {
           	$ol =& $gPg -> GetProjectUsers($pid);
        } 
        $ua = array($uid);
        		

    	foreach ($al as $k => $v)
    	{
            if (!in_array($v['uid'], $ua))
            {
            	$sql  = 'INSERT INTO '.$this -> mTbView.' (uid, hid, cid, sid, pid) VALUES(?, ?, ?, ?, ?)';
                $this -> mDbPtr -> query($sql, array($v['uid'], $hid, $cid, $sid, $pid));
                $ua[] = $v['uid'];
            }    
		}

		if (!empty($ol))
		{
            foreach ($ol as $k => $v)
    	    {
    	        if (1 == $internal && 1 == $v['status'])
            	{
            	   	continue;
            	}
            	
    	    	if (!in_array($v['uid'], $ua))
                {
                	$sql = 'INSERT INTO '.$this -> mTbView.' (uid, hid, cid, sid, pid) VALUES(?, ?, ?, ?, ?)';
                    $this -> mDbPtr -> query($sql, array($v['uid'], $hid, $cid, $sid, $pid));
                    $ua[] = $v['uid'];
                }    
		    }		
		}   	
    	
        
        return true; 	 
    }/** AddView */
    
    
    /**
     * Update View table
     *
     * @param int $uid
     * @param int $hid
     * @param int $cid
     * @param int $sid
     * @param int $pid
     * @return true
     */
    public function UpdView($uid = 0, $hid = 0, $cid, $sid = 0, $pid = 0)
    {
        
    	#$sql  = 'UPDATE '.$this -> mTbView.' SET view = 0 WHERE uid = ?';
        $sql  = 'DELETE FROM '.$this -> mTbView.' WHERE uid = ?'; 
    	$va[] = $uid;

        if ($hid)
        {
        	$sql .= ' AND hid = ?';
        	$va[] = $hid;
        }

        if ($sid)
        {
        	$sql .= ' AND sid = ?';
        	$va[] = $sid;
        }

        if ($cid)
        {
        	$sql .= ' AND cid = ?';
        	$va[] = $cid;
        }
                
        if ($pid)
        {
        	$sql .= ' AND pid = ?';
        	$va[] = $pid;
        }        
        $this -> mDbPtr -> query($sql, $va);
        return true;       
    }/** UpdView */
    
}
?>