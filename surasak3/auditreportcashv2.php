<?php 
require_once 'bootstrap.php';

$hn = sprintf("%s", $_GET['hn']);
$date_start = ad_to_bc(sprintf("%s", $_GET['date_start']));
$date_end = ad_to_bc(sprintf("%s", $_GET['date_end']));

if(empty($hn) OR empty($date_start) OR empty($date_end)){
	echo "กรุณาตรวจสอบข้อมูลให้ครบถ้วน";
	exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title>เอกสารแสดงค่าใช้จ่ายในการรักษาพยาบาลประเภทผู้ป่วยนอก</title>
</head>
<body>
	
<style type="text/css">
	*{
		font-family: "TH SarabunPSK";
		font-size: 18px;
	}
	.textcash1 {
		font-size: 22px;
	}
</style>
<?php 
$sql3 = "SELECT `vn`,`thidate`,SUBSTRING(`thidate`,1,10) AS `date`, 
CONCAT(SUBSTRING(`thidate`,9,2),'/',SUBSTRING(`thidate`,6,2),'/',(SUBSTRING(`thidate`,1,4)-543)) AS `endate` 
FROM `opday` 
WHERE ( `thidate` >= '$date_start 00:00:00' AND `thidate` <= '$date_end 23:59:59' ) 
AND `hn` = '$hn' ";
$result3 = $dbi->query($sql3);
$opday_rows = $result3->num_rows;
if($opday_rows > 0){
	?>
	<p>
		<a class="w3-button w3-round-large w3-teal" href="<?=NOTIFY_HOST;?>/phpspreadsheet/index.php?hn=<?=$hn;?>&date_start=<?=$date_start;?>&date_end=<?=$date_end;?>" target="_blank"><b>ดาวโหลดไฟล์ XLSX</b></a>
	</p>
	<?php 
}

$sqlopcard = "SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' LIMIT 1";
$qOpcard = $dbi->query($sqlopcard);
$results = $qOpcard->fetch_assoc();
$payyes = 0;
$payno = 0;
$total = 0;
$ptname = $results['ptname'];

if($opday_rows > 0){
	?>
	<h3>ข้อมูลตั้งแต่ <?=$date_start;?> ถึง <?=$date_end;?></h3>
	<table width="100%" border="1" cellpadding="2" cellspacing="0" class="textcash" style="border-collapse:collapse">
		<tr>
			<td class="textcash"><b>HN</b></td>
			<td class="textcash"><b>ชื่อ-สกุล ผู้ป่วย</b></td>
			<td class="textcash"><b>วันที่</b></td>
			<td class="textcash"><b>รายการค่าใช้จ่าย</b></td>
			<td class="textcash"><b>จำนวน</b></td>
			<td class="textcash"><b>ราคา</b></td>
			<td class="textcash"><b>รวมเงิน</b></td>
			<td class="textcash"><b>เบิกไม่ได้</b></td>
		</tr>
	<?php
	while($row3 = $result3->fetch_assoc()){

		$thidate = $row3['thidate'];
		$date = $row3['date'];
		$vn = $row3['vn'];
		$endate = $row3['endate'];

		$query13 = "SELECT b.row_id,b.`tradname`,b.`amount`,b.`price`,b.`part`,b.`DPY`,b.`DPN` 
		FROM ( SELECT `row_id` FROM `phardep` WHERE `date` LIKE '$date%' AND `hn` = '$hn' AND `price` > 0 ) AS a 
		LEFT JOIN `drugrx` AS b ON b.`idno` = a.`row_id` 
		WHERE b.`amount` > 0";

		$result13 = $dbi->query($query13);
		if( $result13->num_rows > 0 ){

			while($drug = $result13->fetch_assoc()){ 

				$tradname = $drug['tradname'];
				$amount = $drug['amount'];
				$price = $drug['price'];
				$part = $drug['part'];
				$dpy = $drug['dpy'];
				$dpn = $drug['dpn'];

				$sum = (int) $price;
				$unit = $price / $amount;

				if($dpn>0){
					$dpn = number_format($dpn, 2, ',');
					$sum = $dpy;
				}else{
					$dpn = '';
				}

				?>
				<tr>
					<td><?=$hn;?></td>
					<td><?=$ptname;?></td>
					<td><?=$endate;?></td>
					<td><?=$tradname;?></td>
					<td align="center"><?=$amount;?></td>
					<td align="right"><?=number_format($unit, 2);?></td>
					<td align="right"><?=number_format($sum, 2);?></td>
					<td align="right"><?=$dpn;?></td>
				</tr>
				<?php
				if ($price == "-")
					$price = 0;

				if ($price1 == "-")
					$price1 = 0;

				$payyes += $price;
				$payno += $price1;
				
			}
		}

		$sql_dep = "SELECT b.`code`,b.`detail`,b.`amount`,b.`price`,b.`yprice`,b.`nprice` 
		FROM ( 
			SELECT `row_id` 
			FROM `depart` 
			WHERE `date` LIKE '$date%' 
			AND `hn` = '$hn' 
			AND ( `price` > 0 AND `status` = 'Y' ) 
		) AS a 
		LEFT JOIN `patdata` AS b ON b.`idno` = a.`row_id` ";
		
		$q_dep = $dbi->query($sql_dep);
		if($q_dep->num_rows > 0){
			while($dep = $q_dep->fetch_assoc()){

				$code = $dep['code'];
				$detail = $dep['detail'];

				$amount = $dep['amount'];
				$price = $dep['price'];
				$yprice = (int) $dep['yprice'];
				$nprice = (int) $dep['nprice'];

				if ($nprice===0) {
					$nprice = '';
				}else{
					$nprice = number_format($nprice, 2);
				}

				if ($yprice===0) {
					$yprice = '';
				}else{
					$yprice = number_format($yprice, 2);
				}

				?>
				<tr>
					<td><?=$hn;?></td>
					<td><?=$ptname;?></td>
					<td><?=$endate;?></td>
					<td><?=$detail;?></td>
					<td align="center"><?=$amount;?></td>
					<td align="right"><?=number_format($price, 2);?></td>
					<td align="right"><?=$yprice;?></td>
					<td align="right"><?=$nprice;?></td>
				</tr>
				<?php
			}
		}
	}
}else{
	echo "ไม่พบข้อมูล";
}
?>
</body>
</html>