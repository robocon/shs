<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<?
include("connect.inc"); 
$thidate=$_GET['thidate'];
$icd10=$_GET['icd10'];
if($_REQUEST['do']=='deadip'){
	$where="and dctype like '%dead%' ";
}


if($_REQUEST['do']=='op'){

	$sql1="SELECT  *  FROM opday WHERE thidate like '$thidate%' and icd10 =  '$icd10' and (an='' or an is null) order by thidate asc";
	$query1 = mysql_query($sql1);
}else{
	
	$sql1="SELECT  *  FROM ipcard WHERE dcdate like '$thidate%' and icd10 = '$icd10'  ".$where." order by date asc";
	$query1 = mysql_query($sql1);
}
	$i=1;
?>

<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">ลำดับ</td>
    <td align="center">วันที่-เวลา</td>
    <? if($_REQUEST['do']=='ip' || 'deadip'){ ?>
    <td align="center">วันที่จำหน่าย</td>
    <? } ?>
    <td align="center">HN</td>
    <td align="center">AN</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">สิทธิ</td>
    <td align="center">ICD10</td>
    </tr>
    <? 
while($arr1=mysql_fetch_array($query1)){
	
	if($_REQUEST['do']=='ip' || 'deadip'){
		$date=$arr1['date'];
	}elseif($_REQUEST['do']=='op'){
		$date=$arr1['thidate'];
	}
	?>
    <tr class="forntsarabun">
      <td align="center"><?=$i;?></td>
      <td><?=$date?></td>
      <? if($_REQUEST['do']=='ip' || 'deadip'){ ?><td><?=$arr1['dcdate']?></td><? }?>
      
      <td><?=$arr1['hn']?></td>
      <td><?=$arr1['an']?></td>
      <td><?=$arr1['ptname']?></td>
      <td><?=$arr1['ptright']?></td>
      <td><?=$arr1['icd10']?></td>
     </tr>
     <?
	 $i++;
	}
	?>

    </table>