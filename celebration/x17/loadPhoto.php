<?php
	$image		= $_GET["image"];
	$size		= GetImageSize("images/".$image);
	
	$maxWidth	= (float)$_GET["width"];
	$maxHeight	= (float)$_GET["height"];	
	//echo $image;
	
	$maxWidth	= min($maxWidth, $size[0]);
	$maxHeight	= min($maxHeight, $size[1]);
	$scale		= min($maxWidth / $size[0], $maxHeight / $size[1]);
	
	$width		= (int)$size[0] * $scale; 
	$height		= (int)$size[1] * $scale; 
    
	 header ("Content-type: image/jpeg");	               
     $im_in = ImageCreateFromJPEG("images/".$image);
     $im_out=  ImageCreatetruecolor($width, $height);
     ImageCopyResampled($im_out, $im_in, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
     ImageJpeg($im_out);
     ImageDestroy($im_in);            
     ImageDestroy($im_out);
?>
