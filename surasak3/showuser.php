<?php
session_start();
include("connect.php");

/**
 * Rule of this page
 * [] Level is admin 
 */
$getMenucode = sprintf("%s", $_GET['menucode']);
if(empty($getMenucode)){
	echo "Invalid data";
	exit;
}
$sessionMenucode = sprintf("%s", $_SESSION['smenucode']);
$officerName = sprintf("%s", $_SESSION['sOfficer']);
$officerLevel = sprintf("%s", $_SESSION['sLevel']);

if($sessionMenucode != $getMenucode){
	echo "ไม่สามารถแก้ไขข้ามแผนกได้ กรุณาติดต่อโปรแกรมเมอร์ .... ไหว้ละจ้าาาาา ";
	exit;
}

if($_SESSION['sLevel']!=='admin' && $sessionMenucode !== 'ADM'){
	echo "กรุณาติดต่อผู้ใช้งานระดับ Admin ประจำแผนกของท่าน<br>";
	$sql = "SELECT `name` FROM `inputm` WHERE `menucode` = '$sessionMenucode' AND `level` = 'admin' ";
	$q = mysql_query($sql);
	while ($a = mysql_fetch_assoc($q)) {
		echo '- '.$a['name'].'<br>';
	}
	echo '<br><a href="../sm3.php">&lt;&lt;&nbsp;กลับไปหน้า Login</a>';
	exit;
}

$act = sprintf("%s", $_GET["act"]);
if ($act == "del") {

	$id = sprintf("%s", $_GET["id"]);
	$menucode = sprintf("%s", $_GET['menucode']);
	$del = "UPDATE `inputm` SET `status`='N' WHERE `row_id`='$id'";
	if (mysql_query($del)) {
		echo "<script>alert('ปิดการใช้งานเรียบร้อยแล้ว');window.location='showuser.php?menucode=$menucode';</script>";
	} else {
		echo "<script>alert('!!! ผิดพลาดไม่สามารถปิดการใช้งาน');window.location='showuser.php?menucode=$menucode';</script>";
	}
	exit;
}elseif ($act=='enable') {
	
	$id = sprintf("%s", $_GET["id"]);
	$menucode = sprintf("%s", $_GET['menucode']);

	$del = "UPDATE `inputm` SET `status`='Y' WHERE `row_id`='$id'";
	if (mysql_query($del)) {
		echo "<script>alert('เปิดใช้งานเเรียบร้อย');window.location='showuser.php?menucode=$menucode';</script>";
	} else {
		echo "<script>alert('!!! ผิดพลาดไม่สามารถปิดการใช้งาน');window.location='showuser.php?menucode=$menucode';</script>";
	}
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>จัดการข้อมูลผู้ใช้งานระบบ</title>
	<link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<style type="text/css">
	* {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	table.table th, #comNav{
		background-color: #13795b; 
		color: #ffffff;
	}
</style>
<?php 
require_once 'com_user_menu.php';
?>
<div class="container mt-2">
	<h3>จัดการข้อมูลผู้ใช้งานระบบ</h3>
	<table class="table table-hover">
		<tr>
			<th width="10%">ลำดับ</th>
			<th width="30%">ชื่อ - นามสกุล</th>
			<?php 
			if($sessionMenucode=='ADM'){
				?><th width="15%">part</th><?php
			}
			?>
			<th width="15%">ระดับ</th>
			<th width="15%">สถานะ</th>
			<th width="30">จัดการข้อมูล</th>
		</tr>
		<?php
		$sql = "SELECT * FROM `inputm` WHERE `menucode` LIKE '$getMenucode%' ORDER BY `menucode` ";
		$query = mysql_query($sql);
		$num = mysql_num_rows($query);
		if ($num < 1) {
			echo "<tr><td colspan='3' align='center'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
		} else {
			$i = 0;
			while ($rows = mysql_fetch_array($query)) {
				$i++;

                $statusTxt = 'ใช้งาน';
				$statusClass='';
                if(strtolower($rows["status"])!='y'){
                    $statusTxt = 'ปิดการใช้งาน';
					$statusClass='table-warning';
                }
				?>
				<tr class="<?=$statusClass;?>">
					<td><?=$i; ?></td>
					<td><?=$rows["name"]; ?></td>
					<?php 
					if($sessionMenucode=='ADM'){
						?><td><?=$rows["menucode"]; ?></td><?php
					}
					?>
					<td><?=$rows["level"];?></td>
                    <td><?=$statusTxt;?></td>
					<td>
						<a href="edituser.php?menucode=<?=$getMenucode; ?>&id=<?= $rows["row_id"]; ?>" class="btn btn-primary btn-sm">แก้ไข</a>

						<?php 
						if(strtolower($rows["status"])=='y'){

							// ไม่ให้ Disable ตัวเอง หรือในระดับ Admin ด้วยกันเอง
							$disableIcon = $disable = '';
							$url = 'showuser.php?act=del&menucode='.$getMenucode.'&id='.$rows["row_id"];
							if($officerName==$rows['name'] || $officerLevel==$rows['level']){
								$disable = 'aria-disabled="true"';
								$disableIcon = 'disabled';
								$url = 'javascript:void(0);';
							}
							?>
							<a href="<?=$url;?>" onClick="return confirm('คุณต้องการระงับผู้ใช้งานนี้ใช่หรือไม่');" class="btn btn-danger btn-sm <?=$disableIcon;?>" role="button" <?=$disable;?> >ปิดใช้งาน</a>
							<?php 
						}else{
							?>
							<a href="showuser.php?act=enable&menucode=<?=$getMenucode;?>&id=<?= $rows["row_id"]; ?>" class="btn btn-success btn-sm">เปิดใช้งาน</a>
							<?php
						}
						?>
					</td>
				</tr>
			<?
			}
		}
		?>
	</table>

</div>

</body>
</html>