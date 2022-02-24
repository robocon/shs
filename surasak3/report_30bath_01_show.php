<? 
session_start();
include("connect.inc");

$day = $_POST["day1"];
$month = $_POST["month1"];
$year_th = $_POST["year1"];
$year_eng = $year_th-543;

//----> Convert Month
$selmon = $month;
	if($selmon=="01"){
		$mon ="มกราคม";
		$selmon="01";
	}else if($selmon=="02"){
		$mon ="กุมภาพันธ์";
		$selmon="02";
	}else if($selmon=="03"){
		$mon ="มีนาคม";
		$selmon="03";
	}else if($selmon=="04"){
		$mon ="เมษายน";
		$selmon="04";
	}else if($selmon=="05"){
		$mon ="พฤษภาคม";
		$selmon="05";
	}else if($selmon=="06"){
		$mon ="มิถุนายน";
		$selmon="06";
	}else if($selmon=="07"){
		$mon ="กรกฎาคม";
		$selmon="07";
	}else if($selmon=="08"){
		$mon ="สิงหาคม";
		$selmon="08";
	}else if($selmon=="09"){
		$mon ="กันยายน";
		$selmon="09";
	}else if($selmon=="10"){
		$mon ="ตุลาคม";
		$selmon="10";
	}else if($selmon=="11"){
		$mon ="พฤศจิกายน";
		$selmon="11";
	}else if($selmon=="12"){
		$mon ="ธันวาคม";
		$selmon="12";
	}//end if

//----------------------------------------//

$day2 = $_POST["day2"];
$month2 = $_POST["month2"];
$year_th2 = $_POST["year2"];
$year_eng2 = $year_th-543;

//----> Convert Month2
$selmon2 = $month2;
	if($selmon2=="01"){
		$mon2 ="มกราคม";
		$selmon2="01";
	}else if($selmon2=="02"){
		$mon2 ="กุมภาพันธ์";
		$selmon2="02";
	}else if($selmon2=="03"){
		$mon2 ="มีนาคม";
		$selmon2="03";
	}else if($selmon2=="04"){
		$mon2 ="เมษายน";
		$selmon2="04";
	}else if($selmon2=="05"){
		$mon2 ="พฤษภาคม";
		$selmon2="05";
	}else if($selmon2=="06"){
		$mon2 ="มิถุนายน";
		$selmon2="06";
	}else if($selmon2=="07"){
		$mon2 ="กรกฎาคม";
		$selmon2="07";
	}else if($selmon2=="08"){
		$mon2 ="สิงหาคม";
		$selmon2="08";
	}else if($selmon2=="09"){
		$mon2 ="กันยายน";
		$selmon2="09";
	}else if($selmon2=="10"){
		$mon2 ="ตุลาคม";
		$selmon2="10";
	}else if($selmon2=="11"){
		$mon2 ="พฤศจิกายน";
		$selmon2="11";
	}else if($selmon2=="12"){
		$mon2 ="ธันวาคม";
		$selmon2="12";
	}//end if
 
$i = 1; 
//-----> sql
$sql = "SELECT a.* , b.idcard, b.phone
FROM 
( 
	SELECT * FROM `patdata` WHERE `date` LIKE '$year_th-$month-$day%' 
	AND `amount` > 0 
	AND `part` = 'LAB' 
	AND `status` = 'Y' 
	AND (`code`='SWAB' OR `code`='AgCG3' OR `code`='Covid19') 
) AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` ";

//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
}//end if
 
 
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 20px;
}

#table1 {
  border-collapse: collapse;
}
#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { page-break-after:always; } 
} 
.style1 {font-weight: bold}
-->
</style>

<title>รายงาน  SWAB COVID</title>
<div id="non-printable0">
<h2 align="center"><u><b>รายงานผู้ป่วยมารับบริการตรวจ SWAB COVID</b></u></h2>
<h2 align="center">วันที่ <?  echo $day." ".$mon." ".$year_th; ?></b></u></h2>


<center>
<table border="1" width="700px" id="table1">
	<tr>
	<td align="center" style="font-size:15"><b>ลำดับ</b></td>
	<td align="center" style="font-size:15"><b>ปี/เดือน/วัน</b></td>
	<td align="center" style="font-size:15"><b>เวลา</b></td>
	<td align="center" style="font-size:15"><b>HN</b></td>
	<td align="center" style="font-size:15"><b>ชื่อ-นามสกุล</b></td>
	<td align="center" style="font-size:15"><b>เลขบัตรประชาชน</b></td>
	<td align="center" style="font-size:15"><b>โทรศัพท์</b></td>
	<td align="center" style="font-size:15"><b>LAB</b></td>
	<td align="center" style="font-size:15"><b>ราคา</b></td>
	</tr>
<?
$tmp_hn = "";

 while($rows = mysql_fetch_array($query)){

	$date = substr($rows["date"],0,10);
	$time = substr($rows["date"],10);
	$hn = $rows["hn"];
	$ptname = $rows["ptname"];
	$detail = $rows["detail"];
	$idcard = $rows["idcard"];
	$phone = $rows["phone"];
	$price = $rows["price"];

if($tmp_hn != $hn){

  echo '
	<tr>
	<td align="center" style="font-size:15">'.$i.'</td>
	<td align="center" style="font-size:15">'.$date.'</td>
	<td align="center" style="font-size:15">'.$time.'</td>
	<td align="center" style="font-size:15">'.$hn.'</td>
	<td align="left" style="font-size:15">'.$ptname.'</td>
	<td align="center" style="font-size:15">'.$idcard.'</td>
	<td align="center" style="font-size:15">'.$phone.'</td>
	<td align="left" style="font-size:15">'.$detail.'</td>
	<td align="left" style="font-size:15">'.$price.'</td>
	</tr>
  ';
 
	$i++;
	$tmp_hn = $hn;
}else{

echo '
	<tr>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="left" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="left" style="font-size:15">'.$detail.'</td>
	<td align="left" style="font-size:15">'.$price.'</td>
	</tr>
  ';

}//end if

 

 }//end while
?>
	
</table>
<? exit(); ?>
 
</center>
</div>

