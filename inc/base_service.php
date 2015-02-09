<?
    require_once('config.inc.php');
	require_once(INC_DIR.'dbinit.php');

	session_start();

	function getProjectInfo($dbh, $id)
	{
		$query	= 'SELECT * FROM portfolio_project WHERE id=' . $id;
		$data	= $dbh->getRow($query);
        if ($data)
        {			$queryImage	= 'SELECT * FROM portfolio_image WHERE project_id=' . $id . ' ORDER BY number';
			$dataImage	= $dbh->getAll($queryImage);
			$imageList  = '<imageList>';
			for($i = 0; $i < count($dataImage); $i++)
			{
				$imageList .= '<image id="' . $dataImage[$i]['id'] . '" number="' . $dataImage[$i]['number'] . '" projectId="' . $dataImage[$i]['project_id'] . '" path="' . htmlspecialchars($dataImage[$i]['path']) . '">';
				$imageList .= 	'<description>' . htmlspecialchars($dataImage[$i]['description']) . '</description>';
				$imageList .= '</image>';
			}
	  		$imageList .= '</imageList>';

			$str  = '<project id="' . $data['id'] .'" name="'. htmlspecialchars($data['name'])  . '" delay="' . $data['delay'] . '" image="' . $data['image'] .'" number="' . $data['number'] . '" link="' . $data['link'] .  '">';
			$str .= $imageList;
			$str .= '</project>';
			outputResult($str);
        } else
        {        	outputError('Project not found');
        }
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
?>