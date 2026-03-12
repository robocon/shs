<?php
include_once dirname(__FILE__) . '/connect.php';

$cHn = "";
$cPtname = "";
$cPtright = "";
$nRunno = "";
$tvn = "";
session_register("nRunno");
session_register("cHn");
session_register("cPtname");
session_register("cPtright");
session_register("tvn");
?>
<style>
	*{
		font-family: "TH SarabunPSK";
		font-size: 14pt;
	}
</style>
<form method="POST" name="formm" onsubmit="return checkType();" action="<?php echo $PHP_SELF ?>">
	<p>ผู้ป่วยนอก HN (ได้จากเวชระเบียน)</p>
	<p>&nbsp;&nbsp;HN&nbsp;&nbsp;<input type="text" name="hn" size="12">
		<br />
		<br />
		<input type="radio" id="servicd1" name="servicd" value="1" /> คิดค่าบริการ 50 บาท
		<br />
		<input type="radio" id="servicd2" name="servicd" value="0" checked="checked" /> ไม่คิดค่าบริการ 50 บาท
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="        ตกลง        " name="B1"></p>
</form>
<script>
	function checkType() {
		if (document.formm.servicd1.checked == false && document.formm.servicd2.checked == false) {
			alert('กรุณาเลือกการคิดค่าใช้จ่าย');
			return false;
		} else {
			return true;
		}
	}
</script>
<?php
$hn = $_REQUEST['hn'];
$confirm = $_REQUEST['confirm'];
$servicd = $_REQUEST['servicd'];

if (!empty($hn) && $confirm != true && empty($servicd)) { // <<==== เข้าฟอร์มนี้ก่อน

	$query = sprintf("SELECT hn, concat(yot,' ',name,' ',surname) as ptname,ptright,SUBSTRING(idguard,1,4) AS idguard FROM opcard WHERE hn = '%s' LIMIT 1 ", mysql_real_escape_string($_POST['hn']));
	$result = mysql_query($query) or die(mysql_error());
	$rowOpcard = mysql_num_rows($result);
	if($rowOpcard==0){
		?>
		<p>ไม่พบข้อมูล HN: <?= $hn; ?> กรุณาตรวจสอบข้อมูลอีกครั้ง</p>
		<?php
		exit();
	}
	list($opcardHn, $opcardPtname, $opcardPtright, $opcardIdguard) = Mysql_fetch_row($result);
	if($opcardIdguard=='MX07'){
		?>
		<p>ผู้ป่วยมีสถานะทำลายประวัติ</p>
		<p>กรุณาติดต่อแผนกทะเบียนเพื่อตรวจสอบและปรับปรุงข้อมูล</p>
		<p>ก่อนดำเนินการต่อไป ขอบคุณครับ</p>
		<?php
		exit();
	}
	?>
	<style>
		.nextStep{
			text-decoration: none;
		}
		.nextStep:hover{
			text-decoration: underline;
			
		}
		.nextStep:hover::after{
			content: " ▶️";
			opacity: 1;
		}
	</style>
	<div>
		<table>
			<tr>
				<td align="right"><strong>HN:</strong> </td>
				<td><?= $opcardHn; ?></td>
			</tr>
			<tr>
				<td align="right"><strong>ชื่อ-สกุล:</strong> </td>
				<td><?= $opcardPtname; ?></td>
			</tr>
			<tr>
				<td align="right"><strong>สิทธิการรักษา:</strong> </td>
				<td><?= $opcardPtright; ?></td>
			</tr>
		</table>
		<div>
			✅ <a href="hnhemo.php?hn=<?= $opcardHn ?>&confirm=true&servicd=<?= $servicd ?>" class="nextStep">ชื่อถูกต้อง ทำรายการต่อไป</a> 
		</div>
	</div>
	<?php
} else if (!empty($hn) && !empty($confirm)) { // <<==== จากลิ้งเงื่อนไขด้านบนจะเข้าตัวนี้

	$hn = $_GET['hn'];

	//หาข้อมูลจาก opcard ของ $cHn เพื่อใช้ทั้งในกรณีลงทะเบียนแล้ว หรือยังไม่ลง
	$qOpcard = mysql_query("SELECT * FROM opcard WHERE hn = '$hn'") or die("Query failed ".mysql_error());
	$rowOpcard = mysql_num_rows($qOpcard);
	if($rowOpcard==0){
		?>
		<p>ไม่พบข้อมูล HN: <?= $hn; ?> กรุณาตรวจสอบข้อมูลอีกครั้ง</p>
		<?php
		exit;
	}
	$opcard = mysql_fetch_object($qOpcard);

	$vnlab = 'EX10  ไตเทียม';
	$today = date("d-m-Y");
	$d = substr($today, 0, 2);
	$m = substr($today, 3, 2);
	$yr = substr($today, 6, 4) + 543;
	$thdatehn = $d . '-' . $m . '-' . $yr . $hn;
	$thidate = (date("Y") + 543) . date("-m-d H:i:s");

	// ตรวจดูว่าลงทะเบียนหรือยัง
	$query = "SELECT * FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC ";
	$result = mysql_query($query) or die("Query failed,opday");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if (!($row = mysql_fetch_object($result)))
			continue;
	}

	if (mysql_num_rows($result)) { //กรณีลงทะเบียนแล้ว
		
		$cHn = $row->hn;
		$cPtname = $row->ptname;
		$cPtright = $row->ptright;
		$tvn = $row->vn;
		
	} else {
		
		$cHn = $opcard->hn;
		$cYot = $opcard->yot;
		$cName = $opcard->name;
		$cSurname = $opcard->surname;
		$cPtname = $cYot . ' ' . $cName . '  ' . $cSurname;
		$cPtright = $opcard->ptright;
		$cGoup = $opcard->goup;
		$cCamp = $opcard->camp;
		$cNote = $opcard->note;
		$cIdcard = $opcard->idcard;

		//กำหนดค่า VN จาก runno table
		$query = "SELECT * FROM runno WHERE title = 'VN'";
		$result = mysql_query($query) or die("Query failed");
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
			if (!($row = mysql_fetch_object($result)))
				continue;
		}
		$nVn = $row->runno;
		$dVndate = $row->startday;
		$dVndate = substr($dVndate, 0, 10);
		$today = date("Y-m-d");
		//ยังไม่เปลี่ยนวันที่
		if ($today == $dVndate) {
			$nVn++;
			$thdatevn = $d . '-' . $m . '-' . $yr . $nVn;
			$query = "UPDATE runno SET runno = $nVn WHERE title='VN'";
			$result = mysql_query($query) or die("Query failed");
			$tvn = $nVn;
			//	        print "ได้หมายเลข VN = $nVn<br>";
		}
		//วันใหม่
		if ($today <> $dVndate) {
			$nVn = 1;
			$nPhaok = 'p';
			$thdatevn = $d . '-' . $m . '-' . $yr . $nVn;
			$query = "UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
			$result = mysql_query($query) or die("Query failed");
			$tvn = $nVn;
			// print "วันใหม่  เริ่ม VN = $nVn <br>";
		}
		//ลงทะเบียนใน opday table
		$nPhaok = 'p';
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,
		ptright,goup,camp,note,toborow,phaok,idcard,officer)VALUES('$thidate','$thdatehn','$cHn','$nVn',
		'$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$cNote','$vnlab','$nPhaok','$cIdcard','" . $_SESSION["sOfficer"] . "');";
		$result = mysql_query($query) or die("Query failed,cannot insert into opday");
		
	}

	if ($_GET['servicd'] == "1") { // คิดค่าบริการ 50 บาท
		$check = "select * from depart where hn = '" . $cHn . "' and  detail = '(55020/55021 ค่าบริการผู้ป่วยนอก)' and date like '" . (date("Y") + 543) . date("-m-d") . "%' ";
		$resultcheck = mysql_query($check);
		$cal = mysql_num_rows($resultcheck);
		if ($cal == 0) {
			//runno  for chktranx
			$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
			$result = mysql_query($query)
				or die("Query failed");

			for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}

				if (!($row = mysql_fetch_object($result)))
					continue;
			}

			$nRunno = $row->runno;
			$nRunno++;

			$query = "UPDATE runno SET runno = $nRunno WHERE title='depart'";
			$result = mysql_query($query) or die("Query failed");

			$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('" . $nRunno . "','" . $thidate . "','" . $cPtname . "','" . $cHn . "','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0','','" . $_SESSION["sOfficer"] . "','0','" . $tvn . "','" . $cPtright . "');";
			$result = mysql_query($query);
			$idno = mysql_insert_id();

			$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('" . $thidate . "','" . $cHn . "','','" . $cPtname . "','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50','0','OTHER','OTHER','" . $idno . "','" . $cPtright . "');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");

			$query = "UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '" . $tvn . "' ";
			$result = mysql_query($query) or die("Query failed,update opday");
		}
	}

	//ตรวจดูว่าลงทะเบียนทันตกรรมหรือยังใน Opday2
	//EX10 ไตเทียม
	$query = "SELECT count(hn) FROM opday2 WHERE thdatehn = '$thdatehn' AND (left(toborow,4) = 'EX10'  ) Order by row_id DESC limit 1 ";
	$result = Mysql_Query($query);
	list($count_opday2) = Mysql_fetch_row($result);
	if ($count_opday2 == 0) {
		$query = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,
		ptright,goup,camp,note,toborow,phaok,idcard,officer)VALUES('$thidate','$thdatehn','$cHn','$tvn',
		'$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$cNote','$vnlab','$nPhaok',' $cIdcard','" . $_SESSION["sOfficer"] . "');";
		$result = mysql_query($query) or die("Query failed,cannot insert into opday");
	}

	//runno  for chktranx
	$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
	$result = mysql_query($query)
		or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if (!($row = mysql_fetch_object($result)))
			continue;
	}

	$nRunno = $row->runno;
	$nRunno++;

	$query = "UPDATE runno SET runno = $nRunno WHERE title='depart'";
	$result = mysql_query($query) or die("Query failed");

	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=erask.php?cHn=$cHn&tvn=$tvn\">";

}else{
	?>
	<p><b>กรุณาใส่ HN</b></p>
	<?php
}
?>