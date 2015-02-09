<?php
/**
 * Base options class (for nightlife etc.)
 *
 * @package    engine37 Catalog v3.0
 * @version    0.3b
 * @since      09.04.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */

class BOpt
{
    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;    #PEAR::DB pointer
    private $mCtable;   #table with option categories
    private $mEtable;   #table with option elements
    private $mBlock;

    public function __construct($dbPtr, $ctable = 'optcat', $etable = 'optel', $block = '')
    {
        $this -> mDbPtr  = $dbPtr;
        $this -> mCtable = $ctable;
        $this -> mEtable = $etable;
        $this -> mBlock  = $block;
    }#end constructor


    /**
    * Get options for current block (for site output!!!)
    *
    * @return array - hash with option values
    */
    public function &GetBlock()
    {
        $res = array();
        $i   = 0;
        $sql = 'SELECT id, name, ctype, cname, block FROM '.$this -> mCtable.' WHERE block = "'.$this -> mBlock.'" ORDER BY sortid';

        $db  =& $this -> mDbPtr -> query($sql);
        while ($row = $db -> FetchRow())
        {
            $res[$i] = array('id' => $i,
                             'name' => stripslashes($row['name']),
                             'ctype' => $row['ctype']);
            $sql = 'SELECT cid, val, sortid FROM '.$this -> mEtable.' WHERE cid = "'.$row['id'].'" ORDER BY sortid';
            $dbx =& $this -> mDbPtr -> query($sql);
            $va  = array();
            while ($rowx = $dbx -> FetchRow())
            {
                $rowx['val']      = stripslashes($rowx['val']);
                $va[$rowx['val']] = $rowx['val'];
            }
            $res[$i]['vals'] = $va;
            $i++;
        }
        return $res;
    }#GetBlock


    /**
    * Select one option
    *
    * @param int $id - option ID
    * @return hash with values
    */
    public function &GetCat($id = 0)
    {
        if ($id == 0)
        {
            $r = false;
            return $r;
        }
        $sql = 'SELECT id, name, ctype, cname, block, sortid FROM '.$this -> mCtable.' WHERE id = "'.$id.'"';
        $db  = $this -> mDbPtr -> query($sql);
        if ($row = $db -> FetchRow())
        {
            $row['name']  = stripslashes($row['name']);
            $row['cname'] = stripslashes($row['cname']);
            return $row;
        }
        else
        {
            $res = array();
            return $res;
        }
    }#GetCat


    /**
    * Select options list
    *
    * @param void
    * @return hash with values
    */
    public function &GetCatList()
    {
        $sql = 'SELECT id, name, ctype, cname, block, sortid FROM '.$this -> mCtable.' ORDER BY block, sortid';
        $db  = $this -> mDbPtr -> query($sql);
        $res = array();
        while ($row = $db -> FetchRow())
        {
            $row['name']  = stripslashes($row['name']);
            $row['cname'] = stripslashes($row['cname']);
            $res[] = $row;
        }
        return $res;

    }#GetCatList


    /**
    * Select one option value
    *
    * @param int $id - option value ID
    * @return hash with values
    */
    public function &GetEl($id = 0)
    {
        if ($id == 0)
        {
            $r = false;
            return $r;
        }

        $sql = 'SELECT id, val, cid, sortid FROM '.$this -> mEtable.' WHERE id = "'.$id.'"';
        $db  = $this -> mDbPtr -> query($sql);
        if ($row = $db -> FetchRow())
        {
            $row['val']  = stripslashes($row['val']);
            return $row;
        }
        else
        {
            $res = array();
            return $res;
        }

    }#GetEl


    /**
    * Select option values list
    *
    * @param int $cid - option ID
    * @return hash with values
    */
    public function &GetElList($cid = 0)
    {
        $res = array();

        if ($cid == 0)
        {
            return $res;
        }

        $sql = 'SELECT id, val, cid, sortid FROM '.$this -> mEtable.' WHERE cid = '.$cid.' ORDER BY sortid';
        $db  = $this -> mDbPtr -> query($sql);
        $res = array();
        while ($row = $db -> FetchRow())
        {
            $row['val']  = stripslashes($row['val']);
            $res[] = $row;
        }
        return $res;

    }#GetCatList


    /**
    * Add option
    *
    * @param array $ar - array with params
    * @return true
    */
    function AddCat($ar)
    {
        if (!isset($ar['id']) || $ar['id'] == 0)
        {
            $sql = 'INSERT INTO '.$this -> mCtable.' SET
                    name   = "'.addslashes($ar['name']).'",
                    ctype  = "'.$ar['ctype'].'",
                    cname  = "'.$ar['cname'].'",
                    sortid = "'.$ar['sortid'].'",
                    block  = "'.$ar['block'].'"';
        }
        else
        {
            $sql = 'UPDATE '.$this -> mCtable.' SET
                    name   = "'.addslashes($ar['name']).'",
                    ctype  = "'.$ar['ctype'].'",
                    cname  = "'.$ar['cname'].'",
                    sortid = "'.$ar['sortid'].'",
                    block  = "'.$ar['block'].'"
                    WHERE id = "'.$ar['id'].'"';
        }
        $this -> mDbPtr -> query($sql);
        $r = true;
        return $r;
    }#AddCat


    /**
    * Add option value (to category CID)
    *
    * @param array $ar - array with params
    * @return true
    */
    function AddEl($ar)
    {
        if (!isset($ar['id']) || $ar['id'] == 0)
        {
            $sql = 'INSERT INTO '.$this -> mEtable.' SET
                    val    = "'.addslashes($ar['val']).'",
                    cid    = "'.$ar['cid'].'",
                    sortid = "'.$ar['sortid'].'"';
        }
        else
        {
            $sql = 'UPDATE '.$this -> mEtable.' SET
                    val    = "'.addslashes($ar['val']).'",
                    cid    = "'.$ar['cid'].'",
                    sortid = "'.$ar['sortid'].'"
                    WHERE id = "'.$ar['id'].'"';
        }
        $this -> mDbPtr -> query($sql);
        $r = true;
        return $r;
    }#AddEl


    /**
    * Delete option
    *
    * @param int $id - option ID
    * @return true
    */
    function DelCat($id)
    {
        if ($id == 0 || !is_numeric($id))
        {
            $r = false;
            return $r;
        }

        $sql = 'DELETE FROM '. $this -> mCtable .' WHERE id = "'.$id.'"';
        $this -> mDbPtr -> query($sql);
        $sql = 'DELETE FROM '.$this -> mEtable.' WHERE cid = "'.$id.'"';
        $this -> mDbPtr -> query($sql);
        $r = true;
        return $r;
    }


    /**
    * Delete option value
    *
    * @param int $id - option value ID
    * @return true
    */
    function DelEl($id = 0)
    {
        if ($id == 0 || !is_numeric($id))
        {
            $r = false;
            return $r;
        }
        $sql = 'DELETE FROM '.$this -> mEtable.' WHERE id = "'.$id.'"';
        $this -> mDbPtr -> query($sql);
        $r = true;
        return $r;
    }#DelEl


}#BOpt
?>