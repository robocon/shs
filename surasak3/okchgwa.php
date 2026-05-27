<?php
session_start();
if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}
include("connect.php");

function dump($t){
    echo "<pre>";
    var_dump($t);
    echo "</pre>";
}

$Thidate = (date("Y") + 543) . date("-m-d H:i:s");
$sOfficer = $_SESSION["sOfficer"];
$ward_lists = array(
'42' => 'หอผู้ป่วยรวม',
'43' => 'หอผู้ป่วยสูติ',
'44' => 'หอผู้ป่วยICU',
'45' => 'หอผู้ป่วยพิเศษ',
'46' => 'หอผู้ป่วย Cohort Ward',
'47' => 'หอผู้ป่วย Home Isolation',
'48' => 'หอผู้ป่วย รพ.สนาม',
);
$outbcode = $_GET["outbcode"]; // <--- คือเตียงเดิมที่จะย้ายออก
$inbcode = $_GET['cBedcode']; // <--- เตียงใหม่ที่จะย้ายเข้า

//เก็บข้อมูลเตียงที่ย้าย
$query = "SELECT * FROM bed WHERE bedcode = '$outbcode'";
$result = mysql_query($query) or die("Query failed");
for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }

    if (!($row = mysql_fetch_object($result)))
        continue;
}

if ($result) {
    $oBedcode = $row->bedcode;
    $oAn = $row->an;
    $oHn = $row->hn;
    $oPtname = $row->ptname;
    $oPtright = $row->ptright;
    $oDoctor = $row->doctor;
    $oAge = $row->age;
    $oAddress = $row->address;
    $oMuang = $row->muang;
    $oDate = $row->date;
    $oDiagnos = $row->diagnos;

    $idcard = $row->idcard;
    $food = $row->food;

    $cChgdate = $row->chgdate;
    $cChgwdate = $row->chgwdate;
    $cBedname = $row->bedname;
    $cBedpri = $row->bedpri;

    $price = $row->price;
    $paid = $row->paid;
    $debt = $row->debt;
    $accno = $row->accno;
    $cbedcode = $row->bedcode;
    $calroom = $row->lastcalroom;
    $c19status = $row->c19status;
    $diag1 = $row->diag1;
    $last_drug = $row->last_drug;
    $bedCaldate = $row->caldate;
} else {
    echo "ไม่พบ bedcode : $outbcode";
    exit();
}


$sql = "Select bedpri,bedcode From bed where bedcode='$inbcode' limit 1";
$result3 = Mysql_Query($sql) or die("Error: ".$sql."<br>".mysql_error());
list($Nbadpri, $bedcode) = Mysql_fetch_row($result3);
$cbedcode1 = substr($cbedcode, 0, 2);

/**
 * @param string $bedcode1 หอผู้ป่วยที่ย้ายเข้า
 */
$bedcode1 = substr($bedcode, 0, 2);
echo "ห้องใหม่ $inbcode<br>";
echo "ราคาห้องเดิม $cBedpri<br>";
echo "ราคาห้องใหม่ $Nbadpri<br>";
echo "หอเดิม ".$ward_lists[$cbedcode1]."<br>";
echo "หอใหม่ ".$ward_lists[$bedcode1]."<br>";
echo "<br>";

$chgdate = (substr($calroom, 0, 4) - 543) . substr($calroom, 4); //วันนอน
$diffInSeconds = abs(strtotime(date("Y-m-d H:i:s")) - strtotime($chgdate));

$days = floor($diffInSeconds / (60 * 60 * 24)); // 60 * 60 * 24 = 86400 คือจำนวนวินาทีใน 1 วัน
$hours = floor(($diffInSeconds % (60 * 60 * 24)) / (60 * 60)); // 60 * 60 = 3600 คือจำนวนวินาทีใน 1 ชั่วโมง

echo "จำนวนวัน $days วัน $hours ชั่วโมง &nbsp;&nbsp;";
echo "<br>";

// $days เป็นวันที่คำนวณจาก bed.lastcalroom เอามา datediff กับ วันที่ปัจจุบัน  ถ้าเวลาเกิน 12Hrs ให้ตีเป็น 1 วัน
$dayslast = $days;
if ($hours >= 12) {
    $dayslast = $days + 1;
}

if ($dayslast < 0) {
    $dayslast = 0;
}
$query3 = "Select my_food,doctor,diag From ipcard where an = '$oAn' limit 1";
$result3 = Mysql_Query($query3) or die(mysql_error());
list($myfood, $doctor, $diag) = Mysql_fetch_row($result3);


$oBedcode1 = substr($cbedcode, 0, 2);
if ($oBedcode1 != '44') {
    if ($cBedpri > $myfood) {
        $cNBedpri = $cBedpri - $myfood;
        $cYBedpri = $cBedpri - $cNBedpri;
    } else {
        $cNBedpri = 0;
        $cYBedpri = $cBedpri;
    }
} else {
    $cNBedpri = 0;
    $cYBedpri = $cBedpri;
}

$cBedfood  = $dayslast * $cBedpri;    //รวมราคาห้องและอาหารทั้งสิ้น
$cYBedfood = $dayslast * $cYBedpri; //รวมราคาห้องและอาหารที่เบิกได้
$cNBedfood = $dayslast * $cNBedpri; //รวมราคาห้องและอาหารที่เบิกไม่ได้

$stays = 'รวม ' . $dayslast . ' วัน';
if ($oBedcode1 != '44') {
    $cWcare = 300;
    $cWname = "(55010)ค่าบริการพยาบาลทั่วไป (IPD)";
} else {
    $cWcare = 700;
    $cWname = "(55012 )ค่าบริการพยาบาลทั่วไป ICU";
}
$cBedwcare  = $dayslast * $cWcare;  //รวมค่าบริการทางพยาบาล
/////////
/////////////////
//ค่าห้องที่เบิกได้ depart	
$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$oPtname','$oHn','$oAn','$oDoctor','WARD','2','$cBedname (เฉพาะที่เบิกได้) $stays','$cYBedfood','คอมพิวเตอร์','$diag','$accno');";
$result = mysql_query($query) or die("Query failed,cannot insert into depart");
$idno = mysql_insert_id();

//ค่าห้องที่เบิกได้ patdata
$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$oHn','$oAn','$oPtname','$oDoctor','2','BFY','$cBedname (เฉพาะที่เบิกได้) $stays','$dayslast','$cYBedfood','WARD','BFY','$idno');";
$result = mysql_query($query) or die("Query failed,cannot insert into patdata");

//ค่าบริการทางพยาบาล
$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','NCARE','WARD','$cWname(ย้ายเตียง)','$dayslast','$cBedwcare','คอมพิวเตอร์','NCARE','$accno','$idno');";
$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");

//ค่าห้องที่เบิกได้ ipacc	
$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','BFY','WARD','$cBedname ($oBedcode)(ย้ายเตียง) $stays','$dayslast','$cYBedfood','คอมพิวเตอร์','BFY','$accno','$idno');";
$result = mysql_query($query) or die("Query failed,cannot insert into ipacc");

//ค่าห้องส่วนเกิน dapart
$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$oPtname','$oHn','$oAn','$oDoctor','WARD','2','ค่าห้องส่วนเกิน $cNBedpri บาท(ย้ายเตียง) $stays','$cNBedfood','คอมพิวเตอร์','$diag','$accno');";
$result = mysql_query($query) or die("Query failed,cannot insert into depart");
$idno = mysql_insert_id();

//ค่าห้องส่วนเกิน patdata
$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$oHn','$oAn','$oPtname','$oDoctor','2','BFN','ค่าห้องส่วนเกิน $cNBedpri บาท(ย้ายเตียง) $stays','$dayslast','$cNBedfood','WARD','BFN','$idno');";
$result = mysql_query($query) or die("Query failed,cannot insert into patdata");

//ค่าห้องส่วนเกิน ipacc
$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','BFN','WARD','ค่าห้องส่วนเกิน $cNBedpri บาท(ย้ายเตียง) $stays','$dayslast','$cNBedfood','คอมพิวเตอร์','BFN','$accno','$idno');";
$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");

//ย้ายออกจากเตียงเก่า(ลบข้อมูล)
$sql = "UPDATE bed SET 
`ptname`='',
`age`='',
`idcard`='',
`address`='',
`muang`='',
`ptright`='',
`doctor`='',
`date`='',
`hn`='',
`an`='',
`diagnos`='',
`price`=0,
`paid`=0,
`debt`=0,
`food`='',
`officer`='',
`chgdate`=now(),
`diag1`='',
`caldate`='',
`last_drug`='',
`chgwdate`='',
`accno`=1,
`lastcalroom`='0000-00-00 00:00:00',
`days`=0,
`c19status`='' 
WHERE bedcode='$oBedcode';";
$result = mysql_query($sql) or die("erase bed fail: ".mysql_error());

//ย้ายเข้าเตียงใหม่  
if ($dayslast > 0) {
    $monn = explode(" ", $calroom);
    $timeadmit = $monn[1];
    $caldate = explode("-", $monn[0]);
    $tomorrow = mktime(0, 0, 0, $caldate[1], ($caldate[2] + $dayslast), ($caldate[0] - 543));
    $calroom = date("Y-m-d", $tomorrow);
    $cutmonn = explode("-", $calroom);
    $calroom4 = ($cutmonn[0] + 543) . "-" . $cutmonn[1] . "-" . $cutmonn[2] . " " . $timeadmit;
} else {
    $calroom4 = $calroom;
}

$sql = "UPDATE bed SET 
`ptname`='$oPtname',
`age`='$oAge',
`idcard`='$idcard',
`address`='$oAddress',
`muang`='$oMuang',
`ptright`='$oPtright',
`doctor`='$oDoctor',
`date`='$oDate',
`hn`='$oHn',
`an`='$oAn',
`diagnos`='$oDiagnos',
`price`='$price',
`paid`='$paid',
`debt`='$debt',
`food`='$food',
`officer`='$sOfficer',
`chgdate`='$Thidate',
`diag1`='$diag1',
`caldate`='$bedCaldate',
`last_drug`='$last_drug',
`chgwdate`='$cChgwdate',
`accno`='$accno',
`lastcalroom`='$calroom4',
`c19status`='$c19status'
WHERE bedcode='$inbcode';";
$result = mysql_query($sql) or die("insert data to bed fail: ".mysql_error());


///////  ward_log /////////
if ($bedcode1 == '42') {
    $wname = 'หอผู้ป่วยรวม';
} elseif ($bedcode1 == '43') {
    $wname = 'หอผู้ป่วยสูติ';
} elseif ($bedcode1 == '44') {
    $wname = 'หอผู้ป่วยICU';
} elseif ($bedcode1 == '45') {
    $wname = 'หอผู้ป่วยพิเศษ';
} elseif ($bedcode1 == '46') {
    $wname = 'หอผู้ป่วย Cohort Ward';
} elseif ($bedcode1 == '47') {
    $wname = 'หอผู้ป่วย Home Isolation';
} elseif ($bedcode1 == '48') {
    $wname = 'หอผู้ป่วย รพ.สนาม';
}


$sql_ipcard = "UPDATE `ipcard` SET `bedcode` = '$inbcode', `my_ward` = '$wname' WHERE `an` = '$oAn' ";
$result_ipcard = mysql_query($sql_ipcard);


if ($cbedcode1 == $bedcode1) {
    $chgcode = "Bed";
} else {
    $chgcode = "Ward";
}

$sql_ward = "INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , `day` ,  `lastcall` , `office` ) 
VALUES 
( '$Thidate', '$oAn', '$oHn', '$wname', '$oBedcode','$chgcode', '$cbedcode', '$inbcode', '$dayslast', '$Thidate', '$sOfficer')";
$result_ward = mysql_query($sql_ward) or die("insert data to ward_log fail: ".mysql_error());
////////////////////////////

if (!$result) {
    echo "clear bed fail";
    echo mysql_errno() . ": " . mysql_error() . "\n";
    echo "<br>";
} else {
    print "ย้ายผู้ป่วยเรียบร้อย <br>";
    print "กรุณารอสักครู่ .............ระบบจะปิดหน้าต่างอัตโนมัติ <br>";
}

$rward = substr($inbcode, 0, 2);
if ($rward == '41') {
    $linkward = "allward.php?code=41";
} elseif ($rward == '42') {
    $linkward = "allward.php?code=42";
} elseif ($rward == '43') {
    $linkward = "allward.php?code=43";
} elseif ($rward == '44') {
    $linkward = "allward.php?code=44";
} elseif ($rward == '45') {
    $linkward = "allward.php?code=45";
} elseif ($rward == '46') {
    $linkward = "allward.php?code=46";
} elseif ($rward == '47') {
    $linkward = "allward.php?code=47";
} elseif ($rward == '48') {
    $linkward = "allward.php?code=48";
}
session_unregister("Bcode");
?>
<script>
    setTimeout("window.opener.location.href='<?= $linkward; ?>';window.close()", 3000);
</script>