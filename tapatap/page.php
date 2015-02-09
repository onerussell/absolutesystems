<?php

  $path = getcwd();

  $name = explode('/',$path);

  $ind = count($name) - 1;
  
  $mydir = dir($path);

  while(($file = $mydir->read()) !== false) {

      $filename = explode(".",$file);
      if( ($filename[1] == 'png') OR ($filename[1] == 'jpg')) {

		$img_name = $file;

      }
   }
   $mydir->close();

?>

<html>

<style type="text/css">
html, body, object {
height: 100%;
margin:0;
padding:0;
background:#FFF;}
</style>

<body>
<center>
<a href="..#<?=$name[$ind]?>">
<img src="<?=$img_name?>" border="0">
</a>
</center>
<body>

</html>
