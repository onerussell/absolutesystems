<?php
/**
 * Access to countries, subdivisions and cities
 * 
 * @package    engine37 Catalog v3.0
 * @version    0.1a
 * @since      25.12.2005
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */
class Geografy
{

    /**
     * PEAR::DB pointer
     * @var mixed
     */
    private $mDbPtr;

    /**
     * Database table for country subdivisions
     * @var string
     */
    private $mSubDiv;

    /**
     * Database table for countries
     * @var string
     */
    private $mCntr;

    /**
     * Database table for cities
     * @var string
     */
    private $mCity;

    /**
     * Constructor. Iniatilize base class variables
     *
     * @param mixed  $dbPtr       PEAR::DB pointer
     * @param string $cntrTable   database table for countries
     * @param string $subdivTable database table for subdivisions
     * @param string $citiesTable database table for cities
     *
     * @return void
     */
    public function __construct($dbPtr, $cntrTable = 'countries', $subdivTable = 'countries_subdivisions', $citiesTable = 'countries_cities')
    {
        $this -> mDbPtr  = $dbPtr;
        $this -> mCntr   = $cntrTable;
        $this -> mSubDiv = $subdivTable;
        $this -> mCity   = $citiesTable;

    }#end constructor

    /**
     * Get all subdivisions for specified country
     * @param string $iso2_cntr unique country iso2-code
     * @return array 
     */
    public function &GetSubDiv($iso2_cntr)
    {
        $res =& $this->mDbPtr->getAll('SELECT subdiv_id, name
                                       FROM '.$this->mSubDiv.'
                                       WHERE iso2_cntr = ?
                                       ORDER BY name ASC', array($iso2_cntr));
        return $res;

    }#GetSubDiv

    /**
     * Get all countries
     * @return array 
     */
    public function &GetCountries()
    {
        $res =& $this->mDbPtr->getAll('SELECT iso2, name
                                       FROM '.$this->mCntr.'
                                       ORDER BY name ASC');
        return $res;

    }#GetCountries

    /**
     * Get all cities for specified country
     * @param string $iso2_cntr iso2 code of country
     * @return array 
     */
    public function &GetCities($iso2_cntr)
    {
        $res =& $this->mDbPtr->getAll('SELECT city_id, name
                                       FROM '.$this->mCity.'
                                       WHERE iso2_cntr = ?
                                       ORDER BY name ASC', array($iso2_cntr));
        return $res;

    }#GetCities

    public function GetCountryName($iso2_cntr)
    {
        return $this->mDbPtr->getOne('SELECT name 
                                      FROM '.$this->mCntr.'
                                      WHERE iso2 = ?', array($iso2_cntr));

    }#GetCountryName

    public function GetSubDivName($subdiv_id)
    {
        return $this->mDbPtr->getRow('SELECT name, iso2_cntr
                                      FROM '.$this->mSubDiv.'
                                      WHERE subdiv_id = ?', array($subdiv_id));

    }#GetSubDivName

    public function GetCityName($city_id)
    {
        return $this->mDbPtr->getRow('SELECT cy.name AS city_name, 
                                             cr.iso2, cr.name AS country_name 
                                      FROM '.$this->mCity.' cy, 
                                           '.$this->mCntr.' cr 
                                      WHERE cy.city_id = ?
                                            AND cr.iso2=cy.iso2_cntr ', array($city_id));

    }#GetCityName
}

?>