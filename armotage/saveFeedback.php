<?
	define("CONTACT_MAIL_TO","max@engine37.com");
	define("CONTACT_MAIL_FROM","max@engine37.com");
	define("CONTACT_MAIL_SUBJECT","test subject");
//  require_once('inc/config.inc.php');
//	require_once(INC_DIR.'dbinit.php');
//	require_once(INC_DIR.'no-cache.php');

	$firstName		= $_POST['firstName']; 
	$lastName		= $_POST['lastName']; 
	$company		= $_POST['company']; 
	$address		= $_POST['address']; 
	$city			= $_POST['city']; 
	$state			= $_POST['state']; 
	$zip			= $_POST['zip']; 
	$country		= $_POST['country']; 
	$age			= $_POST['age']; 
	$favoriteColor	= $_POST['favoriteColor']; 

//	$query = "INSERT INTO feedback (firstName, lastName, mail, company, message, date) 
//	   			     VALUES ($firstName, $lastName, $mail, $company, $message, NOW())";
//	$data = $dbh->query($query); 	
	

	$firstName	= htmlspecialchars($_POST['firstName']); 
	$lastName	= htmlspecialchars($_POST['lastName']); 
	$mail		= htmlspecialchars($_POST['mail']); 
	$company	= htmlspecialchars($_POST['company']); 

	
	$mailStr = '<html><head><meta http-equiv="Content-Type" content="text/html"><title>'.CONTACT_MAIL_SUBJECT.'</title><style type="text/css">';
	$mailStr .= 'TD {font-family: arial,geneva,sans-serif; font-size: 9pt}';
	$mailStr .= '.text {font-family: arial,geneva,sans-serif; font-size: 9pt}';	
	$mailStr .= '</style>';
	$mailStr .= '</head><body>';
	$mailStr .= '<b>Name:</b> ' . $firstName . ' ' . $lastName . '<br>';	
	$mailStr .= '<b>E-Mail:</b> <a href="mailto:' . $mail . '">' . $mail . '</a><br>';		
	$mailStr .= '<b>Company:</b> ' . $company . '<br>';		
	$mailStr .= '<b>Address:</b> ' . $address . '<br>';		
	$mailStr .= '<b>City:</b> ' . $city . '<br>';		
	$mailStr .= '<b>State:</b> ' . $state . '<br>';		
	$mailStr .= '<b>Zip:</b> ' . $zip . '<br>';		
	$mailStr .= '<b>Country:</b> ' . $country . '<br>';		
	$mailStr .= '<b>Age:</b> ' . $age . '<br>';		
	$mailStr .= '<b>Favorite Color:</b> ' . $favoriteColor . '<br>';		

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