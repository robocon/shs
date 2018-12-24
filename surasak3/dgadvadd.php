<?php
session_start();
include("connect.inc");
$no=0;

$aDrugcode = array("รหัส");
$aTradname  = array("รายการ");
$aAdvreact = array("อาการแพ้"); 
$aAsses  = array("ประเมิน");
$aReporter  = array("ผู้รายงาน");
$aRepdate= array("วันที่รายงาน");

$aDrugcode[1] = "$drugcode1";
$aTradname[1]  = "$tradname1";
$aAdvreact[1] = "$advreact1"; 
$aAsses[1]  = "$asses1";
$aReporter[1]  = "$reporter1";
$aRepdate[1] = "$repdate1";

$aDrugcode[2] = "$drugcode2";
$aTradname[2]  = "$tradname2";
$aAdvreact[2] = "$advreact2"; 
$aAsses[2]  = "$asses2";
$aReporter[2]  = "$reporter2";
$aRepdate[2] = "$repdate2";

$aDrugcode[3] = "$drugcode3";
$aTradname[3]  = "$tradname3";
$aAdvreact[3] = "$advreact3"; 
$aAsses[3]  = "$asses3";
$aReporter[3]  = "$reporter3";
$aRepdate[3] = "$repdate3";

$aDrugcode[4] = "$drugcode4";
$aTradname[4]  = "$tradname4";
$aAdvreact[4] = "$advreact4"; 
$aAsses[4]  = "$asses4";
$aReporter[4]  = "$reporter4";
$aRepdate[4] = "$repdate4";

$aDrugcode[5] = "$drugcode5";
$aTradname[5]  = "$tradname5";
$aAdvreact[5] = "$advreact5"; 
$aAsses[5]  = "$asses5";
$aReporter[5]  = "$reporter5";
$aRepdate[5] = "$repdate5";

$aDrugcode[6] = "$drugcode6";
$aTradname[6]  = "$tradname6";
$aAdvreact[6] = "$advreact6"; 
$aAsses[6]  = "$asses6";
$aReporter[6]  = "$reporter6";
$aRepdate[6] = "$repdate6";

$aDrugcode[7] = "$drugcode7";
$aTradname[7]  = "$tradname7";
$aAdvreact[7] = "$advreact7"; 
$aAsses[7]  = "$asses7";
$aReporter[7]  = "$reporter7";
$aRepdate[7] = "$repdate7";

echo"<font face='Angsana New'>ชื่อ: $sPtname,HN: $sHn, ";  
echo "สิทธิการรักษา: $sPtright<br>";

$error_list = array();

FOR ($no=1; $no<=7; $no++){
	IF (!empty($aTradname[$no])) {
		
		// Lock ให้ใส่โค้ดยาสำหรับการแพ้ยา(ใช้ใน 43แฟ้ม)
		/*
		$sql = "SELECT `drugcode` 
		FROM `druglst` 
		WHERE `drugcode` LIKE '".$aDrugcode[$no]."'";
		$q = mysql_query($sql);
		$drugRow = mysql_num_rows($q);
		if( $drugRow === 0 OR empty($aDrugcode[$no]) ){
			?>
			<script type="text/javascript">
				alert("ไม่พบ Drugcode(<?=$aDrugcode[$no];?>) ที่ตรงกับระบบ รพ. กรุณาตั้งโค้ดให้ถูกต้องตามระบบ รพ.");
				window.history.go(-1);
			</script>
			<?php
			exit;
		}
		*/
		
		echo "$aDrugcode[$no],$aTradname[$no],$aAdvreact[$no],$aAsses[$no],$aReporter[$no],$aRepdate[$no]<br>";
		
		//insert data into drugreact
		$sql = "INSERT INTO drugreact(`hn`,`drugcode`,`tradname`,`advreact`,`asses`,`reporter`,`date`,`officer`)
		VALUES('$sHn','$aDrugcode[$no]','$aTradname[$no]','$aAdvreact[$no]','$aAsses[$no]','$aReporter[$no]','$aRepdate[$no]','".$_SESSION['sOfficer']."')";
		$result = mysql_query($sql);
		if( $result === false ){
			$error_list[] = mysql_error();
		}

		// เก็บข้อมูลเข้าแฟ้ม drugallergy
		$test_drugcode = $aDrugcode[$no];
		$dname = $aTradname[$no];
		$typedx = $aAsses[$no];
		$symptom = $aAdvreact[$no];
		$provider = $_SESSION['sOfficer'];

		$q = mysql_query("SELECT `code24` FROM `druglst` WHERE `drugcode` LIKE '$test_drugcode'");
		$item = mysql_fetch_assoc($q);
		$drugallergy = $item['code24'];
		$daterecord = date('Ymd');
		$d_update = date('YmdHis');

		$q = mysql_query("SELECT `idcard` FROM `opcard` WHERE `hn` = '$sHn' ");
		$item = mysql_fetch_assoc($q);
		$cid = $item['idcard'];

		$q = mysql_query("SELECT `id` FROM `drugallergy` WHERE `PID` = '$sHn' AND `drugcode` = '$test_drugcode' ");
		$rows = mysql_num_rows($q);

		if( $rows > 0 ){

			// update 
			$item = mysql_fetch_assoc($q);
			$id = $item['id'];

			$sql = "UPDATE `drugallergy` SET 
			`HOSPCODE`='11512', `PID`='$sHn', `DATERECORD`='$daterecord', 
			`DRUGALLERGY`='$drugallergy', `DNAME`='$dname', `TYPEDX`='$typedx', 
			`ALEVEL`=NULL, `SYMPTOM`='$symptom', `INFORMANT`=NULL, 
			`INFORMHOSP`='11512', `D_UPDATE`='$d_update', `PROVIDER`='$provider', 
			`CID`='$cid', `drugcode` = '$test_drugcode' WHERE (`id`='$id');";
			mysql_query($sql);


		}else{

			$sql = "INSERT INTO `drugallergy` (
				`id`, `HOSPCODE`, `PID`, `DATERECORD`, `DRUGALLERGY`, `DNAME`, 
				`TYPEDX`, `ALEVEL`, `SYMPTOM`, `INFORMANT`, `INFORMHOSP`, `D_UPDATE`, 
				`PROVIDER`, `CID`, `drugcode`
			) VALUES (
				NULL, '11512', '$sHn', '$daterecord', '$drugallergy', '$dname', 
				'$typedx', NULL, '$symptom', NULL, '11512', '$d_update', 
				'$provider', '$cid', '$test_drugcode' 
			);";
			mysql_query($sql);

		}

		// เก็บข้อมูลเข้าแฟ้ม drugallergy

	}
}
////////////////
print "<br>บันทึกข้อมูลเรียบร้อย <br>";

if( count($error_list) > 0 ){
	$error_txt = implode('<br>', $error_list);
	echo "<hr><p>มีข้อมูลบางส่วนไม่สามารถบันทึกได้ กรุณาถ่ายรูปหน้าจอเพื่อส่งให้โปรแกรมเมอร์แก้ไข</p>".$error_txt;
}

include("unconnect.inc");
session_unregister("sHn");
session_unregister("sPtname");
session_unregister("sPtright");
?>