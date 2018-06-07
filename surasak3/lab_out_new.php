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
		/* ���ҧ */
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
		<p><a href="../nindex.htm">��Ѻ���˹���������ѡ</a></p>
		<h3>OUTLAB ���Ἱ����Ѵ��</h3>
		<form method="post" action="lab_out_new.php">
			<div>
				<label>
					<span>�����������ѹ���: </span>
					<input type="text" id="date_start" name="date_start" value="<?php echo $date_start; ?>">
				</label>

				<label>
					<span>����ش�ѹ���: </span>
					<input type="text" id="date_end" name="date_end" value="<?php echo $date_end; ?>">
				</label>
			</div>

			<div>
				<input type="hidden" name="action" value="report">
				<button type="submit">�ӡ�����͡������</button>
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
	

	$sql = "SELECT a.*, b.* 
	FROM ( 
		SELECT `row_id` AS `pat_id`,`date`,`hn`,`ptname`,`code`,`status`,`price`,
		SUBSTRING(`date`,1,10) AS `short_date`
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
	WHERE b.`lab_id` IS NOT NULL 
	ORDER BY a.`pat_id`; ";
	
	$db->select($sql);
	$items = $db->get_items();

	?>
	<table class="chk_table">
		<tr>
			<th>�ѹ���</th>
			<th>HN</th>
			<th>����-ʡ��</th>
			<th>����</th>
			<th>��������´</th>
			<th>Out Lab</th>
			<th>Ἱ������</th>
		</tr>
	<?php

	foreach ($items as $key => $item) { 

		$name = $item['outlab_name'];
		$lab_id = $item['lab_id'];


		$sql = "SELECT * FROM `outlab_company` WHERE `labcare_name` = '$name' ";
		$db->select($sql);
		$company = $db->get_item($sql);

		$sql = "SELECT `name` FROM `outlab_list` WHERE `company` = '$name' AND `lab_id` = '$lab_id'";
		$db->select($sql);

		$parts = false;
		$part_txt = '';
		if( $db->get_rows() > 0 ){
			$parts = $db->get_items();
			foreach ($parts as $key => $value) {
				$part_txt .= $value['name']."<br>";
			}
		}

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
			<td><?=$item['detail'];?></td>
			<td><?=$company['name'];?></td>
			<td><?=$part_txt;?></td>
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