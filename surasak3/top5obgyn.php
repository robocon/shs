<?php
include dirname(__FILE__).'/bootstrap.php';
include dirname(__FILE__).'/templates/classic/header.php';

$th_date = !empty($_POST['year_select']) ? trim($_POST['year_select']) : date('Y') + 543 ;
$doctor_id = isset($_POST['doctor']) ? trim($_POST['doctor']) : false ;

// 14/11/68 พี่หมีไม่คีย์ใบงานเข้ามา ไม่เปิดให้ใช้งาน
?>
<h1>ไม่พบข้อมูล</h1>
<?php
exit;
?>
<style>
	h1{
		font-size: 2em;
		font-weight: bold;
	}
	h2{
		font-size: 1.5em;
		font-weight: bold;
	}
</style>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
				<div class="col width-fill mobile-width-fill no-print">
					<div class="cell">
						<ul class="col nav clear">
							<li class="active"><a href="../nindex.htm">หน้าหลักโปรแกรม SHS</a></li>
						</ul>
					</div>
				</div>
				<div class="col">
					<div class="cell">
						<h3>รายชื่อ Diag แพทย์เรียงตามจำนวนผู้ป่วย</h3>
					</div>
				</div>
				<form action="top5obgyn.php" method="post" class="no-print">
					<div class="col">
						<div class="cell">
							ตั้งแต่ <input type="month" name="year_select" value=""> ถึง <input type="month" name="year_select2" value="">
						</div>
					</div>
					<div class="col">
						<div class="cell">
							<button type="submit">แสดงผล</button>
							<input type="hidden" name="show" value="1">
						</div>
					</div>
				</form>
				<?php
				$show = isset($_POST['show']) ? true : false ;
				if( $show ){ 

					$db = Mysql::load();

					if(empty($_POST['year_select']) OR empty($_POST['year_select'])){
						?><h3>กรุณาเลือกข้อมูลให้ครบถ้วน</h3><?php
						exit;
					}

					$sql = "SELECT `name`,`doctorcode` FROM `doctor` WHERE `row_id` = '$doctor_id';";
					$db->select($sql);
					$doctor = $db->get_item();
					
					// ลบช่องว่างสองช่องให้เหลือช่องเดียว
					list($md, $name, $surname) = explode(' ', str_replace('  ', ' ', $doctor['name']));

					$year_select = ad_to_bc($_POST['year_select'].'-01');
					$year_select2 = ad_to_bc($_POST['year_select2'].'-'.date('t', $_POST['year_select2']));

					if($year_select > $year_select2){
						?><h3>มันจะไปเลือกเดือนย้อนหลังได้ยังไง</h3><?php
						exit;
					}

$sql = "SELECT SUBSTRING(a.`thidate`,1,7) AS `date`,a.`thidate`,a.`hn`,a.`diag`,a.`doctor`,COUNT(a.`icd10`) AS `diag_row`,a.`icd10`,b.`dbirth`,a.`age` AS `opday_age`,
TIMESTAMPDIFF( YEAR, b.`dbirth`, CONCAT( ( YEAR( NOW() ) + 543 ), DATE_FORMAT( NOW(), '-%m-%d' ) ) ) AS `age`,
SUBSTRING(a.`age`, 1, 2) AS `short_age` 
FROM `opday` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE ( a.`thidate` >= '$year_select' AND a.`thidate` <= '$year_select2' ) 
AND a.`an` IS NULL AND a.`doctor` <> '' 
AND ( a.`icd10` IS NOT NULL AND a.`icd10` != '' )
GROUP BY SUBSTRING(a.`thidate`,1,7),a.`doctor`, a.`icd10`
ORDER BY SUBSTRING(a.`thidate`,1,7) ASC, `diag_row` DESC";

					$db->select($sql);
					$items = $db->get_items();
					
					$newItems = array();
					foreach ($items as $item) {
						$key = $item['doctor'];
						$subKey = $item['date'];
						$newItems[$key][$subKey][] = $item;
					}
					
					list($yStart, $mStart) = explode('-', $_POST['year_select']);
					list($yEnd, $mEnd) = explode('-', $_POST['year_select2']);
					?>
					<div style="margin-top: 1em;">&nbsp;</div>
					<h1>ระยะเวลา ตั้งแต่ <?=$def_fullm_th[$mStart].' '.($yStart+543);?> ถึง <?=$def_fullm_th[$mEnd].' '.($yEnd+543);?></h1>
					
					<table>
						<tr valign="top">
							<td width="50%" style="vertical-align:top">

					<h1 style="text-align:center;">ผู้ป่วยนอก</h1>
					<?php 
					foreach ($newItems as $doctor => $itemsInMonth) {
						?>
						<div style="margin-top:1em;">&nbsp;</div>
						<h2>แพทย์ <?=$doctor;?></h2>
							<?php
							foreach ($itemsInMonth as $yearMonth => $items) {

								list($y, $m) = explode('-', $yearMonth);
								?>
								<h3><?=$def_fullm_th[$m];?> <?=$y;?></h3>
								<table>
									<tr>
										<th width="5%">#</th>
										<th width="8%">ICD 10</th>
										<th>Diag</th>
										<th width="8%">จำนวน(คน)</th>
									</tr>
								<?php
								$i = 1;
								foreach ($items as $item) {

									if($item['date']!==$lastMonth){
										$i = 1;
									}
									$lastMonth = $item['date'];
									// หมอวรวิทย์ จะคัดเอาเฉพาะคนที่อายุไม่เกิน 15ปี
									// if( $doctor_id == 20 && $item['short_age'] > 15 ){ continue; }
									?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$item['icd10'];?></td>
										<td><?=$item['diag'];?></td>
										<td><?=$item['diag_row'];?></td>
									</tr>
									<?php 
									$i++;
								} // End each item
								?>
								</table>
								<?php
							}// End each month
							?>
					<?php
					} // End doctor
					?>


							</td>
							<td valign="top" style="vertical-align:top">
					
					<h1 style="text-align:center;">ผู้ป่วยใน</h1>
					<?php

					$sql = "SELECT SUBSTRING(a.`date`,1,7) AS `year_month`,a.`date`,a.`icd10`,a.`diag`,a.`doctor`,CONCAT('out') AS `patient`,COUNT(a.`icd10`) AS `diag_row`,a.`icd10`,
					TIMESTAMPDIFF( YEAR, b.`dbirth`, CONCAT( ( YEAR( NOW() ) + 543 ), DATE_FORMAT( NOW(), '-%m-%d' ) ) )  AS `age`
					FROM `ipcard` AS a 
					LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
					WHERE ( a.`date` >= '$year_select' AND a.`date` <= '$year_select2' ) 
					AND a.`doctor` <> '' 
					AND ( a.`icd10` IS NOT NULL AND a.`icd10` != '' )
					GROUP BY SUBSTRING(a.`date`,1,7),a.`doctor`, a.`icd10`
					ORDER BY SUBSTRING(a.`date`,1,7) ASC, COUNT(a.`icd10`) DESC";
					$db->select($sql);
					$items = $db->get_items();
					$newItems2 = array();
					foreach ($items as $item) {
						$key = $item['doctor'];
						$subKey = $item['year_month'];
						$newItems2[$key][$subKey][] = $item;
					}


					foreach ($newItems2 as $doctor => $itemsInMonth) {
						?>
						<div style="margin-top:1em;">&nbsp;</div>
						<h2>แพทย์ <?=$doctor;?></h2>
						<?php
						foreach ($itemsInMonth as $yearMonth => $items) {
							list($y, $m) = explode('-', $yearMonth);
							?>
							<h3><?=$def_fullm_th[$m];?> <?=$y;?></h3>
							<table>
								<tr>
									<th width="5%">#</th>
									<th width="8%">ICD 10</th>
									<th>Diag</th>
									<th width="8%">จำนวน(คน)</th>
								</tr>
								<?php
								$i = 1;
								foreach ($items as $key => $item) {
									?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$item['icd10'];?></td>
										<td><?=$item['diag'];?></td>
										<td><?=$item['diag_row'];?></td>
									</tr>
									<?php
									$i++;
								}
							?>
							</table>
						<?php
						}
					}
					?>



							</td>
						</tr>
					</table>
					
					
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php
include dirname(__FILE__).'/templates/classic/footer.php';