<?php
session_start();
if (!isset($sIdname)){ exit(); } //for security
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");

if($cPtname == "" || $cHn == "" || $cDoctor == "" || $cDepart==""){
    echo "ขออภัยครับระบบมีความผิดพลาดเล็กน้อย กรุณาปิดโปรแกรมโรงพยาบาลและทำการเข้าระบบใหม่ครับ";
    exit();
}

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
$query = "INSERT INTO medicalcertificate  (thidate,number,hn,part,doctor)VALUES(' $thidate5','$nRunno','$cHn','$cPart','$cDoctor');";
$result = mysql_query($query) or die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>");

$cDoctor1 = substr($cDoctor,5,50);
$cDoctor2 = substr($cDoctor,0,5);

/*if($cDoctor2=='MD054'){$doctorcode='ว.13553';}else
if($cDoctor2=='MD052'){$doctorcode='ว.14286';}else
if($cDoctor2=='MD037'){$doctorcode='ว.10212';}else
if($cDoctor2=='MD089'){$doctorcode='ว.32166';}else{$doctorcode='';};*/


$Thaidate1=substr($Thaidate,0,10);

// แพทย์แผนจีน
if( $cDoctor2 === 'MD115' ){
    $yot = 'นาย';
    $cDoctor1 = 'ภาคภูมิ พิสุทธิวงษ์';
    $doctorcode = 'พจ. 714';
    $position = 'แพทย์แผนจีน';
}else{
    $sql = "select * from doctor where name like '%$cDoctor1%'";
    $query = mysql_query($sql);
    $rows = mysql_fetch_array($query);
    $yot = $rows["yot"];
    $doctorcode = "ว. ".$rows["doctorcode"];
    $position = 'แพทย์';
}

?><body Onload="window.print();"><?php
print "<CENTER><img  WIDTH=100 HEIGHT=100 SRC='logo.jpg'></CENTER><font face='Angsana New' size ='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่&nbsp;$nRunno";

print "<font face='Angsana New' size ='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<CENTER><B>ใบรับรองการตรวจร่างกายของแพทย์</B>&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง<BR></CENTER></font>"; 
print "<font face='Angsana New' size ='3'><CENTER>วันที่&nbsp;&nbsp;&nbsp; <B> $Thaidate1</B><BR></CENTER> "; 
print "<font face='Angsana New' size ='3'>ข้าพเจ้า <B>$yot$cDoctor1</B> ตำแหน่ง "; 
print $position;
print "ประจำโรงพยาบาลค่ายสุรศักดิ์มนตรี<BR> ";
print "<font face='Angsana New' size ='3'>ใบอนุญาตประกอบอาชีพเวชกรรมเลขที่ &nbsp;&nbsp;&nbsp;<B>$doctorcode</B><BR>"; 
print "<font face='Angsana New' size ='3'>ได้ทำการตรวจร่างกาย &nbsp;<B>$cPtname</B> &nbsp;HN:$cHn  &nbsp;&nbsp;เป็นโรค:&nbsp;&nbsp;<B>$cDiag</B><BR>"; 
//   print "<font face='Angsana New' size ='3'>เห็นสมควรให้บริการรักษาด้วยการฝังเข็ม&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;ครั้ง&nbsp;&nbsp;ตั้งแต่เวลา........................ถึง........................น.<BR>";
//   print "<font face='Angsana New' size ='3'>เห็นสมควรให้บริการรักษาด้วยการฝังเข็ม&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;ครั้ง&nbsp;&nbsp;เพื่อ................................................<BR>"; 
print "<font face='Angsana New' size ='3'>เห็นสมควรให้บริการรักษาด้วยการฝังเข็ม&nbsp;&nbsp;&nbsp;";

$diag_list = array('อัมพฤกษ์','อัมพาต','CVA');
if( $cDoctor2 === 'MD115' ){
    if( in_array($cDiag, $diag_list) === true ){
        print 'เพื่อ ฟื้นฟูสมรรถภาพ';
    }else{
        print 'เพื่อ การรักษา';
    }
}else{
    print "เพื่อ................................................";
}
print "<BR>";

print "<font face='Angsana New' size ='3'><CENTER>&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แพทย์ผู้ตรวจ<BR></CENTER>";
print "<font face='Angsana New' size ='3'><CENTER>($cDoctor1)</CENTER>"; 
if( $cDoctor2 === 'MD115' ){
    print "<font face='Angsana New' size ='3'><CENTER>$position</CENTER>"; 
}
$nNid++;
$query ="UPDATE runno SET runno = $nNid WHERE title='nid_c'";
$result = mysql_query($query) or die("Query failed");
