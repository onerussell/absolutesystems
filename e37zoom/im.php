<?php

function getmicrotime()
{
  list($usec, $sec) = explode(" ",microtime());
   return ((float)$usec + (float)$sec);
}

$time = getmicrotime();
require_once 'Image/Transform.php';

define('IMAGE_TRANSFORM_IM_PATH', '/usr/local/bin/'); 
$a = Image_Transform::factory('IM');
// factory pattern - returns an object
$a->load("/var/www/site06/e37zoom/big2.jpg");

//$a->crop(400,400, 400, 100);

$a->scale(0.01);
//$a->scalebyPercentage(25);

// load the image file

// scale image by percentage - 40% of its original size
$a->display('JPG',80);

// displays the image
$a->free();
$t1 = getmicrotime() - $time;
error_log("time elapsed: $t1 seconds");
?>