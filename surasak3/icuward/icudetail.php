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
<?

if($_REQUEST['do']=="view"){
	
include("../Connections/connect.inc.php"); 	
	
$icd10=$_REQUEST['icd10'];
$date1=$_REQUEST['date'];

$sql1="select *  from ipcard Where icd10='$icd10'  and date like '$date1%' AND bedcode  LIKE  '44%'";
$q1=mysql_query($sql1);
$i=0;
?>
<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun">
  <tr align="center">
    <td bgcolor="#0099FF">ลำดับ</td>
    <td bgcolor="#0099FF">วันที่</td>
    <td bgcolor="#0099FF">HN</td>
    <td bgcolor="#0099FF">AN</td>
    <td bgcolor="#0099FF">ชื่อ-สกุล</td>
    <td bgcolor="#0099FF">สิทธิ</td>
    <td bgcolor="#0099FF">Diag</td>
  </tr>
  <?
  while($r1=mysql_fetch_array($q1)){  
  ?>
<tr>
 <td align="center"><?=++$i;?></td>
    <td><?=$r1['date'];?></td>
    <td><?=$r1['hn'];?></td>
    <td><?=$r1['an'];?></td>
    <td><?=$r1['ptname'];?></td>
    <td><?=$r1['ptright'];?></td>
    <td><?=$r1['diag'];?></td>
  </tr>
  <?
  }
  ?>
</table>
<?	
}
?>
<input name="btnButton" type="button" value="กลับหน้าเดิม" onClick="JavaScript:history.back();" class="forntsarabun" />