<?php
	require_once('../inc/config.inc.php');
    $image = $_GET["image"];
    $width = (float)$_GET["width"];
    $height= (float)$_GET["height"];

	getImage(UPLOAD_DIR.$image, $width, $height);

	function getImage($image, $width, $height)
	{		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");

		$file = explode(".", $image);
		$isPng= (strtolower($file[1]) == "png");
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
		$im_out=  ImageCreatetruecolor($width, $height);
		ImageCopyResampled($im_out, $im_in, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
		if ($isPng)
		{
			ImagePNG($im_out);
		} else
		{			ImageJpeg($im_out, '', 90);
		}
		ImageDestroy($im_in);
		ImageDestroy($im_out);
	}
?>
