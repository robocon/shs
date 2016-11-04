<?php
include 'bootstrap.php';

include 'templates/classic/header.php';
include 'templates/classic/nav.php';

// DB::load();

$db = Mysql::load();

$default_date = ad_to_bc(date('Y-m'));
$date = input('date', $default_date);
?>
<style type="text/css">
	@media print{
		table, 
		table th, 
		table td{
			border: 0;
		}
	}
</style>
<div class="cell">
	<div class="col">
		<h3>รายชื่อผู้ป่วยในค้างคืนบัตรเรียงตามวันที่</h3>
	</div>
</div>
<div class="cell no-print">
	<div class="col">
		<form action="ipdcardno.php" method="post">
			<div class="cell">
				<div class="col">
					เลือกวันที่ <input type="text" name="date" value="<?=$date;?>">
				</div>
			</div>
			<div class="cell">
				<div class="col">
					<button type="submit">แสดงข้อมูล</button>
					<input type="hidden" name="action" value="show">
				</div>
			</div>
		</form>
	</div>
</div>
<?php
$action = input_post('action');
if( $action === 'show' ){
	?>
	<div class="cell">
		<div class="col">
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>วันที่</th>
						<th>HN</th>
						<th>AN</th>
						<th>ผู้ยืม</th>
						<th>สถานะการยืม</th>
						<th>สถานะ</th>
					</tr>
				</thead>
				<tbody>
					<?php 

					// test format yyyy-mm-dd
					$day_match = preg_match('/\d+\-\d+\-\d+/', $date);
					if ( $day_match > 0 ) {
						$date_checker = $date;
						list($y, $m, $d) = explode('-', $date);
						$date = $y.'-'.$m;
						
					}

					$sql = "SELECT a.*, SUBSTRING(a.`date`, 1, 10) as `date_key`, c.`hn`, 
					CONCAT((SUBSTRING(a.`date`, 1, 4) - 543), SUBSTRING(a.`date`, 5, 15)) AS `en_date`
					FROM `dcstatus` AS a , 
					(
						SELECT `an`, MAX(`date`) AS `date`
						FROM `dcstatus` 
						WHERE `date` LIKE '$date%' 
						GROUP BY `an`
						ORDER BY `date` DESC
					) AS b ,
					`ipcard` AS c 
					WHERE b.`date` = a.`date` 
					AND b.`an` = a.`an` 
					AND c.`an` = b.`an`";
					
					$db->select($sql);
					$items = $db->get_items();
					$i = 1;
					foreach($items as $key => $item){

						$en_date = strtotime($item['en_date']);
						$tothai_date = date('d/m/', $en_date).( date('Y', $en_date) + 543 ).' '.date('H:i:s', $en_date);
						// ถ้าคีย์มาเป็นวันที่มันจะ skip วันอื่นไปทำให้แสดงเฉพาะวันที่เราใส่วันที่เท่านั้น
						if( $day_match > 0 && $item['date_key'] !== $date_checker ){
							continue;
						}
					?>
					<tr>
						<td><?=$i;?></td>
						<td><?=$tothai_date;?></td>
						<td><?=$item['hn'];?></td>
						<td><?=$item['an'];?></td>
						<td><?=$item['office'];?></td>
						<td>
							<?php
							$status_txt = trim($item['status']);
							list($status, $ect_txt) = explode(' ', $status_txt);
							
							echo ( $status == 'ทะเบียนการแพทย์' ) ? 'Y' : 'N' ;
							?>
						</td>
						<td>
							<?php
							// var_dump($status_txt);
							?>
							<?=$status;?>
						</td>
					</tr>
					<?php 
					$i++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
}