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
	
include("connect.inc");
	
$icd10=$_REQUEST['icd10'];
$date1=$_REQUEST['date'];

$sql1="select *  from opday Where icd10='$icd10'  and thidate like '$date1%'  and ptright  LIKE  '%��Сѹ�آ�Ҿ��ǹ˹��%'";
$q1=mysql_query($sql1);
$i=0;
?>
<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun">
  <tr align="center">
    <td bgcolor="#0099FF" >�ӴѺ</td>
    <td bgcolor="#0099FF">�ѹ���</td>
    <td bgcolor="#0099FF">HN</td>
    <td bgcolor="#0099FF">AN</td>
    <td bgcolor="#0099FF">����-ʡ��</td>
    <td bgcolor="#0099FF">�Է��</td>
    <td bgcolor="#0099FF">Diag</td>
    <td bgcolor="#0099FF">ICD10</td>
  </tr>
  <?
  while($r1=mysql_fetch_array($q1)){  
  ?>
<tr>
 <td align="center"><?=++$i;?></td>
    <td><?=$r1['thidate'];?></td>
    <td><?=$r1['hn'];?></td>
    <td><?=$r1['an'];?></td>
    <td><?=$r1['ptname'];?></td>
    <td><?=$r1['ptright'];?></td>
    <td><?=$r1['diag'];?></td>
    <td><?=$r1['icd10'];?></td>
  </tr>
  <?
  }
  ?>
</table>
<?	
}
?>
<input name="btnButton" type="button" value="��Ѻ˹�����" onClick="JavaScript:history.back();" class="forntsarabun" />