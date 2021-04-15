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
<title>ยืนยันการฉีดยา</title>
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
		
		$list = array();
		$isOpd = NULL;
		if($_SESSION['smenucode']=="ADMMAINOPD")
		{
			$isOpd = "1";  //ถ้าฉีดที่ OPD
		}

		$thdatehn = date('d-m-').(date('Y')+543).$_POST['hn'];

		$sql = "SELECT `toborow` FROM `opday` WHERE `thdatehn` = '$thdatehn' ";
		$opday_q = mysql_query($sql);
		$toborow = '';
		$status_c19 = 'N';
		$countdown_c19 = date("Y-m-d H:i:s", strtotime("+30 minutes"));

		if(mysql_num_rows($opday_q) > 0)
		{
			$opday = mysql_fetch_assoc($opday_q);
			$toborow = $opday['toborow'];
		}
		
		$count = count($_POST["drugcode"]);
		$j=0;
		for($i=0;$i<$count;$i++){
			
		$sql = "INSERT INTO `trauma_inject` (  `thidate` , `thidate_regis` , `hn` , `ptname` , `age` , `ptright`, `type`, `drugcode`, `tradname`, `opd`, `toborow`, `status_c19`, `countdown_c19`) VALUES ";
		
		$sql2 = "Select count(hn) as c_hn From `trauma_inject` where `thidate_regis` = '".$_POST["date"][$i]."' AND hn = '".$_POST["hn"]."' AND drugcode='".$_POST["drugcode"][$i]."' limit 1 ";
		list($c_hn) = Mysql_fetch_row(Mysql_Query($sql2));

		if($c_hn == 0){
			array_push($list,"('".(date("Y")+543).date("-m-d H:i:s")."', '".$_POST["date"][$i]."', '".$_POST["hn"]."', '".$_POST["ptname"]."', '".calcage($_POST["dbirth"])."', '".$_POST["ptright"]."', '".$_POST["type"][$i]."', '".$_POST["drugcode"][$i]."', '".$_POST["tradname"][$i]."', '$isOpd', '$toborow', '$status_c19', '' )");
			$j++;
		}

		}
		if($j > 0){
		$list2 = implode(", ",$list);
		$sql .= $list2;
		//print("-->$sql");
		
		echo "<pre>";
		var_dump($sql);
		echo "</pre>";

		$result = Mysql_Query($sql);
		
			if($result)
				echo "<CENTER>ได้ทำการยืนยันการฉีดยาของ <B>HN : ".$_POST["hn"]."</B> เรียบร้อยแล้ว<BR>";
			else
				echo "<CENTER>ไม่สามารถบันทึกข้อมูลได้<BR>".mysql_error();
		}else{
				echo "<CENTER>หมายเลขนี้เคยทำการบันทึกแล้ว<BR>";
		}
			echo "ปิดหน้านี้</CENTER><BR>";
		

		
		
	exit();
	}

?>
	
</body>
</html>





<?php include("unconnect.inc");?>