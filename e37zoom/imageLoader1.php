<?php
	$action = $_GET["action"];
	switch($action) {
		case 1: //Get images size
				$images = split(",", $_GET["images"]);
				getImagesSize($images);
				break;
		case 2: //Get image
	            $img = $_GET["img"];
	            $w1 = (float)$_GET["w1"];
	            $h1 = (float)$_GET["h1"];         
	            $w2 = (float)$_GET["w2"];
	            $h2 = (float)$_GET["h2"];                     
				$xP = (float)$_GET["xP"];         
				$yP = (float)$_GET["yP"];  	            
				getImage($img, $w1, $h1, $w2, $h2, $xP, $yP);		
				break;	
	}

	function getImagesSize($images){
		ob_start();

		header ("Content-type: text/xml");	
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$outputStr .= "<Images>";		
		$count = count($images);
		for ($i=0; $i<$count; $i++) {
			$size = GetImageSize($images[$i]);
			$outputStr .= "<Item " . $size[3] . "/>";
		}
		
		$outputStr .= "</Images>";		 
		echo($outputStr);
		ob_end_flush();

	}          
  
	
	function getImage($img, $w1, $h1, $w2, $h2, $xP, $yP){




require_once 'Image/Transform.php';

define('IMAGE_TRANSFORM_IM_PATH', '/usr/local/bin/'); 
$a = Image_Transform::factory('IM');
// factory pattern - returns an object
$a->load($img);
// load the image file
//$a->scalebyPercentage(80);
// scale image by percentage - 40% of its original size
//$a->display('JPG',80);
$a->free();


	}   
?>
