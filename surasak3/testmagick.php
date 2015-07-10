<?php

if(!class_exists('Imagick')){
	echo 'Please install Imagick';
	exit;
}

$dir = __DIR__;
$test_file = strtolower("$dir/G31D.TIF");

if(file_exists($test_file)){
	
	try {
		$file_name = basename($test_file, ".tif");
		
		$image = new Imagick();
		$image->readImage($test_file);
		$image->writeImage("$dir/new_$file_name.png");
		
		echo 'Convert Success';
		echo '<img src="new_'.$file_name.'.png">';
	}

	//catch exception
	catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
	}

}else{
	echo "Can not find $test_file in system path";
	exit;
}
?>
