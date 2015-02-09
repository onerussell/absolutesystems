<?

$size = $_POST['size'];
if (!is_numeric($size)) exit();
//$poker_location = 'http://www.engine37.com/poker/28/Generic-'.$size.'.jad';
$poker_location = 'http://www.engine37.com/poker/39/Generic-midp2-big-client.jad';
$area_code = $_POST['area_code'];
$phone_number = $_POST['phone_number'];
$carrier = $_POST['carrier'];

switch ($carrier) {
 case 'Sprint': $domain = 'messaging.sprintpcs.com';
       break;
 case 'Cingular': $domain = 'cingularme.com ';
       break;
 case 'T-Mobile': $domain = 'tmomail.net';
       break;
 case 'Verizon': $domain = 'vtext.com';
       break;
 case 'Virgin': $domain = 'vmobl.com';
       break;
 case 'Nextel': $domain = 'messaging.nextel.com';
       break;

}

$email = $area_code.$phone_number.'@'.$domain;



mail($email,"e37poker",$poker_location,$headers,"-f max@engine37.com");
echo "Done."
?>
