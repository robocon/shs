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
<nav class="navbar navbar-expand-lg" id="comNav" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">รายชื่อ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adduser.php?menucode=<?= $_GET["menucode"] ?>">เพิ่มผู้ใช้</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-2">
	<h3>จัดการข้อมูลผู้ใช้งานระบบ</h3>
	<table class="table table-hover">
		<tr>
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
                if(strtolower($rows["status"])!='y'){
                    $statusTxt = 'ปิดการใช้งาน';
					$statusClass='table-warning';
                }
				?>
				<tr class="<?=$statusClass;?>">
					<td><?=$i; ?></td>
					<td><?=$rows["name"]; ?></td>
					<td><?=$rows["menucode"]; ?></td>
                    <td><?=$statusTxt;?></td>
					<td>
						<a href="edituser.php?menucode=<?=$getMenucode; ?>&id=<?= $rows["row_id"]; ?>" class="btn btn-primary btn-sm">แก้ไข</a>
						<?php 
						if(strtolower($rows["status"])=='y'){
						?>
						<a href="showuser.php?act=del&menucode=<?=$getMenucode; ?>&id=<?= $rows["row_id"]; ?>" onClick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่');" class="btn btn-danger btn-sm">ปิดใช้งาน</a>
						<?php 
						}else{
							?>
							<a href="javascript:void(0);" class="btn btn-success btn-sm">เปิดใช้งาน</a>
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