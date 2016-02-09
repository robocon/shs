<?php
session_start();
$sOfficer=$_SESSION["sOfficer"];
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$cPtname="$cYot $cName $cSurname";
//$wa=substr($Bcode,0,2);
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
include("connect.inc");

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

$diag=jschars($_POST['diag']);
$diag1=jschars($_POST['diag1']);
$addfood=jschars($_POST['addfood']);
$repadmit=$_POST['rep'];
if($repadmit=="other"){
	$hospital=$_POST['hosother'];
}else{
	$hospital="";
}
if($_REQUEST['do']=='first'){

$sql = "UPDATE ipcard SET date='$cAdmitd', 
		             ptname='$cPtname',
		             age='$cAge',
		             ptright='$cPtright',
		             goup='$cGoup',
		             camp='$cCamp',	
                     bedcode='$Bcode',
		             diag='$diag',
		             doctor='$doctor',
					 repadmit='$repadmit',
					 hospital='$hospital'
             WHERE an='$cAn';";
             $result = mysql_query($sql) or die("Query failed ipcard");

$sql = "UPDATE opday SET ptright='$cPtright',
		             goup='$cGoup',
		             camp='$cCamp',	
                     diag='$diag',
		             doctor='$doctor' 
             WHERE an='$cAn';";
$result = mysql_query($sql) or die("Query failed ipcard");

//$admitD=date("Y-m-d H:i:s");
  $query ="UPDATE bed SET ptname='$cPtname',age='$cAge',idcard='$cIdcard',address='$cAddress',
                muang='$cMuang',ptright='$cPtright',doctor='$doctor',date='$cAdmitd',hn='$cHn',
                an='$cAn',diagnos='$diag',diag1='$diag1',food='$food $addfood',officer='',lastcalroom='$cAdmitd',chgdate='$cAdmitd',chgwdate='$cAdmitd',accno=1  WHERE bedcode='$Bcode' ";
  $result = mysql_query($query) or die("Query failed bed");
  
 //// ward_log  admit ครั้งแรก  //// 
  
   
   
   $chgcode="Admit/1";

 $sql_ward="INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) VALUES ( '".$thidate."', '".$cAn."', '".$cHn."', '".$wname."', '".$Bcode."','".$chgcode."', '', '".$Bcode."', '', '".$cAdmitd."',  '".$sOfficer."')";
  $result_ward = mysql_query($sql_ward)or die(mysql_error());
  
  
  
		
}elseif($_REQUEST['do']=='second'){
	
	
	
	$query ="UPDATE bed SET ptname='$cPtname',age='$cAge',idcard='$cIdcard',address='$cAddress',
                muang='$cMuang',ptright='$cPtright',doctor='$doctor',date='$cAdmitd',hn='$cHn',
                an='$cAn',diagnos='$diag',diag1='$diag1',food='$food $addfood',officer='',lastcalroom='$cAdmitd',chgdate='$cAdmitd',chgwdate='$cAdmitd',accno=1  WHERE bedcode='$Bcode' ";
   $result = mysql_query($query)or die("Query failed bed");
   
 //// ward_log  admit ครั้งแรก ////
 $chgcode="Admit/2";
 
   $sql_ward="INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) VALUES ( '".$thidate."', '".$cAn."', '".$cHn."', '".$wname."', '".$Bcode."','".$chgcode."', '', '', '', '".$cAdmitd."',  '".$sOfficer."')";
  $result_ward = mysql_query($sql_ward)or die(mysql_error()); 
  
  $sql = "UPDATE ipcard SET 
					 repadmit='$repadmit',
					 hospital='$hospital'
             WHERE an='$cAn';";
             $result = mysql_query($sql) or die("Query failed ipcard");
   
}		
	if($Bcode=="42R5") $room_name="ค่าห้องพิเศษ ($price บาท)";
	if($Bcode=="42R8") $room_name="ค่าห้องแยกโรค ($price บาท)";
	if($price!=""){
		  $query ="UPDATE bed SET bedpri='$price',bedname='$room_name'  WHERE bedcode='$Bcode' ";
		  $result = mysql_query($query)or die("Query failed bedpri");
	}
if(!$result){
echo "ipregis fail";
echo mysql_errno() . ": " . mysql_error(). "\n";
echo "<br>";
                 }
else {
print " ลงทะเบียนรับป่วยเรียบร้อย: <br>";
print "  HN:  $cHn       AN: $cAn <br> ";
print "  $cYot   $cName  $cSurname,   สิทธิการรักษา : $cPtright <br> ";
//print "  ปิดหน้าต่างนี้   แล้ว Refresh หน้าต่างหอผู้ป่วยเพื่อทำข้อมูลให้เป็นปัจจุบัน";
$rward = substr($Bcode,0,2);
			if($rward=='41'){
				echo "<a href='allward.php?code=41'>กลับหน้า ward</a>";
			}elseif($rward=='42'){
				echo "<a href='allward.php?code=42'>กลับหน้า ward</a>";
			}elseif($rward=='43'){
				echo "<a href='allward.php?code=43'>กลับหน้า ward</a>";
			}elseif($rward=='44'){
				echo "<a href='allward.php?code=44'>กลับหน้า ward</a>";
			}elseif($rward=='45'){
				echo "<a href='allward.php?code=45'>กลับหน้า ward</a>";
			}
         }
//session_destroy();
    session_unregister("cAdmitd");  
    session_unregister("cHn");  
    session_unregister("cAn");  
    session_unregister("cYot");
    session_unregister("cName");
    session_unregister("cSurname");
    session_unregister("cPtright");
    session_unregister("cIdcard");  
    session_unregister("cAge");  
    session_unregister("cAddress");
    session_unregister("cMuang");
    session_unregister("cGoup");
    session_unregister("cCamp");
?>
  <script>
setTimeout("window.opener.location.href='<?=$linkward;?>';window.close()",5000);
//setTimeout("window.close()",1000);
</script>

