<?php
session_start();
if (!isset($sIdname)){ exit(); } //for security

if($cPtname == "" || $cHn == "" || $cDoctor == "" || $cDepart==""){
    echo "ขออภัยครับระบบมีความผิดพลาดเล็กน้อย กรุณาปิดโปรแกรมโรงพยาบาลและทำการเข้าระบบใหม่ครับ";
    exit();
}

// เลือกวันที่เริ่มตรวจ และสิ้นสุด
$date_start_th = ( isset($_SESSION['date_start']) && !empty($_SESSION['date_start']) ) ? $_SESSION['date_start'] : false ;
$date_end_th =  ( isset($_SESSION['date_end']) && !empty($_SESSION['date_start']) ) ? $_SESSION['date_end'] : false ;

$thaimonthFull = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");

//item count
$item=0;
for ($n=1; $n<=$x; $n++){
    if ( !empty($aDgcode[$n]) ){
        $item++;
    }
}

include("connect.inc");

//เลข LAB
$query = "SELECT * FROM runno WHERE title = 'nid_c'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
    
    if(!($row = mysql_fetch_object($result)))
        continue;
}

//  	    $cTitle=$row->title;  //=VN
$nNid=$row->runno;
$fNid=$row->prefix;
$today = date("Y-m-d"); 

$nRunno=$fNid.''.$nNid;
$cPart='nid';

//insert data into depart
$thidate5 = (date("Y")+543).date("-m-d H:i:s"); 
$query = "INSERT INTO medicalcertificate (thidate,number,hn,part,doctor)VALUES(' $thidate5','$nRunno','$cHn','$cPart','$cDoctor');";
$result = mysql_query($query) or die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>");

$dateNow = date('Y-m-d');
$sql = "SELECT * FROM `medicalcertificate` 
WHERE `hn` = '$cHn' 
AND `part` = '$cPart' 
AND ( `date_start` <= '$dateNow' AND `date_start` IS NOT NULL ) 
AND ( `date_end` >= '$dateNow' AND `date_end` IS NOT NULL ) ";
$q = mysql_query($sql) or die( mysql_error() );
$rows = mysql_num_rows($q);

$showStart = 0;

// ถ้ายังไม่มีข้อมูลวันที่เริ่มตรวจ และวันที่สิ้นสุด
if( $rows == 0 && $date_start_th !== false && $date_end_th !== false ){
    list($sy, $sm, $sd) = explode('-', $date_start_th);
    list($ey, $em, $ed) = explode('-', $date_end_th);
    
    $txt_date_start = $sd.' '.$thaimonthFull[$sm].' '.$sy;
    $txt_date_end = $ed.' '.$thaimonthFull[$em].' '.$ey;
    
    $date_start = ( $sy - 543 )."-$sm-$sd";
    $date_end = ( $ey - 543 )."-$em-$ed";
    
    $sql = "UPDATE `medicalcertificate` 
    SET `date_start` = '$date_start', `date_end` = '$date_end' 
    WHERE `number` = '$nRunno' ";
    mysql_query($sql);
    $showStart = 1;
    
    $_SESSION['date_start'] = null;
    $_SESSION['date_end'] = null;
}



$cDoctor1 = substr($cDoctor,5,50);
// ถ้านำหน้าด้วย NID ให้ตัดออก
if( preg_match('/NID\s/',$cDoctor, $matchs) > 0 ){
    $cDoctor1 = str_replace('NID ','',$cDoctor);
}

$cDoctor2 = substr($cDoctor,0,5);

/*if($cDoctor2=='MD054'){$doctorcode='ว.13553';}else
if($cDoctor2=='MD052'){$doctorcode='ว.14286';}else
if($cDoctor2=='MD037'){$doctorcode='ว.10212';}else
if($cDoctor2=='MD089'){$doctorcode='ว.32166';}else{$doctorcode='';};*/


$Thaidate1=substr($Thaidate,0,10);
$licen = '';

// แพทย์แผนจีน
if( $cDoctor2 === 'MD115' ){

    $subDoctor = (int) $_GET['subDoctor'];
    if( $subDoctor === 1 ){
        $yot = 'นาย';
        $cDoctor1 = 'ภาคภูมิ พิสุทธิวงษ์';
        $doctorcode = 'พจ. 714';
    }else if( $subDoctor === 2 ){
        $yot = 'น.ส.';
        $cDoctor1 = "ศศิภา ศิริรัตน์";
        $doctorcode = "พจ. 819";
    }else if( $subDoctor === 3 ){
        $yot = 'น.ส.';
        $cDoctor1 = "กันยกร มาเกตุ";
        $doctorcode = "พจ. 907";
    }else if( $subDoctor === 4 ){
        $yot = 'นาย';
        $cDoctor1 = "ศุภกิตติ มงคล";
        $doctorcode = "พจ. 1254";
    }

    $position = "แพทย์แผนจีน";
    $certificate = "ใบอนุญาตประกอบโรคศิลปะ สาขาการแพทย์แผนจีน";
    $licen = "$position $doctorcode";
    
}else{
    $sql = "select * from doctor where name like '%$cDoctor1%'";
    $query = mysql_query($sql);
    $rows = mysql_fetch_array($query);
    $yot = $rows["yot"];
	if($rows["name"]=="MD128 ภาคภูมิ พิสุทธิวงษ์" || $rows["name"]=="MD129 ศศิภา ศิริรัตน์" || $rows["name"]=="MD151 กันยกร มาเกตุ" || $rows["name"]=="MD163 ศุภกิตติ มงคล"){
        
        $doctorcode = "พจ. ".$rows["doctorcode"];
        $position = "แพทย์แผนจีน";
        $certificate = "ใบอนุญาตประกอบโรคศิลปะ สาขาการแพทย์แผนจีน";

	}else{

        $doctorcode = "ว. ".$rows["doctorcode"];
        $position = "แพทย์ประจำโรงพยาบาลค่ายสุรศักดิ์มนตรี";
        $certificate = "ใบอนุญาตประกอบอาชีพเวชกรรม";

	}

}



$date_log = date('Y-m-d H:i:s');
$dt_log = "{\"yot\":\"$yot\",\"name\":\"$cDoctor1\",\"code\":\"$doctorcode\"}";
$log = "INSERT INTO `medicalcertificate`
(`thidate`,
`hn`,
`part`,
`doctor`)
VALUES
('$date_log',
'$cHn',
'$cPart',
'$dt_log');\n\n";
file_put_contents('logs/doctor-cert.log', $log, FILE_APPEND);

list($d, $m, $y) = explode('-', $Thaidate1);
$thaiTxt = $d.' '.$thaimonthFull[$m].' '.$y;

?>
<style type="text/css">
    .clearfix:after{
        content: "";
        display: table; 
        clear: both;
    }
</style>
<script type="text/javascript">
    window.onload = function(){
        window.print();
    };
</script>
<div style="text-align: center;">
    <img  WIDTH=100 HEIGHT=100 SRC='logo.jpg'>
</div>
<div style="height: 24px;">
    <div style="float: left; padding-left: 2em;">
        <font face="Angsana New" size ="4">เลขที่&nbsp;<?=$nRunno;?></font>
    </div>
    <div style="float: right; padding-right: 4em;">
        <font face="Angsana New" size ="4">วันที่&nbsp;<b><?=$thaiTxt;?></b></font>
    </div>
</div>
<div class="clearfix"></div>
<div style="text-align: center;">
    <font face='Angsana New' size ='4'>
        <B>ใบรับรองการตรวจร่างกายของแพทย์</B>&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง
    </font>
</div>
<br>
<font face="Angsana New" size ="3">
    ข้าพเจ้า <B><?=$yot;?>&nbsp;<?=$cDoctor1;?></B> ตำแหน่ง <?=$position;?>
    <br>
    <?=$certificate;?> เลขที่ &nbsp;<B><?=$doctorcode;?></B><BR>
</font>
<font face="Angsana New" size ="3">
    ได้ทำการตรวจร่างกาย &nbsp;<B><?=$cPtname;?></B> &nbsp;HN:<?=$cHn;?>  &nbsp;&nbsp;วินิจฉัยว่าป่วยเป็นโรค:&nbsp;&nbsp;<B><?=$cDiag;?></B><BR>
</font>
<?php

// ทดสอบว่า diag มีคำเหล่านี้อยู่รึป่าว
$diag_list = array('อัมพฤกษ์','อัมพาต','CVA','พากินสันต์');

function test_diag($str, $diags){
    foreach ($diags as $key => $lc) {
        $test_pos = strpos($str, $lc);
        if( $test_pos !== false ){
            return true;
        }
    }
    return false;
}

$inList = test_diag($cDiag, $diag_list);

print "<font face='Angsana New' size ='3'>เห็นสมควรให้การรักษาด้วยการฝังเข็ม&nbsp;&nbsp;&nbsp;";

if( $cDoctor2 == 'MD037' 
OR $cDoctor2 == 'MD054' 
OR $cDoctor2 == 'MD089' 
OR $cDoctor2 == 'MD115' 
OR $cDoctor2 == 'MD128' 
OR $cDoctor2 == 'MD129' 
OR $cDoctor2 == 'MD116' 
OR $cDoctor2 == 'MD130' 
OR $cDoctor2 == 'MD151' ){

    if( $inList === true ){
        print 'เพื่อ ฟื้นฟูสมรรถภาพร่างกาย';
    }else{
        // ถ้าเป็นโรคทั่วไปที่ไม่มีใน list
        print 'เพื่อ บำบัดโรค';
    }
    
    print "<br>";
    if( $showStart > 0 && ( $date_start_th !== false && $date_end_th !== false ) ){
        echo "ตั้งแต่วันที่&nbsp;&nbsp;$txt_date_start&nbsp;&nbsp;ถึง&nbsp;&nbsp;$txt_date_end ";
    }
    // else{
    //     echo "ตั้งแต่วันที่................................................ถึง................................................";
    // }
    
}else{
    print "เพื่อ................................................";
}
print "<br><br>";

// เช็กว่าจะให้ใส่ชื่อไปเลยรึป่าวใช้สำหรับการตั้งเบิก
$auto_name = ( isset($_GET['auto']) && $_GET['auto'] == 1 ) ? 1 : 0 ;
if( $auto_name > 0 ){
    print "<font face='Angsana New' size ='3'><CENTER>ลงชื่อ&nbsp;$yot&nbsp;$cDoctor1&nbsp;&nbsp;&nbsp;แพทย์ผู้ตรวจ<BR></CENTER>";
}else{
    print "<font face='Angsana New' size ='3'><CENTER>ลงชื่อ&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แพทย์ผู้ตรวจ<BR></CENTER>";
}

// if( $cDoctor2 !== 'MD115' AND $cDoctor2 !== 'MD037' AND $cDoctor2 !== 'MD054' AND $cDoctor2 !== 'MD089' ){
    print "<font face='Angsana New' size ='3'><CENTER>(&nbsp;$cDoctor1&nbsp;)</CENTER>"; 
// }

// print "<font face='Angsana New' size ='3'><CENTER>$position&nbsp;$doctorcode</CENTER>"; 
print "<font face='Angsana New' size ='3'><CENTER>$licen</CENTER>"; 

$nNid++;
$query ="UPDATE runno SET runno = $nNid WHERE title='nid_c'";
$result = mysql_query($query) or die("Query failed");
