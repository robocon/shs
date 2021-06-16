<?php
session_start();
$thdatehn="";
session_register("thdatehn"); 

include("connect.inc");   

if(strlen(trim($idcard)) == 13){
	$cHn = $_POST["hn"];
	$sql = "Select hn From opcard where idcard='$idcard' AND hn<>'$cHn' limit 0,1 ";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		list($chk_idcard) = mysql_fetch_row($result);
		echo "<CENTER>ไม่สามารถแก้ไขข้อมูลได้เนื่องจาก เลขบัตรประชาชน $idcard ถูกใช้โดย HN : $chk_idcard </CENTER>";
		exit();
	}
}

$thidate = (date("Y")+543).date("-m-d H:i:s"); 

Function calcage($birth){
	$today = getdate();   
	$nY = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;
	if ( $ageM < 0 ) {
		$ageY = $ageY-1;
		$ageM = 12+$ageM;
	}
	if ($ageM==0){
		$pAge = "$ageY ปี";
	}else{
		$pAge = "$ageY ปี $ageM เดือน";
	}
	return $pAge;
}

//$Y=($y-543);
//$dbirth="$Y-$m-$d";
$dbirth = "$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
$cAge = calcage($dbirth);

//update opdcard table
extract($_POST);

$hospcode = $_POST['hospcode'];
$ptrcode = $_POST['rdo1'];
$employee = ( isset($_POST['employee']) && $_POST['employee'] === 'y' ) ? 'y' : 'n' ;
$typearea = $_POST['typearea'];

$cHn = $_POST["hn"];

$sql = "UPDATE opcard SET idcard = '$idcard',
	mid = '$mid',
	hn = '$cHn',
	yot = '$yot',
	name = '$name',
	surname = '$surname',
	education = '$education',
	goup = '$goup',
	married = '$married',
	dbirth = '$dbirth',
	guardian = '$guardian',
	idguard = '$idguard',
	nation = '$nation',
	religion = '$religion',
	career = '$career',
	ptright = '$ptright1',
	ptrightdetail = '$ptrightdetail',
	address = '$address',
	tambol = '$tambol',
	ampur = '$ampur',
	changwat = '$changwat',
	phone = '$phone',
	father = '$father',
	mother = '$mother',
	couple = '$couple',
	note = '$note',
	note_vip = '$note_vip',
	sex = '$sex',
	camp = '$camp',
	race = '$race',
	ptright1 = '$ptright1',
	ptf = '$ptf',
	ptfadd = '$ptfadd',
	ptffone = '$ptffone',
	lastupdate = '$thidate',
	officer ='".$_SESSION["sOfficer"]."',
	hospcode='".$hospcode."',
	ptrcode  = '$ptrcode',
	blood ='".$blood."',
	drugreact ='".$drugreact."',
	employee = '$employee',
	typearea = '$typearea',
	prename = '$prename',
	name_eng = '$name_eng',
	surname_eng = '$surname_eng',	
	passport = '$passport',
	house_no = '$address_eng',
	address_moo = '$address_moo',
	address_soi = '$address_soi',
	address_road = '$address_road',
	tambol_eng = '$tambol_eng',
	ampur_eng = '$ampur_eng',
	changwat_eng = '$changwat_eng'	 WHERE hn = '$cHn' ";
	//echo $sql;
$result = mysql_query($sql) or die("update failed opcard");

if(!$result){
	echo "update opcard fail";
	echo mysql_errno() . ": " . mysql_error(). "\n";
	echo "<br>";
} else {
	$sqlselect = "select * from condxofyear_so where hn='$cHn' ";
	$result = mysql_query($sqlselect) or die("Query failed condxofyear_so1");
	$numr = mysql_num_rows($result);
	if($numr == 0){

	}else{
		$sqlup ="update condxofyear_so set camp ='$camp' where hn='$cHn' ";
		$result = mysql_query($sqlup) or die("Query failed condxofyear_so2");
	}
}

$short_th_date = substr($thidate,0,10);
$date_hn = $short_th_date.$cHn;
$cid = trim($idcard);
$hn = $pid = $cHn;
$prename = trim($yot);
$name = trim($name);
$lname = trim($surname);
$sex = trim($sex);
$birth = trim($dbirth);
$mstatus = trim($married);
$occupation_new = trim($career);
$race = trim($race);
$nation = trim($nation);
$religion = trim($religion);
$education = trim($education);
// $father = trim($_POST['idcard_father']);
// $mother = trim($_POST['idcard_mother']);
// $couple = trim($_POST['idcard_couple']);
$father = NULL;
$mother = NULL;
$couple = NULL;
$abogroup = trim($blood);
$d_update = trim($thidate);
// $vstatus = $_POST['vstatus'];
$vstatus = NULL;

$telephone = str_replace(array(' ', '-'), '', trim($hphone));
$mobile = str_replace(array(' ', '-'), '', trim($phone));

$q = mysql_query("SELECT `id` FROM `PERSON` WHERE `date_hn` = '$date_hn' ");
if( mysql_num_rows($q) == 0 ){
	// insert 
	$sql = "INSERT INTO `PERSON` (
		`id`, `date_hn`, `HOSTPCODE`, `CID`, `PID`, `HID`, `PRENAME`, `NAME`, `LNAME`, `HN`, 
		`SEX`, `BIRTH`, `MSTATUS`, `OCCUPATION_OLD`, `OCCUPATION_NEW`, `RACE`, `NATION`, `RELIGION`, `EDUCATION`, `FSTATUS`, 
		`FATHER`, `MOTHER`, `COUPLE`, `VSTATUS`, `MOVEIN`, `DISCHARGE`, `DDISCHARGE`, `ABOGROUP`, `RHGROUP`, `LABOR`, 
		`PASSPORT`, `TYPEAREA`, `D_UPDATE`, `TELEPHONE`, `MOBILE`
	) VALUES (
		NULL, '$date_hn', '11512', '$cid', '$pid', NULL, '$prename', '$name', '$lname', '$hn', 
		'$sex', '$birth', '$mstatus', NULL, '$occupation_new', '$race', '$nation', '$religion', '$education', NULL, 
		'$father', '$mother', '$couple', '$vstatus', NULL, NULL, NULL, '$abogroup', NULL, NULL, 
		NULL, '$typearea', '$d_update', '$telephone', '$mobile'
	);";
	mysql_query($sql);
}else{ 
	$item = mysql_fetch_assoc($q);
	$person_id = $item['id'];
	// update
	$sql = "UPDATE `PERSON` SET 
	`date_hn`='$date_hn', `HOSTPCODE`='11512', `CID`='$cid', `PID`='$pid', `HID`=NULL, 
	`PRENAME`='$prename', `NAME`='$name', `LNAME`='$lname', `HN`='$hn', `SEX`='$sex', `BIRTH`='$birth', 
	`MSTATUS`='$mstatus', `OCCUPATION_OLD`=NULL, `OCCUPATION_NEW`='$occupation_new', `RACE`='$race', `NATION`='$nation', `RELIGION`='$religion', 
	`EDUCATION`='$education', `FSTATUS`=NULL, `FATHER`='$father', `MOTHER`='$mother', `COUPLE`='$couple', `VSTATUS`='$vstatus', 
	`MOVEIN`=NULL, `DISCHARGE`=NULL, `DDISCHARGE`=NULL, `ABOGROUP`='$abogroup', `RHGROUP`=NULL, `LABOR`=NULL, 
	`PASSPORT`=NULL, `TYPEAREA`='$typearea', `D_UPDATE`='$d_update', `TELEPHONE`='$telephone', `MOBILE`='$mobile' 
	WHERE (`id`='$person_id');";
	mysql_query($sql);
}
// จบการเก็บข้อมูลเข้า PERSON 

// เก็บข้อมูลเข้า ICF กับ DISABILITY 
$disabid = trim($_POST['disabid']);
if( $disabid != '' ){ 

	// อัพเดทฐานข้อมูลที่เก็บข้อมูลผู้พิการ
    $icf = trim($_POST['icf']);
    $disabtype = trim($_POST['disabtype']);
    $disabcause = trim($_POST['disabcause']);

	$sql = "SELECT `id` FROM `disabled_user` WHERE `hn` = '$pid' ";
	$q = mysql_query($sql);
	$num_disuser = mysql_num_rows($q);
	if( $num_disuser > 0 ){
		$sql = "UPDATE `disabled_user` SET 
		`idcard` = '$cid', 
		`disabid` = '$disabid', 
		`icf` = '$icf', 
		`disabtype` = '$disabtype', 
		`disabcause` = '$disabcause', 
		`lastupdate` = NOW()  
		WHERE `hn` = '$pid' ";
		mysql_query($sql); 
	}else{ 
		$date_dis = date('Ymd');
		$sql = "INSERT INTO `disabled_user` (
			`id`, `hn`, `idcard`, `disabid`, `icf`, `disabtype`, `disabcause`, `date_detect`, `date_disab`, `lastupdate` 
		) VALUES (
			NULL, '$pid', '$cid', '$disabid', '$icf', '$disabtype', '$disabcause', '$date_dis', '$date_dis', NOW() 
		);";
		mysql_query($sql);
	
	}
	
	
	// เก็บข้อมูลลงแฟ้ม icf
	$d_update = date('Ymdhis');
	$date_serv = date('Ymd');
	$seq = $date_serv.sprintf("%03d", $nVn);

	$sql = "SELECT `id` FROM `icf43` WHERE `opday_id` = '$opday_id' ";
	$q = mysql_query($sql);
	if ( mysql_num_rows($q) > 0 ) {
		
		$icf_item = mysql_fetch_assoc();
		$icf_id = $icf_item['id'];

		$sql = "UPDATE `icf43` SET 
		`disabid`='$disabid', 
		`pid`='$pid', 
		`seq`='$seq', 
		`date_serv`='$date_serv', 
		`icf`='$icf', 
		`d_update`='$d_update', 
		`cid`='$cid' 
		WHERE (`id`='$icf_id');";
		mysql_query($sql);
		
	} else {
		$sql = "INSERT INTO `icf43` (
			`id`, `hospcode`, `disabid`, `pid`, `seq`, `date_serv`, 
			`icf`, `qualifier`, `provider`, `d_update`, `cid`, `opday_id`
		) VALUES (
			NULL, '11512', '$disabid', '$pid', '$seq', '$date_serv', 
			'$icf', NULL, NULL, '$d_update', '$cid', '$opday_id'
		);";
		mysql_query($sql);

	} 

	// เก็บข้อมูลลงแฟ้ม disability
	$sql = "SELECT `id` FROM `disability43` WHERE `opday_id` = '$opday_id' ";
	$q = mysql_query($sql);
	if ( mysql_num_rows($q) > 0 ) {
		// 
		$sql = "UPDATE `disability43` SET 
		`disabid`='$disabid', 
		`disabtype`='$disabtype', 
		`disabcause`='$disabcause', 
		`d_update`='$d_update' 
		WHERE (`id`='$dis_id');";
		mysql_query($sql);
		
	} else { 
		$sql = "INSERT INTO `disability43` (
			`id`, `hospcode`, `disabid`, `pid`, `disabtype`, `disabcause`, 
			`diagcode`, `date_detect`, `date_disab`, `d_update`, `cid`, `opday_id`
		) VALUES (
			NULL, '11512', '$disabid', '$pid', '$disabtype', '$disabcause', 
			NULL, '$date_serv', '$date_serv', '$d_update', '$cid', '$opday_id'
		);";
		mysql_query($sql);
	}
}
// เก็บข้อมูลเข้า ICF กับ DISABILITY 

$sql_ipcard = "SELECT a.`row_id` AS `ipcard_id`, a.`hn`, a.`an`,b.`row_id` AS `bed_id` 
FROM (
	SELECT * FROM `ipcard` WHERE `hn` = '$cHn' AND `dcdate` = '0000-00-00 00:00:00' ORDER BY `row_id` DESC LIMIT 1
) AS a 
LEFT JOIN `bed` AS b ON a.`hn` = b.`hn` 
WHERE b.`row_id` IS NOT NULL";
$q_ipcard = mysql_query($sql_ipcard);
if($q_ipcard==true)
{
	if(mysql_num_rows($q_ipcard) > 0)
	{

		$ipd_item = mysql_fetch_assoc($q_ipcard);
		$ipcard_id = $ipd_item['ipcard_id'];
		$bed_id = $ipd_item['bed_id'];

		$update_sql_ipcard = "UPDATE `ipcard` SET `ptright` = '$ptright1' WHERE `row_id` = '$ipcard_id' ";
		$q_update_ipcard = mysql_query($update_sql_ipcard);
		if($q_update_ipcard!=true)
		{
			echo '<p><b>Error : </b>'.mysql_error().'</p>';
		}

		$update_sql_bed = "UPDATE `bed` SET `ptright` = '$ptright1' WHERE `row_id` = '$bed_id' ";
		$q_update_bed = mysql_query($update_sql_bed);
		if($q_update_bed!=true)
		{
			echo '<p><b>Error : </b>'.mysql_error().'</p>';
		}

		if($q_update_ipcard==true && $q_update_bed==true)
		{
			echo '<p><b>อัพเดท</b> ข้อมูลสิทธิการรักษาผู้ป่วยในเรียบร้อย</p>';
		}
	}
}
else
{
	echo '<p><b>Error : </b>'.mysql_error().'</p>';
}


// require_once 'opdwork_json.php';

print " แก้ไขข้อมูลเรียบร้อย: <br>";
print " ปิดหน้าต่างนี้: <br>";

include("unconnect.inc");
?>

<br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdprint.php">พิมพ์บัตรตรวจโรค,บัตรผู้ป่วย</a>.........&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdprintbc1.php">พิมพ์บาร์โค้ดบัตรตรวจโรค</a><br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdprint1bc.php">พิมพ์บัตรผู้ป่วยบาร์โค้ด</a><br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdprint2.php">พิมพ์บัตรต่อประวัติผู้ป่วย</a><br>

&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdprint1bc.">พิมพ์บัตรผู้ป่วยบาร์โค้ด</a><br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="edprint.php">พิมพ์ใบรับรองยานอก</a><br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdprint6.php">พิมพ์ กท.16/1</a><br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="rxformnvn.php">พิมพ์ใบสั่งยาไม่ออกVN</a><br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="vnprint.php">พิมพ์ใบตรวจโรคไม่ออก VN</a><br>
<br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdprint7.php">สำเนาประวัติการรักษาพยาบาล</a><br>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="otherpage.php">เก็บเงินอื่นๆ</a>
