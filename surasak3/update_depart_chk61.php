<?php 
// $db2 = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
$db2 = mysql_connect('192.168.1.2', 'remoteuser', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

?>

<form action="update_depart_chk61.php" method="post">

    <div>
        HN: <input type="text" name="hn" id="">
    </div>

    <div>
        <button type="submit">บันทึก</button>
        <input type="hidden" name="action" value="save">
    </div>

</form>

<?php

$action = $_POST['action'];

if( $action == 'save' ){

    $hn = $_POST['hn'];

    ##################################
    ## หาข้อมูลแลปที่จะตรวจจากตารางหลัก 
    ##################################
    $sql_lab_pretest = "SELECT a.*, b.`exam_no`,b.`agey`
    FROM `lab_pretest` AS a 
    LEFT JOIN `opcardchk` AS b ON b.`HN` = a.`hn` 
    WHERE b.`part` = 'ลูกจ้าง61' 
    AND a.`hn` = '$hn' ";
    $q_pretest = mysql_query($sql_lab_pretest, $db2) or die( mysql_error() );
    $user = mysql_fetch_assoc($q_pretest);

    ##################################
    ## วันที่เคยออก VN 
    ##################################
    $sql_opday = "SELECT `thidate`,`vn`,`ptright` 
    FROM `opday` 
    WHERE `thidate` LIKE '2561-04%' 
    AND `hn` = '$hn' 
    AND `toborow` LIKE 'EX46%' ";
    $q_opday = mysql_query($sql_opday, $db2) or die( mysql_error() );
    $opday = mysql_fetch_assoc($q_opday);

    ##################################
    ## เตรียมข้อมูลลง depart
    ##################################
    $Thidate = $opday['thidate'];
    $cPtname = $user['ptname'];
    $cHn = $user['hn'];
    $cAn = '';
    $cDoctor = 'MD022 (ไม่ทราบแพทย์)';
    $cDepart = 'PATHO';
    $aDetail = 'ค่าตรวจวิเคราะห์โรค';
    $sOfficer = 'สมยศ แสงสุข';
    $cDiag = 'ตรวจสุขภาพประกันสังคม';
    $cAccno = 0;
    $tvn = $opday['vn'];
    $cPtright = $opday['ptright'];
    $cstaf_massage = '';
    $nLab = $user['exam_no'];

    ##################################
    ## รายการตรวจตามสิทธิของประกันสังคม
    ##################################
    $sso_list = array();
    $sso_diff_list = array();
    if( !empty($user['cbc']) ){
        $sso_list[] = 'cbc-sso';
        $sso_diff_list[] = 'cbc';
    }
    if( !empty($user['ua']) ){
        $sso_list[] = 'ua-sso';
        $sso_diff_list[] = 'ua';
    }
    if( !empty($user['bs']) ){
        $sso_list[] = 'bs-sso';
        $sso_diff_list[] = 'bs';
    }
    if( !empty($user['cr']) ){
        $sso_list[] = 'cr-sso';
        $sso_diff_list[] = 'cr';
    }
    if( !empty($user['chol']) ){
        $sso_list[] = 'chol-sso';
        $sso_diff_list[] = 'chol';
    }
    if( !empty($user['hdl']) ){
        $sso_list[] = 'hdl-sso';
        $sso_diff_list[] = 'hdl';
    }
    if( !empty($user['hbsag']) ){
        $sso_list[] = 'hbsag-sso';
        $sso_diff_list[] = 'hbsag';
    }
    if( !empty($user['fobt']) ){
        $sso_list[] = 'stocb-sso';
        $sso_diff_list[] = 'stocb';
    }
    sort($sso_list); // เรียงตัวอักษรใหม่ 

    
    $item_count = count($sso_list);
    $net_price = (float) 0;
    $sum_y_price = (float) 0;
    $sum_n_price = (float) 0;

    foreach ($sso_list as $key => $sso_item) {
        
        $sql_labcare = "SELECT `code`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$sso_item'";
        $q_labcare = mysql_query($sql_labcare, $db2) or die( mysql_error() );
        $lab = mysql_fetch_assoc($q_labcare);
        
        // sum สำหรับ depart
        $net_price += (float) $lab['price'];
        $sum_y_price += (float) $lab['yprice'];
        $sum_n_price += (float) $lab['nprice'];

    }

    $net_price = number_format($net_price, 2,'.','');
    $sum_y_price = number_format($sum_y_price, 2,'.','');
    $sum_n_price = number_format($sum_n_price, 2,'.','');

    ##################################
    ## อ่านและเซ็ตเลข runno 
    ##################################
    mysql_query("LOCK TABLES `runno` READ", $db2) or die( mysql_error() );
    $q_runno = mysql_query("SELECT * FROM `runno` WHERE `title` = 'depart' ", $db2) or die( mysql_error() );
    $test_run = mysql_fetch_assoc($q_runno);
    mysql_query("UNLOCK TABLES", $db2) or die( mysql_error() );

    $nRunno = $test_run['runno'] + 1;
    mysql_query("LOCK TABLES `runno` WRITE", $db2) or die( mysql_error() );
    mysql_query("UPDATE runno SET runno = $nRunno WHERE title='depart'", $db2) or die( mysql_error() );
    mysql_query("UNLOCK TABLES", $db2) or die( mysql_error() );
    // อ่านและเซ็ตเลข runno

    $sql_depart = "INSERT INTO `depart` (
        `chktranx`,`date`,`ptname`,`hn`,`an`,
        `doctor`,`depart`,`item`,`detail`,`price`,
        `sumyprice`,`sumnprice`,`paid`,`idname`,`diag`,
        `accno`,`tvn`,`ptright`,`lab`,`cashok`,`staf_massage` 
    )VALUES( 
        '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
        '$cDoctor','$cDepart','$item_count','$aDetail', '$net_price',
        '$sum_y_price','$sum_n_price','','$sOfficer','$cDiag',
        '$cAccno','$tvn','$cPtright','$nLab','SSOCHECKUP61','$cstaf_massage'
    );";
    dump($sql_depart);
    $res_depart = mysql_query($sql_depart, $db2);
    dump($res_depart);
    $last_id = mysql_insert_id($db2);

    $price = 0;
    $yprice = 0;
    $nprice = 0;

    foreach ($sso_list as $key => $sso_item) { 

        $sql_labcare = "SELECT `code`,`detail`,`part`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$sso_item'";
        $q_labcare = mysql_query($sql_labcare, $db2) or die( mysql_error() );
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
        $res_patdata = mysql_query($sql_patdata, $db2) or die( mysql_error() );
        dump($res_patdata);

    }

    $sql_opacc = "INSERT INTO `opacc` ( 
        `date`,`txdate`,`hn`,`an`,`depart`,
        `detail`,`price`,`paid`,`idname`,`essd`,
        `nessdy`,`nessdn`,`dpy`,`dpn`,`dsy`,
        `dsn`,`ptright`,`credit`,`paidcscd` 
    ) VALUES( 
        '$Thidate','$Thidate','$cHn','$cAn','$cDepart',
        '$aDetail','$net_price','$net_price','นาง พวงเพ็ชร โนใจปิง', NULL,
        NULL,NULL,NULL,NULL,NULL,
        NULL,'$cPtright','SSOCHECKUP61','$net_price' 
    );";
    dump($sql_opacc); 
	$res_opacc = mysql_query($sql_opacc, $db2) or die( mysql_error() );
    dump($res_opacc);













    echo "<hr>";
    ##################################
    ## ตรวจตามรายการของ รพ. ตามช่วงอายุ
    ##################################
    $shs_list = array('cbc','ua');
    if( $user['agey'] >= 35 ){
        $shs_list = array('cbc','ua','bs','ldl','hdl','bun','cr','sgot','sgpt','alk');
    }
    sort($shs_list); // เรียงตัวอักษรใหม่ 


    // ถ้ามีรายการตรวจซ้ำซ้อนกับของ ปกส จะลบออกจากรายการ
    foreach( $shs_list AS $key => $shs_item ){
        if( in_array($shs_item, $sso_diff_list) === true ){
            unset($shs_list[$key]);
        }
    }

    
    $cDiag = 'ตรวจวิเคราะห์เพื่อการรักษา';

    $item_count = count($shs_list);
    $net_price = (float) 0;
    $sum_y_price = (float) 0;
    $sum_n_price = (float) 0;

    foreach ($shs_list as $key => $shs_item) {
        
        $sql_labcare = "SELECT `code`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$shs_item'";
        $q_labcare = mysql_query($sql_labcare, $db2) or die( mysql_error() );
        $lab = mysql_fetch_assoc($q_labcare);
        
        // sum สำหรับ depart
        $net_price += (float) $lab['price'];
        $sum_y_price += (float) $lab['yprice'];
        $sum_n_price += (float) $lab['nprice'];

    }

    $net_price = number_format($net_price, 2,'.','');
    $sum_y_price = number_format($sum_y_price, 2,'.','');
    $sum_n_price = number_format($sum_n_price, 2,'.','');

    // อ่านและเซ็ตเลข runno 
    mysql_query("LOCK TABLES `runno` READ", $db2) or die( mysql_error() );
    $q_runno = mysql_query("SELECT * FROM `runno` WHERE `title` = 'depart' ", $db2) or die( mysql_error() );
    $test_run = mysql_fetch_assoc($q_runno);
    mysql_query("UNLOCK TABLES", $db2) or die( mysql_error() );

    $nRunno = $test_run['runno'] + 1;
    mysql_query("LOCK TABLES `runno` WRITE", $db2) or die( mysql_error() );
    mysql_query("UPDATE runno SET runno = $nRunno WHERE title='depart'", $db2) or die( mysql_error() );
    mysql_query("UNLOCK TABLES", $db2) or die( mysql_error() );
    // อ่านและเซ็ตเลข runno

    $sql_depart = "INSERT INTO `depart` (
        `chktranx`,`date`,`ptname`,`hn`,`an`,
        `doctor`,`depart`,`item`,`detail`,`price`,
        `sumyprice`,`sumnprice`,`paid`,`idname`,`diag`,
        `accno`,`tvn`,`ptright`,`lab`,`cashok`,`staf_massage` 
    )VALUES( 
        '$nRunno','$Thidate','$cPtname','$cHn','$cAn',
        '$cDoctor','$cDepart','$item_count','$aDetail', '$net_price',
        '$sum_y_price','$sum_n_price','','$sOfficer','$cDiag',
        '$cAccno','$tvn','$cPtright','$nLab','SSOCHKUP61','$cstaf_massage'
    );";
    dump($sql_depart);
    $res_depart = mysql_query($sql_depart, $db2);
    dump($res_depart);
    $last_id = mysql_insert_id($db2);

    $price = 0;
    $yprice = 0;
    $nprice = 0;

    foreach ($shs_list as $key => $shs_item) { 

        $sql_labcare = "SELECT `code`,`detail`,`part`,`price`,`yprice`,`nprice` FROM `labcare` WHERE `code` LIKE '$shs_item'";
        $q_labcare = mysql_query($sql_labcare, $db2) or die( mysql_error() );
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
        $res_patdata = mysql_query($sql_patdata, $db2) or die( mysql_error() );
        dump($res_patdata);

    }

    
    $sql_opacc = "INSERT INTO `opacc` ( 
        `date`,`txdate`,`hn`,`an`,`depart`,
        `detail`,`price`,`paid`,`idname`,`essd`,
        `nessdy`,`nessdn`,`dpy`,`dpn`,`dsy`,
        `dsn`,`ptright`,`credit`,`paidcscd` 
    ) VALUES( 
        '$Thidate','$Thidate','$cHn','$cAn','$cDepart',
        '$aDetail','$net_price','$net_price','นาง พวงเพ็ชร โนใจปิง', NULL,
        NULL,NULL,NULL,NULL,NULL,
        NULL,'$cPtright','SSOCHKUP61','$net_price' 
    );";
    dump($sql_opacc); 
	$res_opacc = mysql_query($sql_opacc, $db2) or die( mysql_error() );
    dump($res_opacc);


    



}