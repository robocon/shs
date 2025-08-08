<?php
session_start();
include "connect.php";

if(empty($_SESSION['sIdname'])){
	?>
	<p>
		SESSION หมดอายุ กรุณาloginใหม่อีกครั้ง <a href='../nindex.htm'>คลิกที่นี่เพื่อ Login</a>
	</p>
	<?php
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ปรับสถานะแลป</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<style>
	*{
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	#showContent tr th{
		background-color: #13795b;
		color: #ffffff;
		text-align: center;
	}
</style>
<div class="container">
	<div class="mt-2">
		<a href ="../nindex.htm" class="btn btn-success">🏠 ไปเมนู</a>&nbsp;&nbsp;<a href ="upd_labstatus.php" class="btn btn-success">HN ใหม่</a>
	</div>
<?php
if(isset($_POST['hn'])){
	$sql = "select * from resulthead where hn='".$_POST['hn']."' group by labnumber order by orderdate desc";
  	$rows = mysql_query($sql);
	$num = mysql_num_rows($rows);
	?>
	<h3 class="text-center">รายการ LAB ที่ส่งตรวจ</h3>
	<div class="text-center" style='color:red;'>*** <u><b>คำเตือน</b></u> กรุณาตรวจสอบวันที่ Labnumber, Orderdate และOrder ที่ส่งตรวจ ก่อนการปรับสถานะทุกครั้ง ***</div>
	<table id="showContent" class='table table-hover' border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse:collapse'>
		<tr>
			<th width="8%">Labnumber</th>
			<th width="8%">HN</th>
			<th width="12%">ชื่อ - สกุล</th>
			<th width="12%">Orderdate</th>
			<th>Order ที่ส่งตรวจ</th>
			<th>สถานะการตรวจ</th>
			<th width="8%">ปรับสถานะ</th>
		</tr>
	<?php
	if($num < 1){
		?>
		<tr><td colspan='7' style='color:red;'>-------------------- ไม่มีข้อมูล --------------------</td></tr>
		<?php
	}else{
		while($result = mysql_fetch_array($rows)){ 
		
			$query1 = "SELECT `clinicalinfo` FROM `orderhead` WHERE `labnumber`='".$result['labnumber']."' GROUP BY `labnumber`";
			$result1 = mysql_query($query1) or die("Query failed,opday");
			list($orderclinicalinfo)=mysql_fetch_array($result1);	
			
			if($result['orderdate'] < "2022-02-13"){
				$orderclinicalinfo = $result['clinicalinfo'];
			}else{
				$orderclinicalinfo = $orderclinicalinfo;
			}
			
			if(empty($result['clinicalinfo'])){
				$color="#FADBD8";
			}else{
				$color="#F2F3F4";
			}

			echo "<tr style='background-color:$color'>";
			echo "<td align='center'>".$result['labnumber']."</td>";
			echo "<td align='center'>".$result['hn']."</td>";
			echo "<td align='center'>".$result['patientname']."</td>";
			echo "<td align='center'>".$result['orderdate']."</td>";
			echo "<td>&nbsp;".$orderclinicalinfo."</td>";
			echo "<td>&nbsp;".$result['clinicalinfo']."</td>";
			echo "<td align='center'><a href='upd_labstatus.php?ids=".$result['labnumber']."' >แก้ไข</a></td>";
			echo "</tr>";
		}
	}
	echo "</table>";
}elseif(isset($_GET['ids'])){
	////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	////*runno ตรวจสุขภาพ*/////////
	$sql2 = "select * from resulthead where labnumber='".$_GET['ids']."'";
  	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_array($rows2);

	$yearTh= substr(date('Y')+543,2,2);
	$yearRange = array_reverse(range(60, $yearTh));
	?>
<form id="form1" name="form1" method="post" action="upd_labstatus.php">
	<table width="29%" border='0' align='center'>
		<tr>
			<td>
				<div class="input-group mb-4">
					<span class="input-group-text">สถานะเดิม : </span>
					<span class="input-group-text" style="background-color: white;"><?=$result2['clinicalinfo'];?></span>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">
				<div class="input-group mb-4">
					<span class="input-group-text">ปรับสถานะใหม่ : </span>
					<select class="form-select" name='clinic'>
						<option value="">&gt;&gt; กรุณาเลือกสถานะแลป &lt;&lt;</option>
						<?php
						foreach ($yearRange as $yearItem) {
							$selected = ($yearItem === $nPrefix) ? 'selected="selected"' : '' ;
							?>
							<option value="ตรวจสุขภาพประจำปี<?=$yearItem?>" <?=$selected;?>>ตรวจสุขภาพประจำปี<?=$yearItem?></option>
							<?php
						}
						?>
						<option value='ยกเลิก'>ยกเลิก</option>
					</select>
					<input type="submit" name="upbtn" id="button" class="btn btn-primary" value="ตกลง" />
				</div>
				<input name='ids' type="hidden" value="<?=$_GET['ids']?>" />
			</td>
		</tr>
		<tr>
			<td align="center"></td>
		</tr>
	</table>
</form>
<?php
}elseif(isset($_POST['upbtn'])){
	$sql2 = "update resulthead set clinicalinfo= '".$_POST['clinic']."' where labnumber='".$_POST['ids']."'";
  	$result = mysql_query($sql2);
	if($result){
		echo "<center><h3?>ปรับปรุงข้อมูลเรียบร้อยแล้ว</h3></center>";
		echo "<meta http-equiv='refresh' content='3' />";
	}
}else{
?>
<div class="row justify-content-md-center">
	<div class="col col-md-3 mt-2">
		<form action="upd_labstatus.php" method="post" class="text-center">
			<h3>ปรับปรุงสถานะห้องLAB</h3>
			<div class="input-group mb-3">
				<input type="text" name="hn" class="form-control" placeholder="กรุณากรอก HN" required>
				<button class="btn btn-outline-primary" type="submit" id="button-addon2">ค้นหาจาก HN</button>
			</div>
		</form>
	</div>
</div>
<?php
}
?>
</div>
</body>
</html>