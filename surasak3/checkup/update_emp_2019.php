<?php 
include 'bootstrap.php';

$action = $_POST['action'];

if( $action == 'update' ){

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);

    $i = 0;
    foreach ($items as $key => $item) { 

        list($hn, $temp, $p, $r, $bp1, $bp2, $weight, $height, $waist, $cig, $alc, $exc, $type, $clinic, $con, $drugreact) = explode(',', $item);

        $ht = $height/100;
        $bmi=number_format($weight /($ht*$ht),2);

        $sql = "UPDATE `dxofyear_out` SET 

        `height` = '$height' ,
        `weight` = '$weight' ,
        `round_` = '$waist' ,
        `temperature` = '$temp' ,
        `pause` = '$p' ,
        `rate` = '$r' ,
        `bmi` = '$bmi', 
        `bp1` = '$bp1' ,
        `bp2` = '$bp2' ,

        `drugreact` ='$drugreact' , 
        `cigarette` ='$cig'  , 
        `alcohol` ='$alc', 
        `exercise` ='$exc'  , 
        `congenital_disease` = '$con',
        `type` ='เดินมา'  , 
        `organ` ='ตรวจสุขภาพประจำปี62'  , 
        `clinic` ='12 เวชปฏิบัติ'  , 
        `doctor` ='MD065 พิศาล ศิริชีพชัยยันต์' 

        WHERE `hn` = '$hn' 
        AND `yearchk` = '62'  limit 1";

        
        $i++;
        
        if( $i == 1 ){
            continue;
        }

        $q = mysql_query($sql);
        dump($q);

        dump($sql);
        
    }

    exit;
}

?>

<form action="update_emp_2019.php" method="post" enctype="multipart/form-data">
<div>
    ไฟล์นำเข้า : <input type="file" name="file">
</div>
<div>
    <button type="submit">นำเข้า</button>
    <input type="hidden" name="action" value="update">
</div>
</form>

