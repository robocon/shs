<?php 
set_time_limit(0);
include 'bootstrap.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานสรุปผลตรวจสุขภาพ</title>
<style type="text/css">

/* 
https://css-tricks.com/fixing-tables-long-strings/
*/
* {
	font-family: "TH Sarabun New","TH SarabunPSK";
	font-size: 18px;
}
.chk_table{
	border-collapse: collapse;
}
.chk_table th,
.chk_table td{
	padding: 3px;
	border: 1px solid black;
}

</style>
</head>
<?php

$Conn = mysql_connect("192.168.128.86", "remoteuser", "") or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");
mysql_select_db("smdb", $Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");

$sql = "SELECT a.*, b.* 
FROM ( SELECT `hn` AS `opHN`, CONCAT(`yot`,`name`,' ',`surname`) AS `fullname`  FROM `opcard` WHERE `employee` = 'y' ) AS a 
LEFT JOIN ( 
	SELECT y.* 
	FROM ( 
		SELECT MAX(`id`) AS `lastId` FROM `chk_doctor` WHERE `yearchk` = '64' AND (`date_chk`>='2020-10-21 00:00:00' AND `date_chk`<='2020-11-02 23:59:59') group by hn 
	) AS x 
	LEFT JOIN `chk_doctor` AS y ON y.`id` = x.`lastId` 
) AS b ON b.`hn` = a.`opHN` 
ORDER BY a.`opHN` ";
$out_result_sql = mysql_query($sql, $Conn) or die ( mysql_error() );
$num = mysql_num_rows($out_result_sql);

?>	
<body>
<div align="center"><strong>ผลการตรวจสุขภาพลูกจ้างชั่วคราว โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div>
<div align="center"><strong>ระหว่างวันที่ 21 - 30 ตุลาคม 2563 จำนวน <?=$num;?> ราย</strong></div>
<table width="100%" class="chk_table">
<tr>
	<th width="3%" rowspan="2" align="center">ลำดับ</th>
	<th width="5%" rowspan="2" align="center">HN</th>
	<th width="15%" rowspan="2" align="center">ชื่อ - สกุล</th>
	<th width="4%" rowspan="2" align="center">อายุ</th>
	<th width="5%" rowspan="2" align="center">น้ำหนัก</th>
	<th width="5%" rowspan="2" align="center">ส่วนสูง</th>
	<th width="5%" rowspan="2" align="center">BMI</th>
	<th width="5%" rowspan="2" align="center">รอบเอว</th>
	<th colspan="31" align="center">รายการตรวจ</th>
	<th width="8%" rowspan="2" align="center">ภาวะสุขภาพโดยรวม</th>
	<th rowspan="2" align="center">สรุปผลการตรวจ</th>
</tr>
<tr>
	<th width="3%" align="center">PE</th>
	<th width="7%" align="center">X-RAY</th>
	<th width="5%" align="center">CBC</th>
	<th width="5%" align="center">UA</th>
	<th width="5%" align="center">BS</th>
	<th width="6%" align="center">CHOL</th>
	<th width="6%" align="center">TRIG</th>
	<th width="5%" align="center">HDL</th>
	<th width="5%" align="center">LDL</th>
	<th width="5%" align="center">BUN</th>
	<th width="3%" align="center">CR</th>
	<th width="3%" align="center">eGFR</th>
	<th width="6%" align="center">URIC</th>
	<th width="7%" align="center">SGOT</th>
	<th width="6%" align="center">SGPT</th>
	<th width="4%" align="center">ALK</th>
	<th width="7%" align="center">HBsAg</th>
	<th width="6%" align="center">FOBT</th>
	<th width="6%" align="center">AFP</th>
	<th width="6%" align="center">Anti-HAV IgG</th>
	<th width="6%" align="center">Stool Exam</th>
	<th width="6%" align="center">Stool Culture</th>
	<th width="6%" align="center">Stool Occult</th>

	<th width="6%" align="center">METAMP</th>
	<th width="5%" align="center">ABOC</th>
	<th width="6%" align="center">EKG</th>
	<th width="6%" align="center">V/A</th>
	<th width="6%" align="center">สายตา</th>
	<th width="6%" align="center">สมรรถภาพปอด</th>
	<th width="6%" align="center">อัลตร้าซาวด์<br>ช่องท้อง</th>
	<th width="6%" align="center">ต่อมลูกหมาก<br>โดยการคลำ</th>
</tr>
<?php
$i=0;
while($result = mysql_fetch_array($out_result_sql)){

    // $yaer_chk = $result['year_chk'];
    $yaer_chk = "64";
    $pt_hn = $result['opHN'];
    $age = $result["age"];
    $cs = $result["cs"];
	$exam_no = $result["exam_no"];
	$ptname = $result["fullname"];
	$congenital_disease = $result["congenital_disease"];
	

	// จากที่หมอบันทึก
	$dxofyear_out_id = $result['dxofyear_out_id'];

    // if(empty($result["HN"])){
        $result["HN"] = $pt_hn;
    // }
	
	// ตัวเก่า out_result_chkup
	// dxofyear_out ข้อมูลที่ OPD ลงให้ 

	

    $sql2 = "SELECT * FROM `dxofyear_out` WHERE `row_id` = '$dxofyear_out_id' ";
	$query2 = mysql_query($sql2, $Conn) or die(mysql_error());

	$weight = $height = $bp = $cxr = $stat_cbc = $stat_ua = $conclution = $bmi = $round = "";

	if( mysql_num_rows($query2) > 0 ){
		$result2 = mysql_fetch_array($query2);
		$weight = $result2["weight"];
		$height = $result2["height"];
		$bmi = $result2["bmi"];
		$round = $result2['round_'];

		if(empty($age)){
			$age = $result2["age"];
		}

		if($result2["bp1"] && $result2["bp2"]){
			$bp=$result2["bp1"]."/".$result2["bp2"];
		}else if($result2["bp21"] && $result2["bp22"]){
			$bp=$result2["bp21"]."/".$result2["bp22"];
		}else{
			$bp="&nbsp;";
		}
		

		$cxr = "ปกติ";
		if( $result["cxr"] == 2){
			$cxr = "ผิดปกติ";
		}

		$stat_cbc = "ปกติ";
		if($result["res_cbc"] == 2){
			$stat_cbc = "ผิดปกติ";
		}
		
		$stat_ua = "ปกติ";
		if($result["res_ua"] == 2){
			$stat_ua = "ผิดปกติ";
		}

		$conclution = "ปกติ";
		if($result['conclution'] == 2){
			$conclution = "ผิดปกติ";
		}

	}
	
	$defLabNumber = "";
    
    $i++;
    
    // if($congenital_disease=="ปฎิเสธ" || empty($congenital_disease)){ 
    //     $disease="ไม่มี";
    // }else{
    //     $disease="มี";
    // }

    // $strSQL11 = "SELECT date_format(`orderdate`,'%d-%m-%Y') as orderdate2 
    // FROM `resulthead` 
    // WHERE `hn` = '".$result['HN']."' 
    // AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
    // order by autonumber desc";  //โชว์ข้อมูล
	
    // $objQuery11 = mysql_query($strSQL11);
    // list($orderdate)=mysql_fetch_array($objQuery11);
	
	// list($d,$m,$y)=explode("-",$orderdate);
	// $yy=$y+543;
	// $showdate="$d/$m/$yy";
	// $dateekg="$yy-$m";	
?>
<tr>
	<td align="center"><?=$i;?></td>
	<td><?=$pt_hn;?></td>
	<td><?=$ptname;?></td>
	<td align="center"><?=$age;?></td>
	<td align="center"><?=$weight;?></td>
	<td align="center"><?=$height;?></td>
	<!-- BMI -->
	<td align="center"><?=$bmi;?></td>
	<!-- รอบเอว -->
	<td align="center"><?=$round;?></td>
	<td>&nbsp;</td>
	<td align="left"><?=$cxr;?></td>
    <td align="center">
		<?php 
		// $stat_cbc = $stat_ua = '';
		// $queryStat = mysql_query("SELECT `stat_cbc`,`stat_ua` FROM `condxofyear_out` WHERE `hn` = '$pt_hn' ORDER BY `row_id` DESC LIMIT 1");
		// $dxStat = mysql_fetch_assoc($queryStat);
		// $stat_cbc = $dxStat['stat_cbc'];
		// $stat_ua = $dxStat['stat_ua'];

		$sqlCBC="SELECT b.* 
		FROM ( 

			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'CBC' 
			GROUP BY `profilecode` 
		) AS a 
		LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_number` ";
		$queryCBC = mysql_query($sqlCBC, $Conn) or die(mysql_error());
		$countCBC = mysql_num_rows($queryCBC);
		if($countCBC > 0){
			echo "มี";
			if( !empty($stat_cbc) ){
				echo "($stat_cbc)";
			}
		}else if($countCBC < 1){
			echo "<strong style='color:#FF0000'>ไม่มี</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<td align="center">
		<?php 
		$sql19="SELECT b.* 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'UA' 
			GROUP BY `profilecode` 
		) AS a 
		LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_number` ";
		$query19 = mysql_query($sql19);
		$numua = mysql_num_rows($query19);
		if($numua > 0){
			echo "มี";
			if( !empty($stat_ua) ){
				echo "($stat_ua)";
			}
		}else if($numua < 1){
			echo "<strong style='color:#FF0000'>ไม่มี</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
    <td align="center">
		<?php
		$sql1="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'GLU' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE (b.result !='DELETE' OR b.result !='*') ";
		$query1=mysql_query($sql1);
		list($glu,$flag)=mysql_fetch_array($query1);
		if($flag=="N" || $flag=="L"){
			echo $glu;
		}else if($flag=="H"){
			echo "<strong style='color:#FF0000'>$glu</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql2="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'CHOL' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'CHOL' AND (b.result !='DELETE' OR b.result !='*') ";
		$query2=mysql_query($sql2);
		list($chol,$flag)=mysql_fetch_array($query2);
		if($flag=="N"){
			echo $chol;
		}else if($flag=="H" || $flag=="L"){
			echo "<strong style='color:#FF0000'>$chol</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql3="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'TRIG' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'TRIG' AND (b.result !='DELETE' OR b.result !='*') ";
		$query3=mysql_query($sql3);
		list($trig,$flag)=mysql_fetch_array($query3);
		if($flag=="N"){
			echo $trig;
		}else if($flag=="H" || $flag=="L"){
			echo "<strong style='color:#FF0000'>$trig</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql4="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'HDL' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'HDL' AND (b.result !='DELETE' OR b.result !='*') ";
		$query4=mysql_query($sql4);
		list($hdl,$flag)=mysql_fetch_array($query4);

		if($flag=="N" || $flag=="H"){
			echo $hdl;
		}else if($flag=="L"){
			echo "<strong style='color:#FF0000'>$hdl</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<!-- LDL ธรรมดา -->
	<td align="center">
		<?php 
		$sql5="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'LDL'
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE `profilecode` = 'LDL' AND (b.result !='DELETE' OR b.result !='*') ";
		$query5=mysql_query($sql5);
		list($ldl,$flag)=mysql_fetch_array($query5);
		if($flag=="N" || $flag=="L"){
			echo $ldl;
		}else if($flag=="H"){
			echo "<strong style='color:#FF0000'>$ldl</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql6="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'BUN' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'BUN' AND (b.result !='DELETE' OR b.result !='*') ";
		$query6=mysql_query($sql6);
		list($bun,$flag)=mysql_fetch_array($query6);
		if($flag=="N"){
			echo $bun;
		}else{
			echo "<strong style='color:#FF0000'>$bun</strong>";
		}
		?>
	</td>
	<td align="center">
		<?php 
		// CREA
		$sql7="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'CREAG' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'CREA' AND (b.result !='DELETE' OR b.result !='*') ";
		$query7=mysql_query($sql7);
		list($crea,$flag)=mysql_fetch_array($query7);
		if($flag=="N"){
			echo $crea;
		}else{
			echo "<strong style='color:#FF0000'>$crea</strong>";
		}
		?>
	</td>
	<td align="center">
		<?php 
		// GFR
		$sql7="SELECT b.result, b.flag 
		FROM ( 

			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			$defLabNumber 
			AND `profilecode` = 'CREAG' 
			GROUP BY `profilecode` 

		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'GFR' AND (b.result !='DELETE' OR b.result !='*') ";
		
		$query7=mysql_query($sql7);
		list($crea,$flag)=mysql_fetch_array($query7);

		if($flag=="N"){
			echo $crea;
		}else{
			echo "<strong style='color:#FF0000'>$crea</strong>";
		}
		?>
	</td>
    <td align="center">
		<?php 
		$sql8="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'URIC' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'URIC' AND (b.result !='DELETE' OR b.result !='*') ";
		$query8=mysql_query($sql8);
		list($uric,$flag)=mysql_fetch_array($query8);
		if($flag=="N"){
			echo $uric;
		}else{
			echo "<strong style='color:#FF0000'>$uric</strong>";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql9="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'AST' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'AST' AND (b.result !='DELETE' OR b.result !='*') ";
		$query9=mysql_query($sql9);
		list($ast,$flag)=mysql_fetch_array($query9);
		if($flag=="N"){
			echo $ast;
		}else{
			echo "<strong style='color:#FF0000'>$ast</strong>";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql10="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'ALT' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'ALT' AND (b.result !='DELETE' OR b.result !='*') ";
		$query10=mysql_query($sql10);
		list($alt,$flag)=mysql_fetch_array($query10);
		if($flag=="N"){
			echo $alt;
		}else{
			echo "<strong style='color:#FF0000'>$alt</strong>";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql11="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'ALP' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'ALP' AND (b.result !='DELETE' OR b.result !='*') ";
		$query11=mysql_query($sql11);
		list($alp,$flag)=mysql_fetch_array($query11);
		if($flag=="N"){
			echo $alp;
		}else{
			echo "<strong style='color:#FF0000'>$alp</strong>";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql12="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'HBSAG' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'HBSAG' AND (b.result !='DELETE' OR b.result !='*') ";
		$query12=mysql_query($sql12);
		list($hbsag,$flag)=mysql_fetch_array($query12);
		if($hbsag=="Negative"){
			echo "ไม่พบเชื้อ";
		}else if($hbsag=="Positive"){
			echo "<strong style='color:#FF0000'>พบเชื้อ</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql13="SELECT b.result, b.flag 
		FROM resulthead AS a
		INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
		WHERE b.labcode = 'OCCULT' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
		AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk'
		GROUP BY a.`profilecode` ";
		$query13=mysql_query($sql13);
		list($hbsag,$flag)=mysql_fetch_array($query13);
		if($hbsag=="Negative"){
			echo "ไม่พบเลือด";
		}else if($hbsag=="Positive"){
			echo "<strong style='color:#FF0000'>พบเลือด</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql13="SELECT b.result, b.flag 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'AFP' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
		WHERE b.labcode = 'AFP' AND (b.result !='DELETE' OR b.result !='*') ";
		$query13 = mysql_query($sql13);
		list($afp,$flag) = mysql_fetch_array($query13);
		echo $afp;
		?>
	</td>
	<!-- Anti-HAV IgG -->
	<td align="center">
		<?php 
		$sql = "SELECT b.`result`, b.`flag` 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$pt_hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'HAVTOT' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
		WHERE b.labcode = 'HAVTOT' AND (b.result !='DELETE' OR b.result !='*') ";
		$query13 = mysql_query($sql);
		list($havtot, $flag) = mysql_fetch_array($query13);
		echo $havtot;
		?>
	</td>
	<!-- WET ตรวจอุจจาระสมบูรณ์แบบ Stool Exam -->
	<td align="center">
		<?php 
		$sql = "SELECT b.`result`, b.`flag` 
		FROM ( 
			SELECT *, MAX(`autonumber`) AS `latest_number`
			FROM `resulthead` 
			WHERE `hn` = '$hn' 
			AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
			AND `profilecode` = 'WET' 
			GROUP BY `profilecode` 
		) AS a
		INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
		WHERE b.labcode = 'WET' AND (b.result !='DELETE' OR b.result !='*') ";
		$query13 = mysql_query($sql);
		$resutlWET = "";
		if (mysql_num_rows($query13) > 0) {
			list($result, $flag) = mysql_fetch_array($query13);
			$resutlWET = 'ปกติ';
			if( $flag != 'N' ){
				$resutlWET = 'ผิดปกติ';
			}
		}
		echo $resutlWET;
		?>
	</td> 
	<!-- Stool Culture -->
	<td align="center"><?php echo $cs; ?></td>

	<?php
	// ตรวจเลือดในอุจจาระ - Stool Occult
	$sql = "SELECT b.`result`, b.`flag` 
	FROM ( 
		SELECT *, MAX(`autonumber`) AS `latest_number`
		FROM `resulthead` 
		WHERE `hn` = '$hn' 
		AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
		AND `profilecode` = 'STOCC' 
		GROUP BY `profilecode` 
	) AS a
	INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
	WHERE b.labcode = 'STOCC' AND (b.result !='DELETE' OR b.result !='*') ";
	$query13 = mysql_query($sql);
	list($stoccRes, $flag) = mysql_fetch_array($query13);
	$stoccTxt = '';
	if( $stoccRes == 'Negative' ){
		$stoccTxt = 'ปกติ';
	}elseif ( $stoccRes == 'Positive' ) {
		$stoccTxt = 'ผิดปกติ';
	}
	?>
	<td align="center"><?=$stoccTxt;?></td>
	<td align="center">
		<?php 
		$sql14="SELECT b.result, b.flag 
		FROM resulthead AS a
		INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
		WHERE b.labcode = 'METAMP' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
		AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk'
		GROUP BY a.`profilecode` ";
		$query14=mysql_query($sql14);
		list($hbsag,$flag)=mysql_fetch_array($query14);
		if($hbsag=="Negative"){
			echo "ปกติ";
		}else if($hbsag=="Positive"){
			echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
	<td align="center">
		<?php
		$sql17="SELECT b.result, b.flag 
		FROM resulthead AS a
		INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
		WHERE b.labcode = 'ABOC' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
		AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk'
		GROUP BY a.`profilecode` ";
		$query17=mysql_query($sql17);
		list($aboc,$flag)=mysql_fetch_array($query17);
		if($flag=="N"){
			echo $aboc;
		}else if($flag=="H" || $flag=="L"){
			echo "<strong style='color:#FF0000'>$aboc</strong>";
		}else{
			echo "&nbsp;";
		}
		?>
	</td>
    <td><!-- EKG --></td>
    <td><!-- V/A --></td>
    <td><!-- eye --></td>
    <td><!-- pt --></td>
    <td>
		<?php
		if( !empty($result['altra']) ){
			echo $result['altra'];
		}
		?>
    </td>
    <td>
		<?php 
		// ต่อมลูกหมากโดยการคลำ
		if( !empty($result['psa']) ){
			echo $result['psa'];
		}
		?>
    </td>
	<td>&nbsp;</td>
	<td><?=$conclution;?></td>
</tr>
<?php } ?>  
</table>
<p align="center">PE = การตรวจร่างกายทั่วไป  BS = น้ำตาลในเลือด  CHOL,TRI, HDL, LDL= ไขมันในเลือด BUN, CR= การทำงานของไต  URIC = กรดยูริค SGOT,SGPT, ALK = การทำงานของตับ<br />
HBsAg = เชื้อไวรัสตับอักเสบ  FOBT = เลือดในอุจจาระ METAMP = ตรวจหาสารเสพติด ABOC = กรุ๊ปเลือด EKG = คลื่นหัวใจไฟฟ้า V/A = ตรวจตา</p>
</body>
</html>
