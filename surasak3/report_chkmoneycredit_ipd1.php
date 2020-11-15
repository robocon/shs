<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
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
<p align="center"><strong>รายงานลูกหนี้เงินสดตามใบเสร็จรับเงินผู้ป่วยใน</strong><br />
ประจำเดือน <strong><?=$mon;?></strong> พ.ศ. <strong><?=$yy;?></strong> <br /></span></center>
</p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="7%" align="center"><strong>ลำดับ</strong></td>
    <td width="17%" align="center"><strong>วัน/เดือน/ปี</strong></td>
    <td width="9%" align="center"><strong>HN</strong></td>
    <td width="9%" align="center"><strong>AN</strong></td>
    <td width="33%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="19%" align="center"><strong>เลขที่</strong></td>
    <td width="15%" align="center"><strong>จ่ายเงิน</strong></td>
  </tr>
<?
include("connect.inc");	
$chkdate=$_POST["year"]."-".$_POST["mon"];
$query = "SELECT *,sum(cash) as sumpaid FROM ipmonrep WHERE   date like '$chkdate%' and credit = 'เงินสด' group by date, hn ORDER  BY date";
//echo $query;
$result = mysql_query($query)or die("Query failed");
$i=0;
$total=0;
while($rows=mysql_fetch_array($result)){
$i++;
$ptname=$rows["ptname"];
$total=$total+$rows["sumpaid"];
?>	  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=substr($rows["date"],0,10);?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["an"];?></td>
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
