<?php
include_once dirname(__FILE__).'/newBootstrap.php';
include_once dirname(__FILE__).'/connect.php';

$count = count($_SESSION["list_code"]);
if ($count > 0) {

	$Thidate = (date("Y") + 543) . date("-m-d H:i:s");
	$an = $_GET['an'];
	$bed = $_GET['cBed'];
	$bedcode = $_GET['cBedcode'];
	$cbedname = $_GET['cbedname'];
	$hn = $_GET['hn'];

	if($_POST['date_sent']){
		$Thidate = dateChristToThai($_POST['date_sent']);
	}

	$sql1 = "select max(no)as tno from lab_ward where an='$an' ";
	$q1 = mysql_query($sql1);
	$ar = mysql_fetch_array($q1);
	$num = $ar['tno'] + 1;

	$sql = "INSERT INTO `lab_ward` ( `no` ,`an` , `code`, `date` )  VALUES ";
	$list = array();
	for ($n = 0; $n < $count; $n++) {
		if (!empty($_SESSION["list_code"][$n])) {
			$q = "('$num','$an', '" . $_SESSION["list_code"][$n] . "', '$Thidate')  ";
			array_push($list, $q);
		}
	}

	$sql .= implode(", ", $list);
	$result = mysql_query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
if ($result) {
	?>
	<p>สั่ง LAB เรียบร้อยแล้ว</p>
	<script>
		window.addEventListener('load', (event) => {
			window.open("ipbed1aa.php?an=<?=$an;?>&bad=<?=$bed;?>&bedcode=<?=$bedcode;?>&cbedname=<?=$cbedname;?>&no=<?=$num;?>", "WinRechallenge","width=600,height=300,left=100,top=100");
		});
		setInterval(function(){
			location.replace("wpreappoi.php?an=<?=$an;?>&cBed=<?=$bed;?>&cBedcode=<?=$bedcode;?>&cHn=<?=$hn;?>&cbedname=<?=$cbedname;?>");
		}, 2000);
	</script>
	<?php
} else {
	?>
	<p>เกิดข้อผิดพลาด</p>
	<p><?=mysql_error();?></p>
	<?php
}
?>
	<p><a href="wpreappoi.php?an=<?=$an;?>&cBed=<?=$bed;?>&cBedcode=<?=$bedcode;?>&cHn=<?=$hn;?>&cbedname=<?=$cbedname;?>">กลับไปหน้าสั่งLAB</a></p>
</body>
</html>