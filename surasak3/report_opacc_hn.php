<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99"> ตรวจเช็คค่าใช้จ่ายเอกซเรย์ระบบดิจิตอล </td>
    </tr>
  <tr class="forntsarabun">
    <td align="right">HN</td>
    <td><input name="hn" type="text" class="forntsarabun" value="<?=$_POST['hn'];?>" /></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ตกลง"/>&nbsp;&nbsp;
      <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>
<HR>
<?php

if($_POST['submit']){

include("connect.inc"); 


$hn=$_POST['hn'];

	
//$doctor=substr($_POST['doctor'],0,5);


/*$tsql1="CREATE TEMPORARY TABLE   opacc1  Select  *  from   opacc as a,opcard as b   WHERE  a.hn=b.hn and a.hn= '$hn'";
$tquery1 = mysql_query($tsql1);*/


//$tsql2="CREATE TEMPORARY TABLE  opcard1  Select * from  opcard   WHERE hn='$hn'";
//$tquery2 = mysql_query($tsql2);

/*$tsql3="CREATE TEMPORARY TABLE  appoint1  Select * from  appoint   WHERE date
LIKE  '$date1%'";
$tquery3 = mysql_query($tsql3);*/
	
	 
	$sql1="Select  *  from   opacc as a,opcard as b   WHERE  a.hn=b.hn and a.hn= '$hn' and a.depart like '%XRAY%'";
	$query1 = mysql_query($sql1);
	$row=mysql_num_rows($query1);
	$i=1;

	// print "<div><font class='forntsarabun' >สถิติผู้ป่วยในจำแนกตาม แพทย์ $_POST[doctor]  $ประจำ$day  $dateshow </font></div><br>";
	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">ลำดับ</td>
    <td align="center">วันที่บันทึกข้อมูล</td>
    <td align="center">วันที่ทำหัตถการ</td>
    <td align="center">HN</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">สิทธิการรักษา</td>
    <td align="center">depart</td>
    <td align="center">รายการ</td>
    <td align="center">ราคาเต็ม</td>
    <td align="center">ราคาจ่ายจริง</td>
    <td align="center">credit</td>
    <td align="center">รายละเอียด</td>
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){
		
		
		$arr1['ptname']=$arr1['yot'].$arr1['name'].' '.$arr1['surname'];
	?>
    <tr>
      <td align="center"><?=$i;?></td>
      <td><?=$arr1['date']?></td>
      <td><?=$arr1['txdate']?></td>
      <td><?=$arr1['hn']?></td>
      <td><?=$arr1['ptname']?></td>
      <td><?=$arr1['ptright']?></td>
      <td><?=$arr1['depart']?></td>
      <td><?=$arr1['detail']?></td>
      <td><?=$arr1['price']?></td>
      <td><?=$arr1['paid']?></td>
      <td><?=$arr1['credit']?></td>
      <td align="center"><a href="detail_xraydigital.php?do=view&txdate=<?=$arr1['txdate']?>&hn=<?=$arr1['hn']?>">ดู</a></td>
    </tr>
   <? 
   $i++;
   $sumprice+=$arr1['price'];
   $sumpaid+=$arr1['paid'];
	}  
	?>
    <tr>
      <td colspan="8" align="center" bgcolor="#FFFFCC">รวมเงิน</td>
      <td bgcolor="#FFFFCC"><?=number_format($sumprice,2);?></td>
      <td bgcolor="#FFFFCC"><?=number_format($sumpaid,2);?></td>
      <td bgcolor="#FFFFCC">&nbsp;</td>
      <td bgcolor="#FFFFCC">&nbsp;</td>
    </tr>

    </table>
<?
}
?>