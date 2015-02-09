<?php
	require("commonFunctions.inc");
	
	$firstName	= toDataBaseString($_POST["firstName"]);
	$lastName	= toDataBaseString($_POST["lastName"]);
	$eventDate	= toDataBaseString($_POST["eventDate"]);
	$site		= toDataBaseString($_POST["site"]);
	$mail		= toDataBaseString($_POST["mail"]);
	$us			= toDataBaseString($_POST["us"]);
	$services	= toDataBaseString($_POST["services"]);
	$price		= toDataBaseString($_POST["price"]);
	$comments	= toDataBaseString($_POST["comments"]);

	$mailStr = '<html>';
	$mailStr .=	'<head>';
	$mailStr .=		'<meta http-equiv="Content-Type" content="text/html">';
	$mailStr .= 	'<title>Contact Us</title>';
	$mailStr .= 	'<style type="text/css"><!--';
	$mailStr .= 	'TD {font-family: arial,geneva,sans-serif; font-size: 9pt}';
	$mailStr .= 	'.text {font-family: arial,geneva,sans-serif; font-size: 9pt}';	
	$mailStr .= 	'--></style>';	
	$mailStr .= '</head>';
	$mailStr .= '<body>';
	$mailStr .= '<div align="center">';
	$mailStr .= 	'<table border="0" cellspacing="1" cellpadding="0">';

	$mailStr .=	'<tr>';
	$mailStr .=	'<td>';
	$mailStr .=			'<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="3">';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td><b>First Name</b></td>';
	$mailStr .=					'<td colspan="2">'.$firstName.'</td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td><b>Last Name</b></td>';
	$mailStr .=					'<td colspan="2">'.$lastName.'</td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td><b>Event Date</b></td>';
	$mailStr .=					'<td colspan="2">'.$eventDate.'</td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td><b>Reception Site</b></td>';
	$mailStr .=					'<td colspan="2"><a href="'.$site.'">'.$site.'</a></td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td><b>E-Mail</b></td>';
	$mailStr .=					'<td colspan="2"><a href="mailto:'.$mail.'">'.$mail.'</a></td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td><b>Phone</b></td>';
	$mailStr .=					'<td colspan="2">'.$phone.'</td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td colspan="2"><b>How did you hear of us?</b></td>';
	$mailStr .=					'<td>'.$us.'</td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td colspan="3"><b>When will you be reserving our services?</b>&nbsp;&nbsp;'.$services.'</td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td colspan="2"><b>Price range</b></td>';
	$mailStr .=					'<td>'.$price.'</td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td colspan="3"><b>Comments</b></td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'<tr>';
	$mailStr .=					'<td colspan="3">'.$comments.'</td>';
	$mailStr .=				'</tr>';
	$mailStr .=				'</table>';
	$mailStr .=			'</td>';
	$mailStr .=		'</tr>';
	$mailStr .= 	'</table>';
	$mailStr .=  '</div>';
	$mailStr .= '</body>';
	$mailStr .=	'</html>';
		

	$mail="yuri@militarystd.ru";
	$from="info@$SERVER_NAME";
	$subject="Contact Us";
	$headers = "From: $from\nMIME-Version: 1.0\nContent-Type: text/html;";
	
	$result = mail($mail, $subject, $mailStr, $headers);
	$loadkey	= ($result) ? 1 : 2;
	
	echo("&loadkey=$loadkey&"); 	
?>
