<?

  require_once('inc/config.inc.php');
  require_once(INC_DIR.'dbinit.php');

  header("Content-Type: text/xml");

  $id = $_GET['id'];

  $query = "SELECT * FROM portfolioitem WHERE portfoliolist_id='$id'";
  $data = $dbh->getAll($query);	

  $path = UPLOAD_DIR;

echo $xml_data = <<<EOT
<?xml version="1.0"?>
<root>
<call result="1">
<imageList>
EOT;

foreach ($data as $value) {

echo <<<EOT
<image src="{$value['image']}">
	<![CDATA[{$value['description']}]]>
</image>
EOT;

}

echo <<<EOT
</imageList>
</call>
</root>
EOT;



/* output sample
<?xml version="1.0"?>

<root>
  <call result="1">
    <data id="1" name="Celebration Photography" link="http://www.celebrationphotography.net" delay="7">
    <imageList>
      <image src="pic/celebration1.jpg" >
        <![CDATA[With 9 offices throughout California and Nevada, Celebration Photography & Video Inc. is the largest wedding photography outfit in two states. engine37 was hired to develop Celebration's new website and to further increase brand awareness, bringing to life re-designed look & feel along with the firm's new identity.]]>
      </image>
      <image src="pic/celebration2.jpg" >
        <![CDATA[Our task was to essentially combine Celebration's photographs and to then develop visuals with which Celebration's clientele could equivocally identify with, as well as to attract new prospects to Celebration's core markets. Territorial demographics and current product positioning and branding had to be taken into consideration amid other factors. ]]>
	  </image>
      <image src="pic/celebration3.jpg" >
        <![CDATA[For site's administration, we've developed a powerful, yet easy to use, content management system enabling even Celebration's most non-technical of staff to easily implement changes and additions to the site on their own. engine37's proprietary e37zoom technology was also utilized to allow site guests to zoom into finest details of Celebration's photos. ]]>
	  </image>
      <image src="pic/celebration4.jpg" >
        <![CDATA[Flash technology was used not only for the site's aesthetics -- its front-end -- but for its back-end as well, allowing for the utmost flexibility and intuitive interface. e37 CMS features interchangeable skins, real-time controls, 3D-like interface, ability to upload as many as 1,000 photographs in a single step, associative status indicator amid other features. ]]>
	  </image>
      <image src="pic/celebration5.jpg" >
        <![CDATA[]]>
	  </image>
    </imageList>
  </call>
</root>

*/
?>