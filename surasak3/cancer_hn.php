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
<form name="f1"  method="post" action="cancer_hn.php">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">ผู้ป่วยมะเร็ง</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">ระบุ HN</span></td>
    <td ><input type="text" name="hn" class="forntsarabun"/></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="b1" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>
<HR>
<?php

if(isset($_POST['b1'])){

include("connect.inc"); 

/*if($_POST['d_start']!=''){
$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$day="วันที่";
}else{
$date1=$_POST['y_start'].'-'.$_POST['m_start'];
$day="เดือน";
}*/

/*switch($_POST['m_start']){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	  $dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];*/
	
	$sql1="SELECT * FROM cancer Where hn='".$_POST['hn']."'";
	$query1 = mysql_query($sql1);
	$row=mysql_num_rows($query1);
	if($row){
	$i=1;	
/*	 print "<div><font class='forntsarabun' >สถิติ   ผู้ป่วยตรวจตามนัดเวชศาสตร์ฟื้นฟู ประจำ$day  $dateshow </font></div><br>";*/
	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">ลำดับ</td>
    <td align="center">วันที่</td>
    <td align="center">HN</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">รหัสบัตรประชาชน</td>
    <td align="center">พิมพ์ใบรายงาน</td>
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){		
	
	$str="select yot,name,surname,idcard, date_format(dbirth,'%d-%m-%Y'), concat(address,' ', tambol,' ', ampur,' ', changwat) as address, nation, religion, sex, married, dbirth from opcard where hn='".$arr1["hn"]."'";

$strresult = mysql_query($str) or die(mysql_error());
$strarr = mysql_fetch_array($strresult);
$name1=$strarr['yot'].' '.$strarr['name'];
$name2=$strarr['surname'];
	?>
    <tr>
      <td align="center"><?=$i;?></td>
      <td><?=$arr1['thidate']?></td>
      <td><?=$arr1['hn']?></td>
      <td><?=$name1." ".$name2?></td>
      <td><?=$arr1['id']?></td>
      <td align="center"><a href="cancer_report.php?hn=<?=$arr1['hn'];?>"><img src="print.png" width="37" height="34"  border="0"/></a></td>
     </tr>
    <? $i++;
	}  
	?>
    </table>
<?

}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของ HN ::  $_POST[hn]</font>";
}
}
?>