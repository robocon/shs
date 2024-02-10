<?php
session_start();
include("connect.php");
if ($_REQUEST['do'] == 'edit') {
	$row = $_POST['row'];
	$owner = $_REQUEST['programmer'];
	$head = $_REQUEST['head'];
	$update = "UPDATE com_support SET status='a', programmer='$owner' Where row='$row' ";
	$query = mysql_query($update);
	if ($query) {

		$sToken = "bXrbN0yds9GRmkTEX6ZLsWZh57aqmRlPbT8oBGo6MpS"; // real
		$sMessage = "เรื่อง: $head\nกำลังดำเนินการโดย $owner";
		$chOne = curl_init();
		curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
		curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($chOne, CURLOPT_POST, 1);
		curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
		$headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
		curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($chOne);
		curl_close($chOne);

		$_SESSION['supportMessage'] = "เลือกผู้รับผิดชอบงานเรียบร้อยแล้ว";
		header("Location: com_support.php");
	} else {

		$_SESSION['supportMessage'] = "ไม่สามารถเลือกผู้รับผิดชอบงานได้";
		header("Location: com_support.php");
	}
	exit;
}
?>
<style type="text/css">
	.forntsarabun {
		font-family: "TH SarabunPSK";
		font-size: 22px;
	}

	.style2 {
		font-family: "TH SarabunPSK";
		font-size: 24px;
		font-weight: bold;
		color: #FFFFFF;
	}
	#admForm tr td{
		padding-bottom: 4px;
	}
	label:hover{
		cursor: pointer;
	}
</style>

<body bgcolor="#FFFFFF">

	<a target="_self"  href="com_support.php" class="forntsarabun" style="text-decoration:none;">&lt;&lt;&nbsp;กลับหน้าเมนูแจ้งซ่อม</a>
	<hr>

	<?php
	$row = sprintf("%s", $_GET['row']);
	$query = "SELECT * FROM `com_support` WHERE `row` ='$row'";
	$result = mysql_query($query) or die("Query failed ".mysql_error());
	$dbarr = mysql_fetch_array($result);
	?>
	<form method="POST" action="?do=edit" onSubmit="JavaScript:return fncSubmit();" name="edit">
		<table align="center" cellpadding="0" cellspacing="0" class="forntsarabun" id="admForm">
			<tr>
				<td height="48" colspan="4" bgcolor="#66CC99"><span class="style2">ระบบแจ้ง เพิ่มแก้ไข/ปรับปรุง เพิ่มเติม โปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี</span></td>
			</tr>
			<tr>
				<td width="121" bgcolor="#66CCCC"><strong>แผนก</strong></td>
				<td colspan="4" bgcolor="#66CCCC"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
					<select name="depart" id="depart" class="forntsarabun">
						<option value="0">เลือกแผนก</option>
						<?
						$sql = "select  *  from   departments where status='y' order by id asc";
						$result = mysql_query($sql);
						while ($arr = mysql_fetch_array($result)) {
							if ($dbarr['depart'] == $arr['name']) {
								echo '<option value="' . $arr['name'] . '" selected>' . $arr['name'] . ' </option>';
							} else {
								echo '<option value="' . $arr['name'] . '">' . $arr['name'] . ' </option>';
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#66CCCC"><strong>ประเภทงาน</strong></td>
				<td colspan="3" bgcolor="#66CCCC">
					<?php 
					$jobType = array('hardware'=>'งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย', 'software'=>'งานแก้ไขโปรแกรม/พัฒนาระบบสารสนเทศ');
					?>
					<select name="jobtype" id="jobtype" class="forntsarabun" onchange="jobTypeChange(this.value)">
						<option value="0">เลือกงาน</option>
						<?php 
						foreach ($jobType as $type => $typeValue) {
							$selected = ($dbarr['jobtype'] == $type) ? 'selected="selected"' : '' ;
							?>
							<option value="<?=$type;?>" <?=$selected;?> ><?=$typeValue;?></option>
							<?php
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#66CCCC"><strong>หัวข้อ</strong></td>
				<td colspan="3" bgcolor="#66CCCC"><input name="head" type="text" class="forntsarabun" value="<?= $dbarr['head']; ?>" size="60" readonly></td>
			</tr>
			<tr>
				<td valign="top" bgcolor="#66CCCC"><strong>รายละเอียด</strong></td>
				<td colspan="3" bgcolor="#66CCCC"><textarea name="detail" cols="100" rows="10" readonly class="forntsarabun"><?= $dbarr['detail']; ?></textarea></td>
			</tr>
			<tr>
				<td bgcolor="#66CCCC"><strong>ผู้แจ้ง</strong></td>
				<td width="160" bgcolor="#66CCCC"><input name="user" type="text" class="forntsarabun" value="<?= $dbarr['user']; ?>" size="20" readonly></td>
				<td width="96" bgcolor="#66CCCC">โทรศัพท์ภายใน</td>
				<td width="520" bgcolor="#66CCCC"><input name="phone" type="text" class="forntsarabun" value="<?= $dbarr['phone']; ?>" size="20" readonly></td>
			</tr>
			<tr>
				<td bgcolor="#66CCCC"><strong>ผู้รับผิดชอบ</strong></td>
				<td colspan="3" bgcolor="#66CCCC">
					<select name="programmer" class="forntsarabun">
						<option value="0" selected>==กรุณาเลือก==</option>
						<option value="เทวิน  ศรีแก้ว">เทวิน ศรีแก้ว</option>
						<option value="กฤษณะศักดิ์  กันธรส">กฤษณะศักดิ์ กันธรส</option>
						<option value="ชาญวิทย์  ตากาบุตร">ชาญวิทย์ ตากาบุตร</option>
						<option value="จักรพันธ์  รุ่งเรืองศรี">จักรพันธ์ รุ่งเรืองศรี</option>
						<option value="ฐานพัฒน์  นิลคำ">ฐานพัฒน์ นิลคำ</option>
					</select>
				</td>
			</tr>
			<?php 
			$swTypeDisplay='';
			if($dbarr['jobtype']=='hardware'){
				$swTypeDisplay='display:none;';
			}
			?>
			<tr style="<?=$swTypeDisplay;?>" id="swTypeContain">
				<td bgcolor="#66CCCC"><b>ประเภทงานพัฒนา</b></td>
				<td colspan="3" bgcolor="#66CCCC">
					<input type="radio" name="software_type" id="software_type1" value="แก้ไขโปรแกรม/ข้อมูล"><label for="software_type1">แก้ไขโปรแกรม/ข้อมูล</label>
					<input type="radio" name="software_type" id="software_type2" value="พัฒนาโปรแกรม"><label for="software_type2">พัฒนาโปรแกรม</label>
				</td>
			</tr>
			<tr>
				<td bgcolor="#66CC99">&nbsp;</td>
				<td colspan="3" bgcolor="#66CC99">
					<input name="B1" type="submit" class="forntsarabun" value="ตกลง">
					<input type="hidden" name="row" value="<?= $row; ?>">
					<input name="B2" type="reset" class="forntsarabun" value="ลบทิ้ง">
			</tr>
		</table>
	</form>
</body>
<script type="text/javascript">
	function jobTypeChange(v){
		if(v==='software'){
			document.getElementById('swTypeContain').style.display = '';
		}else{
			document.getElementById('swTypeContain').style.display = 'none';
		}
		
	}
	function fncSubmit() {
		
		let radioStatus = false;
		const radioButtons = document.querySelectorAll('input[name="software_type"]');
		for (const radioButton of radioButtons) {
			if (radioButton.checked) {
				radioStatus = true;
			}
		}

		if (document.edit.programmer.selectedIndex == 0) {
			alert('กรุณาเลือกผู้รับผิดชอบ');
			document.edit.programmer.focus();
			return false;
		}else if(radioStatus===false){
			alert('กรุณาเลือก ประเภทงานพัฒนา')
			return false;
		}

		document.edit.submit();
	}
</script>