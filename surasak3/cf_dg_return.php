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
	font-size: 18 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 18 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

</head>
<body>
<?php


if(count($_POST["list"]) > 0){
	
	$list2 = implode("','",$_POST["list"]);
	$sql = "Update ddrugrx set drug_return = '1' where row_id in ('".$list2."') limit ".count($_POST["list"]);
	$result = Mysql_Query($sql);
	echo "<BR><BR><CENTER><B>";
	if($result){
		echo "บันทึกข้อมูล ได้รับยาคืนเรียบร้อยแล้ว";
	}else{
		echo "<FONT COLOR=\"red\">ไม่สามารถบันทึกข้อมูลได้</FONT>";
	}
	echo "</B></CENTER>";

}
?>
<SCRIPT LANGUAGE="JavaScript">

	window.onload = function(){
		opener.location.reload();
	}

</SCRIPT>
</body>
</html>





<?php include("unconnect.inc");?>