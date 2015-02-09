<?
//	session_start();
	//запрос на выборку моделей по фирме на продажу
	require_once('../inc/config.inc.php');
//	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
	require_once(DIR_INC.'set_valxml.php');
	//задаем кол-во моделей на странице
	$perpage = INVENTORY_PAGE;
//	$make_id = $dbh->escapeSimple($_POST['make_id']);
//	$sort = $dbh->escapeSimple($_POST['sort']);
	$sort_by = $dbh->escapeSimple($_POST['sort_by']);
	$diler_id = 3;
	
	//текущая страница
	if(!$_POST['page']) $page = 1; 
	else $page = intval($_POST['page']);
	//общее кол-во страниц
	$allpages = 0;
	if(!$_POST['allpages'])
	{
		$sql = "SELECT ceil(count(*)/$perpage) as c 
				  FROM modelsales 
				   WHERE diler_id=$diler_id";
//				 WHERE make_id=$make_id
		$data = $dbh->getAll($sql);
		$allpages = $data[0]["c"]; 
		$fla_allpages = true;
	}else{
		$allpages = intval($_POST['allpages']);
	}
	
	if (!isset($sort)) $sort='model_name';
	if (!isset($sort_by)) $sort_by='ASC';
	
//SUBSTRING(modelsale_pic,1,LOCATE(',',modelsale_pic)-1) as image
	$fla_sql = "SELECT * FROM modelsales 
						WHERE diler_id=$diler_id
						";
//	$fla_sql  .= " limit ".(($page*$perpage)-$perpage).", ".$perpage;
	$data = $dbh->getAll($fla_sql);	
	$xml_string = xml_connect($data);
//echo $xml_string;

$xsl = new DOMDocument;
$xsl->load('3.xsl');
$xslt = new XSLTProcessor();
$xslt->importStylesheet($xsl);

$xml = new DOMDocument;
$xml->loadXML($xml_string);

if (false === $results = $xslt->transformToURI($xml,'/tmp/pdf.fo')) {
echo "error";
}
//echo "done";
//echo $results;


echo exec('/usr/local/safe_mode/fop-0.20.5/fop.sh -fo /tmp/pdf.fo -pdf /tmp/myfile.pdf');
copy('/tmp/myfile.pdf','1.pdf');
header('Location: 1.pdf');
?>
?>   