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
				<div><h3>ระบบแสดงราชื่อผู้ป่วยที่ใช้ยา Warfarin</h3></div>
				<div class="col">
					<div class="width-2of5">
						เลือกปีแสดงผล: 
					</div>
					<div>
						<select name="year" id="year">
							<option value="2556">2556</option>
							<option value="2557">2557</option>
							<option value="2558" selected="selected">2558</option>
						</select>
					</div>
				</div>
				<div class="col">
					<div class="width-2of5"></div>
					<div>
						<button type="submit">ค้นหา</button>
						<input type="hidden" name="search" value="search">
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	DB::load();
	if( $search ){
	?>
	<div class="col">
		<div class="cell">
			<div class="col">
				<h3>รายชื่อผู้ป่วยที่ใช้ยา Warfarin ปี <?php echo $year; ?></h3>
			</div>
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>ชื่อยา</th>
						<th>วันที่หมอจ่ายยา</th>
						<th>HN</th>
						<th>ชื่อผู้ป่วย</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$sql = "
					SELECT b.`drugcode`,b.`tradname`,b.`hn`,b.`date` AS `doctor_date`,c.`yot`,c.`name`,c.`surname`
					FROM 
					`ddrugrx` AS b  
					LEFT JOIN `opcard` AS c ON c.`hn` = b.`hn`
					LEFT JOIN `dphardep` AS a ON a.`date` = b.`date`
					WHERE b.`drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
					AND a.`dr_cancle` IS NULL 
					AND b.`date` LIKE :year_select 
					ORDER BY b.`date` ASC
					";
					
					$items = DB::select($sql, array(
						':year_select' => "$year%"
					));
					
					$i = 1;
					foreach ($items as $key => $item) {
						$drug_code = trim($item['drugcode']);
					?>
					<tr>
						<td align="center"><?php echo $i;?></td>
						<td><?php echo $item['tradname']; ?></td>
						<td><?php echo $item['doctor_date']; ?></td>
						<td><?php echo $item['hn']; ?></td>
						<td><?php echo $item['yot'].' '.$item['name'].' '.$item['surname'];?></td>
					</tr>
					<?php $i++; ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php } ?>
</div>
<?php
include 'templates/classic/footer.php';