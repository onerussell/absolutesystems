<?php
	session_start();
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	require_once('../inc/config.inc.php');
	//require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
	
	$action = (int)$_GET["action"];
	switch($action) {
		case 1: //Get images size
				$images = split(",", $_GET["images"]);
				getImagesSize($images, DIR_UPLOAD);	
				break;
		case 2: //Get image
	            $img = $_GET["img"];
	            $w1 = (float)$_GET["w1"];
	            $h1 = (float)$_GET["h1"];         
	            $w2 = (float)$_GET["w2"];
	            $h2 = (float)$_GET["h2"];                     
				$xP = (float)$_GET["xP"];         
				$yP = (float)$_GET["yP"];  	            
				getImage(DIR_UPLOAD.$img, $w1, $h1, $w2, $h2, $xP, $yP);		
				break;
		case 3: //Rotate image
	      $angle = (int)$_GET["angle"];	            		
				$img = basename($_GET['img']);
				$val_dilerID = split("_", $img);
				$diler_id = $_SESSION['diler_id'];
	     
			  if ($val_dilerID[0] == $diler_id) rotateImageOnAngle(DIR_UPLOAD.$img, $angle);
			  else setMessageError(NULL, "You have no rights to rotate this picture");
			 break;  
					
		case 4: //Upload image
				$filename = basename($_GET['imgName']);
		    list($width, $height, $type, $attr) = getimagesize($_FILES['Filedata']['tmp_name']);
		    if (!isset($_FILES['Filedata'])) setMessageError(NULL, "D'nt upload file");
				else if ($type != 2) setMessageError(NULL, "incorrect type of the file"); 
				else if ($_FILES['Filedata']['error'] == 1) setMessageError(1, "The uploaded file exceeds the max filesize"); 
				else if ($_FILES['Filedata']['error'] == 0)	saveFile(DIR_UPLOAD.$filename, $_FILES['Filedata']);
				break;							
		case 5: //Delete image
				
				$img = basename($_GET['img']);
				$val_dilerID = split("_", $img);
				$diler_id = $_SESSION['diler_id'];
	     
			  if ($val_dilerID[0] == $diler_id) deleteFile(DIR_UPLOAD.$img);
			  else setMessageError(NULL, "You have no rights to removal of this picture");
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
		
		move_uploaded_file($file['tmp_name'], $filename);
		unlink($file['tmp_name']);
		 
							
	}
	
	function getImagesSize($images, $folder){
		header ("Content-type: text/xml");	
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$outputStr .= "<data>";		

		$imagesStr .= "<images>";				
		$count = count($images);
		for ($i=0; $i<$count; $i++) {
			if (file_exists($folder.$images[$i])){
				$size = GetImageSize($folder.$images[$i]);
				$imagesStr .= "<item name=\"" . $images[$i] ."\"" . $size[3] . "/>";
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
            ImageJpeg($im_out, '', 100);
            ImageDestroy($im_in);            
            ImageDestroy($im_out);	
	} 	
	
	function rotateImageOnAngle($img, $angle){
	    require_once('inc/rotateImage.php');
		$source = ImageCreateFromJPEG($img);

		if ($angle==-90) $angle = 270;
        $rotate = ImageRotateRightAngle($source, $angle);
		copy($rotate, $img);

		ImageJpeg($rotate, $img, 100);
		$size = GetImageSize($img);
				
		header ("Content-type: text/xml");			
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$outputStr .= "<Images>";		
		$outputStr .= "<Item " . $size[3] . "/>";		
		$outputStr .= "</Images>";		 
		echo($outputStr);			
	}
	function setMessageError($result, $messageError){
		header ("Content-type: text/xml");	
		$outputStr = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";		
		$outputStr .= "<data><call result=\"" . $result . "\" >" . $messageError . "</call></data>";

	}
	
	
?>
