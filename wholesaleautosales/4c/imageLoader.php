<?php
	$action = $HTTP_GET_VARS["action"];
	switch($action) {
		case 1: //Get images size
				$images = split(",", $HTTP_GET_VARS["images"]);
				getImagesSize($images);
				break;
		case 2: //Get image
	            $img = $HTTP_GET_VARS["img"];
	            $w1 = (float)$HTTP_GET_VARS["w1"];
	            $h1 = (float)$HTTP_GET_VARS["h1"];         
	            $w2 = (float)$HTTP_GET_VARS["w2"];
	            $h2 = (float)$HTTP_GET_VARS["h2"];                     
				$xP = (float)$HTTP_GET_VARS["xP"];         
				$yP = (float)$HTTP_GET_VARS["yP"];  	            
				getImage($img, $w1, $h1, $w2, $h2, $xP, $yP);		
				break;	
	}

	function getImagesSize($images){
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
	}          
  
	
	function getImage($img, $w1, $h1, $w2, $h2, $xP, $yP){
            header ("Content-type: image/jpeg");	
               
            $size = GetImageSize($img);
            $x = $xP * $size[0] /100;             
            $y = $yP * $size[1] /100;

            $im_in = ImageCreateFromJPEG($img);
            $im_out=  ImageCreatetruecolor($w1, $h1);
            ImageCopyResampled($im_out, $im_in, 0, 0, $x, $y, $w2, $h2, $size[0], $size[1]);
            ImageJpeg($im_out,null,100);
            ImageDestroy($im_in);            
            ImageDestroy($im_out);	
	}   
?>
