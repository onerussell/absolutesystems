<?php
/**
 * Projects Class
 * @package   engine37 catalog 3.2
 * @version   0.1
 * @since     29.04.2006
 * @copyright 2004-2007 engine37 Team
 * @author    ssergy
 * @link      http://engine37.com
*/

class Project_Model
{
    /**
     * Projects table
     *
     * @var string
     */
    private $mTbProj;
    
    /**
     * Project users table
     *
     * @var string
     */
    private $mTbProjUsers;
    
    /**
     * Users table
     *
     * @var string
     */
    private $mTbUsers;
    
    /**
     * Screens table
     *
     * @var string
     */
    private $mTbScreens;        
    
    /**
     * Prev image (for some functions)
     */
    private $mPrevImage = '';
    
    
    /**
     * Database pointer
     *
     */
    private $mdbPtr;
        
    public function __construct(&$gDb, $table)
    {
        $this -> mTbProj      = $table['projects'];
        $this -> mTbProjUsers = $table['project_users'];
        $this -> mTbUsers     = $table['users'];
        $this -> mTbScreens   = $table['screens'];
        $this -> mdbPtr       =& $gDb; 
    } 

    #*******************************************************
    #   Projects
    #*******************************************************      
    public function EditProject($ar, $id = 0)
    {
    	if (!$id)
    	{
    		$sql = 'INSERT INTO '.$this -> mTbProj.'(name, pdate, last_upd) VALUES(?, '.mktime().', '.mktime().')';
    		$this -> mdbPtr -> query($sql, $ar);
    		$sql = 'SELECT LAST_INSERT_ID()';
            $id  = $this -> mdbPtr -> getOne($sql);
            return $id;
    	}
    	else 
    	{
    		$ar[] = $id;
    		$sql = 'UPDATE '.$this -> mTbProj.' SET
    		        name  = ?,
    		        active = ?
    		        WHERE id = ?
    		       ';

    		$this -> mdbPtr -> query($sql, $ar);
    		return $id;
    	} 	
    }#EditProject
    
    
    public function DeleteProject($id)
    {
        //delete users
    	$this -> DelAllProjUsers($id);
        
    	//delete project info
    	//$sql = 'DELETE FROM '.$this -> mTbProj.' WHERE id = ?';
    	$sql = 'UPDATE  '.$this -> mTbProj.' SET deleted = 1 WHERE id = ?';
        $this -> mdbPtr -> query($sql, $id);	
    	
        return true;
    }#DeleteProject
    
    
    /**
     * Change project active status
     *
     * @param int $id - project ID
     * @param int $active - project active (0 - not active || 1 - active)     
     * 
     */
    public function ChgActive($id, $active)
    {
    	$sql = 'UPDATE '.$this -> mTbProj.' SET active = ? WHERE id = ?';
    	$this -> mdbPtr -> query($sql, array($active, $id));
    	return true;
    }#ChgActive
    
    
    public function &GetProject($id)
    {
    	$sql = 'SELECT * FROM '.$this -> mTbProj.' WHERE id = ? AND deleted = 0';
    	$db  = $this -> mdbPtr -> query($sql, array($id));
    	if ($row = $db -> FetchRow())
    	{
    		$row['name']  = stripslashes($row['name']);
    		$row['link']  = ''.strtolower(strtr($row['name'], array(' ' => '_'))); 
    		return $row;
    	}
    	else 
    	{
    		$r = array();
    		return $r;
    	}
    }#GetProject

    
    public function &GetProjectsList($status = 1)
    {
        if (0 == $status) $addon ='';
        if (1 == $status) $addon ='AND active = 1';
        if (2 == $status) $addon ='AND active = 2';

    	$sql = 'SELECT *, id AS project_id FROM '.$this -> mTbProj.' WHERE deleted = 0 '.$addon.' ORDER BY last_upd desc';

    	$db  = $this -> mdbPtr -> query($sql, array());
    	$r   = array();
    	while ($row = $db -> FetchRow())
    	{
    		$row['name']     = stripslashes($row['name']);
    		$row['link']     = ''.strtolower(strtr($row['name'], array(' ' => '_'))); 

    		//TODO - вынести код в смарти плагин...зашита презентационная логика
    		if ($row['last_upd'] > mktime(0, 0, 0, date("m"), date("d"), date("Y")))
    		{
    		    $row['last_upd'] = 'Today, '.date('h:i a', $row['last_upd']);
    		}
    		elseif ($row['last_upd'] > mktime(0, 0, 0, date("m"), date("d") -1, date("Y")))
    		{
    		    $row['last_upd'] = 'Yesterday, '.date('h:i a', $row['last_upd']);
    		}
            else
    		{
				$last_upd_days = (mktime(0, 0, 0, date("m"), date("d"), date("Y")) - $row['last_upd'])/60/60/24;
    			$row['last_upd'] = round($last_upd_days).' day(s) ago | '.date('D, F d,  Y h:i a', $row['last_upd']);
    		}

    		$r[] = $row;
    	}    	
    	return $r;
    }#GetProjectsList
    
    
    
    #*******************************************************
    #   Project Users
    #*******************************************************   
    
    public function AddProjToUser($project_id, $uid)
    {
    	$sql = 'SELECT 1 FROM '.$this -> mTbProjUsers.' WHERE project_id = ? AND uid = ?';
    	$r   = $this -> mdbPtr -> getOne($sql, array($project_id, $uid));
    	if (!$r)
    	{
    		$sql = 'INSERT INTO '.$this -> mTbProjUsers.' (project_id, uid) VALUES(?, ?)';
    		$this -> mdbPtr -> query($sql, array($project_id, $uid));
    		return true;
    	}
    	else 
    	{
    		return false;
    	}
    }#AddProjToUser
    
    
    public function DelProjFromUser($project_id, $uid)
    {
    	$sql = 'DELETE FROM '.$this -> mTbProjUsers.' WHERE project_id = ? AND uid = ?';
    	$this -> mdbPtr -> query($sql, array($project_id, $uid));
    	return true;
    }#DelProjFromUser
    
    
    public function DelAllProjUsers($project_id)
    {
    	$sql = 'DELETE FROM '.$this -> mTbProjUsers.' WHERE project_id = ?';
        $this -> mdbPtr -> query($sql, array($project_id));
    	return true;
    }#DelAllProjUsers
    
    
    /**
     * Get all user project
     *
     * @param int $uid - User ID
     * @return array with projects
     */
    public function GetUserProjects($uid, $lowinfo = 0)
    {
    	$sql = 'SELECT pu.*, p.name, p.image, p.last_upd FROM '.$this -> mTbProjUsers.' pu, '.$this -> mTbProj.' p
    	        WHERE pu.project_id = p.id AND p.deleted = 0 AND pu.uid = ?
    	        '; 
    	$db  = $this -> mdbPtr -> query($sql, array($uid));
    	$r   = array();
    	while ($row = $db -> FetchRow())
    	{
    		$row['name']     = stripslashes($row['name']);
    		$row['link']     = ''.strtolower(strtr($row['name'], array(' ' => '_')));
    		$row['last_upd'] = (0 < $row['last_upd']) ? date('D, M d,  Y h:i a', $row['last_upd']): '';
    		if ($lowinfo)
    		{
    		    $r[$row['project_id']] = $row['name'];	
    		}
    		else 
    		{
    		    $r[] = $row;
    		}    
    	}    	
    	return $r;    	
    }#GetUserProjects
    
    
    /**
     * Delete all user projects
     *
     * @param int $uid - User ID
     * @return only true
     */
    public function DelAllUserProj($uid)
    {
    	$sql = 'DELETE FROM '.$this -> mTbProjUsers.' WHERE uid = ?';
        $this -> mdbPtr -> query($sql, array($uid));
    	return true;
    }#DelAllUserProj

       
    /**
     * Get Project users
     *
     * @param int $project_id - project ID
     * @return array with users
     */
    public function &GetProjectUsers($project_id, $status = 0)
    {
    	$sql = 'SELECT pu.uid, u.name, u.lname, u.status, u.email 
    	        FROM '.$this -> mTbProjUsers.' pu, '.$this -> mTbUsers.' u
    	        WHERE pu.uid = u.uid AND pu.project_id = ? 
    	       ';
    	if ($status)
    	{
    		$sql .= ' AND u.status = '.(int)$status;
    	}
     	$db  = $this -> mdbPtr -> query($sql, array($project_id));
    	$r   = array();
    	while ($row = $db -> FetchRow())
    	{
    		$row['name']  = stripslashes($row['name']);
    		$row['lname']  = stripslashes($row['lname']);
    		$r[] = $row;
    	}    	
    	return $r;     	
    }#GetProjectUsers
    
    
    /**
     * Check User project (for access)
     *
     * @param int $uid - user ID
     * @param int $project_id - project ID
     * @return bool true or false
     */
    public function CheckUserProject($uid, $project_id)
    {
    	$sql = 'SELECT 1 FROM '.$this -> mTbProjUsers.' WHERE uid = ? AND project_id = ?';
        $r   = $this -> mdbPtr -> getOne($sql, array($uid, $project_id));
        #deb($this -> mdbPtr);
        if ($r)
        {
        	return true;
        }
        else 
        {
        	return false;
        }
    }#CheckUserProject
    
    /**
     * Get Project ID by Project name
     *
     * @param string $name
     * @return int $id or 0
     * 
     */
    public function GetProjectIDByName($name)
    {
    	$sql = 'SELECT id FROM '.$this -> mTbProj.' WHERE LOWER(name) = ? AND deleted = 0';
    	$id  = $this -> mdbPtr -> getOne($sql, array(strtolower($name)));
    	return $id;
    }#GetProjectIDByName
    
    #*******************************************************
    #   Screens
    #*******************************************************       
    
    public function AddScreen($ar, $image)
    {
    	$sql = 'INSERT INTO '.$this -> mTbScreens.' (pid, name, link, rev, parent, mparent, must_approve, pdate) VALUES (?, ?, ?, ?, ?, ?, ?, '.mktime().')';
    	$this -> mdbPtr -> query($sql, $ar);
    	$id  = $this -> mdbPtr -> getOne('SELECT LAST_INSERT_ID()');
    	
    	/** update sort */
    	if (!empty($ar[4]))
    	{
    		$sql = 'SELECT sortid  FROM '.$this -> mTbScreens.' WHERE id = ?';
    		$r   = $this -> mdbPtr -> getOne($sql, $ar[4]);
    	}
    	else
    	{
    	    $sql = 'SELECT MAX(sortid) FROM '.$this -> mTbScreens.' WHERE pid = ?';
    	    $r   = $this -> mdbPtr -> getOne($sql, $ar[0]);
    	}
        if (empty($r))
    	{
    		$r = 0;
    	}
        $sql = 'UPDATE '.$this -> mTbScreens.' SET sortid = ? WHERE id = ?';
    	$this -> mdbPtr -> query($sql, array(($r+1), $id));
        
        
    	/** update image */
    	if ($image && $id)
    	{
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET image = ? WHERE id = ?';
    		$this -> mdbPtr -> query($sql, array($image, $id));
    	}
    	
    	/** update project image */
    	if (empty($ar[6]))
    	{
    		$sql = 'UPDATE '.$this -> mTbProj.' SET image = ?, last_upd = '.mktime().' WHERE id = ?';
    		$this -> mdbPtr -> query($sql, array($image, $ar[0]));   
    	}
    	
    	return $id;
    }#AddScreen
    

    public function UpdScreen($ar, $image, $id)
    {
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET
    	        mparent      = ?,
    	        name         = ?,
    	        link         = ?,
    	        must_approve = ?,
    	        pdatee       = '.mktime().'
    	        WHERE id = ?
    	        ';
    	
    	$ar[] = $id;
    	#deb($ar);
    	$this -> mdbPtr -> query($sql, $ar);
    	if ($image)
    	{
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET image = ? WHERE id = ?';
    		$this -> mdbPtr -> query($sql, array($image, $id));

    		//update image screen
    		/*
    		$sql = 'UPDATE '.$this -> mTbProj.' SET image = ?, last_upd = '.mktime().' WHERE id = ?';
    		$this -> mdbPtr -> query($sql, array($image, $ar[0]));   
    		*/ 		
    	}
    	return true;
    }#UpdScreen

    
    public function ClearAprove($sid)
    {
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET is_approve   = 0 WHERE id = ?';
        $this -> mdbPtr -> query($sql, array($sid));
        return true;
    }/** ClearAprove

       
    /**
     * Update screen name && link
     *
     * @param int $sid - screen ID
     * @param string $name
     * @param string $link
     * @return bool true
     */
    public function UpdScreenName($sid, $name, $link)
    {
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET name = ?, link = ? WHERE id = ?';
    	$this -> mdbPtr -> query($sql, array($name, $link, $sid));
    	return true;
    }/** UpdScreenName */
    
    
   /**
    * Update map marent 
    *
    * @param int $sid - screen ID
    * @param int $mparent - new map parent
    * @return bool true
    */
    public function UpdMParent($sid, $mparent)
    {
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET mparent = ? WHERE id = ?';
    	$this -> mdbPtr -> query($sql, array($mparent, $sid));
    	
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET mparent = ? WHERE parent = ?';
    	$this -> mdbPtr -> query($sql, array($mparent, $sid));
    	return true;
    }/** UpdMParent
    
    
    /**
     * Update scereen link (when update parent screen)
     *
     * @param int $sid
     * @param string $link
     * @return bool true
     */
    public function UpdScreenLinks($sid, $old_link, $new_link)
    {
    	
    	$sql = 'SELECT id, link FROM '.$this -> mTbScreens.' WHERE parent = ?';
    	$db  = $this -> mdbPtr -> query($sql, array($sid));
       
    	$ll  = array($old_link.'/' => $new_link.'/');
        
    	while ($row = $db -> FetchRow())
    	{
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET link = ? WHERE id = ?';
    		$this -> mdbPtr -> query($sql, array(strtr($row['link'], $ll), $row['id']));
    	}
    	return true;
    }#UpdScreenLinks

       
    public function DelScreen($sid)
    {    	
    	$sql = 'DELETE FROM '.$this -> mTbScreens.' WHERE id = ?';
    	$this -> mdbPtr -> query($sql, array($sid));
    	
    	

    	/*
    	$Sql = 'DELETE FROM '.$this -> mTbScreens.' WHERE parent = ?';
    	$this -> mdbPtr -> query($sql, array($sid));
    	*/
    	return true;
    }#DelScreen
    
    
    /**
     * Make next screen AS parent screen
     *
     * @param int $old_parent - old parent screen
     */
    public function MakeNextAsParent($old_parent, $name, $link)
    {
    	$sql = 'SELECT id FROM '.$this -> mTbScreens.' WHERE parent = ? ORDER BY pdate LIMIT 1';
    	$id  = $this -> mdbPtr -> getOne($sql, $old_parent);
    	if ($id)
    	{
    	    //new parent
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET parent = 0, name = ?, link = ? WHERE id = ?';
    	    $this -> mdbPtr -> query($sql, array($name, $link, $id));	
    		
    	    //update all other screens
    	    $sql = 'UPDATE '.$this -> mTbScreens.' SET parent = ? WHERE parent = ?';
    	    $this -> mdbPtr -> query($sql, array($id, $old_parent));	
    	    
    	    //get last screen 	    
    	    $sql = 'SELECT id FROM '.$this -> mTbScreens.' WHERE parent = ? ORDER BY pdate DESC LIMIT 1';
    	    $lid = $this -> mdbPtr -> getOne($sql, $id);
    	
    	    //update parent
    	    if ($lid)
    	    {
    	        $sql = 'UPDATE '.$this -> mTbScreens.' SET last_screen = ? WHERE id = ?';
    	        $this -> mdbPtr -> query($sql, array($lid, $id));
    	    }
    	    $this -> UpdScreenRev($id);
    	}
    	return true;
    }#MakeNextAsParent
    
    
    /**
     * Update last screen for parent screen (for ex. after delete) 
     *
     * @param int $sid - screen ID
     * @return bool true
     */
    public function UpdScreenLast($sid)
    {
    	$sql = 'SELECT id, image, pid FROM '.$this -> mTbScreens.' WHERE parent = ? ORDER BY pdate DESC LIMIT 1';
    	$db   = $this -> mdbPtr -> query($sql, array($sid));
    	if ($row = $db -> FetchRow())
    	{
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET last_screen = ? WHERE id = ?';
    		$this -> mdbPtr -> query($sql, array($row['id'], $sid));
    		
    		$sql = 'UPDATE '.$this -> mTbProj.' SET image = ? WHERE id = ?';
    		$this -> mdbPtr -> query($sql, array($row['image'], $row['pid']));
    	}
    	else 
    	{
    		$sql = 'SELECT image, pid FROM '.$this -> mTbScreens.'
    		        WHERE id = ?';
    		$db   = $this -> mdbPtr -> query($sql, array($sid));
    		if ($row = $db -> FetchRow())
    		{
    			$sql = 'UPDATE '.$this -> mTbProj.' SET image = ? WHERE id = ?';
    			$this -> mdbPtr -> query($sql, array($row['image'], $sid));
    		}
    	}
    	
    	$this -> UpdScreenRev($sid);
    	return true;
    }#UpdScreenLast
    
    
    /**
     * Update screen name && link after delete one screen 
     *
     * @param int $parent - parent screen ID (parent field = 0)
     */
    private function UpdScreenRev($parent)
    {
    	$sql = 'SELECT link FROM '.$this -> mTbScreens.' WHERE id = ?';
    	$r   = $this -> mdbPtr -> getOne($sql, array($parent));
    	if ($r)
    	{
    	    $sql = 'SELECT id FROM '.$this -> mTbScreens.' WHERE parent = ? ORDER BY pdate';
    	    $db  = $this -> mdbPtr -> query($sql, array($parent));
    	    $k   = 1;
    	    while ($row = $db -> FetchRow())
    	    {
    	    	$sql = 'UPDATE '.$this -> mTbScreens.' SET name = ?, link = ?, rev = ? WHERE id = ?';
    	    	$this -> mdbPtr -> query($sql, array('Rev'.$k, $r .'/rev'.$k, $k, $row['id']));
    	    	$k ++;
    	    }
    	}
    }#UpdScreenRev
    
    
    public function ApproveScreen($sid)
    {
    	$sql = 'SELECT parent FROM '.$this -> mTbScreens.' WHERE id = ?';
    	$r   = $this -> mdbPtr -> getOne($sql, array($sid));
    	if ($r)
    	{
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET is_approve = 0 WHERE parent = ? OR id = ?';
    		$this -> mdbPtr -> query($sql, array($r, $r));
    	}
    	else 
    	{
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET is_approve = 0 WHERE parent = ?';
    		$this -> mdbPtr -> query($sql, array($sid));
    	}
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET is_approve = 1 WHERE id = ?';
    	$this -> mdbPtr -> query($sql, array($sid));
    	return true;
    }#ApproveScreen
    

    /**
     * Approve screen for client view
     *
     * @param int $sid screen ID
     * @return bool true
     */
    public function ApproveViewScreen($sid)
    {
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET must_approve = 0 WHERE id = ?';
    	$this -> mdbPtr -> query($sql, array($sid));
    	
    	//update project image screen
    	$sql = 'SELECT image, pid FROM '.$this -> mTbScreens.' WHERE id = ?';
    	$db   = $this -> mdbPtr -> query($sql, $sid);
    	if ($row = $db -> FetchRow())
    	{
            $sql = 'UPDATE '.$this -> mTbProj.' SET image = ?, last_upd = '.mktime().' WHERE id = ?';
    	    $this -> mdbPtr -> query($sql, array($row['image'], $row['pid']));
    	}
    	return true;
    }#ApproveScreen

       
    /**
     * Get Project ID by Screen ID
     * @param int $id - screen ID
     * @return int project_id
     *
     */
    public function GetScreenProjectID($id)
    {
        $sql = 'SELECT pid FROM '.$this -> mTbScreens.' WHERE id = ?';
        $r   = $this -> mdbPtr -> getOne($sql, array($id));	
        return $r;
    }#GetScreenProjectID
    
    
    /**
     * Get Screen ID by Link
     *
     * @param string $link
     * @param int $pid - project ID
     * @return int $id 
     */
    public function GetScreenIDByLink($link, $pid)
    {
    	$sql = 'SELECT id FROM '.$this -> mTbScreens.' WHERE link = ? AND pid = ?';
    	$r   = $this -> mdbPtr -> getOne($sql, array(strtolower($link), $pid));	
        return $r;	
    }#GetScreenIDByLink
    
    
    /**
     * Set Last Screen to top screen
     *
     * @param int $id - top screen ID
     * @param int $last_id - last screen ID
     */
    public function UpdLastScreen($id, $last_id)
    {
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET last_screen = ? WHERE id = ?';
    	$this -> mdbPtr -> query($sql, array($last_id, $id));
    }#UpdLastScreen
       
    
    /**
     * Get One screen
     *
     * @param int $id
     * @return array screen array
     */  
    public function &GetScreen($id, $no_rev = 0)
    {
    	$sql = 'SELECT * FROM '.$this -> mTbScreens.' WHERE id = ?';
    	$db  = $this -> mdbPtr -> query($sql, array($id));
    	if ($row = $db -> FetchRow())
    	{
    		$row['name']  = stripslashes($row['name']);
    		$row['olink'] = $row['link'];
    		if (!$row['parent'] && !$no_rev)
    		{
    			$row['link'] .= '/rev0';
    		}
    		return $row;
    	}
    	else 
    	{
    		$r = array();
    		return $r;
    	}
    }#GetScreen
    
    
    
    
    /**
     * Get One project screen (only image)
     *
     * @param int $pid - project_id
     * 
     * @return string - image
     */
    public function &GetOneProjScreen($pid)
    {
    	$sql = 'SELECT image FROM '.$this -> mTbScreens.' WHERE pid = ? LIMIT 1';
    	$r   = $this -> mdbPtr -> getOne($sql, $pid);
    	if ($r)
    	{
    		return $r;
    	}
    	else 
    	{
    		$r = '';
    		return $r;
    	}
    }#GetOneProjScreen
    
    
    /**
     * Get count of SubScreens
     *
     * @param int $pid
     * @param int $parent
     */
    public function GetSubScreenCount($pid, $parent, $ustatus = 0)
    {
    	$sql = 'SELECT COUNT(id) FROM '.$this -> mTbScreens.' WHERE parent = ? AND pid = ?';
    	if (1 == $ustatus)
    	{
    		$sql .= ' AND must_approve = 0';
    	}
    	$r   = $this -> mdbPtr -> getOne($sql, array($parent, $pid));
    	return $r;
    }#GetSubScreenCount
    
    
    /**
     * Get Screens
     *
     * @param int $pid - project ID
     * @param int $parent - parent screen
     * @param int $user_status  - user status (0..4), 1 - client (!)
     * @return array with values
     */
    public function GetScreens($pid, $parent = 0, $user_status = 0)
    {

    	if (0 == $parent)
    	{
    	    $sql = 'SELECT s.*, s2.id AS nid, s2.image AS nimage, s2.pdate AS npdate, s2.comcnt AS ncomcnt, s2.clmcnt AS nclmcnt, s2.is_new AS nis_new, s2.is_approve AS nis_approve, s2.link AS nlink  
    	            FROM '.$this -> mTbScreens.' s 
    	            LEFT JOIN '.$this -> mTbScreens.' s2 ON (s.last_screen = s2.id'.(1 == $user_status ? ' AND s2.must_approve = 0' : '').') 
    	            WHERE s.parent = ? AND s.pid = ? 
    	            '.(1 == $user_status ? ' AND s.must_approve = 0' : '').'
    	            ORDER BY s.sortid';	
    	}
    	else 
    	{
    	    $sql = 'SELECT * FROM '.$this -> mTbScreens.' 
    	    WHERE parent = ? AND pid = ? '.(1 == $user_status ? ' AND must_approve = 0' : '').' ORDER BY pdate';
    	}
    	$db  = $this -> mdbPtr -> query($sql, array($parent, $pid));
    	$r   = array();
    	while ($row = $db -> FetchRow())
    	{
    		$row['name']  = stripslashes($row['name']);
    		$row['pdate'] = date('D, M d,  Y h:i a', $row['pdate']);
    		$row['olink'] = $row['link'];
    		if (!$row['parent'])
    		{
    			$row['link'] .= '/rev0';
    		}    		
    		if (!empty($row['npdate']))
    		{
    			$row['npdate'] = date('D, M d,  Y h:i a', $row['npdate']);
    		}
    		
    		if (0 == $row['parent'] && empty($row['nid']) && 1 == $user_status)
    		{
    			$sql = 'SELECT s2.id AS nid, s2.image AS nimage, s2.pdate AS npdate, s2.comcnt AS ncomcnt, s2.clmcnt AS nclmcnt, s2.is_new AS nis_new, s2.is_approve AS nis_approve, s2.link AS nlink, s2.must_approve AS nmust_approve 
    			        FROM '.$this -> mTbScreens.' s2 WHERE parent = ? AND s2.pid = ? AND s2.must_approve = 0
    			        ORDER BY s2.pdate DESC LIMIT 1
    			        ';
    			$dbx  = $this -> mdbPtr -> query($sql, array($row['id'], $pid));
    			if ($rowx = $dbx -> FetchRow())
    			{
    				$rowx['npdate'] = date('D, M d,  Y h:i a', $rowx['npdate']);
    				$row = array_merge($row, $rowx);
    			}
    		}
    		$r[] = $row;
    	}

    	return $r;
    }#GetScreens
    
    
    public function GetPrevNext($sid, $pid)
    {
    	$sql = 'SELECT id, rev, parent FROM '.$this -> mTbScreens.' WHERE id = ?';
    	$db   = $this -> mdbPtr -> query($sql, $sid);
        if ($row = $db -> FetchRow())
        {
        	$id     = $row['id'];
        	$rev    = $row['rev'];
            $parent = $row['parent']; 
        }
        else
        {
        	$r = array(0, 0);
        	return $r;        	
        }
       
    	/** Get Prev */
        $r[0]    = 0;
        $this -> mPrevImage = '';

        if ($rev)
        {
        	if (1 == $rev)
            {
          
            	$sql = 'SELECT link, parent, image FROM '.$this -> mTbScreens.' WHERE id = ? AND pid = ?';
                $db  = $this -> mdbPtr -> query($sql, array($parent, $pid));
                if ($row = $db -> FetchRow())
    	        {
    		        $r[0] = $row['link'].(!$row['parent'] ? '/rev0' : '');
    		        $this -> mPrevImage = $row['image'];
    	        }                 
            }
            else
            {
        	    $sql = 'SELECT link, parent, image FROM '.$this -> mTbScreens.' 
                        WHERE parent = ? AND pid = ? AND rev < '.$rev.' ORDER BY rev DESC LIMIT 1';
                $db  = $this -> mdbPtr -> query($sql, array($parent, $pid));
                if ($row = $db -> FetchRow())
    	        {
    		        $r[0] = $row['link'].(!$row['parent'] ? '/rev0' : '');
    		        $this -> mPrevImage = $row['image'];
    	        }                
            }    
        }
        else
        {
     
            /** Check other screens */
        	$sql = 'SELECT id, link, parent FROM '.$this -> mTbScreens.' 
                   WHERE id < ? AND pid = ? AND rev = 0';
            $dbx = $this -> mdbPtr -> query($sql, array( ($rev) ? $parent : $id, $pid) );
            if ($rowx = $dbx -> FetchRow())
            {
            	//get max
            	$sql = 'SELECT link, parent FROM '.$this -> mTbScreens.' 
                        WHERE parent = ? AND pid = ? ORDER BY rev DESC LIMIT 1';
            	$db  = $this -> mdbPtr -> query($sql, array($rowx['id'], $pid));
            	if ($row = $db -> FetchRow())
            	{
            		$r[0] = $row['link'].(!$row['parent'] ? '/rev0' : '');
            	}
            	else
            	{
            		$r[0] = $rowx['link'].(!$rowx['parent'] ? '/rev0' : '');
            	}	
            }
            
        }
    	

    	/** Get Next */
    	$r[1] = 0;

        $sql = 'SELECT link, parent FROM '.$this -> mTbScreens.' 
                WHERE parent = ? AND pid = ? AND rev > '.$rev.' ORDER BY rev ASC LIMIT 1';
        $db  = $this -> mdbPtr -> query($sql, array( ($rev) ? $parent : $id, $pid));
        if ($row = $db -> FetchRow())
    	{
    	    $r[1] = $row['link'].(!$row['parent'] ? '/rev0' : '');
    	}                
        else
        {
            /** Check other screens */
        	$sql = 'SELECT id, link, parent FROM '.$this -> mTbScreens.' 
                    WHERE id > ? AND pid = ? AND rev = 0';
            $db  = $this -> mdbPtr -> query($sql, array(($rev) ? $parent : $id, $pid));

            if ($row = $db -> FetchRow())
            {
                $r[1] = $row['link'].(!$row['parent'] ? '/rev0' : '');
            }	
        }             	

    	return $r;  	
    }#GetPrevNext
    
    /**
     * Get Previos revision image
     * 
     * @return string imagename
     */
    public function GetPrevImage()
    {
    	return $this -> mPrevImage;
    }/** GetPrevImage */
    
    
    /**
     * Get screen tree by mparent field - for site map
     *
     * @param int $pid
     * @return string
     */
    public function GetScreenTree($pid)
    {
    	
    	$pi = $this -> GetProject($pid);

    	$ra = array();
    	//select top screens
        $sql = 'SELECT id, name, rev, is_approve, image, last_screen, mparent, link FROM '.$this -> mTbScreens.' WHERE parent = 0 AND pid = ?';	
    	
        $db  = $this -> mdbPtr -> query($sql, array($pid));
    	//deb($this -> mdbPtr);
        while ($row = $db -> FetchRow())
    	{
    		if ($row['last_screen'])
    		{
    			$sql = 'SELECT id, name, rev, is_approve, image, mparent, is_new, link FROM '.$this -> mTbScreens.' WHERE id = ?';	
    			$dbx = $this -> mdbPtr -> query($sql, $row['last_screen']);
    			if ($rowx = $dbx -> FetchRow())
    			{
    				$rowx['id']   = $row['id'];
    				$rowx['name'] = $row['name'];
    				$rowx['link'] = $row['link'];
    			    $row          = $rowx;
    			}
    		}
    	    $row['link'] = PATH_ROOT . $pi['link'] . '/'.$row['link'].'/rev'.$row['rev']; 
    		$ra[$row['mparent']][] = $row;
    		
    	}
    	ksort($ra);
    	$st = $this -> OutL($ra, -1);
    	return $st;
    }/** GetScreenTree */
    
    
    /**
     * Check aprove status on last revision 
     *    
     * @param int $sid - first rev ID
     * 
     * @return int - aprove status (0 or 1)
     */
    public function CheckScreenAprove($sid)
    {
        $sql = 'SELECT id 
                FROM '.$this -> mTbScreens.'
                WHERE (id = ? OR parent = ?) AND is_approve = 1 
                ';
        $r  = $this -> mdbPtr -> getOne($sql, array($sid, $sid));
        if (!empty($r))
        {
        	return $r;
        }
        else
        {
        	$r = 0;
        	return $r;
        }
    }/** CheckScreenAprove*/    
    
    
    
    /**
     * Recursion function for GetScreenTree func
     *
     * @param array $ra
     * @param int $x - current ID
     * @return string
     */
    private function OutL(&$ra, $x)
    {
	   
    	$mRep = array('"' => '&quot;', '&' => '&amp;', '>' => '&gt;', '<' => '&lt;', "'" => '&apos;', '®'=>'(R)');
    	$st = '';
    	if (empty($ra[$x]))
    	{
    		return $st;
    	}
    	foreach ($ra[$x] as $k => $v)
        {
    	    $st .= '<item name="'.strtr($v['name'], $mRep).'" rev="'.$v['rev'].'" approved="'.(!empty($v['is_approve']) ? 'true' : 'false').'" new="'.(!empty($v['is_new']) ? 'true' : 'false').'" image="'.PATH_ROOT.DIR_NAME_IMAGE.DIR_NAME_RESIZE.'/m_'.$v['image'].'" page_link="'.$v['link'].'">'."\n";
    	    $st .= $this -> OutL($ra, $v['id']);  		
    	    $st .= '</item>'."\n"; 
        }
        return $st;
    }/** OutL */
    	
    
    /**
     * Update commentary count in screen table
     *
     * @param int $sid - screen ID
     * @param int $base - base commentary counter (0, +1, -1)
     * @param int $client -client commentary counter  (0, +1, -1)
     * @return bool true
     */
    public function UpdCom($sid, $base = 1, $client = 0)
    {
    	$this -> mdbPtr -> query('UPDATE '.$this -> mTbScreens.' SET 
    	                          comcnt = comcnt + '.$base.', 
    	                          clmcnt = clmcnt + '.$client.'
    	                          WHERE id = ?', $sid);
    	
    	return true;
    }#AddCom
    
    
    /**
     * Clear is_new flag 
     *
     * @param int $sid
     */
    public function NoNew($sid)
    {
    	$sql = 'UPDATE '.$this -> mTbScreens.' SET is_new = 0 WHERE id = ?';
    	$this -> mdbPtr -> query($sql, $sid);
    	return true;
    }#NoNew
    
    
    /**
     * Update (screen sortID
     * param int $pid - project ID 
     * param int $screen_id - screend ID
     * 
     * return bool true
     */
    public function UpdSort($pid, $screen_id, $vl)
    {
    	$sql = 'SELECT sortid FROM '.$this -> mTbScreens.' WHERE pid = ? AND id = ?';
    	$db  = $this -> mdbPtr -> query($sql, array($pid, $screen_id));
    	if ($row = $db -> FetchRow())
    	{
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET sortid = sortid + '.(-1 * $vl). 
    		       ' WHERE pid = ? AND sortid = '.($row['sortid'] +  $vl);
    		
    		$this -> mdbPtr -> query($sql, array($pid));
    		
    		$sql = 'UPDATE '.$this -> mTbScreens.' SET sortid = sortid + '.$vl.' 
    	            WHERE pid = ? AND (id = ? OR parent = ?)';
    		$this -> mdbPtr -> query($sql, array($pid, $screen_id, $screen_id));
    	}
        return  true;
    }/** DownSort */
    
    
    /**
     * Update full project sort
     * param int $pid - project ID 
     * 
     * return bool true 
     */
    public function UpdFullSort($pid)
    {
    	
        $sql = 'SELECT id FROM '.TB.'screens WHERE parent = 0 AND pid = ? ORDER BY sortid';
    	$db2 = $this -> mdbPtr -> query($sql, $pid); 
    	$k   = 1;
    	while ($row2 = $db2 -> FetchRow())
    	{
    	    $sql = 'UPDATE '.TB.'screens SET sortid = ? WHERE id = ?';
    	    $this -> mdbPtr -> query($sql, array($k, $row2['id']));

    	    $sql = 'UPDATE '.TB.'screens SET sortid = ? WHERE parent = ?';
    	    $this -> mdbPtr -> query($sql, array($k, $row2['id']));
    	    
    	    $k ++;
    	}
    	return  true;
    }/** UpdFullSort */


    /**
     * Save sorting order
     * param int $pid - project ID 
     * param String $serialized_order - format : 1|3|66|78|34 - set of screen id's delimited by '|'
     *
     * return bool true 
     */

    public function SaveSortingOrder($pid,$serialized_order)
    {
       $new_order_id = explode('|',$serialized_order);

       $sql = 'SELECT id FROM '.TB.'screens WHERE parent = 0 AND pid = ? ORDER BY sortid';
       $db = $this -> mdbPtr -> query($sql, $pid); 
       $k   = 0;

       while ($row = $db -> FetchRow()) {

    	    $sql = 'UPDATE '.TB.'screens SET sortid = ? WHERE id = ?';
    	    $this -> mdbPtr -> query($sql, array($k, $new_order_id[$k]));

    	    $k ++;
    	}

    	return  true;
    }/** SaveSortingOrder */


    public function GetNextScreenId($sid, $pid)
    {


	   $sql = 'SELECT id FROM '.TB.'screens WHERE parent = 0 AND pid ='.$pid.' ORDER BY sortid';
       $col = $this -> mdbPtr -> getCol($sql); 
       $cnt = count($col);
       $ids=array();
        for($k=0;$k<$cnt;$k++) {
	    	$sql = 'SELECT id FROM '.TB.'screens WHERE parent ='. $col[$k].' ORDER BY rev DESC';
	    	$id = $this -> mdbPtr -> getOne($sql);
			if ($id) {	

	    		$ids[] = $id;  
			}else {

	    		$ids[] = $col[$k];  
			}

		}

		$k = array_search($sid,$ids);
		$prevnext = array();
		$prevnext[]=$ids[$k-1];
		$prevnext[]=$ids[$k+1];
        return $prevnext;

    }/** GetNextScreenId */

    
}#End class    
