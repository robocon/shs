<?
session_start();
include("connect.inc");
$clinic=$_POST["clinic"];
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
if($clinic=="all"){
	$clinic_name="ทั้งหมด";
}else{	
	if($clinic=="EYE"){
		$clinic_name="ห้องตรวจจักษุ (ตา)";
		$depcode="U22";
	}else if($clinic=="DEN"){
		$clinic_name="ทันตกรรม";
		$depcode="U13";
	}else if($clinic=="NID"){
		$clinic_name="นวดแผนไทย";
		$depcode="U21";
	}else if($clinic=="CHN"){
		$clinic_name="ฝังเข็ม";
		$depcode="U24";
	}	
}	
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 24px;
}
-->
</style>
<div align="center" style="margin-top: 20px;"><strong>รายงานการจองคิว/นัดหมายออนไลน์</strong></div>
<div align="center">จุดบริการ : <?=$clinic_name;?></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>
<?
$chkdate1=($_POST["year1"]-543)."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"]-543)."-".$_POST["month2"]."-".$_POST["date2"];
//print_r($_POST);
if($clinic=="all"){
	if($chkdate1==$chkdate2){
		$sql="select * from appoint where appdate_en = '$chkdate1' and detail LIKE 'FU54%' order by appdate_en";
	}else{
		$sql="select * from appoint where (appdate_en >= '$chkdate1' and appdate_en <= '$chkdate2') and detail LIKE 'FU54%' order by appdate_en";
	}	
}else{
	if($chkdate1==$chkdate2){
		$sql="select * from appoint where appdate_en = '$chkdate1' and detail LIKE 'FU54%' and depcode LIKE '$depcode%' order by appdate_en";
	}else{
		$sql="select * from appoint where (appdate_en >= '$chkdate1' and appdate_en <= '$chkdate2') and detail LIKE 'FU54%' and depcode LIKE '$depcode%' order by appdate_en";
	}	
}	
//echo $sql;
$query=mysql_query($sql);
$opd=mysql_num_rows($query);

?>  
<table width="60%" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="77%">จำนวนคิวจอง</td>
    <td width="23%" align="right"><?=$opd;?>&nbsp;&nbsp;คิว</td>
  </tr>
</table>

<div align="center" style="margin-top: 20px;"><strong>รายละเอียดการจองคิว/นัดหมายออนไลน์</strong></div>
<table width="80%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr align="center" style="font-weight:bold;">
    <td width="5%">ลำดับ</td>
    <td width="15%">วันและเวลาที่จอง</td>
	<td width="10%">HN</td>
	<td width="20%">ชื่อ - นามสกุล</td>
	<td width="15%">จุดบริการ</td>
	<td width="15%">วัน/เดือน/ปี ที่นัดหมาย</td>
	<td width="10%">เวลา</td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="left"><?=$rows["date"];?></td>
	<td align="left"><?=$rows["hn"];?></td>
	<td align="left"><?=$rows["ptname"];?></td>
	<td align="left"><?=$rows["depcode"];?></td>
	<td align="center"><?=$rows["appdate"];?></td>
	<td align="center"><?=$rows["apptime"];?></td>	
  </tr>
<?
}
?>  
</table>