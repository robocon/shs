<?php 

include 'bootstrap.php';

$def_month_th = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');

$title = 'OPD ตา สรุปยอดตามปี';
include 'templates/classic/header.php';

DB::load();

$default_year = ( date('Y') + 543 );
$year = input_post('year', $default_year);
$show = input_post('show');
?>
<style>
	body{
		font-family: 'TH SarabunPSK';
		font-size: 16pt;
	}
</style>

<div class="col nav-menu-col">
	<div class="menu cell">
		<ul class="nav">
			<li><a href="../nindex.htm">หน้าหลักโปรแกรม SHS</a></li>
			<li><a href="eye_from.php">สมุดทะเบียนตา</a></li>
		</ul>
	</div>
</div>

<div class="cell">
	<div class="col">
		<h3>OPD ตา สรุปยอดตามปี</h3>
	</div>
</div>
<form action="report_opdeye.php" method="post" class="no-print">
	<div class="cell">
		<div class="col">
			<label for="year">
				เลือกปีที่ต้องการแสดงผล <input type="text" id="year" class="width-1of24" name="year" value="<?=$year?>">
			</label>
		</div>
	</div>
	<div class="cell">
		<div class="col">
			<button type="submit">แสดงผล</button>
			<input type="hidden" name="show" value="inyear">
		</div>
	</div>
</form>

<?php
$eye_lists = array(
	'No DR' => 'NoDR',
	'Mild NPDR ' => 'Mild',
	'Moderate NPDR' => 'Moderate',
	'Severe NPDR' => 'Severe',
	'PDR' => 'PDR'
);

if( $show === 'inyear' ){
	
	$en_year = bc_to_ad($year);
	$sql = "SELECT `date_eye`,DATE_FORMAT( `date_eye`, '%Y-%m' ) AS `new_date`,`dr`,COUNT(`hn`) AS `rows` FROM `opd_eye` 
WHERE `dr` != '' 
AND `date_eye` LIKE '$en_year%' 
GROUP BY MONTH(`date_eye`), `dr`
ORDER BY `date_eye`";
	$items = DB::select($sql);
	
	$new_items = array();
	foreach( $items as $key => $item ){
		$key = $item['new_date'].'-'.$item['dr'];
		$new_items[$key] = $item;
	}
	
	?>
	<table>
		<thead>
			<tr>
				<th rowspan="2">ผล DR</th>
				<th colspan="13">จำนวนผู้ป่วย ปี <?=$year;?></th>
			</tr>
			<tr>
				<?php
				foreach( $def_month_th as $key => $month){
					?><th><?=$month;?></th><?php
				}
				?>
				<th>รวม</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($eye_lists as $key => $list) {
				?>
				<tr>
					<td><?=$list;?></td>
					<?php
					$ii = 0;
					foreach( $def_month_th as $mKey => $month){
						$find_key = $en_year.'-'.$mKey.'-'.$list;
						?>
						<td>
						<?php
							if( $new_items[$find_key] ){
								$month_total = $new_items[$find_key]['rows'];
								$ii += $month_total;
								?><a href="report_opdeye_details.php?date=<?=($en_year.'-'.$mKey);?>&dr=<?=$list;?>" target="_blank"><?=$month_total;?></a> <?php
							}else{
								echo '-';
							}
						?>
						</td>
						<?php
					}
					?>
					<td><?=$ii;?></td>
				</tr>
				<?php
			}
			?>
			
		</tbody>
	</table>
	<div class="cell no-print">
		<div class="col">
			<button onclick="printTable()">พิมพ์</button>
		</div>
	</div>
	<script type="text/javascript">
		function printTable(){
			window.print();
		}
	</script>
	<?php
}

include 'templates/classic/footer.php';