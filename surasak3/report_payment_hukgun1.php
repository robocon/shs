<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.style1 {
	font-size: 20px;
	font-weight: bold;
}
.style2 {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
 include("connect.inc");  
////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ตรวจสุขภาพ*/////////

if($_POST["chkmonth"]=="01"){
	$month="มกราคม";
}else if($_POST["chkmonth"]=="02"){
	$month="กุมภาพันธ์";
}else if($_POST["chkmonth"]=="03"){
	$month="มีนาคม";
}else if($_POST["chkmonth"]=="04"){
	$month="เมษายน";
}else if($_POST["chkmonth"]=="05"){
	$month="พฤษภาคม";
}else if($_POST["chkmonth"]=="06"){
	$month="มิถุนายน";
}else if($_POST["chkmonth"]=="07"){
	$month="กรกฎาคม";
}else if($_POST["chkmonth"]=="08"){
	$month="สิงหาคม";
}else if($_POST["chkmonth"]=="09"){
	$month="กันยายน";
}else if($_POST["chkmonth"]=="10"){
	$month="ตุลาคม";
}else if($_POST["chkmonth"]=="11"){
	$month="พฤศจิกายน";
}else if($_POST["chkmonth"]=="12"){
	$month="ธันวาคม";
}
?>
<div align="center" class="style1">ค่าใช้จ่ายตรวจสุขภาพโครงการฮักกันยามเฒ่า</div>
<div align="center">วันที่ <? echo $_POST["chkdate"]; ?> เดือน <? echo $month; ?> พ.ศ. <? echo $_POST["chkyear"]; ?></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" height="30" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ป</strong>ี</td>
    <td width="12%" height="35" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="7%" height="35" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="29%" height="35" align="center" bgcolor="#66CC99"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>LAB</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>X-RAY</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>รวม</strong></td>
  </tr>
<?
$sql="select * from opacc where credit = 'ฮักกันยามเฒ่า$nPrefix' and date like '$_POST[chkyear]-$_POST[chkmonth]-$_POST[chkdate]%' group by hn";
//echo $sql;
$query=mysql_query($sql);
$i=0;
$sumlab=0;
$sumxray=0;
$total=0;
while($rows=mysql_fetch_array($query)){
$i++;
$subdate=substr($rows["date"],0,10);
list($y,$m,$d)=explode("-",$subdate);
$showdate="$d/$m/$y";
$y=$y-543;
$newdate="$y-$m-$d";

$sql1="select vn, ptname from condxofyear_out where hn='$rows[hn]' and thidate like '$newdate%'";
$query1=mysql_query($sql1);
list($vn,$ptname)=mysql_fetch_array($query1);

$sql2="select price from opacc where depart='PATHO' and hn='$rows[hn]' and date like '$subdate%'";
$query2=mysql_query($sql2);
list($lab)=mysql_fetch_array($query2);

$sql3="select price from opacc where depart='XRAY' and hn='$rows[hn]' and date like '$subdate%'";
$query3=mysql_query($sql3);
list($xray)=mysql_fetch_array($query3);

$sum=$lab+$xray;
$sumlab=$sumlab+$lab;
$sumxray=$sumxray+$xray;
$total=$total+$sum;
?>  
  <tr>
    <td height="30" align="center"><?=$i;?></td>
    <td align="center"><?=$showdate?></td>
    <td height="35" align="center"><?=$rows["hn"];?></td>    
    <td height="35" align="center"><?=$vn;?></td>
    <td height="35" align="left"><?=$ptname;?></td>
    <td align="right"><?=number_format($lab,2);?></td>
    <td align="right"><?=number_format($xray,2);?></td>
    <td align="right"><?=number_format($sum,2);?></td>
  </tr>
<?
}
?>    
  <tr>
    <td height="35" colspan="5" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="right"><?=number_format($sumlab,2);?></td>
    <td align="right"><?=number_format($sumxray,2);?></td>
    <td align="right"><?=number_format($total,2);?></td>
  </tr>
</table>