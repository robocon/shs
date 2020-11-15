<?php
  session_start();
  include("connect.inc");
$sOfficer=$_SESSION["sOfficer"];
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
  ///// wrad_log ///
  $rward = substr($Bcode,0,2);
  		if($rward=='42'){
			 $wname='หอผู้ป่วยรวม';
			 $linkward="fward.php";
		 }elseif($rward=='43'){
			 $wname='หอผู้ป่วยสูติ';
			 $linkward="gward.php";
		 }elseif($rward=='44'){
			$wname='หอผู้ป่วยICU';
			$linkward="icuward.php";
		 }elseif($rward=='45'){
			 $wname='หอผู้ป่วยพิเศษ';	
			 $linkward="vipward.php";
		 }
   $chgcode="Delete";
   
   $strsql="Select an,hn,lastcalroom  From bed Where bedcode='$Bedcode'";
   $strresult = mysql_query($strsql)or die(mysql_error());
   list($an,$hn,$lastcalroom) = mysql_fetch_row($strresult);
   
   
  $sql_ward="INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) VALUES ( '".$thidate."', '".$an."', '".$hn."', '".$wname."', '".$Bcode."','".$chgcode."', '', '', '', '".$lastcalroom."',  '".$sOfficer."')";
  $result_ward = mysql_query($sql_ward)or die(mysql_error());
  
  ///////
  
  
  

  $sql = "UPDATE bed SET ptname='',age='',idcard='',address='',muang='',ptright='',doctor='',date='',
           hn='',an='',diagnos='',price=0,paid=0,debt=0,food='',diag1='',officer='',
           chgdate=now() WHERE bedcode='$Bedcode';";
  $result = mysql_query($sql)or die("Query failed bed");
  
  $sql2 = "Select dcdate From ipcard where an = '$cAn' limit 1";
  $result2 = Mysql_Query($sql2) or die(mysql_error());
	list($dcdate) = Mysql_fetch_row($result2);
	if($dcdate !='0000-00-00 00:00:00'){
  
  $status_update="UPDATE ipcard SET status_log='จำหน่าย',`dcdate` = '$thidate' WHERE an='$cAn'";
  $result_update = mysql_query($status_update)or die("Query failed ipcard");
  
	}
  
 // echo $status_update;
  
  include("unconnect.inc");
  If (!$result){
           echo "clear bed fail";
           echo mysql_errno() . ": " . mysql_error(). "\n";
           echo "<br>";
                   }
  else {
          print " ลบผู้ป่วยออกจากเตียงเรียบร้อย: <br>";
         // print "  ปิดหน้าต่างนี้   แล้ว Refresh หน้าต่างหอผู้ป่วยเพื่อ update ข้อมูล";
		   print "กรุณารอสักครู่ .............ระบบจะปิดหน้าต่างให้อัตโนมัติ <br>";
         }
//  session_destroy();
    //ipdata.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister('cDate');
//    session_unregister('cBedcode');
    session_unregister('cBed');
    session_unregister('cPtname');
    session_unregister('cAge');
    session_unregister('cPtright');
    session_unregister('cDoctor');
    session_unregister('cHn');
    session_unregister('cAn');
    session_unregister('cDiag');
    session_unregister('cBedpri');
    session_unregister('cChgdate');
    session_unregister('cBedname');
    session_unregister('cAccno');
////
?>
  <script>
setTimeout("window.opener.location.href='<?=$linkward;?>';window.close()",5000);
//setTimeout("window.close()",1000);
</script>