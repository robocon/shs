<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis620" />
<title>รายงาน 10 อันดับโรคประจำเดือน</title>
<style type="text/css">
<!--
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
-->
</style>
</head>
<?
include("connect.inc");
include 'bootstrap.php';
$m=date('m');
?>
<body>
<div align="center">
<p align="center"><strong>รายงาน 10 อันดับโรคผู้ป่วยนอก สำหรับผู้ป่วยเด็กที่มีอายุน้อยกว่า 15 ปี</strong></p>
<form action="report_listicd10_student_opd.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
<table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
			<tr class="forntsarabun" align="center">
				<td colspan="2" bgcolor="#33CCCC"><strong>เลือกการแสดงผล</strong></td>
	  </tr>
			<tr class="forntsarabun" align="center">
				<td colspan="2">
					<?php
					$def_year = get_year_checkup(true, true);
					$range_year = range(( $def_year - 5 ), $def_year);
					?>
					ปีงบประมาณ: <?=getYearList('y_start', true, $def_year, $range_year);?>
				</td>
			</tr>
			<tr class="forntsarabun" align="center">
				<td colspan="2">
					<button class="forntsarabun" type="submit">ตกลง</button>
					<input type="hidden" name="checkup" value="yes">
					<input type="hidden" name="submit" value="submit">
				</td>
			</tr>
		</table>
	</form>
</div>
<hr />
<?
if($_POST["act"]=="show"){

$date=$_POST["y_start"]+543;
$month1="10-01 00:00:00";
$month2="09-30 23:59:59";
$year=$_POST["y_start"]+543;
$date1=$_POST["y_start"]+542;
$date2=$_POST["y_start"]+543;

$chkyear1="$date1-$month1";
$chkyear2="$date2-$month2";

$sql="SELECT icd10, count( icd10 )  AS num
FROM  `opday` 
WHERE (icd10 IS NOT NULL AND icd10 !='') 
AND `thidate` BETWEEN  '$chkyear1' AND '$chkyear2' 
AND (age !='' AND age < 15)  GROUP  BY icd10
ORDER  BY count( icd10 ) DESC 
LIMIT 10";

//echo $sql;
$query= mysql_query($sql); 
$rows=mysql_num_rows($query);
?>
<p align="center"><strong>รายงาน 10 อันดับโรคผู้ป่วยนอก สำหรับผู้ป่วยเด็กที่มีอายุน้อยกว่า 15 ปี<br />ปีงบประมาณ <?=$year;?></strong></p>
<table width="80%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
<tr>
        <td width="8%" align="center" bgcolor="#FFCC99"><strong>ลำดับ</strong></td>
    <td width="14%" align="center" bgcolor="#FFCC99"><strong>icd10</strong></td>
    <td width="33%" align="center" bgcolor="#FFCC99"><strong>ชื่อโรค(ไทย)</strong></td>
    <td width="35%" align="center" bgcolor="#FFCC99"><strong>ชื่อโรค(อังกฤษ)</strong></td>
    <td width="10%" align="center" bgcolor="#FFCC99"><strong>จำนวน</strong></td>
  </tr>
<?  
if($rows){
$i=0;
while(list($icd10,$num) = mysql_fetch_array($query)){  
	$i++;
	$sql1=mysql_query("select detail, diag_thai from icd10 where code='$icd10'");
	list($detail,$diag_thai)=mysql_fetch_array($sql1);
?>
<td align="center" bgcolor="#FFFFCC"><?=$i;?></td>
<td bgcolor="#FFFFCC"><?=$icd10;?></td>
<td bgcolor="#FFFFCC"><?=$diag_thai;?></td>
<td bgcolor="#FFFFCC"><?=$detail;?></td>
<td align="center" bgcolor="#FFFFCC"><?=$num;?></td>
</tr>
<? 
}
}else{
 echo " <tr> <td colspan='5' class='forntsarabun' align='center'>--------- ไม่พบรายการ ----------</td>
  </tr>";
}
?>
</table>
<p align="center"><strong>รายชื่อผู้ป่วยนอกที่มีอายุน้อยกว่า 15 ปี<br />ประจำปี <?=$date;?></strong></p>
<?
	$sql1 = "CREATE TEMPORARY TABLE `opday1` 
	SELECT `row_id`,`thidate`,`hn`,`ptname`,`age`,`ptright`,`diag`, TRIM(`icd10`) AS `icd10`
	FROM `opday` 
	WHERE `thidate` BETWEEN  '$chkyear1' AND '$chkyear2' 
	AND (age !='' and age < 15)";
	$query1 = mysql_query($sql1) or die( mysql_error() );
 
	$sql = "SELECT * FROM opday1 order by thidate asc";
	$objq = mysql_query($sql);
?>

		<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun" align="center">
			<tr bgcolor="#0099FF">
				<td align="center">ลำดับ</td>
				<td align="center">วันที่</td>
				<td align="center">HN</td>
				<td align="center">ชื่อ-สกุล</td>
				<td align="center">อายุ</td>
				<td align="center">สิทธิ</td>
				<td align="center">Diag</td>
				<td align="center">icd10</td>
			</tr>
			<?php
			$i = 0;
			$empty_i = 0;
			$

			$new_item_set = array();
			while( $item = mysql_fetch_array($objq) ){

				// นับจำนวน icd10 ที่มันเป็นค่าว่าง
				if( empty($item['icd10']) OR is_null($item['icd10']) ){
					++$empty_i;
				}
				?>
				<tr>
					<td align="center"><?=++$i;?></td>
					<td><?=$item['thidate'];?></td>
					<td><?=$item['hn'];?></td>
					<td><?=$item['ptname'];?></td>
					<td><?=$item['age'];?></td>
					<td><?=$item['ptright'];?></td>
					<td><?=$item['diag'];?></td>
					<td><?=$item['icd10'];?></td>
				</tr>
				<?php
			} //End while
			?>
		</table>
<?
}
?>
</body>
</html>
