<?php
// create a 100*100 image
$im = imagecreatetruecolor(25, 90);

// Write the text
// $red = imagecolorallocate($im, 255, 0, 0);
$red = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
imagefill($im, 0, 0, $red);

// $textcolor = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
$red = imagecolorallocate($im, 0, 0, 0);
imagestringup($im, 5, 4, 80, '301', $red);

header('Content-type: image/png');
// Save the image
imagepng($im);
imagedestroy($im);