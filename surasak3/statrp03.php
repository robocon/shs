<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

require("connect.php");

$month_["01"] = "มกราคม";
$month_["02"] = "กุมภาพันธ์";
$month_["03"] = "มีนาคม";
$month_["04"] = "เมษายน";
$month_["05"] = "พฤษภาคม";
$month_["06"] = "มิถุนายน";
$month_["07"] = "กรกฏาคม";
$month_["08"] = "สิงหาคม";
$month_["09"] = "กันยายน";
$month_["10"] = "ตุลาคม";
$month_["11"] = "พฤศจิกายน";
$month_["12"] = "ธันวาคม";

if($_GET["day"] != "")
	$_GET["day"] = sprintf("%02d",$_GET["day"]);


$time_zone = explode("-",$_GET["time"]);
	
	$where = " AND `code` LIKE '".$_GET["code"]."%'  ";

if($_GET["code"] == "58001" OR $_GET["code"] == "58000" ){ //ฝังเข็ม

	$date = $_GET["year"]."-".$_GET["month"]."-".$_GET["day"];
	$start_from = $time_zone[0];
	$end_from = $time_zone[1];
	$code = trim($_GET["code"]);
	$doctor = trim($_GET["doctor"]);

	if( $code == '58001' ){
		$where = " AND ( `code` LIKE '$code%' OR `code` LIKE '58020%') ";
	}else{
		$where = " AND `code` LIKE '$code%' ";
	}
	
	// Test case
	$sql = "SELECT a.* 
	FROM ( 
		SELECT `row_id`,`hn`,`date`,`ptname`,`idno`,`code`,`amount`,`doctor`,`ptright`,
		SUBSTRING(`date`, 1, 10) AS `dateymd`, 
		SUBSTRING(`date`, 12, 8) AS `timehis`
		FROM `patdata` 
		WHERE `hn` != '' 
		AND `date` LIKE '$date%' 
		AND `doctor` LIKE '$doctor%'
		$where 
	) AS a 
	LEFT JOIN `patdata` AS b ON a.`row_id` = b.`row_id`
	WHERE ( a.`timehis` >= '$start_from' AND a.`timehis` <= '$end_from' )
	GROUP BY a.`hn` HAVING SUM(a.`amount`) > 0 
	ORDER BY a.`date` ASC ";

	$result2  = Mysql_Query($sql) or die( mysql_error() );
	
	$txt = "คลินิกนอกเวลาราชการ (ฝังเข็ม) เวลา ";
	switch($_GET["time"]){
		case "07:30:00-12:30:00" : $txt .= "08.00 - 12.00"; break;
		case "16:20:00-21:00:00" : $txt .= "16.30 - 20.30"; break;
		case "08:00:00-16:00:00" : $txt .= "08.00 - 16.00"; break;
		case "16:00:01-20:30:00" : $txt .= "16.00 - 20.00"; break;
	
	}
	?>
	<style type="text/css">
		body, th, td{
			font-family: 'TH SarabunPSK';
			font-size: 20px;
		}
		.main-contain{
			width: 80%;
		}
		@media screen and (max-width: 992px){
			.main-contain{
				width: 100%;
			}
		}
		@media print{
			.main-contain{
				width: 100%;
			}
			.fix-head, .fix-bottom{
				display: table-header-group;
			}
		}
	</style>
	<div class="main-contain">
		<div class="fix-head">
			<div style="text-align: center;">
				<p><?=$txt;?></p>
			</div>
			<div>
				<p><?php echo "วันที่ ".$_GET["day"]." ".$month_[$_GET["month"]]." ".$_GET["year"];?></p>
			</div>
		</div>
		<div>
			<table width="100%" border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
				<thead>
					<tr>
						<th>ลำดับ</th>
						<th>ชื่อ - สกุล ผู้รับบริการ</th>
						<th>HN</th>
						<th>โรค</th>
						<th>สิทธิการรักษา</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$i=1;
					while( $item = mysql_fetch_assoc($result2)){	
						$hn = $item['hn'];
						$ptname = $item['ptname'];
						$idno = $item['idno'];
						
						$sql = "SELECT `diag` 
						FROM `depart` 
						WHERE `row_id` = '$idno'";
						$query = mysql_query($sql) or die( mysql_error() );
						$res = mysql_fetch_assoc($query);
					
					?>
					<tr>
						<td align="center"><?=$i;?></td>
						<td><?=$ptname;?></td>
						<td align="center"><?=$hn;?></td>
						<td align="center"><?=$res['diag'];?></td>
						<td align="center"><?=$item['ptright'];?></td>
					</tr>
					<?php
						$i++;
					}
					?>
				</tbody>
			</table>
		</div>
		<div style="padding: 0.5em;"></div>
		<div class="fix-bottom">
			<table width="100%" border="0" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
				<tbody>
					<tr>
						<td width="50%">ผู้บันทึก</td>
						<td width="50%">นาย</td>
					</tr>
					<tr>
						<td><span style="padding-left: 50px;"></span>(<span style="padding: 0 80px;"></span>)</td>
						<td><span style="padding-left: 50px;"></span>(<span style="padding: 0 80px;"></span>)</td>
					</tr>
					<tr>
						<td><span style="padding-left: 65px;"></span>เจ้าหน้าที่คลินิกฝังเข็ม</td>
						<td><span style="padding-left: 95px;"></span>แพทย์ผู้รักษา</td>
					</tr>
					<tr>
						<td><span style="padding-left: 65px;"></span>........../........../..........</td>
						<td><span style="padding-left: 80px;">........../........../..........</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<script>
		window.print();
	</script>
	<?php
	exit;
	
}else{ 
	
	$time = rawurlencode($_GET['time']);
	$url = "statrp03_pdf.php?year=".$_GET['year']."&month=".$_GET['month']."&day=".$_GET['day']."&time=$time";
	?>
	<iframe src="statrp03_pdf.php?year=<?=$_GET['year'];?>&month=<?=$_GET['month'];?>&day=<?=$_GET['day'];?>&time=<?=$time;?>" frameborder="0" width="100%" height="100%" id="printf" name="printf"></iframe>
	<script>
		setTimeout(function(){ 
			window.frames["printf"].focus();
			window.frames["printf"].print();
		}, 500);

		window.onfocus = function(){
			setTimeout(function(){
				window.close();
			}, 100);
		}
	</script>
	<?php
	
}//นวดแผนไทย

require("unconnect.php");
?>