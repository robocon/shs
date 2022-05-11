<?
session_start();
include("connect.inc");

$sqltm="CREATE TEMPORARY TABLE reportcscdopd select * from opacc where (txdate >='2561-09-01 00:00:00' and txdate <='2561-12-31 23:59:59') AND credit='จ่ายตรง'";
//echo $sql;
$querytm=mysql_query($sqltm);

$querytmp="SELECT * FROM reportcscdopd";
$resulttmp = mysql_query($querytmp) or die("Query reportcscdopd failed");
?>
<style type="text/css">
<!--
.txt {	font-family: TH SarabunPSK;
	font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงข้อมูลการส่งเบิกเงินผู้ป่วยนอกสิทธิเบิกจ่ายตรง (CSCD)</strong></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="10%" align="center" bgcolor="#52BE80"><strong>ปี-เดือน</strong></td>
	<td width="10%" align="center" bgcolor="#52BE80"><strong>ส่งเบิก</strong></td>
    <td width="11%" align="center" bgcolor="#52BE80"><strong>ส่งเบิกผ่าน</strong></td>
    <td width="10%" align="center" bgcolor="#52BE80"><strong>ส่งเบิกไม่ผ่าน</strong></td>
    <td width="10%" align="center" bgcolor="#52BE80"><strong>ส่งเบิกแก้ติด C ผ่าน</strong></td>
    <td width="12%" align="center" bgcolor="#52BE80"><strong>ส่งเบิกแก้ติด C ไม่ผ่าน</strong></td>
  </tr>
<?
$sql="select substring(txdate,1,7) , sum(paidcscd) as sumpaidcscd from reportcscdopd where (txdate >='2561-09-01 00:00:00' and txdate <='2561-12-31 23:59:59') AND credit='จ่ายตรง'  GROUP BY SUBSTRING( txdate, 1, 7 ) ";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
//echo $num;
while(list($txdate,$sumpaidcscd)=mysql_fetch_row($query)){
	
$sql1="select sum(paidcscd) as sumpaidcscd_true from reportcscdopd where (txdate LIKE '$txdate%') AND credit='จ่ายตรง'  and typecscd ='' GROUP BY SUBSTRING( txdate, 1, 7 ) ";
//echo $sql1;
$query1=mysql_query($sql1);
list($sumpaidcscd_true)=mysql_fetch_row($query1);

$sql1="select sum(paidcscd) as sumprice_p from reportcscdopd where (txdate LIKE '$txdate%') AND credit='จ่ายตรง'  and typecscd ='' GROUP BY SUBSTRING( txdate, 1, 7 ) ";
//echo $sql1;
$query1=mysql_query($sql1);
list($sumprice_p)=mysql_fetch_array($query1);

$sql2="select sum(paidcscd) as sumprice_a from reportcscdopd where (txdate LIKE '$txdate%') AND credit='จ่ายตรง'  and typecscd ='A' GROUP BY SUBSTRING( txdate, 1, 7 ) ";
//echo $sql2;
$query2=mysql_query($sql2);
list($sumprice_a)=mysql_fetch_array($query2);

$sql3="select sum(paidcscd) as sumprice_c from reportcscdopd where (txdate LIKE '$txdate%') AND credit='จ่ายตรง'  and typecscd ='C' GROUP BY SUBSTRING( txdate, 1, 7 ) ";
//echo $sql3;
$query3=mysql_query($sql3);
list($sumprice_c)=mysql_fetch_array($query3);

$sumprice_ca=$sumprice_a+$sumprice_c;
?>
  <tr>
    <td width="10%" align="center" bgcolor="#D5F5E3"><strong><?=$txdate;?></strong></td>
	<td width="10%" align="center" bgcolor="#D5F5E3"><strong><?=number_format($sumpaidcscd,2);?></strong></td>
    <td width="11%" align="center" bgcolor="#D5F5E3"><strong><?=number_format($sumprice_p,2);?></strong></td>
    <td width="10%" align="center" bgcolor="#D5F5E3"><strong><?=number_format($sumprice_ca,2);?></strong></td>
    <td width="10%" align="center" bgcolor="#D5F5E3"><strong><?=number_format($sumprice_a,2);?></strong></td>
    <td width="12%" align="center" bgcolor="#D5F5E3"><strong><?=number_format($sumprice_c,2);?></strong></td>
  </tr>
<?
}
?>
</table>  