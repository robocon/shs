<?php

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}
?>

<p align="center">นำเข้า Lab ตรวจสุขภาพลูกจ้าง 2561 </p>

<form name="form1" id="form1" method="post" action="employeelab61.php">
	<input name="act" type="hidden" value="add">   
	<input name="Submit" type="submit" value="กดที่นี่ เพื่อนำเข้า Lab" />
</form>

<?php 

if( $_POST["act"] == "add" ){

	include("connect.inc"); 

	$sql = "SELECT * 
	FROM `opcardchk` 
	WHERE `part` = 'ลูกจ้าง61' 
	AND `active` = 'y' 
	ORDER BY `exam_no` ASC";

	$query = mysql_query($sql) or die( mysql_error() );
	while( $rows = mysql_fetch_assoc($query) ){

		$hn = $rows['HN'];
		$dbirth = "00-00-00 00:00:00";
		$ptname = $rows["name"]." ".$rows["surname"];
		$nLab = '180422'.$rows['exam_no'];
		$Thidate2 = date("Y-m-d H:i:s");
		$patienttype = "OPD";
		$clinicalinfo = "ตรวจสุขภาพประจำปี61";


		$chkgender = substr($rows["name"],0,4);
		if($chkgender == "น.ส."){
			$gender = "F";
		}else{
			$chkgender = substr($rows["name"],0,3);
			if($chkgender == "นาง"){
				$gender = "F";
			}else{
				$gender = "M";
			}
		}

		$priority = "R";
		$cliniciancode = '';

		$sql1 = "INSERT INTO `orderhead` ( 
			`autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
			`patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
			`room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
		) VALUES ( 
			NULL, '$Thidate2', '$nLab', '$hn', '$patienttype', 
			'$ptname', '$gender', '$dbirth', '', '', 
			'','$cliniciancode', 'MD022 (ไม่ทราบแพทย์)', '$priority', '$clinicalinfo' 
		);";
		// dump("ORDERHEAD");
		// dump($sql1);
		$result1 = mysql_query($sql1) or die(" orderhead : ".mysql_error() );
		// echo "นำเข้า Order Lab เรียบร้อยแล้ว";


		// รายการตรวจตามสิทธิประกันสังคม
		$sql = "SELECT * FROM `lab_pretest` 
		WHERE `hn` = '$hn' 
		AND `part` = 'ลูกจ้าง61' LIMIT 1";
		$q = mysql_query($sql) or die( mysql_error() );
		$item = mysql_fetch_assoc($q);
		
		$sso_list = array();
		if( !empty($item['cbc']) ){
			$sso_list[] = 'cbc';
		}
		if( !empty($item['ua']) ){
			$sso_list[] = 'ua';
		}
		if( !empty($item['bs']) ){
			$sso_list[] = 'bs';
		}
		if( !empty($item['cr']) ){
			$sso_list[] = 'cr';
		}
		if( !empty($item['chol']) ){
			$sso_list[] = 'chol';
		}
		if( !empty($item['hdl']) ){
			$sso_list[] = 'hdl';
		}
		if( !empty($item['hbsag']) ){
			$sso_list[] = 'hbsag';
		}
		if( !empty($item['fobt']) ){
			$sso_list[] = 'stocb';
		}
		if( !empty($item['cxr']) ){
			// $sso_list[] = 'cxr';
		}
		sort($sso_list);


		// รายการตรวจตามสิทธิ รพ.
		$arrlab = array('cbc','ua');
		if( $rows['agey'] >= 35 ){
			$arrlab = array('cbc','ua','bs','ldl','hdl','bun','cr','sgot','sgpt','alk');
		}
		sort($arrlab);

		// ถ้ามีตัวไหนของ รพ. ไปซ้ำกับ ประกันสังคม จะเอาออก
		foreach( $arrlab AS $key => $shs_item ){
			if( in_array($shs_item, $sso_list) === true ){
				unset($arrlab[$key]);
			}
		}

		// จับเอาสองตัวมารวมกัน เป็นรายการตรวจทั้งหมด
		$all_lab_lists = array_merge_recursive($sso_list, $arrlab);
		sort($all_lab_lists);

		//
		foreach ($all_lab_lists as $value) {
			$sql_detail = "SELECT `code`,`oldcode`,`detail` 
			FROM `labcare` 
			WHERE `code` = '$value' 
			LIMIT 1 ";
			$q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
			list($code, $oldcode, $detail) = mysql_fetch_row($q);   
			
			$insert_detail = "INSERT INTO `orderdetail` ( 
				`labnumber` , `labcode`, `labcode1` , `labname` 
			) VALUES ( 
				'$nLab', '$code', '$oldcode', '$detail'
			);";
			// dump($insert_detail);
			$result2 = mysql_query($insert_detail) or die("insert orderdetail : ".mysql_error());

		}
		
		echo "นำเข้าข้อมูล HN : $hn $ptname เสร็จเรียบร้อย <br>";
		echo "รหัส Lab : $nLab<br>";
		echo "<hr>";
		
	}  // End While
}  
?>