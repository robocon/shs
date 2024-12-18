<?php
include 'connect.php';
include 'bootstrap.php';
if ($_REQUEST['do'] == 'edit') {

	$row = sprintf("%s", $_POST['row']);
	$owner = sprintf("%s", $_REQUEST['programmer']);
	$jobType = sprintf("%s", $_POST['jobtype']);
	$software_type = sprintf("%s", $_POST['software_type']);
	$asset_type = sprintf("%s", $_POST['asset_type']);
	$asset_name = sprintf("%s", $_POST['asset_name']);
	$asset_serial = sprintf("%s", $_POST['asset_serial']);
	$head = sprintf("%s", $_POST['head']);
	$detail = sprintf("%s", $_POST['detail']);

	// ลบ tag ทั้งหมดออกเหลือแค่ img กับ <br>
	$detail = strip_tags(htmlspecialchars_decode($_POST["detail"]),'<img><br>');
	$detail = htmlspecialchars($detail, ENT_QUOTES);

	$update = "UPDATE `com_support` SET 
	`head` = '$head',
	`detail` = '$detail',
	`status`='a', 
	`programmer`='$owner', 
	`software_type`='$software_type',
	`asset_type` = '$asset_type',
	`asset_name` = '$asset_name',
	`asset_serial` = '$asset_serial'
	WHERE `row`='$row' ";
	$query = mysql_query($update);
	if ($query) {
		$sToken = "bXrbN0yds9GRmkTEX6ZLsWZh57aqmRlPbT8oBGo6MpS"; // real
		$sMessage = "เรื่อง: $head\nกำลังดำเนินการโดย $owner";
		send_line_noti($sMessage, $sToken);

		$tokenTwo = "Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ";
		send_line_noti($sMessage, $tokenTwo);

		$_SESSION['supportMessage'] = "เลือกผู้รับผิดชอบงานเรียบร้อยแล้ว";
	} else {
		$_SESSION['supportMessage'] = "ไม่สามารถเลือกผู้รับผิดชอบงานได้";
	}

	header("Location: com_support.php");
	exit;
}
?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- อัพเดท เวอร์ชั่นใหม่ๆ ได้ที่ https://github.com/sweetalert2/sweetalert2/releases -->
<script src="js/sweetalert2.all.min.js"></script>
<style type="text/css">
	.forntsarabun {font-family: "TH SarabunPSK";font-size: 22px;}
	.style2 {font-family: "TH SarabunPSK";font-size: 24px;font-weight: bold;color: #FFFFFF;}
	#admForm tr td{padding: 4px;}
	label:hover{cursor: pointer;}
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
		<table align="center" cellpadding="0" cellspacing="0" class="forntsarabun" id="admForm" style="background-color: #66CCCC;">
			<tr>
				<td colspan="4" bgcolor="#249393"><span class="style2">ระบบแจ้ง เพิ่มแก้ไข/ปรับปรุง เพิ่มเติม โปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี</span></td>
			</tr>
			<tr>
				<td align="right"><strong>แผนก :&nbsp;</strong></td>
				<td colspan="4"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
					<select name="depart" id="depart" class="forntsarabun">
						<option value="0">==&gt;&nbsp;เลือกแผนก&nbsp;&lt;==</option>
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
				<td align="right"><strong>ประเภทงาน :&nbsp;</strong></td>
				<td colspan="3">
					<?php 
					$jobType = array('hardware'=>'งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย', 'software'=>'งานแก้ไขโปรแกรม/พัฒนาระบบสารสนเทศ');
					?>
					<select name="jobtype" id="jobtype" class="forntsarabun" onchange="jobTypeChange(this.value)">
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
				<td align="right"><strong>หัวข้อ : </strong></td>
				<td colspan="3"><input name="head" id="head" type="text" class="forntsarabun" value="<?= $dbarr['head']; ?>" size="60"></td>
			</tr>
			<tr>
				<td align="right"><strong>วัน-เวลาที่แจ้ง :&nbsp;</strong></td>
				<td colspan="3"> <p><?=$dbarr['date'];?></p></td>
			</tr>
			<tr>
				<td valign="top" align="right"><strong>รายละเอียด :&nbsp;</strong></td>
				<td colspan="3">
					<script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
					<script>
						tinymce.init({
							selector: 'textarea#detail',
							toolbar: false, // ปิดใช้งาน toolbar
							menubar: false, // ปิดใช้งาน menubar
							forced_root_block : '', // ไม่ต้องใช้ tag p เมื่อเริ่มต้นใช้งาน tinymce
							paste_as_text: true,
							width: 1024
						});
					</script>
					<textarea name="detail" id="detail" cols="100" rows="10" class="forntsarabun"><?=htmlspecialchars_decode($dbarr['detail']);?></textarea>
				</td>
			</tr>
			<tr>
				<td align="right"><strong>ผู้แจ้ง :&nbsp;</strong></td>
				<td width="160"><input name="user" type="text" class="forntsarabun" value="<?= $dbarr['user']; ?>" size="20" readonly></td>
				<td width="96" align="right"><strong>โทรศัพท์ภายใน</strong></td>
				<td width="520"><input name="phone" type="text" class="forntsarabun" value="<?= $dbarr['phone']; ?>" size="20" readonly></td>
			</tr>
			<tr>
				<td align="right"><strong>ผู้รับผิดชอบ :&nbsp;</strong></td>
				<td colspan="3">
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
			$swTypeDisplay1='';
			if($dbarr['jobtype']=='software'){
				$swTypeDisplay1='display:none;';
			}

			$softwareTypeList = array(
				'software_type1' => 'แก้ไขโปรแกรม/ข้อมูล',
				'software_type2' => 'พัฒนาโปรแกรม'
			)
			?>
			<tr style="<?=$swTypeDisplay;?>" id="swTypeContain">
				<td><b>ประเภทงานพัฒนา :&nbsp;</b></td>
				<td colspan="3">
				<?php 
				foreach ($softwareTypeList as $swKey => $swType) {
					?>
					<input type="radio" name="software_type" id="<?=$swKey;?>" value="<?=$swType;?>">&nbsp;<label for="<?=$swKey;?>"><?=$swType;?></label>
					<?php
				}
				?>
				</td>
			</tr>
			<tr style="<?=$swTypeDisplay1;?>" id="swTypeContain1">
				<td valign="top" align="right"><strong>ประเภทอุปกรณ์ :&nbsp;</strong></td>
				<td colspan="3">
					<?php 
					$assetType = array('pc'=>'เครื่องคอมพิวเตอร์', 'monitor'=>'จอคอมพิวเตอร์', 'notebook'=>'โน๊ตบุ๊ค', 'printer'=>'เครื่องพิมพ์');
					?>
					<select name="asset_type" id="asset_type" class="forntsarabun">
						<option value="">==&gt;&nbsp;เลือกประเภท&nbsp;&lt;==</option>
						<?php 
						foreach ($assetType as $type => $typeValue) {
							$selected = ($dbarr['asset_type'] == $type) ? 'selected="selected"' : '' ;
							?>
							<option value="<?=$type;?>" <?=$selected;?> ><?=$typeValue;?></option>
							<?php
						}
						?>
					</select>
					<span style='margin-left:20px;'>
						<strong>ชื่อเครื่อง :</strong>  <input name="asset_name" id="asset_name" type="text" class="forntsarabun" value="<?= $dbarr['asset_name']; ?>" size="35">
					</span>
					<span style='margin-left:20px;'>
						<strong>Serial Number :</strong>  <input name="asset_serial" id="asset_serial" type="text" class="forntsarabun" value="<?= $dbarr['asset_serial']; ?>" size="30">
					</span>	
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">
					<input name="B1" type="submit" class="forntsarabun" value="ตกลง">
					<input type="hidden" name="row" value="<?= $row; ?>">
					<input name="B2" type="reset" class="forntsarabun" value="ลบทิ้ง">
				</td>
			</tr>
		</table>
	</form>
</body>
<script type="text/javascript">
	function jobTypeChange(v){
		if(v==='software'){
			document.getElementById('swTypeContain').style.display = '';
			document.getElementById('swTypeContain1').style.display = 'none';

			// ล้างค่า hardware
			document.getElementById('asset_type').value = '';
			document.getElementById('asset_name').value = '';
			document.getElementById('asset_serial').value = '';
		}else{
			document.getElementById('swTypeContain').style.display = 'none';
			document.getElementById('swTypeContain1').style.display = '';

			// ล้างค่า checkbox
			document.getElementById('software_type1').checked = false;
			document.getElementById('software_type2').checked = false;
		}
	}
	function fncSubmit() {
		if (document.edit.programmer.selectedIndex == 0) {
			alert('กรุณาเลือกผู้รับผิดชอบ');
			document.edit.programmer.focus();
			return false;
		}
		document.edit.submit();
	}
</script>