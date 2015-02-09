<?php
    require_once('inc/base_service.php');

	$action = $_GET["action"];
	switch($action)
	{
		case 'getProjectList':	getProjectList($dbh);
			break;
		case 'getProjectInfo':	getProjectInfo($dbh, $_GET["id"]);
			break;
		default: 				actionNotFound();
			break;
	}

	function getProjectList($dbh)
	{
		$query	= 'SELECT * FROM portfolio_project WHERE visible=1 ORDER BY number';
		$data	= $dbh->getAll($query);

		$str =		'<projectList>';
		for($i = 0; $i < count($data); $i++)
		{
			if ($data[$i]['image'] != "")
			{
				$str .=	'<project id="' . $data[$i]['id'] .'" name="'. htmlspecialchars($data[$i]['name'])  . '" image="' . $data[$i]['image'] .'" delay="' . $data[$i]['delay'] . '" link="' . $data[$i]['link'] . '"/>';
			}
		}
		$str .=		'</projectList>';
		outputResult($str);
	}
?>