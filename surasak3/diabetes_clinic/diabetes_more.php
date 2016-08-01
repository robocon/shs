<?php session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if(!authen()) die('��س� Loing �����������к��ա����');

// $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
// $year = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_STRING);
// $month = filter_input(INPUT_GET, 'month', FILTER_SANITIZE_STRING);
$type = $_GET['type'];
$year = $_GET['year'];
$month = $_GET['month'];

$datemonth = input_get('datemonth');

if(empty($type) OR empty($datemonth)){
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
	'01' => '�.�.', 
	'02' => '�.�.', 
	'03' => '��.�', 
	'04' => '��.�.', 
	'05' => '�.�.', 
	'06' => '��.�.', 
	'07' => '�.�.', 
	'08' => '�.�.', 
	'09' => '�.�.', 
	'10' => '�.�.', 
	'11' => '�.�.', 
	'12' => '�.�.' 
);

// list($date1, $month) = explode('-', $dm);
// $date1 = date('Y');

// �Ѻ����է�����ҳ
// $year_start = ($date1 - 1)."-$month-01";
// $year_end = "$date1-09-30";

$budget_range = array(
	($date1 - 1).'-10' => '�.�.', 
	($date1 - 1).'-11' => '�.�.', 
	($date1 - 1).'-12' => '�.�.', 
	$date1.'-01' => '�.�.', 
	$date1.'-02' => '�.�.', 
	$date1.'-03' => '��.�', 
	$date1.'-04' => '��.�.', 
	$date1.'-05' => '�.�.', 
	$date1.'-06' => '��.�.', 
	$date1.'-07' => '�.�.', 
	$date1.'-08' => '�.�.', 
	$date1.'-09' => '�.�.'
);



// ���ѹ�ش���¢ͧ��͹
$time_stamp = strtotime("$datemonth-01");
$last_day_of_month = date('t', $time_stamp);
// dump($last_day_of_month);

// ���ҧ�ѹ��� 1 仨��֧�ѹ�ش���¢ͧ��͹
$days = array();
for($i=1; $i<=$last_day_of_month; $i++){
	if(strlen($i) == 1){
		$i = "0$i";
	}
	$days[] = (string) $i;
}
// dump($days);

if( $type == 'fbg' ){
	$web_title = '�ѵ�Ҽ����� DM ���дѺ Fasting Blood Glucose �����ࡳ��';
	
}else if($type == 'hba1c'){
	$web_title = '�ѵ�Ҽ����� DM ���дѺ HbA1c �����ࡳ���������';
	
}else if($type == 'ldl'){
	$web_title = '�ѵ�Ҽ����� DM ���дѺ LDL �����ࡳ���������';
	
}else if($type == 'bp'){
	$web_title = '�ѵ�Ҽ����� DM ���дѺ�����ѹ���Ե�����ࡳ���������';
	
}


include("../connect.inc");

// Create temp for diabetes_clinic only
// $sql_temp = "CREATE TEMPORARY TABLE diabetes_temp 
// ( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dbbirt DATE NOT NULL  ) 
// SELECT *
// FROM diabetes_clinic 
// WHERE thidate LIKE '$year-$month-%';";

// $sql_temp = "CREATE TEMPORARY TABLE IF NOT EXISTS diabetes_temp 
// ( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dateN DATE NOT NULL, dbbirt DATE NOT NULL, retinal_date DATE NOT NULL, foot_date DATE NOT NULL, tooth_date DATE NOT NULL ) 
// SELECT * 
// FROM diabetes_clinic 
// WHERE `dateN` >= '$year_start' 
// AND `dateN` <= '$year_end';";
// dump($sql_temp);
// $query = mysql_query($sql_temp) or die(mysql_error());

$sql_temp = "CREATE TEMPORARY TABLE IF NOT EXISTS diabetes_history_temp 
( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dateN DATE NOT NULL, dbbirt DATE NOT NULL  ) 
SELECT a.* 
FROM `diabetes_clinic_history` AS a 
RIGHT JOIN (
	SELECT MAX(`row_id`) AS `row_id` 
	FROM `diabetes_clinic_history` 
	WHERE `dateN` LIKE '$datemonth%' 
	GROUP BY `dateN`,`hn`
) AS b ON b.`row_id` = a.`row_id`;";
// dump($sql_temp);
mysql_query($sql_temp) or die( mysql_error() );



// �ӹǹ�����·�����㹻չ��
// $sql = "SELECT COUNT(`row_id`) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
// FROM diabetes_history_temp 
// GROUP BY DAY(dateN) 
// ORDER BY dateN ASC;";
// dump($sql); 
// $query = mysql_query($sql);
// $all_user = mysql_fetch_assoc($query);
// dump($all_user);

include 'header.php';

list($date1, $month) = explode('-', $datemonth);
?>
<h3><?=$web_title;?></h3>
<table border="1" cellspacing="0" cellpadding="3" bordercolor="#000000" style="border-collapse:collapse" width="100%">
	<tr>
		<td rowspan="2" align="center">����ͧ����Ѵ</td>
		<td rowspan="2" align="center">���</td>
		<td colspan="<?php echo $last_day_of_month;?>" align="center">�� <?php echo ( $date1 + 543 );?> ��͹ <?php echo $months[$month];?></td>
	</tr>
	<tr>
		<?php 
		foreach($days AS $key => $value){
			?><td align="center"><?php echo (int) $value;?></td><?php 
		}
		?>
	</tr>
	<?php 
	if( $type == 'fbg' ){
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( `dateN`, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `l_bs` < 130 AND `l_bs` != '' AND ( `ht` = '' OR `ht` = 0 ) AND `ht_etc` = ''
		GROUP BY DAY( `dateN` );";

		// $sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
		// FROM `diabetes_history_temp`	
		// WHERE 
		// ( `l_bs` < 130 AND `l_bs` != '' AND ( `ht` = '' OR `ht` = 0 ) AND `ht_etc` = '' )
		// OR (
		// 	`l_bs` < 150 AND `l_bs` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 OR `ht_etc` != '' )
		// ) 
		// GROUP BY MONTH( dateN )
		// ORDER BY dateN ASC";
		// dump($sql);
		$query = mysql_query($sql) or die( mysql_error() );
		$fbg_items = array();
		while($item = mysql_fetch_assoc($query)){
			$fbg_items[$item['new_daten']] = $item;
		}
		// dump($fbg_items);
		?>
		<tr>
			<td>FBG &lt; 130 mg % 㹼����� DM ����</td>
			<td rowspan="2" align="center">60%</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				// dump($find_key);
				if(isset($fbg_items[$find_key])){
					$item_row = '<b>'.$fbg_items[$find_key]['rows'].'</b>';
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `l_bs` < 150 AND `l_bs` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 OR `ht_etc` != '' )  
		GROUP BY DAY( dateN ) ";
		// dump($sql);
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$fbg_items = array();
		while($item = mysql_fetch_assoc($query)){
			$fbg_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>FBG &lt; 150 mg % 㹼����� DM �������á��͹</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($fbg_items[$find_key])){
					$item_row = '<b>'.$fbg_items[$find_key]['rows'].'</b>';
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 	
	}else if( $type == 'hba1c' ){
		
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `l_hbalc` < 7 AND `l_hbalc` > 0 AND ( `ht` = 0 OR `ht` = '' ) AND `ht_etc` = ''
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$hba1c_items = array();
		while($item = mysql_fetch_assoc($query)){
			$hba1c_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>HbA1c &lt; 7% 㹼����»���</td>
			<td rowspan="2" align="center">60%</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($hba1c_items[$find_key])){
					$item_row = $hba1c_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `l_hbalc` < 8 AND `l_hbalc` > 0 AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 OR `ht_etc` != '' )
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$hba1c_items = array();
		while($item = mysql_fetch_assoc($query)){
			$hba1c_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>HbA1c &lt; 8% 㹼����� DM ����������á��͹</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($hba1c_items[$find_key])){
					$item_row = $hba1c_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		}else if( $type =='ldl' ){

		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `l_ldl` != '' AND `l_ldl` < 100 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' )
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$ldl_items = array();
		while($item = mysql_fetch_assoc($query)){
			$ldl_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>LDL &lt; 100 mg/dl 㹼����� DM ����</td>
			<td rowspan="2" align="center">60%</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($ldl_items[$find_key])){
					$item_row = $ldl_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `l_ldl` != '' AND `l_ldl` < 70 AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 )
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$ldl_items = array();
		while($item = mysql_fetch_assoc($query)){
			$ldl_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>LDL &lt; 70 mg/dl 㹼����� DM �������á��͹</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($ldl_items[$find_key])){
					$item_row = $ldl_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 	
		}else if( $type =='bp' ){

		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `bp1` != '' AND `bp1` < 140 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' )
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>SBP &lt; 140 mmHg 㹼����� DM ����</td>
			<td rowspan="6" align="center">60%</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				$find_key = "$year-$month-$value";
				if(isset($bp_items[$find_key])){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `bp2` != '' AND `bp2` < 90 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' )
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>DBP &lt; 90 mmHg 㹼����� DM ����</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($bp_items[$find_key])){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `bp1` < 130 AND `bp1` != '' AND `l_creatinine` >= 1.30
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>SBP &lt; 130 mmHg 㹼����� DM ������õչ����㹻������</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($bp_items[$find_key])){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `bp2` < 80 AND `bp2` != '' AND `l_creatinine` >= 1.30
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>DBP &lt; 80 mmHg 㹼����� DM ������õչ����㹻������</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($bp_items[$find_key])){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		
		// GET y_start from post
		$year_current = $th_year.date('-m-d');
			
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `bp1` < 150 
		AND `bp1` != '' 
		AND `ht_etc` != '' 
		AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 ) 
		AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>SBP &lt; 150 mmHg 㹼����� DM ����������á��͹��������ҡ���� 60 ��</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($bp_items[$find_key])){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 
		$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m-%d' ) AS new_daten
		FROM `diabetes_history_temp` 
		WHERE `bp2` < 80 
		AND `bp2` != '' 
		AND `ht_etc` != '' 
		AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 ) 
		AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60
		GROUP BY DAY( dateN ) ";
		$query = mysql_query($sql) or die( mysql_error($Conn) );
		$bp_items = array();
		while($item = mysql_fetch_assoc($query)){
			$bp_items[$item['new_daten']] = $item;
		}
		?>
		<tr>
			<td>DBP &lt; 80 mmHg 㹼����� DM ����������á��͹��������ҡ���� 60 ��</td>
			<?php 
			foreach($days AS $key => $value){
				$item_row = 0;
				// $find_key = "$year-$month-$value";
				$find_key = "$datemonth-$value";
				if(isset($bp_items[$find_key])){
					$item_row = $bp_items[$find_key]['rows'];
				}
				?>
				<td align="right"><?php echo $item_row;?></td>
				<?php 
			}
			?>
		</tr>
		<?php 	}
	?>
</table>