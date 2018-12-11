<?php 

include 'bootstrap.php';

?>
<p align="center">นำเข้า Lab ตรวจสุขภาพสอบตำรวจ 2562
<form name="form1" id="form1" method="post" action="policelab62.php">
	<input name="act" type="hidden" value="add">   
	<input name="Submit" type="submit" value="กดที่นี่ เพื่อนำเข้า Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
	// include("connect.inc"); 
	$sql = "SELECT `HN`,`yot`,`name`,`surname`,`dbirth`,`exam_no` 
	FROM `opcardchk` 
	WHERE `part` = 'สอบตำรวจ62' 
	ORDER BY `row` ASC";
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
	
	while($rows = mysql_fetch_array($query)){
		//list($d,$m,$y)=explode("/",$rows["dbirth"]);
		//$y=$y-543;
		//$dbirth="$y-$m-$d 00:00:00";
		$dbirth = "00-00-00 00:00:00";
		$ptname = $rows["yot"].' '.$rows["name"].' '.$rows["surname"];

		// $query1 = "SELECT runno, startday FROM runno WHERE title = 'lab'";
		// $result = mysql_query($query1) or die("Query failed");

		// for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		// 	if (!mysql_data_seek($result, $i)) {
		// 		echo "Cannot seek to row $i\n";
		// 		continue;
		// 	}
		// 		if(!($row = mysql_fetch_object($result)))
		// 		continue;
		// }

		// $nLab=$row->runno;
		// $dLabdate=$row->startday;
		// $dLabdate=substr($dLabdate,0,10);

		$Thidate2 = date("Y-m-d H:i:s");
		$patienttype = "OPD";

		$clinicalinfo = "CBC ,UA ,@stool ,HIV ,VDRL ,AMP ,";
		$gender = "M";
		$priority = "R";
		$cliniciancode = '';
		$labnumber = $rows['exam_no'];
		$hn = $rows['HN'];

		$sql1 = "INSERT INTO `orderhead` ( 
			`autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
			`patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
			`room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
		) VALUES ( 
			'', '$Thidate2', '$labnumber', '$hn', '$patienttype', 
			'$ptname', '$gender', '$dbirth', '', '', 
			'','$cliniciancode', 'MD022 (ไม่ทราบแพทย์)', '$priority', '$clinicalinfo' 
		);";

		dump($sql1);
		// $result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead ");

		// @stool ==> 10446, ST
		$arrlab=array('CBC','UA','HIV','VDRL','AMP','10446','ST');
		foreach ($arrlab as $value) {
			list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
			
			$sql2 = "INSERT INTO `orderdetail` ( 
				`labnumber` , `labcode`, `labcode1` , `labname` 
			) VALUES ( 
				'$labnumber', '".$code."', '".$oldcode."', '".$detail."' 
			);";
			dump($sql2);
			// $result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
			
		}



		echo "$hn : นำเข้า Order Lab เรียบร้อยแล้ว<br>";

		echo "<hr>";

		// $nLab++;
		// $query3 ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
		// $result3 = mysql_query($query3) or die("Query failed runno");

	}  //close while
}  //close if act=add
?>