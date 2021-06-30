<?php 

// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('rdu_test', $db2) or die( mysql_error() );

// $where_thdate = " thdatehn LIKE '$thdate_opday%' ";
// if (strlen($thdate_opday)==7) {
//     $where_thdate = " thdatehn LIKE '%$thdate_opday%' ";
// }


//-------------------- Create file procedure_opd ไฟล์ที่ 11 --------------------//
$temp11 = "SELECT thidate, hn, vn, doctor, clinic, icd9cm, TRIM(idcard) AS `idcard` 
FROM opday 
WHERE thidate LIKE '$thimonth%' 
AND icd9cm IS NOT NULL 
AND icd9cm <> '' 
ORDER BY thidate ASC";
$querytmp11 = mysql_query($temp11) or die("Query failed,Create temp11 : ".mysql_error());

$txt = '';
while (list ($thidate,$hn,$vn,$doctor,$clinic_name,$procedcode, $idcard) = mysql_fetch_row($querytmp11)) {	
	
    // ถ้ามีตัวเลขนำหน้าแสดงว่าเป็นรหัสคลินิกแบบเก่า
    $test_match = preg_match('^\d{2}.+', $clinic_name, $matchs);
    if($test_match > 0){
        list($old_clinic_code, $name) = explode(' ', $clinic_name);
        $cliniccode = $name;

    }else{
        $q = mysql_query("SELECT `code` FROM `clinic` WHERE detail LIKE '$clinic_name%'") or die( mysql_error() );
        if( mysql_num_rows($q) > 0 ){
            $item = mysql_fetch_assoc($q);
            $cliniccode = $item['code'];
        }
    }

    // ถ้าไม่มีเลยให้ default เป็น 99
    if (empty($cliniccode)) {
        $cliniccode = 99;
    }

    // แทนที่แผนจีนด้วยแพทย์ทางเลือก
    if($cliniccode=='88')
    {
        $cliniccode = '25';
    }

    $clinic = '0'.$cliniccode.'00';
    

    $regis1=substr($thidate,0,10);
    $regis2=substr($thidate,11,19);
    list($yy,$mm,$dd)=explode("-",$regis1);
    $yy=$yy-543;
    list($hh,$ss,$ii)=explode(":",$regis2);
    $d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

    // SEQ + DATE_SERV
    // if ( preg_match('/(\d+)\s(.+)/', $clinicName, $matchs) > 0 ) {
        
    //     $clinicCode = $matchs['1'];

    // }elseif( $clinicName !== null ){
    //     $db->select("SELECT `code` FROM `f43_clinic` WHERE `detail` = '$clinicName' ");
    //     $clinicDb = $db->get_item();
    //     $clinicCode = $clinicDb['code'];
    // }else{
    //     $clinicCode = '99';
    // }

    // $date_serv = date('Ymd', strtotime($d_update));
    // $date_serv = $s1;

    $date_serv = "$yy$mm$dd";
    
    $vn = sprintf("%03d",$vn);
    // $seq = $s1.$cliniccode.$vn;
    $seq = $date_serv.$vn;

    // PROVIDER
    // ถ้าในชื่อมีเลข ว.
    if ( preg_match('/(\d+){4,5}/', $doctor, $matchs) > 0 ) {
        $doctorcode = $matchs['0'];

    }elseif( preg_match('/MD\d+/', $doctor) > 0 ){
        $prefixMd = substr($doctor,0,5);

        $sqlDR = "SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$prefixMd%' ";
        $qDR = mysql_query($sqlDR);
        $dr = mysql_fetch_assoc($qDR);
        $doctorcode = $dr['doctorcode'];

    }

    if( !empty($doctorcode) ){
        $qtb9 = mysql_query("SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ");
        $tb = mysql_fetch_assoc($qtb9);
        if (mysql_num_rows($tb) > 0) {
            $provider = $tb['PROVIDER'];
        }else{
            $provider = '00000000000000';
        }
        
    }else{
        $provider = '00000000000000';
    }
    // PROVIDER

    $serviceprice="0.00";

    $txt .= "$hospcode|$hn|$seq|$date_serv|$clinic|$procedcode|$serviceprice|$provider|$d_update|$idcard\r\n";
    
    
}  //close while

$filePath = $dirPath.'/procedure_opd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|SEQ|DATE_SERV|CLINIC|PROCEDCODE|SERVICEPRICE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_procedure_opd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม procedure_opd เสร็จเรียบร้อย<br>";
//-------------------- Close file procedure_opd ไฟล์ที่ 11 --------------------//