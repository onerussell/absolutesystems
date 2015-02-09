<?
    require_once('inc/config.inc.php');
	require_once(INC_DIR.'dbinit.php');
	require_once(INC_DIR.'no-cache.php');

	$firstName	= $dbh->quoteSmart($_POST['firstName']); 
	$lastName	= $dbh->quoteSmart($_POST['lastName']); 
	$mail		= $dbh->quoteSmart($_POST['mail']); 
	$company	= $dbh->quoteSmart($_POST['company']); 
	$message	= $dbh->quoteSmart($_POST['message']); 

	$query = "INSERT INTO feedback (firstName, lastName, mail, company, message, date) 
	   			     VALUES ($firstName, $lastName, $mail, $company, $message, NOW())";
	$data = $dbh->query($query); 	
	

	$firstName	= htmlspecialchars($_POST['firstName']); 
	$lastName	= htmlspecialchars($_POST['lastName']); 
	$mail		= htmlspecialchars($_POST['mail']); 
	$company	= htmlspecialchars($_POST['company']); 
	$message	= htmlspecialchars($_POST['message']); 

	
	$mailStr = '<html><head><meta http-equiv="Content-Type" content="text/html"><title>'.CONTACT_MAIL_SUBJECT.'</title><style type="text/css">';
	$mailStr .= 'TD {font-family: arial,geneva,sans-serif; font-size: 9pt}';
	$mailStr .= '.text {font-family: arial,geneva,sans-serif; font-size: 9pt}';	
	$mailStr .= '</style>';
	$mailStr .= '</head><body>';
	$mailStr .= '<b>Author:</b> ' . $firstName . ' ' . $lastName . '<br>';	
	$mailStr .= '<b>E-Mail:</b> <a href="mailto:' . $mail . '">' . $mail . '</a><br>';		
	$mailStr .= '<b>Company:</b> ' . $company . '<br>';		
	$mailStr .= '<b>Message:</b> ' . $message;			
	$mailStr .= '</body></html>';
	
	$mail	= CONTACT_MAIL_TO;
	$from	= CONTACT_MAIL_FROM;
	$subject= CONTACT_MAIL_SUBJECT;
	$headers= "From: $from\nMIME-Version: 1.0\nContent-Type: text/html;";
	
	$result = mail($mail, $subject, $mailStr, $headers);
	
	
	if ($result) $var_xml = '&loadkey=1&';		
	else $var_xml = '&loadkey=1&';	
	echo $var_xml;
?>