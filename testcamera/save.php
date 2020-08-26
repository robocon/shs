<?php 
set_time_limit(0);
require __DIR__ . "/vendor/autoload.php";
use PHPZxing\PHPZxingDecoder;

define('UPLOAD_DIR', '');

$imgLists = $_POST['imgScan'];
$barcodeLists = array();
foreach ($imgLists as $key => $img) {
    
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = UPLOAD_DIR . uniqid() . '.png';
    $success = file_put_contents($file, $data);
    $barcodeLists[] = $file;
}

sleep(1);

$config = array(
    'try_harder'            => true,
    'multiple_bar_codes' => true
);
$decoder        = new PHPZxingDecoder($config);
$decoder->setJavaPath("G:\ScannerRegis\LibericaJDK-8-Full\bin\java.exe");

foreach ($barcodeLists as $key => $bc) {
    
    $decodedData    = $decoder->decode($bc);
    echo "<pre>";
    print_r($decodedData);
    echo "</pre>";

}



