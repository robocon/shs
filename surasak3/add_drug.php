<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/connect.php';
include_once dirname(__FILE__).'/includes/JSON.php';
if (!isset($_SESSION['sIdname'])){die;}

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$my_an = sprintf("%s", $_GET["an"]);

if($_GET["an"] && empty($my_an)){
	?>
	<p><b>ไม่สามารถระบุ AN ได้ <a href="javascript:history.back();" >คลิกที่นี่</a>เพื่อกลับหน้าจ่ายยาผู้ป่วยใน</b></p>
	<?php
	exit;
}
/**
 * SUPER VARIABLE จะถูกเรียกใช้ทุกครั้งที่ไฟล์นี้ทำงาน
 */
$Thidate = (date("Y")+543).date("-m-d H:i:s");

/**
 * ข้อมูลเบื้องต้นของผู้ป่วยจาก an
 */
$sql = "Select an, hn, ptname, bedcode, ptright, doctor From bed where an = '$my_an' limit 0,1 ";
$result = Mysql_Query($sql);
$bed = Mysql_fetch_assoc($result);
if(!$bed){
	?>
	<h1 style="color:red;">คำเตือน ไม่พบข้อมูล AN: <?=$my_an;?> กรุณาตรวจสอบ AN อีกครั้ง</h1>
	<?php
}

$sql = "SELECT an,drugcode,tradname,firstdate,enddate  FROM `dgprofile`  where an='$my_an' and statcon = 'CONT' and onoff='ON' and enddate='".date("Y-m-d")."'";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
if($num > 0){
	$rows=mysql_fetch_array($result);
	$show_an=$rows["an"];
	echo "<script>alert('ผู้ป่วย AN : $show_an มียาที่ครบกำหนด Cont ยาในวันนี้จำนวน $num รายการ');</script>";
}

$my_hn = $_SESSION["hn_now"] = $bed["hn"];
$_SESSION["an_now"] = $bed["an"];
$_SESSION["ptright_now"] = $bed["ptright"];

// แสดงโรคประจำตัวด้านล่าง และหาว่าคนไข้มีโรคประจำตัวเป็น G6PD รึป่าว
$qOp = $dbi->query("SELECT congenital_disease FROM opcard WHERE hn = '$my_hn' ");
$opcard = $qOp->fetch_assoc();
$opcard_g6pd = false;
if(preg_match('/(G6PD)/', $opcard['congenital_disease'], $matchs)){
	$opcard_g6pd = true;
}

// ถ้าเภสัชได้ติ๊กว่าผู้ป่วยคนนี้มีประวัติการเป็น G6PD ในระบบแพ้ยาให้ทำการดึงรายการยาในกลุ่ม g6pd ออกมา
$drugreactGroup10 = array();
$queryG6pdInDrugreact = $dbi->query("SELECT row_id FROM drugreact WHERE hn='$my_hn' AND g6pd='1'");
if($queryG6pdInDrugreact->num_rows > 0){
	$queryGroup10 = $dbi->query("SELECT * FROM drugreact_group_list WHERE drugreact_group = '10' ");
	while ($g10 = $queryGroup10->fetch_assoc()) {
		$drugreactGroup10[] = trim($g10['drugcode']);
	}
}

// รายการยาที่แพ้ตามที่เภสัชได้บันทึกเอาไว้
$drugreact_list = array();
$drugreact_list_js = array();
$drugreact_g6pd = false;
$res_drugreact = $dbi->query("SELECT * FROM `drugreact` WHERE hn = '$my_hn' AND advreact != '' AND g6pd IS NULL  GROUP BY drugcode");
$rowdg1 = $res_drugreact->num_rows;
if($rowdg1 > 0){
	while($arrdg1 = $res_drugreact->fetch_assoc()){
		$drugcode = trim($arrdg1['drugcode']);
		$drugreact_list[] = $drugcode;
		$drugreact_list_js[] = "'$drugcode'";

		if($arrdg1['g6pd']=="1"){
			$drugreact_g6pd = true;
		}
	}
}

// กลุ่มที่แพ้ตามที่เภสัชได้่บันทึกเอาไว้
$sqlGroup = "SELECT `groupname`,advreact,asses FROM `drugreact` WHERE hn = '$my_hn' AND groupname <> '' AND sideeffects='' GROUP BY `groupname`";
$qGroup = $dbi->query($sqlGroup);
$groupnameList = array();
if ($qGroup->num_rows>0) { 
	while ($a = $qGroup->fetch_assoc()) {
		$groupnameList[] = $a;
	}
}

// รายการยาที่แพ้ ตามกลุ่ม
$sql1="SELECT b.* FROM ( 
	SELECT `groupname` FROM `drugreact` WHERE `hn` = '$my_hn' AND `groupname` != '' AND sideeffects='' GROUP BY `groupname`
) AS a 

LEFT JOIN `drugreact_group` AS c ON c.`name` = a.`groupname`
LEFT JOIN `drugreact_group_list` AS b ON c.`id` = b.`drugreact_group` 
WHERE b.drugcode NOT IN (SELECT `drugcode` FROM `drugreact` WHERE `hn` = '$my_hn' AND drugcode != '' AND advreact != '' AND g6pd IS NULL GROUP BY drugcode)";

$res = $dbi->query($sql1);
$drugreact_groups = array();
$drugreact_groups_js = array();
while ($a = $res->fetch_assoc()) {
	$drugreact_groups[] = $a['drugcode'];
	$drugreact_groups_js[] = "'".trim($a['drugcode'])."'";
}

$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

// ************************************************************ Submit ************************************************************
if(isset($_POST["Save_dgprofile"]) && $_POST["Save_dgprofile"] == "บันทึกข้อมูลใน DrugProfile" ){
	
	// $w = array();
	// for($j=0;$j<$_SESSION["num_list"];$j++){
	// 	if($_SESSION["list_druglst"]["row_id"][$j]  == ""){
	// 		$w["drugcode"][$i] = $_SESSION["list_druglst"]["drugcode"][$j];
	// 		$w["tradname"][$i] = $_SESSION["list_druglst"]["tradname"][$j];
	// 		$w["part"][$i] = $_SESSION["list_druglst"]["part"][$j];
	// 		$w["slcode"][$i] = $_SESSION["list_druglst"]["slcode"][$j];
	// 		$w["statcon"][$i] = $_SESSION["list_druglst"]["statcon"][$j];
	// 		$w["amount"][$i] = $_SESSION["list_druglst"]["amount"][$j];
	// 		$w["row_id"][$i] = $_SESSION["list_druglst"]["row_id"][$j];
	// 		$w["firstdate"][$i] = $_SESSION["list_druglst"]["firstdate"][$j];			
	// 		$w["enddate"][$i] = $_SESSION["list_druglst"]["enddate"][$j];			
	// 		$i++;
	// 	}
	// }

	$sql2 = "INSERT INTO dgprofile(date,an,drugcode,tradname,unit,salepri,freepri,amount,price,slcode,part,statcon,onoff,dateoff,officer,firstdate,enddate )VALUES ";
	$add_status = false;
	for($j=0;$j<$_SESSION["num_list"];$j++){

		// ถ้า row_id เป็นค่าว่าง ==> คือเป็นตัวใหม่ที่ถูกเพิ่มเข้ามา
		if($_SESSION["list_druglst"]["row_id"][$j]  == ""){

			$add_status = true;
			$sql = "SELECT `salepri`, `freepri`, `part`, `unit`, `tradname` FROM `druglst` WHERE `drugcode` = '".$_SESSION["list_druglst"]["drugcode"][$j]."' limit 0,1 ";
			list($salepri, $freepri, $part, $unit, $tradname) = Mysql_fetch_row(Mysql_Query($sql));

			$part = $_SESSION["list_druglst"]["part"][$j];
			$unit = $_SESSION["list_druglst"]["unit"][$j];

			// เฉพาะ drugcode ทีเป็น old ถ้า tradname ไม่ตรงกันให้เอาตัวที่ user เป็นคนคีย์มาใช้งาน
			if( $_SESSION["list_druglst"]["drugcode"][$j]=="OLD" && $tradname != $_SESSION["list_druglst"]["tradname"][$j]){
				$tradname = $_SESSION["list_druglst"]["tradname"][$j];
			}

		 	$sql2 .= "('".$Thidate."','".$_GET["an"]."','".$_SESSION["list_druglst"]["drugcode"][$j]."','".$tradname."','".$unit."','".$salepri."','".$freepri."', '".$_SESSION["list_druglst"]["amount"][$j]."','".($salepri * $_SESSION["list_druglst"]["amount"][$j])."','".$_SESSION["list_druglst"]["slcode"][$j]."','".$part."','".$_SESSION["list_druglst"]["statcon"][$j]."','ON','','".$_SESSION["sOfficer"]."', '".$_SESSION["list_druglst"]["firstdate"][$j]."', '".$_SESSION["list_druglst"]["enddate"][$j]."'), ";  
			$i++;
		}
	}
	$sql2 = substr($sql2,0,-2);
	if($add_status == true){
		$result = Mysql_Query($sql2);
	}else{
		$result = false;
		$error = mysql_error();
	}
	
	if($result == true || $_SESSION["num_list"] > 0){
		$txt = "";
		?>
		<div style="text-align:center;">
			<p>ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว</p>
			<p>
				<A HREF="phardividedrug.php?an=<?= $_GET["an"]."&bed=".$_GET["bed"]."&bedcode=".$_GET["bedcode"] ?>">ตัดจ่ายยา</A>&nbsp;|&nbsp;<A HREF="enddrugprofile.php">กลับหน้าward</A>
			</p>
		</div>
		<?php
	}else{
		?>
		<div style="text-align:center;">
			<p>เกิดความผิดพลาดในการเพิ่มข้อมูล : <?= $error ?></p>
		</div>
		<?php
	}
	exit();
}
// ***************************************************** จบ Submit **************************************************


/**
 * กำหนด SESSION ตอนที่โหลดหน้ามาครั้งแรก
 */
session_unregister($list_druglst);
session_unregister($num_list);

session_register($list_druglst);
session_register($num_list);

$_SESSION["num_list"] = 0;
$_SESSION["list_druglst"] = array();

$list_status_drug = array();
$list_status_drug["STAT1"] = "Stat";
$list_status_drug["STAT"] = "One day";
$list_status_drug["CONT"] = "Continue";
$list_status_drug["OLD"] = "ยาเดิม";

$an = $_GET['an'];
$sql = "SELECT `row_id`,`drugcode`,`tradname`,`part`,`slcode`,`statcon`,`amount`,`firstdate`,`enddate`,`unit`
FROM `dgprofile` 
WHERE `an` = '$an' 
AND LEFT( `drugcode`, 1 ) IN ('0','1','2','3','4','5','6','7','8','9','O') 
AND 
(
	( onoff = 'ON' AND ( statcon = 'CONT' OR statcon = 'OLD' ) ) 
	OR 
	( `date` LIKE '$Thidate%' AND ( statcon = 'STAT' OR statcon = 'STAT1' ) ) 
) 
Order by row_id ASC ";
$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){
	
	$_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]] = $arr["row_id"];
	$_SESSION["list_druglst"]["drugcode"][$_SESSION["num_list"]] = $arr["drugcode"];
	$_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]] = $arr["tradname"];
	$_SESSION["list_druglst"]["part"][$_SESSION["num_list"]] = $arr["part"];
	$_SESSION["list_druglst"]["slcode"][$_SESSION["num_list"]] = $arr["slcode"];
	$_SESSION["list_druglst"]["statcon"][$_SESSION["num_list"]] = $arr["statcon"];
	$_SESSION["list_druglst"]["amount"][$_SESSION["num_list"]] = $arr["amount"];
	$_SESSION["list_druglst"]["firstdate"][$_SESSION["num_list"]] = $arr["firstdate"];
	$_SESSION["list_druglst"]["enddate"][$_SESSION["num_list"]] = $arr["enddate"];
	$_SESSION["list_druglst"]["unit"][$_SESSION["num_list"]] = $arr["unit"];

	$sqlDruglst = sprintf("SELECT genname FROM druglst WHERE drugcode = '%s' LIMIT 1", $dbi->real_escape_string($arr["drugcode"]));
	$qDruglst = $dbi->query($sqlDruglst);
	if($qDruglst->num_rows>0){
		$druglst = $qDruglst->fetch_assoc();
		$_SESSION["list_druglst"]["genname"][$_SESSION["num_list"]] = $druglst['genname'];
	}else{
		$_SESSION["list_druglst"]["genname"][$_SESSION["num_list"]] = '';
	}

	$_SESSION["num_list"]++;
}
// ***************************************************** จบ กำหนด Session **************************************************

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>เพิ่ม/ลบ/แก้ไข Drugprofile</title>
<style type="text/css">
a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
body,td,th {
	font-family:  TH SarabunPSK;
	font-size: 18px;
}
.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;
}
#slidemenubar, #slidemenubar2{
	position:absolute;
	left:-155px;
	width:160px;
	top:250px;
	border:1.5px solid #FFCC00;
}
.txtsarabun {
	font-family:"TH SarabunPSK";
	font-size:20px;
}	
body {
	background-color: #FFFFF0;
	font-family:"TH SarabunPSK";
	font-size: 18px;
}
input[readonly] {
    background-color: #d7d7d7;
}
.swal2-html-container {
    text-align: left;
    font-size: 22px;
}
</style>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript" src="epoch_classes_korsor.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<body>
<!-- div Drug List -->

<div id="slidemenubar2" style="left:-350px;" >
  
<layer id="slidemenubar"  >

<TABLE width="380" class="font_title"  bgcolor="#FFFFFF">
<TR>
	<TD valign="top" width="340">
	<BR>
<CENTER><A HREF="javascript: chang_layer(layer2);">ยาที่เคยจ่าย</A>&nbsp;<FONT COLOR="#000000">|</FONT>&nbsp;<A HREF="javascript: chang_layer(layer1); ">ยาที่เคย Off</A>&nbsp;<FONT COLOR="#000000">|</FONT>&nbsp;<A HREF="javascript: chang_layer(layer3); ">รายการยาเดิม</A></CENTER>
<BR>


<TABLE id="layer2" border = 1 bordercolor="009688"  cellpadding="0" cellspacing="0">
<TR>
	<TD>
	
</TD>
</TR>
</TABLE>

<TABLE  id="layer3"  border = 1 bordercolor="#3300FF"  cellpadding="0" cellspacing="0" style="display:none">
<TR>
	<TD>
	
</TD>
</TR>
</TABLE>
</TD>
	<TD align="center" width="40" bgcolor="#FFCC00" Onclick="pull_draw();">
	D<BR>R<BR>U<BR>G<BR><BR>L<BR>I<BR>S<BR>T
	</TD>
</TR>
</TABLE>

</layer>
</div>


<script language="JavaScript1.2">
	
	function chang_layer(ly){
	 layer1.style.display='none'; 
	 layer2.style.display='none';
	 layer3.style.display='none';
	 ly.style.display = '';
	}

	function regenerate(){
		window.location.reload()
	}

	function regenerate2(){
		if (document.layers)
		setTimeout("window.onresize=regenerate",400)
	}

	// window.onload=regenerate2
	// if (document.all){

	// 	themenu=document.all.slidemenubar2.style
	// 	rightboundary=0
	// 	leftboundary=-350
	// }else{
	// 	themenu=document.layers.slidemenubar
	// 	rightboundary=350
	// 	leftboundary=10
	// }
	
	function pull_draw(){

		if(themenu.pixelLeft == -350){
			pull();
		}else{
			draw();
			
		}
	}

	function pull(){
		if (window.drawit)
			clearInterval(drawit)
		pullit=setInterval("pullengine()",5)
	}

	function draw(){
		clearInterval(pullit)
		drawit=setInterval("drawengine()",5)
	}
	
	function pullengine(){
		if (document.all && themenu.pixelLeft < rightboundary)
			themenu.pixelLeft+=20
		else if(document.layers && themenu.left<rightboundary)
			themenu.left+=5
		else if (window.pullit)
			clearInterval(pullit)
	}

	function drawengine(){
		if (document.all && themenu.pixelLeft > leftboundary)
			themenu.pixelLeft-=20
		else if(document.layers && themenu.left > leftboundary)
			themenu.left-=5
		else if (window.drawit)
			clearInterval(drawit)
	}
</script>

<!-- div End Drug List -->

<?php 
$sql = "Select an, hn, ptname, bedcode, ptright, doctor From bed where an = '".$_GET["an"]."' limit 0,1 ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
Mysql_free_result($result);

$hnFromBed = $arr["hn"];

session_register("hn_now");
$_SESSION["hn_now"] = $arr["hn"];
session_register("an_now");
$_SESSION["an_now"] = $arr["an"];
$_SESSION["ptright_now"] = $arr["ptright"];

?>
<BR>
<TABLE align="center"  border="1" bordercolor="009688" cellspacing="0" cellpadding="0" width="80%">
<TR>
	<TD>
<TABLE width="100%" align="center" cellpadding="6" cellspacing="3">
<TR bgcolor="009688">
	<TD height="46" colspan="6" align="center"><FONT COLOR="#FFFFFF"><B>รายละเอียดผู้ป่วยใน</B></FONT></TD>
</TR>
<TR>
	<TD align="right" bgcolor="#009688"><strong>AN : </strong></TD>
	<TD bgcolor="#00CC99"><a href="med_phar.php?fill_an=<?=$arr["an"];?>" target="_blank" title="Doctor Order"><?=$arr["an"];?></a></TD>
	<TD align="right" bgcolor="009688"><strong>HN : </strong></TD>	
</TD>
	<TD bgcolor="#00CC99"><a href="med_record_detail.php?an=<?=$arr["an"];?>" target="_blank" title="Medication record"><?php echo $arr["hn"];?></a></TD>
	<TD align="right" bgcolor="#009688"><strong>ชื่อ-สกุล : </strong></TD>
	<TD bgcolor="#00CC99"><?php echo $arr["ptname"];?></TD>
</TR>
<TR>
	<TD align="right" bgcolor="#009688"><strong>หอผู้ป่วย : </strong></TD>
	<TD bgcolor="#00CC99"><?php echo $build[substr($arr["bedcode"],0,2)];?></TD>
	<TD align="right" bgcolor="009688"><strong>สิทธิ์ : </strong></TD>
	<TD bgcolor="#00CC99"><?php echo $arr["ptright"];?></TD>
	<TD align="right" bgcolor="#009688"><strong>แพทย์ : </strong></TD>
	<TD bgcolor="#00CC99"><?php echo $arr["doctor"];?></TD>
</TR>
<tr>
	<td align="right" bgcolor="#009688"><b>โรคประจำตัว</b></td>
	<td bgcolor="#00CC99"><?=(!empty($opcard['congenital_disease']) ? $opcard['congenital_disease'] : '-' );?></td>
	<td></td>
	<td></td>
</tr>
</TABLE>
</TD>
</TR>
</TABLE>
<?
$chkdate=(date("Y")+543)."".date("-m-d");
$sql1="select * from phardep where hn = '".$arr["hn"]."' and date like '$chkdate%' and an is null ";
$query1=mysql_query($sql1);
$num=mysql_num_rows($query1);
$result=mysql_fetch_array($query1);
$lastdate=$result["date"];
if($num >0){
echo "<p align='center' style='color:red;'><strong>ผู้ป่วยมีประวัติการจ่ายยา OPD CASE ล่าสุดเมื่อ $lastdate</strong></p>";
}
?>
<TABLE align="center"  border="0" cellspacing="4" cellpadding="0" width="80%">
<TR>
	<TD>
		<?php 
			// แสดงรายการยาที่แพ้
			$sql = "SELECT `drugcode`, `tradname`, `advreact`, `groupname` FROM `drugreact` WHERE `hn` = '".$arr["hn"]."' AND advreact != '' ";
			$result = Mysql_Query($sql);
			$rows = Mysql_num_rows($result);
			if($rows> 0){
				echo "<FONT COLOR=\"red\"><B>แพ้ยาทั้งหมด ".$rows." รายการ</B></FONT>";
				?>
				<a href="drugreact_new_add.php?page=show&hn=<?=$my_hn;?>" target="_blank" style="color:blue;">[แก้ไขรายกาแพ้ยา]</a>
				<?php
				echo "<br>";
				$i = 1;
				while(list($drugcode,  $tradname , $advreact, $groupname) = Mysql_fetch_row($result)){ 

					$advreactTxt = '';
					if(!empty($advreact)){
						$advreactTxt = ' <b style="color:red;">อาการ :</b> '.$advreact;
					}

					$groupTxt = '';
					if (!empty($groupname)) {
						$groupTxt = ' <b>['.$groupname.']</b>';
					}

					echo "<b>$i)</b> [<b>",$drugcode,"</b>] : ", $tradname , $advreactTxt, $groupTxt, "<BR>";
					$i++;
				}
				
			}
		?>
	</TD>
	<td valign="top">
		
		<?php 
		$sql = "SELECT a.*,b.`tradname` FROM ( SELECT `id`,`hn`,`an`,`drugcode`,`doctor`,`reason`, SUBSTRING(`date`,1,10) AS `date` FROM `dt_rechallenge` WHERE `an` = '$an' ORDER BY `id` ASC ) AS a 
		LEFT JOIN `druglst` AS b ON a.`drugcode` = b.`drugcode` ";
		$q = $dbi->query($sql);
		if ($q->num_rows > 0) {
			?>
			<table style="border:2px solid #009688;" width="100%">
				<tr>
					<th colspan="4"><b>บันทึก Rechallenge</b></th>
				</tr>
				<tr style="background-color: #009688; color: #ffffff;">
					<th>วันที่บันทึก</th>
					<th>รหัสยา</th>
					<th>แพทย์</th>
					<th>เหตุผล</th>
				</tr>
				<?php 
				while ($a = $q->fetch_assoc()) { 

					?>
					<tr style="background-color: #00CC99;">
						<td><?=$a['date'];?></td>
						<td>
							<a href="javascript:void(0);" onclick="show_rechallenge('<?=$a['id'];?>')">[<b><?=$a['drugcode'];?></b>] : <?=$a['tradname'];?></a>
						</td>
						<td><?=$a['doctor'];?></td>
						<td><?=$a['reason'];?></td>
					</tr>
					<?php
				}
				?>
			</table>
			<script>
				function show_rechallenge(id){
					window.open("dt_show_rechallenge.php?id="+id, "WinRechallenge","width=600,height=300,left=100,top=100");
				}
			</script>
			<?php
		}
		?>
	</td>
</TR>
<?php 
if (count($groupnameList)>0) {
	$i = 1;
	echo "<tr><td colspan='6'><font color=\"red\"><b>กลุ่มยาที่แพ้</b></font></td></tr>";
	foreach ($groupnameList as $key => $value) {
		echo "<tr><td colspan='6'><font>$i) ".$value['groupname']."...".$value['advreact']."( ".$value['asses']." )</font></td></tr>";
		$i++;
	}
}

// ผลข้างเคียง
$sql = "SELECT a.*,b.`tradname` FROM (
SELECT `drugcode`,`sideeffects` FROM `drugreact` WHERE `hn` = '$hnFromBed' AND `sideeffects` <> '' GROUP BY `drugcode`
) AS a LEFT JOIN `druglst` AS b ON a.`drugcode` = b.`drugcode` ";
$q = $dbi->query($sql);
if($q->num_rows>0){
	?>
	<tr>
		<td>
		<p style="color:red; margin:0; padding: 0;"><b>ผลข้างเคียงจากการใช้ยา</b></p>
		<?php
		while ($a = $q->fetch_assoc()) {
			?>
			<p style="margin:0; padding: 0;"><b><?=$a['drugcode'];?> : </b><?=$a['tradname'];?>&nbsp;&nbsp;<b>อาการข้างเคียง : </b><?=$a['sideeffects'];?></p>
			<?php
		}
		?>
		</td>
	</tr>
	<?php
}
?>
</TABLE>

<div align="center" ><BR>
</div>
<TABLE width="55%" align="center" cellpadding="6" cellspacing="3">
	<TR valign="top">
		<TD width="14%" align="right"><strong>รหัสยา : </strong></TD>
	  	<TD width="17%" style="position: relative;">
			<INPUT NAME="drugcode" TYPE="text" class="txtsarabun" ID="drugcode" onkeyup="searchSuggest2('drugcode',this.value); " onKeyDown="if(event.keyCode == 40 && document.getElementById('listdrugcode').innerHTML != ''){ document.getElementById('list_radio').focus(); document.getElementById('list_radio').checked=true ; return false;  }" size="13" autofocus>
		</TD>
		<TD width="14%" align="right"><strong>ชื่อยา :</strong></TD>
		<TD width="25%"><INPUT NAME="drugname" TYPE="text" class="txtsarabun" ID = "drugname" onKeyPress="submit_button('drugcode');"  size="25" ></TD>
		<TD width="15%" align="right"><strong>วิธีใช้ :</strong></TD>
		<TD width="15%"><INPUT NAME="drugslip" TYPE="text" class="txtsarabun" ID = "drugslip"
	  onkeypress="searchSuggest2('drugslip',this.value);" onKeyDown="if(event.keyCode == 40 && document.getElementById('listdrugcode').innerHTML != ''){ document.getElementById('list_radio').focus(); document.getElementById('list_radio').checked=true ; return false;  }" size="11"
		></TD>
	</TR>
	<TR valign="top">
		<TD style="position: relative;" align="right">
			<strong>จำนวน : </strong>
			<div id="listdrugcode" style="position: absolute; top:0; left:0; width:960px; height:auto; overflow:auto; background-color:#ffffff; text-align:center;"></div>
		</TD>
	  <TD><INPUT NAME="amount" TYPE="text" class="txtsarabun" ID="amount"  onkeypress="submit_button('amount');" size="4"></TD>
		<TD align="right"><strong>หน่วย :</strong></TD>
		<TD align="left">
			<div>
				<INPUT NAME="unit" TYPE="text" class="txtsarabun" ID="unit" onKeyPress="submit_button('amount');"  size="5"> 
				<strong>ประเภท:</strong>
				<INPUT NAME="unit2" TYPE="text" class="txtsarabun" ID="unit2"   size="5" readonly>
			</div>
			<div>
				<select name="" id="" onchange="selectHelper(this.value)">
					<option value="">ตัวช่วย</option>
					<option value="tablet">tablet</option>
					<option value="bottle">bottle</option>
					<option value="amp">amp</option>
					<option value="vial">vial</option>
					<option value="capsule">capsule</option>
					<option value="elixir">elixir</option>
					<option value="unit">unit</option>
				</select>
			</div>
		</TD>
		<TD align="right"><strong>สถานะ :</strong></TD>
		<TD>
			<SELECT NAME="statcon" class="txtsarabun" ID="statcon"  onkeypress="submit_button('statcon');" >
			<OPTION VALUE="" SELECTED>-- สถานะ --</OPTION>
				<OPTION VALUE="STAT1">STAT</OPTION>
				<OPTION VALUE="STAT">จ่ายวันเดียว</OPTION>
				<OPTION VALUE="CONT">ยา continue</OPTION>
				<OPTION VALUE="OLD">ยาเดิม</OPTION>
			</SELECT>
		</TD>
	</TR>
	<TR>
	  <TD colspan="6" align="center"><table width="90%" border="0" cellspacing="2" cellpadding="4">
        <TR>
          <TD align="center"><strong>วันที่เริ่มต้น : </strong>            &nbsp;
            <input name="firstdate" type="text" class="txtsarabun" id="firstdate" size="15" placeholder="Ex. 2021-01-01">
            <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่สิ้นสุด : </strong>
            &nbsp;
          <input name="enddate" type="text" class="txtsarabun" id="enddate" size="15" placeholder="Ex. 2021-01-07"></TD>
        </TR>
        
      </table></TD>
  </TR>
	<TR>
		<TD height="50" colspan="6" align="center" valign="bottom">
			<INPUT ID="button_submit" TYPE="button" class="txtsarabun" VALUE=" เพิ่มข้อมูล " ONCLICK="add_session();">&nbsp;&nbsp;
			<INPUT TYPE="button" class="txtsarabun" VALUE=" เลือกผู้ป่วยใหม่ " ONCLICK="window.location.href='enddrugprofile.php';">&nbsp;&nbsp;
			<INPUT TYPE="button" class="txtsarabun" VALUE=" ข้อมูลการจ่ายยา " ONCLICK="window.open('rp_profile.php?an=<?php echo $arr["an"];?>&month=<?php echo date("m");?>&year=<?php echo (date("Y")+543);?>&date=<?php echo date("dmy");?>','_blank');">&nbsp;&nbsp;
            <input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="txtsarabun" />&nbsp;&nbsp;
			<button type="button" class="txtsarabun" onclick="window.open('drugstk2.php?an=<?=$arr['an'];?>','durgstk','width=900,height=600')">ติด OPD ย้อนหลัง</button>
		</TD>
  </TR>
	</TABLE>
	<script>
		function selectHelper(v){
			document.getElementById('unit').value=v;
		}
	</script>

<?php
$sql = "SELECT DATE_FORMAT(`date`,'%d/%m/%Y') as `dateform` FROM `dgprofile` WHERE `an` = '".$_GET["an"]."' ORDER BY `date` DESC LIMIT 0,1 ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
?>
<p style="text-align:center;">
  <strong style="font-size: 18pt;">[ รายการยา ]</strong> วันที่ปรับปรุงล่าสุด <u><?= $arr["dateform"]; ?></u>
</p>

<div id="show_druglst">
<?php
// แสดงรายการตาม SESSION
include_once 'add_drug_template.php';
?>
</div>
<!-- end show_druglst -->

<div class="base-container">
<style>
	.drug-off-container{
		margin: auto;
		width: 50%;
	}
	.drug-off-container table tr th{
		text-align: center;
		font-weight: bold;
	}
	.drug-off-container h3, .drug-group h3{
		text-align: center;
		margin-bottom: 0;
	}
	.drug-group{
		margin-bottom: 1em;
		margin: auto;
		width: 85%;
	}

	.drug-group table tr.font_title{
		background-color: #009688;
		color:#ffffff;
		font-weight: bold;
	}
	.drug-group table tr{
		background-color: #00CC99;
	}
</style>
<?php
$sql = sprintf("SELECT DISTINCT `drugcode`, `row_id`, `unit`, `tradname`, `slcode`, `amount`, `part`,`statcon` 
FROM `dgprofile` WHERE `an` = '%s' 
AND (`onoff` = 'OFF' AND `statcon` = 'CONT')", $dbi->real_escape_string($_GET['an']));
$result = $dbi->query($sql);
$rows = $result->num_rows;
if($rows>0){
?>
<div class="drug-off-container drug-group">
	<div><h3>รายการยาที่ OFF</h3></div>
	<table width="100%">
		<tr class="font_title" style="background-color: #009688;">
			<th width="110">รหัสยา</th>
			<th>ชื่อยา</th>
			<th>วิธีใช้</th>
			<th>จำนวน</th>
			<th>สถานะ</th>
			<th>ON</th>
		</tr>
		<?php
		while($arr = $result->fetch_assoc()){
			?>
			<tr style="background-color: #00CC99;">
				<td><?= $arr["drugcode"]; ?></td>
				<td><?= $arr['tradname']; ?></td>
				<td><?= $arr["slcode"]; ?></td>
				<td><?= $arr["amount"]; ?></td>
				<td><?= $arr["statcon"]; ?></td>
				<td align="center">
					<a href="javascript:void(0);" onclick="isEnable('<?= $_GET['an'] ?>','<?=$arr['row_id'];?>','<?=$arr['drugcode'];?>','<?=$arr['tradname'];?>','<?=$arr['unit'];?>','<?=$arr['part'];?>','<?=$arr['slcode'];?>','<?=$arr['amount'];?>')">ON</a>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
	<script>
		function isEnable(an,row_id,drugcode,tradname,unit,part,slcode,amount){
			// document.getElementById('drugcode').value=drugcode;
			// document.getElementById('drugname').value=tradname;
			// document.getElementById('unit').value=unit;
			// document.getElementById('unit2').value=part;
			// document.getElementById('drugslip').value=slcode;
			// document.getElementById('statcon').options[3].selected = true;
			// document.getElementById('amount').value=amount;
			// add_session();

			setToOn(an,row_id).then((res)=>{
				if(res.status==200){
					location.reload();
				}else{
					Swal.fire({
						icon: "error",
						title: 'ไม่สามารถแก้ไขได้',
						html: `<b>ปัญหา:</b> ${res.msg}`,
					});
				}
			});
		}

		async function setToOn(an,row_id){
			const response = await fetch(`add_drug2.php?action=setOn&an=${an}&row_id=${row_id}`);
			const body = await response.json();
			return body;
		}
	</script>
</div>
<?php
} // รายการยาที่ OFF
?>
<!-- end drugoff -->

<div class="drug-stat drug-group">
	<h3>รายการยาที่เคยจ่าย (STAT)</h3>
	
	<table width="100%">
	<tr align="center" bgcolor="#009688" class="font_title">
		<td>วันที่</td>
		<td width="110">รหัสยา</td>
		<td>ชื่อยา</td>
		<td width="50">วิธีใช้</td>
		<td width="40">จำนวน</td>
		<td width="70">Unit</td>
	</tr>
	<?php
	$sql = sprintf("SELECT DISTINCT `drugcode`,`date`,`unit`,`tradname`,`slcode`,`part`,`amount`
	FROM `dgprofile` 
	WHERE `an` = '%s' 
	AND `statcon` = 'STAT' 
	AND `date` < '$Thidate' 
	ORDER BY `date` DESC ", $dbi->real_escape_string($_GET['an']));
	$q2 = $dbi->query($sql);
	if($q2->num_rows>0){
		while($arr = $q2->fetch_assoc()){
		echo "<tr>
			<td>".$arr['date']."</td>
			<td><A HREF=\"javascript:void(0);\" Onclick=\"
			document.getElementById('amount').focus();
			document.getElementById('drugcode').value='",$arr["drugcode"],"';
			document.getElementById('drugname').value='",jschars($arr["tradname"]),"';
			document.getElementById('unit').value='",$arr["unit"],"';
			document.getElementById('unit2').value='",$arr["part"],"';
			document.getElementById('drugslip').value='",$arr["slcode"],"';
			document.getElementById('statcon').options[1].selected = true;
			\" >",$arr["drugcode"],"</A></td>
			<td>".$arr['tradname']."</td>
			<td>",$arr["slcode"],"</td>
			<td>".$arr['amount']."</td>
			<td>".$arr['unit']."</td>
		</tr>";
		} // end while
	}else{
		?>
		<tr>
			<td colspan="6"><p style="text-align:center;"><strong>ยังไม่มีข้อมูล</strong></p></td>
		</tr>
		<?php
	}
	?>
	</table>
</div><!-- รายการยาที่เคยจ่าย -->

<div class="drug-old drug-group">
	<h3>รายการยาเดิม</h3>
	<table width="100%">
	<tr align="center" class="font_title">
		<td width="110">รหัสยา</td>
		<td>ชื่อยา</td>
		<td width="50">วิธีใช้</td>
		<td width="40">จำนวน</td>
		<td width="70">Unit</td>
	</tr>
	<?php
	$sql = sprintf("SELECT DISTINCT `drugcode`,`unit`,`tradname`,`slcode`,`part`,`amount`
	FROM `dgprofile_old` 
	WHERE `an` = '%s' 
	AND  `statcon` = 'OLD'", $dbi->real_escape_string($_GET['an']));
	$res = $dbi->query($sql);
	if($res->num_rows>0){
		while($arr = $res->fetch_assoc()){
		echo "<TR>
			<td><A HREF=\"javascript:void(0)\" Onclick=\"
			document.getElementById('amount').focus();
			document.getElementById('drugcode').value='",$arr["drugcode"],"';
			document.getElementById('drugname').value='",jschars($arr["tradname"]),"';
			document.getElementById('unit').value='",$arr["unit"],"';
			document.getElementById('unit2').value='",$arr["part"],"';
			document.getElementById('drugslip').value='",$arr["slcode"],"';
			document.getElementById('statcon').options[4].selected = true;
			\" >",$arr["drugcode"],"</A></td>
			<td>".$arr['tradname']."</td>
			<td>",$arr["slcode"],"</td>
			<td>".$arr['amount']."</td>
			<td>".$arr['unit']."</td>
		</TR>";
		}
	}else{
		?>
		<tr>
			<td colspan="5"><p style="text-align:center;"><strong>ยังไม่มีข้อมูล</strong></p></td>
		</tr>
		<?php
	}
	?>
	</table>
</div><!-- รายการยาเดิม -->

</div>

<script>
function getAttributeItem(row_id,input_id,v,j){
	if(v.length<1){
		return false;
	}
	const tdContainer = document.getElementById(input_id).getAttribute('data-container');
	loadDrugSlip(row_id,input_id,v).then((res)=>{
		if(res!=='0'){
			let testContainer = document.getElementById('drugslip-container');
			if(testContainer){
				document.getElementById('drugslip-container').remove();
			}
			let htmlContain = `<div style="position:relative; top:0; left:-240px;" id="drugslip-container">
				<div style="position:absolute; top:0; left:0; padding: 4px; width:600px; color:black; background-color:#ffffff;" id="drugslip-content">${res}</div>
			</div>`;
			document.getElementById(tdContainer).insertAdjacentHTML('beforeend', htmlContain);
		}
	});
}

async function loadDrugSlip(row_id,input_id,v,j){
	url = 'add_drug2.php?action=drugslip2&search='+v+'&return='+input_id+'&container=drugslip-container&row_id='+row_id+'&ii='+j;
	const response = await fetch(url);
	const body = await response.text();
	return body;
}

function selectSlip(row_id, divId,slcode,container,j){

	// ส่งค่าไปอัพเดท slcode
	onUpdateSlcode(row_id,slcode,j).then((res)=>{
		if(res.status==200){

			udpateSuccessFulToast();

			document.getElementById(divId).value=slcode;
			document.getElementById(container).remove();
		}else{
			Swal.fire({
				icon: "error",
				title: "ไม่สามารถบันทึกข้อมูลได้ Error: "+res.msg
			});
		}
	});
}

async function onUpdateSlcode(row_id,slcode,j){
	url = 'add_drug2.php?action=update_drugslip&row_id='+row_id+'&slcode='+slcode+'&ii='+j;
	const response = await fetch(url);
	const body = await response.json();
	return body;
}

function updateAmount(row_id,drugcode,v){
	onUpdateAmount(row_id,drugcode,v).then((res)=>{
		if(res.status===200){
			udpateSuccessFulToast();
		}else{
			Swal.fire({
				icon: "error",
				title: "ไม่สามารถบันทึกข้อมูลได้ Error: "+res.msg
			});
		}
	});
}

async function onUpdateAmount(row_id,drugcode,v){
	url = 'add_drug2.php?action=update_amount&row_id='+row_id+'&drugcode='+drugcode+'&amount='+v;
	const response = await fetch(url);
	const body = await response.json();
	return body;
}

async function udpateSuccessFulToast(){
	const Toast = Swal.mixin({
	toast: true,
	position: "top-end",
	showConfirmButton: false,
	timer: 1000,
	timerProgressBar: true,
	didOpen: (toast) => {
		toast.onmouseenter = Swal.stopTimer;
		toast.onmouseleave = Swal.resumeTimer;
	}
	});
	Toast.fire({
		icon: "success",
		title: "อัพเดทข้อมูลเรียบร้อย"
	});
}

function updateStatdrugSession(i, row_id, value){

	if(row_id!==''){
		var test_str = [];
		test_str.push(encodeURIComponent('action')+"="+encodeURIComponent('changeSession'));
		test_str.push(encodeURIComponent('i')+"="+encodeURIComponent(row_id));
		test_str.push(encodeURIComponent('value')+"="+encodeURIComponent(value));
		var data = test_str.join("&");

		var request = new newXmlHttp();
		request.open('POST', 'add_drug2.php', true);
		request.setRequestHeader(
			'Content-Type',
			'application/x-www-form-urlencoded; charset=UTF-8'
		);
		request.onreadystatechange = function () {
			if (request.readyState === 4) {
				if (request.status >= 200 && request.status < 400) { 
					var res = request.responseText.replace(/^\s+|\s+$/g, '');;
					if(res=='CONT'){
						document.getElementById("trParent"+i).style.backgroundColor = '#00CC99';
					}else{
						document.getElementById("trParent"+i).style.backgroundColor = '#FFFFCC';
					}

					udpateSuccessFulToast();
				}else{
					//error
				}
			}
		}
		request.send(data);
	}else{
		if(value=='CONT'){
			document.getElementById("trParent"+i).style.backgroundColor = '#00CC99';
		}else{
			document.getElementById("trParent"+i).style.backgroundColor = '#FFFFCC';
		}
	}
}

var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('firstdate'));
	dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('enddate'));

	// Button ESC for Close Popup
	document.addEventListener("keydown", (event) => {
		if (event.isComposing || event.keyCode === 27) {
			document.getElementById('listdrugcode').innerHTML='';
		}
	});
		
};

function newXmlHttp(){
	var xmlhttp = false;

	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
	try{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			xmlhttp = false;
		}
	}

	if(!xmlhttp && document.createElement){
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function searchSuggest2(action,str) {
	
	if(!submit_button(action)){
		return false;
	}

	if(str.length >= 2){
		url = 'add_drug2.php?action='+action+'&an=<?=$my_an;?>&search='+str;
		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);
		document.getElementById("listdrugcode").innerHTML = xmlhttp.responseText;
	}else{
		document.getElementById("listdrugcode").innerHTML = '';
	}
}

var returnstr = '';
function update_field(drugcode,tradname,unit,part,slcode){ 
	document.getElementById('drugcode').focus();
	document.getElementById('drugcode').value=drugcode;
	document.getElementById('drugname').value=tradname;
	document.getElementById('unit').value=unit;
	document.getElementById('unit2').value=part;
	document.getElementById('drugslip').value=slcode;
	document.getElementById('listdrugcode').innerHTML = '';
}


function submit_button(action){
	
	if(event.keyCode == 13){
		if(action == "drugcode")
			document.getElementById('drugslip').focus();
		else if(action == "drugslip")
			document.getElementById('amount').focus();
		else if(action == "amount")
			document.getElementById('statcon').focus();
		else if(action == "statcon")
			document.getElementById('button_submit').focus();

		return false;
	}else{
		return true;
	}

}

function checkData(){
	var stat = true;
	var txt = "";
	if(document.getElementById('drugcode').value == ""){
		txt = txt+"- รหัสยา<br>";
		stat = false;
	}

	if(document.getElementById('drugslip').value == ""){
		txt = txt+"- วิธีใช้<br>";
		stat = false;
	}

	if(document.getElementById('amount').value == ""){
		txt = txt+"- จำนวน<br>";
		stat = false;
	}

	if(document.getElementById('statcon').value == ""){
		txt = txt+"- สถานะ<br>";
		stat = false;
	}
	
	if(stat == false){
		Swal.fire({
			title: 'ข้อมูลไม่ครบถ้วน กรุณาตรวจสอบข้อมูล',
			html: txt
		});
	}
	return stat;
}

function clearData(){
	
	document.getElementById('drugcode').value = "";
	document.getElementById('drugname').value = "";
	document.getElementById('drugslip').value = "";
	document.getElementById('amount').value = "";
	document.getElementById('unit').value = "";
	document.getElementById('unit2').value = "";
	document.getElementById('statcon').options[0].selected = true;
	document.getElementById('firstdate').value = "";
	document.getElementById('enddate').value = "";	

}

async function drug_interaction(drugcode){
	let res = await doCheckDrugInteraction(drugcode);
	let returnStatus = true;
	if(res!=='0'){
		await Swal.fire({
			html: res,
			showCancelButton: false,

			showDenyButton: true,
			denyButtonText: `ยกเลิก`,
			
  			confirmButtonText: "ยืนยัน",
			confirmButtonColor: "#3085d6",
		}).then((result)=>{
			if(result.isDenied){
				returnStatus = false;
			}
		});
	}
	return returnStatus;
}

async function doCheckDrugInteraction(drugcode){
	url = 'add_drug2.php?action=drug_interaction&drugcode='+ drugcode;
	const response = await fetch(url);
	const body = await response.text();
	return body;
}

/**
 * เพิ่มข้อมูลเข้าไปใน $_SESSION
 */
async function add_session(){

	if(checkData() == true){
		
		let an = '<?=$_GET["an"];?>';
		let drugcode = document.getElementById('drugcode').value;
		let slcode = document.getElementById('drugslip').value;
		let tradname = document.getElementById('drugname').value;
		let part = document.getElementById('unit2').value; // ประเภทคือ unit2
		let unit = document.getElementById('unit').value; // หน่วยคือ unit
		let amount = document.getElementById('amount').value;
		let statcon = document.getElementById('statcon').value;
		let firstdate = document.getElementById('firstdate').value;
		let enddate = document.getElementById('enddate').value;

		var drug_alert = [<?=implode(',', $drugreact_list_js);?>];
		var drug_notify = [<?=implode(',', $drugreact_groups_js);?>];

		if(drug_alert.indexOf(drugcode.trim())>-1){

			var resConfirm = confirm("!!! คำเตือน !!! \n >>> ผู้ป่วยมีการแพ้ยาตัวนี้ <<< \nคลิก OK เพื่อกรอกแบบฟอร์ม Rechallenge หากต้องการสั่งยาต่อไป\nคลิก Cancel เพื่อยกเลิก");
			if (resConfirm===true) {

				returnstr = [drugcode,tradname,unit,part,slcode].join('|');

				var url = 'phar_rechallenge.php?hn='+encodeURIComponent('<?=$bed["hn"];?>');
				url += '&drugcode='+encodeURIComponent(drugcode);
				url += '&returnstr='+returnstr;
				url += '&an='+encodeURIComponent(an);

				window.open(url,"myWindow","width=600,height=300,left=100,top=100");

			}else{
				return false;
			}

		}else{
			if(drug_notify.indexOf(drugcode.trim())>-1){
				alert("ยาที่สั่งใช้ เป็นยาในกลุ่มเดียวกับยาที่ผู้ป่วยมีโอกาสแพ้ยา");
			}
		}
	
		// ถ้าไม่แพ้จะ return เป็น 0 
		// ถ้าแพ้จะ return เป็นข้อความให้คอนเฟิร์ม
		let res = await drug_interaction(document.getElementById('drugcode').value);
		if(res===false){
			return false;
		}

		action = "add";
		url = 'add_drug2.php?action=add';
		url += '&drugcode='+encodeURIComponent(drugcode)
		url += '&tradname='+encodeURIComponent(tradname);
		url += '&slcode='+encodeURIComponent(slcode);
		url += '&amount='+encodeURIComponent(amount);
		url += '&statcon='+encodeURIComponent(statcon);
		url += '&part='+encodeURIComponent(part);
		url += '&an='+encodeURIComponent(an);
		url += '&firstdate='+encodeURIComponent(firstdate);
		url += '&enddate='+encodeURIComponent(enddate);
		url += '&unit='+encodeURIComponent(unit);
		url += '&bed='+encodeURIComponent('<?= $_GET['bed'] ?>');
		url += '&bedcode='+encodeURIComponent('<?= $_GET['bedcode'] ?>');
		url += '&date='+encodeURIComponent('<?= $_GET['date'] ?>');

		xmlhttp = newXmlHttp();

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				// Typical action to be performed when the document is ready:
				
				document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
				clearData();
			}
		};
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById('drugcode').focus();

		// location.reload();

		// list_off();
	}
}

function del_session(delnum,rowid){

	if(rowid != ""){
		txt = "คุณต้องการ OFF ยา ใช่หรือไม่";
		rowid = "&rowid="+rowid;
	}else{
		txt = "คุณต้องการ ลบ ยาออกจากรายการใช่หรือไม่";
	}
	if(confirm(txt)){
		action = "del";
		an = '<?=$_GET["an"];?>';
		url = 'add_drug2.php?action=del&delnum='+delnum+'&an='+an+'&rowid='+rowid;
		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);

		xmlhttp.onreadystatechange = function () {
		if (this.readyState === 4) {
			if (this.status >= 200 && this.status < 400) {
				// Success!
				var data = JSON.parse(this.responseText);
				if(data.status==200){
					location.reload();
				}
				
			} else {
				// Error :(
			}
		}
		};
		xmlhttp.send(null);
	}
}

/**
 * แก้ไขข้อมูล คือส่งค่าจากใน table นั่นล่ะเข้าไปอัพเดทใน db กับ session แล้ว return กลับมาเป็นตาราง
 */
function edit_list(delnum,rowid,slcode,amount,statusdrug){

	txt = "คุณต้องการ แก้ไขข้อมูล ใช่หรือไม่";

	get_slcode = "&slcode="+slcode;
	get_amount = "&amount="+amount;
	get_stat = "&statcon="+statusdrug;
	if(slcode == 'OLD'){
		amount = 0;
	}

	if(rowid != ""){
		rowid = "&rowid="+rowid;
	}else{
		rowid = "";
	}
	if(slcode == "" || amount == ""){
		alert("กรุณา กรอกข้อมูล วิธีใช้ และ จำนวนยาให้ครบด้วยครับ");
	}else if(confirm(txt)){
		
		an = '<?=$_GET["an"];?>';
		url = 'add_drug2.php?action=edit&delnum='+delnum+'&an='+an+get_slcode+get_amount+rowid+get_stat;
		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		// location.reload();

		// @todo แล้วถ้าไม่ใช้แบบเก่าล่ะ คือปล่อยให้มันทำงานไปแล้วแล้ว refresh หน้านี้แทน
		// document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
		// list_off();
	}
}

function drug_alert(drugcode,hn){

	var return_drug_alert;

	xmlhttp = newXmlHttp();
	url = 'add_drug2.php?action=drug_alert&drugcode='+ drugcode+'&hn='+hn;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return_drug_alert = xmlhttp.responseText;
	return_drug_alert = return_drug_alert.substr(4);
	
	if(return_drug_alert != "0"){
		if(confirm(return_drug_alert)){
			return true;
		}else{
			return false;
		}
			
	}else{
		return true;
	}

}


/**
 * @important !!!Terminate!!!
 */
function list_off(){
	action = "list_off";
	if(layer1.style.display == 'none')
		hidd = "0";
	else
		hidd = "1";

	url = 'listAjax.php?action=list_off&an=<?=$_GET["an"];?>&stat='+hidd;
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_listoff").innerHTML = xmlhttp.responseText;
}

/**
 * @important !!!Terminate!!!
 */
function searchSuggest(action,str) {
	
	if(!submit_button(action)){
		return false;
	}

	if(action == 'drugcode')
		lengthsearch = 3;
	else
		lengthsearch = 2;

	str = str+String.fromCharCode(event.keyCode);
	if(str.length >= lengthsearch){
		url = 'listAjax.php?action='+action+'&search=' + str;

		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById("listdrugcode").innerHTML = xmlhttp.responseText;
	}
}
</SCRIPT>

</body>
</html>