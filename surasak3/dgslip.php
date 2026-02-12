<?php
include_once dirname(__FILE__) . '/bootstrap.php';
if (empty($_SESSION['sOfficer'])) {
	include 'pageNotFound.php';
	exit;
}

// ลบข้อมูล
if ($_GET["act"] == "del") {
	$getid = $_GET["id"];
	$slcode = $_GET["slcode"];
	$datekey = date("Y-m-d H:i:s");
	$del = "delete from drugslip where row_id='$getid'";
	if (mysql_query($del)) {
		$add = "insert into log_drugslip set slcode='$slcode', action='del', username='" . $_SESSION["sOfficer"] . "', menucode='" . $_SESSION["smenucode"] . "', datekey='$datekey'";
		mysql_query($add);
		echo "<script>alert('ลบข้อมูลเรียบร้อย');window.location='dgslip.php';</script>";
	} else {
		echo "<script>alert('ผิดพลาด ไม่สามารถลบข้อมูลได้');window.location='dgslip.php';</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<style>
	*{
      font-family: "TH SarabunPSK";
      font-size: 16pt;
  }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary" id="mainNav" data-bs-theme="dark" style="background-color: #13795b!important; color: #ffffff;">
  <div class="container-fluid">
    <a class="navbar-brand" href="../nindex.htm">🏡</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="slipadd.php">เพิ่มข้อมูลวิธีใช้</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="dgslip.php">แก้ไขวิธีใช้</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="slipcode_edit.php">จำนวนต่อวัน</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container">

<style type="text/css">
	body,
	td,
	th {
		font-family: TH SarabunPSK;
		font-size: 16px;
	}

	a:link {
		text-decoration: none;
	}

	a:visited {
		text-decoration: none;
	}

	a:hover {
		text-decoration: none;
	}

	a:active {
		text-decoration: none;
	}
	#mainTable tr th{
		line-height: 35px;
		text-align: center;
	}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" class="mt-2">
	<form name="form1" method="post" action="<? $PHP_SELF; ?>">
		<tr>
			<td align="center" valign="bottom">
				<p><strong>รหัสวิธีการใช้ยา :</strong>
					<input type="text" name="txt" size="30" value="<?= $txt; ?>" />
					&nbsp;
					<input type="submit" name="button" id="button" value="ค้นหาข้อมูล" class="btn btn-sm btn-secondary" />
				</p>
			</td>
		</tr>
	</form>
</table>
<?php
if ($_POST["txt"] == "") {
	$query = "SELECT * FROM drugslip";
} else {
	$query = "SELECT * FROM drugslip where slcode like '%$_POST[txt]%'";
}
$result = mysql_query($query) or die("Query failed");
$num = mysql_num_rows($result);
?>
<table id="mainTable" width="100%" border="1" cellpadding="0" style="border-collapse:collapse; border-color: #000000;">
	<tr>
		<th align="center" bgcolor="#FF9933">ลำดับที่</th>
		<th align="center" bgcolor="#FF9933">รหัส</th>
		<th align="center" bgcolor="#FF9933">วิธีใช้1</th>
		<th align="center" bgcolor="#FF9933">วิธีใช้2</th>
		<th align="center" bgcolor="#FF9933">วิธีใช้3</th>
		<th align="center" bgcolor="#FF9933">วิธีใช้4</th>
		<th align="center" bgcolor="#FF9933">จำนวนที่ใช้ต่อวัน</th>
		<th align="center" bgcolor="#FF9933">กระบวนการ</th>
	</tr>
	<?php
	if (empty($num)) {
		echo "<tr>
			<th colspan='7' align='center' bgcolor='#EBF2D3' class='style3'>---------- ไม่มีข้อมูลในระบบ ----------</th>
		</tr>";
	} else {
		$i = 0;
		while ($rows = mysql_fetch_array($result)) {
			$i++;
		?>
			<tr>
				<td height="23" align="center" bgcolor="#EBF2D3"><?= $i; ?></td>
				<td align="left" bgcolor="#EBF2D3"><?= $rows["slcode"]; ?></td>
				<td align="left" bgcolor="#EBF2D3"><?= $rows["detail1"]; ?></td>
				<td align="left" bgcolor="#EBF2D3"><?= $rows["detail2"]; ?></td>
				<td align="left" bgcolor="#EBF2D3"><?= $rows["detail3"]; ?></td>
				<td align="left" bgcolor="#EBF2D3"><?= $rows["detail4"]; ?></td>
				<th align="left" bgcolor="#EBF2D3"><?= $rows["amount"]; ?></th>
				<td align="center" bgcolor="#FFCC99">
					<a href="dgslip_edit.php?id=<?= $rows["row_id"]; ?>" class="btn btn-sm btn-secondary">แก้ไข</a>&nbsp;&nbsp;&nbsp;
					<a href="dgslip.php?act=del&id=<?= $rows["row_id"]; ?>&slcode=<?= $rows["slcode"]; ?>" onClick="return confirm('คุณต้องการลบรายการนี้จริงหรือไม่?');" class="btn btn-sm btn-secondary mb-1">ลบ</a>
				</td>
			</tr>
		<?php
		}
	}
	?>
</table>

</div>
</body>
</html>