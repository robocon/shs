<?php
include 'bootstrap.php';

$title = 'จำนวนผู้ป่วยทันตกรรมแยกตามสิทธิ์';
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
	
	$sql = "SELECT COUNT(  `hn` ) AS  `rows`, `ptright` 
	FROM `opday` 
	WHERE  `toborow` LIKE '%EX07%' 
	AND (
		`thidate` >=  '$yStart-10-01' AND  `thidate` <=  '$yearSelect-09-30'
	)
	GROUP BY  `ptright`
	";
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
			foreach( $lists as $key => $list ){
			?>
			<tr>
				<td><?=$list['name'];?></td>
				<td><?=$list['rows'];?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<?php
}

include 'templates/classic/footer.php';