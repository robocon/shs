<?php 
include 'bootstrap.php';

// ข้าราชการ
$db = Mysql::load();




$sql = "SELECT a.*,b.`vn`,b.`thidate`,b.`ptname`,b.`ptright` 
FROM `opcardchk` AS a 
LEFT JOIN ( 
    SELECT * FROM `opday` WHERE `thidate` LIKE '2561-09-20%' 
) AS b ON b.`hn` = a.`hn`
WHERE a.`part` = 'lpru61' 

AND ( a.`HN` = '61-6056' OR a.`HN` = '51-4968' OR a.`HN` = '48-19666' OR a.`HN` = '49-5922' )

ORDER BY a.`row` ASC";



$db->select($sql);
$items = $db->get_items();



foreach( $items as $key => $item ){ 
    

    $lab_list = explode('|', $item['course']);


    ##################################
    ## เตรียมข้อมูลลง depart
    ##################################
    $Thidate = $item['thidate'];
    $cPtname = $item['ptname'];
    $cHn = $item['HN'];
    $cAn = '';
    $cDoctor = 'MD022 (ไม่ทราบแพทย์)';
    $cDepart = 'PATHO';
    $aDetail = 'ค่าตรวจวิเคราะห์โรค';
    $sOfficer = 'สมยศ แสงสุข';
    $cDiag = 'ตรวจสุขภาพ';
    $cAccno = 0;
    $tvn = $item['vn'];
    $cPtright = $item['ptright'];
    $cstaf_massage = '';
    $nLab = $item['exam_no'];


    ##################################
    ## อ่านและเซ็ตเลข runno สำหรับ depart
    ##################################
    mysql_query("LOCK TABLES `runno` READ") or die( mysql_error() );
    $q_runno = mysql_query("SELECT * FROM `runno` WHERE `title` = 'depart' ") or die( mysql_error() );
    $test_run = mysql_fetch_assoc($q_runno);
    mysql_query("UNLOCK TABLES") or die( mysql_error() );

    $nRunno = $test_run['runno'] + 1;
    mysql_query("LOCK TABLES `runno` WRITE") or die( mysql_error() );
    mysql_query("UPDATE runno SET runno = $nRunno WHERE title='depart'") or die( mysql_error() );
    mysql_query("UNLOCK TABLES") or die( mysql_error() );


    ##################################
    ## คิดค่าใช้จ่าย
    ##################################
    $item_count = 11;
    $net_price = (float) 0;
    $sum_y_price = (float) 0;
    $sum_n_price = (float) 0;


    // คีย์เอา id เพื่อใส่ใน patdata
    $sql_depart = "INSERT INTO `depart` (
        `chktranx`,`date`,`ptname`,`hn`,`an`,
        `doctor`,`depart`,`item`,`detail`,`price`,
        `sumyprice`,`sumnprice`,`paid`,`idname`,`diag`,
        `accno`,`tvn`,`ptright`,`lab`,`cashok`,`staf_massage` 
    )VALUES( 
        '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
        '$cDoctor','$cDepart','$item_count','$aDetail', '$net_price',
        '$sum_y_price','$sum_n_price','','$sOfficer','$cDiag',
        '$cAccno','$tvn','$cPtright','$nLab','','$cstaf_massage'
    );";
    dump($sql_depart);
    $res_depart = mysql_query($sql_depart);
    dump($res_depart);
    $last_id = mysql_insert_id();
    dump($last_id);
    

    foreach ($lab_list as $key => $lab_code) {
        
        // dump($lab_code);
        $sql_labcare = "SELECT `code`,`detail`,`part`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$lab_code'";
        $q_labcare = mysql_query($sql_labcare) or die( mysql_error() );

        $labcare_row = mysql_num_rows($q_labcare);
        if( $labcare_row > 0 ){

            $lab = mysql_fetch_assoc($q_labcare);

            $price = number_format($lab['price'], 2,'.','');
            $yprice = number_format($lab['yprice'], 2,'.','');
            $nprice = number_format($lab['nprice'], 2,'.','');
            $detail = $lab['detail'];
            $part = $lab['part'];
            $lab_code = $lab['code'];
        
            $sql_patdata = "INSERT INTO `patdata` (
                `date`,`hn`,`an`,`ptname`,`doctor`,
                `item`,`code`,`detail`,`amount`,`price`,
                `yprice`,`nprice`,`depart`,`part`,`idno`,
                `ptright`,`film_size`  
            ) VALUES( 
                '$Thidate','$cHn','$cAn','$cPtname','$cDoctor',
                '$item_count','$lab_code','$detail','1','$price',
                '$yprice','$nprice','$cDepart','$part','$last_id',
                '$cPtright',''
            );";
            dump($sql_patdata);
            $res_patdata = mysql_query($sql_patdata) or die( mysql_error() );
            dump($res_patdata);

            ############################################################3

            // sum สำหรับ depart
            $net_price += (float) $lab['price'];
            $sum_y_price += (float) $lab['yprice'];
            $sum_n_price += (float) $lab['nprice'];

        }
    }

    $net_price = number_format($net_price, 2,'.','');
    $sum_y_price = number_format($sum_y_price, 2,'.','');
    $sum_n_price = number_format($sum_n_price, 2,'.','');

    
    $depart_update_sql = "UPDATE `depart` SET  
    `price` =  '$net_price', 
    `sumyprice` =  '$sum_y_price', 
    `sumnprice` =  '$sum_n_price' 
    WHERE `row_id` = '$last_id' LIMIT 1 ;";
    dump($depart_update_sql);
    $res_update_depart = mysql_query($depart_update_sql) or die( mysql_error() );
    dump($res_update_depart);

    echo "<hr>";
}
?>