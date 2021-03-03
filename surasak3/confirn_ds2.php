<?php
session_start();
include("connect.inc");


function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

?>
<html>
<head>
<title>สรุป</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

</head>
<body>

<?php
	
	if(isset($_POST["hn"]) && $_POST["hn"] != ""){
		

		$sql = "Select hn, ptname, ptright, thidate From opday where thdatehn like '".(date("d-m-").(date("Y")+543)).$_POST["hn"]."'  Order by thidate DESC limit 1 ";

		$result = Mysql_Query($sql);

		if(Mysql_num_rows($result) == 0){
			echo "<CENTER><FONT COLOR=\"#FF0000\" size=\"5\">ผู้ป่วยยังไม่ได้ลงทะเบียนที่ห้องทะเบียนครับ</FONT><BR>ปิดหน้านี้</CENTER>";
			exit();

		}

		$arr = Mysql_fetch_assoc($result);
		
		$sql = "Select dbirth From opcard where hn = '".$arr["hn"]."' limit 1 ";
		$result = Mysql_Query($sql);
		list($dbirth) = Mysql_fetch_row($result);
		
		$sql = "Select size_wound, detail  From inhale_wound where hn = '".$arr["hn"]."' Order by row_id DESC limit 1 ";
		$result = Mysql_Query($sql);
		list($size_wound, $location) = Mysql_fetch_row($result);

		$age = calcage($dbirth);
		$sql = "Select count(hn) as c_hn From `trauma_ds` where hn='".$arr["hn"]."' AND thidate_regis = '".$arr["thidate"]."' limit 1";
		list($rows) = Mysql_fetch_row(Mysql_Query($sql));
		
		if($rows == 0){ 

			$isOpd = NULL;
			if($_SESSION['smenucode']=="ADMMAINOPD")
			{
				$isOpd = "'1'";
			}

		$sql = "INSERT INTO `trauma_ds` (  `thidate` , `thidate_regis` , `hn` , `ptname` , `age` , `ptright`, `type`, `size`, `location`, `opd` ) VALUES ( '".(date("Y")+543).date("-m-d H:i:s")."', '".$arr["thidate"]."', '".$arr["hn"]."', '".$arr["ptname"]."', '".$age."', '".$arr["ptright"]."', 'P', '".$size_wound."', '".$location."', $isOpd);";

		Mysql_Query($sql);

		echo "<CENTER><FONT   size=\"5\">ยืนยันการทำแผลเรียบร้อยแล้ว<BR>ปิดหน้านี้</FONT></CENTER>";
		}else{
		echo "<CENTER><FONT  COLOR=\"#FF0000\" size=\"5\">ไม่พบหมายเลข HN : ".$_POST["hn"]." มาลงทะเบียนวันนี้ครับ หรือ อาจได้ทำการยืนยันการทำแผลไปก่อนหน้านี้แล้ว</FONT><BR>ปิดหน้านี้</CENTER>";

		}

	}

?>
	

</body>
</html>





<?php include("unconnect.inc");?>