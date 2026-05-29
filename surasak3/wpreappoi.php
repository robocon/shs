<?php
include_once dirname(__FILE__).'/newBootstrap.php';
include_once dirname(__FILE__).'/connect.php';
if(empty($_SESSION['sOfficer'])){
	include 'pageNotFound.php';
	exit;
}

$note_code_items = array(
	'*1' => 'รอผลการตรวจวิเคราะห์ 7 วัน (ไม่รวมวันหยุดราชการ)',
	'*2' => 'เจาะเลือดเพิ่ม 3 tube',
	'*3' => 'รอผลการตรวจวิเคราะห์ 14 วัน (ไม่รวมวันหยุดราชการ)',
	'*4' => 'งดน้ำและอาหารก่อนเจาะเลือด 8 ชม.',
	'*5' => 'งดน้ำและอาหารก่อนเจาะเลือด 12 ชม.',
	'*6' => 'กระป๋องปัสสาวะ',
	'*7' => 'กระป๋องอุจจาระ',
	'*8' => 'กระป๋อง sterile',
	'*9' => 'กระป๋องเก็บเสมหะ',
	'*10' => 'ตรวจวิเคราะห์ในวัน-เวลาราชการเท่านั้น',
	'*11' => 'เจาะเลือดใน tube แก้ว',
	'*12' => 'เจาะเลือดใน tube แก้วยาวพันรอบด้วยฟอร์ยห่ออาหาร',
	'*13' => 'เจาะเลือดใน tube พันรอบด้วยฟอร์ยห่ออาหาร',
	'*14' => 'เอกสารแนบพร้อมส่งคู่กับสิ่งส่งตรวจ',
	'*15' => 'รอผลการตรวจวิเคราะห์ 20 วัน (ไม่รวมวันหยุดราชการ)',
	'*16' => 'รอผลการตรวจวิเคราะห์ 60 วัน (ไม่รวมวันหยุดราชการ)',
	'*17' => 'รอผลการตรวจวิเคราะห์ 3 วัน (ไม่รวมวันหยุดราชการ)',
	'*18' => 'กระป๋อง Urine 24 hr.'
);
$tubeSort = array(
	'EDTA'=>'EDTA Blood (หลอดเลือดสีม่วง)',
	'Heparin'=>'Heparin Blood (หลอดเลือดสีเขียว)',
	'sodium_citrate'=>'Sodium citrate Blood (หลอดเลือดสีฟ้า)',
	'NaF'=>'Sodium Fluoride Blood (หลอดเลือดสีเทา)',
	'Colt_blood'=>'Clot Blood (หลอดเลือดสีแดง)',
	'CAN'=>'กระป๋องต่างๆ',
	'Culture'=>'Culture',
	// 'special'=>'Special Lab'
);
$tubeColor = array(
	'EDTA'=>'#b2a1c7',
	'Heparin'=>'#c2d69b',
	'sodium_citrate'=>'#b6dde8',
	'NaF'=>'#b3b3b3',
	'Colt_blood'=>'#f79f9f',
	'CAN'=>'#ddd9c3',
	'Culture'=>'#fde9d9',
	'special'=>'#aab4ff'
);

if (isset($_GET["action"])  && $_GET["action"] == "viewlist") {

	$count = count($_SESSION["list_code"]);

	for ($i = 0; $i < $count; $i++) {
		echo "<div><A class='lab-item-selected' title='คลิกเพื่อยกเลิกรายการ' HREF=\"javascript:del_list(", $i, ");\" >🗑️ [".$_SESSION["list_code"][$i]."] ".$_SESSION["list_detail"][$i]."</A></div>";
	}

	exit();
} else if (isset($_GET["action"]) && $_GET["action"] == "addtolist") {

	//************************** แสดงรายการ lab  ********************************************************

	$array_new = array($_GET["code"]);

	$result = array_intersect($_SESSION["list_code"], $array_new);

	if (count($result) == 0) {

		$sql = "Select detail, yprice, nprice From labcare where (code = '" . $_GET["code"] . "' || codex = '" . $_GET["code"] . "') and labstatus='Y' and version !='OLD' limit 1; ";
		list($detail, $yprice, $nprice) = Mysql_fetch_row(Mysql_Query($sql));

		array_push($_SESSION["list_code"], $_GET["code"]);
		array_push($_SESSION["list_detail"], $detail);
	}

	exit();
} else if (isset($_GET["action"]) && $_GET["action"] == "delete") {

	$count = count($_SESSION["list_code"]);

	$j = $_GET["code"];

	for ($i = $j; $i < $count; $i++) {
		$_SESSION["list_code"][$i] = $_SESSION["list_code"][$i + 1];
		$_SESSION["list_detail"][$i] = $_SESSION["list_detail"][$i + 1];
	}

	unset($_SESSION["list_code"][$count - 1]);
	unset($_SESSION["list_detail"][$count - 1]);

	echo $_SESSION["list_code"][$i];


	exit();
} else if (isset($_GET["action"]) && $_GET["action"] == "lab") {

	$search = sprintf("%s", $dbi->real_escape_string($_GET["search"]));

	$whereSearch = "(code LIKE '%$search%' || codex LIKE '%$search%' || detail LIKE '%$search%')";
	if($_SESSION['smenucode']==='ADMICU'){
		$whereSearch = "`code` LIKE '%$search%'";
	}

	$sql = "SELECT `code`,`olddetail`,`tat`,`note_code`,`price`
	FROM `labcare` 
	WHERE $whereSearch
	AND `labstatus` = 'Y' 
	AND `version` != 'OLD' 
	ORDER BY `numbered` ASC";
	$result = $dbi->query($sql);
	if($result->num_rows>0){
		?>
		<div style="position: absolute; text-align: left; width:800px; height:400px; overflow:auto; border: 1px solid #000000; box-shadow: 4px 4px 4px #747474;background-color:#F2F3F4;">
			<table bgcolor="#FFFFCC" width="100%" border="0" cellpadding="0" cellspacing="0" id="custom-select">
				<tr align="center" bgcolor="#3333CC">
					<td colspan="4"><A HREF="#" onclick="document.getElementById('list').innerHTML='';" style='color: #ffffff; font-size: 18px;'>[ ปิด ]</A></td>
				</tr>
				<tr>
					<th>รายละเอียด</th>
					<th>หมายเหตุ</th>
					<th>TAT</th>
					<th>ราคา</th>
				</tr>
		<?php
		while($arr = $result->fetch_assoc()){
			$detail = ereg_replace(strtoupper($_GET["search"]), "<span style=\"background:#FFC1C1;font-size: 24px;\">" . strtoupper($_GET["search"]) . "</span>", $arr["olddetail"]);
			?>
			<tr class="custom-select-child">
				<td><a HREF="javascript:void(0);" style="padding-left:8px;" onclick="addtolist('<?=$arr['code'];?>');">[<?=$arr['code'];?>] <?=$detail;?></a></td>
				<td align="right">
					<?php
					$ncList = explode(',', $arr['note_code']);
					foreach ($ncList as $nc) {
						?>
						<p><?=$nc;?> <?=$note_code_items[$nc];?></p>
						<?php
					}
					?>
				</td>
				<td align="right"><?=!empty($arr["tat"]) ? $arr["tat"].'วัน' : '' ;?> </td>
				<td align="right"><?=$arr["price"];?></td>
			</tr>
			<?php
		}
		?>
			</table>
		</div>
		<?php
	}
	exit();
}


session_register("list_code");
session_register("list_detail");
$_SESSION["list_code"] = array();
$_SESSION["list_detail"] = array();

function jschars($str)
{
	$str = str_replace("\\\\", "\\\\", $str);
	$str = str_replace("\"", "\\\"", $str);
	//$str = str_replace("'", "\\'", $str);
	$str = str_replace("\r\n", "\\n", $str);
	$str = str_replace("\r", "\\n", $str);
	$str = str_replace("\n", "\\n", $str);
	$str = str_replace("\t", "\\t", $str);
	$str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
	$str = str_replace(">", "\\x3E", $str);
	return $str;
}
$getAn = sprintf("%s", $_GET['an']);
$cdate_appoint = date("Y-m-d H:i:s");
$query = "SELECT bed,date_format(date,'%d- %m- %Y'),`ptname`,`age`,`an`,`hn`,`diagnos`,`food`,`doctor`,`ptright`,`price`,`paid`,`debt`,`caldate`,`bedname`,`bedcode`,`hn`,`status`,`diag1` 
FROM `bed` 
WHERE `an`='$getAn'";
$result = mysql_query($query) or die("Query failed : ".mysql_error());
list($bed,$date,$ptname,$age,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,$bedcode,$hn,$status,$diag1) = mysql_fetch_row($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>🧪 สั่งแลปผู้ป่วยใน</title>
</head>
<body>
<style>
*{
	font-family: "TH SarabunPSK";
	font-size: 20px;
}

.btn-old-cancel:hover,
.btn-old-reprint:hover{
	background-color: #c7c7c7;
}

/* ตาราง */
.chk_table {
	border-collapse: collapse;
}

.chk_table th,
.chk_table td {
	padding: 3px;
	border: 1px solid black;
}

.a-button {
	border: 1px solid black;;
	color: #000000;
	padding: 2px 6px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	cursor: pointer;
	border-radius: 4px;
}
.a-button:hover{
	box-shadow: 3px 3px 3px #3e3e3e;
}
.a-green{
	background-color: #198754;
	color: #ffffff!important;
}
legend{
	font-weight:bold;
	font-size:24px;
}
/* รายการแลปที่กดเลือกเรียบร้อยแล้ว */
.lab-item-selected{
	text-decoration:none;
}
.lab-item-selected:hover{
	text-decoration:underline;
}
/* รายการแลปตอนที่เลือกเอง */
.custom-select-child:nth-child(odd),
#list_patho div:nth-child(odd){
	background-color: #d1d1d1ff;
}
/* เปรียบเสมือน Container ของรายการแลปที่แบ่งตาม accordion */
#orderLabLists{
	float:left;
	width:60%;
	margin-bottom:4em;
	margin-left:5%;
	margin-right:5%;
	position: relative;
}
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 10px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 18pt;
  transition: 0.4s;
}
.active, .accordion:hover {
  background-color: #ccc;
}
.accordion:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}
.active:after {
  content: "\2212";
}
.panel {
  padding: 0 0 8px 0;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
.panel::after {
  content: "";
  clear: both;
  display: table;
}
/* รายการ IN-OUT LAB */
.lab-code-items{
	border-collapse: collapse;
}
.lab-code-items th,
.lab-code-items td{
	padding: 4px;
}
.lab-code-items tr.content:hover{
	background-color: #fffbc3ff;
}
.lab-code-items tr:nth-child(odd){
	background-color: #d1d1d1ff;
}
.lab-code-items tr th{
	background-color: #b3b3b3ff;
}
.lab-code-items p,
.panel h3{
	margin:0;
	padding:0;
}
.panel h3{
	font-size: 18pt;
}

</style>
<script src="js/sweetalert2.all.min.js"></script>
<fieldset style="margin-bottom:1em;">
	<legend>ข้อมูลเบื้องต้น</legend>
	<table>
		<tr>
			<td align="right"><strong>ชื่อ</strong>: </td>
			<td><?=$ptname;?></td>
			<td align="right"><strong>สิทธิ</strong>: </td>
			<td><?=$ptright;?></td>
			<td align="right"><strong>AN</strong>: </td>
			<td><?=$an;?></td>
		</tr>
		<tr>
			<td align="right"><strong>HN</strong>: </td>
			<td><?=$hn;?></td>
			<td align="right"><strong>อายุ</strong>: </td>
			<td><?=$age;?></td>
			<td align="right"><strong>แพทย์</strong>: </td>
			<td><?= $doctor;?></td>
		</tr>
	</table>
</fieldset>

<TABLE border="0" class="forntsarabun" width="30%" style="float:left;" >
	<TR valign="top">
		<TD>
			<form method="POST" id="ward_send_lab" action="wappinsert1.php?an=<?= $an; ?>&cBed=<?= $bed; ?>&cBedcode=<?= $bedcode; ?>&cbedname=<?= $_GET['cbedname'] ?>&hn=<?=$hn;?>">
				<fieldset>
					<legend>รายการที่สั่ง</legend>
					<div id="list_patho"></div>
				</fieldset>
                <div style='color:red;'>*** หากต้องการลบรายการออกให้คลิกที่รายการนั้นๆ ***</div>
				<div style="margin-top:1em;">
					<div style="font-weight:bold;">เลือกวันที่ส่งล่วงหน้า</div>
					<div><input type="date" name="date_sent" id="date_sent" class="forntsarabun"> <a href="javascript:void(0);" onclick="document.getElementById('date_sent').value=''">[ล้างค่า]</a></div>
				</div>
				<div style="margin-top:10px;"><input type="submit" value="     ยืนยันการสั่ง LAB     " name="B1" class="forntsarabun a-button a-green"></div>
			</form>
			<div>
				<?php
				$sql = "SELECT *, GROUP_CONCAT(`code`) AS `group_codes`, SUBSTRING(DATE_SUB(`date`, INTERVAL 543 YEAR),1,10) AS `date_en` FROM `lab_ward` WHERE `an` = '$an' GROUP BY `no` ORDER BY `row_id` DESC";
				$q = mysql_query($sql);
				if (mysql_num_rows($q) > 0) {
				?>
				<hr>
				<div class="forntsarabun">
					<div><b style="font-size:24px;">รายการแลปที่เคยสั่ง</b></div>
					<table class="chk_table forntsarabun">
					<?php
					while ($lw = mysql_fetch_assoc($q)) {
						$no = $lw['no'];
						$date = $lw['date'];
						$group_codes = $lw['group_codes'];

                        /**
                         * !!! ที่ยังไม่ได้เทสก็คือในกรณีที่วันนั้นมีสั่งหลายรอบมันจะเป็นยังไง
                         */
                        $sqlOrder = "SELECT `autonumber`,`clinicalinfo` FROM `orderhead` WHERE `hn` = '$hn' AND `orderdate` LIKE '{$lw['date_en']}%' ";
                        $qOrder = mysql_query($sqlOrder);
                        $aOrder = mysql_fetch_assoc($qOrder);

                        $newOrderItems = array();
                        $orderItems = explode(',',$aOrder['clinicalinfo']);
                        foreach($orderItems AS $ori){
                            $ori = trim($ori);
                            if(!empty($ori)){
                                $newOrderItems[] = $ori;
                            }
                        }

                        $labWardItems = explode(',',$lw['group_codes']);
                        // เอารายการใน orderhead มาเทียบกับที่สั่งใน lab_ward สมมุติว่าให้ถูกไว้ก่อน แล้วถ้าหาไม่เจอค่อยให้เป็นผิด
                        $checkLab = true;
                        foreach($labWardItems AS $lwi){
                            if(!in_array($lwi, $newOrderItems)){
                                $checkLab = false;
                            }
                        }
						?>
						<tr id="row-<?=$no;?>">
							<td>
								<strong>ครั้งที่ <?= $no; ?></strong> (<?= $date; ?>)
								<div style="float:right;">
                                    <?php if($checkLab===false): ?>
									<a href="javascript: void(0);" class="btn-old-cancel" onclick="cancelOrder('<?=$no;?>')" title="ยกเลิก">🗑️</a>
                                    <?php endif; ?>
									<a href="javascript: void(0);" class="btn-old-reprint" onclick="rePrint('<?=$no;?>')" title="ปริ้น">🖨️</a>
								</div>
								<div style="padding:4px;"><?= $lw['group_codes']; ?></div>
							</td>
						</tr>
						<?php
					}
					?>
					</table>
				</div>
				<script>
					async function cancelOrder(number){
                        Swal.fire({
                            title: "ยืนยันการยกเลิก?",
                            showCancelButton: true,
                            cancelButtonText: "ยกเลิก",
                            confirmButtonText: "ยืนยัน"
                        }).then( async (result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed){
                               Swal.fire({
                                    title: 'กำลังดำเนินการ...',
                                    allowOutsideClick: false,
                                    didOpen:()=>{
                                        Swal.showLoading();
                                    }
                                });
                                const [response] = await Promise.all([
                                    fetch('wpreappoi_cancel.php?no=' + number),
                                    new Promise(resolve => setTimeout(resolve, 800)) // บังคับรอ 800ms
                                ]);
                                
                                const data = await response.json();
                                if(data.status===200){
                                    Swal.fire({
                                        title: "ยกเลิกเรียบร้อย",
                                        icon: "success", // error, question, info, success
                                        allowOutsideClick: false,
                                        didClose: function(){
                                            document.getElementById('row-'+data.id).remove();
                                        }
                                    })
                                }
                            }
                        });
					}

					async function rePrint(no){
						window.open("ipbed1aa.php?an=<?=$an;?>&bad=<?=$bed;?>&bedcode=<?=$bedcode;?>&cbedname=<?=$_GET['cbedname'];?>&no="+no, "WinRechallenge","width=600,height=300,left=100,top=100");
					}
				</script>
				<?php
				}
				?>
			</div>
		</TD>
	</TR>
</TABLE>

<div id="orderLabLists">
	<button style="position:absolute; top:0; left:0; display:none;">&gt;&gt;&gt;</button>
	<div style="text-align:center;">
		<h3 style="font-size: 24pt; margin: 0;">เลือกรายการตรวจทางพยาธิ</h3>
	</div>
	<div>
		ค้นหารายการแลปอื่นๆ: <INPUT TYPE="text" id="labSearch" NAME="" size="20" onkeypress="searchSuggest('lab',this.value,2);" class="forntsarabun">
		<div id="list"></div>
	</div>
	<div style="display: block; margin: 0.5em 0; padding: 4px 0;">
		<span style="background-color:red; color:white; padding:4px;">** หมายเหตุ **</span>
		<span style="background-color:yellow; color:#000; padding:4px;">OUT LAB และตรวจการเข้ากันของเลือด ให้แยกหลอดทดสอบ อย่างน้อย 1 tube</span>
	</div>
	
	<?php
	$q = $dbi->query("SELECT `code`,`labpart`,`labtype`,`tube`,`note_code`,`tat`,`olddetail` FROM `labcare` WHERE `tube`!='' AND `labstatus`='Y' ORDER BY `tube`,`labpart`");

	$allTubeItems = array();
	while ($a = $q->fetch_assoc()) {
		$key = $a['tube'];
		$sub_key = $a['labtype'];
		$allTubeItems[$key][$sub_key][] = $a;
	}

	foreach ($tubeSort as $tubeKey => $tubeName) {
		$bgColor = $tubeColor[$tubeKey];
		?>
		<button class="accordion" style="background-color:<?=$bgColor;?>; font-weight:bold;"><?=$tubeName;?></button>
		<div class="panel">
			<div style="width:49%; float:left; margin-right: 1%;">
			<div style="text-align:center; background-color:<?=$bgColor;?>; margin-top:1em;">
				<h3>แลปใน</h3>
			</div>
			<table class="lab-code-items" width="100%">
				<tr>
					<th width="15%">Code</th>
					<th>หมายเหตุ</th>
					<th>TAT</th>
				</tr>
				<?php
				foreach ($allTubeItems[$tubeKey]['IN'] as $key => $l) {

					$olddetail = '';
					if($tubeKey=='special'){
						$olddetail = '<br>'.$l['olddetail'];
					}

					?>
					<tr class="content">
						<td><a href="javascript:void(0);" onclick="addtolist('<?=$l['code'];?>')"><?=$l['code'].$olddetail;?></a></td>
						<td>
							<?php
							if(!empty($l['note_code'])){
								$ncList = explode(',', $l['note_code']);
								foreach ($ncList as $nc) {
									?>
									<p><?=$nc;?> <?=$note_code_items[$nc];?></p>
									<?php
								}
							}
							?>
						</td>
						<td><?=$l['tat'];?></td>
					</tr>
					<?php
				}
				?>
			</table>
			</div>

			<div style="width:49%; float:left; margin-left:1%;">
			<div style="text-align:center; background-color:<?=$bgColor;?>; margin-top:1em;">
				<h3>แลปนอก</h3>
			</div>
			<table class="lab-code-items" width="100%">
				<tr>
					<th width="15%">Code</th>
					<th>หมายเหตุ</th>
					<th>TAT</th>
				</tr>
				<?php
				foreach ($allTubeItems[$tubeKey]['OUT'] as $l) {

					$olddetail = '';
					if($tubeKey=='special'){
						$olddetail = '<br>'.$l['olddetail'];
					}
					?>
					<tr class="content">
						<td><a href="javascript:void(0);" onclick="addtolist('<?=$l['code'];?>')"><?=$l['code'].$olddetail;?></a></td>
						<td>
							<?php
							if(!empty($l['note_code'])){
								$ncList = explode(',', $l['note_code']);
								foreach ($ncList as $nc) {
									?>
									<p><?=$nc;?> <?=$note_code_items[$nc];?></p>
									<?php
								}
							}
							?>
						</td>
						<td><?=$l['tat'];?></td>
					</tr>
					<?php
				}
				?>
			</table>
			</div>
		</div>
		<?php
	}
	?>
</div>
<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
		panel.style.maxHeight = null;
		} else {
		panel.style.maxHeight = panel.scrollHeight + "px";
		} 
	});
	}

	document.getElementById("ward_send_lab").addEventListener("submit", function(e) {
		e.preventDefault();
		const lab_rows = document.getElementsByClassName('lab-item-selected').length;
		if(lab_rows===0){
			alert('กรุณาเลือกรายการแลปก่อนบันทึก');
			return false;
		}
		onSave();
	});

	async function onSave(){
		const form = document.getElementById("ward_send_lab");
		const formData = new FormData(form);
		const searchParams = new URLSearchParams(formData).toString();
		const response = await fetch('wappinsert1.php?an=<?= $an; ?>&cBed=<?= $bed; ?>&cBedcode=<?= $bedcode; ?>&cbedname=<?= $_GET['cbedname'] ?>&hn=<?=$hn;?>', {
			method: 'POST',
			body: formData
		});
		const data = await response.json();
		if(data.status===200){
			window.open("ipbed1aa.php?an=<?=$an;?>&bad=<?=$bed;?>&bedcode=<?=$bedcode;?>&cbedname=<?=$_GET['cbedname'];?>&no="+data.id, "WinRechallenge","width=600,height=300,left=100,top=100");
			Swal.fire({
				title: "บันทึกเรียร้อย",
				icon: "success", // error, question, info, success
				allowOutsideClick: false,
				didClose: function(){
					location.reload();
				}
			})
		}
	}

	function newXmlHttp() {
		var xmlhttp = false;

		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				xmlhttp = false;
			}
		}

		if (!xmlhttp && document.createElement) {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}

	function addtolist(code) {
		xmlhttp = newXmlHttp();
		url = 'wpreappoi.php?action=addtolist&code=' + code;
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById('labSearch').value='';
		viewlist();

	}

	function viewlist() {
		xmlhttp = newXmlHttp();
		url = 'wpreappoi.php?action=viewlist';
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);
		document.getElementById("list_patho").innerHTML = xmlhttp.responseText;
		document.getElementById("list").innerHTML = "";


	}

	function del_list(code) {
		url = 'wpreappoi.php?action=delete&code=' + code;
		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);
		viewlist();
	}

	function show_bock() {
		if (document.getElementById("bock_lab").style.display == "none") {
			document.getElementById("bock_lab").style.display = "";
		} else {
			document.getElementById("bock_lab").style.display = "none";
		}
	}

	function searchSuggest(action, str, len) {

		str = str + String.fromCharCode(event.keyCode);

		if (str.length >= len) {
			url = 'wpreappoi.php?action=' + action + '&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById('list').style.display = ''
			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
	}
</script>
</body>
</html>