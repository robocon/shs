<?php 
include 'bootstrap.php';

$action = $_POST['action'];

if( $action == 'test' ){

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);

    $i = 0;
    foreach ($items as $key => $item) { 

        list($hn, $temp, $p, $r, $bp1, $bp2, $weight, $height, $waist, $cig, $alc, $exc, $type, $clinic, $con, $drugreact) = explode(',', $item);

        // $sql = "UPDATE `dxofyear_out` SET 

        // `height` = '$height' ,
        // `weight` = '$weight' ,
        // `round_` = '$waist' ,
        // `temperature` = '$temp' ,
        // `pause` = '$p' ,
        // `rate` = '$r' ,

        // `bp1` = '$bp1' ,
        // `bp2` = '$bp2' ,

        // `drugreact` ='$drugreact' , 
        // `cigarette` ='$cig'  , 
        // `alcohol` ='$alc', 
        // `exercise` ='$exc'  , 
        // `congenital_disease` = '$con',
        // `type` ='เดินมา'  , 
        // `organ` ='ตรวจสุขภาพประจำปี62'  , 
        // `clinic` ='12 เวชปฏิบัติ'  , 
        // `doctor` ='MD065 พิศาล ศิริชีพชัยยันต์' 

        // WHERE `hn` = '$hn' 
        // AND `yearchk` = '62'  limit 1";

        
        $i++;
        
        if( $i == 1 ){
            continue;
        }

        $sql = "SELECT `hn`,`ptname`,`stat_ua`,`reason_ua`,`stat_cbc`,`reason_cbc`,`cxr`,`reason_cxr`, 
        `stat_bs`,`reason_bs`,`stat_bun`,`reason_bun`,`stat_cr`,`reason_cr`,`stat_uric`,`reason_uric`,
        `stat_chol`,`reason_chol`,`stat_tg`,`reason_tg`,`stat_sgot`,`reason_sgot`,
        `stat_alk`,`reason_alk`,`general`,`reason_general`,`pap`,`reason_pap`,
        `stat_other1`,`reason_other1`,`stat_other2`,`reason_other2`,`dx`,`diag`,
        `status_dr`,`summary`,`sum1`,`sum2`
        FROM `condxofyear_out` WHERE `hn` = '$hn' AND `thidate` LIKE '2019-04%' ";
        dump($sql);
        $q = mysql_query($sql) or die( mysql_error() );

        $item = mysql_fetch_assoc($q);
        dump($item);





        // dump($sql);
        
    }

    exit;
}

?>

<form action="test_emp_2019.php" method="post" enctype="multipart/form-data">
<div>
    ไฟล์นำเข้า : <input type="file" name="file">
</div>
<div>
    <button type="submit">นำเข้า</button>
    <input type="hidden" name="action" value="test">
</div>
</form>

