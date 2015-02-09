<?php
	//session_start();
	//for data-grid
	require_once('../inc/config.inc.php');
    //require_once(DIR_INC.'valid_sess.php');
	
	$maxWidth = 160;//(int)$_GET["width"];
	$maxHeight = 100;//(int)$_GET["height"];	
	
	$image = $_GET["image"];
	$size = GetImageSize(DIR_UPLOAD.$image);
		
	$maxWidth = min($maxWidth, $size[0]);
	$maxHeight = min($maxHeight, $size[1]);
	$scale = min($maxWidth / $size[0], $maxHeight / $size[1]);
		
	$width = (int)$size[0] * $scale; 
	$height	= (int)$size[1] * $scale; 
	    
	header ("Content-type: image/jpeg");	               
	$im_in = ImageCreateFromJPEG(DIR_UPLOAD.$image);
	$im_out = ImageCreatetruecolor($width, $height);
	ImageCopyResampled($im_out, $im_in, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
	ImageJpeg($im_out);
	ImageDestroy($im_in);            
	ImageDestroy($im_out);
?>
