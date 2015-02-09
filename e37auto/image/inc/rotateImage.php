<?
   define("IMAGE_FLIP_HORIZONTAL",    1);
   define("IMAGE_FLIP_VERTICAL",    2);
   define("IMAGE_FLIP_BOTH",    3);

function ImageFlip($imgsrc, $type)
{
   $width = imagesx($imgsrc);
   $height = imagesy($imgsrc);

   $imgdest = imagecreatetruecolor($width, $height);

   switch( $type )
       {
       // mirror wzgl. osi
       case IMAGE_FLIP_HORIZONTAL:
           for( $y=0 ; $y<$height ; $y++ )
               imagecopy($imgdest, $imgsrc, 0, $height-$y-1, 0, $y, $width, 1);
           break;

       case IMAGE_FLIP_VERTICAL:
           for( $x=0 ; $x<$width ; $x++ )
               imagecopy($imgdest, $imgsrc, $width-$x-1, 0, $x, 0, 1, $height);
           break;

       case IMAGE_FLIP_BOTH:
           for( $x=0 ; $x<$width ; $x++ )
               imagecopy($imgdest, $imgsrc, $width-$x-1, 0, $x, 0, 1, $height);

           $rowBuffer = imagecreatetruecolor($width, 1);
           for( $y=0 ; $y<($height/2) ; $y++ )
               {
               imagecopy($rowBuffer, $imgdest  , 0, 0, 0, $height-$y-1, $width, 1);
               imagecopy($imgdest  , $imgdest  , 0, $height-$y-1, 0, $y, $width, 1);
               imagecopy($imgdest  , $rowBuffer, 0, $y, 0, 0, $width, 1);
               }

           imagedestroy( $rowBuffer );
           break;
       }

   return( $imgdest );
} 



// $imgSrc - GD image handle of source image 
// $angle - angle of rotation. Needs to be positive integer 
// angle shall be 0,90,180,270, but if you give other it 
// will be rouned to nearest right angle (i.e. 52->90 degs, 
// 96->90 degs) 
// returns GD image handle of rotated image. 
function ImageRotateRightAngle( $imgSrc, $angle ) 
{ 
   // ensuring we got really RightAngle (if not we choose the closest one) 
   $angle = min( ( (int)(($angle+45) / 90) * 90), 270 ); 

   // no need to fight 
   if( $angle == 0 ) 
       return( $imgSrc ); 

   // dimenstion of source image 
   $srcX = imagesx( $imgSrc ); 
   $srcY = imagesy( $imgSrc ); 

   switch( $angle ) 
       { 
       case 90: 
           $imgDest = imagecreatetruecolor( $srcY, $srcX ); 
           for( $x=0; $x<$srcX; $x++ ) 
               for( $y=0; $y<$srcY; $y++ ) 
                   imagecopy($imgDest, $imgSrc, $srcY-$y-1, $x, $x, $y, 1, 1); 
           break; 

       case 180: 
           $imgDest = ImageFlip( $imgSrc, IMAGE_FLIP_BOTH ); 
           break; 

       case 270: 
           $imgDest = imagecreatetruecolor( $srcY, $srcX ); 
           for( $x=0; $x<$srcX; $x++ ) 
               for( $y=0; $y<$srcY; $y++ ) 
                   imagecopy($imgDest, $imgSrc, $y, $srcX-$x-1, $x, $y, 1, 1); 
           break; 
       } 

   return( $imgDest ); 
} 
?> 