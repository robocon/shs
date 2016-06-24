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
<!--<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">รายงานการเปลี่ยนแปลงข้อมูลผู้ป่วย</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">&nbsp;AN&nbsp;</td>
    <td ><input type="text" name="an" class="forntsarabun" />
   </td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
     <!--  <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>-->
<? 	 print "<div align=\"center\"><font class='forntsarabun' >รายงานการเปลี่ยนแปลงข้อมูลผู้ป่วย AN: $_GET[sAn]</font></div><br>";  ?>
<HR>
<?php

include("connect.inc"); 

$an=$_GET['sAn'];

$tsql1="CREATE TEMPORARY TABLE   ward_log1  Select * from   ward_log  WHERE an ='$an'";
$tquery1 = mysql_query($tsql1);


	
	$sql1="SELECT * FROM ward_log1";
	$query1 = mysql_query($sql1);
	$row=mysql_num_rows($query1);
	if($row){
	$i=1;



	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">ลำดับ</td>
    <td align="center">วันที่</td>
    <td align="center">HN</td>
    <td align="center">AN</td>
    <td align="center">หอผู้ป่วย</td>
    <td align="center">Bedcode</td>
    <td align="center">Change code</td>
    <td align="center">ข้อมูลเก่า</td>
    <td align="center">ข้อมูลใหม่</td>
    <td align="center">วันนอน</td>
    <td align="center">คำนวนค่าห้องล่าสุด</td>
     <td align="center">เจ้าหน้าที่</td>
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){
			
			$subdate=explode(" ",$arr1['date']);
		
	?>
    <tr>
      <td align="center"><?=$i;?></td>
      <td><?=$arr1['regisdate']?></td>
      <td><?=$arr1['hn']?></td>
      <td><?=$arr1['an']?></td>
      <td><?=$arr1['ward']?></td>
      <td><?=$arr1['bedcode']?></td>
      <td><?=$arr1['chgcode']?></td>
      <td><?=$arr1['old']?></td>
      <td><?=$arr1['new']?></td>
      <td><?=$arr1['day']?></td>
      <td><?=$arr1['lastcall']?></td>
      <td><?=$arr1['office']?></td>
    </tr>
    <? $i++;
	}  
	
	
	?>
    </table>
<?

}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของ $an</font>";
}
?>