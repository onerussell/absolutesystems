<?php
	require("commonFunctions.inc");

	$field0 = toDataBaseString($_POST["field0"]);
	$field1 = toDataBaseString($_POST["field1"]);
	$field2 = toDataBaseString($_POST["field2"]);
	$field3 = toDataBaseString($_POST["field3"]);
	$field4 = toDataBaseString($_POST["field4"]);
	$field5 = toDataBaseString($_POST["field5"]);
	$field6 = toDataBaseString($_POST["field6"]);
	$field7 = toDataBaseString($_POST["field7"]);
	$field8 = toDataBaseString($_POST["field8"]);
	$field9 = toDataBaseString($_POST["field9"]);
	$field10 = toDataBaseString($_POST["field10"]);
	$field11 = toDataBaseString($_POST["field11"]);
	$field12 = toDataBaseString($_POST["field12"]);
	$field13 = toDataBaseString($_POST["field13"]);
	$field14 = toDataBaseString($_POST["field14"]);
	$field15 = toDataBaseString($_POST["field15"]);
	$field16 = toDataBaseString($_POST["field16"]);
	$field17 = toDataBaseString($_POST["field17"]);
	$field18 = toDataBaseString($_POST["field18"]);
	$field19 = toDataBaseString($_POST["field19"]);
	$field20 = toDataBaseString($_POST["field20"]);
	$field21 = toDataBaseString($_POST["field21"]);
	$field22 = toDataBaseString($_POST["field22"]);
	$field23 = toDataBaseString($_POST["field23"]);
	$field24 = toDataBaseString($_POST["field24"]);
	$field25 = toDataBaseString($_POST["field25"]);
	$field26 = toDataBaseString($_POST["field26"]);
	$field27 = toDataBaseString($_POST["field27"]);
	$field28 = toDataBaseString($_POST["field28"]);
	$field29 = toDataBaseString($_POST["field29"]);
	$field30 = toDataBaseString($_POST["field30"]);
	$field31 = toDataBaseString($_POST["field31"]);
	$field32 = toDataBaseString($_POST["field32"]);
	$field33 = toDataBaseString($_POST["field33"]);
	$field34 = toDataBaseString($_POST["field34"]);
	$field35 = toDataBaseString($_POST["field35"]);
	$field36 = toDataBaseString($_POST["field36"]);
	$field37 = toDataBaseString($_POST["field37"]);
	$field38 = toDataBaseString($_POST["field38"]);
	$field39 = toDataBaseString($_POST["field39"]);
	$field40 = toDataBaseString($_POST["field40"]);
	$field41 = toDataBaseString($_POST["field41"]);
	$field42 = toDataBaseString($_POST["field42"]);
	$field43 = toDataBaseString($_POST["field43"]);
	$field44 = toDataBaseString($_POST["field44"]);
	$field45 = toDataBaseString($_POST["field45"]);
	$percent = toDataBaseString($_POST["percent"]);
	$check1 = toDataBaseString($_POST["check1"]);
	$check2 = toDataBaseString($_POST["check2"]);
	$check3 = toDataBaseString($_POST["check3"]);
	$check4 = toDataBaseString($_POST["check4"]);
	$GrMarried1 = toDataBaseString($_POST["GrMarried1"]);
	$GrMarried2 = toDataBaseString($_POST["GrMarried2"]);
	$GrParty1 = toDataBaseString($_POST["GrParty1"]);
	$GrParty2 = toDataBaseString($_POST["GrParty2"]);
	$GrCeremony1 = toDataBaseString($_POST["GrCeremony1"]);
	$GrCeremony2 = toDataBaseString($_POST["GrCeremony2"]);
	$GrCeremony3 = toDataBaseString($_POST["GrCeremony3"]);
	$GrCeremony4 = toDataBaseString($_POST["GrCeremony4"]);
	$GrCeremony5 = toDataBaseString($_POST["GrCeremony5"]);
	$GrWebSite = toDataBaseString($_POST["GrWebSite"]);
	$GrPictures = toDataBaseString($_POST["GrPictures"]);

	$mailStr = '<html><head><meta http-equiv="Content-Type" content="text/html"><title>Celebration Photography</title><style type="text/css"><!--';
	$mailStr .= 'TD {font-family: arial,geneva,sans-serif; font-size: 9pt}';
	$mailStr .= '.text {font-family: arial,geneva,sans-serif; font-size: 9pt}';	
	$mailStr .= '--></style>';
	$mailStr .= '</head><body><div align="center"><table border="0" id="table1" cellspacing="0" cellpadding="0"><tr><td align="center" colspan="4"><p align="center"><b>WEDDING DAY INFORMATION SHEET - PHOTOGRAPHY<br>&nbsp;</b></p></td></tr><tr><td align="right" colspan="3"><b>Wedding Date:&nbsp;</b><img border="0" src="zero.gif" width="1" height="3"></td><td>'.$field0.'</td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table3"><TR><TD align="left"><b>Bride\'s Name:&nbsp;&nbsp;</b></TD><TD>'.$field1.'</TD></TR><TR><TD align="right">Home Phone:&nbsp;&nbsp;</TD><TD>'.$field2.'</TD></TR>';
	$mailStr .= '<TR><TD align="right">Cell Phone:&nbsp;&nbsp;</TD><TD>'.$field3.'</TD></TR></TABLE></td><td align="right" rowspan="32" valign="top" bgcolor="#000000"><img border="0" src="zero.gif" width="1" height="3"></td><td align="right" rowspan="32" valign="top">&nbsp;&nbsp;&nbsp;&nbsp; </td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table28"><TR><TD align="left"><b>Groom\'s Name: &nbsp;</b></TD><TD>'.$field26.'</TD></TR><TR><TD align="right">Home Phone:&nbsp;&nbsp;</TD><TD>'.$field27.'</TD></TR><TR><TD align="right">Cell Phone:&nbsp;&nbsp;</TD><TD>'.$field28.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table4"><TR><TD align="left">How many parents on Bride\'s side?<b>&nbsp;</b></TD><TD>'.$field4.'</TD></TR></TABLE></td>';
	$mailStr .= '<td><TABLE border="0" cellspacing="0" cellpadding="2" id="table29"><TR><TD align="left">How many parents on Groom\'s side?<b>&nbsp;</b></TD><TD>'.$field29.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table5"><TR><TD align="left">'.$check1.'&nbsp;</TD><TD align="left">&nbsp;</TD><TD align="left">'.$check2.'</TD><TD>&nbsp;</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table30"><TR><TD align="left">'.$check3.'&nbsp;</TD><TD align="left">&nbsp; </TD><TD align="left">'.$check4.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table6"><TR><TD align="left"><b>&nbsp;</b>Are they Married?: </TD></TR><TR><TD align="left">'.$GrMarried1.'</TD></TR></TABLE></td>';
	$mailStr .= '<td><TABLE border="0" cellspacing="0" cellpadding="2" id="table31"><TR><TD align="left"><b>&nbsp;</b>Are they Married?: </TD></TR><TR><TD align="left">'.$GrMarried2.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table7"><TR><TD align="left">Explain...</TD></TR><TR><TD align="left">'.$field5.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table32"><TR><TD align="left">Explain...</TD></TR><TR><TD align="left">'.$field30.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table8"><TR><TD align="left">How many Brothers &amp; Sisters on the Bride\'s Side?<b>&nbsp;</b></TD><TD>'.$field6.'</TD></TR></TABLE></td>';
	$mailStr .= '<td><TABLE border="0" cellspacing="0" cellpadding="2" id="table33"><TR><TD align="left">How many Brothers &amp; Sisters on the Groom\'s Side?<b>&nbsp;</b></TD><TD>'.$field31.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table9"><TR><TD align="left"><b>&nbsp;</b>Are they in the Bridal Party?</TD></TR><TR><TD align="left">'.$GrParty1.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table34"><TR><TD align="left"><b>&nbsp;</b>Are they in the Bridal Party?</TD></TR><TR><TD align="left">'.$GrParty2.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table10"><TR><TD align="left">How many Grandparents on the Bride\'s Side?</TD>';
	$mailStr .= '<TD align="left">'.$field7.'</TD><TD align="left">Who?&nbsp;&nbsp;&nbsp;&nbsp; </TD></TR><TR><TD align="left" colspan="3">'.$field8.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table35"><TR><TD align="left">How many Grandparents on the Groom\'s Side?</TD><TD align="left">'.$field32.'</TD><TD align="left">Who?</TD></TR><TR><TD align="left" colspan="3">'.$field33.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table11"><TR><TD align="left">Relatives of Importance on the Bride\'s Side?</TD></TR><TR><TD align="left">'.$field9.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table36"><TR><TD align="left">Relatives of Importance on the Groom\'s Side?</TD></TR>';
	$mailStr .= '<TR><TD align="left">'.$field34.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table12"><TR><TD align="left">How many Bridesmaids?<b>&nbsp;</b></TD><TD>'.$field10.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table37"><TR><TD align="left">How many Groomsmen?<b>&nbsp;</b></TD><TD>'.$field35.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table13"><TR><TD align="left">How many Flower girls/Jr. Bridesmaids?<b>&nbsp;</b></TD><TD>'.$field11.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table38"><TR><TD align="left">How many Ring bearers?<b>&nbsp;</b></TD><TD>'.$field36.'</TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td rowspan="2"><TABLE border="0" cellspacing="0" cellpadding="2" id="table14"><TR><TD align="left">Photographers Starting Location: </TD></TR><TR><TD align="left">'.$field12.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table39"><TR><TD align="left">May we photograph USING FLASH during the ceremony? </TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table40"><TR><TD align="left">'.$GrCeremony2.'</TD></TR></TABLE></td></tr><tr><td rowspan="2"><TABLE border="0" cellspacing="0" cellpadding="2" id="table15"><TR><TD align="left">Starting Address:</TD></TR><TR><TD align="left">'.$field13.'</TD></TR></TABLE></td>';
	$mailStr .= '<td><TABLE border="0" cellspacing="0" cellpadding="2" id="table41"><TR><TD align="left">May we photograph inside the ceremony area after the ceremony? </TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table42"><TR><TD align="left">'.$GrCeremony3.'</TD></TR></TABLE></td></tr><tr><td valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table44"><TR><TD align="left">'.$field14.'&nbsp;</TD><TD>Zip:</TD><TD>'.$field15.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table43"><TR><TD align="left">Are there any gardens or a nice place to take photographs<br>at the ceremony site? </TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table17"><TR><TD align="left">Starting time:<b>&nbsp;</b></TD><TD>'.$field16.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table45"><TR><TD align="left">'.$GrCeremony4.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table18"><TR><TD align="left">Phone # at Start Location:<b>&nbsp;</b></TD><TD>'.$field17.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table46"><TR><TD align="left">Where will we be taking pictures AFTER the ceremony? </TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table19"><TR>';
	$mailStr .= '<TD align="left">Will the Bride &amp; Groom see each other before the ceremony? </TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table47"><TR><TD align="left">'.$GrCeremony5.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table20"><TR><TD align="left">'.$GrCeremony1.'&nbsp;</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table48"><TR><TD align="left">Explain:</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table21"><TR><TD align="left">Ceremony Start Time:</TD><TD>'.$field18.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table49"><TR><TD align="left">'.$field37.'</TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table22"><TR><TD align="left">Name of Ceremony Location:<b>&nbsp;</b></TD><TD>'.$field19.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table50"><TR><TD align="left">Cocktail Time:<b>&nbsp;</b></TD><TD align="left">'.$field38.'</TD><TD align="left">Reception Start Time:</TD><TD>'.$field39.'</TD></TR></TABLE></td></tr><tr><td rowspan="2"><TABLE border="0" cellspacing="0" cellpadding="2" id="table23"><TR><TD align="left">Ceremony Address:</TD></TR><TR><TD align="left">'.$field20.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table51"><TR><TD align="left">Name of Reception Site:</TD><TD>'.$field40.'</TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table52"><TR><TD align="left">Reception Address:</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table24"><TR><TD align="left">'.$field21.'&nbsp;</TD><TD>Zip:</TD><TD>'.$field22.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table53"><TR><TD align="left">'.$field41.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table25"><TR><TD align="left">Phone # at Ceremony Location:</TD><TD>'.$field23.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table54"><TR><TD align="left">'.$field42.'&nbsp;</TD><TD>Zip:</TD><TD>'.$field43.'</TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td rowspan="2" valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table57"><TR><TD align="left">Are there any photographs you consider<br>&quot;MUST HAVE PHOTOS&quot; that we should be aware<br>of (ie. Friends from school, work, childhood)?</TD></TR><TR><TD align="left">'.$field24.'</TD></TR></TABLE></td><td valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table55"><TR><TD align="left">Phone # at Reception Site:</TD><TD>'.$field44.'</TD></TR><TR><TD align="left">How many guests are you expecting?</TD><TD>'.$field45.'</TD></TR></TABLE></td></tr><tr><td valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table56"><TR><TD align="left">If your package includes black and white photographs,<br>what percentage would you like</TD>';
	$mailStr .= '<TD>'.$percent.'</TD></TR></TABLE></td></tr><tr><td valign="top" rowspan="2"><TABLE border="0" cellspacing="0" cellpadding="2" id="table59"><TR><TD align="left">Are there any special photographs you would like to have<br>taken at the reception site?</TD></TR><TR><TD align="left">'.$field25.'</TD></TR></TABLE></td><td valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table60"><TR><TD align="left">As a free service to our clients, we offer online access to your<br>photographs. Would you like your photographs posted<br>on our password protected website?</TD></TR></TABLE></td></tr><tr><td valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table61"><TR><TD align="left">'.$GrWebSite.'&nbsp;</TD></TR></TABLE></td></tr><tr><td>&nbsp;</td>';
	$mailStr .= '<td><TABLE border="0" cellspacing="0" cellpadding="2" id="table62"><TR><TD>I will pick up my pictures from:</TD></TR><TR><TD>'.$GrPictures.'&nbsp;&nbsp; </TD></TR></TABLE></td></tr></table></div></body></html>';
	
	$mail="yuri@militarystd.ru";
	$from="info@$SERVER_NAME";
	$subject="Celebration Photography";
	$headers = "From: $from\nMIME-Version: 1.0\nContent-Type: text/html;";
	
	$result = mail($mail, $subject, $mailStr, $headers);
?>
<html>
<head>
<title>Celebration Photography</title>
<link href="main.css" rel=stylesheet type=text/css>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div align="center">
  <center>
	<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0" height="100%">
		<tr>
			<td align="center">
<?php
	if ($result) echo("<B><font size=3>Your request has been submitted successfully and you'll be contacted soon!</font></B>");
	else echo("<B><font size=3>There has been a server error.</font></B>"); 		
?>
</td>
		</tr>
	</table>
&nbsp;</center>
</div>
</body>
</html>	