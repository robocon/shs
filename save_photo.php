<?php 

include_once 'surasak3/connection.php';
include_once 'surasak3/includes/JSON.php';

$raw_content = file_get_contents('php://input');

$json = new Services_JSON();
$data = $json->decode($raw_content);

$idcard = $data->idCard;
$rawPhoto = $data->rawPhoto;
if(!empty($idcard) && !empty($rawPhoto))
{
    $img_path = dirname(__FILE__).'/image_patient/'.$idcard.'.jpg';
    
    $rawPhoto = base64_decode($rawPhoto);
    $im = imagecreatefromstring($rawPhoto);
    $res_img = imagejpeg($im, $img_path, 85);
    echo "success";
}
else
{
    echo "fail";
}
exit;