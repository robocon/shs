<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>

<h1 class="forntsarabun">รายงานประจำ เดือน <?=$yrmonth?> <a target=_self  href='../../nindex.htm'><-----ไปเมนู</a></h1>
<?php
include("Connections/connect.inc.php");

$query="SELECT  opday.icd10,icd506.depart, COUNT(opday.icd10)  AS duplicate
FROM opday, icd506
WHERE opday.icd10 = icd506.icd10 AND thidate
LIKE  '$yrmonth%'
GROUP  BY opday.icd10
HAVING duplicate > 0
ORDER  BY opday.icd10";
   $result = mysql_query($query);
   $rows=mysql_num_rows($result);
   $n=0;
   ?>

   <table  border="0" cellspacing="0" cellpadding="0" class="forntsarabun">
  <tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center">ลำดับ</td>
    <td align="center">icd10/ชื่อโรค</td>
    <td align="center">จำนวน</td>
  </tr>
  <? 	 
if($rows){
while (list ($icd10,$depart,$duplicate) = mysql_fetch_row ($result)) {
$n++;
  ?>
  <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center"><?=$n;?> </td>
    <td><a target='_blank' href="icd506_detail.php?icd10=<?=$icd10;?>&yrmonth=<?=$yrmonth?>"><?=$icd10.' '.$depart;?></a></td>
    <td align="right"><?=$duplicate;?></td>
  </tr>
<? 
}
}else{
 echo " <tr> <td colspan='3' class='forntsarabun' align='center'>ไม่พบรายการ</td>
  </tr>";
}
?>
</table>

