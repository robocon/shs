<?php
session_start();
include 'connect.inc';
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

if (!isset($sOfficer)) {
	echo "กรุณาเข้าสู่ระบบใหม่ <br>";
	echo "<a href='../sm3.php'>กดที่นี่เพื่อ Login อีกครั้ง</a>";
	exit();
}

$smenucode = sprintf("%s", $_SESSION['smenucode']);
$sOfficer = sprintf("%s", $_SESSION['sOfficer']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ระบบแจ้งซ่อมระบบคอมพิวเตอร์</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- อัพเดท เวอร์ชั่นใหม่ๆ ได้ที่ https://github.com/sweetalert2/sweetalert2/releases -->
	<script src="js/sweetalert2.all.min.js"></script>
	
</head>

<body bgcolor="#FFFFFF">

<style type="text/css">
*{font-family: "TH SarabunPSK";}
.forntsarabun { font-size: 20px;}
.style2 {font-size: 24px;font-weight: bold;color: #FFFFFF;}
a:link {text-decoration: none;}
a:visited {text-decoration: none;}
a:hover {text-decoration: none;}
a:active {text-decoration: none;}
ol {margin: 0;padding: 0;}
ol li {margin-bottom: 12px;}
#closeBtn:hover {
	cursor: pointer;
	text-decoration: underline;
}
.com_menu a:hover{
	text-decoration: underline;
}
#notiContent > ol{
	margin: 0 0.5em;
	padding: 0.5em 1em;
}
#notiBackground{
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	z-index: 8;
	background-color: white;
}
label:hover{cursor: pointer;}
#notiContainer{
	position:absolute;
	left:0;
	right:0;
	top:0;
	bottom:0;
	margin: auto;
	background-color:white;
	border:2px solid #997404;
	padding:4px;
	box-shadow: 4px 4px 8px;
	width: 720px;
	height: 480px;
	z-index: 9;
}
#f1 table td{
	padding-bottom: 8px;
    vertical-align: top;
}
</style>
<!-- POPUP ให้ผู้ใช้รับทราบ ก่อนการบันทึกข้อมูล -->
<div id="notiBackground"></div>
<div id="notiContainer">
	<div style="position:relative;">
		<div class="style2" style="background-color: #ffc107; padding: 2px 4px; color:#000000;">
			<span>คำแนะนำก่อนการแจ้งซ่อม/ปรับปรุงโปรแกรม</span>
			<span style="float:right;" onclick="closeBtn()" id="closeBtn">[ กดปิด/Esc เพื่อปิด ]</span>
		</div>
		<div class="forntsarabun" id="notiContent">
			<ol>
				<li>
					<div style="font-weight:bold;"><u style="color:red;">การแจ้งลบ</u> ใบตรวจโรคอิเล็กทรอนิกส์
					</div>
					<div>กรุณาให้เหตุผลในการลบข้อมูลด้วยทุกครั้ง</div>
				</li>
				<li>
					<div style="font-weight:bold;">หากต้องการ <u style="color:red;">ลบ/แก้ไข</u> ค่าใช้จ่าย</div>
					<div>กรุณาให้ข้อมูลที่ครบถ้วนเพื่อง่ายต่อการแก้ไข เช่น HN วันที่ รหัส ราคา และเหตุผลในการแก้ไข</div>
				</li>
				<li>
					<div style="font-weight:bold;">หากมีเจ้าหน้าที่มาปฏิบัติงานใหม่</div>
					<div>ขอความกรุณาแจ้ง ชื่อ-สกุล แผนกที่ปฏิบัติงาน ก่อน<u style="color:red;">อย่างน้อย 1วัน</u></div>
				</li>
			</ol>
			<p style="color:red;"><b>กรณีที่ ต้องการแจ้งแก้ไขปรับปรุงโปรแกรม<u>มากกว่า 1 เรื่อง ให้แยกใบงาน</u>เนื่องจากแต่ละงานใช้ระยะเวลาดำเนินการที่แตกต่างกัน ใบงานของท่านอาจจะค้างในระบบเป็นเวลานาน</b></p>
			<p style="text-align:center;">
				<label for="consent"><input type="checkbox" name="consent" id="consent"> ข้าพเจ้าอ่านและรับทราบคำแนะนำทุกประการ<br>หากไม่ปฏิบัติตามให้ถือว่าใบงานนั้นเป็นอันโมฆะและยินยอมให้ศูนย์คอมฯ ยกเลิกใบงานโดยไม่ต้องแจ้งล่วงหน้า</label>
			</p>
		</div>
	</div>
</div>
<!-- POPUP ให้ผู้ใช้รับทราบ ก่อนการบันทึกข้อมูล -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">แนบรูปภาพในใบแจ้งซ่อมได้แล้ว</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

		<div id="carouselExample" class="carousel carousel-dark slide">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/com_support/1.jpg" class="d-block w-100" alt="กดปุ่ม Print Screen บนคีย์บอร์ด">
					<div class="carousel-caption d-none d-md-block">
						<h5>กดปุ่ม Print Screen บนคีย์บอร์ด</h5>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/com_support/2.jpg" class="d-block w-100" alt="Control + V ในช่องรายละเอียดงาน">
					<div class="carousel-caption d-none d-md-block">
						<h5>Control + V ในช่องรายละเอียดงาน</h5>
					</div>
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>

      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
<script>
	
</script>

<div class="com_menu">
	<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_support.php'><font size='4' class='forntsarabun'>ดูข้อมูลแจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>
</div>
<hr>
<?php 
// แสดงเบอร์โทรล่าสุดที่ user คีย์เ้ข้าไป
$sql = "SELECT phone FROM com_support WHERE user1 = '$sOfficer' AND phone <> '' ORDER BY row DESC LIMIT 1 ";
$q = $dbi->query($sql);
$phone = '';
if($q->num_rows>0){
	$comSupport = $q->fetch_assoc();
	$phone = $comSupport['phone'];
}
?>
<form method="POST" action="comadd1.php" name="f1" id="f1">
	<input name="act" type="hidden" value="add">
	<table width="1053" align="center" bgcolor="#66CCCC" class="forntsarabun">
		<tr>
			<td height="48" colspan="4" bgcolor="#0099CC">
				<span class="style2">ระบบแจ้งซ่อมระบบคอมพิวเตอร์ปรับปรุงและพัฒนาโปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี</span>
			</td>
		</tr>
		<tr>
			<td width="146" align="right"><b>แผนก : </b></td>
			<td width="160">
				<select name="depart" id="depart" class="forntsarabun">
					<option value="0">==&gt;&nbsp;เลือกแผนก&nbsp;&lt;==</option>
					<?php 
					// เลือกแผนกให้อัตโนมัติ
					$sql = "select * from departments where status='y' order by id asc";
					$result = mysql_query($sql);
					while ($arr = mysql_fetch_array($result)) {
						$depMenu = explode(',', $arr['menucode']);
						$selected = (in_array($smenucode, $depMenu) === true) ? 'selected="selected"' : '';
						echo '<option value="' . $arr['name'] . '" ' . $selected . '>' . $arr['name'] . ' </option>';
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right"><b>ประเภทงาน : </b></td>
			<td colspan="3">
				<?php 
				$jobType = array('hardware'=>'งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย', 'software'=>'งานแก้ไขโปรแกรม/พัฒนาระบบสารสนเทศ');
				?>
				<select name="jobtype" id="jobtype" class="forntsarabun">
					<option value="0" selected>==&gt;&nbsp;เลือกงาน&nbsp;&lt;==</option>
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
			<td align="right"><b>เรื่องที่จะแจ้ง : </b></td>
			<td colspan="3">
				<input name="head" id="head" type="text" class="forntsarabun"size="60"><br>
				<font color="#FF0000">*** ระบุปัญหาหรืออาการที่ต้องการแก้ไขด้วยครับ ***</font>
			</td>
		</tr>
		<tr>
			<td valign="top" align="right"><b>รายละเอียดงาน : </b></td>
			<td colspan="3">
				<!-- https://www.tiny.cloud/get-tiny/custom-builds/ -->
				<!-- https://www.tiny.cloud/docs-4x/general-configuration-guide/basic-setup/#toolbarmenuconfiguration -->
				<script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
				<script>
					tinymce.init({
						selector: 'textarea#detail',
						toolbar: false, // ปิดใช้งาน toolbar
						menubar: false, // ปิดใช้งาน menubar
						forced_root_block : '' // ไม่ต้องใช้ tag p เมื่อเริ่มต้นใช้งาน tinymce
					});
				</script>
				<TEXTAREA NAME="detail" id="detail" COLS="100" ROWS="10" class="forntsarabun"></TEXTAREA>
			</td>
		</tr>
		<tr>
			<td valign="top" align="right"><b>หมายเหตุ : </b></td>
			<td colspan="3">
				<font color="#FF0000" size='4'>กรณีที่ ต้องการแจ้งแก้ไขปรับปรุงโปรแกรมมากกว่า 1 เรื่อง ให้แยกใบงานเนื่องจากใช้ระยะเวลาดำเนินการที่แตกต่างกัน ใบงานของท่านอาจจะค้างในระบบเป็นเวลานาน</font>
			</td>
		</tr>
		<tr>
			<td align="right"><b>ชื่อ - นามสกุล : <br>(ผู้แจ้งเรื่อง) </b></td>
			<td><input name="user" type="text" class="forntsarabun" size="20"value="<?= $sOfficer; ?>"></td>
			<td width="144" align="right"><b>โทรศัพท์ภายใน : </b></td>
			<td width="583">
				<input name="phone" id="phone" type="text" class="forntsarabun"size="20" value="<?=$phone;?>" >
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="3"><input name="B1" type="submit" class="forntsarabun"
					value="บันทึกข้อมูล" onClick="JavaScript:return fncSubmit()">&nbsp; &nbsp;&nbsp;
				<input name="B2" type="reset" class="forntsarabun" value="เคลียร์ข้อมูล">
			</td>
		</tr>
	</table>
</form>

<script>

	// https://www.w3schools.com/js/js_cookies.asp
	function getCookie(cname) {
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i <ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
			c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	function setCookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		let expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	// https://www.w3schools.com/js/js_cookies.asp


	window.onload = function(){
		document.addEventListener("keydown", (event) => {
			if (event.isComposing || event.keyCode === 27) {
				closeBtn();
			}
		});
	}

	const myModal = new bootstrap.Modal('#staticBackdrop', {keyboard: false});

	function closeBtn() {
		var consent =document.getElementById('consent').checked;
		if(consent===false){
			Swal.fire("กรุณากดรับทราบคำแนะนำก่อนการแจ้งซ่อม");
		}else if(consent===true){
			document.getElementById('notiBackground').style.display = 'none';
			document.getElementById('notiContainer').style.display = 'none';
			document.getElementById('head').focus();

			// หลังจากที่ปิดคำแนะนำให้แสดง modal
			let n = getCookie('com_supportPopUp');
			if(n===''){ 
				setCookie('com_supportPopUp', '1');
				myModal.show();
			}
		}
	}

	////// เช็คค่าว่าง
	function fncSubmit() {

	var editorContent = tinyMCE.get('detail').getContent();

	var fn = document.f1;
	if (fn.depart.value == "0") {
		Swal.fire("กรุณาเลือกแผนก");
		fn.depart.focus();
		return false;
	}

	if (fn.jobtype.value == "0") {
		Swal.fire("กรุณาเลือกประเภทงาน");
		fn.jobtype.focus();
		return false;
	}

	if (fn.head.value == "") {
		Swal.fire("กรุณากรอกหัวข้อ 'เรื่องที่จะแจ้ง' ");
		fn.head.focus();
		return false;
	}

	// document.all.detail.value
	if (editorContent.length < 1) {
		Swal.fire("กรอกรายละเอียดงาน");
		// document.all.detail.focus();
		return false;
	}

	if (fn.phone.value == "") {
		Swal.fire("กรุณากรอกเบอร์โทรศัพท์ภายใน");
		fn.phone.focus();
		return false;
	}

	fn.submit();
	}
</script>
</body>
</html>