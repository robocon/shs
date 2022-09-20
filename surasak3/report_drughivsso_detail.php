<? 
session_start();
include("../connect.inc");
$chkdate=$_GET["chkdate"];
//echo $chkdate;
$startdate="$chkdate-01 00:00:00";
$enddate="$chkdate-31 23:59:59";
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<p align="center"><strong>รายงานข้อมูลยาผู้ป่วย HIV สิทธิประกันสังคม (ผู้ป่วยนอก) ประจำเดือน  <?=$chkdate;?></strong></p>
<table width="80%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="9%" align="center"><strong>ลำดับ</strong></td>
    <td width="21%" align="center"><strong>วันที่สั่งจ่ายยา</strong></td>
    <td width="14%" align="center"><strong>รหัสยา</strong></td>
    <td width="31%" align="center"><strong>ชื่อยา</strong></td>
    <td width="10%" align="center"><strong>จำนวน</strong></td>
    <td width="15%" align="center"><strong>ราคา</strong></td>
  </tr>
<?
$chkdate="$startyear-$m";
$sql="SELECT  a.date,a.drugcode,a.tradname,a.amount,a.price
FROM  `drugrx` as a left join phardep as b on a.idno = b.row_id
WHERE (a.`date` >='$startdate' AND a.`date` <='$enddate') AND  (b.ptright like 'R07%' and b.`cashok` =  'ประกันสังคม') and (b.an is null || b.an='') and (a.drugcode LIKE '20%' || a.drugcode LIKE '30%') and a.amount >0;";		
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());
$i=0;
$total=0;
while($rows= mysql_fetch_array($result)){
$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["date"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td align="center"><?=$rows["amount"];?></td>
    <td align="right"><?=number_format($rows["price"],2);?></td>
  </tr>
<?
$total=$total+$rows["price"];
}
?> 
  <tr>
    <td colspan="5" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="right"><?=number_format($total,2);?></td>
  </tr>
</table>



