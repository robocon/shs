<?php
include 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

require_once 'includes/JSON.php';
$json = new Services_JSON();

$sessionMenucode = sprintf("%s", $_SESSION['smenucode']);
$getMenucode = sprintf("%s", $_GET['menucode']);
if(empty($sessionMenucode)){
	echo "Invalid data";
	exit;
}

$officerLevel = sprintf("%s", $_SESSION['sLevel']);
if($officerLevel!='admin'){
    echo "อนุญาตเฉพาะAdminประจำแผนก";
    exit;
}

$departments = array(
	'ADM' => 'โปรแกรมเมอร์',
    'ADMCOM' => 'ศูนย์คอมพิวเตอร์',
    'ADMOPD' => 'ทะเบียน',
    'ADMWF' => 'หอผู้ป่วยรวม',
    'ADMICU' => 'หอผู้ป่วยหนัก',
    'ADMVIP' => 'หอผู้ป่วยพิเศษ',
    'ADMMAINREPORT' => 'กองบังคับการ',
    'ADMPT' => 'กายภาพบำบัด/นวดแผนไทย/เวชศาสตร์ฟื้นฟู',
    'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
    'ADMHEM' => 'ห้องไตเทียม',
    'ADMSUR' => 'ห้องผ่าตัด/วิสัญญี',
    'ADMPHA' => 'กองเภสัชกรรม',
    'ADMPHARX' => 'เภสัชกร',
    'ADMDEN' => 'กองทันตกรรม',
    'ADMER' => 'ห้องฉุกเฉิน',
    'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
    'ADMMON' => 'ส่วนเก็บเงินรายได้',
    'ADMNHSO' => 'ห้องประกันสุขภาพฯ',
    'ADMLAB' => 'แผนกพยาธิวิทยา',
    'ADMXR' => 'แผนกรังสีกรรม/ตรวจมวลกระดูก',
    'ADMCMS' => 'ห้องจ่ายกลาง',
    'ADMSSO' => 'ประกันสังคม',
    'ADMNID' => 'ห้องฝังเข็ม',
    'ADMEYE' => 'ห้องตรวจตา',
    'ADMFOD' => 'โภชนาการ',
    'ADMNEWCHKUP' => 'ตรวจสุขภาพ',
    'ADMLIBRARY'=>'ส่งเสริมสุขภาพ'
);

$officerName = sprintf("%s", $_SESSION['sOfficer']);

if($_SESSION['sLevel']!=='admin' && $sessionMenucode !== 'ADM'){
	echo "กรุณาติดต่อผู้ใช้งานระดับ Admin ประจำแผนกของท่าน<br>";
	$sql = "SELECT `name` FROM `inputm` WHERE `menucode` = '$sessionMenucode' AND `level` = 'admin' ";
	$q = $dbi->query($sql);
	while ($a = $q->fetch_assoc()) {
		echo '- '.$a['name'].'<br>';
	}
	echo '<br><a href="../sm3.php">&lt;&lt;&nbsp;กลับไปหน้า Login</a>';
	exit;
}

$act = sprintf("%s", $_GET["act"]);
if ($act == "disable") {

	$id = sprintf("%s", $_GET["id"]);
	$sql = "UPDATE `inputm` SET `status` = 'N' WHERE row_id = '$id' ";
	$q = $dbi->query($sql);
	if ($q !== false) { 
		$res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
	} else {
		$res = array('status'=>400, 'message'=>'ไม่พบผู้ใช้งาน');
	}
	echo $json->encode($res);
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
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
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
			<th width="30">จัดการข้อมูล</th>
		</tr>
		<?php
		$sql = "SELECT * FROM `inputm` WHERE `menucode` LIKE '$sessionMenucode%' AND `menucode` != 'ADMDR1' AND `status` = 'Y' ORDER BY `row_id` ASC ";
		$q = $dbi->query($sql);
		$num = $q->num_rows;
		if ($num > 0) {

			$i = 0;
			while ($rows = $q->fetch_assoc()) {
				$i++;
				$statusClass='';
                if(strtolower($rows["status"])!='y'){
					$statusClass='table-warning';
                }
				?>
				<tr class="<?=$statusClass;?>" id="user-<?=$rows['row_id'];?>">
					<td><?=$i; ?></td>
					<td>
						<a href="edituser.php?menucode=<?=$sessionMenucode; ?>&id=<?= $rows["row_id"]; ?>" title="คลิกเพื่อแก้ไข"><?=$rows["name"];?></a>
					</td>
					<?php 
					if($sessionMenucode=='ADM'){
						?><td><?=$rows["menucode"]; ?></td><?php
					}
					?>
					<td><?=$rows["level"];?></td>
					<td>
						<?php 
						// ไม่ให้ Disable ตัวเอง หรือในระดับ Admin ด้วยกันเอง
						$disableIcon = $disable = '';
						if( $sessionMenucode != 'ADM' ){
							if($officerName==$rows['name'] || $officerLevel==$rows['level']){
								$disable = 'aria-disabled="true"';
								$disableIcon = 'disabled';
							}
						}
						?>
						<a href="javascript:void(0);" onclick="onDisable('<?=$rows['row_id'];?>')" class="btn btn-danger btn-sm <?=$disableIcon;?>" role="button" <?=$disable;?> >ปิด</a>
					</td>
				</tr>
			<?php
			}
		}
		?>
	</table>
	<script>
		function onDisable(id){
			onDisableProcess(id).then((res)=>{
				if(res.status==200){
					document.getElementById('user-'+id).remove();
					Swal.fire({
						title: "บันทึกข้อมูลเรียบร้อย!",
						icon: "success",
						showConfirmButton: false,
						timer: 1200
					});
				}else{
					Swal.fire({
						title: "บันทึกข้อมูลไม่สมบูรณ์ ",
						text: res.message,
						icon: "warning"
					});
				}
			});
		}
		async function onDisableProcess(id){
			const response = await fetch('showuser.php?act=disable&id='+id);
			const res = await response.json();
			return res;
		}
	</script>
</div>

</body>
</html>