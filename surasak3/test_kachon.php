<?php
include 'bootstrap.php';

include 'templates/classic/header.php';

$doctors = array('MD101' => 'ขชล รวมทรัพย์', 'MD041' => 'วรวิทย์ วงษ์มณี');
?>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
				<h3></h3>
				<form action="">
					<div class="col">
						<div class="cell">
							ปี-เดือน <input type="text" name="year_select" value="">
						</div>
					</div>
					<div class="col">
						<div class="cell">
							เลือกแพทย์ <select name="doctor" id="">
								<?php foreach($doctors as $key => $item){ ?>
								<option value="<?=$key;?>"><?=$item;?></option>
								<option value="<?=$key;?>"><?=$item;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col">
						<div class="cell">
							<button type="submit">แสดงผล</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

	
<?php
$test = null;
if( $test !== null){

	$sql = "
	SELECT `thidate`,`hn`,`diag`,`doctor`,CONCAT('111'),COUNT(`diag`) AS `diag_row`
	FROM `opday`
	WHERE `thidate` LIKE '2558%' AND ( `doctor` LIKE '%MD101%' OR `doctor` LIKE '%ว.38212%' ) AND ( `diag` IS NOT NULL AND `diag` NOT LIKE '' )
	GROUP BY `diag`
	
	UNION ALL
	
	SELECT `date`,`hn`,`diag`,`doctor`,CONCAT('222'),COUNT(`diag`) AS `diag_row`
	FROM `ipcard`
	WHERE `date` LIKE '2558%' AND ( `doctor` LIKE '%MD101%' OR `doctor` LIKE '%ว.38212%' ) AND ( `diag` IS NOT NULL AND `diag` NOT LIKE '' )
	GROUP BY `diag`
	
	ORDER BY `diag_row` DESC
	LIMIT 0,15
	";
	
	DB::select($sql);
}





include 'templates/classic/footer.php';