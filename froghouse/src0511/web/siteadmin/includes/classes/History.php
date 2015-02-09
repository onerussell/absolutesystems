<?php
/**
 * History class
 * 
 * @package    engine37 Catalog v3.0
 * @version    0.1b
 * @since      25.12.2005
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */
class History
{
    private $mTimeOffset; // offset in hours
    private $mResOnPage;  // = 0 if not paginal viewing is required
    private $mTable;
    private $mUser;
    private $mDbPtr;

    public function __construct($dbPtr, $user, $table = 'history', $resOnPage = 20, $timeOffset = 0)
    {
        $this->mDbPtr      =  $dbPtr;
        $this->mUser       =  $user;
        $this->mTable      =  $table;
        $this->mResOnPage  =  $resOnPage;
        $this->mTimeOffset =  $timeOffset;

    }#end constructor

    public function &GetLastAccess($login, $actType)
    {
        $data = array($login, $actType);
        $sql = 'SELECT DATE_FORMAT(DATE_ADD(h.date,INTERVAL '.$this->mTimeOffset.' HOUR),\'%d.%m.%y %k:%i\') AS date,
                       h.ip FROM '.$this->mTable.' h 
                WHERE h.login = ?
                      AND h.action = ? 
                ORDER BY h.date DESC';

        $res =& $this->mDbPtr->limitQuery($sql, 0, 1, $data); 

        if ($res -> numRows() > 0)
            return $res -> fetchRow();
        else
           {
            $res = array('ip'   => getenv('REMOTE_ADDR'), 
                         'date' => date('d.m.Y H:i'));
            return $res;
           }

    }#GetLastAccess

    /**
     * Delete history record
     * @param int $log_id record id
     * @return void
     */
    public function DeleteRecord($log_id)
    {
        $log_id = intval($log_id);
        $this->mDbPtr->query('DELETE FROM '.$this->mTable.' 
                              WHERE log_id = ?', $log_id);

    }#DeleteRecord

    public function ResOnPage()
    {
        return $this->mResOnPage;

    }#ResOnPage

    /**
     * Add new history record
     *
     * @param string $action action, for example 'Delete'
     * @param string $what   for example 'user'
     *
     * @return void
     */
    public function Add($action,$what)
    {
        $data = array($action, 
                      $what, 
                      getenv('REMOTE_ADDR'), 
                      $this -> mUser);

        $this->mDbPtr->query('INSERT INTO '.$this->mTable.'
                              (action,what,date,ip,login) 
                              VALUES (?, ?, NOW(), ?, ?)', $data, $this -> mDbPtr);

    }#Add

    /**
     * Get records count for period
     *
     * @param int $startDate start date, -1 for negative infinity
     * @param int $endDate   end date, -1 for infinity 
     *
     * @return int count of records
     */
    public function &Count($startDate = -1, $endDate = -1)
    {
        $sql = 'SELECT COUNT(*) FROM '.$this->mTable;
        if ($startDate != -1)
            $sql .= ' WHERE date>=\''.$startDate.'\' 
                            AND date<=\''.$endDate.'\'';

        $res =& $this->mDbPtr->getOne($sql, array()); 

        return $res;

    }#Count

    /**
     * Get records
     *
     * @param int $pStart    page number
     * @param int $startDate start date, -1 for negative infinity
     * @param int $endDate   end date, -1 for infinity 
     *
     * @return array associative array with results
     */
    public function &GetAll($pStart = 0, $startDate = -1, $endDate = -1)
    {
        $sql = 'SELECT log_id, action, what, ip, login, 
                       DATE_FORMAT(DATE_ADD(date,INTERVAL '.$this->mTimeOffset.' HOUR),\'%d.%m.%y<br />%k:%i\') AS date_f 
                FROM '.$this->mTable;

        if ($startDate != -1)
            $sql .= ' WHERE date>=\''.$startDate.'\' 
                      AND date<=\''.$endDate.'\'';

        $sql .= ' ORDER BY date DESC';

        if ($this->mResOnPage > 0)
            $dbout =& $this->mDbPtr->limitQuery($sql, $pStart, $this->mResOnPage, array());
        else
            $dbout =& $this->mDbPtr->query($sql);

        $HA = array(); // (H)istory (A)rray
        while ($row = $dbout -> fetchRow())
        {
            $HA[] = $row;
        }
        return $HA;

    }#GetAll

    /**
     * Delete all history
     * @return void
     */
    public function DeleteAll()
    {
        $this->mDbPtr->query('TRUNCATE '.$this->mTable);

    }#DeleteAll

}
?>