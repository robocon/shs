<?php session_start();

// $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
// $year = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_STRING);
// $month = filter_input(INPUT_GET, 'month', FILTER_SANITIZE_STRING);
$type = $_GET['type'];
$year = $_GET['year'];
$month = $_GET['month'];

if(empty($type) OR empty($year) OR empty($month)){
	echo 'System require type, year and month :)';
	exit;
}

// Filter for white list
$allow_type = array('fbg','hba1c','ldl','bp');
if(!in_array($type, $allow_type)){
	echo 'Invalid type :(';
	exit;
}

$th_year = intval($year) + 543;
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

// หาวันสุดท้ายของเดือน
$time_stamp = strtotime("$year-$month-01");
$last_day_of_month = date('t', $time_stamp);

// สร้างวันที่ 1 ไปจนถึงวันสุดท้ายของเดือน
$days = array();
for($i=1; $i<=$last_day_of_month; $i++){
	if(strlen($i) == 1){
		$i = "0$i";
	}
	$days[] = (string) $i;
}

if( $type == 'fbg' ){
	$title = 'อัตราผู้ป่วย DM มีระดับ Fasting Blood Glucose อยู่ในเกณฑ์';
	
}else if($type == 'hba1c'){
	$title = 'อัตราผู้ป่วย DM มีระดับ HbA1c อยู่ในเกณฑ์เหมาะสม';
	
}else if($type == 'ldl'){
	$title = 'อัตราผู้ป่วย DM มีระดับ LDL อยู่ในเกณฑ์เหมาะสม';
	
}else if($type == 'bp'){
	$title = 'อัตราผู้ป่วย DM มีระดับความดันโลหิตอยู่ในเกณฑ์เหมาะสม';
	
}


include("../connect.inc");

// Create temp for diabetes_clinic only
$sql_temp = "CREATE TEMPORARY TABLE diabetes_temp 
( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dbbirt DATE NOT NULL  ) 
SELECT *
FROM diabetes_clinic 
WHERE thidate LIKE '$year-$month-%';";
$query = mysql_query($sql_temp) or die(mysql_error($Conn));

// จำนวนผู้ป่วยทั้งหมดในปีนี้
$query = mysql_query("SELECT COUNT(row_id) AS total FROM diabetes_temp");
$all_user = mysql_fetch_assoc($query);

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
		<title><?php echo $title;?></title>
	</head>
	<body>
	</body>
</html>
<style type="text/css">
body{
	padding: 0;
	margin: 0;
	font-family: Arial;
}
td{
	padding: 4px;
}
</style>
<h3><?php echo $title;?></h3>
<table border="1" cellspacing="0" cellpadding="3">
	<tr>
		<td rowspan="2" align="center">เครื่องชี้วัด</td>
		<td rowspan="2" align="center">เป้า</td>
		<td colspan="<?php echo $last_day_of_month;?>" align="center">ปี <?php echo $th_year;?> เดือน <?php echo $months[$month];?></td>
	</tr>
	<tr>
		<?php
		foreach($days AS $key => $value){
			?>
			<td align="center"><?php echo (int) $value;?></td>
			<?php
		}
		?>
	</tr>
	<?php
	if( $type == 'fbg' ){
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `l_bs` < 130 AND ( `ht` = '' OR `ht` = 0 )
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$fbg_items = array();
		while($item = mysql_fetch_assoc($query)){
			$fbg_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>FBG &lt; 130 mg % ในผู้ป่วย DM ปกติ</td>
			<td rowspan="2">60%</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				
				if($fbg_items[$find_key]){
					$item_row = $fbg_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `l_bs` < 150 AND `l_bs` != '' AND ( `ht_etc` != '' OR `ht` = 1 OR `ht` = 3 ) 
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$fbg_items = array();
		while($item = mysql_fetch_assoc($query)){
			$fbg_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>FBG &lt; 150 mg % ในผู้ป่วย DM มีภาวะแทรกซ้อน</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($fbg_items[$find_key]){
					$item_row = $fbg_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php
	
	}else if( $type == 'hba1c' ){
		
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `l_hbalc` <  7 AND `l_hbalc` > 0 AND ( `ht` = 0 OR `ht` = '' )
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$hba1c_items = array();
		while($item = mysql_fetch_assoc($query)){
			$hba1c_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>HbA1c &lt; 7% ในผู้ป่วยปกติ</td>
			<td rowspan="2">60%</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($hba1c_items[$find_key]){
					$item_row = $hba1c_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `l_hbalc` < 8 AND `l_hbalc` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' )
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$hba1c_items = array();
		while($item = mysql_fetch_assoc($query)){
			$hba1c_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>HbA1c &lt; 8% ในผู้ป่วย DM ที่มีภาวะแทรกซ้อน</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($hba1c_items[$find_key]){
					$item_row = $hba1c_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php
	}else if( $type =='ldl' ){
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `l_ldl` <  100 AND `l_ldl` > 0 AND ( `ht` = 0 OR `ht` = '' )
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$ldl_items = array();
		while($item = mysql_fetch_assoc($query)){
			$ldl_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>LDL &lt; 100 mg/dl ในผู้ป่วย DM ปกติ</td>
			<td rowspan="2">60%</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($ldl_items[$find_key]){
					$item_row = $ldl_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `l_ldl` < 70 AND `l_ldl` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' )
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$ldl_items = array();
		while($item = mysql_fetch_assoc($query)){
			$ldl_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>LDL &lt; 70 mg/dl ในผู้ป่วย DM มีภาวะแทรกซ้อน</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($ldl_items[$find_key]){
					$item_row = $ldl_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php
	}else if( $type =='bp' ){
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `bp1` < 140 AND `bp1` > 0 AND ( `ht` = '' OR `ht` = 0 )
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>SBP &lt; 140 mmHg ในผู้ป่วย DM ปกติ</td>
			<td rowspan="6">60%</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($bp_items[$find_key]){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php 
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `bp2` < 90 AND `bp1` > 0 AND ( `ht` = '' OR `ht` = 0 )
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>DBP &lt; 90 mmHg ในผู้ป่วย DM ปกติ</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($bp_items[$find_key]){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php 
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `bp1` < 130 AND `bp1` > 0 AND `l_creatinine` >= 1.30
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>SBP &lt; 130 mmHg ในผู้ป่วย DM ที่มีโปรตีนรั่วในปัสสาวะ</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($bp_items[$find_key]){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php 
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `bp2` < 80 AND `bp2` > 0 AND `l_creatinine` >= 1.30
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>DBP &lt; 80 mmHg ในผู้ป่วย DM ที่มีโปรตีนรั่วในปัสสาวะ</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($bp_items[$find_key]){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php 
		
		// GET y_start from post
		$year_current = $th_year.date('-m-d');
			
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `bp1` < 150 AND `bp1` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>SBP &lt; 150 mmHg ในผู้ป่วย DM ที่มีภาวะแทรกซ้อนและอายุมากกว่า 60 ปี</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($bp_items[$find_key]){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php 
		$sql = "
		SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_temp` 
		WHERE `bp2` < 80 AND `bp2` > 0 AND ( `ht` = 1 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
		GROUP BY DAY( thidate ) 
		";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>DBP &lt; 80 mmHg ในผู้ป่วย DM ที่มีภาวะแทรกซ้อนและอายุมากกว่า 60 ปี</td>
			<?php
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if($bp_items[$find_key]){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td><?php echo $item_row;?></td>
				<?php
			}
			?>
		</tr>
		<?php
	}
	?>
</table>