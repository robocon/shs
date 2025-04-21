<?php
session_start();
include("connect.inc");
$m = date('m');
?><style type="text/css">
	body,
	td,
	th {
		font-family: TH SarabunPSK;
		font-size: 18px;
	}

	.fromtxt {
		font-family: TH SarabunPSK;
		font-size: 18px;
	}
</style>
<h2>กรุณาเลือกเดือนและปีที่ต้องการดูข้อมูล</h2>
<form id="form1" name="form1" method="post" action="report_listsumvnmount.php">
	<input name="act" type="hidden" value="show">
	เลือก เดือน :
	<select name="m_start" class="fromtxt">
		<option value="01" <? if ($m == '01') {
								echo "selected";
							} ?>>มกราคม</option>
		<option value="02" <? if ($m == '02') {
								echo "selected";
							} ?>>กุมภาพันธ์</option>
		<option value="03" <? if ($m == '03') {
								echo "selected";
							} ?>>มีนาคม</option>
		<option value="04" <? if ($m == '04') {
								echo "selected";
							} ?>>เมษายน</option>
		<option value="05" <? if ($m == '05') {
								echo "selected";
							} ?>>พฤษภาคม</option>
		<option value="06" <? if ($m == '06') {
								echo "selected";
							} ?>>มิถุนายน</option>
		<option value="07" <? if ($m == '07') {
								echo "selected";
							} ?>>กรกฎาคม</option>
		<option value="08" <? if ($m == '08') {
								echo "selected";
							} ?>>สิงหาคม</option>
		<option value="09" <? if ($m == '09') {
								echo "selected";
							} ?>>กันยายน</option>
		<option value="10" <? if ($m == '10') {
								echo "selected";
							} ?>>ตุลาคม</option>
		<option value="11" <? if ($m == '11') {
								echo "selected";
							} ?>>พฤศจิกายน</option>
		<option value="12" <? if ($m == '12') {
								echo "selected";
							} ?>>ธันวาคม</option>
	</select>
	ปี พ.ศ.
	<?php
	$Y = date("Y") + 543;
	$date = date("Y") + 543 + 5;

	$dates = range(2547, $date);
	echo "<select name='y_start' class='fromtxt'>";
	foreach ($dates as $i) {
	?>

		<option value='<?= $i ?>' <? if ($Y == $i) {
										echo "selected";
									} ?>><?= $i; ?></option>
		<?php
	}
	echo "</select>";
		?>&nbsp;&nbsp;&nbsp;
		<input name="button" type="submit" class="fromtxt" id="button" value="ตกลง" />
		&nbsp;&nbsp;&nbsp;<a target=_self href='../nindex.htm'> ไปเมนู </a>
</form>
<?php
if ($_POST["act"] == "show") {
	$mount = $_POST["m_start"];
	$year = $_POST["y_start"];
	$sql = "select distinct(SUBSTRING(ptright,1,3)) from opday where thidate like '$year-$mount%' and ptright !=''";
	$query = mysql_query($sql);
?>
	<hr>
	<h3>ข้อมูลผู้ป่วยที่มาใช้บริการโรงพยาบาลแยกตามสิทธิ<br>
		ประจำเดือน <?= "$mount/$year"; ?></h3>
	<table width="50%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
		<tr>
			<td align="center">วันที่</td>
			<?php
			while (list($ptright) = mysql_fetch_array($query)) {

				$q = mysql_query("SELECT `name` FROM `ptright` WHERE `code` = '$ptright' ");
				$item = mysql_fetch_assoc($q);
			?>
				<td align="center"><?= $ptright.' '.$item['name'];?></td>
			<?php
			}
			?>
		</tr>
		<?php
		if ($mount == "01" || $mount == "03" || $mount == "05" || $mount == "07" || $mount == "08" || $mount == "10" || $mount == "12") {
			$n = 31;
		} else if ($mount == "04" || $mount == "06" || $mount == "09" || $mount == "11") {
			$n = 30;
		} else if ($mount == "02") {
			$n = 28;
		}
		for ($i = 1; $i <= $n; $i++) {
		?>
			<tr>
				<td align="center"><?= $i; ?></td>
				<?php
				$sql = "select distinct(SUBSTRING(ptright,1,3)) from opday where thidate like '$year-$mount%'  and ptright !=''";
				$query = mysql_query($sql);
				while (list($ptright) = mysql_fetch_array($query)) {
					$date = sprintf("%02d", $i);
					$sql1 = "select count(row_id) from opday where thidate like '$year-$mount-$date%' and ptright LIKE '$ptright%'";
					$query1 = mysql_query($sql1);
					list($count) = mysql_fetch_array($query1)
				?>
					<td align="right"><?= $count; ?></td>
				<?php
				}
				?>
			</tr>
		<?php
		}
		?>
	</table>
<?php
}
?>