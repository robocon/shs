<?php
session_start();
require_once 'bootstrap.php';
?>
<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>
<?php

if ($_REQUEST['do'] == 'edit') {

	function DateDiff($strDate1, $strDate2)
	{
		return (strtotime($strDate2) - strtotime($strDate1)) / (60 * 60 * 24); // 1 day = 60*60*24
	}

	$thidate = (date("Y") + 543) . date("-m-d H:i:s");
	$row = $_POST['row'];
	$user = $_POST['user'];
	$p_edit = $_POST['p_edit'];
	$programmer = $_POST['programmer'];

	$date = substr($_POST['date'], 0, 10);  //วันที่แจ้ง
	list($y, $m, $d) = explode("-", $date);
	$y = $y - 543;
	$date1 = "$y-$m-$d";

	$dateend = substr($thidate, 0, 10);  //วันที่เสร็จ
	list($yy, $mm, $dd) = explode("-", $dateend);
	$yy = $yy - 543;
	$date2 = "$yy-$mm-$dd";

	$hold = DateDiff("$date1", "$date2");

	$jobType = sprintf("%s", $_POST['jobtype']);
	$software_type = '';
	if($jobType==='software' && !empty($_POST['software_type'])){
		$software_type = sprintf("%s", $_POST['software_type']);
	}
	
	$update = "UPDATE com_support SET `status`='n', `p_edit`='$p_edit' ,`dateend`='$thidate' , `programmer`='$programmer', hold='$hold', `software_type`='$software_type' WHERE `row`='$row' ";
	$query = mysql_query($update);
	if ($query) {

		$sToken = "bXrbN0yds9GRmkTEX6ZLsWZh57aqmRlPbT8oBGo6MpS"; // test
		$sMessage = "สรุปปิดงาน\nลำดับแจ้ง: $row\nเรื่อง: $head\nผู้แจ้ง: $user\nดำเนินการเรียบร้อยโดย $programmer";
		sendLineNotify($sMessage, $sToken);

		$tokenTwo = "Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ";
		sendLineNotify($sMessage, $tokenTwo);

		$_SESSION['supportMessage'] = "บันทึกข้อมูลเรียบร้อยแล้ว";
		echo "<script>
				$(document).ready(function() {
				Swal.fire({
					title: 'บันทึกข้อมูล',
					text: 'ระบบบันทึกข้อมูลเรียบร้อย !',
					icon: 'success',
					timer: 5000,
					showConfirmButton: false
					});
				})
			</script>";
		header("refresh:2; url=com_support.php");
	} else {

		$_SESSION['supportMessage'] = "ไม่สามารถเพิ่มข้อมูลได้";
		echo "<script>
				$(document).ready(function() {
				Swal.fire({
					title: 'ผิดพลาด',
					text: 'ระบบบันทึกข้อมูลไม่สำเร็จ !',
					icon: 'error',
					timer: 5000,
					showConfirmButton: false
					});
				})
			</script>";
		header("refresh:2; url=com_support.php?row=$row");
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
		color: #FFFFFF;
	}
	input[readonly], textarea[readonly] {
		background-color: #e8e8e8;
	}
	label:hover{
		cursor: pointer;
	}
</style>

<body bgcolor="#FFFFFF">
	<script language="javascript">
		function fncSubmit() {
			if (document.edit.p_edit.value == "") {
				alert('ใส่ผลการดำเนินงาน');
				document.edit.p_edit.focus();
				return false;
			}

			document.edit.submit();
		}
	</script>
	<?
	$row = $_GET['row'];
	$query = "SELECT * FROM `com_support` WHERE `row` ='$row'";
	$result = mysql_query($query) or die("Query failed");
	$dbarr = mysql_fetch_array($result);
	?>
	<a target="_self" href="com_support.php" class="forntsarabun" style="text-decoration:none;">&lt;&lt;&nbsp;กลับหน้าเมนูแจ้งซ่อม</a>
	<hr>
	<form method="POST" action="?do=edit" onSubmit="JavaScript:return fncSubmit();" name="edit">
		<input type="hidden" name="date" value="<?= $dbarr["date"]; ?>">
		<table align="center" cellpadding="5" cellspacing="0" class="forntsarabun">
			<tr>
				<td height="48" colspan="4" bgcolor="#CC6699"><span class="style2"><strong>ระบบแจ้ง เพิ่มแก้ไข/ปรับปรุง เพิ่มเติม โปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></span></td>
			</tr>
			<tr>
				<td bgcolor="#FF99CC"><strong>แผนก</strong></td>
				<td colspan="3" bgcolor="#FF99CC">
					<select name="depart" id="depart" class="forntsarabun">
						<option value="0">==&gt;&nbsp;เลือกแผนก&nbsp;&lt;==</option>
						<?
						$sql = "select * from `departments` where `status`='y' order by `id` asc";
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
				<td bgcolor="#FF99CC"><strong>ประเภทงาน</strong></td>
				<td colspan="3" bgcolor="#FF99CC">
					<?php 
					$jobType = array('hardware'=>'งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย', 'software'=>'งานแก้ไขโปรแกรม/พัฒนาระบบสารสนเทศ');
					?>
					<select name="jobtype" id="jobtype" class="forntsarabun">
						<option value="0">==&gt;&nbsp;เลือกงาน&nbsp;&lt;==</option>
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
				<td width="112" bgcolor="#FF99CC"><strong>หัวข้อ</strong></td>
				<td colspan="3" bgcolor="#FF99CC"><input name="head" type="text" class="forntsarabun" value="<?= $dbarr['head']; ?>" size="40" readonly></td>
			</tr>
			<tr>
				<td valign="top" bgcolor="#FF99CC"><strong>รายละเอียด</strong></td>
				<td colspan="3" bgcolor="#FF99CC">
					<script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
					<script>
						tinymce.init({
							selector: 'textarea#detail',
							toolbar: false, // ปิดใช้งาน toolbar
							menubar: false, // ปิดใช้งาน menubar
							forced_root_block : '' // ไม่ต้องใช้ tag p เมื่อเริ่มต้นใช้งาน tinymce
						});
					</script>
					<textarea id="detail" name="detail" cols="100" rows="10" readonly class="forntsarabun"><?= $dbarr['detail']; ?></textarea>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FF99CC"><strong>ผู้แจ้ง</strong></td>
				<td width="160" bgcolor="#FF99CC"><input name="user" type="text" class="forntsarabun" value="<?= $dbarr['user']; ?>" size="20" readonly></td>
				<td width="102" bgcolor="#FF99CC">โทรศัพท์ภายใน</td>
				<td width="553" bgcolor="#FF99CC"><input name="phone" type="text" class="forntsarabun" value="<?= $dbarr['phone']; ?>" size="10" readonly><span style="margin-left:10px;">วันที่แจ้ง : <?= $dbarr['date']; ?></span></td>
			</tr>
			<tr>
				<td bgcolor="#FF99CC"><strong>ผู้รับผิดชอบ</strong></td>
				<td colspan="3" bgcolor="#FF99CC">
					<?php 
					$programmerList = array('เทวิน  ศรีแก้ว','กฤษณะศักดิ์  กันธรส','ชาญวิทย์  ตากาบุตร','จักรพันธ์  รุ่งเรืองศรี','ฐานพัฒน์  นิลคำ');
					?>
					<select name="programmer" class="forntsarabun">
						<option value="0" selected>==&gt;&nbsp;กรุณาเลือก&nbsp;&lt;==</option>
						<?php 
						foreach ($programmerList as $pg) { 
							$selected = $pg===$dbarr['programmer'] ? 'selected="selected"' : '' ;
							?>
							<option value="<?=$pg;?>" <?=$selected;?> ><?=$pg;?></option>
							<?php
						}
						?>
					</select>
				</td>
			</tr>
			<?php
			$swTypeDisplay='';
			if($dbarr['jobtype']=='hardware'){
				$swTypeDisplay='display:none;';
			}

			$softwareTypeList = array(
				'software_type1' => 'แก้ไขโปรแกรม/ข้อมูล',
				'software_type2' => 'พัฒนาโปรแกรม'
			)
			?>
			<tr style="<?=$swTypeDisplay;?>" id="swTypeContain">
				<td bgcolor="#FF99CC"><b>ประเภทงานพัฒนา</b></td>
				<td colspan="3" bgcolor="#FF99CC">
					<?php 
					foreach ($softwareTypeList as $swKey => $swType) {
						$selected = $swType===$dbarr['software_type'] ? 'checked="checked"' : '' ;
						?>
						<input type="radio" name="software_type" id="<?=$swKey;?>" value="<?=$swType;?>" <?=$selected;?> ><label for="<?=$swKey;?>"><?=$swType;?></label>
						<?php
					}
					?>
				</td>
			</tr>
			<tr>
				<td valign="top" bgcolor="#FF99CC"><strong>ผลการดำเนินงาน</strong></td>
				<td colspan="3" bgcolor="#FF99CC"><textarea name="p_edit" cols="100" rows="5" class="forntsarabun"></textarea></td>
			</tr>
			<tr>
				<td bgcolor="#CC6699">&nbsp;</td>
				<td colspan="3" bgcolor="#CC6699"><input name="B1" type="submit" class="forntsarabun" value="ตกลง">
					<input type="hidden" name="row" value="<?= $row; ?>">
					<input name="B2" type="reset" class="forntsarabun" value="ลบทิ้ง">
				</td>
			</tr>
		</table>
	</form>
</body>