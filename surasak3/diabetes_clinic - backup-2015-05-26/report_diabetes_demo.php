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
					���͡��㹡�ä���
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
					<button type="submit">�ӡ�ä���</button>
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

// �ӹǹ�����·�����㹻չ��
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
	$key_year = $date1;

	?>
	<style>
		td{ padding: 4px; }
	</style>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<tr>
			<td rowspan="2" align="center" class="forntsarabun"><p>����ͧ����Ѵ</p></td>
			<td rowspan="2" align="center" class="forntsarabun">���</td>
			<!-- <td rowspan="2" align="center" class="forntsarabun">��<br><?=($date1+543)?></td> -->
			<td colspan="12" align="center" class="forntsarabun">�� <?=($date1+543)?></td>
		</tr>
		<tr>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
		</tr>
		<tr>
			<td class="forntsarabun">1. �ѵ�Ҽ����� DM ������Ѻ������ HbA1c ���ҧ���� 1 ����/��</td>
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
			<td class="forntsarabun">2. �ѵ�Ҽ����� DM ������Ѻ������ LDL ���ҧ���� 1 ����/��</td>
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
			<td class="forntsarabun">3. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ Micro albuminuria ���ҧ���� 1 ����/��</td>
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
			<td class="forntsarabun">4. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ�ͻ���ҷ��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// ��Ǩ�ͻ���ҷ��
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
			<td class="forntsarabun">5. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ�آ�Ҿ��ͧ�ҡ</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// ��Ǩ�ͻ���ҷ��
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
			<td class="forntsarabun">6. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ���</td>
			<td align="center" class="forntsarabun">&gt;20%</td>
			<?php 
			
			// ��Ǩ���
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
			<td class="forntsarabun">7. �ѵ�Ҽ����� DM �������ٺ������</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// DM �������ٺ������
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
			<td class="forntsarabun">8. �ѵ�Ҽ����� DM ������Ѻ���йӴ�ҹ����ҡ��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition ���йӴ�ҹ����ҡ��
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
			<td class="forntsarabun">9. �ѵ�Ҽ����� DM ������Ѻ�����������ͧ Exercise</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition ���йӴ�ҹ����á�áԹ
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
			10. �ѵ�Ҽ����� DM ���дѺ Fasting Blood Glucose �����ࡳ��<br>
			( FBG &lt; 130 mg % 㹼����� DM ����<br>
			FBG &lt; 150 mg % 㹼����� DM �������á��͹)
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
						$item_row = '<a href="diabetes_more.php?type=fbg&year='.$date1.'&month='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
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
			11. �ѵ�Ҽ����� DM ���дѺ HbA1c �����ࡳ���������<br>
			( HbA1c &lt; 7 % 㹼����� DM ����<br>
			HbA1c &lt; 8 % 㹼����� DM �������á��͹)
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
						$item_row = '<a href="diabetes_more.php?type=hba1c&year='.$date1.'&month='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
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
			12. �ѵ�Ҽ����� DM ���дѺ LDL �����ࡳ���������<br>
			( LDL &lt; 100 mg/dl 㹼����� DM ����<br>
			LDL &lt; 70 mg/dl 㹼����� DM �������á��͹)
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
						$item_row = '<a href="diabetes_more.php?type=ldl&year='.$date1.'&month='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
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
			13. �ѵ�Ҽ����� DM ���дѺ�����ѹ���Ե �����ࡳ���������<br>
			- SBP &lt; 140 mmHg 㹼����� DM ����<br>
			- DBP &lt; 90 mmHg 㹼����� DM ����<br>
			- SBP &lt; 130 mmHg 㹼����� DM ������õչ����㹻������<br>
			- DBP &lt; 80 mmHg 㹼����� DM ������õչ����㹻������<br>
			- SBP &lt; 150 mmHg 㹼����� DM ����������á��͹��������ҡ���� 60 ��<br>
			- DBP &lt; 80 mmHg 㹼����� DM ����������á��͹��������ҡ���� 60 ��
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
						$item_row = '<a href="diabetes_more.php?type=bp&year='.$date1.'&month='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
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
			<td class="forntsarabun">16. �ѵ�Ҽ����� DM ����ٺ������</td>
			<td align="center" class="forntsarabun">&lt;20%</td>
			<?php 
			
			// DM ����ٺ������
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
			<td class="forntsarabun">20. �����¡���� DM ������ Clinic DM</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// HbA1c ����ҡ���� 7% ������Ѻ��õ�Ǩ���
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
			<td class="forntsarabun">21. �����¡���� DM ����դ�� HbA1c > 7% ���Ǩ���</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// HbA1c ����ҡ���� 7% ������Ѻ��õ�Ǩ���
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