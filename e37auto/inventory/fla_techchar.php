<?
	session_start();
	require_once('../inc/config.inc.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
	require_once(DIR_INC.'set_valxml.php');
	
	$submodel_id = $dbh->escapeSimple($_POST['submodel_id']);
	
	//������ �� ������� �� ��������� ������������ ������
	//(�����������, ������� �������)
	$fla_sql = "SELECT * FROM techchars 
						WHERE submodel_id = '$submodel_id'";
	$data =& $dbh->getAll($fla_sql);	
	$var_xml = "&xmlTechchars=".xml_connect($data);
	
	//������ �� ������� �� ��������� ������������ ������
	//(���������)
	$fla_sql = "SELECT * FROM submodengines 
						WHERE submodel_id = '$submodel_id'";
	$data =& $dbh->getAll($fla_sql);
	$var_xml .= "&xmlSubmodengines=".xml_connect($data);
	
	//������ �� ������� �� ��������� - ����������
	//(����������, ����������� � �.�.)
	$fla_sql = "SELECT * FROM submodequips 
						WHERE submodel_id = '$submodel_id'";
	$data =& $dbh->getAll($fla_sql);
	
	$var_xml .= "&xmlSubmodequips=".xml_connect($data);
	$var_xml .= "&loadkey=1";
	echo $var_xml;
?>