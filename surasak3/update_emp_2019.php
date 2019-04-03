<?php 


$action = $_POST['action'];

if( $action == 'update' ){

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);

    foreach ($items as $key => $item) {
        list($hn, $temp, $p, $r, $bp1, $bp2, $weight, $height, $waist, $cig, $alc, $exc, $type, $clinic, $con, $drugreact) = explode(',', $item);

        $sql = "UPDATE `dxofyear_out` SET 

        `height` = '$height' ,
        `weight` = '$weight' ,
        `round_` = '$waist' ,
        `temperature` = '$temp' ,
        `pause` = '$p' ,
        `rate` = '$r' ,

        `bp1` = '$bp1' ,
        `bp2` = '$bp2' ,


        `drugreact` ='$drugreact' , 
        `cigarette` ='$cig'  , 
        `alcohol` ='$alc', 
        `exercise` ='$exc'  , 
        `congenital_disease` = '$con'
        `type` ='เดินมา'  , 
        `organ` ='ตรวจสุขภาพประจำปี62'  , 
        `clinic` ='12 เวชปฏิบัติ'  , 
        `doctor` ='MD065 พิศาล ศิริชีพชัยยันต์', 


        WHERE `hn` = '$hn' 
        AND `yearchk` = '62'  limit 1";

    }

    exit;
}



