<?php
session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if(!authen()) die('กรุณา Loing เพื่อเข้าสู่ระบบอีกครั้ง');

require "header.php";
?>
<div id="no_print" >
	<form name="f1" action="report_diabetes.php" method="post">
		<table  border="0" cellpadding="3" cellspacing="3">
			<tr class="forntsarabun">
				<td  align="right">
					เลือกปีในการค้นหา
					<select name="y_start" class="forntsarabun">
					<?php 
						$Y = date("Y")+543;
						$date = date("Y")+543+5;
						$dates = range(2547,$date);

						foreach($dates as $i){
							
							if(isset($_POST['y_start'])){
								$select = ($i == $_POST['y_start']) ? 'selected' : '' ;
							}else{
								$select = ($i == $Y) ? 'selected' : '' ;
							}
							
							?>
							<option value="<?=$i?>" <?php echo $select; ?>><?=$i;?></option>
							<?php
						}
					?>
					<select>
					<button type="submit">ทำการค้นหา</button>
					<input type="hidden" name="search" value="search">
				</td>
			</tr>
		</table>
	</form>
</div>
<?php

if(isset($_POST['y_start'])){
	$date1 = intval($_POST['y_start']) - 543;
}else{
	$date1 = date('Y');
}

// สร้าง temp สำหรับแสดงผลรายปี (ภายใน 1 ปี จะนับเพียงครั้งเดียว)
$sql_temp = "
CREATE TEMPORARY TABLE diabetes_temp 
( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, dateN DATE NOT NULL, dbbirt DATE NOT NULL, retinal_date DATE NOT NULL, foot_date DATE NOT NULL, tooth_date DATE NOT NULL ) 
SELECT * 
FROM diabetes_clinic 
WHERE dateN LIKE '$date1-%';
";
mysql_query($sql_temp);

// temp สำหรับแสดงผลรายเดือน (ภายใน 1 ปี ผู้ป่วยมาตรวจกี่ครั้งก็จะนับไปตามจำนวนนั้น)
$sql_temp = "
CREATE TEMPORARY TABLE diabetes_history_temp 
( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, dateN DATE NOT NULL, dbbirt DATE NOT NULL  ) 
SELECT * 
FROM diabetes_clinic_history 
WHERE dateN LIKE '$date1-%';
";
mysql_query($sql_temp);

// จำนวนผู้ป่วยทั้งหมดในปีนี้
$query = mysql_query("SELECT COUNT(row_id) AS total FROM diabetes_temp");
$all_user = mysql_fetch_assoc($query);

if(isset($_POST['search']) && $_POST['search'] == 'search'){
	
	// Total user in each month สำหรับแสดงผลรายปี
	$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
FROM diabetes_temp
GROUP BY MONTH(dateN) 
ORDER BY dateN ASC 
";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$user_total_items = array();
	while($item = mysql_fetch_assoc($query)){
		$user_total_items[$item['new_orderdate']] = $item;
	}
	
	// Total user in each month สำหรับแสดงผลรายเดือน
	$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
FROM diabetes_history_temp
GROUP BY MONTH(dateN) 
ORDER BY dateN ASC 
";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$user_total_items2 = array();
	while($item = mysql_fetch_assoc($query)){
		$user_total_items2[$item['new_orderdate']] = $item;
	}
	
	// Set default variable
	$months = array(
		'01' => 'ม.ค.', 
		'02' => 'ก.พ.', 
		'03' => 'มี.ค', 
		'04' => 'เม.ษ.', 
		'05' => 'พ.ค.', 
		'06' => 'มิ.ย.', 
		'07' => 'ก.ค.', 
		'08' => 'ส.ค.', 
		'09' => 'ก.ย.', 
		'10' => 'ต.ค.', 
		'11' => 'พ.ย.', 
		'12' => 'ธ.ค.'
	);
	$key_year = $date1;

	?>
	<style>
		td{ padding: 4px; }
	</style>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<tr>
			<td rowspan="2" align="center" class="forntsarabun"><p>เครื่องชี้วัด</p></td>
			<td rowspan="2" align="center" class="forntsarabun">เป้า</td>
			<!-- <td rowspan="2" align="center" class="forntsarabun">ปี<br><?=($date1+543)?></td> -->
			<td colspan="12" align="center" class="forntsarabun">ปี <?=($date1+543)?></td>
		</tr>
		<tr>
			<td align="center" class="forntsarabun">ม.ค.</td>
			<td align="center" class="forntsarabun">ก.พ.</td>
			<td align="center" class="forntsarabun">มี.ค.</td>
			<td align="center" class="forntsarabun">เม.ย.</td>
			<td align="center" class="forntsarabun">พ.ค.</td>
			<td align="center" class="forntsarabun">มิ.ย.</td>
			<td align="center" class="forntsarabun">ก.ค.</td>
			<td align="center" class="forntsarabun">ส.ค.</td>
			<td align="center" class="forntsarabun">ก.ย.</td>
			<td align="center" class="forntsarabun">ต.ค.</td>
			<td align="center" class="forntsarabun">พ.ย.</td>
			<td align="center" class="forntsarabun">ธ.ค.</td>
		</tr>
		<tr>
			<td class="forntsarabun">1. อัตราผู้ป่วย DM ที่ได้รับการเจาะ HbA1c อย่างน้อย 1 ครั้ง/ปี</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
FROM diabetes_temp
WHERE l_hbalc != ''
GROUP BY MONTH(dateN) 
ORDER BY dateN ASC 
";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_items = array();
			$hba1c_total = 0;
			while($item = mysql_fetch_assoc($query)){
				$hba1c_total += $item['rows'];
				$hba1c_items[$item['new_orderdate']] = $item;
			}
	
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($hba1c_items[$find_key])){
					$pre_row = $hba1c_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $item_row;?></span>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">2. อัตราผู้ป่วย DM ที่ได้รับการเจาะ LDL อย่างน้อย 1 ครั้ง/ปี</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
FROM diabetes_temp
WHERE l_ldl != ''
GROUP BY MONTH(dateN) 
ORDER BY dateN ASC 
";

			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$ldl_items = array();
			$ldl_total = 0;
			while($item = mysql_fetch_assoc($query)){
				$ldl_total += $item['rows'];
				$ldl_items[$item['new_orderdate']] = $item;
			}
	
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($ldl_items[$find_key])){
					$pre_row = $ldl_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $item_row;?></span>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">3. อัตราผู้ป่วย DM ที่ได้รับการตรวจ Micro albuminuria อย่างน้อย 1 ครั้ง/ปี</td>
			<td align="center" class="forntsarabun">&gt;70%</td>
			<!-- <td align="center" class="forntsarabun"><?=$malb_total;?></td> -->
			<?php 
			$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
FROM diabetes_temp
WHERE l_microal != '' OR l_ua != ''
GROUP BY MONTH(dateN) 
ORDER BY dateN ASC 
";

			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$malb_items = array();
			$malb_total = 0;
			while($item = mysql_fetch_assoc($query)){
				$malb_total += $item['rows'];
				$malb_items[$item['new_orderdate']] = $item;
			}
	
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($malb_items[$find_key])){
					$pre_row = $malb_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $item_row;?></span>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">4. อัตราผู้ป่วย DM ที่ได้รับการตรวจจอประสาทตา</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			$date1_th = $date1 + 543;
			// ตรวจจอประสาทตา
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
FROM `diabetes_temp_history` 
WHERE `retinal` != '' OR `retinal_date` != '0000-00-00' AND `retinal_date` LIKE '$date1_th-%'
GROUP BY MONTH( dateN ) 
ORDER BY dateN ASC 
			";
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$retinal_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$retinal_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($retinal_items[$find_key])){
					$pre_row = $retinal_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $pre_row;?></span>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">5. อัตราผู้ป่วย DM ที่ได้รับการตรวจสุขภาพช่องปาก</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// ตรวจจอประสาทตา
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `tooth` = 1 OR `tooth_date` != '0000-00-00' AND `tooth_date` LIKE '$date1_th-%'
GROUP BY MONTH( dateN ) 
ORDER BY dateN ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$tooth_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$tooth_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($tooth_items[$find_key])){
					$pre_row = $tooth_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $pre_row;?></span>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">6. อัตราผู้ป่วย DM ที่ได้รับการตรวจเท้า</td>
			<td align="center" class="forntsarabun">&gt;20%</td>
			<?php 
			
			// ตรวจเท้า
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
FROM `diabetes_temp_history` 
WHERE `foot` != '' OR `foot_date` != '0000-00-00' AND `foot_date` LIKE '$date1_th-%'
GROUP BY MONTH( dateN ) 
ORDER BY dateN ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$foot_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$foot_items[$item['new_daten']] = $item;
			}

			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($foot_items[$find_key])){
					$pre_row = $foot_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $pre_row;?></span>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">7. อัตราผู้ป่วย DM ที่ไม่สูบบุหรี่</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// DM ที่ไม่สูบบุหรี่
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `smork` =  '' OR `smork` = '0'
GROUP BY MONTH( dateN ) 
ORDER BY dateN ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$smoke_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$smoke_items[$item['new_daten']] = $item;
			}
	
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($smoke_items[$find_key])){
					$pre_row = $smoke_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $pre_row;?></span>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">8. อัตราผู้ป่วย DM ที่ได้รับคำแนะนำด้านโภชนาการ</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition คำแนะนำด้านโภชนาการ
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `nutrition` !=  '' AND `nutrition` = 1
GROUP BY MONTH( dateN ) 
ORDER BY dateN ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$nutrition_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$nutrition_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($nutrition_items[$find_key])){
					$pre_row = $nutrition_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span><?php echo $item_row;?></span>
					<?php if( $item_row > 0 ): ?>
					<br><span>(<?php echo $pre_row.'/'.$pre_total; ?>)</span>
					<?php endif; ?>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">9. อัตราผู้ป่วย DM ที่ได้รับความรู้เรื่อง Exercise</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition คำแนะนำด้านอาหารการกิน
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `exercise` !=  '' AND `exercise` = 1
GROUP BY MONTH( dateN ) 
ORDER BY dateN ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$exercise_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$exercise_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($exercise_items[$find_key])){
					$pre_row = $exercise_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span><?php echo $item_row;?></span>
					<?php if( $item_row > 0 ): ?>
					<br><span>(<?php echo $pre_row.'/'.$pre_total; ?>)</span>
					<?php endif; ?>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			10. อัตราผู้ป่วย DM มีระดับ Fasting Blood Glucose อยู่ในเกณฑ์<br>
			( FBG &lt; 130 mg % ในผู้ป่วย DM ปกติ<br>
			FBG &lt; 150 mg % ในผู้ป่วย DM มีภาวะแทรกซ้อน)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `l_bs` != '' AND `l_bs` < 130 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' )
				GROUP BY MONTH( `dateN` )
			UNION ALL
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `l_bs` != '' AND `l_bs` < 150 AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 )  
				GROUP BY MONTH( dateN ) 
			";
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$fbg_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				
				$key = $item['new_daten'];
				$rows = $item['rows'];

				if ( !isset($fbg_items[$key]) ) {
					$fbg_items[$key] = $rows;
				} else {
					$fbg_items[$key] += $rows;
				}
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($fbg_items[$find_key])){
					$pre_row = $fbg_items[$find_key];
					$pre_total = $user_total_items2[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						$item_row = '<a href="diabetes_more.php?type=fbg&year='.$date1.'&month='.$key.'" target="_blank" title="คลิกเพื่อเปิดหน้าต่างใหม่">'.$item_percent.'</a>';
						$item_row .= "<br>($pre_row/$pre_total)";
					}
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			11. อัตราผู้ป่วย DM มีระดับ HbA1c อยู่ในเกณฑ์เหมาะสม<br>
			( HbA1c &lt; 7 % ในผู้ป่วย DM ปกติ<br>
			HbA1c &lt; 8 % ในผู้ป่วย DM มีภาวะแทรกซ้อน)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `l_hbalc` != '' AND `l_hbalc` < 7 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' ) 
				GROUP BY MONTH( dateN ) 
			UNION ALL 
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `l_hbalc` != '' AND `l_hbalc` < 8 AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 )
				GROUP BY MONTH( dateN ) 
			";
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				
				$key = $item['new_daten'];
				$rows = $item['rows'];

				if ( !isset($hba1c_dm_items[$key]) ) {
					$hba1c_dm_items[$key] = $rows;
				} else {
					$hba1c_dm_items[$key] += $rows;
				}
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($hba1c_dm_items[$find_key])){
					$pre_row = $hba1c_dm_items[$find_key];
					$pre_total = $user_total_items2[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						$item_row = '<a href="diabetes_more.php?type=hba1c&year='.$date1.'&month='.$key.'" target="_blank" title="คลิกเพื่อเปิดหน้าต่างใหม่">'.$item_percent.'</a>';
						$item_row .= "<br>($pre_row/$pre_total)";
					}
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			12. อัตราผู้ป่วย DM มีระดับ LDL อยู่ในเกณฑ์เหมาะสม<br>
			( LDL &lt; 100 mg/dl ในผู้ป่วย DM ปกติ<br>
			LDL &lt; 70 mg/dl ในผู้ป่วย DM มีภาวะแทรกซ้อน)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `l_ldl` != '' AND `l_ldl` < 100 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' )
				GROUP BY MONTH( dateN ) 
			UNION ALL 
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `l_ldl` != '' AND `l_ldl` < 70 AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 )
				GROUP BY MONTH( dateN ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				
				$key = $item['new_daten'];
				$rows = $item['rows'];

				if ( !isset($hba1c_dm_items[$key]) ) {
					$hba1c_dm_items[$key] = $rows;
				} else {
					$hba1c_dm_items[$key] += $rows;
				}
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($hba1c_dm_items[$find_key])){
					$pre_row = $hba1c_dm_items[$find_key];
					$pre_total = $user_total_items2[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						$item_row = '<a href="diabetes_more.php?type=ldl&year='.$date1.'&month='.$key.'" target="_blank" title="คลิกเพื่อเปิดหน้าต่างใหม่">'.$item_percent.'</a>';
						$item_row .= "<br>($pre_row/$pre_total)";
					}
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">
			13. อัตราผู้ป่วย DM มีระดับความดันโลหิต อยู่ในเกณฑ์เหมาะสม<br>
			- SBP &lt; 140 mmHg ในผู้ป่วย DM ปกติ<br>
			- DBP &lt; 90 mmHg ในผู้ป่วย DM ปกติ<br>
			- SBP &lt; 130 mmHg ในผู้ป่วย DM ที่มีโปรตีนรั่วในปัสสาวะ<br>
			- DBP &lt; 80 mmHg ในผู้ป่วย DM ที่มีโปรตีนรั่วในปัสสาวะ<br>
			- SBP &lt; 150 mmHg ในผู้ป่วย DM ที่มีภาวะแทรกซ้อนและอายุมากกว่า 60 ปี<br>
			- DBP &lt; 80 mmHg ในผู้ป่วย DM ที่มีภาวะแทรกซ้อนและอายุมากกว่า 60 ปี
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			
			// GET y_start from post
			$year_current = intval($_POST['y_start']).date('-m-d');
			
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten 
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `bp1` != '' AND `bp1` < 140 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' ) 
				GROUP BY MONTH( dateN ) 
			UNION ALL
				SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `bp2` != '' AND `bp2` < 90 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' )
				GROUP BY MONTH( dateN )
			UNION ALL
				SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `bp1` < 130 AND `bp1` != '' AND `l_creatinine` >= 1.30 
				GROUP BY MONTH( dateN )
			UNION ALL
				SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `bp2` < 80 AND `bp2` != '' AND `l_creatinine` >= 1.30 
				GROUP BY MONTH( dateN )
			UNION ALL
				SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `bp1` < 150 AND `bp1` != '' AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60 
				GROUP BY MONTH( dateN )
			UNION ALL
				SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
				FROM `diabetes_clinic_history` 
				WHERE `dateN` LIKE '$date1%' AND `bp2` < 80 AND `bp2` != '' AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60 
				GROUP BY MONTH( dateN )
			";

			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				
				$key = $item['new_daten'];
				$rows = $item['rows'];

				if ( !isset($hba1c_dm_items[$key]) ) {
					$hba1c_dm_items[$key] = $rows;
				} else {
					$hba1c_dm_items[$key] += $rows;
				}
			}

			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($hba1c_dm_items[$find_key])){
					$pre_row = $hba1c_dm_items[$find_key];
					$pre_total = $user_total_items2[$find_key]['rows']; // จำนวนทั้งหมดของเดือน
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						$item_row = '<a href="diabetes_more.php?type=bp&year='.$date1.'&month='.$key.'" target="_blank" title="คลิกเพื่อเปิดหน้าต่างใหม่">'.$item_percent.'</a>';
						$item_row .= "<br>($pre_row/$pre_total)";
					}
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">16. อัตราผู้ป่วย DM ที่สูบบุหรี่</td>
			<td align="center" class="forntsarabun">&lt;20%</td>
			<?php 
			
			// DM ที่สูบบุหรี่
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `smork` !=  '' AND `smork` = '1'
GROUP BY MONTH( dateN ) 
ORDER BY dateN ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$smoke_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$smoke_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($smoke_items[$find_key])){
					$pre_row = $smoke_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $item_row;?></span>
				</td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">21. กลุ่มผู้ป่วย DM ที่ได้รับการตรวจเท้าอย่างน้อย 1 ครั้งและมี HbA1c > 7% ของปีนี้ </td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php
				
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE ( `foot` != '' OR `foot_date` != '0000-00-00' ) AND `foot_date` LIKE '$date1_th-%' AND `l_hbalc` != '' AND `l_hbalc` >=  '7' 
GROUP BY MONTH( dateN ) 
ORDER BY dateN ASC 
			";
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c7_items = array();
			while($item = mysql_fetch_assoc($query)){
				$hba1c7_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($hba1c7_items[$find_key])){
					$pre_row = $hba1c7_items[$find_key]['rows'];
					$pre_total = $foot_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo "$pre_row/$pre_total"; ?>"><?php echo $item_row;?></span>
				</td>
				<?php
			}	
			?>
		</tr>
		<?php 
		/*
		?>
		<tr>
			<td class="forntsarabun">20. ผู้ป่วยกลุ่ม DM ที่เข้า Clinic DM</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// HbA1c ที่มากกว่า 7% และได้รับการตรวจเท้า
			// $sql = "
			// SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			// FROM `diabetes_temp` 
			// WHERE `foot` !=  '' AND `l_hbalc` >= 7
			// GROUP BY MONTH( thidate ) 
			// ";
			// $query = mysql_query($sql) or die( mysql_error($Conn) );
			// $hba1c_foot_items = array();
			// $hba1c_foot_total = $all_user['total'];
			
			// while($item = mysql_fetch_assoc($query)){
				// $hba1c_foot_items[$item['new_daten']] = $item;
			// }
			
			foreach($months AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				// if($hba1c_foot_items[$find_key]){
					// $pre_row = $hba1c_foot_items[$find_key]['rows'];
					// $item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				// }
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">21. ผู้ป่วยกลุ่ม DM ที่มีค่า HbA1c > 7% ได้ตรวจเท้า</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// HbA1c ที่มากกว่า 7% และได้รับการตรวจเท้า
			$sql = "
			SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
			FROM `diabetes_temp` 
			WHERE `foot` !=  '' AND `l_hbalc` >= 7
			GROUP BY MONTH( thidate ) 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_foot_items = array();
			$hba1c_foot_total = $all_user['total'];
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_foot_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				if($hba1c_foot_items[$find_key]){
					$pre_row = $hba1c_foot_items[$find_key]['rows'];
					$item_row = round( ( ( $pre_row / $foot_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php 
		*/
		?>
	</table>

<?php } // End if submit ?>
<?php
require "footer.php";
?>