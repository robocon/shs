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
	font-size: 12px;  
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
<p align="center"><strong>รายงานลูกหนี้ค่ารักษาพยาบาลผู้ป่วยนอก</strong><br />
ประจำเดือน <strong><?=$mon;?></strong> พ.ศ. <strong><?=$yy;?></strong> <br /></span></center>
</p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center"><strong>ลำดับ</strong></td>
    <td width="10%" align="center"><strong>วัน/เดือน/ปี</strong></td>
    <td width="5%" align="center"><strong>VN</strong></td>
    <td width="5%" align="center"><strong>HN</strong></td>
    <td width="20%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="10%" align="center"><strong>รหัส</strong></td>
    <td width="23%" align="center"><strong>รายการ</strong></td>
    <td width="9%" align="center"><strong>ราคา/หน่วย</strong></td>
    <td width="6%" align="center"><strong>จำนวน</strong></td>
    <td width="8%" align="center"><strong>รวมทั้งสิ้น</strong></td>    
  </tr>
<?
include("connect.inc");	
$chkdate1=$_POST["year"]."-".$_POST["mon"]."-01 00:00:00";
$chkdate2=$_POST["year"]."-".$_POST["mon"]."-31 23:59:59";
$credit=$_POST["credit"];

if($credit=="all"){
$query = "CREATE TEMPORARY TABLE reportcreditvn SELECT * 
FROM opacc
WHERE (txdate
>=  '$chkdate1' AND txdate
<=  '$chkdate2')  AND (
credit =  'เงินสด' || credit =  'จ่ายตรง' || credit =  'ประกันสังคม' || credit =  '30บาท' || credit =  'จ่ายตรง อปท.' || credit =  'ทหารไทย' || credit =  'HD' || credit =  'พรบ.' || credit =  'กท44' || credit =  'เช็ค'
) 
GROUP BY txdate,depart 
ORDER BY txdate ASC , hn ASC";
}else{
$query = "CREATE TEMPORARY TABLE reportcreditvn SELECT * 
FROM opacc
WHERE (txdate
>=  '$chkdate1' AND txdate
<=  '$chkdate2')  AND (credit =  '$credit') 
GROUP BY txdate,depart 
ORDER BY txdate ASC , hn ASC";
}
$rest = mysql_query($query) or die("Query failed opacc, Create reportcreditvn Error !!!");


$query3="SELECT * FROM reportcreditvn";
$result = mysql_query($query3) or die("Query reportcreditvn failed");
$i=0;
while($rows=mysql_fetch_array($result)){
$i++;
$sql=mysql_query("select yot,name,surname from opcard where hn='$rows[hn]'");
list($yot,$name,$surname)=mysql_fetch_array($sql);
$ptname="$yot$name&nbsp;&nbsp;$surname";

if($rows["vn"]=="" || $rows["vn"] == "NULL"){
$chkdate=substr($rows["txdate"],0,10);
$sql2="select vn from opday where thidate like '".$chkdate."%' and hn='".$rows["hn"]."' ";
//echo $sql2."<br>";
$query2=mysql_query($sql2);
list($tvn)=mysql_fetch_array($query2);
}else{
$tvn=$rows["vn"];
}

if($rows["depart"]=="PHAR"){
$sql1="select * from drugrx where date ='".$rows["txdate"]."' and hn='".$rows["hn"]."' ";
//echo $sql1;
$query1 = mysql_query($sql1)or die("Query drugrx failed");
$j=0;
$total1=0;
while($rows1=mysql_fetch_array($query1)){
$j++;
$total1=$total1+$rows1["price"];
$unitpri=$rows1["price"]/$rows1["amount"];
$unitpri=number_format( $unitpri, 2, '.', '');
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=substr($rows1["date"],0,10);?></td>
    <td align="center"><?=$tvn;?></td>
    <td><?=$rows1["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><?=$rows1["drugcode"];?></td>
    <td><?=$rows1["tradname"];?></td>
    <td align="right"><?=$unitpri;?></td>
    <td align="center"><?=$rows1["amount"];?></td>
    <td align="right"><?=$rows1["price"];?></td>
  </tr>
<?
}
}else{

$sql1="select * from patdata where date ='".$rows["txdate"]."' and hn='".$rows["hn"]."' ";
//echo $sql1;
$query1 = mysql_query($sql1)or die("Query patdata failed");
$j=0;
$toal2=0;
while($rows1=mysql_fetch_array($query1)){
$j++;
$total2=$total2+$rows1["price"];
$unitpri=$rows1["price"]/$rows1["amount"];
$unitpri=number_format( $unitpri, 2, '.', '');
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=substr($rows1["date"],0,10);?></td>
    <td align="center"><?=$tvn;?></td>
    <td><?=$rows1["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><?=$rows1["code"];?></td>
    <td><?=$rows1["detail"];?></td>
    <td align="right"><?=$unitpri;?></td>
    <td align="center"><?=$rows1["amount"];?></td>
    <td align="right"><?=$rows1["price"];?></td>
  </tr>
<?
}

}
?>
<?
}
?>    
</table>

</body>
</html>
