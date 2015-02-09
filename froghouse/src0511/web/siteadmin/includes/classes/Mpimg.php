<?php
/**
 * Main page Images administration
 *
 * @package    engine37 Catalog v3.0
 * @version    0.1b
 * @since      10.01.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */

class Mpimg
{
    private $mTable;     //Table name
    private $mDbPtr;     //DB pointer

    public function __construct($dbPtr, $table  = 'banners')
    {
        $this -> mTable    =  $table;
        $this -> mDbPtr    =  $dbPtr;
    }


    /**
    * Add image to dB
    * @param array $ar with values
    * @param int $id - page id for Update (if Update)
    * @return bool true
    */
    public function Add($ar)
    {

            $sql  =  'INSERT INTO '.$this -> mTable.' SET
                      name     = ?,
                      image    = ?';

        $this -> mDbPtr -> query($sql, $ar);
        return true;

    }#Add


    /**
    * Delete image from dB
    *
    * @param int $id - banner ID
    * @return bool true
    */
    public function Del($id = 0)
    {
        if ($id == 0 || !is_numeric($id))
        {
            global $gSmarty;
            throw new Exception($gSmarty -> _config[0]['vars']['errdel'].' [id = '.$id.']');
        }
        $sql = 'DELETE FROM '.$this -> mTable.' WHERE id = "'.$id.'"';

        $this -> mDbPtr -> query($sql);
        return true;

    }#DelBanner


    /**
    * Get Banner
    *
    * @param int $id - image ID in table (for select by ID)
    * @return array - hash with values (image, name)  or 0
    */
    public function Get($id = 0)
    {

        if (is_numeric($id) && $id > 0)
            $sql  = 'SELECT id, name, image
                     FROM '.$this -> mTable.'
                     WHERE id = "'.$id.'"';
        else
        {
            $sql  = 'SELECT *, RAND() AS ordfield
                     FROM '.$this -> mTable;
            $sql .= ' ORDER BY ordfield';
        }
        $db   =& $this -> mDbPtr -> query($sql);

        #no banners
        if ($db -> numRows() == 0)
            return 0;
        else
        {
            $row           = $db -> fetchRow();
            $row['image']  = $row['image'];
            $row['name']   = stripslashes($row['name']);
            return $row;
        }

    }#GetBanner


    /**
    * Get List
    *
    * @param void
    * @return array - hash with values
    */
    public function GetList()
    {
        $sql  = 'SELECT id, name, image
                 FROM '.$this -> mTable.'
                 ORDER BY name';

        $db   =& $this -> mDbPtr -> query($sql);
        $res  = array();
        while ($row = $db -> fetchRow())
        {
            $row['name']     = stripslashes($row['name']);
            $row['image']    = PATH_ROOT . DIR_NAME_IMAGE . '/' . $row['image'];
            $res[]           = $row;
        }
        return $res;

    }#GetList

}#end class