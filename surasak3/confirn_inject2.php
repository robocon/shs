<?php
session_start();
include("connect.php");

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
body,td,th {font-family:  MS Sans Serif;font-size: 14 px;}
.font_title{font-family:  MS Sans Serif;font-size: 14 px;color:#FFFFFF;font-weight: bold;}
</style>
</head>
<body>
<?php

	if(isset($_POST["hn"]) && $_POST["hn"] != ""){
		$injTxt = '';
		$list = array();
		$isOpd = $_POST['isOpd'];
		if($isOpd == "1"){

			$dep_hn = $_POST['hn'];
			$THDate = (date('Y')+543).date("-m-d");
			$Thidate = $THDate.date(" H:i:s");

			$sql = "SELECT row_id FROM `patdata` WHERE `date` LIKE '$THDate%' AND `hn` ='$dep_hn' AND `code` = 'INJ' ";
			$qPat = mysql_query($sql);
			if(mysql_num_rows($qPat) == 0){
				
				$sqlRunno = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
				$reqRunno = mysql_query($sqlRunno) or die("Query failed");
			
				for ($i = mysql_num_rows($reqRunno) - 1; $i >= 0; $i--) {
					if (!mysql_data_seek($reqRunno, $i)) {
						echo "Cannot seek to row $i\n";
						continue;
					}
			
					if(!($rowRunno = mysql_fetch_object($reqRunno)))
						continue;
				}
				
				$nRunno=$rowRunno->runno;
				$nRunno++;
				$dep_ptname = $_POST['ptname'];
				$injectno = 1;
				$sOfficer = $_SESSION['sOfficer'];
				
				$thdatehn = date('d-m-').(date('Y')+543).$dep_hn;
				$sqlOpday = "SELECT `vn`,`ptright` FROM `opday` WHERE `thdatehn` = '$thdatehn' ";
				$q = mysql_query($sqlOpday);
				if(mysql_num_rows($q)==0){
					echo "ไม่พบการออก VN ในวันนี้ กรุณาติดต่อแผนกทะเบียน";
					exit;
				}
				$opday = mysql_fetch_assoc($q);
				$dep_vn = $opday['vn'];
				$dep_ptright = $opday['ptright'];
				
				
				$qUpdateRunno ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
				$resUpdateRunno = mysql_query($qUpdateRunno) or die($qUpdateRunno.' : '.mysql_error());
					/////////////////////////////////////////////////////////////
				$sqlInsertDepart = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)
				VALUES('$nRunno','$Thidate','$dep_ptname','$dep_hn','','EMER','$injectno','(55823 ค่าฉีดยาผู้ป่วยนอก)', '".(20*$injectno)."','".(20*$injectno)."','0','','".$sOfficer."','0','$dep_vn','$dep_ptright');";
				$resDepart = mysql_query($sqlInsertDepart) or die($sqlInsertDepart.' : '.mysql_error());
				$depart_id=mysql_insert_id();
			
				$sqlInsertPatdata = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) 
				VALUES('$Thidate','$dep_hn','','$dep_ptname','$injectno','INJ','(55823 ค่าฉีดยาผู้ป่วยนอก)','$injectno','".(20*$injectno)."','".(20*$injectno)."','0','EMER','NCARE','$depart_id','$dep_ptright');";
				$resPatdata = mysql_query($sqlInsertPatdata) or die($sqlInsertPatdata.' : '.mysql_error());

				$injTxt = 'บันทึกค่าฉีดยาผู้ป่วยนอกเรียบร้อย';
			}
		}
		
		$count = count($_POST["drugcode"]);
		$j=0;
		for($i=0;$i<$count;$i++){
			
			$sql = "INSERT INTO `trauma_inject` (  `thidate` , `thidate_regis` , `hn` , `ptname` , `age` , `ptright`, `type`, `drugcode`, `tradname`, `opd`) VALUES ";
			
			$sql2 = "Select count(hn) as c_hn From `trauma_inject` where `thidate_regis` = '".$_POST["date"][$i]."' AND hn = '".$_POST["hn"]."' AND drugcode='".$_POST["drugcode"][$i]."' limit 1 ";
			list($c_hn) = Mysql_fetch_row(Mysql_Query($sql2));

			if($c_hn == 0){
				array_push($list,"('".(date("Y")+543).date("-m-d H:i:s")."', '".$_POST["date"][$i]."', '".$_POST["hn"]."', '".$_POST["ptname"]."', '".calcage($_POST["dbirth"])."', '".$_POST["ptright"]."', '".$_POST["type"][$i]."', '".$_POST["drugcode"][$i]."', '".$_POST["tradname"][$i]."', '$isOpd')");
				$j++;
			}

		}
		if($j > 0){
			$list2 = implode(", ",$list);
			$sql .= $list2;
			$result = Mysql_Query($sql);
		
			if($result){
				echo "<CENTER>ได้ทำการยืนยันการฉีดยาของ <B>HN : ".$_POST["hn"]."</B> เรียบร้อยแล้ว<BR>";
			}else{
				echo "<CENTER>ไม่สามารถบันทึกข้อมูลได้<BR>".mysql_error();
			}
				
		}else{
			echo "<CENTER>ยืนยันการฉีดยาของ <B>HN : ".$_POST["hn"]."</B> เรียบร้อยแล้ว<BR>";
		}

		if($injTxt != ''){
			echo "<p><b>$injTxt</b></p>";
		}
		
		echo "ปิดหน้านี้</CENTER><BR>";
	exit();
	}
?>
</body>
</html>