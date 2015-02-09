/**
 * Class encapsulate various static methods for work with files
 *
 * @package    engine37 Catalog v3.0
 * @version    1.2b
 * @since      04.04.2006
 * @copyright  2004-2006 engine37.com
 * @link       http://engine37.com
 */
function sort_files_by_date($a, $b)
{
    if ($a['time']==$b['time'])
       return 0;

    return ($a['time'] > $b['time']) ? 1 : -1;
}

class Storage
{
    public static function ReduceDirByMatch($dname,$fmatch)
    {
        $matches = array();
       
        if (preg_match('/^(.+?)\/$/',$dname,$matches))
           $dname = $matches[1];
       
        if ($dh = opendir($dname))
        {
            while (false !== ($file = readdir($dh)))
            {
                $fname=$dname .'/'. $file;
                if (is_file($fname) && preg_match($fmatch,$file))
                   @unlink($fname);
            }
        }
        else
          return false;
    }

    public static function GenerateImages($SIZES, $docPath, $image, $image_ext)
    {
        $new_img = $docPath.$image.'.'.$image_ext;

        $size = getimagesize($new_img);

        if ($size)
        {
            $width  = $size[0];
            $height = $size[1];
           
            $sizes = preg_split('/;/',$SIZES,-1,PREG_SPLIT_NO_EMPTY);
            $cnt   = count($sizes);
           
            $img =& new Image_Transform_Driver_GD();
           
            for ($i = 0; $i < $cnt; $i++)
            {
                $img -> load($new_img);
           
                $matches = array();
                if (preg_match('/^(\d+)x(\d+)$/', $sizes[$i], $matches))
                {
                   $w = $matches[1];
                   $h = $matches[2];
            
                   if (($w > $h && $width < $height)||($w < $h && $width > $height))
                   {
                       $wx = $h;
                       $hx = $w;
                   }
                   else
                   {
                       $wx = $w;
                       $hx = $h;
                   }
            
                   if ($width < $wx || $height < $hx)
                      continue;
            
                   $crop_height = ($width*$hx)/$wx;
                   if ($crop_height > $height) // crop by width
                   {
                       $crop_width  = ($height*$wx)/$hx;
                       $crop_height = $height;
                       $img -> crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                   }
                   else // árop by height
                   {
                       $crop_width  = $width;
                       $img -> crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                   }
           
                   $res_img = $docPath.$image.'_'.$sizes[$i].'.'.$image_ext;
                   $img -> save($res_img);
                   $img -> load($res_img);
                   if ($img -> resize($wx, $hx));
                       $img -> save($res_img);
                }
            }
        }
    }

    public static function GetDirSize($dname)
    {
        if ($dh = opendir($dname))
        {
            $size = 0.0;
            while (false !== ($file = readdir($dh)))
            {
                $fname = $dname .'/'. $file;
                if (is_file($fname))
                {
                    $csize=sprintf('%u', filesize($fname));
                    $size+=(double)$csize;
                }
            }
            return $size;
        }
         else
          return false;
    }

    // Comment: delete old files
    public static function ReduceDirToSize($dname,$endsize)
    {
        if ($dh = opendir($dname))
        {
            $farr = array();
            $size = 0.0;
            while (false !== ($file = readdir($dh)))
            {
                $fname=$dname .'/'. $file;
                if (is_file($fname))
                {
                    $csize=sprintf('%u', filesize($fname));
                    $farr[]=array('name'=>$fname,'time'=>filemtime($fname),'size'=>$csize);
                    $size+=(double)$csize;
                }
            }

            if ($size <= $endsize)
              return true;
            
            usort($farr,'sort_files_by_date');
            $cnt=count($farr);
            $k=0;
            for($i=0;($i<$cnt)&&($size>$endsize);$i++)
            {
                $k++;
                echo 'delete -> '.$farr[$i]['name'].'<br />';
                //unlink($farr[$i]['name']);
                $size-=(double)$farr[$i]['size'];
            }
            // echo $k.' files have been deleted (total '.$cnt.' files)';
            return true;
        }
        else
          return false;
    }

    public static function &ShowDir($dname)
    {
        if ($dh = opendir($dname))
        {
            $farr=array();
            while (false !== ($file = readdir($dh)))
            {
                  $fname=$dname .'/'. $file;
                  if (is_file($fname))
                     $farr[]=array('name'=>$fname,'time'=>filemtime($fname),'size'=>sprintf('%u', filesize($fname)));
            }
            usort($farr,'sort_files_by_date');
            echo '<html><body><table border="1">';
            for($i=0;$i<count($farr);$i++)
            {
               echo '<tr><td><b>'.$farr[$i]['name'].'</b></td><td>'.date('d-m-y H:i:s', $farr[$i]['time']).'<td>'.$farr[$i]['size'].'</td>';
            }
            echo '</table></body></html>';
            return $farr;
        }
        else
          return false;
       }

    public static function UploadOne($field,$path,$randomname=false,$move=true, $ext=false)
    {
        if (is_array($field))
        {
            $key=$field[1];
            $field=$field[0];
            if (empty($_FILES[$field]['tmp_name'][$key]))
               return '';
            
            if (preg_match('/\.(\w{1,5})$/',basename($_FILES[$field]['name'][$key]),$matches))
            {
               $ext  = '.'.$matches[1];
               $extx = $matches[1];
            }
            else
               $ext='';
            
            if ($randomname==false)
               $fname=basename($_FILES[$field]['name'][$key]);
            else
            {
                $matches=array();
                $fnamex = preg_replace('/\./','',GetMTime());
                $fname  = $fnamex.$ext;
            }
            
            $uploadfile = $path . $fname;
            if ($move)
            {
                if (move_uploaded_file($_FILES[$field]['tmp_name'][$key], $uploadfile))
                {
                    if ($ext)
                       return array($fnamex, $extx);
                     else
                       return $fname;
                }
                else
                  return '';
            }
            else
            {
               if (copy($_FILES[$field]['tmp_name'][$key], $uploadfile))
               {
                   if ($ext)
                     return array($fnamex, $extx);
                    else
                     return $fname;
               }
               else
                  return '';
            }
        }
        else
        {
           if (empty($_FILES[$field]['tmp_name']))
              return '';
     
           if (preg_match('/\.(\w{1,5})$/',basename($_FILES[$field]['name']),$matches))
           {
               $ext  = '.'.$matches[1];
               $extx = $matches[1];
           }
           else
               $ext='';

           if ($randomname==false)
              $fname=basename($_FILES[$field]['name']);
           else
           {
               $matches=array();
               $fnamex = preg_replace('/\./','',GetMTime());
               $fname  = $fnamex.$ext;
           }

           $uploadfile = $path . $fname;
           if ($move)
           {
              if (move_uploaded_file($_FILES[$field]['tmp_name'], $uploadfile))
              {
                  if ($ext)
                    return array($fnamex, $extx);
                   else
                    return $fname;
              }
              else
                 return '';
           }
           else
           {
               if (copy($_FILES[$field]['tmp_name'], $uploadfile))
               {
                   if ($ext)
                     return array($fnamex, $extx);
                    else
                     return $fname;
               }
               else
                 return '';
           }
        }
    }
}
