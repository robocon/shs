<?php
// session_start();
// require "connect.php";
// require "includes/functions.php";
require "bootstrap.php";

function clean_space($str){
	$check = array("\n", "\r", "\n\r","\r\n", '"', "'", ',');
	$str = trim($str);
	$str = str_replace($check, ' ', $str);
	
	if($str == ''){
		$str = '-';
	}
	
	return $str;
}

$file_name = '';
$test_row = 0;
$action = isset($_POST['action']) ? trim($_POST['action']) : ( isset($_GET['action']) ? trim($_GET['action']) : false ) ;

if($action == 'save'){
	
	list($ys, $ms, $ds) = explode('-', $_POST['date_start']);
	$ys = $ys + 543;
	$date_start_th = "$ys-$ms-$ds";
	$time_start = $_POST['time_start'];
	
	list($ye, $me, $de) = explode('-', $_POST['date_end']);
	$ye = $ye + 543;
	$date_end_th = "$ye-$me-$de";
	$time_end = $_POST['time_end'];
	
	
	$cal_start = strtotime($_POST['date_start']);
	$cal_end = strtotime($_POST['date_end']);
	
	if($cal_end < $cal_start){
		echo '';
		echo 'ไม่สามารถเลือกวันที่ย้อนหลังวันที่เริ่มได้&nbsp;<a href="javascript: window.history.back();">คลิกที่นี่</a> เพื่อกลับไปแก้ไขข้อมูล';
		exit;
	}
	
	$sql = "
SELECT a.`hn`, a.`ptname`, b.`code`, b.`detail`, b.`outlab_name` 
FROM `patdata` AS a , `labcare` AS b 
WHERE ( a.`date` >= '$date_start_th $time_start:00' AND a.`date` <= '$date_end_th $time_end:00' ) 
AND a.`code` = b.`code` 
AND b.`labtype` = 'OUT' 
AND b.`depart` LIKE '%patho%' 
AND b.`code` NOT LIKE '%@%'
";

	$query = mysql_query($sql) or die( mysql_error($Conn) );
	$contents = "HN,Name,Detail,Company\n";
	
	$test_row = mysql_num_rows($query);
	
	while($item = mysql_fetch_assoc($query)){
		$hn = $item['hn'];
		$name = clean_space($item['ptname']);
		$detail = clean_space($item['detail']);
		$outlab = clean_space($item['outlab_name']);
		
		$contents .= "$hn,$name,$detail,$outlab\n";
	}
	
	
	$file_name = "out_lab_$date_start_th-to-$date_end_th.csv";
	
	if($test_row > 0){
		$fp = fopen('lab_export/'.$file_name, 'w');
		fwrite($fp, $contents);
		fclose($fp);
	}
	
}else if($action == 'download'){
	
	$options = pathinfo($_GET['file']);
	if($options['extension'] != 'csv'){
		echo 'Invalid file type please contact admin';
		exit;
	}
	
	$full_path = 'lab_export/'.$options['basename'];
	
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($full_path));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($full_path));
    readfile($full_path);
	
	exit;
}

$curr_hour = date('G');

if($curr_hour <= '12'){
	$date_start = date('Y-m-d', strtotime('-1 day'));
	$date_end = date('Y-m-d');
}else{
	$date_start = date('Y-m-d');
	$date_end = date('Y-m-d', strtotime('+1 day'));
}

$curr_time = "$curr_hour:00";

$times = array(
'01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', 
'12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', 
'23:00', '00:00', 
);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=TIS620" />
		<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
		<script type="text/javascript" src="epoch_classes.js"></script>
		<style type="text/css">
		#date_start, #date_end{
			width: 100px;
		}
		div{
			margin-bottom: 0.5em;
		}
		</style>
	</head>
	<body>
		<p><a href="../nindex.htm">กลับสู่หน้าโปรแกรมหลัก</a></p>
		<h3>โปรแกรมส่งออกข้อมูลผู้ป่วยที่มีค่าใช้จ่ายแลปนอก</h3>
		<form method="post" action="lab_out_export.php">
			<div>
				<span>เลือกวันที่ส่งออกข้อมูล&nbsp;</span>
			</div>
			
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
			</div>
			<div>
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
			<div>
				<input type="hidden" name="action" value="save">
				<button type="submit">ทำการส่งออกข้อมูล</button>
			</div>
		</form>
		<?php
		if($test_row > 0 && $action == 'save'){
			?>
			<p>ระบบทำการส่งออกข้อมูลเสร็จเรียบร้อย</p>
			<p><a href="lab_out_export.php?action=download&file=<?php echo $file_name; ?>">คลิกที่นี่</a> เพื่อดาวโหลดไฟล์</p>
			<?php
		}else if($test_row == 0 && $action == 'save'){
			?>
			<p>ไม่มีข้อมูลในวันที่เลือก</p>
			<?php
		}
		?>
		<script type="text/javascript">
			var popup1, popup2;
			window.onload = function() {
				popup1 = new Epoch('popup1','popup',document.getElementById('date_start'),false);
				popup2 = new Epoch('popup2','popup',document.getElementById('date_end'),false);
			};
		</script>
	</body>
</html>