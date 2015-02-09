<?

    require_once('config.inc.php');
//	require_once(INC_DIR.'dbinit.php');
//	require_once(INC_DIR.'checkUser.php');
	require_once('no-cache.php');

	$folder = UPLOAD_DIR;

	$action = (int)$_GET["action"];
	switch($action) {
		case 1: //Get images size
				$images = split(",", $_GET["images"]);
			    getImagesSize($images, $folder);
				break;
		case 2: //Get image
	            $img = $_GET["img"];
	            $w1 = (float)$_GET["w1"];
	            $h1 = (float)$_GET["h1"];         
	            $w2 = (float)$_GET["w2"];
	            $h2 = (float)$_GET["h2"];                     
				$xP = (float)$_GET["xP"];         
				$yP = (float)$_GET["yP"];  	            
				getImage($folder.$img, $w1, $h1, $w2, $h2, $xP, $yP);		
				break;
		case 3: //Rotate image
	            $img = $_GET["img"];
	            $angle = (int)$_GET["angle"];	            		
				rotateImageOnAngle($folder.$img, $angle);
				break;		
		case 4: //Upload image

				$filename = $_GET["imgName"];		
				$file = $_FILES['Filedata'];
				saveFile($folder.$filename, $file);				
				break;							
		case 5: //Delete image
	            $img = $_GET["img"];		
				deleteFile($folder.$img);					            
				break;		
	}
	
	function deleteFile($filename){
		header ("Content-type: text/xml");	
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	
		if (file_exists($filename)) {
			if (unlink($filename)) {
				$result =  1;
				$messageError = "";
			} else {
				$result =  0;
				$messageError = "There has been a server error.";			
			}
		} else {
			$result =  0;
			$messageError = "File not found.";						
		}
		$outputStr .= "<data><call result=\"" . $result . "\" >" . $messageError . "</call></data>";				
		echo($outputStr);
	}
	
	function saveFile($filename, $file){

		if (move_uploaded_file($file["tmp_name"], $filename)) {      
			$result =  0;
			$messageError = ""; 
			error_log("upload ok");					
		} else {
			$result =  1;
			$messageError = "cannot move file to destination"; 
			error_log($messageError); exit();
		}
	
	    require_once(INC_DIR.'resizeImage.php');
	    resizeImage($filename,$filename,1024,768,95);

		header ("Content-type: text/xml");	
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";		
		$outputStr .= "<data><call result=\"" . $result . "\" >" . $messageError . "</call></data>";				
	}
	
	function getImagesSize($images, $folder) {
		header ("Content-type: text/xml");	
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$outputStr .= "<data>";		

		$imagesStr .= "<images>";
		foreach($images as $image) {	
	
			if (($image) && (file_exists($folder.$image))) {
				$size = GetImageSize($folder.$image);
				$imagesStr .= "<item name=\"" . $image ."\" " . $size[3] . "/>";
			}
		}

		$imagesStr .= "</images>";						
		
		$outputStr .= "<call result=\"1\" >" . $imagesStr ."</call>";		
		$outputStr .= "</data>";		 
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
            ImageJpeg($im_out, '', 80);
            ImageDestroy($im_in);            
            ImageDestroy($im_out);	
	} 	
	
	function rotateImageOnAngle($img, $angle){
	    require_once(INC_DIR.'rotateImage.php');
		$source = ImageCreateFromJPEG($img);

		if ($angle==-90) $angle = 270;

        $rotate = ImageRotateRightAngle($source, $angle);

		ImageJpeg($rotate, $img, 100);
		$size = GetImageSize($img);
				
		header ("Content-type: text/xml");			
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$outputStr .= "<Images>";		
		$outputStr .= "<Item " . $size[3] . "/>";		
		$outputStr .= "</Images>";		 
		echo($outputStr);			
	}
?>
