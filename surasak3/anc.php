<?php 

include 'anc_menu.php';

?>

<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath1">
	<table width="50%" border="1" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">แฟ้ม : ANC</td>
		</tr>
		<tr>
			<td height="41" align="center">ค้นหาตาม HN : 
			<input type="text" name="chn" id="chn" /></td>
		</tr>
		<tr>
			<td height="37" align="center">
			<input name="ok" type="submit" value="ค้นหา" /></td>
		</tr>
	</table>
</form>

<?php 
if( $_SESSION['msg'] ){
	echo '<div><b>'.$_SESSION['msg'].'</b></div>';
	$_SESSION['msg'] = false;
}
?>

<?php 

$chn = $_POST['chn'];
if( isset($chn) ){

	$sql = "select * from opcard where hn='$chn'";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	if($result['name']==""){
		echo "ไม่พบผู้ป่วย HN นี้คะ";	
	}else{
		echo "<table border=1><tr><th>HN</th><th>ชื่อ-สกุล</th><th>วันที่มารับบริการ</th></tr>";
		$sql3 = "select * from opday where hn = '$chn' order by thidate desc limit 50";
		$rows3 = mysql_query($sql3);
		while($result3 = mysql_fetch_array($rows3)){
			$d = substr($result3['thidate'],8,2);
			$m = substr($result3['thidate'],5,2);
			$y = substr($result3['thidate'],0,4);
			$t = substr($result3['thidate'],11);
		?>
		<tr>
			<td><?=$result3['hn']?></td>
			<td><?=$result3['ptname']?></td>
			<td><a href="anc.php?show=<?=$result3['row_id']?>"><?="$d-$m-$y $t"?></a></td>
		</tr>
		<?php
		}
		echo "</table>";
	}

}elseif(isset($_POST['conbtn'])){

	// บันทึกข้อมูล
	$thidate = date("YmdHis");

	$hn = $_POST['nHn'];
	$seq = $_POST['seq'];
	$date_serve = $_POST['dserv'];
	$gravida = $_POST['grav'];
	$ancno = $_POST['ancno'];
	$ga = $_POST['ga'];
	$ancres = $_POST['ancres'];
	$cid = $_POST['idcard'];
	$doctor = $_POST['doctor'];

	$doctorcode = '00000';
	$q = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` = '$doctor' ");
	if ( mysql_num_rows($q) > 0 ) {
		$item = mysql_fetch_assoc($q);
		$doctorcode = $item['doctorcode'];
	}
	
	$provider = $seq.$doctorcode;

	$q = mysql_query("SELECT * FROM `anc` WHERE `pid` = '$hn' and `seq` = '$seq' ") or die(mysql_error());
	$test_row = mysql_num_rows($q);

	if( $test_row > 0 ){ 

		$item = mysql_fetch_assoc($q);
		$id = $item['row_id'];

		// update 
		$sql = "UPDATE `anc` SET `pid`='$hn', 
		`seq`='$seq', 
		`date_serv`='$date_serve', 
		`gravida`='$gravida', 
		`ancno`='$ancno', 
		`ga`='$ga', 
		`ancres`='$ancres', 
		`aplace`='11512', 
		`provider`='$provider', 
		`d_update`='$thidate', 
		`cid`='$cid' 
		WHERE (`row_id`='$id');";
		$result = mysql_query($sql) or die(mysql_error());

	}else{	
		
		$sql = "INSERT INTO `anc` (
		`row_id`, `pid`, `seq`, `date_serv`, `gravida`, `ancno`, `ga`, `ancres`, `aplace`, `provider`, `d_update`, `cid`
		) VALUES (
		NULL, '$hn', '$seq', '$date_serve', '$gravida', '$ancno', '$ga', '$ancres', '11512', '$provider', '$thidate', '$cid'
		);";
		$result = mysql_query($sql) or die(mysql_error());
	}
	
	if($result){

		$_SESSION['msg'] = 'บันทึกข้อมูลเรียบร้อยแล้ว';
		header('Location: anc.php');
	}

}elseif(isset($_GET['show'])){

	$sql = "select * from opday where row_id = '".$_GET['show']."' ";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	
	$sql2 = "select * from opcard where hn='".$result['hn']."' ";
	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_array($rows2);
	?>
	
	<h3>กรุณากรอกข้อมูลในช่องด้านล่าง แฟ้ม anc</h3>
	<form action="anc.php" method="post" name="formdeath2">

		<table width="100%" border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse">
		<tr>
			<td colspan="2">
			HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
			ชื่อ : <?=$result['ptname']?> <br />
			เลขที่บัตรปชช. : <input name="idcard" type="text" value="<?=$result2['idcard']?>" readonly="readonly"/>
			</td>
		</tr>
			<?php 
			$d = substr($result['thidate'],8,2);
			$m = substr($result['thidate'],5,2);
			$y = substr($result['thidate'],0,4)-543;
			$seq = "$y$m$d".sprintf("%03d",$result['vn']);
			?>
		<tr>
			<td>ลำดับที่ :</td>
			<td><input name="seq" type="text" id="seq" value="<?=$seq?>" readonly="readonly"/></td>
		</tr>
		<tr>
			<td width="23%">วันที่รับบริการ :</td>
			<td width="77%"><input name="dserv" type="text" id="dserv" value="<?="$y$m$d"?>" readonly="readonly"/></td>
		</tr>
		<tr>
			<td>ครรภ์ที่ :</td>
			<td><input type="text" name="grav" id="grav" />
			(ไม่ใส่ 0 นำหน้าเช่น 1,2,10)</td>
		</tr>
		<tr>
			<td>ANC ช่วงที่ :</td>
			<td>
				<select name="ancno">
					<option value="1">การนัดช่วงที่ 1 เมื่ออายุครรภ์ &lt;12 สัปดาห์</option>
					<option value="1">การนัดช่วงที่ 2 เมื่ออายุครรภ์ &ge;12 และ &lt;18 สัปดาห์</option>
					<option value="1">การนัดช่วงที่ 3 เมื่ออายุครรภ์ &ge;18 และ &lt;26 สัปดาห์</option>
					<option value="1">การนัดช่วงที่ 4 เมื่ออายุครรภ์ &ge;26 และ &lt;32 สัปดาห์</option>
					<option value="1">การนัดช่วงที่ 5 เมื่ออายุครรภ์ &ge;32 และ &lt;38 สัปดาห์</option>
				</select><br>
				* หมายเหตุ : กรณีอายุครรภ์ไม่อยู่ในช่วงของการฝากครรภ์ให้บันทึกเฉพาะอายุครรภ์ บันทึกช่วงครรภ์ กรณีมาตรงช่วงการนัดฝากครรภ์เท่านั้น
			</td>
		</tr>
		<tr>
			<td>อายุครรภ์ (สัปดาห์) : </td>
			<td><input type="text" name="ga" id="ga" />
			(จำนวนเต็ม)</td>
		</tr>
		<tr>
			<td>ผลการตรวจ : </td>
			<td>
				<input type="radio" name="ancres" id="ancres1" value="1" /> <label class="radio" for="ancres1">ปกติ</label> 
				<input type="radio" name="ancres" id="ancres2" value="2" /> <label class="radio" for="ancres2">ผิดปกติ</label> 
				<input type="radio" name="ancres" id="ancres9" value="9" /> <label class="radio" for="ancres9">ไม่ทราบ</label> 
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input name="conbtn" type="submit" value=" บันทึกข้อมูล " />
				<input type="hidden" name="doctor" value="<?=$result['doctor'];?>">
			</td>
		</tr>
		</table>
	</form>
	<?php
}
?>