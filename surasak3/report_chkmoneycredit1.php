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
$mm=$_POST["mon"];
$yy=$_POST["year"];
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
ประจำเดือน <strong><?=$mon;?></strong> พ.ศ. <strong><?=$yy;?></strong> <br /></span></center>
</p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="6%" align="center"><strong>ลำดับ</strong></td>
    <td width="15%" align="center"><strong>วัน/เดือน/ปี</strong></td>
    <td width="8%" align="center"><strong>VN</strong></td>
    <td width="8%" align="center"><strong>HN</strong></td>
    <td width="29%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="16%" align="center"><strong>เลขที่</strong></td>
    <td width="18%" align="center"><strong>จำนวนเงิน</strong></td>
  </tr>
<?
include("connect.inc");	
$chkdate=$_POST["year"]."-".$_POST["mon"];
if($credit=="เงินสด"){
$query = "SELECT *,sum(paid) as sumpaid FROM opacc  WHERE date like '$chkdate%' and credit = 'เงินสด' group by date, hn ORDER  BY substring(date,1,10) asc, ABS(vn) asc";
}else if($credit=="ยกเลิก"){
$query = "SELECT *,sum(paid) as sumpaid FROM opacc WHERE date like '$chkdate%' and (credit = 'ยกเลิก' AND LENGTH(billno) > 6) group by date, hn ORDER  BY substring(date,1,10) asc, ABS(vn) asc";
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
?>	  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=substr($rows["date"],0,10);?></td>
    <td align="center"><?=$rows["vn"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$ptname;?></td>
    <td align="center"><?=$rows["billno"];?></td>
    <td align="right"><?=$rows["sumpaid"];?></td>
  </tr>
<?
}
?>  
  <tr>
    <td colspan="6" align="right"><strong>รวมเป็นเงินทั้งสิ้น</strong></td>
    <td align="right"><?=number_format($total,2);?></td>
  </tr>
</table>

</body>
</html>
