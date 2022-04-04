<?php 
/**
 * วิธีเอาไปใช้งานคือ 
 * <img src="vertical_number.php?font=<?=$exam_no;?>" alt="">
 */
/*
width
-----
|   |
|   |  height
|   |
|   |
-----
*/
$im = imagecreate(40, 90);
// $im = imagecreatetruecolor(40, 90);
$string = $_REQUEST['font'];

$bg = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);


// prints a black "Z" on a white background
//imagecharup($im, 5, 10, 25, $string, $black);
$font_size = (empty($_REQUEST['font_size'])) ? 5 : $_REQUEST['font_size'] ;

/**
 * Fix from : https://www.php.net/manual/en/function.imagecharup.php 
 * Read first comment
 */
// $len = strlen($string);
// for ($i=1; $i<=$len; $i++) { 
//     imagecharup($im, $font_size, 4, imagesy($im)-($i*imagefontwidth($font_size)), $string, $black);
//     $string = substr($string,1);
// }

// $white = imagecolorallocate($im, 255, 255, 255);
// imagefill($im, 0, 0, $white);

imagestringup($im, 5, 40, 90, $string, $black);

//header('Content-type: image/png');
imagepng($im);