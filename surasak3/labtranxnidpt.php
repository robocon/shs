<body Onload="">
<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	
	if($cPtname == "" || $cHn == "" || $cDoctor == "" || $cDepart==""){

		echo "ขออภัยครับระบบมีความผิดพลาดเล็กน้อย กรุณาปิดโปรแกรมโรงพยาบาลและทำการเข้าระบบใหม่ครับ";
		exit();
	}

   //item count
   $item=0;
   for ($n=1; $n<=$x; $n++){
        If (!empty($aDgcode[$n])){
             $item++;
	}
            };

    include("connect.inc");

//เลข LAB
$query = "SELECT * FROM runno WHERE title = 'nid_pt'";
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


$nRunno=$nNid.''.$fNid;
	$cPart='nid';
//insert data into depart
$thidate5 = (date("Y")+543).date("-m-d H:i:s"); 
   $query = "INSERT INTO medicalcertificate  (thidate,number,hn,part,doctor)VALUES(' $thidate5','$nRunno','$cHn','$cPart','$cDoctor');";
         $result = mysql_query($query) or 
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>");



$cDoctor1 = trim(substr($cDoctor,5,50));
$cDoctor2=substr($cDoctor,0,5);
/*if($cDoctor2=='MD054'){$doctorcode='ว.13553';}else
if($cDoctor2=='MD052'){$doctorcode='ว.14286';}else
if($cDoctor2=='MD037'){$doctorcode='ว.10212';}else
if($cDoctor2=='MD089'){$doctorcode='ว.32166';}else{$doctorcode='';};*/

//
$acu = 0;
if($cDoctor1=="แพทย์แผนไทย"){
  
  // จันทร์ ถึง ศุกร์เป็นของ ศิริพร อินปัน
  $subDoctor = (int) $_GET['subDoctor'];
  if( $subDoctor === 1 ){
    $cDoctor1="ศิริพร อินปัน";
    $doctorcode = "พท.ป. 1272";
  }else{
    $cDoctor1="ธัญญาวดี มูลรัตน์";
    $doctorcode = "พท.ป. 1038";
  }

  $yot="น.ส.";
  $position="แพทย์แผนไทยประยุกต์";
  $certificate="ใบอนุญาตประกอบโรคศิลปะ สาขา การแพทย์แผนไทยประยุกต์";
  $licen="แพทย์แผนไทยประยุกต์";
  $acu = 1;

}else{
  $sql="select * from doctor where name like '%$cDoctor1%'";
  $query=mysql_query($sql);
  $rows=mysql_fetch_array($query);
  $yot=$rows["yot"];
  $doctorcode = "ว. ".$rows["doctorcode"];
  $position="แพทย์ประจำโรงพยาบาลค่ายสุรศักดิ์มนตรี";
  $certificate="ใบอนุญาตประกอบอาชีพเวชกรรม";
}
  $Thaidate1=substr($Thaidate,0,10);
  print "<CENTER><img  WIDTH=100 HEIGHT=100 SRC='logo.jpg'></CENTER><font face='Angsana New' size ='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่&nbsp;$nRunno";

	  print "<font face='Angsana New' size ='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<CENTER><B>ใบรับรองการตรวจร่างกายของแพทย์</B>&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง<BR></CENTER></font>"; 
	    print "<font face='Angsana New' size ='3'><CENTER>วันที่&nbsp;&nbsp;&nbsp; <B> $Thaidate1</B><BR></CENTER> "; 
	  print "<font face='Angsana New' size ='3'>ข้าพเจ้า <B>$yot$cDoctor1</B> ตำแหน่ง $position<BR> "; 

	  

	  print "<font face='Angsana New' size ='3'>$certificate เลขที่ &nbsp;&nbsp;&nbsp;<B>$doctorcode</B><BR>"; 
	  print "<font face='Angsana New' size ='3'>ได้ทำการตรวจร่างกาย &nbsp;<B>$cPtname</B> &nbsp;HN:$cHn  &nbsp;&nbsp;เป็นโรค:&nbsp;&nbsp;<B>$cDiag</B><BR>"; 
	  print "<font face='Angsana New' size ='3'>เห็นสมควรให้บริการ ด้วยการนวดพร้อมประคบสมุนไพร "; 
	  if( $acu === 0 ){
          print "เพื่อ.............................................................................<BR>";
          print "<font face='Angsana New' size ='3'>ตั้งแต่เวลา........................ถึง........................น.<BR><BR>";
      }else{
          print "<br>";
      }
    
	  print "<font face='Angsana New' size ='3'><CENTER>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แพทย์ผู้ตรวจ<BR></CENTER>";
	  $Thaidate1=substr($Thaidate,0,10);
	  print "<font face='Angsana New' size ='3'><CENTER>($cDoctor1)</CENTER>"; 
	    print "<font face='Angsana New' size ='3'><CENTER>$licen</CENTER>"; 

  $nNid++;
		$query ="UPDATE runno SET runno = $nNid WHERE title='nid_pt'";
		$result = mysql_query($query) or die("Query failed");

	    // print "<B>นำใบแจ้งหนี้ไปชำระเงินที่ห้องเก็บเงิน</B>";  
//จบใบแจ้งหนี้
?>