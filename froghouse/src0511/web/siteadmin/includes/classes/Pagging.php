<?php
/**
 * Pagging class - Make pages list
 *
 * @package    engine37 Catalog v3.0
 * @version    0.1b
 * @since      25.12.2005
 * @copyright  2004-2005 engine37.com
 * @link       http://engine37.com
 */

class Pagging
{
    private $mResOnPage; //Results on page
    private $mEcount;    //Count of elements
    private $mPageLink;  //Link for pages
    private $mPage;      //Current page

    public function __construct($ResOnPage  = 10, $Ecount = 0, $page = 1, $link = '')
    {
        $this -> mResOnPage     =  $ResOnPage;
        $this -> mEcount        =  $Ecount;
        $this -> mPageLink      =  $link;

        if (!is_numeric($page) || $page == 0)
            $page = 1;
        $this -> mPage          = $page;
    }


    public function Make()
    {
        if ($this -> mEcount < $this -> mResOnPage)
            return true;
        global $gSmarty;

        $range    = $this -> GetRange();
        $range[]  = $this -> mEcount;
        $gSmarty -> assign('range', $range);
        $gSmarty -> assign('page' , $this -> mPage);

        $link = $this -> mPageLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';

        #make list
        $k   = 0;
        $i   = 1;
        $res = array();
        while ($k < $this -> mEcount)
        {
            $res[] =  array('page' => $i, 'link' => $link.'page='.$i);
            $k     += $this -> mResOnPage;
            $i ++;
        }
        $gSmarty -> assign('pages', $res);
        $gSmarty -> assign('_pagging', $gSmarty -> fetch('mods/_pagging.tpl'));
        return true;

    }#Make


    public function Make2($style = 1)
    {
        if ($this -> mEcount < $this -> mResOnPage)
            return true;
        global $gSmarty;

        $range    = $this -> GetRange();
        $range[]  = $this -> mEcount;
        $gSmarty -> assign('range', $range);
        $gSmarty -> assign('page' , $this -> mPage);

        $link = $this -> mPageLink;
        if ( strpos($link, '?') > 0 )
            $link .= '&';
        else
            $link .= '?';

        #make list
        $k   = 0;
        $i   = 1;

        $res = array();
        while ($k < $this -> mEcount)
        {
            $res[] =  array('page' => $i, 'link' => $link.'page='.$i);
            $k     += $this -> mResOnPage;
            $i ++;
        }

        $ar = array();
        for ($i = 0; $i < count($res); $i++)
            if ($res[$i]['page'] == $this -> mPage)
            {
                if (isset($res[$i-1]))
                   $ar[0] = $res[$i-1];
                if (isset($res[$i+1]))
                   $ar[1] = $res[$i+1];
                $ar[2] = $this -> mPage;
                $ar[3] = ceil($this -> mEcount / $this -> mResOnPage);
                $ar[4] = $this -> mResOnPage;
                break;
            }

        $gSmarty -> assign('pages', $ar);
        if ($style == 1)
            $gSmarty -> assign('_pagging', $gSmarty -> fetch('mods/_pagging2.tpl'));
        elseif ($style == 2)
            $gSmarty -> assign('_pagging', $gSmarty -> fetch('mods/_pagging3.tpl'));
        return true;

    }#Make2


    public function GetRange()
    {
        $res[0] = ($this -> mPage - 1) * $this -> mResOnPage;
        $res[1] =  $this -> mPage * $this -> mResOnPage;
        if ($res[1] > $this -> mEcount)
            $res[1] = $this -> mEcount;
        return $res;

    }#GetRange

}#end class