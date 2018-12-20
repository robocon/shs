<?php 

include 'bootstrap.php';

// $Conn = mysql_connect('192.168.1.13', 'dottow', '') or die( mysql_error() );
// mysql_select_db('smdb', $Conn) or die( mysql_error() );

?>
<p align="center">นำเข้า Lab ตรวจสุขภาพสอบตำรวจ 2561
	<form name="form1" id="form1" method="post" action="policelab62.php">
		<input name="act" type="hidden" value="add">   
		<input name="Submit" type="submit" value="กดที่นี่ เพื่อนำเข้า Lab" />
	</form>
</p>
<?php
if( $_POST["act"] == "add" ){
	
	$db = Mysql::load();

	$sql = "SELECT `HN`,`yot`,`name`,`surname`,`dbirth`,`exam_no` 
	FROM `opcardchk` 
	WHERE `part` = 'สอบตำรวจ62' 
	ORDER BY `row` ASC";
	$db->select($sql);
	$items = $db->get_items();

	foreach( $items as $key => $item ){ 
		
		$dbirth = "00-00-00 00:00:00";
		$ptname = $item["yot"].' '.$item["name"].' '.$item["surname"];

		$Thidate2 = date("Y-m-d H:i:s");
		$patienttype = "OPD";

		$clinicalinfo = "CBC ,UA ,@stool ,HIV ,VDRL ,AMP ,";
		$gender = "M";
		$priority = "R";
		$cliniciancode = '';
		$labnumber = $item['exam_no'];
		$hn = $item['HN'];

		$sql1 = "INSERT INTO `orderhead` ( 
			`autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
			`patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
			`room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
		) VALUES ( 
			'', '$Thidate2', '$labnumber', '$hn', '$patienttype', 
			'$ptname', '$gender', '$dbirth', '', '', 
			'','$cliniciancode', 'MD022 (ไม่ทราบแพทย์)', '$priority', '$clinicalinfo' 
		);";
		$head_insert = $db->insert($sql1);
		dump($head_insert);

		// @stool ==> 10446, ST
		$arrlab = array('CBC','UA','HIV','VDRL','AMP','10446','ST');
		foreach ( $arrlab as $value ) {

			$sql = "SELECT `code`,`oldcode`,`detail` FROM `labcare` WHERE `code` = '$value' LIMIT 0,1 ";
			$db->select($sql);
			$lab = $db->get_item();

			$code = $lab['code'];
			$oldcode = $lab['oldcode'];
			$detail = $lab['detail'];
			
			$sql2 = "INSERT INTO `orderdetail` ( 
				`labnumber` , `labcode`, `labcode1` , `labname` 
			) VALUES ( 
				'$labnumber', '$code', '$oldcode', '$detail' 
			);";
			$detail_insert = $db->insert($sql2);
			dump($detail_insert);
			
		}

		echo "$hn : นำเข้า Order Lab เรียบร้อยแล้ว<br>";
		echo "<hr>";

	}  //close while
}  //close if act=add
?>