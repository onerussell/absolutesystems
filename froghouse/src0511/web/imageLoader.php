<?php
	define("UPLOAD_DIR",$_SERVER['DOCUMENT_ROOT'].'/sandbox/thefroghouse/includes/data/gallery/');


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
				if (isset($_GET["xP"])) {$xP = $_GET["xP"]; } else {$xP=0;}
				if (isset($_GET["yP"])) {$yP = $_GET["yP"]; } else {$yP=0;}
  	            
				getImage(UPLOAD_DIR.$img, $w1, $h1, $w2, $h2, $xP, $yP);		
				break;	
	}

	function getImagesSize($images){
		ob_start();

		header ("Content-type: text/xml");	
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$outputStr .= "<Images>";		
		$count = count($images);
		for ($i=0; $i<$count; $i++) {

			$size = GetImageSize(UPLOAD_DIR.$images[$i]);
			$outputStr .= "<Item " . $size[3] . "/>";
		}
		
		$outputStr .= "</Images>";		 
		echo($outputStr);
		ob_end_flush();

	}          
  
	
	function getImage($img, $w1, $h1, $w2, $h2, $xP, $yP){
            header ("Content-type: image/jpeg");	
               
            $size = GetImageSize($img);
            $x = $xP * $size[0] /100;             
            $y = $yP * $size[1] /100;

            $im_in = ImageCreateFromJPEG($img);
            $im_out = ImageCreateTrueColor($w1, $h1);
            ImageCopyResampled($im_out, $im_in, 0, 0, $x, $y, $w2, $h2, $size[0], $size[1]);
            ImageJpeg($im_out);

            ImageDestroy($im_in);            
            ImageDestroy($im_out);	

	}   
?>
