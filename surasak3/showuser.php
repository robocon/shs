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
if($sessionMenucode != $getMenucode){
	echo "ไม่สามารถแก้ไขข้ามแผนกได้ กรุณาติดต่อโปรแกรมเมอร์ .... ไหว้ละจ้าาาาา ";
	exit;
}

if($_SESSION['sLevel']!=='admin' && $_SESSION['smenucode'] !== 'ADM'){
	echo "กรุณาติดต่อผู้ใช้งานระดับ Admin ประจำแผนกของท่าน<br>";
	$sql = "SELECT `name` FROM `inputm` WHERE `menucode` = '".$_SESSION['smenucode']."' AND `level` = 'admin' ";
	$q = mysql_query($sql);
	while ($a = mysql_fetch_assoc($q)) {
		echo '- '.$a['name'].'<br>';
	}
	echo '<br><a href="../sm3.php">&lt;&lt;&nbsp;กลับไปหน้า Login</a>';
	exit;
}

if ($_GET["act"] == "del") {
	$del = "update inputm set status='N' where row_id='" . $_GET["id"] . "'";
	if (mysql_query($del)) {
		echo "<script>alert('ปิดการใช้งานเรียบร้อยแล้ว');window.location='showuser.php?menucode=".$_GET['menucode']."';</script>";
		exit;
	} else {
		echo "<script>alert('!!! ผิดพลาดไม่สามารถปิดการใช้งาน');window.location='showuser.php?menucode=".$_GET['menucode']."';</script>";
		exit;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>จัดการข้อมูลผู้ใช้งานระบบ</title>
	<link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
</head>
<body>
<style type="text/css">
	body,td,th {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	th{
		background-color: #009688;
		color: #ffffff;
	}
    .addUserButton{
        text-decoration: none;
        border: none;
        padding: 8px 12px;
        background-color: #009688;
        color: #ffffff;
    }
    .addUserButton:hover{
        background-color: #01746a;
    }
	.disableUser, .disableUser a{
		background-color: #dc3545;
		color: #ffffff;
	}
	.disableUser:hover, .disableUser:hover a{
		background-color: #b02a37;
	}
</style>
<div align="center">
	<p><strong>จัดการข้อมูลผู้ใช้งานระบบ</strong></p>
	<div>
        <a href="adduser.php?menucode=<?= $_GET["menucode"] ?>" class="addUserButton">เพิ่มผู้ใช้ในแผนก</a>
    </div>
    <div>&nbsp;</div>
	<table width="80%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
		<tr style="background-color: #13795b; color:#ffffff;">
			<th width="10%">ลำดับ</th>
			<th width="30%">ชื่อ - นามสกุล</th>
			<th width="15%">part</th>
            <th width="15%">สถานะ</th>
			<th width="30">จัดการข้อมูล</th>
		</tr>
		<?php
		$sql = "select * from inputm where menucode like '$getMenucode%' order by menucode ";
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
                if($rows["status"]=='N'){
                    $statusTxt = 'ปิดการใช้งาน';
					$statusClass='disableUser';
                }
				?>
				<tr class="<?=$statusClass;?>">
					<td align="center"><?=$i; ?></td>
					<td><?=$rows["name"]; ?></td>
					<td align="center"><?=$rows["menucode"]; ?></td>
                    <td align="center"><?=$statusTxt;?></td>
					<td align="center">
						<a href="edituser.php?menucode=<?=$getMenucode; ?>&id=<?= $rows["row_id"]; ?>">แก้ไข</a>
						&nbsp;|&nbsp;
						<?php 
						if($rows["status"]=='Y'){
						?>
						<a href="showuser.php?act=del&menucode=<?=$getMenucode; ?>&id=<?= $rows["row_id"]; ?>" onClick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่');">ปิดใช้งาน</a>
						<?php 
						}else{
							?>
							<a href="javascript:void(0);">เปิดใช้งาน</a>
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