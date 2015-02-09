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

	$check1 = toDataBaseString($_POST["check1"]);
	$check2 = toDataBaseString($_POST["check2"]);
	$check3 = toDataBaseString($_POST["check3"]);
	$check4 = toDataBaseString($_POST["check4"]);
	$GrMarried1 = toDataBaseString($_POST["GrMarried1"]);
	$GrMarried2 = toDataBaseString($_POST["GrMarried2"]);
	$GrParty1 = toDataBaseString($_POST["GrParty1"]);
	$GrParty2 = toDataBaseString($_POST["GrParty2"]);
	
	$GrCeremony1 = toDataBaseString($_POST["GrCeremony1"]);
	
	$GrRules = toDataBaseString($_POST["GrRules"]);
	$GrBridal = toDataBaseString($_POST["GrBridal"]);
	$GrParent = toDataBaseString($_POST["GrParent"]);

	$GrPictures = toDataBaseString($_POST["GrPictures"]);

	$mailStr = '<html><head><meta http-equiv="Content-Type" content="text/html"><title>Celebration Photography</title><style type="text/css"><!--';
	$mailStr .= 'TD {font-family: arial,geneva,sans-serif; font-size: 9pt}';
	$mailStr .= '.text {font-family: arial,geneva,sans-serif; font-size: 9pt}';	
	$mailStr .= '--></style>';
	$mailStr .= '</head><body><div align="center">';
	$mailStr .= '<table border="0" id="table1" cellspacing="0" cellpadding="0"><tr><td align="center" colspan="4"><p align="center"><b>WEDDING DAY INFORMATION SHEET - VIDEOGRAPHY<br>&nbsp;</b></p></td></tr><tr><td align="right" colspan="3"><b>Wedding Date:&nbsp;</b><img border="0" src="zero.gif" width="1" height="3"></td><td>'.$field0.'</td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table3"><TR><TD align="left"><b>Bride\'s Name:&nbsp;&nbsp;</b></TD><TD>'.$field1.'</TD></TR><TR><TD align="right">Home Phone:&nbsp;&nbsp;</TD><TD>'.$field2.'</TD></TR><TR><TD align="right">Cell Phone:&nbsp;&nbsp;</TD><TD>'.$field3.'</TD></TR></TABLE></td><td align="right" rowspan="27" valign="top" bgcolor="#000000"><img border="0" src="zero.gif" width="1" height="3"></td><td align="right" rowspan="27" valign="top">&nbsp;&nbsp;&nbsp;&nbsp; </td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table28"><TR><TD align="left"><b>Groom\'s Name: &nbsp;</b></TD><TD>'.$field21.'</TD></TR><TR><TD align="right">Home Phone:&nbsp;&nbsp;</TD><TD>'.$field22.'</TD></TR><TR><TD align="right">Cell Phone:&nbsp;&nbsp;</TD><TD>'.$field23.'</TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table4"><TR><TD align="left">How many parents on Bride\'s side?<b>&nbsp;</b></TD><TD>'.$field4.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table29"><TR><TD align="left">How many parents on Groom\'s side?<b>&nbsp;</b></TD><TD>'.$field24.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table5"><TR><TD align="left">'.$check1.'&nbsp;</TD><TD align="left">&nbsp;&nbsp; </TD><TD align="left">'.$check2.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table30"><TR><TD align="left">'.$check3.'&nbsp;</TD><TD align="left">&nbsp; </TD><TD align="left">'.$check4.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table6"><TR><TD align="left"><b>&nbsp;</b>Are they Married?: </TD></TR><TR><TD align="left">'.$GrMarried1.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table31"><TR><TD align="left">Are they Married?: </TD></TR><TR><TD align="left">'.$GrMarried2.'</TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table7"><TR><TD align="left">Explain...</TD></TR><TR><TD align="left">'.$field5.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table32"><TR><TD align="left">Explain...</TD></TR><TR><TD align="left">'.$field25.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table8"><TR><TD align="left">How many Brothers &amp; Sisters on the Bride\'s Side?<b>&nbsp;</b></TD><TD>'.$field6.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table33"><TR><TD align="left">How many Brothers &amp; Sisters on the Groom\'s Side?<b>&nbsp;</b></TD><TD>'.$field26.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table9"><TR><TD align="left"><b>&nbsp;</b>Are they in the Bridal Party?</TD></TR><TR><TD align="left">'.$GrParty1.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table34"><TR><TD align="left">Are they in the Bridal Party?</TD></TR><TR><TD align="left">'.$GrParty2.'</TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table10"><TR><TD align="left">How many Grandparents on the Bride\'s Side?</TD><TD align="left">'.$field7.'</TD><TD align="left">Who?&nbsp;&nbsp;&nbsp;&nbsp; </TD></TR><TR><TD align="left" colspan="3">'.$field8.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table35"><TR><TD align="left">How many Grandparents on the Groom\'s Side?</TD><TD align="left">'.$field27.'</TD><TD align="left">Who?</TD></TR><TR><TD align="left" colspan="3">'.$field28.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table11"><TR><TD align="left">Relatives of Importance on the Bride\'s Side?</TD></TR><TR><TD align="left">'.$field9.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table36"><TR><TD align="left">Relatives of Importance on the Groom\'s Side?</TD></TR><TR><TD align="left">'.$field29.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table12"><TR><TD align="left">How many Bridesmaids?<b>&nbsp;</b></TD><TD>'.$field10.'</TD></TR></TABLE></td>';
	$mailStr .= '<td><TABLE border="0" cellspacing="0" cellpadding="2" id="table37"><TR><TD align="left">How many Groomsmen?<b>&nbsp;</b></TD><TD>'.$field30.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table13"><TR><TD align="left">How many Flower girls/Jr. Bridesmaids?<b>&nbsp;</b></TD><TD>'.$field11.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table38"><TR><TD align="left">How many Ring bearers?<b>&nbsp;</b></TD><TD>'.$field31.'</TD></TR></TABLE></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td rowspan="2"><TABLE border="0" cellspacing="0" cellpadding="2" id="table14"><TR><TD align="left">Ceremony Start Time: </TD><TD align="left">'.$field12.'</TD></TR><TR><TD align="left" colspan="2">The Videographer will arrive approx.<br>30 minutes before the ceremony.</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table75"><TR><TD align="left">Cocktail Time:<b>&nbsp;</b></TD><TD align="left">'.$field32.'</TD><TD align="left">Reception Start Time:</TD><TD>'.$field33.'</TD></TR></TABLE></td></tr>';
	$mailStr .= '<tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table76"><TR><TD align="left">Name of Reception Site:</TD><TD>'.$field34.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table65"><TR><TD align="left">Name of Ceremony Location:<b>&nbsp;</b></TD><TD>'.$field13.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table77"><TR><TD align="left">Reception Address:</TD></TR></TABLE></td></tr><tr><td valign="top" rowspan="2"><TABLE border="0" cellspacing="0" cellpadding="2" id="table66"><TR><TD align="left">Ceremony Address:</TD></TR><TR><TD align="left">'.$field14.'</TD></TR></TABLE></td><td valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table78"><TR><TD align="left">'.$field35.'</TD></TR></TABLE></td></tr><tr><td valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table79"><TR><TD align="left">'.$field36.'&nbsp;</TD><TD>Zip: </TD><TD>'.$field37.'</TD></TR></TABLE></td></tr><tr><td valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table86"><TR><TD align="left">'.$field15.'&nbsp;</TD><TD>Zip:</TD><TD>'.$field16.'</TD>';
	$mailStr .= '</TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table80"><TR><TD align="left">Phone # at Reception Site:</TD><TD>'.$field38.'</TD></TR><TR><TD align="left">Who will assist the Videographer in identifying and<br>gathering important guests for interview?</TD><TD valign="middle">'.$field39.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table68"><TR><TD align="left">Phone # at Ceremony Location:</TD><TD>'.$field17.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table81"><TR><TD align="left">Do you want the parents interviewed?</TD><TD>'.$GrParent.'</TD></TR></TABLE></td></tr><tr><td rowspan="2"><TABLE border="0" cellspacing="0" cellpadding="2" id="table69"><TR><TD align="left">Will the Bride &amp; Groom see each other before the ceremony?</TD></TR><TR><TD align="left"><TABLE border="0" cellspacing="0" cellpadding="2" id="table70"><TR><TD align="left">'.$GrCeremony1.'</TD></TR></TABLE></TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table82"><TR><TD align="left">Do you want the bridal attendants interviewed?</TD>';
	$mailStr .= '<TD>'.$GrBridal.'</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table83"><TR><TD align="left"><b>&nbsp;</b>Additional interviews:</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table71"><TR><TD align="left">How long is your ceremony?</TD><TD>'.$field18.'</TD></TR></TABLE></td><td rowspan="2" valign="top">'.$field40.'</td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table72"><TR><TD align="left">Does the ceremony site have any special rules or restrictions?</TD></TR></TABLE></td></tr><tr><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table73"><TR><TD align="left">'.$GrRules.'</TD></TR></TABLE></td><td><TABLE border="0" cellspacing="0" cellpadding="2" id="table84"><TR><TD align="left">Do you have any other questions or comments?</TD></TR></TABLE></td></tr><tr><td>'.$field19.'</td><td valign="top">'.$field41.'</td></tr><tr><td>Are there any special performances or presentations<br>we should know about?</td><td rowspan="2" valign="top"><TABLE border="0" cellspacing="0" cellpadding="2" id="table85"><TR><TD>I will pick up my videos from: </TD></TR>';
	$mailStr .= '<TR><TD>'.$GrPictures.'&nbsp;&nbsp; </TD></TR></TABLE></td></tr><tr><td>'.$field20.'</td></tr></table></div></body></html>';

	$mail="max@engine37.com";
	$from="info@celebrationphotography.net";
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