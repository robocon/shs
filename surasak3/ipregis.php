<?php
session_start();
if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}

include("connect.php");

$sOfficer = $_SESSION["sOfficer"];
$thidate = (date("Y") + 543) . date("-m-d H:i:s");

$Bcode = $_GET['Bcode'];
if(empty($_GET['Bcode'])){
	$Bcode = $_SESSION['cBedcode'];
}

$rward = substr($Bcode, 0, 2);
if ($rward == '42') {
	$wname = 'หอผู้ป่วยรวม';
} elseif ($rward == '43') {
	$wname = 'หอผู้ป่วยสูติ';
} elseif ($rward == '44') {
	$wname = 'หอผู้ป่วยICU';
} elseif ($rward == '45') {
	$wname = 'หอผู้ป่วยพิเศษ';
} elseif ($rward == '46') {
	$wname = 'หอผู้ป่วย Cohort Ward';
} elseif ($rward == '47') {
	$wname = 'หอผู้ป่วย Home Isolation';
} elseif ($rward == '48') {
	$wname = 'หอผู้ป่วย รพ.สนาม';
}

function calcage($birth)
{
    $today = getdate();
    $nY = $today['year'];
    $nM = $today['mon'];
    $bY = substr($birth, 0, 4) - 543;
    //$bY=substr($birth,0,4);
    $bM = substr($birth, 5, 2);
    $ageY = $nY - $bY;
    $ageM = $nM - $bM;
    if ($ageM < 0) {
        $ageY = $ageY - 1;
        $ageM = 12 + $ageM;
    }
    if ($ageM == 0) {
        $pAge = "$ageY ปี";
    } else {
        $pAge = "$ageY ปี $ageM เดือน";
    }
    return $pAge;
}

$diag = $_POST['diag'];
$diag1 = $_POST['diag1'];
$addfood = $_POST['addfood'];
$repadmit = $_POST['rep'];
if ($repadmit == "other") {
	$hospital = $_POST['hosother'];
} else {
	$hospital = "";
}

$foodContainer = (!empty($_POST['food_container'])) ? sprintf("%s", $_POST['food_container']) : '';
$foodContainerText = "ไม่ต้องการแยกภาชนะ";
if ($foodContainer == "1") {
	$foodContainerText = "แยกภาชนะ";
}

$hn = $_GET['hn'];
$query = "SELECT * FROM `opcard` WHERE `hn` = '$hn'";
$result = mysql_query($query) or die("Query failed : ".mysql_error());
$row = mysql_fetch_object($result);
if ($result) {
	$cHn = $row->hn;
	$cYot = $row->yot;
	$cName = $row->name;
	$cSurname = $row->surname;
	$cPtname = $row->yot.$row->name.' '.$row->surname;
	$cPtright = $row->ptright;
	$cGoup = $row->goup;
	$cCamp = $row->camp;
	$cIdcard = $row->idcard;
	$cAddress = $row->address;
	$cMuang = "ต. $row->tambol  อ. $row->ampur  จ. $row->changwat";
	$cAge = calcage($row->dbirth);
}

$doctor = $_POST['doctor'];
$typeadmit = $_POST['typeadmit'];
$weight = $_POST['weight'];
$cAn = $_GET['an'];
$cAdmitd = $_POST['cAdmitd'];
if(empty($cAdmitd)){
	$cAdmitd = $_SESSION['cAdmitd'];
}

if ($_REQUEST['do'] == 'first') {

	$sql = "UPDATE ipcard SET date= DATE_ADD(NOW(), INTERVAL 543 YEAR), 
	ptname='$cPtname',
	age='$cAge',
	ptright='$cPtright',
	goup='$cGoup',
	camp='$cCamp',	
	bedcode='$Bcode',
	diag='$diag',
	doctor='$doctor',
	repadmit='$repadmit',
	hospital='$hospital',
	typeadmit='$typeadmit',
	weight='$weight' 
	WHERE an='$cAn';";
	$result = mysql_query($sql) or die(mysql_error() . " Query failed ipcard");

	$sql = "UPDATE opday SET ptright='$cPtright',
	goup='$cGoup',
	camp='$cCamp',
	diag='$diag',
	doctor='$doctor' 
	WHERE an='$cAn';";
	$result = mysql_query($sql) or die(mysql_error() . " Query failed ipcard");

	$query11 = "SELECT hi_type FROM ipcard WHERE an = '$cAn'";
	$result11 = mysql_query($query11);
	$rows11 = mysql_num_rows($result11);
	$arr = mysql_fetch_array($result11);

	$subbedcode = substr($Bcode, 0, 2);
	$subptright = substr($cPtright, 0, 3);

	if ($subbedcode == "47") {  //Ward Home Isolation
		if ($subptright == "R02" || $subptright == "R03" || $subptright == "R04" || $subptright == "R16" || $subptright == "R33") {

			// เท่าที่ลองแกะคือ ราคา bedpri ต่างกันเฉยๆ
			if ($arr["hi_type"] == "in") {
				$bedpri='1000.00';
				//// ward_log  admit ครั้งแรก  ////
			} else if ($arr["hi_type"] == "out") {
				$bedpri='1000.00';
				//// ward_log  admit ครั้งแรก  ////
			} else {
				$bedpri='0.00';
				//// ward_log  admit ครั้งแรก  ////
			}
			
		} else { //สิทธิอื่นๆ
			$bedpri='0.00';
			//// ward_log  admit ครั้งแรก  ////
		}

		$query = "UPDATE bed SET ptname='$cPtname',age='$cAge',idcard='$cIdcard',address='$cAddress',
		muang='$cMuang',ptright='$cPtright',doctor='$doctor',date='$cAdmitd',hn='$cHn',
		an='$cAn',diagnos='$diag',diag1='$diag1',food='$food $addfood $foodContainerText',officer='',lastcalroom='$cAdmitd',chgdate='$cAdmitd',chgwdate='$cAdmitd',accno=1,bedpri='$bedpri'  WHERE bedcode='$Bcode' ";
		$result = mysql_query($query) or die("Query failed bed");

	} else if ($subbedcode == "48") { //Ward รพ.สนาม
		if ($subptright == "R07" || $subptright == "R50") {  //สิทธิประกันสังคม
			
			$bedpri='1500.00';
			//// ward_log  admit ครั้งแรก  ////
		} else { //สิทธิอื่นๆ

			$bedpri='1000.00';
			//// ward_log  admit ครั้งแรก  ////
		}

		$query = "UPDATE bed SET ptname='$cPtname',age='$cAge',idcard='$cIdcard',address='$cAddress',
		muang='$cMuang',ptright='$cPtright',doctor='$doctor',date='$cAdmitd',hn='$cHn',
		an='$cAn',diagnos='$diag',diag1='$diag1',food='$food $addfood $foodContainerText',officer='',lastcalroom='$cAdmitd',chgdate='$cAdmitd',chgwdate='$cAdmitd',accno=1,bedpri='$bedpri'  WHERE bedcode='$Bcode' ";
		$result = mysql_query($query) or die("Query failed bed");

	} else { //Ward อื่นๆ
		
		$query = "UPDATE bed SET ptname='$cPtname',age='$cAge',idcard='$cIdcard',address='$cAddress',
                muang='$cMuang',ptright='$cPtright',doctor='$doctor',date='$cAdmitd',hn='$cHn',
                an='$cAn',diagnos='$diag',diag1='$diag1',food='$food $addfood $foodContainerText',officer='',lastcalroom='$cAdmitd',chgdate='$cAdmitd',chgwdate='$cAdmitd',accno=1  WHERE bedcode='$Bcode' ";
		$result = mysql_query($query) or die("Query failed bed");
		//// ward_log  admit ครั้งแรก  ////
	}

	$chgcode = "Admit/1";

	$sql_ward = "INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) VALUES ( '" . $thidate . "', '" . $cAn . "', '" . $cHn . "', '" . $wname . "', '" . $Bcode . "','" . $chgcode . "', '', '" . $Bcode . "', '', '" . $cAdmitd . "',  '" . $sOfficer . "')";
	$result_ward = mysql_query($sql_ward) or die(mysql_error());

} elseif ($_REQUEST['do'] == 'second') {

	$query = "UPDATE bed SET ptname='$cPtname',age='$cAge',idcard='$cIdcard',address='$cAddress',
	muang='$cMuang',ptright='$cPtright',doctor='$doctor',date='$cAdmitd',hn='$cHn',
	an='$cAn',diagnos='$diag',diag1='$diag1',food='$food $addfood $foodContainerText',officer='',lastcalroom='$cAdmitd',chgdate='$cAdmitd',chgwdate='$cAdmitd',accno=1  WHERE bedcode='$Bcode' ";
	$result = mysql_query($query) or die("Query failed bed");

	//// ward_log  admit ครั้งแรก ////
	$chgcode = "Admit/2";

	$sql_ward = "INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) VALUES ( '" . $thidate . "', '" . $cAn . "', '" . $cHn . "', '" . $wname . "', '" . $Bcode . "','" . $chgcode . "', '', '', '', '" . $cAdmitd . "',  '" . $sOfficer . "')";
	$result_ward = mysql_query($sql_ward) or die(mysql_error());

	$sql = "UPDATE ipcard SET 
	repadmit='$repadmit',
	hospital='$hospital'
	WHERE an='$cAn';";
	$result = mysql_query($sql) or die(mysql_error() . " Query failed ipcard");
}

?>
<style>
	:root{
		font-family: "TH SarabunPSK";
		font-size: 18px;
	}
	p,h3{
		margin:0;
		padding:0;
	}
</style>
<?php

if ($Bcode == "42R5") $room_name = "ค่าห้องพิเศษ ($price บาท)";
if ($Bcode == "42R8") $room_name = "ค่าห้องแยกโรค ($price บาท)";
if ($price != "") {
	$query = "UPDATE bed SET bedpri='$price',bedname='$room_name'  WHERE bedcode='$Bcode' ";
	$result = mysql_query($query) or die("Query failed bedpri");
}
if (!$result) {
	echo "ipregis fail";
	echo mysql_errno() . ": " . mysql_error() . "\n";
	echo "<br>";
} else {
	?>
	<h3><center>ลงทะเบียนรับป่วยเรียบร้อย</center></h3>
	<p><strong>HN</strong>: <?= $cHn; ?></p>
	<p><strong>AN</strong>: <?= $cAn; ?></p>
	<p><strong>ชื่อ-สกุล</strong>: <?= $cYot.$cName.' '.$cSurname; ?></p>
	<p><strong>สิทธิการรักษา</strong>: <?= $cPtright; ?></p>
	<?php
	$rward = substr($Bcode, 0, 2);
	
}
//session_destroy();
session_unregister("cAdmitd");
session_unregister("cHn");
session_unregister("cAn");
session_unregister("cYot");
session_unregister("cName");
session_unregister("cSurname");
session_unregister("cPtright");
session_unregister("cIdcard");
session_unregister("cAge");
session_unregister("cAddress");
session_unregister("cMuang");
session_unregister("cGoup");
session_unregister("cCamp");
?>
<p><a href="allward.php?code=<?= $rward ?>">🏠 กลับหน้า หอผู้ป่วย</a></p>