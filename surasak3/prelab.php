<?php
   session_start();

    $x=0;
    $aDgcode = array("รหัส");
    $aTrade  = array("รายการ");
    $aPrice  = array("ราคา ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aMoney= array("       รวมเงิน   ");
    $Netprice="";   

    $aYprice = array("ราคา ");
    $aNprice = array("ราคา ");
    $aSumYprice = array("ราคา ");
    $aSumNprice = array("ราคา ");
	$aFilmsize= array("       ขนาด   ");
	$aPriority = $_POST["priority"];
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");
	session_register("aFilmsize");
	session_register("aPriority");
	
	$appday=$_POST['appday'];
	$appmon=$_POST['appmon'];
	$appyr=$_POST['appyr'];
	session_register("appday");
	session_register("appmon");
	session_register("appyr");
	//// เปลี่ยนแปลงสิทธิ์
	$cPtright = $_POST['pt'];
	if($_POST["diag"]=='ตรวจสุขภาพ') $cPtright = $_POST['pt2'];
	//session_register("cPtright");
	///
    $cPart="";
    $cDiag=$_POST["diag"];
    $cDoctor=$doctor;
	$cstaf_massage=$_POST['staf_massage'];
	$selnid1=$_POST['selnid1'];
	$selnid2=$_POST['selnid2'];
	$selnid3=$_POST['selnid3'];
	$selnid4=$_POST['selnid4'];
	$selnid5=$_POST['selnid5'];
	$selnid6=$_POST['selnid6'];
	$selnid7=$_POST['selnid7'];
	$selnid8=$_POST['selnid8'];
	$selnid9=$_POST['selnid9'];
	$selnid10=$_POST['selnid10'];
	$selnid11=$_POST['selnid11'];
	$selnid12=$_POST['selnid12'];			
    $cAn="";
    $cAccno=0;
    $tvn="$tvn";
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");


    session_register("cPart");
    session_register("cDiag");
    session_register("cAn"); 
    session_register("cDoctor"); 
	session_register("cstaf_massage");
    session_register("cAccno"); 
	session_register("tvn"); 
	session_register("list_codeed");
	
	$_SESSION['date_start'] = $_POST['date_start'];
	$_SESSION['date_end'] = $_POST['date_end'];
	
	$_SESSION["list_codeed"] = array();
	if(!empty($_POST["xraydetail"]) && count($_POST["xraydetail"]) > 0){
		session_register("cXraydetail");
		session_register("cXraydetail1");
		$_SESSION["cXraydetail"] = "";
		$count = count($_POST["xraydetail"]);
		for($i=0;$i<$count;$i++)
		$_SESSION["cXraydetail"] .= ($i+1).".".$_POST["xraydetail"][$i]."";
	}

	//print "ผู้ป่วยนอก<br>";
	//print "HN :$cHn<br>";
	//print "VN :$tvn<br>";
	//print "$cPtname<br>";
	//print "สิทธิการรักษา :$cPtright<br>";
	//print "โรค :$cDiag<br>";
	//print "แพทย์ :$cDoctor<br>";
	
	include("connect.inc");
	
	$sql = "Select  menucode From inputm  where idname = '".$_SESSION["sIdname"]."' limit 1";
	
	list($menucode)= Mysql_fetch_row(Mysql_Query($sql));

	if($menucode == "ADMNID" || $menucode == "ADMPT"){

		if($menucode == "ADMNID"){
		
		//จัดเก็บข้อมูลในตาราง clinicnid
		$today = date("Y-m-d H:i:s");
		$submonth=substr($today,0,7);
		if(!empty($cHn)){
		$tbsql="select * from opcard where hn='$cHn'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);	
		$goup=$rows["goup"];
			$add="insert into clinicnidgroup set date_time='$today', hn='$cHn', goup='$goup'";
			$query=mysql_query($add);
		}  //close if cHn
		
		if(!empty($selnid1)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid1'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid1'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid1
		
		if(!empty($selnid2)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid2'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid2'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid2	
		
		if(!empty($selnid3)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid3'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid3'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid3	
		
		if(!empty($selnid4)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid4'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid4'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid4	
		
		if(!empty($selnid5)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid5'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid5'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid5	
		
		if(!empty($selnid6)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid6'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid6'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid6	
		
		if(!empty($selnid7)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid7'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid7'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid7	
		
		if(!empty($selnid8)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid8'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid8'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid8	
		
		if(!empty($selnid9)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid9'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid9'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid9	
		
		if(!empty($selnid10)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid10'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid10'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid10	
		
		if(!empty($selnid11)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid11'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid11'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid11	
		
		if(!empty($selnid12)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid12'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid12'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid12																											
		
		if(!empty($selnid13)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid13'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid13'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid13		
		
		if(!empty($selnid14)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid14'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid14'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid14		
		
		if(!empty($selnid15)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid15'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid15'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid15		
		
		if(!empty($selnid16)){
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='$selnid16'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){
			$add="insert into clinicnid set date_time='$today', hn='$cHn', vn='$tvn', groupnid='$selnid16'";
			$query=mysql_query($add);
			}	
		}  //close if $selnid16		
													
			$sql = "Select diag, left(toborow,5) as toborow5  From opday2 where thdatehn = '".(date("d-m-")).(date("Y")+543).($cHn)."' AND (left(toborow,4) = 'EX92' OR left(toborow,5) = 'EX 92' ) limit 1 ";
			list($diag_old, $toborow5)= Mysql_fetch_row(Mysql_Query($sql));

			$sql = "Update opday2 set diag = '".$diag_old.", ".$cDiag."' where thdatehn = '".(date("d-m-")).(date("Y")+543).($cHn)."' AND left(toborow,5) = '".$toborow5."' ";
			Mysql_Query($sql);		

		}else if($menucode == "ADMPT"){
			$sql = "Select diag, left(toborow,5) as toborow5 From opday2 where thdatehn = '".(date("d-m-")).(date("Y")+543).($cHn)."' AND (left(toborow,4) = 'EX91' OR left(toborow,4) = 'EX17' OR left(toborow,5) = 'EX 91') limit 1 ";
			list($diag_old, $toborow5)= Mysql_fetch_row(Mysql_Query($sql));

			$sql = "Update opday2 set diag = '".$diag_old.", ".$cDiag."' where thdatehn = '".(date("d-m-")).(date("Y")+543).($cHn)."' AND left(toborow,5) = '".$toborow5."' ";
			Mysql_Query($sql);
		}
	}
	
	$Thidate = (date("Y")+543).date("-m-d"); 

	$sql = "Select code, sum(amount) From patdata where date like '".$Thidate."%' AND hn='".$cHn."' group by code having sum( amount ) > 0";

	$result = Mysql_Query($sql);
	while(list($code, $sum) = Mysql_fetch_row($result)){
		$_SESSION["list_codeed"][$code] = $sum;
	}
	
	$_SESSION["nPrintXray"] = "";

	if($_SESSION["until_login"] == "xray" && (!empty($_POST["xraydetail"]) && count($_POST["xraydetail"]) > 0)){
		
		if(substr($_SESSION["cXraydetail"],0,17)=="1. CHEST CHECK UP"){
			$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
			$result = mysql_query($query) or die("Query failed");
			
			for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
					if(!($row = mysql_fetch_object($result)))
					continue;
			}
			$nPrefix=$row->prefix;	
				
			$query9 ="UPDATE chkup_solider SET xray = '".(date("Y")+543).date("-m-d H:i:s")."' WHERE hn='".$cHn."' and yearchkup='$nPrefix' ";
			$result9 = mysql_query($query9) or die("Query failed");
		}
		 
		
		
		$sql = "Select yot,name, surname, dbirth From opcard where hn ='".$cHn."' limit 0,1";
		list($yot, $name, $surname, $dbirth) = Mysql_fetch_row(Mysql_Query($sql));


		$query = "SELECT runno FROM runno WHERE title = 'xrayno' limit 0,1";
		$result = mysql_query($query) or die("Query failed");
		list($xray_no) = mysql_fetch_row($result);
		$xray_no++;
		 $query ="UPDATE runno SET runno = $xray_no WHERE title='xrayno' limit 1 ";
		$result = mysql_query($query) or die("Query failed");
		
		$sql = "INSERT INTO `xray_doctor` (`date` ,`hn` ,`vn` ,`yot` ,`name` ,`sname` ,`detail` ,`doctor` ,`status` ,`xrayno` ,`film` ,`type_diag`,`detail_all`,`dbirth`,`orderby`)VALUES ('".(date("Y")+543).date("-m-d H:i:s")."', '".$cHn."', '".$tvn."', '".$yot."', '".$name."', '".$surname."', '".$_SESSION["cXraydetail"]."', '".$_POST["doctor"]."', 'N', '".$xray_no."', 'digital', '".$_POST["diag"]."', '".$_SESSION["cXraydetail"]."', '".$dbirth."', 'XRAY');";
		
		mysql_query($sql);
		
		
for($i=0;$i<$count;$i++){
		$_SESSION["cXraydetail1"]=$_POST["xraydetail"][$i];
		
		$sql1 = "INSERT INTO `xray_doctor_detail` (`date` ,`hn` ,`xrayno` ,`doctor_detail`,`detail_all`)VALUES ('".(date("Y")+543).date("-m-d H:i:s")."','".$cHn."','".$xray_no."','".$_SESSION["cXraydetail1"]."','".$_SESSION["cXraydetail"]."');";
		$q=mysql_query($sql1);
		
		//echo $sql1;
		}

		$_SESSION["nPrintXray"] = "<A HREF=\"xraydoctor_print.php?vn=".urlencode($tvn)."&hn=".urlencode($cHn)."&name=".urlencode($yot." ".$name." ".$surname)."&detail_all=".urlencode($_SESSION["cXraydetail"])."&doctor=".urlencode($_POST["doctor"])."&xrayno=".urlencode($xray_no)."\" target=\"_blank\">พิมพ์ หมายเลข X-Ray</A>";
	}

	$sql = "update opday set doctor = '$cDoctor' where  thdatehn = '".(date("d-m-")).(date("Y")+543).($cHn)."' ";
	$result = @mysql_query($sql);

	include("unconnect.inc");

?>
<!-- <a href="labseek.php" id="aLink">ทำรายการต่อไป</a> -->
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=labseek.php">


<script type="text/javascript">
document.getElementById('aLink').focus();
</script>