<?php
// require("fpdf/fpdf.php");
// require("fpdf/pdf.php");

require("connect.php");

$month_ = array(
	'01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', 
	'07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
);

// $day = sprintf("%02d", $_POST["day"]);
$month = sprintf("%02d", $_POST["month"]);
$year = sprintf("%02d", $_POST["year"]);

$doctor = $_POST["doctor"];
$code = $_POST["code"];

$time = $_POST["time"];
	


list($timeStart, $timeEnd) = explode("-", $_POST["time"]);

// สร้าง temp 
if($code === '58000'){
	$where = "AND `code` LIKE '$code%' ";
}else{
	$where = "AND ( `code` LIKE '58001%' OR `code` LIKE '58002%' OR `code` LIKE '58003%' )";
}

$sql_temp = "
CREATE TEMPORARY TABLE IF NOT EXISTS patdata_temp 
SELECT `hn`, `ptname`, `idno`, `date`, `detail`, `amount`, DATE_FORMAT(`date`,'%H:%i:%s') AS `time`, DATE_FORMAT(`date`,'%Y-%m-%d') AS `date2`
FROM `patdata` 
WHERE `hn` != '' 
AND `doctor` LIKE '$doctor%' 
AND ( `date` >= '$year-$month-01' AND `date` <= '$year-$month-31') 
$where ;";
mysql_query($sql_temp) or die( mysql_error() );

// คัดเวลา ช่วงเวลาทำการ และ นอกเวลาทำการ
$setTime = " `time` >= '08:20:00' AND `time` <= '16:20:00' ";
if ( $time !== '08:00:00-16:00:00' ) {
	$setTime = " `time` >= '16:20:00' AND `time` <= '20:20:00' ";
}

$sql = "SELECT *
FROM `patdata_temp` 
WHERE $setTime
GROUP BY `hn` 
HAVING SUM(`amount`) > 0 
ORDER BY `date` ASC";
$result2  = mysql_query($sql) or die( mysql_error() );

$txt = "คลินิกนอกเวลาราชการ (ฝังเข็ม) เวลา ";
switch( $time ){
	
	case "08:00:00-16:00:00" : $txt .= "08:00 - 16.00"; break;
	case "16:00:00-20:00:00" : $txt .= "16:00 - 20:00"; break;
	
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
			<p>เดือน <?php echo $month_[$month]." $year";?></p>
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
					<th>วันที่</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i=1;
				while( $item = mysql_fetch_assoc($result2) ){
					
					$sql = "SELECT `diag` 
					FROM `depart` 
					WHERE `row_id` = '".$item['idno']."'";
					$query = mysql_query($sql) or die( mysql_error() );
					$res = mysql_fetch_assoc($query);
				
				?>
				<tr>
					<td width="5%" align="center"><?=$i;?></td>
					<td><?=$item['ptname'];?></td>
					<td align="center"><?=$item['hn'];?></td>
					<td align="center"><?=$res['diag'];?></td>
					<td><?=$item['date2'];?></td>
				</tr>
				<?php
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>
	<?php /* ?>
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
	<?php */ ?>
</div>