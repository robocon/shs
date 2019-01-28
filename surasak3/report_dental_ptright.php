<?php
include 'bootstrap.php';

include 'templates/classic/header.php';

// Default year checkup
$checkup = get_year_checkup(true);
$show = input_post('show_result');
$yearSelect = input_post('year_select', $checkup);
?>
<div class="cell no-print">
	<div class="col">
		<ul class="nav">
			<li><a href="../nindex.htm">หน้าหลักโปรแกรม SHS</a></li>
		</ul>
	</div>
</div>
<div class="cell">
	<div class="col">
		<h3>จำนวนผู้ป่วยทันตกรรมแยกตามสิทธิ์ ปี <?=$yearSelect;?></h3>
	</div>
</div>
<div class="cell">
	<div class="col">
		<form action="report_dental_ptright.php" method="post" class="no-print">
			<div class="cell">
				<div class="col">
					<label for="yearSelect">
						เลือกปีงบประมาณ <input type="text" id="yearSelect" name="year_select" value="<?=$yearSelect;?>">
						<div style="font-size:16px; color: red;">หากต้องการเลือกเป็นเดือนให้ใส่รูปแบบ YYYY-MM เช่น 2562-01 เป็นต้น</div>
					</label>
				</div>
			</div>
			<div class="cell">
				<div class="col">
					<button type="submit">แสดงผล</button>
					<input type="hidden" name="show_result" value="show">
				</div>
			</div>
		</form>
	</div>
</div>
	
<?php

if( $show == 'show' ){
	
	DB::load();
	$yStart = $yearSelect - 1;

	$test_match = preg_match('(\d{4}\-\d{2})',$yearSelect, $matchs);
	$where = "`thidate` >=  '$yStart-10-01 00:00:00' AND  `thidate` <=  '$yearSelect-09-30 23:59:59' ";
	if( $test_match > 0 ){
		$where = "`thidate` LIKE '$yearSelect%'";
	}
	
	$sql = "SELECT COUNT(  `hn` ) AS  `rows`, `ptright` 
	FROM `opday` 
	WHERE  `toborow` LIKE '%EX07%' 
	AND (
		$where
	)
	GROUP BY  `ptright`";

	$items = DB::select($sql);
	$lists = array();
	foreach( $items as $key => $item ){
		
		$ptright = str_replace(array(" ","\xA0","\xFF"), ' ', trim($item['ptright']));
		$ptright = str_replace("  ", ' ', $ptright);
		
		$key = hash('md5', $ptright);
		if( !$lists[$key] ){
			$lists[$key] = array(
				'name' => $ptright,
				'rows' => $item['rows']
			);
		}else{
			$lists[$key]['rows'] = ( $lists[$key]['rows'] + $item['rows'] );
		}
		
	}
	
	?>
	<table>
		<thead>
			<tr>
				<th>สิทธิ์</th>
				<th>จำนวน(คน)</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$total = 0;
			foreach( $lists as $key => $list ){ 

				$total += (int) $list['rows'];
			?>
			<tr>
				<td><?=$list['name'];?></td>
				<td align="right"><?=$list['rows'];?></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td align="center">ยอดรวม</td>
				<td align="right"><?=$total;?></td>
			</tr>
		</tbody>
	</table>
	<?php
}

include 'templates/classic/footer.php';