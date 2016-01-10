<?php session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if(!authen()) die('หมดระยะเวลาการใช้งาน <a href="login.php">คลิกที่นี่</a> เพื่อเข้าสู่ระบบอีกครั้ง');

require "header.php";
?>
<div><h3>สถิติ HT</h3></div>
<div id="no_print" >
	<form name="f1" action="report_hypertension.php" method="post">
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
							<?php 						}
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

// temp สำหรับแสดงผลรายเดือน (ภายใน 1 ปี ผู้ป่วยมาตรวจกี่ครั้งก็จะนับไปตามจำนวนนั้น)
$sql_temp = "
CREATE TEMPORARY TABLE hyper_temp 
( thidate DATE NOT NULL ) 
SELECT * 
FROM hypertension_history 
WHERE thidate >= '$date1-01' AND thidate <= '$date1-12';
";
mysql_query($sql_temp);

/*
// จำนวนผู้ป่วยทั้งหมดที่เข้าเคส
$sql = "
SELECT COUNT(id) AS total 
FROM hyper_temp
WHERE (`bp1` != '' OR `bp2` != '') 
AND (
	( bp1 <130 AND bp2 <80 AND (joint_disease_dm = 'Y' OR joint_disease_nephritic = 'Y' OR joint_disease_myocardial = 'Y' OR joint_disease_paralysis = 'Y') )
	OR
	( bp1 < 140 AND bp2 < 90 AND (joint_disease_dm = '' AND joint_disease_nephritic = '' AND joint_disease_myocardial = '' AND joint_disease_paralysis = '') )
)
";
$query = mysql_query($sql);
$test = mysql_fetch_assoc($query);
*/

// จำนวนผู้ป่วย HT ทั้งหมดที่ไม่สนใจเคสต่างๆ
$sql = "
SELECT COUNT(`hn`) AS `rows`, DATE_FORMAT( `thidate`, '%Y-%m' ) AS `thidate`
FROM hyper_temp
GROUP BY MONTH(`thidate`)
";
$q = mysql_query($sql);
$all_year = array();
while($item = mysql_fetch_assoc($q)){
	$all_year[$item['thidate']] = $item['rows'];
}


if(isset($_POST['search']) && $_POST['search'] == 'search'){
    
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
			<td>1. มีโรคร่วมค่าความดันโลหิต &lt; 130/80 mmHg.</td>
			<td></td>
			<?php 			$sql = "
			SELECT COUNT( hn ) AS rows,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `thidate`,`bp1`,`bp2`
FROM hyper_temp
WHERE (`bp1` != '' OR `bp2` != '') AND bp1 <130 
AND bp2 <80 
AND (joint_disease_dm = 'Y' OR joint_disease_nephritic = 'Y' OR joint_disease_myocardial = 'Y' OR joint_disease_paralysis = 'Y')
GROUP BY MONTH( thidate );
			";
			$q = mysql_query($sql);
			$lists = array();
			$in_month = array();
			while($item = mysql_fetch_assoc($q)){
				$lists[$item['thidate']] = $item['rows'];
				$in_month[$item['thidate']] = $item['rows'];
			}
			
			foreach($months AS $key => $value){
				$key_search = "$date1-$key";
				
				$real_val = '';
				if( !is_null($lists[$key_search]) ){
					$real_val = $lists[$key_search];
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo ""; ?>"><?php echo $real_val;?></span>
				</td>
				<?php 			}
			?>
		<tr/>
		<tr>
			<td>2. ไม่มีโรคร่วมค่าความดันโลหิต &lt; 140/90 mmHg.</td>
			<td></td>
			<?php 			$sql = "
			SELECT COUNT( hn ) AS rows,DATE_FORMAT( `thidate`, '%Y-%m' ) AS `thidate`,`bp1`,`bp2`
FROM hyper_temp
WHERE (`bp1` != '' OR `bp2` != '') AND bp1 < 140 
AND bp2 < 90 
AND (joint_disease_dm = '' AND joint_disease_nephritic = '' AND joint_disease_myocardial = '' AND joint_disease_paralysis = '')
GROUP BY MONTH( thidate );
			";
			$q = mysql_query($sql);
			$lists = array();
			while($item = mysql_fetch_assoc($q)){
				$lists[$item['thidate']] = $item['rows'];
				$in_month[$item['thidate']] += $item['rows'];
			}
			
			foreach($months AS $key => $value){
				$key_search = "$date1-$key";
				
				$real_val = '';
				if( !is_null($lists[$key_search]) ){
					$real_val = $lists[$key_search];
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo ""; ?>"><?php echo $real_val;?></span>
				</td>
				<?php 			}
			?>
		<tr/>
		<tr>
			<td>จำนวนผู้ป่วยที่เข้าเคสในแต่ละเดือน</td>
			<td></td>
			<?php 			
			foreach($months AS $key => $value){
				$key_search = "$date1-$key";
				
				$real_val = '';
				if( !is_null($in_month[$key_search]) ){
					$real_val = $in_month[$key_search];
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo ""; ?>"><?php echo $real_val;?></span>
				</td>
				<?php 			}
			?>
		</tr>
		<tr>
			<td>จำนวนผู้ป่วย HT ในแต่ละเดือน</td>
			<td></td>
			<?php 			
			foreach($months AS $key => $value){
				$key_search = "$date1-$key";
				
				$real_val = '';
				if( !is_null($all_year[$key_search]) ){
					$real_val = $all_year[$key_search];
				}
				?>
				<td align="center" class="forntsarabun">
					<span title="<?php echo ""; ?>"><?php echo $real_val;?></span>
				</td>
				<?php 			}
			?>
		</tr>
	</table>
<?php } // End if submit ?>
<?php require "footer.php";
?>