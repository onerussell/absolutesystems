<?php
    require_once('inc/config.inc.php');
	error_reporting('E_ALL');
	ini_set('display_errors', 1);

    $image = $_GET["image"];
    $width = round($_GET["width"]);
    $height= round($_GET["height"]);

	getImage($image, $width, $height);

	function getImage($image, $maxWidth, $maxHeight)
	{
	
	//filter input
	$baseName = basename($image);
	$image = UPLOAD_DIR . $baseName;

	
	$file = explode(".", $baseName);
	$isPng= (strtolower($file[1]) == "png") ? true : false;

	if ($isPng)
	{
		header ("Content-type: image/png");
		$im_in = ImageCreateFromPNG($image);
	} else
	{
		header ("Content-type: image/jpeg");
		$im_in = ImageCreateFromJPEG($image);
	}

	$size = GetImageSize($image);
    $width      = $size[0];
	$height     = $size[1];
			
    $im_out     =  ImageCreatetruecolor($maxWidth, $maxHeight);
    ImageCopyResampled($im_out, $im_in, 0, 0, 0, 0, $maxWidth, $maxHeight, $width, $height);

	if ($isPng)
	{
		ImagePNG($im_out);
	} else {

		ImageJpeg($im_out);

	}

	ImageDestroy($im_in);
	ImageDestroy($im_out);
}	
?>
