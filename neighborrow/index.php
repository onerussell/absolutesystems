<center>
<br>
<?php

$projectpath = getcwd();


function cropImageJPG($src,$dst,$w,$h,$quality) {

    if(!file_exists($src)) return false;

    $size = GetImageSize ($src); 

    if ($size[2] == 2){
        $s = ImageCreateFromJPEG($src);
   	} elseif ($size[2] == 3 )  {
       	$s = ImageCreateFromPNG($src);
   	} else {
       	return false;
   	};

    if ($size[0]*$h/$w > $size[1]){
        $srcW = floor($size[1]/$h*$w);
        $srcH = $size[1];
        $startX = floor(($size[0]-$srcW)/2);
        $startY = 0;
    } else {
        $srcW = $size[0];
        $srcH = floor($size[0]/$w*$h);
        $startX = 0;
        $startY = floor(($size[1]-$srcH)/2);
    };

    $d = ImageCreateTrueColor($w,$h);

    imagecopyresampled($d, $s, 0, 0, $startX, $startY, $w, $h,$srcW,$srcH);
    imageinterlace($d,0);
    imageJPEG($d,$dst,$quality);
    imagedestroy($s);
    imagedestroy($d);
}



	function resize($src, $dst, $max_width, $max_height, $quality) {

    	if(!file_exists($src)) return false;

    	$size = GetImageSize ($src); 

    	if ($size[2] == 2 ) {
        	$s = ImageCreateFromJPEG($src);
    	} elseif ($size[2] == 3 )  {
        	$s = ImageCreateFromPNG($src);
    	} else {
        	return false;
    	};

    	$width = $size[0];
    	$height = $size[1];
    	$x_ratio = $max_width/$width;
    	$y_ratio = $max_height/$height;

    	if (($width <= $max_width) && ($height <= $max_height)) {
       		$tn_width = $width;
       		$tn_height = $height;
    	} else if (($x_ratio*$height) < $max_height) {
       		$tn_width = $max_width;
       		$tn_height = ceil($x_ratio*$height);
    	} else {
       		$tn_width = ceil($y_ratio*$width);
       		$tn_height = $max_height;
    	}


    	$d = ImageCreateTrueColor($tn_width,$tn_height);

    	imageCopyResampled($d, $s, 0, 0, 0, 0, $tn_width, $tn_height,$width,$height);

		imageinterlace($d,0);
    	imageJPEG($d,$dst,$quality);
    	imagedestroy($s);
    	imagedestroy($d);
	}

echo "<table cellpadding='0' cellspacing='2' bgcolor='#CCCCCC'>";
echo "<tr>";
for($i=1;$i<1000;$i++) {

   $path = $projectpath.'/x'.$i;
   $mydir = dir($path);
   while(($file = $mydir->read()) !== false) {

      $filename = explode(".",$file);
      if( ($filename[1] == 'png') OR ($filename[1] == 'jpg')) {
    	if(!file_exists("$projectpath/img/$file")) {
        	cropImageJPG("$path/$file","$projectpath/img/$file",200,150,95);
        }
      	echo '<td><a href="x'.$i.'/"><img src="img/'.$file.'" border="10" style="border-color:#FFFFFF" width="200" height="150" border="0"/></a></td>';
      	$k++;
      	if ($k>3) {echo '</tr><tr>'; $k=0;}
      }
   }
   $mydir->close();
}

echo "</tr>" ;
echo "</table>" ;
?>