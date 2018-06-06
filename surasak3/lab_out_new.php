<?php

require "bootstrap.php";

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
		</style>
	</head>
	<body>
		<p><a href="../nindex.htm">กลับสู่หน้าโปรแกรมหลัก</a></p>
		<h3>โปรแกรมส่งออกข้อมูลผู้ป่วยที่มีค่าใช้จ่ายแลปนอก</h3>
		<form method="post" action="lab_out_new.php">
			<div>
				<span>เลือกวันที่ส่งออกข้อมูล&nbsp;</span>
			</div>
			
			<div>
				<label>
					<span>เริ่มตั้งแต่วันที่: </span>
					<input type="text" id="date_start" name="date_start" value="<?php echo $date_start; ?>">
				</label>
			</div>
			<div>
				<label>
					<span>สิ้นสุดวันที่: </span>
					<input type="text" id="date_end" name="date_end" value="<?php echo $date_end; ?>">
				</label>
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

    $db = Mysql::load();


    list($ys, $ms, $ds) = explode('-', $_POST['date_start']);
	$ys = $ys + 543;
    $date_start_th = "$ys-$ms-$ds";

    list($ye, $me, $de) = explode('-', $_POST['date_end']);
	$ye = $ye + 543;
	$date_end_th = "$ye-$me-$de";
	

	$sql = "SELECT a.*,SUBSTRING(a.`date`,1,10) AS `short_date`,b.*
	FROM ( 
		SELECT `row_id` AS `pat_id`,`date`,`hn`,`ptname`,`code`,`status`,`price` 
		FROM `patdata` 
		WHERE ( `date` >= '$date_start_th 00:00:01' AND `date` <= '$date_end_th 23:59:59' ) 
		AND `depart` = 'PATHO' 
		AND `status` = 'Y' 
		AND `price` > 0 
	) AS a LEFT JOIN ( 
		SELECT `row_id` AS `lab_id`,`code`,`detail`,`outlab_name`
		FROM `labcare` 
		WHERE `labtype` = 'OUT' 
		AND `labstatus` = 'Y' 
		AND `depart` LIKE '%patho%'
	) AS b ON b.`code` = a.`code` 
	WHERE b.`lab_id` IS NOT NULL; ";
	
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
			<th>Out Lab</th>
		</tr>
	<?php

	foreach ($items as $key => $item) {
		?>
		<tr>
			<td><?=$item['short_date'];?></td>
			<td><?=$item['hn'];?></td>
			<td><?=$item['ptname'];?></td>
			<td><?=$item['code'];?></td>
			<td><?=$item['detail'];?></td>
			<td><?=$item['outlab_name'];?></td>
		</tr>
		<?php
	}
	?>
	</table>
	<?php
}