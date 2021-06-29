<?php 

// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('smdb', $db2) or die( mysql_error() );

//
//-------------------- Create file diagnosis_opd ไฟล์ที่ 15 --------------------//
//
$sql10 = "SELECT `thidate`, `hn`, `vn`, `doctor`, `clinic`, SUBSTRING(`thidate`, 1, 10) AS `date2`, TRIM(`idcard`) AS `idcard`
FROM `opday` 
WHERE thidate LIKE '$thimonth%' 
AND ( `hn` != '' AND `vn` != '' ) 
GROUP BY CONCAT(SUBSTRING(`thidate`, 1, 10),`hn`)  
ORDER BY `thidate`";
$result10 = mysql_query($sql10, $db2) or die(mysql_error()."Query failed, Select diagnosis_opd");
$num = mysql_num_rows($result10);

$ii = 0;
$txt = '';

while (list ($thidate,$hn,$vn,$doctor,$clinic_name,$date2,$idcard) = mysql_fetch_row ($result10)) {
    
    $chkdate = substr($thidate,0,10);	
    $sqlopd = "SELECT  regisdate,icd10,type 
    From diag 
    where hn='$hn' 
    and svdate like '$chkdate%'
    GROUP BY `icd10`";
    
    $resultopd = mysql_query($sqlopd, $db2) or die( mysql_error() );	
    $numopd = mysql_num_rows($resultopd);
    
    if($numopd > 1){  //ถ้ามีหลาย record
        while(list($regisdate,$icd10,$type) = mysql_fetch_array($resultopd)){

            if(empty($icd10)){
                $diagcode = "Z538";
                $diagtype = "1";
            }else{
                $diagcode = $icd10;
                if($type == "PRINCIPLE"){ $diagtype = "1";}
                if($type == "CO-MORBIDITY"){ $diagtype = "2";}
                if($type == "COMPLICATION"){ $diagtype = "3";}
                if($type == "OTHER"){ $diagtype = "4";}
                if($type == "EXTERNAL CAUSE"){ $diagtype = "5";}	
            }
            
            // $newclinic = substr($clinic_name,0,2);
            // if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
            // if(!empty($vn)){ $firstcode="0";}
            // $treecode="00";
            // $clinic = $firstcode.$newclinic.$treecode;	

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
                $cliniccode = '99';
            }

            // แทนที่แผนจีนด้วยแพทย์ทางเลือก
            if($cliniccode=='88')
            {
                $cliniccode = '25';
            }

            $clinic = '0'.$cliniccode.'00';
        

            $regis1 = substr($thidate,0,10);
            $regis2 = substr($thidate,11,19);
            list($yy,$mm,$dd) = explode("-",$regis1);
            $yy = $yy-543;
            list($hh,$ss,$ii) = explode(":",$regis2);
            $d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

            $regis1 = substr($thidate,0,10);
            $regis2 = substr($thidate,11,19);
            list($yy,$mm,$dd) = explode("-",$regis1);
            $yy = $yy-543;
            $date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
            $vn = sprintf("%03d",$vn);	
            $seq = $date_serv.$vn;	  //ลำดับที่

            $sqldoc = mysql_query("select doctorcode from doctor where name like'%$doctor%'", $db2);
            list($doctorcode) = mysql_fetch_array($sqldoc);
            if(empty($doctorcode)){
                $provider = $seq."00000";
            }else{
                $provider = $seq.$doctorcode;
            }	

            $inline = "$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update|$idcard\r\n";
            $txt .= $inline;
            
        }  //close while

    }else{  //ถ้ามี 1 record
    
        list($regisdate,$icd10,$type) = mysql_fetch_array($resultopd);

        if(empty($icd10)){
            $diagcode = "Z538";
            $diagtype = "1";
        }else{
            $diagcode = $icd10;
            if($type == "PRINCIPLE"){ $diagtype = "1";}
            if($type == "CO-MORBIDITY"){ $diagtype = "2";}
            if($type == "COMPLICATION"){ $diagtype = "3";}
            if($type == "OTHER"){ $diagtype = "4";}
            if($type == "EXTERNAL CAUSE"){ $diagtype = "5";}	
        }
        
        // ถ้ามีตัวเลขนำหน้าแสดงว่าเป็นรหัสคลินิกแบบเก่า
        $test_match = preg_match('^\d{2}.+', $cliniccode, $matchs);
        if($test_match > 0){
            list($old_clinic_code, $name) = explode(' ', $cliniccode);
            $cliniccode = $name;

        }else{
            $q = mysql_query("SELECT `code` FROM `clinic` WHERE detail LIKE '$cliniccode%'") or die( mysql_error() );
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

        $regis1 = substr($thidate,0,10);
        $regis2 = substr($thidate,11,19);
        list($yy,$mm,$dd) = explode("-",$regis1);
        $yy = $yy-543;
        list($hh,$ss,$ii) = explode(":",$regis2);
        $d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

        $regis1 = substr($thidate,0,10);
        $regis2 = substr($thidate,11,19);
        list($yy,$mm,$dd) = explode("-",$regis1);
        $yy = $yy-543;
        $date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
        $vn = sprintf("%03d",$vn);	
        $seq = $date_serv.$vn;	  //ลำดับที่

        $sqldoc = mysql_query("select doctorcode from doctor where name like'%$doctor%'", $db2);
        list($doctorcode) = mysql_fetch_array($sqldoc);
        if(empty($doctorcode)){
            $provider = $date_serv.$vn."00000";
        }else{
            $provider = $date_serv.$vn.$doctorcode;
        }	

        $inline = "$hospcode|$hn|$seq|$date_serv|$diagtype|$diagcode|$clinic|$provider|$d_update|$idcard\r\n";
        $txt .= $inline;
        
    }  // close while
}  //close if
$filePath = $dirPath.'/diagnosis_opd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|DIAGTYPE|DIAGCODE|CLINIC|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_diagnosis_opd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม diagnosis_opd เสร็จเรียบร้อย<br>";