<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 21px;  
}
-->
</style></head>

<body>
<?
$colspan="6";
$credit=$_POST["credit"];
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
$credit=$_POST["credit"];
if($mm=='01'){ $mon="มกราคม"; }
if($mm=='02'){ $mon="กุมภาพันธ์"; }
if($mm=='03'){ $mon="มีนาคม"; }
if($mm=='04'){ $mon="เมษายน"; }
if($mm=='05'){ $mon="พฤษภาคม"; }
if($mm=='06'){ $mon="มิถุนายน"; }
if($mm=='07'){ $mon="กรกฎาคม"; }
if($mm=='08'){ $mon="สิงหาคม"; }
if($mm=='09'){ $mon="กันยายน"; }
if($mm=='10'){ $mon="ตุลาคม"; }
if($mm=='11'){ $mon="พฤศจิกายน"; }
if($mm=='12'){ $mon="ธันวาคม"; }
?>
<p align="center"><strong>รายงานลูกหนี้<?=$credit;?>ตามใบเสร็จรับเงินผู้ป่วยนอก</strong><br />
ประจำเดือน <strong><?=$mon;?></strong>ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?><br /></span></center>
</p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="6%" align="center"><strong>ลำดับ</strong></td>
    <td width="15%" align="center"><strong>วัน/เดือน/ปี</strong></td>
    <td width="15%" align="center"><strong>เจ้าหน้าที่</strong></td>
	<td width="8%" align="center"><strong>HN</strong></td>
	<td width="8%" align="center"><strong>VN</strong></td>
    <td width="29%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
	<td width="15%" align="center"><strong>หมวดหมู่</strong></td>
	<?
	if($_POST["credit"]=="all"){
	?>
    <td width="15%" align="center"><strong>ลูกหนี้</strong></td>
	<? } ?>
	<td width="10%" align="center"><strong>เลขที่</strong></td>
    <td width="18%" align="center"><strong>จำนวนเงิน</strong></td>
  </tr>
<?
include("connect.inc");	
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

if($credit=="all"){
	$query = "SELECT *,sum(paid) as sumpaid FROM opacc  WHERE (txdate >= '$chkdate1' and txdate <= '$chkdate2') and (credit='เงินสด' || credit='เงินโอน' || credit='กรุงไทย' || credit='เช็ค') group by txdate, hn ORDER  BY substring(txdate,1,10) asc, billno asc";
}else if($credit=="ยกเลิก"){
	$query = "SELECT *,sum(paid) as sumpaid FROM opacc WHERE (txdate >= '$chkdate1' and txdate <= '$chkdate2') and (credit = 'ยกเลิก' AND LENGTH(billno) > 6) group by txdate, hn ORDER  BY substring(txdate,1,10) asc, billno asc";
}else{
	$query = "SELECT *,sum(paid) as sumpaid FROM opacc  WHERE (txdate >= '$chkdate1' and txdate <= '$chkdate2') and credit='$credit' group by txdate, hn ORDER  BY substring(txdate,1,10) asc, billno asc";
}	
//echo $query;
$result = mysql_query($query)or die("Query failed");
$i=0;
$total=0;
while($rows=mysql_fetch_array($result)){
$i++;
$sql=mysql_query("select yot,name,surname from opcard where hn='$rows[hn]'");
list($yot,$name,$surname)=mysql_fetch_array($sql);
$ptname="$yot$name&nbsp;&nbsp;$surname";
$total=$total+$rows["sumpaid"];

if($rows["depart"]=="PHAR"){
	$depart_name="ยา";
}else if($rows["depart"]=="PATHO"){
	$depart_name="พยาธิ";
}else if($rows["depart"]=="XRAY"){
	$depart_name="เอกซเรย์";
}else if($rows["depart"]=="DENTA"){
	$depart_name="ทันตกรรม";
}else if($rows["depart"]=="PHYSI"){
	$depart_name="กายภาพ";
}else if($rows["depart"]=="EMER"){
	$depart_name="บริการ";
}else if($rows["depart"]=="SURG"){
	$depart_name="ผ่าตัด";
}else if($rows["depart"]=="NID"){
	$depart_name="ฝังเข็ม";
}else if($rows["depart"]=="HEMO"){
	$depart_name="ไตเทียม";
}else if($rows["depart"]=="OTHER"){
	$depart_name="ตรวจอื่นๆ";
}else if($rows["depart"]=="EYE"){
	$depart_name="ตา";
}
?>	  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=substr($rows["txdate"],0,10);?></td>
    <td align="center"><?=$rows["idname"];?></td>
	<td><?=$rows["hn"];?></td>
	<td align="center"><?=$rows["vn"];?></td>
    <td><?=$ptname;?></td>
	<td><?=$depart_name;?></td>
	<?
	if($_POST["credit"]=="all"){
		$colspan="7";
	?>
	<td align="center"><?=$rows["credit"];?></td>
	<? } ?>	
    <td align="center"><?=$rows["billno"];?></td>
    <td align="right"><?=$rows["sumpaid"];?></td>
  </tr>
	<?
	}
	?>  
  <!--tr> 
    <td colspan="<?=$colspan;?>" align="right"><strong>รวมเป็นเงินทั้งสิ้น</strong></td>
    <td align="right"><strong><?=number_format($total,2);?></strong></td>
  </tr-->
</table>

</body>
</html>
