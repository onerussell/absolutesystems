<?php
include 'top.php';
//[$bcol][fcol]: backcolor ??
error_reporting(0);
session_start();
$turing_number = rand(100001,999999);
header("Content-type: image/jpeg"); 

$im = imagecreatefromjpeg('bb.jpg');
$black = ImagecolorAllocate($im,0,0,0); 
$fcol = $black;
//Out
// binmode STDOUT; 
// ImageString($im,2,2,0,$turing_number,$fcol);
ImageString($im,2,3,1,$turing_number,$fcol);
ImageJPEG($im); 
$_SESSION['turing_number'] = $turing_number;
?>