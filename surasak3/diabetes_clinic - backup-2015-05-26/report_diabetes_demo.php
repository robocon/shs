<?php
session_start();
include("../connect.inc");
require "header.php";
?>
<div id="no_print" >
	<form name="f1" action="report_diabetes_demo.php" method="post">
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

echo "<pre>";

// Build a temp
$sql_temp = "
CREATE TEMPORARY TABLE hn_merge 
SELECT a.hn, b.orderdate, b.profilecode, a.smork, a.retinal
FROM diabetes_clinic AS a, resulthead AS b 
WHERE a.hn = b.hn 
AND b.orderdate LIKE '$date1-%';
";
// var_dump($sql_temp);
$query_temp = mysql_query($sql_temp);


// Create temp for diabetes_clinic only
$sql_temp = "
CREATE TEMPORARY TABLE diabetes_temp 
( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dbbirt DATE NOT NULL  ) 
SELECT *
FROM diabetes_clinic 
WHERE thidate LIKE '$date1-%';
";
// var_dump($sql_temp);
mysql_query($sql_temp);

// จำนวนผู้ป่วยทั้งหมดในปีนี้
$query = mysql_query("SELECT COUNT(row_id) AS total FROM diabetes_temp");
$all_user = mysql_fetch_assoc($query);
	


if(isset($_POST['search']) && $_POST['search'] == 'search'){
	
	// Testing new code
	// echo "<pre>";
	// $test_time = microtime(true);
	
	// Total user in each month
	$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_orderdate
FROM diabetes_temp
GROUP BY MONTH(thidate) 
ORDER BY thidate ASC 
";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$user_total_items = array();
	while($item = mysql_fetch_assoc($query)){
		$user_total_items[$item['new_orderdate']] = $item;
	}
	
	

	
	
	
	
	// MALB
	
	
	
	
	
	// var_dump(microtime(true) - $test_time);
	// Ending new code
	
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
SELECT COUNT(hn) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_orderdate
FROM diabetes_temp
WHERE l_hbalc != ''
GROUP BY MONTH(thidate) 
ORDER BY thidate ASC 
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
				if($hba1c_items[$find_key]){
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
SELECT COUNT(hn) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_orderdate
FROM diabetes_temp
WHERE l_ldl != ''
GROUP BY MONTH(thidate) 
ORDER BY thidate ASC 
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
				if($ldl_items[$find_key]){
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
			
			// $sql = "
// SELECT COUNT(hn) AS rows, DATE_FORMAT( orderdate, '%Y-%m' ) AS new_orderdate
// FROM hn_merge
// WHERE profilecode = 'MALB'
// GROUP BY MONTH(orderdate) 
// ORDER BY orderdate ASC 
// ";

			$sql = "
SELECT COUNT(hn) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_orderdate
FROM diabetes_temp
WHERE l_microal != ''
GROUP BY MONTH(thidate) 
ORDER BY thidate ASC 
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
				if($malb_items[$find_key]){
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
			
			// ตรวจจอประสาทตา
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `retinal` !=  '' OR `retinal_date` != '0000-00-00'
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
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
				if($retinal_items[$find_key]){
					$pre_row = $retinal_items[$find_key]['rows'];
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
			<td class="forntsarabun">5. อัตราผู้ป่วย DM ที่ได้รับการตรวจสุขภาพช่องปาก</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// ตรวจจอประสาทตา
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `tooth` =  '1' OR `tooth_date` != '0000-00-00'
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
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
				if($tooth_items[$find_key]){
					$pre_row = $tooth_items[$find_key]['rows'];
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
			<td class="forntsarabun">6. อัตราผู้ป่วย DM ที่ได้รับการตรวจเท้า</td>
			<td align="center" class="forntsarabun">&gt;20%</td>
			<?php 
			
			// ตรวจเท้า
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `foot` !=  '' AND `foot` != '-'
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
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
				if($foot_items[$find_key]){
					$pre_row = $foot_items[$find_key]['rows'];
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
			<td class="forntsarabun">7. อัตราผู้ป่วย DM ที่ไม่สูบบุหรี่</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// DM ที่ไม่สูบบุหรี่
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `smork` =  '' OR `smork` = '0'
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
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
				if($smoke_items[$find_key]){
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
			<td class="forntsarabun">8. อัตราผู้ป่วย DM ที่ได้รับคำแนะนำด้านโภชนาการ</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition คำแนะนำด้านโภชนาการ
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `nutrition` !=  '' AND `nutrition` = 1
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
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
				if($nutrition_items[$find_key]){
					$pre_row = $nutrition_items[$find_key]['rows'];
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
			<td class="forntsarabun">9. อัตราผู้ป่วย DM ที่ได้รับความรู้เรื่อง Exercise</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition คำแนะนำด้านอาหารการกิน
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `exercise` !=  '' AND `exercise` = 1
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
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
				if($exercise_items[$find_key]){
					$pre_row = $exercise_items[$find_key]['rows'];
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
			<td class="forntsarabun">
			10. อัตราผู้ป่วย DM มีระดับ Fasting Blood Glucose อยู่ในเกณฑ์<br>
			( FBG &lt; 130 mg % ในผู้ป่วย DM ปกติ<br>
			FBG &lt; 150 mg % ในผู้ป่วย DM มีภาวะแทรกซ้อน)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE ( `l_bs` < 130 AND ( `ht` = '' OR `ht` = 0 ) ) 
OR (
	`l_bs` < 150 AND `l_bs` != '' AND ( `ht_etc` != '' OR `ht` = 1 OR `ht` = 3 ) 
)
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$fbg_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$fbg_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if($fbg_items[$find_key]){
					$pre_row = $fbg_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
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
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE (`l_hbalc` <  7 AND `l_hbalc` > 0 AND ( `ht` = 0 OR `ht` = '' ) )
OR (
	`l_hbalc` < 8 AND `l_hbalc` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) 
) 
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
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
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE ( `l_ldl` <  100 AND `l_ldl` > 0 AND ( `ht` = 0 OR `ht` = '' ) )
OR (
	`l_ldl` < 70 AND `l_ldl` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' )
)
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
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
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE ( `bp1` < 140 AND `bp1` > 0 AND ( `ht` = '' OR `ht` = 0 ) )
OR ( `bp2` < 90 AND `bp2` > 0 AND ( `ht` = '' OR `ht` = 0 ) )
OR ( `bp1` < 130 AND `bp1` > 0 AND `l_creatinine` >= 1.30 )
OR ( `bp2` < 80 AND `bp2` > 0 AND `l_creatinine` >= 1.30 )
OR (
	`bp1` < 150 AND `bp1` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
)
OR (
	`bp2` < 80 AND `bp2` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
)
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
			";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
			}
			
			foreach($months AS $key => $value){
				$item_row = 0;
				$find_key = "$key_year-$key";
				
				$pre_row = 0;
				$pre_total = 0;
				if($hba1c_dm_items[$find_key]){
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
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
SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
FROM `diabetes_temp` 
WHERE `smork` !=  '' AND `smork` = '1'
GROUP BY MONTH( thidate ) 
ORDER BY thidate ASC 
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
				if($smoke_items[$find_key]){
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