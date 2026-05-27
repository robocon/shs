<?php
session_start();
if ($_SESSION["sOfficer"] == "") {

	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}

include("connect.php");

if ($_REQUEST['do'] == 'update') {
	$update = "UPDATE ipcard set status_log='' WHERE an='" . $_REQUEST['Can'] . "'";
	$result1 = mysql_query($update);
	if ($result1) {
		echo  "ปลดล๊อคผู้ป่วยเรียบร้อยแล้ว";
		echo  "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=anchkcash.php'>";
	}
	exit();
}

?>
<style type="text/css">
	body {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	.txtsarabun {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
</style>

<form method="post" action="anchkcash.php">
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบหมายเลข AN</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="an" size="12" id="aLink">
	</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self href='../nindex.htm'> &lt;&lt;&nbsp;กลับไปเมนู</a>
	</p>
</form>
<script type="text/javascript">
	document.getElementById('aLink').focus();
</script>

<?php
$an = $_POST['an'];
if (!empty($an)) {

	$query = "SELECT `an`,`hn`,`ptname`,`ptright`,`date`,`dcdate`,`diag`,`doctor`,`bedcode`,`status_log`,`opreg`,`authdt`,`my_food` FROM `ipcard` WHERE `an` = '$an' LIMIT 1;";
	$result = mysql_query($query) or die("Query failed: ".mysql_error());
	list($an, $hn, $ptname, $ptright, $date, $dcdate, $diag, $doctor, $bedcode, $status_log, $opreg, $authdt, $my_food) = mysql_fetch_row($result);

	/// ตรวจสอบว่า ผป.มียอดค้างชำระหรือไม่
	$strsql = "select * from accrued where hn='$hn' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow = mysql_num_rows($strresult);
	if ($strrow > 0) {
		echo "<script>alert('ผู้ป่วยมียอดค้างชำระ กรุณาตรวจสอบ') </script>";
		echo "<p><b><font style='font-weight:bold'><a target='BLANK'  href='accrued_list.php?hn=$hn'>ดูยอดค้างชำระ</a></font></b></p>";
	}

	if(empty($ptname)){
		$sql = "SELECT `ptname`,`ptright` FROM `opday` WHERE `an` = '$an' LIMIT 1";
		$q = mysql_query($sql) or die("Query failed: ".mysql_error());
		list($ptname,$ptright) = mysql_fetch_row($q);
	}
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
	<tr>
		<th bgcolor="16A085">AN</th>
		<th bgcolor="16A085">HN</th>
		<th bgcolor="16A085">ชื่อ-สกุล</th>
		<th bgcolor="16A085">สิทธิ</th>
		<th bgcolor="16A085">รับป่วย</th>
		<th bgcolor="16A085">จำหน่าย</th>
		<th bgcolor="16A085">โรค</th>
		<th bgcolor="16A085">แพทย์</th>
		<th bgcolor="16A085">เตียง</th>
		<th bgcolor="16A085">ราคาเตียง<br> ณ ปัจจุบัน</th>
		<th bgcolor="16A085">ค่าห้อง/อาหาร<br>ตามสิทธิ</th>
		<th bgcolor="16A085">ใบข้อมูลเจ็บป่วย</th>
		<th bgcolor="16A085">สถานะ</th>
		<th bgcolor="16A085">หมายเลขอนุมัติ</th>
		<th bgcolor="16A085">วันที่และเวลา</th>
		<th bgcolor="16A085">ตรวจสอบสิทธิ</th>
	</tr>
	<?php
	$accrued_hn = $hn;

	$my_food = number_format($my_food, 2);

	$sql = "SELECT bedpri FROM bed where bedcode = '$bedcode' ";
	$query = mysql_query($sql);
	list($bedpri) = mysql_fetch_array($query);

	print "<tr>";
	print   "  <td BGCOLOR='A9DFBF'>$an</a></td>";
	print   "  <td BGCOLOR='A9DFBF'>$hn</td>";
	print   "  <td BGCOLOR='A9DFBF'>$ptname</td>";
	print   "  <td BGCOLOR='A9DFBF'>$ptright</a></td>";
	print   "  <td BGCOLOR='A9DFBF'>$date</a></td>";
	print   "  <td BGCOLOR='A9DFBF'>$dcdate</td>"; // วันที่จำหน่าย
	print   "  <td BGCOLOR='A9DFBF'>$diag</td>";
	print   "  <td BGCOLOR='A9DFBF'>$doctor</td>";
	print   "  <td BGCOLOR='A9DFBF'>$bedcode</td>";
	print   "  <td BGCOLOR='A9DFBF' align='center'><strong style='color:red;'>$bedpri</strong></td>";
	print   "  <td BGCOLOR='A9DFBF' align='center'><strong style='color:blue;'>$my_food</strong></td>";
	print	"  <td BGCOLOR='A9DFBF' align='center'><a target=_BLANK href=\"insertanchkcash.php?Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>";
	print	"  <td BGCOLOR='A9DFBF' align='center'>";

	if ($status_log == 'จำหน่าย') {
		?><a href="JavaScript:if(confirm('ยืนยันการปลดล๊อค')==true){ window.location='anchkcash.php?Can=<?= $an; ?>&do=update';}">ปลดล๊อคผู้ป่วย</a><?
	} else {
		print "ปลดล๊อคผู้ป่วย";
	}

	echo "</td>";
	print "<td align='center' BGCOLOR='A9DFBF'>";
	$newptright = substr($ptright, 0, 3);
	if ($newptright == 'R02' || $newptright == 'R03' || $newptright == 'R38') {
		if ($opreg == "") {
		?>
			<a href="opregedit.php?Can=<?= $an; ?>">ระบุหมายเลข</a>
		<?
		} else {
			echo "<a href='opregedit.php?Can=$an&act=edit'>" . $opreg . "</a>";
		}
	} else {
		print "-";
	}
	echo "</td>";
	print "<td align='center' BGCOLOR='A9DFBF'>";
	$newptright = substr($ptright, 0, 3);
	if ($newptright == 'R02' || $newptright == 'R03' || $newptright == 'R38') {
		if ($authdt == "0000-00-00 00:00:00") {
			echo "0000-00-00 00:00:00";
		} else {
			echo $authdt;
		}
	} else {
		print "-";
	}

	echo "</td>";
	print "<td BGCOLOR='A9DFBF'><button type=\"button\" class=\"txtsarabun\" id=\"checkPt\" onclick=\"window.open('https://eservices.nhso.go.th/eServices/mobile/login.xhtml')\">ตรวจสอบสิทธิ</button</td>";
	echo " </tr>";
	?>
</table>
<?php
}