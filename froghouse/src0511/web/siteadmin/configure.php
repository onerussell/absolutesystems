<?php
/**
 * Configure Module
 *
 * @package    engine37 Catalog v3.0 SE (PHP 4)
 * @version    0.1 alpha
 * @since      02.01.2006
 * @copyright  2004-2006 engine37 Team
 * @link       http://engine37.com
 */

require 'top.php';

while ( list( $keyx, $valx ) = each( $_REQUEST ) ) 
      {
       $$keyx =$valx;
      }

if (isset($action)) $gSmarty->assign("action",$action);
if (isset($ocid)) $gSmarty->assign("ocid",$ocid);
if (isset($group)) $gSmarty->assign("group",$group);

//-------------------------------------------------
//               action
//-------------------------------------------------
$gSmarty->assign('C_DOMEN',getenv('SERVER_NAME'));

if (@$do==1){

$hw='';
if ((isset($group))and($group<>'')) $hw='?group='.$group;

        if ($action=="edit"){
                if (!isset($_REQUEST['name']))$_REQUEST['name']='Not defined';
                if (!isset($var))$var='Not defined';
                if (!isset($sortid))$sortid='0';
                if (!isset($groupf))$groupf='0';

            if (!isset($ocid))//add
                $gDb->query("insert into ".TB."config(name,var,val,sortid,groupf) values('".addslashes($_REQUEST['name'])."','".$var."','".addslashes($val)."','".$sortid."','".$groupf."')");
            else//edit 
                $gDb->query("update ".TB."config set name='".addslashes($_REQUEST['name'])."', var='".$var."', val='".addslashes($val)."', sortid='".$sortid."', groupf='".$groupf."' where ocid=".$ocid);

         SaveConfig();

        }elseif ($action=="del"){
            if ( (isset($ocid))and(@$ocid<>'') )
               {
                $gDb->query("delete from ".TB."config where ocid=".$ocid);
                SaveConfig();
               }

        }
//------------------------------
        elseif ( ($action=="editgroup") and (isset($_REQUEST['name'])) and (isset($fname)) ){       
        if ($_REQUEST['name']=='')$_REQUEST['name']='Not defined';
        if ($fname=='')$fname='def';

        if ((isset($group))and($group<>'')) $gDb->query('update '.TB.'config_g set name="'.$_REQUEST['name'].'", fname="'.$fname.'" where id='.$group);  
        else $gDb->query('insert into '.TB.'config_g (name, fname) values ("'.$_REQUEST['name'].'", "'.$fname.'")'); 

        SaveConfig();

        }elseif (($action="delgroup")and(isset($group))){
            $gDb->query('delete from '.TB.'config where groupf='.$group); 
            $gDb->query('delete from '.TB.'config_g where id='.$group); 
            $hw='';
            SaveConfig();
        }
        
        $url=glinka('configure.php'.$hw); 
        header("Location: $url");
}
//-------------------------------------------------
//               show FORM
//-------------------------------------------------

if (isset($action) && ($action=="edit" || $action=='del') && isset($ocid)){
    
        $db=$gDb->query("select name,val, var, sortid, groupf from ".TB."config where ocid=".$ocid); 
        $val=array();
        if ($db -> numRows()>0){
        $row=$db -> fetchRow();
        $row['name']=stripslashes($row["name"]);
        $row['val']=stripslashes($row["val"]);      }
        $gSmarty->assign('info', $row);

}elseif ((@$action=='editgroup')and((isset($group))and($group<>''))){
        $db=$gDb->query("select name, fname from ".TB."config_g where id=".$group);
        if ($db -> numRows()>0){
            $row=$db -> fetchRow();
            $gSmarty->assign('name',$row['name']);
            $gSmarty->assign('fname',$row['fname']);
        }   
}

//-------------------------------------------------
//               FREE OUTPUT
//-------------------------------------------------


$gv='where groupf="-1"';
$gar=array();
if ((isset($group))and($group<>'')){
 $gv='where groupf='.$group;
 $db=$gDb->query('select name, fname from '.TB.'config_g where id='.$group);
if ($db -> numRows()>0){
 $row=$db -> fetchRow();
            $gSmarty->assign('name_',$row['name']);
            $gSmarty->assign('fname',$row['fname']);
}
}
//----------------
    $db=$gDb->query("select id, name, fname from ".TB."config_g ORDER BY name ASC");
    if ($db -> numRows()>0)
        while ($row=$db -> fetchRow()){
            $ar=array("id"=>$row["id"],"name"=>$row["name"],"fname"=>$row["fname"]);
            array_push($gar,$ar);
        }


$gSmarty->assign('gar',$gar);

    $db=$gDb->query("select ocid, name, var, val, sortid from ".TB."config ".$gv." order by sortid");
$show_ar=array();
    if ($db -> numRows()>0){
        while ($row=$db -> fetchRow())
            $show_ar[]=array("ocid"=>$row["ocid"],"name"=>$row["name"],"var"=>$row["var"],"val"=>stripslashes($row["val"]), "sortid"=>$row["sortid"]);
    $gSmarty->assign("show_ar",$show_ar);
   }

//compile templates-------------------------------------

$main_content = $gSmarty -> fetch('mods/Configure.tpl');
$gSmarty->assign_by_ref('main_content',$main_content);
$gSmarty->display('main_template.tpl');

require 'bottom.php';

function glinka($str)
    {
     return $str;
    }

function SaveConfig()
    {
     global $gDb;
     if ($fh = fopen(BPATH.'/siteadmin/includes/config/generated.php', 'w'))
        {
         $txt = '<?php'."\n";
         $dbout = $gDb->query("select c.var, c.val from ".TB."config c, ".TB."config_g cg where c.groupf=cg.id");
         if (0 < $dbout -> numRows())
            {
             while ($row = $dbout -> fetchRow())
                   {
                    $va = explode('|', $row['val']);
                    $va = StripSlashes($va[0]);
                    $va = str_replace("'","\\'",$va);
                    if (is_numeric($va) && strlen($va) < 9)
                       $txt .= 'define(\''.AddSlashes($row['var']).'\', '.$va.');'."\n";
                     else
                       $txt .= 'define(\''.AddSlashes($row['var']).'\', \''.$va.'\');'."\n";
                   }
             fwrite($fh, $txt);
             fclose($fh);
            }
         $txt = '?>';
        }
     else 
       die('Access denied for config file \'generated.php\'');
    }
?>