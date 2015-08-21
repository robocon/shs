<?php 

require 'bootstrap.php';
DB::load();

$sql = "
SELECT YEAR(MIN(`thidate`)) as min_year
FROM `opday` 
WHERE `toborow` LIKE 'EX25%' 
AND `thidate` != '0000-00-00 00:00:00'
";
$prev_year = DB::select($sql, null, true);
$min_year = (int) $prev_year['min_year'];

// Default variable
$this_th_year = (int) ( date('Y') + 543 );
$month_lists = array(
	'01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', 
	'07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
);


include 'templates/default/header.php';

$year = isset($_REQUEST['year']) ? trim($_REQUEST['year']) : false ;
$month = isset($_REQUEST['month']) ? trim($_REQUEST['month']) : false ;
?>

<div class="site-center">
    <div class="site-body panel">
        <div class="body">
            <div class="cell">
				
                <div class="col">
                    <div class="cell">
                        <div class="page-header">
                            <h1>ผู้ป่วยตรวจจักษุ</h1>
                        </div>
                    </div>
                </div>
<div class="col">
	<div class="cell">
		<p>เลือกวันที่ในการแสดงผล</p>
		<form action="report_eye.php" method="post">
			<div class="col">
				<div class="cell">
					เลือกปี
				<select name="year" id="">
					<?php
						for( $this_th_year; $this_th_year >= $min_year; $this_th_year--){
							?><option value="<?php echo $this_th_year ?>"><?php echo $this_th_year ?></option><?php
						}
					?>
				</select>
				เลือกเดือน
				<select name="month" id="">
					<?php
						foreach($month_lists as $key => $month_item){
							?><option value="<?php echo $key; ?>"><?php echo $month_item ?></option><?php
						}
					?>
				</select>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<button type="submit">ตกลง</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="col">
	<div class="cell">
		<?php 
		// Default request
		
		$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;
		
		
		
		if ( $year !== false && $month !== false && $action !== 'fulldetail' ) {
			// 29268 เลข ว. ของหมอ
			$sql = "
			SELECT DATE_FORMAT(`thidate`, '%Y-%m-%d') AS `date`, COUNT(`hn`) AS `count`
			FROM `opday`
			WHERE `thidate` LIKE :date_select  
			AND ( `toborow` LIKE 'EX25%' OR `clinic` LIKE '07%' ) 
			AND (
				`diag` NOT LIKE 'เลื่อนนัด' 
				AND `diag` NOT LIKE 'ไม่มาตามนัด' 
				AND `diag` NOT LIKE 'นัด%' 
				AND `diag` NOT LIKE 'นัดพบ%' 
			) AND `doctor` LIKE '%29268%'
			GROUP BY DATE(`thidate`)
			";
			// dump($sql);
			$items = DB::select( $sql, array(':date_select' => $year.'-'.$month.'%') );
			
			if ( count($items) == 0 ) {
				echo 'เดือนที่เลือกไม่มีรายการผู้ป่วย กรุณาเลือกวันที่ใหม่';
				continue;
			}
			?>
			<table class="outline-header horizontal-border">
				<thead>
					<tr>
						<th width="5%">ลำดับ</th>
						<th>วันที่</th>
						<th>จำนวนผู้ป่วย</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach($items as $item): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td>
							<a href="report_eye.php?action=fulldetail&date=<?php echo $item['date'];?>">
							<?php 
								list($y, $m, $d) = explode('-', $item['date']);
								echo $d.' '.$month_lists[$m].' '.$y; 
							?>
							</a>
						</td>
						<td><?php echo $item['count']; ?></td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			<?php
			
			
			
		} else if( $year === false && $month === false && $action === 'fulldetail' ) {
			$date = isset($_REQUEST['date']) ? trim($_REQUEST['date']) : false ;
			
			$sql = "
			SELECT `hn`,`ptname`,`diag`,`ptright`
			FROM `opday` 
			WHERE `thidate` LIKE :date_select  
			AND ( `toborow` LIKE 'EX25%' OR `clinic` LIKE '07%' ) 
			AND (
				`diag` NOT LIKE 'เลื่อนนัด' 
				AND `diag` NOT LIKE 'ไม่มาตามนัด' 
				AND `diag` NOT LIKE 'นัด%' 
				AND `diag` NOT LIKE 'นัดพบ%' 
			)  AND `doctor` LIKE '%29268%'
			ORDER BY `row_id` ASC 
			";
			// dump($sql);
			// dump($date);
			$items = DB::select( $sql, array(':date_select' => $date.'%') );
			
			if ( count($items) == 0 ) {
				echo 'วันที่เลือก ไม่มีรายการผู้ป่วย กรุณาเลือกวันที่ใหม่';
				continue;
			}
			
			list($y, $m, $d) = explode('-', $date);
			?>
			<h3>รายการผู้ป่วยตรวจจักษุ วันที่ <?php echo $d.' '.$month_lists[$m].' '.$y;?></h3>
			<table class="outline-header horizontal-border">
				<thead>
					<tr>
						<th>ลำดับ</th>
						<th>HN</th>
						<th>ชื่อผู้ป่วย</th>
						<th>สิทธิ์</th>
						<th>Diagnosis</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach($items as $key => $item): ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $item['hn']; ?></td>
						<td><?php echo $item['ptname']; ?></td>
						<td>
						<?php 
							echo !empty($item['ptright']) ? $item['ptright'] : '-' ; 
						?>
						</td>
						<td>
						<?php 
							echo !empty($item['diag']) ? $item['diag'] : '-' ; 
						?>
						</td>
					</tr>
					<?php $i++; ?>
					<?php endforeach;?>
				</tbody>
			</table>
			<?php
		}
		?>
	</div>
</div>
<?php
include 'templates/default/footer.php';
?>