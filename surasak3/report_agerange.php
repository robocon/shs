<?php
	
include 'bootstrap.php';
$db = Mysql::load();


$months = array( '01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.' );
				
?>

<html>
	<head>
		
	</head>
	<body>
		<style>
		@media print{
			#no-print{
				display: none;
			}
		}
		body{
			font-size:12px;
		}
		table{
			border-left: 1px solid #aaaaaa;
			border-top: 1px solid #aaaaaa;
			width: 100%;
			border-collapse: collapse;
		}
		th, td{
			border-right: 1px solid #aaaaaa;
			border-bottom: 1px solid #aaaaaa;
			padding: 0.3em;
			margin: 0;
			font-size:12px;
		}
		.percent{
			font-size: 14px;
			color: #838383;
		}
	</style>
		<div id="no-print">
			<h1>รายงานผู้ป่วยนอกแบ่งตามสิทธิ์และช่วงอายุ</h1>
			<form action="report_agerange.php" method="post">
				<span>เลือกปี</span>
				<select name="year">
					<option value="2555">2555</option>
					<option value="2556">2556</option>
					<option value="2557">2557</option>
					<option value="2558">2558</option>
					<option value="2559">2559</option>
				</select>
				<span>เลือกเดือน</span>
				<select name="month">
					<?php
						foreach ($months as $key => $value) {
							?>
							<option value="<?php echo $key;?>"><?php echo $value;?></option>
							<?php
						}
					?>
					
				</select>
				<button type="submit">แสดงผลรายงาน</button>
			</form>
		</div>
		<div>
			<?php
			$select_month = isset($_POST['month']) ? $_POST['month'] : false ;
			$select_year = isset($_POST['year']) ? $_POST['year'] : false ;
			
			if( $select_month !== false && $select_year !== false ){
					
				
				$sql = "SELECT `hn`,`thidate`,`ptright`,`age` FROM `opday` WHERE `thidate` LIKE '$select_year-$select_month%'";
				$db->select($sql);
				$all_items = $db->get_items();
				$all_rows = $db->get_rows();
				
				if( $all_rows === 0 ){
					echo 'ไม่มีข้อมูลผู้ป่วยในช่วงปี และ เดือนที่ท่านค้นหา กรุณาเลือกข้อมูลใหม่';
					exit;
				}
				
				$r03_items = array();
				$r03_rows = 0;
				
				$r07_items = array();
				$r07_rows = 0;
				
				$mixed_items = array();
				$mixed_rows = 0;
				
				$r33_items = array();
				$r33_rows = 0;
				
				$newborn_items = array();
				$newborn_rows = 0;
				
				$teenage_items = array();
				$teenage_rows = 0;
				
				$oldman_itmes = array();
				$oldman_rows = 0;
				
				$older_items = array();
				$older_rows = 0;
				
				
				foreach($all_items as $item){
					
					list($thidate, $thitime) = explode(' ', $item['thidate']);
					list($y,$m,$d) = explode('-', $thidate);
					$set_key = $thidate;
					
					// แยกตามสิทธิ
					if(preg_match('/เบิกจ่ายตรง/', $item['ptright'])){
						$r03_items[$set_key][] = $item;
						$r03_rows++;
					}
					
					if(preg_match('/ประกันสังคม/', $item['ptright'])){
						$r07_items[$set_key][] = $item;
						$r07_rows++;
					}
					
					if(preg_match('/(ประกันสุขภาพ)|(โครงการตา)/', $item['ptright'])){
						$mixed_items[$set_key][] = $item;
						$mixed_rows++;
					}
					
					if(preg_match('/อปท/', $item['ptright'])){
						$r33_items[$set_key][] = $item;
						$r33_rows++;
					}
					
					// แยกตามช่วงอายุ
					$match = preg_match('/(\d+).+/', $item['age'], $matchs);
					if( $match ){
						
						if( $matchs['1'] < 10 ){
							$newborn_items[$set_key][] = $item;
							$newborn_rows++;
							
						}else if( $matchs['1'] >= 10 && $matchs['1'] < 20 ){
							$teenage_items[$set_key][] = $item;
							$teenage_rows++;
							
						}else if( $matchs['1'] >= 20 && $matchs['1'] < 60 ){
							$oldman_itmes[$set_key][] = $item;
							$oldman_rows++;
							
						}else{
							$older_items[$set_key][] = $item;
							$older_rows++;
						}
						
					}
					
				}
				
				// หาวันสุดท้ายของเดือน
				$time_stamp = strtotime(($select_year - 543)."-$select_month-01");
				$last_day_of_month = date('t', $time_stamp);
				
				// สร้างวันที่ 1 ไปจนถึงวันสุดท้ายของเดือน
				$days = array();
				for($i=1; $i<=$last_day_of_month; $i++){
					if(strlen($i) == 1){
						$i = "0$i";
					}
					$days[] = (string) $i;
				}
				
				$row_days = count($days);
				
			?>
			<table>
				<thead>
					<tr>
						<th rowspan="2">ตัวชี้วัด</th>
						<th rowspan="2" width="8%">จำนวนผู้ป่วยทั้งหมด(คน)</th>
						<th colspan="<?php echo $row_days;?>">ประจำเดือน <?php echo $months[$select_month];?> แบ่งตามวัน(คน)</th>
					</tr>
					<tr>
					<?php
						foreach($days as $day){
							?>
							<th><?php echo intval($day);?></th>
							<?php
						}
					?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>สิทธิจ่ายตรง</td>
						<td align="center"><?php echo $r03_rows;?></td>
						<?php
						foreach($days as $day){
							$find_key = "$select_year-$select_month-$day";
							$per_day = count($r03_items[$find_key]);
							?>
							<td align="right"><?php echo $per_day;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>สิทธิประกันสังคม</td>
						<td align="center"><?php echo $r07_rows;?></td>
						<?php
						foreach($days as $day){
							$find_key = "$select_year-$select_month-$day";
							$per_day = count($r07_items[$find_key]);
							?>
							<td align="right"><?php echo $per_day;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>สิทธิ 30 บาท</td>
						<td align="center"><?php echo $mixed_rows;?></td>
						<?php
						foreach($days as $day){
							$find_key = "$select_year-$select_month-$day";
							$per_day = count($mixed_items[$find_key]);
							?>
							<td align="right"><?php echo $per_day;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>สิทธิอปท.</td>
						<td align="center"><?php echo $r33_rows;?></td>
						<?php
						foreach($days as $day){
							$find_key = "$select_year-$select_month-$day";
							$per_day = count($r33_items[$find_key]);
							?>
							<td align="right"><?php echo $per_day;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>ช่วงอายุน้อยกว่า 10ปี</td>
						<td align="center"><?php echo $newborn_rows;?></td>
						<?php
						foreach($days as $day){
							$find_key = "$select_year-$select_month-$day";
							$per_day = count($newborn_items[$find_key]);
							?>
							<td align="right"><?php echo $per_day;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>ช่วงอายุระหว่าง 10ปี ถึง 20ปี</td>
						<td align="center"><?php echo $teenage_rows;?></td>
						<?php
						foreach($days as $day){
							$find_key = "$select_year-$select_month-$day";
							$per_day = count($teenage_items[$find_key]);
							?>
							<td align="right"><?php echo $per_day;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>ช่วงอายุระหว่าง 20ปี ถึง 60ปี</td>
						<td align="center"><?php echo $oldman_rows;?></td>
						<?php
						foreach($days as $day){
							$find_key = "$select_year-$select_month-$day";
							$per_day = count($oldman_itmes[$find_key]);
							?>
							<td align="right"><?php echo $per_day;?></td>
							<?php
						}
						?>
					</tr>
					<tr>
						<td>ช่วงอายุมากกว่า 60ปี</td>
						<td align="center"><?php echo $older_rows;?></td>
						<?php
						foreach($days as $day){
							$find_key = "$select_year-$select_month-$day";
							$per_day = count($older_items[$find_key]);
							?>
							<td align="right"><?php echo $per_day;?></td>
							<?php
						}
						?>
					</tr>
				</tbody>
			</table>
			<button onclick="force_print()">สั่ง Print</button>
			<script type="text/javascript">
			function force_print(){ window.print(); }
			</script>
			<?php } ?>
		</div>
	</body>
</html>