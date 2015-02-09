<?php
	require_once('e37uploader_at.cfg.php');

	
    # Session config and initialization
    if (defined('SESSION_SAVE_PATH') && '' != SESSION_SAVE_PATH)
    {
        session_save_path('files/sessions');
    }
    
    if (defined('SESSION_NAME') && '' != SESSION_NAME && 'PHPSESSID' != SESSION_NAME)
    {    
        session_name(SESSION_NAME);
        $session_name = SESSION_NAME;
    }  
   
	//----------------------------------------------------------------------

    session_start();

   	$action = $_POST['action'];
   	switch($action)
   	{
   		case 'getProfile':	getProfile();
   			break;
   		case 'upload':		upload($_POST["index"], $_FILES['Filedata']['name'], $_FILES['Filedata']);
   			break;
   	}

    function getProfile()
    {
    	$str = '';
    	$str .=	'<profile>';
    	$str .=		'<allowMultipleSelection value="' . ALLOW_MULTIPLE_SELECTION . '"/>';
    	$str .=		'<maximumFileSize value="' . MAXIMUM_FILESIZE. '"/>';
    	$str .=		'<maximumFileCount value="' . MAXIMUM_FILECOUNT. '"/>';
        $str .=		'<urlAfterUpload value="' . URL_AFTER_UPLOAD. '"/>';
        $str .=		'<transferRate value="' . TRANSFER_RATE. '"/>';
        $str .=		'<estimatedTime value="' . ESTIMATED_TIME. '"/>';
        $str .=		'<targetAfterUpload value="' . TARGET_AFTER_UPLOAD. '"/>';
        $str .=		'<fileFilter value="' . FILE_FILTER. '"/>';
        $str .=		'<urlVars value="'.SESSION_NAME.'=' . session_id() . '"/>';
    	$str .=	'</profile>';

    	outputResult($str);
    }

 	function upload($index, $fileName, $file)
 	{
 		global $ext_ar, $im_ar;
 		$result = $file["error"];
		$message= "";
		switch ($result)
		{
		   case UPLOAD_ERR_OK:
		       break;
		   case UPLOAD_ERR_INI_SIZE:	$message = "The uploaded file exceeds the upload_max_filesize directive (".ini_get("upload_max_filesize").") in php.ini.";
		       break;
		   case UPLOAD_ERR_FORM_SIZE:	$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
		       break;
		   case UPLOAD_ERR_PARTIAL:		$message = "The uploaded file was only partially uploaded.";
		       break;
		   case UPLOAD_ERR_NO_FILE:		$message = "No file was uploaded.";
		       break;
		   case UPLOAD_ERR_NO_TMP_DIR:	$message = "Missing a temporary folder.";
		       break;
		   case UPLOAD_ERR_CANT_WRITE:	$message = "Failed to write file to disk";
		       break;
		   default:						$message = "Unknown File Error";
		}

       	if ($result == UPLOAD_ERR_OK)
       	{
			$ofilename = $fileName;
		    $fileName = (RANDOM_NAME) ? ("" . time() . rand(11, 99). strrchr($file["name"], ".")) : $fileName;

            $ext =  str_replace('.', '', strrchr($file["name"], "."));		    
		    if(is_uploaded_file($file["tmp_name"]) && in_array($ext, $ext_ar))
	 		{
	 			if (in_array($ext, $im_ar))
	 			{    
	 				i_crop_copy(1000, 100000, $file["tmp_name"], UPLOAD_DIR.'/'. $fileName, 2);
	 				addUploadItem($index, $fileName, $ofilename);
	 				echo("result=1&fileName=$fileName");
	 			}
	 			elseif (move_uploaded_file($file["tmp_name"], UPLOAD_DIR.'/'. $fileName))
				{
					addUploadItem($index, $fileName, $ofilename);
					echo("result=1&fileName=$fileName");
				} 
				else
				{
					$er = error_get_last();
					echo("result=0&message=" . $er["message"]);
				}
			}
			else
			{
				$er = error_get_last();
				echo("result=0&message=" . $er["message"]);
			}
		} else
		{
             echo("result=0&message=" . $message);
		}
	}

	function clearUploadData()
	{
       $_SESSION['upload_data'] = array();
	}

	function addUploadItem($index, $item, $oitem)
	{
	    $_SESSION['upload_str']  = ($index == 0) ? '' : $_SESSION['upload_str'] . ',';
	    $_SESSION['upload_str'] .= $item;
	    $_SESSION['upload_data'][] = array($item, $oitem);
		saveLog("addUploadItem - " . count($_SESSION['upload_data']));
	}

	function outputResult($messsage)
	{
		header("Content-type: text/xml");
		$str = '<?xml version="1.0"?>';

		$str .=	'<data>';
		$str .=		'<call result="1">';
		$str .=			$messsage;
		$str .=		'</call>';
		$str .=	'</data>';

		echo($str);
	}

	function outputError($messsage)
	{
		header("Content-type: text/xml");
		$str = '<?xml version="1.0"?>';

		$str .=	'<data>';
		$str .=		'<call result="0">';
		$str .=			'<error>';
		$str .=				$messsage;
		$str .=			'</error>';
		$str .=		'</call>';
		$str .=	'</data>';

		echo($str);
	}

	function actionNotFound()
	{
		header("Content-type: text/xml");
		$str = '<?xml version="1.0"?>';

		$str .=	'<data>';
		$str .=		'<call result="0">';
		$str .=			'<error>';
		$str .=				'Action not found';
		$str .=			'</error>';
		$str .=		'</call>';
		$str .=	'</data>';
		echo($str);
	}

	function saveLog($message){
		//if ($file=fopen(UPLOAD_DIR . "log.txt", "a")){
			//fputs($file, $message . "\n");
		//}
	}
	
/**
 * Crop function with copy image
 * @param  int $crop resize method: 1,2
 * @return int
 */
function i_crop_copy($w, $h, $uploadfile, $res_img, $crop = 1)
{

    $size = getimagesize($uploadfile);
    if ($size)
    {
        $width  = $size[0];
        $height = $size[1];

        $imgObjName  =  'Image_Transform_Driver_GD';
        $img         =& new $imgObjName();


        if ($width > $w || $height > $h)
        {
            $wx = $w;
            $hx = $h;

            $img -> load($uploadfile);

            if (1 == $crop)
            {
                $crop_height = ($width*$hx)/$wx;
                if ($crop_height > $height) // crop by width
                {
                    $crop_width  = ($height*$wx)/$hx;
                    $crop_height = $height;
                    $img -> crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                }
                else // crop by height
                {
                    $crop_width  = $width;
                    $img -> crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                }
               
                $img -> save($res_img);
                $img -> load($res_img);
            }
            else
            {
                $coeff = $height / $width;

                if ($coeff*$wx > $hx)
                   $wx = $width*$hx / $height;
                else
                   $hx = $height*$wx / $width;
            }

            if ($img -> resize($wx, $hx))
            {
                $img -> save($res_img,'jpeg');
                return true;
            }
            else
            {
                return false;
            }    
        }
        else
		{
            copy($uploadfile, $res_img); 
		}	
    }
    else
    {
        return false;
    }  
}#i_crop_copy
?>