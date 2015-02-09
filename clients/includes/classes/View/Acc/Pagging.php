<?php
/**
 * Pagging class - Make pages list
 *
 * @package    5dev catalog 3.1
 * @version    1.0
 * @since      12.03.2006
 * @copyright  2006 5dev Team
 * @link       http://5dev.com
 */

class Pagging
{
    private $mResOnPage; //Results on page
    private $mEcount;    //Count of elements
    private $mPageLink;  //Link for pages
    private $mPage;      //Current page
    private $mPageMax;   //Max pagging items on page

    public function __construct($ResOnPage  = 10, $Ecount = 0, $page = 1, $link = '')
    {
        $this -> mResOnPage     =  $ResOnPage;
        $this -> mEcount        =  $Ecount;
        $this -> mPageLink      =  $link;
        $this -> mPageMax       =  8; 
        
        if (!is_numeric($page) || $page == 0)
        {
            $page = 1;
        }    
        $this -> mPage          = $page;
    }#Pagging


    public function &Make()
    {
        $pages = '';
        if ($this -> mEcount < $this -> mResOnPage || $this -> mResOnPage == 0)
        {
            return $pages;
        }
        global $gSmarty;

        $range    = $this -> GetRange();
        $range[]  = $this -> mEcount;
        $gSmarty -> assign('range', $range);
        $gSmarty -> assign('page' , $this -> mPage);

        $link = $this -> mPageLink;
        $link .=  ( strpos($link, '?') > 0 ) ? '&' : '?';
        #make list
        $k   = 0;
        $i   = 1;
        $res = array();

        $fl = 1;
        $lr = 8;  
        if (($this -> mEcount / $this -> mResOnPage) > $this -> mPageMax && $this -> mPage >= $this -> mPageMax - 1)
        {
        	if (floor(($this -> mPage + 1) / $this -> mPageMax) == (($this -> mPage + 1) / $this -> mPageMax))
        	{
        		$fl = $this -> mPage - ($this -> mPageMax / 2);
        		$lr = $this -> mPage + $this -> mPageMax - ($this -> mPageMax / 2); 
        	}
        	else 
        	{
                $fl = floor($this -> mPage / $this -> mPageMax) * $this -> mPageMax  - 1;
                if ($this -> mPage < $fl + ($this -> mPageMax / 2) - 1)
                {
                	$fl = $fl - ($this -> mPageMax / 2);
                }
                $lr = $fl + $this -> mPageMax;   		
        	}
        }
        if ($this -> mPage > 1/*$this -> mPageMax*/)
        {
        	$gSmarty -> assign('lfirst', $link.'page=1');
        }
        if ($this -> mPage < ceil($this -> mEcount / $this -> mResOnPage))
        {
        	$gSmarty -> assign('llast', $link.'page='.ceil($this -> mEcount / $this -> mResOnPage));
        }

               
        while ($k < $this -> mEcount)
        {
            if ($i > $lr)
            {
            	break;
            }
            if ($i >= $fl && $i <= $lr)
            {
        	    $res[] =  array('page' => $i, 'link' => $link.'page='.$i);
            }    
            $k     += $this -> mResOnPage;
            $i ++;
        }
        $gSmarty -> assign('pages', $res);
        $pages = $gSmarty -> fetch('mods/_pagging.html');
        return $pages;

    }#Make

    /* 
    public function Make2($mm = 0, $page = 0, $linkname = '',$maxp = 5, $oshow = 5, $pagev = 'page')
    {
        $linkname .= (strpos($linkname,'?') > 0) ? '&' : '?';

        $tpg = '';
        $stl   = '';    
        $fm    = floor((($page + 1) / $maxp) / $oshow) * $oshow * $maxp;
        $fall  = ($oshow * $maxp + $fm);
        
        if ($mm > $maxp)
        {
            $k   = 1;
            $ff  = 0;
            $lst = (strpos(($mm/$maxp), '.') > 0) ? floor($mm/$maxp) * $maxp : (($mm/$maxp)-1) * $maxp;
            $om  = $fm - $maxp;
            $tnm = ($om / $maxp)+1;
            
            if ($om > 0)
            {
                $stl.= '<td class="black" align="center" bgcolor="#edeef0" width="15"><a href="'.$linkname.$pagev.'=0" class="page">&larr;&nbsp;</a></td>';
                $stl.=  '<td class="black" align="center" bgcolor="#edeef0" width="15"><a href="'.$linkname.$pagev.'='.$om.'" class="page">'.$tnm.'</a></td>';
            }
            while ($mm > 0)
            {
                $mel = ($k * $maxp) - 1;
                if ($mel >= $fm && $ff < $fall)
                {
                    if ( (($ff == $page || $ff==0) && $page == 0) && $tpg != 'all' )
                    {
                        $stl .=  '<td align="center" bgcolor="#ff6666" width="15"><font color="#ffffff"><b>'.$k.'</b></font></td>';
                    }
                    else
                    {
                        $stl.=  '<td class="black" align="center" bgcolor="#edeef0" width="15"><a href="'.$linkname.$pagev.'='.$ff.'">'.$k.'</a></td>';
                    }
                }
                $mm  = $mm - $maxp;
                $ff  = $ff + $maxp;
                $k   ++;
                $mel ++;
                if ($mel == $fall && $mel <= $lst)
                {
                    $stl .=  '<td class="black" align="center" bgcolor="#edeef0" width="15"><a href="'.$linkname.$pagev.'='.$ff.'">'.$k.'</a></td>';
                    $stl .=  '<td class="black" align="center" bgcolor="#edeef0" width="15"><a href="'.$linkname.$pagev.'='.$lst.'">&nbsp;&rarr;</a></td>';
                }
             }
        }
        else
        {
            $stl.= '<td align="center" bgcolor="#ff6666" width="15"><font color="#ffffff"><b>1</b></font></td>';
        }
        $stl = '<table border="0" cellpadding="5" cellspacing="5">
                <tr>
                '.$stl.'
                </tr>
                </table>';
        return $stl;
    }#Make2
    */
    
    public function &GetRange()
    {
        $res[0] = ($this -> mPage - 1) * $this -> mResOnPage;
        $res[1] =  $this -> mPage * $this -> mResOnPage;
        if ($res[1] > $this -> mEcount)
            $res[1] = $this -> mEcount;
        return $res;

    }#GetRange
       
}#end class