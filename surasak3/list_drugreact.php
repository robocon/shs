<?php 
require_once 'bootstrap.php';
require_once 'connect.inc';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>รายชื่อผู้ป่วยแพ้ยา</title>

<style>
.font_title{font-family:"Angsana New"; font-size:24px}
.tb_font{font-family:"Angsana New"; font-size:20px;}
.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F}
@media print{
	#no_print{display:none;}
}
table tr:hover{
	background-color: #b8b8b8;
}
</style>
</head>
<body>
<div>
	<h1 align="center" class="font_title"><a href="list_drugreact.php">รายชื่อผู้ป่วยแพ้ยา</a></h1>
</div>
<div>
	<form action="list_drugreact.php" method="get">
		<div align="center">
			ค้นหาตาม HN: <input type="text" name="hn" id="hn"> <button type="submit">ค้นหา</button>
			<input type="hidden" name="page" value="search_by_hn">
			<br>
		</div>
	</form>
	<div align="center" style="margin: 8px;">
		<a href="javascript:void(0);" onclick="window.location='list_drugreact.php?page=all';">แสดงรายชื่อทั้งหมด</a>
	</div>
</div>
<?php 

$page = sprintf("%s", trim($_GET['page']));
$hn = sprintf("%s", trim($_GET['hn']));
$tb_search = '';
if($page==='all'){
	$tb_search = 'drugreact';
}elseif ($page==='search_by_hn') {
	$tb_search = " ( SELECT * FROM drugreact WHERE hn = '$hn' )  ";
}

if (!empty($tb_search)) {
	
	$n='1';
	$sqls = "SELECT a.hn, a.idguard,CONCAT(a.`yot`,a.`name`,' ',a.`surname`) AS ptname,b.* 
	FROM $tb_search AS b
	LEFT JOIN opcard AS a ON a.hn = b.hn 
	WHERE b.row_id IS NOT NULL 
	AND a.idcard != '' 
	AND ( a.idguard NOT LIKE 'mx07%' AND a.idguard NOT LIKE 'mx04%' )
	ORDER BY b.hn ASC ";
	$q = $dbi->query($sqls);
	if($q->num_rows > 0){ 
		?>
		<table align="center" width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;"  bordercolor="#000000" class="">
			<tr style="background-color: #008080; color: #ffffff;" class="tb_font_1">
				<th align="center">NO.</th>
				<th align="center">HN</th>
				<th align="center">ชื่อ - สกุล</th>
				<th align="center">รหัสยา</th>
				<th align="center">ชื่อยา</th>
				<th align="center">ชื่อสามัญ</th>
				<th align="center" width="23%">ชื่อกลุ่ม</th>
				<th align="center" width="15%">อาการ</th>
			</tr>
			<?php 
			while($result = $q->fetch_assoc()){ 

				$id = $result['row_id'];
				$hn = $result['hn'];

				$urlSearchHn = "drugreact_new_add.php?page=search&hn=$hn";
				$url = "drugreact_new_add.php?page=showedit&row_id=$id&hn=$hn";

				$idguard_code = substr($result['idguard'],0,4);
				$user_alert = '';
				if($idguard_code=='MX04'){
					$user_alert = ' <b style="color:red;">(เสียชีวิต)</b>';
				}
				?>
				<tr class="tb_font"> 
					<td><?=$n?></td>
					<td>
						<a href="<?=$urlSearchHn;?>" title="คลิกเพื่อแสดงข้อมูลในหน้าแพ้ยา" target="_blank"><?=$result['hn']?></a>
					</td>
					<td ><?=$result['ptname'].$user_alert;?></td>
					<td>
						<a href="<?=$url;?>" title="ึคลิกเพื่อแก้ไขข้อมูล" target="_blank"><?=$result['drugcode']?></a>
					</td>
					<td ><?=$result['tradname']?></td>
					<td ><?=$result['genname']?></td>
					<td ><?=$result['groupname']?></td>
					<td ><?=$result['advreact']?></td>
				</tr>
				<?php
				$n++;
			}
			?>
		</table>
		<?php
	}else{
		?>
		<p align="center"><b>ไม่พบข้อมูลการแพ้ยา</b></p>
		<?php
	}
}
?>
</body>
</html>