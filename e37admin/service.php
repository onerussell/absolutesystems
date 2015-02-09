<?php
    require_once('../inc/base_service.php');

	$action = $_POST["action"];
	switch($action)
	{
		case 'getProjectList':	getProjectList($dbh);
			break;
		case 'getProjectInfo':	getProjectInfo($dbh, $_POST["id"]);
			break;
		case 'saveProjectInfo':	saveProjectInfo($dbh, $_POST["id"], $_POST["name"], $_POST["link"], $_POST["number"], $_POST["delay"]);
			break;
		case "deleteProjectInfo": deleteProjectInfo($dbh, $_POST["id"], UPLOAD_DIR);
			break;
		case 'checkFileName':	checkFileName($dbh, $_POST["id"], $_POST["name"]);
			break;
		case 'uploadFile':		uploadFile($_POST["oldFileName"], UPLOAD_DIR, $_FILES['Filedata']);
			break;
		case 'checkUploadFile':	checkUploadFile(UPLOAD_DIR, $_POST["name"]);
			break;
		case 'saveImageInfo':	saveImageInfo($dbh, $_POST["id"], $_POST["projectId"], $_POST["path"], $_POST["description"], $_POST["number"], $_POST["delay"]);
			break;
		case "deleteImageInfo": deleteImageInfo($dbh, $_POST["id"], UPLOAD_DIR);
			break;
		case "changeProjectOrder": changeProjectOrder($dbh, $_POST["id"], $_POST["oldIndex"], $_POST["newIndex"]);
			break;
		case "changeImageOrder": changeImageOrder($dbh, $_POST["id"], $_POST["oldIndex"], $_POST["newIndex"]);
			break;
		case "changeProjectStatus": changeProjectStatus($dbh, $_POST["id"], $_POST["visible"]);
			break;
		default: 				actionNotFound();
			break;
	}

	function  changeProjectStatus($dbh, $id, $visible)
	{
		$value = ($visible == "true") ? 1 : 0;
		$query = "UPDATE portfolio_project SET visible=$value WHERE id=$id";
		$data = $dbh->query($query);
		outputResult($str . '<query>' . $query . '</query>');	}

	function getProjectList($dbh)
	{
		$query	= 'SELECT * FROM portfolio_project ORDER BY number';
		$data	= $dbh->getAll($query);

		$str =		'<projectList>';
		for($i = 0; $i < count($data); $i++)
		{
			$visible = ($data[$i]['visible'] == 1) ? "true" : "false";
			$str .=	'<project id="' . $data[$i]['id'] .'" name="'. htmlspecialchars($data[$i]['name'])  . '" image="' . $data[$i]['image'] .'" number="' . $data[$i]['number'] . '" delay="' . $data[$i]['delay'] . '" link="' . $data[$i]['link'] . '" visible="' . $visible . '"/>';
		}
		$str .=		'</projectList>';
		outputResult($str);
	}

	function saveProjectInfo($dbh, $id, $name, $link, $number, $delay)
	{	    $id		= (int)$id;
	    $name	= $dbh->quoteSmart($name);
	    $link	= $dbh->quoteSmart($link);
	    $number	= (int)($number);
	    $delay	= (int)($delay);
		$str = "";
		if ($id == 0)
		{
			$query = "INSERT INTO portfolio_project(name, link, number, delay) VALUES ($name, $link, $number, $delay)";
			$data = $dbh->query($query);
			$queryId = "SELECT LAST_INSERT_ID()";
	        $id = $dbh->getOne($queryId);

			$str .=	'<id>' . $id . '</id>';
		} else
		{
			$query = "UPDATE portfolio_project SET name=$name, link=$link, number=$number, delay=$delay WHERE id=$id";
			$data = $dbh->query($query);

			$str .=	'<id>' . $id . '</id>';
		}

		outputResult($str);
	}

	function deleteProjectInfo($dbh, $projectId, $folder)
	{
		$projectId = (int)$projectId;
		$query = "SELECT * FROM portfolio_project WHERE id=" . $projectId;
		$data = $dbh->getRow($query);
		if ($data)
		{
			$number= $data["number"];

			//Delete Project
			$query = "DELETE FROM portfolio_project WHERE id=" . $projectId;
			$dbh->query($query);

			//Update project order
			$query = "SELECT id, number FROM portfolio_project WHERE number>" . $number;
			$data = $dbh->getAll($query);
			echo($query . " count= " . count($data));
	  		for($i = 0; $i < count($data); $i++)
			{
				$id = $data[$i]["id"];
				$number= $data[$i]["number"] - 1;
				$query = "UPDATE portfolio_project SET number=" . $number . " WHERE id=" . $id;
				$dbh->query($query);
				echo($query);
			}

			//Delete files
			$query = "SELECT path FROM portfolio_image WHERE project_id=" . $projectId;
			$data = $dbh->getAll($query);
	  		for($i = 0; $i < count($data); $i++)
			{
				deleteFile($folder, $data[$i]["path"]);
			}

			//Delete images from BD
			$query = "DELETE FROM portfolio_image WHERE project_id=" . $projectId;
			$dbh->query($query);

			outputResult("");
		} else
		{			outputResult("Project not found.");
		}
	}


	function deleteFile($folder, $name)
	{
		if (file_exists($folder.$name))
		{
   			unlink($folder.$name);
		}
	}

	function checkFileName($dbh, $id, $path)
	{
         $id	= (int)$id;
         $path	= $dbh->quoteSmart($path);
         $query	= 'SELECT * FROM portfolio_image WHERE path=' . $path . ' AND id!=' . $id;
         $data	= $dbh->getAll($query);
         $str	= '';
         if (count($data) > 0)
         {
         	$str = '<check>false</check>';
         } else
         {
        	 $str = '<check>true</check>';
         }
         $str .= '<query>' . $query  . '</query>';
         outputResult($str);
	}

 	function uploadFile($oldFileName, $dir, $file)
 	{
		$result = $file["error"];
		$message= "";

		if ($oldFileName)
		{
			deleteFile($dir, $oldFileName);
		}

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

			$fileName = "" . time() . strrchr($file["name"], ".");
	 		if(is_uploaded_file($file["tmp_name"]))
	 		{
				if (move_uploaded_file($file["tmp_name"], $dir . $fileName))
				{
					echo("result=1&fileName=$fileName&id=" . session_id());
				} else
				{
					$er = error_get_last();
					echo("result=0&message=" . $er["message"]);
				}
			} else
			{
					$er = error_get_last();
					echo("result=0&message=" . $er["message"]);
			}
		} else
		{
             echo("result=0&message=" . $message);
		}
	}

	function checkUploadFile($folder, $name)
	{
		outputResult("<check>" . file_exists($folder.$name) . "</check>");
	}

	function saveImageInfo($dbh, $id, $projectId, $path, $description, $number, $delay)
	{
	    $id	= (int)$id;
	    $projectId	= (int)$projectId;
	    $path		= $dbh->quoteSmart($path);
	    $description= $dbh->quoteSmart($description);
	    $number	= (int)($number);
	    $delay	= (int)($delay);
		$str = "";
		if ($id == 0)
		{
			$query = "INSERT INTO portfolio_image(project_id, path, description, number) VALUES ($projectId, $path, $description, $number)";
			$data = $dbh->query($query);
			$queryId = "SELECT LAST_INSERT_ID()";
	        $id = $dbh->getOne($queryId);

			$str .=	'<id>' . $id . '</id>';
		} else
		{
			$query = "UPDATE portfolio_image SET project_id=$projectId, path=$path, description=$description, number=$number WHERE id=$id";
			$data = $dbh->query($query);

			$str .=	'<id>' . $id . '</id>';
		}

        //Update main screen
        if ($number == 1)
        {        	changeMainScreen($dbh, $projectId);
        }
		outputResult($str . '<query>' . $query . '</query>');
	}

	function deleteImageInfo($dbh, $imageId, $folder)
	{
		$imageId = (int)$imageId;
		$query = "SELECT path, number, project_id FROM portfolio_image WHERE id=" . $imageId;
		$data	= $dbh->getRow($query);
  		if ($data)
  		{
			$imageNumber= $data["number"];
			$path		= $data["path"];
			$projectId	= $data["project_id"];

			//Update image order
			$query = "SELECT id, number FROM portfolio_image WHERE number>" . $imageNumber . " AND project_id=" . $projectId;
			$data = $dbh->getAll($query);
	  		for($i = 0; $i < count($data); $i++)
			{
				$id = $data[$i]["id"];
				$number= $data[$i]["number"] - 1;
				$query = "UPDATE portfolio_image SET number=" . $number . " WHERE id=" . $id;
				$dbh->query($query);
				echo($query);
			}

			//Delete image from BD
			$query = "DELETE FROM portfolio_image WHERE id=" . $imageId;
			$dbh->query($query);

  			//Update main screen  x
  			if ($imageNumber == 1)
  			{
  				changeMainScreen($dbh, $projectId);
  			}

			//Delete image file
			deleteFile($folder, $path);

			outputResult("");
		} else
		{
			outputError("Image not found.");		}
	}

	function changeMainScreen($dbh, $projectId)
	{		$query = "SELECT path FROM portfolio_image WHERE project_id=" . $projectId . " AND number=1";
	    $data	= $dbh->getRow($query);
	    $path = "";
	    if ($data)
	    {
	    	$path = $data["path"];	    }
    	$query = "UPDATE portfolio_project SET image='" . $data["path"] . "' WHERE id=" . $projectId;
    	$data = $dbh->query($query);
	}

	function changeImageOrder($dbh, $imageId, $oldIndex, $newIndex)
	{
		$query = "SELECT project_id FROM portfolio_image WHERE id=" . $imageId;
        $data	= $dbh->getRow($query);
        if ($data)
        {
			$projectId = $data["project_id"];

			//Update image order
			$delta = 0;
			if ($newIndex < $oldIndex)
			{
				$query = "SELECT id, number FROM portfolio_image WHERE project_id=" . $projectId . " AND number>=" . $newIndex . " AND number<" . $oldIndex;
				$delta = 1;
			} else
			{
				$query = "SELECT id, number FROM portfolio_image WHERE project_id=" . $projectId . " AND number<=" . $newIndex . " AND number>" . $oldIndex;
				$delta = -1;
			}
			$data	= $dbh->getAll($query);
			for($i = 0; $i < count($data); $i++)
			{
				$id = $data[$i]['id'];
				$number= $data[$i]['number'] + $delta;
				$query = "UPDATE portfolio_image SET number=$number WHERE id=" . $id;
				$dbh->query($query);
			}

			//Update image
			$query = "UPDATE portfolio_image SET number=$newIndex WHERE id=" . $imageId;
			$dbh->query($query);

			//Update main screen
			if ($oldIndex == 1 || $newIndex == 1)
			{
				changeMainScreen($dbh, $projectId);
			}

			$str = "<oldIndex>" . $oldIndex . "</oldIndex>";
			$str .= "<newIndex>" . $newIndex . "</newIndex>";
			outputResult($str);
		} else
		{			outputResult("Image not found.");
		}
	}

	function changeProjectOrder($dbh, $id, $oldIndex, $newIndex)
	{		$query = "";
		$delta = 0;
		if ($newIndex < $oldIndex)
		{
			$query = "SELECT id, number FROM portfolio_project WHERE number>=" . $newIndex . " AND number<" . $oldIndex;
			$delta = 1;
		} else
		{			$query = "SELECT id, number FROM portfolio_project WHERE number<=" . $newIndex . " AND number>" . $oldIndex;
			$delta = -1;
		}
		$data	= $dbh->getAll($query);
		for($i = 0; $i < count($data); $i++)
		{
			$itemId = $data[$i]['id'];
			$number = $data[$i]['number'] + $delta;
			$query = "UPDATE portfolio_project SET number=$number WHERE id=$itemId";
			$dbh->query($query);
		}
		$query = "UPDATE portfolio_project SET number=$newIndex WHERE id=$id";
		$dbh->query($query);

		$str = "<oldIndex>" . $oldIndex . "</oldIndex>";
		$str .= "<newIndex>" . $newIndex . "</newIndex>";
		outputResult($str);
	}
?>