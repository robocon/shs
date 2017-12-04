<?
session_start();
include("connect.inc");	
$day=date("d");
$month=date("m");
$year=date("Y");

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานการใช้ยาที่ระบุเป็นยาเสพติด</title>
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
-->
</style>
</head>
<body>
<div id="non-printable">
<p align="center"><strong>รายงานการใช้ยาที่ระบุเป็นยาเสพติด</strong></p>
<form name="form1" method="post" action="report_drugnarcotic.php">
<input name="act" type="hidden" value="show" />
<table width="100%" height="72" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="34%" height="30" align="right" valign="middle">ช่วงวันที่ :      </td>
    <td width="33%" height="30" align="left" valign="middle"><input name="start_day" type="text" id="start_day" size="5" value="1" />
เดือน :
  <input name="start_month" type="text" id="start_month" size="10" value="<?=$month;?>" />
ปี:
<input name="start_year" type="text" id="start_year" size="10" value="<?=$year+543;?>" /></td>
    <td width="33%" rowspan="2" align="left" valign="middle"><input type="submit" name="button2" id="button2" value="ViewReport" style="height: 40px; font-family:'TH SarabunPSK'; font-weight:bold; font-size:16px;" /></td>
  </tr>
  <tr>
    <td height="23" align="right" valign="middle">ถึงวันที่&nbsp;:</td>
    <td height="23" align="left" valign="middle"><input name="end_day" type="text" id="end_day" size="5" value="<?=$day;?>" />
เดือน :
  <input name="end_month" type="text" id="end_month" size="10" value="<?=$month;?>" />
ปี:
<input name="end_year" type="text" id="end_year" size="10" value="<?=$year+543;?>" /></td>
    </tr>
</table>
</form>
<div align="center"><a href="../nindex.htm"><<< ไปหน้าแรก</a></div>
<hr>
</div>
<?
if($_POST["act"]=="show"){ 
$start_year=$_POST["start_year"];
$start_month=$_POST["start_month"];
$start_day=sprintf("%02d",$_POST["start_day"]);

$end_year=$_POST["end_year"];
$end_month=$_POST["end_month"];
$end_day=sprintf("%02d",$_POST["end_day"]);

$selmon=$start_month;
	if($selmon=="01"){
		$mon ="มกราคม";
	}else if($selmon=="02"){
		$mon ="กุมภาพันธ์";
	}else if($selmon=="03"){
		$mon ="มีนาคม";
	}else if($selmon=="04"){
		$mon ="เมษายน";
	}else if($selmon=="05"){
		$mon ="พฤษภาคม";
	}else if($selmon=="06"){
		$mon ="มิถุนายน";
	}else if($selmon=="07"){
		$mon ="กรกฎาคม";
	}else if($selmon=="08"){
		$mon ="สิงหาคม";
	}else if($selmon=="09"){
		$mon ="กันยายน";
	}else if($selmon=="10"){
		$mon ="ตุลาคม";
	}else if($selmon=="11"){
		$mon ="พฤศจิกายน";
	}else if($selmon=="12"){
		$mon ="ธันวาคม";
	}
	
$selmon1=$end_month;
	if($selmon1=="01"){
		$mon1 ="มกราคม";
	}else if($selmon1=="02"){
		$mon1 ="กุมภาพันธ์";
	}else if($selmon1=="03"){
		$mon1 ="มีนาคม";
	}else if($selmon1=="04"){
		$mon1 ="เมษายน";
	}else if($selmon1=="05"){
		$mon1 ="พฤษภาคม";
	}else if($selmon1=="06"){
		$mon1 ="มิถุนายน";
	}else if($selmon1=="07"){
		$mon1 ="กรกฎาคม";
	}else if($selmon1=="08"){
		$mon1 ="สิงหาคม";
	}else if($selmon1=="09"){
		$mon1 ="กันยายน";
	}else if($selmon1=="10"){
		$mon1 ="ตุลาคม";
	}else if($selmon1=="11"){
		$mon1 ="พฤศจิกายน";
	}else if($selmon1=="12"){
		$mon1 ="ธันวาคม";
	}	
?>
<div id="printable"> 
<p align="center"><strong>รายงานการใช้ยาที่ระบุเป็นยาเสพติด</strong><br>
<strong>ระหว่างวันที่ : </strong><?=$start_day;?> เดือน<?=$mon;?> พ.ศ. <?=$start_year;?> ถึงวันที่ <?=$end_day;?> เดือน<?=$mon1;?> พ.ศ. <?=$end_year;?>
</p>
<?
$dsql="select * from druglst where narcotic='Y'";
$dquery=mysql_query($dsql) or die ("Query Error");
$n=0;
while($drows=mysql_fetch_array($dquery)){
$n++;
?>
<div align="left"><strong>ลำดับที่ <?=$n;?> รหัสยา : <?=$drows["drugcode"];?> ชื่อยา : <?=$drows["tradname"];?></strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:">
  <tr>
    <td width="4%" align="center" bgcolor="#FFCCCC"><strong>#</strong></td>
    <td width="9%" align="center" bgcolor="#FFCCCC"><strong>วันที่จ่ายยา</strong></td>
    <td width="8%" align="center" bgcolor="#FFCCCC"><strong>HN</strong></td>
    <td width="19%" align="center" bgcolor="#FFCCCC"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" align="center" bgcolor="#FFCCCC"><strong>อายุ</strong></td>
    <td width="28%" align="center" bgcolor="#FFCCCC"><strong>ที่อยู่</strong></td>
    <td width="15%" align="center" bgcolor="#FFCCCC"><strong>เบอร์โทร</strong></td>
    <td width="7%" align="center" bgcolor="#FFCCCC"><strong>จำนวนที่จ่าย</strong></td>
  </tr>
<?
$sql="select * from drugrx where (date between '$start_year-$start_month-$start_day 00:00:00' AND '$end_year-$end_month-$end_day 23:59:59') and drugcode='".$drows["drugcode"]."'";
$query=mysql_query($sql) or die ("Query Error");
if(mysql_num_rows($query) < 1){
	echo "<tr><td colspan='11' align='center'>----- ไม่มีข้อมูล -----</td></tr>";
}
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$osql="select * from opcard where hn='".$rows["hn"]."'";
$oquery=mysql_query($osql) or die ("Query Error");
$orows=mysql_fetch_array($oquery);
$ptname=$orows["yot"].$orows["name"]."  ".$orows["surname"];
$address=$orows["address"]." ต.".$orows["tambol"]."  อ.".$orows["ampur"]."  จ.".$orows["changwat"];
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["date"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><?=calcage($orows["dbirth"]);?></td>
    <td><?=$address;?></td>
    <td><?=$orows["phone"];?></td>
    <td><?=$rows["amount"];?></td>
  </tr>
<?
}
?>    
</table>
<br />
<?
}
?>
</div>
<?
}
?>
</body>
</html>
