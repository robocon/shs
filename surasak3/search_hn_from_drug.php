<?php
include 'bootstrap.php';

$search = isset($_REQUEST['search']) ? trim($_REQUEST['search']) : false ;
$year = isset($_REQUEST['year']) ? trim($_REQUEST['year']) : date('Y') + 543 ;

$title = 'ระบบแสดงราชื่อผู้ป่วยที่ใช้ยา Warfarin';
include 'templates/classic/header.php';
include 'templates/classic/nav.php';

?>
<div class="site-center">
	<div class="col" class="no-print">
		<div class="cell">
			<form class="col" action="search_hn_from_drug.php" method="post">
				<div><h3>ระบบแสดงรายชื่อผู้ป่วยที่ใช้ยา Warfarin</h3></div>
				<div class="col">
					<div class="width-2of5">
						เลือกปีแสดงผล: 
						<select name="year" id="year">
							<?php 
							$yearRange = range(2556, (date('Y')+543));
							foreach ($yearRange as $key => $y) { 
								?>
								<option value="<?=$y;?>"><?=$y;?></option>
								<?php
							}
							?>
						</select>
						<button type="submit">ค้นหาตามปี</button>
						<input type="hidden" name="search" value="search">
					</div>
				</div>
				<div class="col">
					<div class="width-2of5"></div>
					<div>
						
					</div>
				</div>
			</form>
		</div>
		<div class="cell">
			<form action="search_hn_from_drug.php" method="post">
				<div class="width-2of5">
					<button type="submit">ค้นหา 6เดือนย้อนหลัง</button>
					<input type="hidden" name="backSixMonths" value="1">
					<input type="hidden" name="search" value="search">
				</div>
			</form>
		</div>
	</div>
	<?php
	// DB::load();
	$db = Mysql::load();
	if( $search ){
	?>
	<div class="col">
		<div class="cell">
			<div class="col">
				<h3>รายชื่อผู้ป่วยที่ใช้ยา Warfarin ปี <?php echo $year; ?> เรียงตามเดือน</h3>
			</div>
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>วันที่หมอจ่ายยา</th>
						<th>HN</th>
						<th>ชื่อผู้ป่วย</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$searchBack = sprintf("%s",$_POST['backSixMonths']);
					if(empty($searchBack)){
						$sql = "SELECT b.`drugcode`,b.`tradname`,b.`hn`,b.`date` AS `doctor_date`,c.`yot`,c.`name`,c.`surname`
						FROM `ddrugrx` AS b  
						LEFT JOIN `opcard` AS c ON c.`hn` = b.`hn`
						LEFT JOIN `dphardep` AS a ON a.`date` = b.`date`
						WHERE b.`drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
						AND a.`dr_cancle` IS NULL 
						AND b.`date` LIKE :year_select 
						ORDER BY b.`date` ASC";
						$db->select($sql, array(':year_select' => "$year%"));
						$items = $db->get_items();
					}else{
						$currentDateTh = (date('Y')+543).date('-m-d 00:00:00');
						$backTime = strtotime("-6 months");
						$lastSixMonthTh = (date('Y', $backTime)+543).date('-m-01 00:00:00', $backTime);
						$sql = "SELECT b.`drugcode`,b.`tradname`,b.`hn`,b.`date` AS `doctor_date`,c.`yot`,c.`name`,c.`surname`
						FROM `ddrugrx` AS b  
						LEFT JOIN `opcard` AS c ON c.`hn` = b.`hn`
						LEFT JOIN `dphardep` AS a ON a.`date` = b.`date`
						WHERE b.`drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
						AND a.`dr_cancle` IS NULL 
						AND b.`date` >= '$lastSixMonthTh' AND b.`date` <= '$currentDateTh' 
						ORDER BY b.`date` ASC";
						$db->select($sql);
						$items = $db->get_items();
					}
					

					$i = 1;
					$count_drugs = array();
					$check_hn = false;

					$group_hn = array();

					foreach ($items as $key => $item) {
						// $drug_code = trim($item['drugcode']);
						
						$trade_key = trim($item['tradname']);
						
						if( !$count_drugs[$trade_key] ){
							$count_drugs[$trade_key] = 1;
						}else{
							$count_drugs[$trade_key] += 1;
						}

						// ข้ามการแสดงผลถ้า hn ซ้ำกับของคนก่อนหน้านี้
						$hn = $item['hn'];

						$full_name = $item['yot'].' '.$item['name'].' '.$item['surname'];
						$group_hn[$hn] = $full_name;

						if( $hn == $check_hn ){
							continue;
						}
						?>
						<tr>
							<td align="center"><?php echo $i;?></td>
							<td><?php echo $item['doctor_date']; ?></td>
							<td><?php echo $hn; ?></td>
							<td><?php echo $full_name;?></td>
						</tr>
						<?php
						$i++;

						// latest memory for checking next loop
						$check_hn = $item['hn'];
					}
					?>
				</tbody>
			</table>
			<div style="margin-top: 1em;">
				<p>จำนวนรวมของยาแต่ละชนิด</p>
				<?php 
				foreach($count_drugs as $key => $item_rows){
					?><p><b><?php echo $key;?></b>: <?php echo $item_rows;?></p><?php
				}
				?>
			</div>
			<div style="margin-top: 1em;">
				<h3>รายชื่อทั้งหมดในปี</h3>
				<table>
				<?php
				$i = 1;
				foreach ($group_hn as $hn => $user) {
					?>
					<tr>
						<td align="right"><?=$i;?></td>
						<td><?=$hn;?></td>
						<td><?=$user;?></td>
					</tr>
					<?php
					$i++;
				}
				?>
				</table>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php
include 'templates/classic/footer.php';