<?php 

include 'bootstrap.php';
?>
<!doctype html>

<html lang="en">
<head>
<meta charset="tis-620">
<title>LAB - รายงานผู้ป่วยนัดเจาะเลือด</title>
<meta name="description" content="LAB - รายงานผู้ป่วยนัดเจาะเลือด">
<meta name="author" content="SHS">

<!--
<link rel="stylesheet" href="css/styles.css?v=1.0">
-->

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>
<!--
<script src="js/scripts.js"></script>
-->
<div id="no-print">
<a href="../nindex.htm">&lt;&lt;&nbsp;กลับไปหน้าหลักโปรแกรม</a>
<h3>เลือกปีเพื่อแสดงรายงาน</h3>
<form action="report_lab_blood.php" method="post">
	<select name="year" id="year">
		<option value="2557">2557</option>
		<option value="2558">2558</option>
		<option value="2559">2559</option>
		<option value="2560">2560</option>
	</select>
	<button>เลือกปี</button>
	<input type="hidden" name="active_year" value="1">
</form>
</div>
<?php 
$active_year = isset($_POST['active_year']) ? intval($_POST['active_year']) : false ;
$year = isset($_POST['year']) ? intval($_POST['year']) : false ;	

if($active_year !== false OR $year !== false){
	
	$months = array( '01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.' );
	$th_months = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	$key_months = array('01','02','03','04','05','06','07','08','09','10','11','12');
	
	$db = Mysql::load();
	$sql = "
	SELECT `hn`,`appdate`,`advice`,`age`
	FROM `appoint`
	WHERE `appdate` LIKE '%$year%' 
	AND ( `detail` LIKE 'FU14%' OR ( `patho` != 'NA' AND `patho` != '' AND `patho` != 'ไม่มี' ) )
	";
	
	$db->select($sql);
	$all_items = $db->get_items();
	$all_rows = $db->get_rows();
	if( $all_rows === 0 ){
		echo "ไม่พบข้อมูล ผู้ป่วยนัดเจาะเลือดในปีนี้";
		exit;
	}
	
	$new_lists = array();
	$nofood_lists = array();
	$lesssixty_lists = array();
	$equalsixty_lists = array();
	$moresixty_lists = array();
	
	foreach($all_items as $item){
		
		$pre_appdate = str_replace($th_months, $key_months, $item['appdate']);
		list($d,$m,$y) = explode(' ', $pre_appdate);
		
		$set_key = "$y-$m";
		$new_lists[$set_key][] = $item;
		
		
		if( preg_match('/(งดน้ำหวานและอาหาร)|(งดน้ำและอาหาร)/', $item['advice']) ){
			$nofood_lists[$set_key][] = $item;
		}
		
		$match = preg_match('/(\d+).+/', $item['age'], $matchs);
		
		if( $match ){
			
			if( $matchs['1'] < 60 ){
				$lesssixty_lists[$set_key][] = $item;
			}else if( $matchs['1'] >= 60 &&  $matchs['1'] <= 65 ){
				$equalsixty_lists[$set_key][] = $item;
			}else if( $matchs['1'] > 60 ){
				$moresixty_lists[$set_key][] = $item;
			}
			
		}
		
	}
	ksort($new_lists);
	ksort($nofood_lists);
	ksort($lesssixty_lists);
	ksort($equalsixty_lists);
	ksort($moresixty_lists);
	
?>
	<style>
		@media print{
			#no-print{
				display: none;
			}
		}
		body{
			font-size:15px;
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
		}
		.percent{
			font-size: 14px;
			color: #838383;
		}
	</style>
	<h3>รายงานผู้ป่วยนัดเจาะเลือดห้อง Lab</h3>
	<table>
		<thead>
			<tr>
				<th rowspan="2">ตัวชี้วัด</th>
				<th colspan="12">ปี <?php echo $year;?></th>
				<th rowspan="2">รวมทั้งปี</th>
			</tr>
			<tr>
				<?php
				foreach($months as $key => $month){
				?>
				<th><?php echo $month; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1.) ผู้ป่วยงดน้ำ, งดอาหาร</td>
				<?php
				$final_from_all = 0;
				$final_from_list = 0;
				foreach($months as $key => $month){
					$find_key = "$year-$key";
					$total_users = count($new_lists[$find_key]);
					$incase = count($nofood_lists[$find_key]);
					$round = round( ( ( $incase * 100 ) / $total_users ), 2 );
					
					$final_from_list += $incase;
					$final_from_all += $total_users;
				?>
				<td align="center">
					<?php if( $round > 0): ?>
					<span class="percent"><?php echo $round.' %'; ?></span>
					<br>
					<?php echo "( $incase / $total_users )"; ?>
					<?php else: ?>
					<p>-</p>
					<?php endif; ?>
				</td>
				<?php } ?>
				<td align="center">
					<span class="percent"><?php echo round(( ($final_from_list * 100) / $final_from_all),2);?> % </span>
					<br>
					( <?php echo $final_from_list.' / '.$final_from_all;?> )
				</td>
			</tr>
			<tr>
				<td>2.) ช่วงอายุน้อยกว่า 60ปี</td>
				<?php
				$final_from_all = 0;
				$final_from_list = 0;
				
				foreach($months as $key => $month){
					$find_key = "$year-$key";
					$total_users = count($new_lists[$find_key]);
					$incase = count($lesssixty_lists[$find_key]);
					$round = round( ( ( $incase * 100 ) / $total_users ), 2 );
					
					$final_from_list += $incase;
					$final_from_all += $total_users;
				?>
				<td align="center">
					<?php if( $round > 0): ?>
					<span class="percent"><?php echo $round.' %'; ?></span>
					<br>
					<?php echo "( $incase / $total_users )"; ?>
					<?php else: ?>
					<p>-</p>
					<?php endif; ?>
				</td>
				<?php } ?>
				<td align="center">
					<span class="percent"><?php echo round(( ($final_from_list * 100) / $final_from_all),2);?> % </span>
					<br>
					( <?php echo $final_from_list.' / '.$final_from_all;?> )
				</td>
			</tr>
			<tr>
				<td>3.) ช่วงอายุระหว่าง 60 ถึง 65ปี</td>
				<?php
				$final_from_all = 0;
				$final_from_list = 0;
				
				foreach($months as $key => $month){
					$find_key = "$year-$key";
					$total_users = count($new_lists[$find_key]);
					$incase = count($moresixty_lists[$find_key]);
					$round = round( ( ( $incase * 100 ) / $total_users ), 2 );
					
					$final_from_list += $incase;
					$final_from_all += $total_users;
				?>
				<td align="center">
					<?php if( $round > 0): ?>
					<span class="percent"><?php echo $round.' %'; ?></span>
					<br>
					<?php echo "( $incase / $total_users )"; ?>
					<?php else: ?>
					<p>-</p>
					<?php endif; ?>
				</td>
				<?php } ?>
				<td align="center">
					<span class="percent"><?php echo round(( ($final_from_list * 100) / $final_from_all),2);?> % </span>
					<br>
					( <?php echo $final_from_list.' / '.$final_from_all;?> )
				</td>
			</tr>
			<tr>
				<td>4.) ช่วงอายุมากกว่า 60ปี</td>
				<?php
				$final_from_all = 0;
				$final_from_list = 0;
				
				foreach($months as $key => $month){
					$find_key = "$year-$key";
					$total_users = count($new_lists[$find_key]);
					$incase = count($equalsixty_lists[$find_key]);
					$round = round( ( ( $incase * 100 ) / $total_users ), 2 );
					
					$final_from_list += $incase;
					$final_from_all += $total_users;
				?>
				<td align="center">
					<?php if( $round > 0): ?>
					<span class="percent"><?php echo $round.' %'; ?></span>
					<br>
					<?php echo "( $incase / $total_users )"; ?>
					<?php else: ?>
					<p>-</p>
					<?php endif; ?>
				</td>
				<?php } ?>
				<td align="center">
					<span class="percent"><?php echo round(( ($final_from_list * 100) / $final_from_all),2);?> % </span>
					<br>
					( <?php echo $final_from_list.' / '.$final_from_all;?> )
				</td>
			</tr>
		</tbody>
	</table>
	<div id="no-print">
		<button id="print" onclick="force_print()">สั่ง Print</button>
	</div>
	
	<script type="text/javascript">
	function force_print(){
		window.print();
	}
	</script>
<?php } ?>
</body>
</html>







