<?php
include_once dirname(__FILE__).'/newBootstrap.php';
include_once dirname(__FILE__).'/connect.php';
if(empty($_SESSION['sOfficer'])){
	include 'pageNotFound.php';
	exit;
}

if (isset($_GET["action"])) {
	header("content-type: application/x-javascript; charset=UTF-8");
}

if (isset($_GET["action"])  && $_GET["action"] == "viewlist") {

	$count = count($_SESSION["list_code"]);

	// echo "<A HREF=\"javascript:show_bock();\">เจาะเลือด</A>
	echo "<TABLE bgcolor='#FFFFD2' style='font-size: 24px;'>
	<TR>
		<TD>";
	for ($i = 0; $i < $count; $i++) {
		echo "<div><A class='lab-item-selected' HREF=\"javascript:del_list(", $i, ");\" >❌ ", $_SESSION["list_detail"][$i], "</A></div>";
	}
	echo "</TD>
	</TR>
	</TABLE>";
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

	$sql = "Select code, detail From labcare where  (code = '" . $_GET["search"] . "' || codex = '" . $_GET["search"] . "' || detail like '%" . $_GET["search"] . "%')  AND `labstatus` = 'Y' AND `version` != 'OLD' Order by numbered ASC";

	$result = Mysql_Query($sql) or die(Mysql_error());

	if (Mysql_num_rows($result) > 0) {
		echo "<Div style=\"position: absolute;text-align: left; width:520px; height:400px; overflow:auto; border: 1px solid #000000; box-shadow: 4px 4px 4px #747474;background-color:#F2F3F4;\">";

		echo "<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id='custom-select'>
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td><font style=\"color: #FFFFFF; font-size: 20px;\"><strong>รายละเอียด</strong></font></td>
			<td width=\"24\"><font><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\" style='color: #ffffff; font-size: 18px;'>ปิด</A></strong></font></td>
		</tr>";

		$i = 1;
		while ($arr = Mysql_fetch_assoc($result)) {

			if ($i % 2 == 0)
				$bgcolor = "#FFFFFF";
			else
				$bgcolor = "#FFFFCC";


			$arr["detail"] = ereg_replace(strtoupper($_GET["search"]), "<span style=\"background:#FFC1C1;font-size: 24px;\">" . strtoupper($_GET["search"]) . "</span>", $arr["detail"]);

			echo "<tr bgcolor=\"$bgcolor\">
					<td bgcolor=\"$bgcolor\"><A HREF=\"javascript:void(0);\" style='padding-left:8px;' onclick=\"addtolist('" . $arr["code"] . "'); \">", $arr["detail"], "</A></td>
					<td colspan=\"2\"  bgcolor=\"$bgcolor\">", $arr["salepri"], "</td>
				</tr>
					<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>";

			$i++;
		}
		echo "</TABLE></Div>";
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
<fieldset style="margin-bottom:1em;">
	<legend>ข้อมูลเบื้องต้น</legend>
	<table>
		<tr>
			<td align="right"><strong>ชื่อ</strong>: </td>
			<td><?=$ptname;?></td>
		</tr>
		<tr>
			<td align="right"><strong>HN</strong>: </td>
			<td><?=$hn;?> <strong>AN</strong>: <?=$an;?> <strong>อายุ</strong>: <?=$age;?></td>
		</tr>
		<tr>
			<td align="right"><strong>สิทธิ</strong>: </td>
			<td><?=$ptright;?></td>
		</tr>
		<tr>
			<td align="right"><strong>แพทย์</strong>: </td>
			<td><?= $doctor;?></td>
		</tr>
	</table>
</fieldset>
<style>
*{
	font-family: "TH SarabunPSK";
	font-size: 20px;
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
.a-gray{
	background-color: #6e6e6e;
	color: #ffffff!important;
}
.a-item{
	padding-bottom:8px;
	padding-left:12px;
}
.a-item, #custom-select a{
	text-decoration: none;
}
.a-item:hover, #custom-select a:hover{
	text-decoration: underline;
	background-color: #e5e5e5;
}
legend{
	font-weight:bold;
	font-size:24px;
}
</style>
<TABLE border="0" class="forntsarabun" width="50%" style="float:left;" >
	<TR valign="top">
		<TD>
			<form method="POST" id="ward_send_lab" action="wappinsert1.php?an=<?= $an; ?>&cBed=<?= $bed; ?>&cBedcode=<?= $bedcode; ?>&cbedname=<?= $_GET['cbedname'] ?>">
				<fieldset>
					<legend>รายการที่สั่ง</legend>
					<div id="list_patho"></div>
				</fieldset>
				<div style="margin-top:1em;">
					<div style="font-weight:bold;">เลือกวันที่ส่งล่วงหน้า</div>
					<div><input type="date" name="date_sent" id="date_sent" class="forntsarabun"> <a href="javascript:void(0);" onclick="document.getElementById('date_sent').value=''">[ล้างค่า]</a></div>
				</div>
				<div style='color:red;'>*** หากต้องการลบรายการออกให้คลิกที่รายการนั้นๆ ***</div>
				<div style="margin-top:10px;"><input type="submit" value="     ยืนยันการสั่ง LAB     " name="B1" class="forntsarabun"></div>
			</form>
			<div>
				<?php
				$sql = "SELECT * FROM `lab_ward` WHERE `an` = '$an' GROUP BY `an`,`no` ORDER BY `no` DESC";
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
							?>
							<tr>
								<td><strong>ครั้งที่ <?= $no; ?></strong> (<?= $date; ?>)</td>
							</tr>
							<?php
							$sql_lab_ward = "SELECT * FROM `lab_ward` WHERE `an` = '$an' AND `no` = '$no' ORDER BY `row_id` ASC";
							$q_lw = mysql_query($sql_lab_ward);
							$item_lw_list = array();
							while ($item_lw = mysql_fetch_assoc($q_lw)) {
								$item_lw_list[] = $item_lw['code'];
							}
							$lw_item_merge = implode(', ', $item_lw_list);
							?>
							<tr>
								<td><?= $lw_item_merge; ?></td>
							</tr>
							<?php
						}
						?>
					</table>
				</div>
				<?php
				}
				?>
			</div>
		</TD>
	</TR>
</TABLE>
<TABLE id="" width="50%" border="1" bordercolor='#000000' cellpadding="3" cellspacing="0" style="float:left;">
	<tr valign="top">
		<td width="500">
			<div align="center"><B>รายการตรวจทางพยาธิ</B></div>
		</td>
	</tr>
	<TR valign="top">
		<TD colspan="<?php echo $r * 2; ?>" align='left'>ตรวจLAB อื่นๆ ระบุ : <INPUT TYPE="text" NAME="" size="20" onkeypress="searchSuggest('lab',this.value,3);" class="forntsarabun">
			<Div id="list"></Div>
		</TD>
	</TR>
	<TR>
		<TD align="center"><strong>รายการที่ใช้บ่อย</strong></TD>
	</TR>
	<tr>
		<td>
		<div style="display: grid; column-gap: 50px; grid-template-columns: auto auto auto;">
	<?php
	// display: grid; column-gap: 50px;
	// display: flex;flex-wrap: wrap; gap: 20px; flex-direction: row;
	$i = 0;
	$list_lab_check[$i]["code"] = "CBC";
	$list_lab_check[$i]["detail"] = "CBC";
	$i++;

	$list_lab_check[$i]["code"] = "UA";
	$list_lab_check[$i]["detail"] = "UA";
	$i++;

	$list_lab_check[$i]["code"] = "UPT";
	$list_lab_check[$i]["detail"] = "UPT";
	$i++;

	$list_lab_check[$i]["code"] = "BS";
	$list_lab_check[$i]["detail"] = "BS";
	$i++;

	$list_lab_check[$i]["code"] = "HBA1C";
	$list_lab_check[$i]["detail"] = "HbA1C";
	$i++;

	$list_lab_check[$i]["code"] = "CHOL";
	$list_lab_check[$i]["detail"] = "CHOL";
	$i++;

	$list_lab_check[$i]["code"] = "TRI";
	$list_lab_check[$i]["detail"] = "TRI";
	$i++;

	$list_lab_check[$i]["code"] = "HDL";
	$list_lab_check[$i]["detail"] = "HDL";
	$i++;

	$list_lab_check[$i]["code"] = "LDL";
	$list_lab_check[$i]["detail"] = "LDL";
	$i++;

	$list_lab_check[$i]["code"] = "URIC";
	$list_lab_check[$i]["detail"] = "URIC";
	$i++;

	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN";
	$i++;

	$list_lab_check[$i]["code"] = "CR";
	$list_lab_check[$i]["detail"] = "CR";
	$i++;

	$list_lab_check[$i]["code"] = "ELYTE";
	$list_lab_check[$i]["detail"] = "ELyte";
	$i++;

	$list_lab_check[$i]["code"] = "LFT";
	$list_lab_check[$i]["detail"] = "LFT";
	$i++;

	$list_lab_check[$i]["code"] = "HBSAG";
	$list_lab_check[$i]["detail"] = "HBsAg";
	$i++;

	$list_lab_check[$i]["code"] = "HBSAB";
	$list_lab_check[$i]["detail"] = "HBsAb";
	$i++;

	$list_lab_check[$i]["code"] = "HBCAB";
	$list_lab_check[$i]["detail"] = "HBcAb";
	$i++;

	$list_lab_check[$i]["code"] = "HCV";
	$list_lab_check[$i]["detail"] = "HCV";
	$i++;

	$list_lab_check[$i]["code"] = "HIV";
	$list_lab_check[$i]["detail"] = "AntiHIV";
	$i++;

	$list_lab_check[$i]["code"] = "FT3";
	$list_lab_check[$i]["detail"] = "FT3";
	$i++;

	$list_lab_check[$i]["code"] = "FT4";
	$list_lab_check[$i]["detail"] = "FT4";
	$i++;

	$list_lab_check[$i]["code"] = "TSH";
	$list_lab_check[$i]["detail"] = "TSH";
	$i++;

	$list_lab_check[$i]["code"] = "BGT";
	$list_lab_check[$i]["detail"] = "BG";
	$i++;

	$list_lab_check[$i]["code"] = "Phos";
	$list_lab_check[$i]["detail"] = "PHOS";
	$i++;

	$list_lab_check[$i]["code"] = "CD4";
	$list_lab_check[$i]["detail"] = "CD4";
	$i++;

	$list_lab_check[$i]["code"] = "TROP-T";
	$list_lab_check[$i]["detail"] = "TROP-T";
	$i++;

	$list_lab_check[$i]["code"] = "VDRL";
	$list_lab_check[$i]["detail"] = "VDRL";
	$i++;

	$list_lab_check[$i]["code"] = "DCIP";
	$list_lab_check[$i]["detail"] = "DCIP";
	$i++;

	$list_lab_check[$i]["code"] = "PAP";
	$list_lab_check[$i]["detail"] = "PAP";
	$i++;

	$list_lab_check[$i]["code"] = "SGOT";
	$list_lab_check[$i]["detail"] = "AST";
	$i++;

	$list_lab_check[$i]["code"] = "SGPT";
	$list_lab_check[$i]["detail"] = "ALT";
	$i++;

	$list_lab_check[$i]["code"] = "ALK";
	$list_lab_check[$i]["detail"] = "AP";
	$i++;

	$list_lab_check[$i]["code"] = "CAL";
	$list_lab_check[$i]["detail"] = "CA";
	$i++;

	$list_lab_check[$i]["code"] = "HCT";
	$list_lab_check[$i]["detail"] = "HCT";
	$i++;
	$list_lab_check[$i]["code"] = "ALB";
	$list_lab_check[$i]["detail"] = "Albumin";
	//************

	$i++;
	$list_lab_check[$i]["code"] = "Na";
	$list_lab_check[$i]["detail"] = "Na";

	$i++;
	$list_lab_check[$i]["code"] = "k";
	$list_lab_check[$i]["detail"] = "K";

	$i++;
	$list_lab_check[$i]["code"] = "Cl";
	$list_lab_check[$i]["detail"] = "Cl";

	$i++;
	$list_lab_check[$i]["code"] = "co2";
	$list_lab_check[$i]["detail"] = "CO2";

	$r = 5;
	$count = count($list_lab_check);
	
	// padding-bottom:8px; padding-left:12px;
	for ($i = 1; $i <= $count; $i++) {
		echo "<A HREF=\"javascript:void(0);\" class='a-item' onclick=\"addtolist('" . jschars($list_lab_check[$i - 1]["code"]) . "');\" >" . jschars($list_lab_check[$i - 1]["detail"]) . "</A>";
		// if ($i % $r == 0)
			// echo "</TR><TR>";
	}
	?>
		</div>
		</td>
	</tr>
</TABLE>

<script>
	document.getElementById("ward_send_lab").addEventListener("submit", function(e) {
		e.preventDefault();
		const lab_rows = document.getElementsByClassName('lab-item-selected').length;
		if(lab_rows===0){
			alert('กรุณาเลือกรายการแลปก่อนบันทึก');
			return false;
		}
		this.submit();
	});

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
		viewlist();
		//if(checkELyte() == "4"){
		//	alert("ท่านได้สั่งรายการ Na, K, Cl, Co2 แยกทั้ง 4 รายการ \n กรุณาสั่งเป็น E'Lyte ");
		//}
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