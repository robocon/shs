<?php 
session_start();
// require "../connect.php";
// require "../includes/functions.php";

include '../bootstrap.php';
$db = Mysql::load();


// Verify user before load content
if( authen() === false ){ die('Session ������� <a href="../login_page.php">��ԡ�����</a> ���ͷӡ���������к��ա����'); }

require "header.php";
?>
<div id="no_print" >
	<form name="f1" action="report_diabetes.php" method="post">
		<table  border="0" cellpadding="3" cellspacing="3">
			<tr class="forntsarabun">
				<td align="left">
					<h3>ʶԵ� DM</h3>
					<div>
						���͡��㹡�ä���
						<select name="y_start" class="forntsarabun">
						<?php 
							$Y = date("Y")+543;
							$date = date("Y")+543+2;
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
					</div>
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

// �Ѻ����է�����ҳ
$year_start = ($date1 - 1)."-10-01";
$year_end = "$date1-09-30";

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

// ���ҧ temp ����Ѻ�ʴ�����»� (���� 1 �� �йѺ��§��������)
$sql_temp = "CREATE TEMPORARY TABLE IF NOT EXISTS diabetes_temp 
#( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dateN DATE NOT NULL, dbbirt DATE NOT NULL, retinal_date DATE NOT NULL, foot_date DATE NOT NULL, tooth_date DATE NOT NULL ) 
SELECT * 
FROM diabetes_clinic 
WHERE `dateN` >= '$year_start' 
AND `dateN` <= '$year_end';";

// dump($sql_temp);
// echo "<hr>";


// $con=mysqli_connect("localhost","root","1234","smdb");
// Check connection
// if (mysqli_connect_errno())
// {
// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
// }

// $sql = "CALL testDiabetesPro('2018-10-01','2019-09-30');";

// Execute multi query
// if (mysqli_multi_query($con,$sql))
// {
// 	do
// 	{
// 		// Store first result set
// 		if ($result=mysqli_store_result($con)) {
// 			// Fetch one and one row
// 			while ($row=mysqli_fetch_assoc($result))
// 			{
// 				// printf("%s\n",$row);
// 				dump($row);
// 			}
// 			// Free result set
// 			mysqli_free_result($result);
// 		}
// 	}
// 	while (mysqli_next_result($con));
// }

// $db->select($sql);

// $items = $db->get_items();
// dump($items);


// $db_temp = mysql_query($sql_temp) or die( mysql_error() );
// dump($db_temp);
// exit;

// temp ����Ѻ�ʴ��������͹ (���� 1 �� �������ҵ�Ǩ�����駡�йѺ仵���ӹǹ���)
// $sql_temp = "CREATE TEMPORARY TABLE diabetes_history_temp 
// ( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dateN DATE NOT NULL, dbbirt DATE NOT NULL  ) 
// SELECT * 
// FROM `diabetes_clinic_history` 
// WHERE `dateN` >= '$year_start' 
// AND `dateN` <= '$year_end' 
// ORDER BY `dateN`, `hn`
// ;";
// dump($sql_temp);

$sql_temp = "CREATE TEMPORARY TABLE diabetes_history_temp 
#( l_hbalc FLOAT NOT NULL, l_creatinine FLOAT NOT NULL, thidate DATE NOT NULL, dateN DATE NOT NULL, dbbirt DATE NOT NULL  ) 
SELECT a.* 
FROM `diabetes_clinic_history` AS a 
RIGHT JOIN (
	SELECT MAX(`row_id`) AS `row_id` 
	FROM `diabetes_clinic_history` 
	WHERE `dateN` >= '$year_start' 
	AND `dateN` <= '$year_end' 
	GROUP BY `dateN`,`hn`
) AS b ON b.`row_id` = a.`row_id`";

// dump($sql_temp);
// echo "<hr>";

mysql_query($sql_temp);

// �ӹǹ�����·�����㹻չ��
$query = mysql_query("SELECT COUNT(`row_id`) AS total FROM diabetes_clinic_history");
$all_user = mysql_fetch_assoc($query);

if(isset($_POST['search']) && $_POST['search'] == 'search'){
	
	// Total user in each month ����Ѻ�ʴ�����»�
	$sql = "SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
	FROM diabetes_history_temp
	GROUP BY MONTH(dateN) 
	ORDER BY dateN ASC";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$user_total_items = array();
	while($item = mysql_fetch_assoc($query)){
		$user_total_items[$item['new_orderdate']] = $item;
	}
	
	// Total user in each month ����Ѻ�ʴ��������͹
	$sql = "SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
	FROM diabetes_history_temp
	GROUP BY MONTH(dateN) 
	ORDER BY dateN ASC ";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$user_total_items2 = array();
	while($item = mysql_fetch_assoc($query)){
		$user_total_items2[$item['new_orderdate']] = $item;
	}
	// dump($user_total_items2);
	
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
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">��.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
			<td align="center" class="forntsarabun">�.�.</td>
		</tr>
		<tr>
			<td class="forntsarabun">1. �ѵ�Ҽ����� DM ������Ѻ������ HbA1c ���ҧ���� 1 ����/��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			$sql = "SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
			FROM diabetes_history_temp
			WHERE l_hbalc != ''
			GROUP BY MONTH(dateN) 
			ORDER BY dateN ASC ";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_items = array();
			$hba1c_total = 0;
			while($item = mysql_fetch_assoc($query)){
				$hba1c_total += $item['rows'];
				$hba1c_items[$item['new_orderdate']] = $item;
			}
	
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
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
			<td class="forntsarabun">2. �ѵ�Ҽ����� DM ������Ѻ������ LDL ���ҧ���� 1 ����/��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			$sql = "SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
			FROM diabetes_history_temp
			WHERE l_ldl != ''
			GROUP BY MONTH(dateN) 
			ORDER BY dateN ASC ";

			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$ldl_items = array();
			$ldl_total = 0;
			while($item = mysql_fetch_assoc($query)){
				$ldl_total += $item['rows'];
				$ldl_items[$item['new_orderdate']] = $item;
			}
	
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
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
			<td class="forntsarabun">3. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ Micro albuminuria ���ҧ���� 1 ����/��</td>
			<td align="center" class="forntsarabun">&gt;70%</td>
			<!-- <td align="center" class="forntsarabun"><?=$malb_total;?></td> -->
			<?php 
			$sql = "SELECT COUNT(hn) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_orderdate
			FROM diabetes_history_temp
			WHERE l_microal != '' OR l_ua != '' OR l_urine != '' 
			GROUP BY MONTH(dateN) 
			ORDER BY dateN ASC ";

			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$malb_items = array();
			$malb_total = 0;
			while($item = mysql_fetch_assoc($query)){
				$malb_total += $item['rows'];
				$malb_items[$item['new_orderdate']] = $item;
			}
	
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
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
			<td class="forntsarabun">4. �ѵ�Ҽ����� DM ������Ѻ��õ�Ǩ�ͻ���ҷ��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			$date1_th = $date1 + 543;
			// ��Ǩ�ͻ���ҷ��
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `retinal_date` != '0000-00-00 00:00:00' 
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			// dump($sql);
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$retinal_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$retinal_items[$item['new_daten']] = $item;
			}

			// dump($retinal_items);
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				// $find_key_th = ad_to_bc($find_key); // �ŧ�� �.�.
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($retinal_items[$find_key])){
					$pre_row = $retinal_items[$find_key]['rows'];
					// $pre_total = $user_total_items[$find_key]['rows'];
					// $item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span><?php echo $pre_row;?></span>
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
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `tooth_date` != '0000-00-00 00:00:00' 
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$tooth_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$tooth_items[$item['new_daten']] = $item;
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				// $find_key_th = ad_to_bc("$key_year-$key"); // �ŧ�� �.�.
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($tooth_items[$find_key])){
					$pre_row = $tooth_items[$find_key]['rows'];
					// $pre_total = $user_total_items[$find_key]['rows'];
					// $item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span><?php echo $pre_row;?></span>
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
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `foot_date` != '0000-00-00 00:00:00' 
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$foot_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$foot_items[$item['new_daten']] = $item;
			}

			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				// $find_key_th = ad_to_bc("$key_year-$key"); // �ŧ�� �.�.
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($foot_items[$find_key])){
					$pre_row = $foot_items[$find_key]['rows'];
					// $pre_total = $user_total_items[$find_key]['rows'];
					// $item_row = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
				}
				?>
				<td align="center" class="forntsarabun">
					<span><?php echo $pre_row;?></span>
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
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `smork` =  '' OR `smork` = '0'
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$smoke_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$smoke_items[$item['new_daten']] = $item;
			}
	
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
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
				<?php 			}
			?>
		</tr>
		<tr>
			<td class="forntsarabun">8. �ѵ�Ҽ����� DM ������Ѻ���йӴ�ҹ����ҡ��</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition ���йӴ�ҹ����ҡ��
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `date_nutrition` != '0000-00-00 00:00:00' 
			AND `nutrition` = '1'
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$nutrition_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$nutrition_items[$item['new_daten']] = $item;
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
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
			<td class="forntsarabun">9. �ѵ�Ҽ����� DM ������Ѻ�����������ͧ Exercise</td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 
			
			// Nutrition ���йӴ�ҹ����á�áԹ
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `exercise` !=  '' AND `exercise` = 1
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$exercise_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$exercise_items[$item['new_daten']] = $item;
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
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
			10. �ѵ�Ҽ����� DM ���дѺ Fasting Blood Glucose �����ࡳ��<br>
			( FBG &lt; 130 mg % 㹼����� DM ����<br>
			FBG &lt; 150 mg % 㹼����� DM �������á��͹)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp`	
			WHERE 
			( `l_bs` < 130 AND `l_bs` != '' AND ( `ht` = '' OR `ht` = 0 ) AND `ht_etc` = '' )
			OR (
				`l_bs` < 150 AND `l_bs` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 OR `ht_etc` != '' )
			) 
			GROUP BY MONTH( dateN )
			ORDER BY dateN ASC";
			// dump($sql);
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$fbg_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$fbg_items[$item['new_daten']] = $item;
				
				// $key = $item['new_daten'];
				// $rows = $item['rows'];

				// if ( !isset($fbg_items[$key]) ) {
				// 	$fbg_items[$key] = $rows;
				// } else {
				// 	$fbg_items[$key] += $rows;
				// }
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($fbg_items[$find_key])){
					
					// Old code
					$pre_row = $fbg_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					
					// $pre_row = $fbg_items[$find_key];
					// $pre_total = $user_total_items2[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						$item_row = '<a href="diabetes_more.php?type=fbg&datemonth='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
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
			// $sql = "
			// SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `l_hbalc` != '' AND `l_hbalc` < 7 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' ) 
			// 	GROUP BY MONTH( dateN ) 
			// UNION ALL 
			// SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `l_hbalc` != '' AND `l_hbalc` < 8 AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 )
			// 	GROUP BY MONTH( dateN ) 
			// ";
			
			
			
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten 
			FROM `diabetes_history_temp` 
			WHERE 
			( `l_hbalc` < 7 AND `l_hbalc` > 0 AND ( `ht` = 0 OR `ht` = '' ) AND `ht_etc` = '' ) 
			OR 
			( `l_hbalc` < 8 AND `l_hbalc` > 0 AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 OR `ht_etc` != '' ) ) 
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC";
			// dump($sql);
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$hba1c_dm_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$hba1c_dm_items[$item['new_daten']] = $item;
				
				// $key = $item['new_daten'];
				// $rows = $item['rows'];

				// if ( !isset($hba1c_dm_items[$key]) ) {
				// 	$hba1c_dm_items[$key] = $rows;
				// } else {
				// 	$hba1c_dm_items[$key] += $rows;
				// }
			}
			// echo "<pre>";
			// var_dump($hba1c_dm_items);
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				// var_dump($find_key);
				$find_key = $key;

				$pre_row = 0;
				$pre_total = 0;
				if(isset($hba1c_dm_items[$find_key])){
					
					$pre_row = $hba1c_dm_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					
					// $pre_row = $hba1c_dm_items[$find_key];
					// $pre_total = $user_total_items2[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						$item_row = '<a href="diabetes_more.php?type=hba1c&datemonth='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
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
			<td>
				�ѵ�Ҽ����� DM ���дѺ HbA1c �����ࡳ��������� ( HbA1c &lt; 7 % )
			</td>
			<td>
				<?php
				$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten 
				FROM `diabetes_history_temp` 
				WHERE `l_hbalc` < 7 AND `l_hbalc` > 0 
				GROUP BY MONTH( dateN ) 
				ORDER BY dateN ASC";
				// dump($sql);

				$query = mysql_query($sql) or die( mysql_error($Conn) );
				$hba1c_dm_items = array();
				
				while($item = mysql_fetch_assoc($query)){
					$hba1c_dm_items[$item['new_daten']] = $item;
				}

				foreach($budget_range AS $key => $value){
					$item_row = 0;
					$find_key = $key;

					$pre_row = 0;
					$pre_total = 0;
					if(isset($hba1c_dm_items[$find_key])){
						
						$pre_row = $hba1c_dm_items[$find_key]['rows'];
						$pre_total = $user_total_items[$find_key]['rows'];
						
						$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
						
						if($item_percent > 0){
							$item_row = $item_percent;
							$item_row .= "<br>($pre_row/$pre_total)";
						}
					}
					?>
					<td align="center" class="forntsarabun"><?php echo $item_row;?></td>
					<?php 
				}
				?>
			</td>
		</tr>
		<tr>
			<td class="forntsarabun">
			12. �ѵ�Ҽ����� DM ���дѺ LDL �����ࡳ���������<br>
			( LDL &lt; 100 mg/dl 㹼����� DM ����<br>
			LDL &lt; 70 mg/dl 㹼����� DM �������á��͹)
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			// $sql = "
			// SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `l_ldl` != '' AND `l_ldl` < 100 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' )
			// 	GROUP BY MONTH( dateN ) 
			// UNION ALL 
			// SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `l_ldl` != '' AND `l_ldl` < 70 AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 )
			// 	GROUP BY MONTH( dateN ) 
			// ";
			
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp`	
			WHERE 
			( `l_ldl` < 100 AND `l_ldl` > 0 AND ( `ht` = 0 OR `ht` = '' ) AND `ht_etc` = '' )
			OR
			( `l_ldl` < 70 AND `l_ldl` > 0 AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 OR `ht_etc` != '' ) )
			GROUP BY MONTH( dateN )
			ORDER BY dateN ASC";
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$ldl_dm_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$ldl_dm_items[$item['new_daten']] = $item;
			}

			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($ldl_dm_items[$find_key])){
					
					$pre_row = $ldl_dm_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					
					// $pre_row = $ldl_dm_items[$find_key];
					// $pre_total = $user_total_items2[$find_key]['rows'];
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						$item_row = '<a href="diabetes_more.php?type=ldl&datemonth='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
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
			
			// $sql = "
			// SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten 
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `bp1` != '' AND `bp1` < 140 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' ) 
			// 	GROUP BY MONTH( dateN ) 
			// UNION ALL
			// 	SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `bp2` != '' AND `bp2` < 90 AND `ht_etc` = '' AND ( `ht` = 0 OR `ht` = '' )
			// 	GROUP BY MONTH( dateN )
			// UNION ALL
			// 	SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `bp1` < 130 AND `bp1` != '' AND `l_creatinine` >= 1.30 
			// 	GROUP BY MONTH( dateN )
			// UNION ALL
			// 	SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `bp2` < 80 AND `bp2` != '' AND `l_creatinine` >= 1.30 
			// 	GROUP BY MONTH( dateN )
			// UNION ALL
			// 	SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `bp1` < 150 AND `bp1` != '' AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60 
			// 	GROUP BY MONTH( dateN )
			// UNION ALL
			// 	SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			// 	FROM `diabetes_clinic_history` 
			// 	WHERE `dateN` LIKE '$date1%' AND `bp2` < 80 AND `bp2` != '' AND `ht_etc` != '' AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 ) AND TIMESTAMPDIFF( YEAR, dbbirt, '$year_current' ) > 60 
			// 	GROUP BY MONTH( dateN )
			// ";
			
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp`
			WHERE 
			( `bp1` < 140 AND `bp1` > 0 AND ( `ht` = 0 OR `ht` = '' ) AND `ht_etc` = '' )
			OR 
			( `bp2` < 90 AND `bp2` > 0 AND ( `ht` = 0 OR `ht` = '' ) AND `ht_etc` = '' )
			OR
			( `bp1` < 130 AND `bp1` > 0 AND `l_urine` > 150 )
			OR
			( `bp2` < 80 AND `bp2` > 0 AND `l_urine` > 150 )
			OR
			( `bp1` < 150 AND `bp1` > 0 AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, `dbbirt`, '$year_current' ) > 60 )
			OR
			( `bp2` < 80 AND `bp2` > 0 AND ( `ht` = 1 OR `ht` = 2 OR `ht` = 3 OR `ht_etc` != '' ) AND TIMESTAMPDIFF( YEAR, `dbbirt`, '$year_current' ) > 60 )
			GROUP BY MONTH( dateN )
			ORDER BY dateN ASC";

			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$number13_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$number13_items[$item['new_daten']] = $item;
				
				// $key = $item['new_daten'];
				// $rows = $item['rows'];

				// if ( !isset($hba1c_dm_items[$key]) ) {
				// 	$hba1c_dm_items[$key] = $rows;
				// } else {
				// 	$hba1c_dm_items[$key] += $rows;
				// }
			}

			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;

				$pre_row = 0;
				$pre_total = 0;
				if(isset($number13_items[$find_key])){
					
					$pre_row = $number13_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					
					// $pre_row = $hba1c_dm_items[$find_key];
					// $pre_total = $user_total_items2[$find_key]['rows']; // �ӹǹ�������ͧ��͹
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						$item_row = '<a href="diabetes_more.php?type=bp&datemonth='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
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
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `smork` !=  '' AND `smork` = '1'
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$smoke_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$smoke_items[$item['new_daten']] = $item;
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
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
			<td class="forntsarabun">21. ����������� DM ������Ѻ��õ�Ǩ������ҧ���� 1 ��������� HbA1c > 7% �ͧ�չ�� </td>
			<td align="center" class="forntsarabun">&gt;80%</td>
			<?php 				
// 				SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( thidate, '%Y-%m' ) AS new_daten
// FROM `diabetes_history_temp` 
// WHERE `foot` != '' OR `foot_date` != '0000-00-00' AND `foot_date` LIKE '$date1_th-%'
// GROUP BY MONTH( thidate ) 
// ORDER BY thidate ASC 
				
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE ( `foot` != '' OR `foot_date` != '0000-00-00' ) 
			AND `foot_date` LIKE '$date1_th-%' 
			AND `l_hbalc` > 0 
			AND `l_hbalc` >=  '7' 
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$number21_items = array();
			while($item = mysql_fetch_assoc($query)){
				$number21_items[$item['new_daten']] = $item;
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				// $find_key = "$key_year-$key";
				$find_key = $key;
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($number21_items[$find_key])){
					$pre_row = $number21_items[$find_key]['rows'];
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
				<?php 			}
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
				<?php 			}
			?>
		</tr>
		<?php 
		*/
		
		?>
		<tr>
			<td class="forntsarabun">�ѵ�Ҽ����� DM ���дѺ LDL �����ࡳ��������� LDL &lt;70 mg/dl </td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
				
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp`	
			WHERE `l_ldl` < 70 AND `l_ldl` > 0 
			GROUP BY MONTH( dateN )
			ORDER BY dateN ASC";
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$number100_items = array();
			while($item = mysql_fetch_assoc($query)){
				$number100_items[$item['new_daten']] = $item;
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				$find_key = $key;
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($number100_items[$find_key])){
					
					$pre_row = $number100_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];
					
					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						// $item_row = '<a href="diabetes_more.php?type=ldl&datemonth='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
						$item_row = $item_percent;
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
			�ѵ�Ҽ����� DM ���дѺ�����ѹ���Ե �����ࡳ���������<br>
			- SBP &lt; 130 mmHg - DBP &lt; 80 mmHg 
			</td>
			<td align="center" class="forntsarabun">&gt;60%</td>
			<?php 
			
			// GET y_start from post
			$year_current = intval($_POST['y_start']).date('-m-d');
			
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp`
			WHERE 
			( `bp1` < 130 AND `bp1` > 0 )
			AND
			( `bp2` < 80 AND `bp2` > 0 )
			GROUP BY MONTH( dateN )
			ORDER BY dateN ASC";

			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$number101_items = array();
			
			while($item = mysql_fetch_assoc($query)){
				$number101_items[$item['new_daten']] = $item;
			}

			foreach($budget_range AS $key => $value){
				$item_row = 0;

				$find_key = $key;

				$pre_row = 0;
				$pre_total = 0;
				if(isset($number101_items[$find_key])){
					
					$pre_row = $number101_items[$find_key]['rows'];
					$pre_total = $user_total_items[$find_key]['rows'];

					$item_percent = round( ( ( $pre_row / $pre_total ) * 100 ) ,1);
					
					if($item_percent > 0){
						// $item_row = '<a href="diabetes_more.php?type=bp&datemonth='.$key.'" target="_blank" title="��ԡ�����Դ˹�ҵ�ҧ����">'.$item_percent.'</a>';
						$item_row = $item_percent;
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
			<td class="forntsarabun">�ӹǹ����������ҹ�������������ҹ��鹵�</td>
			<td align="center" class="forntsarabun"></td>
			<?php 
			
			// 
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `retinal` <> '' 
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$retinal_items102 = array();
			
			while($item = mysql_fetch_assoc($query)){
				$retinal_items102[$item['new_daten']] = $item;
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				$find_key = $key;
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($retinal_items102[$find_key])){
					$pre_row = $retinal_items102[$find_key]['rows'];
				}
				?>
				<td align="center" class="forntsarabun">
					<span><?php echo $pre_row;?></span>
				</td>
				<?php 
			}
			?>
		</tr>

		<tr>
			<td class="forntsarabun">�ӹǹ�����·���� Diabetic Neuropathy ����Ǩ������ǼԴ����</td>
			<td align="center" class="forntsarabun"></td>
			<?php 
			
			// 
			$sql = "SELECT COUNT( `hn` ) AS rows, DATE_FORMAT( dateN, '%Y-%m' ) AS new_daten
			FROM `diabetes_history_temp` 
			WHERE `retinal` <> '' 
			AND `foot` <> '' 
			GROUP BY MONTH( dateN ) 
			ORDER BY dateN ASC ";
			
			$query = mysql_query($sql) or die( mysql_error($Conn) );
			$retinal_items103 = array();
			
			while($item = mysql_fetch_assoc($query)){
				$retinal_items103[$item['new_daten']] = $item;
			}
			
			foreach($budget_range AS $key => $value){
				$item_row = 0;
				$find_key = $key;
				
				$pre_row = 0;
				$pre_total = 0;
				if(isset($retinal_items103[$find_key])){
					$pre_row = $retinal_items103[$find_key]['rows'];
				}
				?>
				<td align="center" class="forntsarabun">
					<span><?php echo $pre_row;?></span>
				</td>
				<?php 
			}
			?>
		</tr>
	</table>

<?php } // End if submit ?>
<?php require "footer.php";
?>