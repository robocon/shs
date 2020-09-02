<?php 
/**
 * วิธีเอาไปใช้งานคือ 
 * <img src="vertical_number.php?font=<?=$exam_no;?>" alt="">
 */
$im = imagecreate(40, 40);

$string = $_REQUEST['font'];

$bg = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

// prints a black "Z" on a white background
//imagecharup($im, 5, 10, 25, $string, $black);
$font_size = 5;

/**
 * Fix from : https://www.php.net/manual/en/function.imagecharup.php 
 * Read first comment
 */
$len = strlen($string);
for ($i=1; $i<=$len; $i++) {
    imagecharup($im, $font_size, 5, imagesy($im)-($i*imagefontwidth($font_size)), $string, $black);
    $string = substr($string,1);
}

//header('Content-type: image/png');
imagepng($im);