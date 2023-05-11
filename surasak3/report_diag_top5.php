<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>รายงาน 10 อันดับโรค</title>
<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 18px;
}

</style>
</head>
<?
include("connect.inc");
?>
<body>
<div align="center">
<p align="center"><strong>รายงาน 10 อันดับโรค</strong></p>
<form action="report_diag_top5.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
คลีนิก : 
<select name="clinic" class="forntsarabun" id="clinic">
<option value="opd">ผู้ป่วยนอก</option>  
<option value="ipd">ผู้ป่วยใน</option>  
</select>
ปี : <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2556,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       <input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>
    <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
</form>
</div>
<hr />
<?php
if($_POST["act"]=="show"){
$clinic=$_POST["clinic"];
$showdate=$_POST["y_start"];

if( $clinic == 'opd' ){
	$sql="SELECT icd10, count( icd10 )  AS num
	FROM  `opday` 
	WHERE `thidate` LIKE  '$showdate%' AND (an ='' || an is null) AND 
	(icd10 IS NOT NULL AND icd10 !='') 
	GROUP  BY icd10
	ORDER  BY count( icd10 )  DESC 
	LIMIT 10";	
  $showclinic="ผู้ป่วยนอก";
}else{
	$sql="SELECT icd10, count(icd10)  AS num
	FROM  `ipcard` 
	WHERE `dcdate` LIKE  '$showdate%' AND 
	(icd10 IS NOT NULL AND icd10 !='') 
	GROUP  BY icd10
	ORDER  BY count(icd10)  DESC 
	LIMIT 10";
  $showclinic="ผู้ป่วยใน";
}
//echo $sql;
$query= mysql_query($sql); 
$rows=mysql_num_rows($query);
?>
<p align="center"><strong>รายงาน 10 อันดับโรค<br />
ประจำปี <?=$showdate;?>  ประเภท : <? echo $showclinic;?></strong></p>
<table width="80%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
<tr>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>icd10</strong></td>
    <td width="33%" align="center" bgcolor="#66CC99"><strong>ชื่อโรค(ไทย)</strong></td>
    <td width="35%" align="center" bgcolor="#66CC99"><strong>ชื่อโรค(อังกฤษ)</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>จำนวน</strong></td>
  </tr>
<?  
if($rows){
$i=0;
while(list($icd10,$num) = mysql_fetch_array($query)){  
	$i++;
	$sql1=mysql_query("select detail, diag_thai from icd10 where code='$icd10'");
	list($detail,$diag_thai)=mysql_fetch_array($sql1);
?>
<td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
<td bgcolor="#CCFFCC"><?=$icd10;?></td>
<td bgcolor="#CCFFCC"><?=$diag_thai;?></td>
<td bgcolor="#CCFFCC"><?=$detail;?></td>
<td align="center" bgcolor="#CCFFCC"><?=$num;?></td>
</tr>
<? 
}
}else{
 echo " <tr> <td colspan='5' class='forntsarabun' align='center'>--------- ไม่พบรายการ ----------</td>
  </tr>";
}
?>
</table>
<?
}
?>
</body>
</html>
