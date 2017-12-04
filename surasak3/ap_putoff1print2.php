<body>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<?php
session_start();
include("connect.inc");
$sum = count($_SESSION['putid']);

if(!isset($_GET['click'])){
	echo "<font face='Angsana New' size='6'>พิมพ์รายชื่อเลื่อนนัดบนไปรษณีย์ </font><br><br>";
echo "<table border=1 width='30%' style='border-collapse:collapse; font-family:AngsanaUPC; font-size:20px;' cellpadding='0' cellspacing='0'>";
echo "<tr><td>#</td><td>HN</td><td>ชื่อ - สกุล</td><td>พิมพ์</td></tr>";

	for($k=0;$k<$sum;$k++){

		$sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_SESSION['putid'][$k]."'  limit 1 ";

  		list($row_id, $date, $officer, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright) = Mysql_fetch_row(Mysql_Query($sql));

		$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  
  		$doctor=substr($cdoctor,5);

   		$depcode=substr($depcode,4);
		
		$datenot =$_SESSION['cancle'][$k];
		$Q++;
		echo "<tr><td>$Q</td><td>$cHn</td><td>$cPtname</td><td><a href='ap_putoff1print2.php?click=$k' target='_blank'>พิมพ์</a></td></tr>";
	}
}else{
	?>
	<script>
    window.print();
    </script>
	<?
		$sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright ,b.address ,b.tambol,b.ampur,b.changwat From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_SESSION['putid'][$_GET['click']]."'  limit 1 ";
		list($row_id, $date, $officer, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright,$address ,$tambol,$ampur,$changwat) = Mysql_fetch_row(Mysql_Query($sql));

		$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  
  		$doctor=substr($cdoctor,5);

   		$depcode=substr($depcode,4);
		
		$datenot =$_SESSION['cancle'][$_GET['click']];
		
		print "<table style='font-family:AngsanaUPC';><tr><td><font face='Angsana New' size='4'><center><b>HN : $cHn &nbsp;&nbsp;&nbsp;&nbsp;แพทย์ $doctor</td></tr>";
   		print "<tr><td><font face='Angsana New' size='3'>เรียนคุณ $cPtname</font></td></tr>";
		print "<tr><td><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ห้องตรวจโรครพ.ค่ายสุรศักดิ์มนตรี ได้นัดท่านมาติดตามผลการรักษา</td></tr>";
 		print "<tr><td><font face='Angsana New' size='3'>ในวันที่  $datenot นั้น ทางห้องตรวจโรคขอเลื่อนนัดท่าน</td></tr>";
		print "<tr><td><font face='Angsana New' size='3'>มาในวันที่ $appd เวลา: $capptime แทน </td></tr>";
		print "<tr><td><font face='Angsana New' size='3'>เนื่องจากแพทย์ติดราชการหากท่านมาตามการเลื่อนนัดไม่ได้  </td></tr>";
		print "<tr><td><font face='Angsana New' size='3'>กรุณาโทรศัพท์ติดต่อที่ 054-839305 ต่อ 1125 วันราชการเวลา 13.30-15.00 น.</td></tr>";
		print "<tr><td align='center'><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขออภัย ณ โอกาสนี้ด้วย</td></tr>";
		print "<tr><td align='center'><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ห้องตรวจโรคผู้ป่วยนอก</td></tr>";
		print "<tr><td align='center'><font face='Angsana New' size='4'><strong>กรุณานำใบนัดเดิมมาด้วย</strong></td></tr>";
		print "</table>";
  		//print "<tr><td><font face='Angsana New' size='5'><U>นัดมาวันที่: $appd &nbsp;&nbsp;&nbsp; เวลา: $capptime</U></FONT></td></tr>";
		//print "<tr><td><font face='Angsana New' size='4'><b><U>ยื่นใบนัดที่:&nbsp; $room</U></b><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;</td></tr>";
	//print "<b>ผู้ออกใบนัด:</b>&nbsp; $sOfficer,&nbsp; $depcode</td></tr> "; 
	//print "&nbsp;&nbsp;<b>วันและเวลาที่ออกใบนัด&nbsp;:</b>$Thaidate</td></tr>"; 
	echo "<div style='page-break-after:always'></div>";
	
	echo "<table width='75%'>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td width='60%'>&nbsp;</td><td width='40%'><font face='Angsana New' size='4'> $cPtname</font></td></tr>";
	echo "<tr><td>&nbsp;</td><td><font face='Angsana New' size='4'>$address ต.$tambol</font></td></tr>";
	echo "<tr><td>&nbsp;</td><td><font face='Angsana New' size='4'>อ.$ampur</font></td></tr>";
	echo "<tr><td>&nbsp;</td><td><font face='Angsana New' size='4'>จ.$changwat</font></td></tr>";
	echo "</table>";
  
} 

?>