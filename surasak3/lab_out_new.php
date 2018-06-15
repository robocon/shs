<?php

require "bootstrap.php";
$db = Mysql::load();


$times = array(
	'01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', 
	'12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', 
	'23:00', '00:00', 
);

$curr_hour = date('G');
$curr_time = "$curr_hour:00";

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=TIS620" />
		<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
		<script type="text/javascript" src="epoch_classes.js"></script>
		<style type="text/css">
		*{
			font-family: TH Sarabun New, TH SarabunPSK;
			font-size: 16pt;
		}
		#date_start, #date_end{
			width: 100px;
		}
		div{
			margin-bottom: 0.5em;
		}
		/* ตาราง */
		.chk_table{
			border-collapse: collapse;
		}

		.chk_table, th, td{
			border: 1px solid black;
		}

		.chk_table th,
		.chk_table td{
			padding: 3px;
		}
		table td{
			vertical-align: top;
		}
		</style>
	</head>
	<body>
		<p><a href="../nindex.htm">กลับสู่หน้าโปรแกรมหลัก</a></p>
		<h3>OUTLAB ตามแผนกที่จัดส่ง</h3>
		<form method="post" action="lab_out_new.php">
			<div>
				<label>
					<span>เริ่มตั้งแต่วันที่: </span>
					<input type="text" id="date_start" name="date_start" value="<?php echo $date_start; ?>">
				</label>
				<label>
					<span>เวลา: </span>
					<select name="time_start">
						<?php foreach($times as $time){ ?>
						<?php $select = ($time == $curr_time) ? 'selected="selected"' : '' ; ?>
						<option value="<?php echo $time; ?>" <?php echo $select; ?>><?php echo $time; ?></option>
						<?php } ?>
					</select>
					น.
				</label>

				<label>
					<span>สิ้นสุดวันที่: </span>
					<input type="text" id="date_end" name="date_end" value="<?php echo $date_end; ?>">
				</label>
				<label>
					<span>เวลา: </span>
					<select name="time_end">
						<?php foreach($times as $time){ ?>
						<?php $select = ($time == $curr_time) ? 'selected="selected"' : '' ; ?>
						<option value="<?php echo $time; ?>" <?php echo $select; ?>><?php echo $time; ?></option>
						<?php } ?>
					</select>
					น.
				</label>
			</div>
			<?php
			$sql = "SELECT * FROM `outlab_company`";
			$db->select($sql);
			$company_list = $db->get_items();

			
			?>
			<div>
				<span>เลือกรายการที่ส่ง: </span>
				<select name="part" id="">
					<option value="">ทั้งหมด</option>
					<?php
					foreach ($company_list as $key => $company) {
						$selected = ( $company['id'] == $_POST['part'] ) ? 'selected="selected"' : '';
						?>
						<option value="<?=$company['id'];?>" <?=$selected;?> ><?=$company['name'];?></option>
						<?php
					}
					?>
				</select>
			</div>
			<div>
				<input type="hidden" name="action" value="report">
				<button type="submit">ทำการส่งออกข้อมูล</button>
			</div>
		</form>
		
		<script type="text/javascript">
			var popup1, popup2;
			window.onload = function() {
				popup1 = new Epoch('popup1','popup',document.getElementById('date_start'),false);
				popup2 = new Epoch('popup2','popup',document.getElementById('date_end'),false);
			};
		</script>
	</body>
</html>

<?php 

$action = input_post('action');

if( $action == 'report' ){

	$time_start = $_POST['date_start'].':00';
	$time_end = $_POST['date_end'].':59';
	$part = input('part');

	// 
	$where = '';
	if( $part != '' ){
		$where = "WHERE `company_id` = '$part'";
		
	} 

	// ดึงเอา code มารวมกันก่อน
	$sql = "SELECT * FROM `outlab_list` $where GROUP BY `lab_id`";
	$db->select($sql);
	$company_list = $db->get_items();
	
	$outlab_where = array();
	foreach ($company_list as $key => $company) {
		$code = $company['code'];
		$outlab_where[] = "'$code'";
	}
	$outlab_where_txt = implode(',', $outlab_where);
	// dump($outlab_where_txt);

    list($ys, $ms, $ds) = explode('-', $_POST['date_start']);
	$ys = $ys + 543;
    $date_start_th = "$ys-$ms-$ds";

    list($ye, $me, $de) = explode('-', $_POST['date_end']);
	$ye = $ye + 543;
	$date_end_th = "$ye-$me-$de";
	

	/*
	$where_outlab = '';
	if( $company_id != '' ){
		$where_outlab = "AND `outlab_name` = '$company_id' ";
	}

	$sql = "SELECT a.*, b.* 
	FROM ( 
		SELECT `row_id` AS `pat_id`,`date`,`hn`,`ptname`,`code`,`status`,`price`,
		SUBSTRING(`date`,1,10) AS `short_date`
		FROM `patdata` 
		WHERE ( `date` >= '$date_start_th $time_start' AND `date` <= '$date_end_th $time_end' ) 
		AND `depart` = 'PATHO' 
		AND `status` = 'Y' 
		AND `price` > 0 
	) AS a LEFT JOIN ( 
		SELECT `row_id` AS `lab_id`,`code`,`detail`,`outlab_name`
		FROM `labcare` 
		WHERE `labtype` = 'OUT' 
		$where_outlab 
		AND `labstatus` = 'Y' 
		AND `depart` LIKE '%patho%'
	) AS b ON b.`code` = a.`code` 
	WHERE b.`lab_id` IS NOT NULL 
	ORDER BY a.`pat_id`; ";
	*/

	
	$sql = "SELECT `row_id`,`date`,`hn`,`ptname`,`code`,`status`,`price`,
	SUBSTRING(`date`,1,10) AS `short_date`
	FROM `patdata` 
	WHERE ( `date` >= '$date_start_th $time_start' AND `date` <= '$date_end_th $time_end' ) 
	AND `code` IN($outlab_where_txt) 
	AND `depart` = 'PATHO' 
	AND `status` = 'Y' 
	AND `price` > 0 
	GROUP BY `hn`,`code`
	ORDER BY `row_id`";

	// dump($sql);
	// exit;
	
	$db->select($sql);
	$items = $db->get_items();

	?>
	<table class="chk_table">
		<tr>
			<th>วันที่</th>
			<th>HN</th>
			<th>ชื่อ-สกุล</th>
			<th>รหัส</th>
			<th>รายละเอียด</th>
		</tr>
	<?php
	// รายการจาก patdata
	foreach ($items as $key => $item) { 

		$name = $item['outlab_name'];
		$lab_code = $item['code'];


		// $sql = "SELECT * FROM `outlab_company` WHERE `labcare_name` = '$name' ";
		// $db->select($sql);
		// $company = $db->get_item($sql); 


		$sql = "SELECT `row_id` AS `lab_id`,`code`,`detail`,`outlab_name` FROM `labcare` WHERE `code` = '$lab_code' ";
		$db->select($sql);
		$labcare = $db->get_item();


		$part_txt = '';
		// $sql = "SELECT * FROM `outlab_list` WHERE `lab_id` = '$lab_id'";
		// $db->select($sql);

		// $parts = false;
		// $part_txt = '';
		// if( $db->get_rows() > 0 ){
		// 	$parts = $db->get_items();
		// 	foreach ($parts as $key => $value) {
		// 		$part_txt .= $value['company']."<br>";
		// 	}
		// }

		$short_date = $item['short_date'];
		if( $short_date == $late_short_date ){
			$short_date = '';
		}

		$hn = $item['hn'];
		if ( $hn == $late_hn ) {
			$hn = '';
		}

		$ptname = $item['ptname'];
		if ( $ptname == $late_ptname ) {
			$ptname = '';
		}

		?>
		<tr>
			<td><?=$short_date;?></td>
			<td><?=$hn;?></td>
			<td><?=$ptname;?></td>
			<td><?=$item['code'];?></td>
			<td><?=$labcare['detail'];?></td>
		</tr>
		<?php

		$late_short_date = $item['short_date'];
		$late_hn = $item['hn'];
		$late_ptname = $item['ptname'];
	}
	?>
	</table>
	<?php
}