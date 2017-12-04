<?php
session_start();
 session_unregister("x");
    session_unregister("aDate");
    session_unregister("chkdate");
    session_unregister("repdate");
	 session_unregister("doctor");
    session_unregister("aHn");
    session_unregister("aAn");
    session_unregister("aIdname");
    session_unregister("aDepart");
    session_unregister("aDetail");
    session_unregister("aPrice");
    session_unregister("aPaid");
    session_unregister("aPhar");  
    session_unregister("aPharpaid");    
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aLabo");
    session_unregister("aLabopaid");
    session_unregister("aXray");
    session_unregister("aXraypaid");  
    session_unregister("aSurg");    
    session_unregister("aSurgpaid");
    session_unregister("aEmer");
    session_unregister("aEmerpaid");
    session_unregister("aDent");
    session_unregister("aDentpaid");
    session_unregister("aPhysi");
    session_unregister("aPhysipd");
    session_unregister("aHemo");
    session_unregister("aHemopd");
    session_unregister("aOther");
    session_unregister("aOtherpd");
    session_unregister("aWard");
    session_unregister("aWardpd");
	 session_unregister("aNid");
    session_unregister("aNidpd");
 session_unregister("aEye");
    session_unregister("aEyepd");
session_unregister("aCredit_d");
	session_unregister("aCredit");
	session_unregister("aCredit_1");
	session_unregister("aCredit_2");
	session_unregister("aCredit_3");
	session_unregister("aCredit_4");
	session_unregister("aCredit_5");
	session_unregister("aCredit_6");
	session_unregister("aCredit_7");
	session_unregister("aCredit_8");
	session_unregister("aCredit_1pd");
	session_unregister("aCredit_2pd");
	session_unregister("aCredit_3pd");
	session_unregister("aCredit_4pd");
	session_unregister("aCredit_5pd");
	session_unregister("aCredit_6pd");
	session_unregister("aCredit_7pd");
	session_unregister("aCredit_8pd");
session_unregister("aBillno");
session_unregister("aPaidcscd");
session_unregister("aVn");
session_unregister("ptname");

	

    $x            =0;
    $aDate     =array("time");
    $chkdate="";   
    $repdate="";
	   $doctor="";
    $aHn        =array("hn");
    $aAn         =array("an");  
    $aIdname  =array("idname");
    $Netprice  ="";   
    $Netpaid   ="";
    $aDepart   =array("depart");
    $aDetail    = array("detail");
    $aPrice   =array("price");
    $aPaid    = array("paid");
    $aPhar      =array("phar");
    $aPharpaid=array("pharpaid"); 
    $aEssd     =array("DDL");
    $aNessdy =array("DDY");
    $aNessdn =array("DDN");
    $aDPY      =array("DPY");
    $aDPN      =array("DPN");   
    $aDSY      =array("DSY");
    $aDSN      =array("DSN");   
    $aLabo        =array("labo");
    $aLabopaid  =array("labopaid");
    $aXray         =array("xray");
    $aXraypaid =array("xraypaid");
    $aSurg        =array("surg");
    $aSurgpaid =array("surgpaid");
    $aEmer        =array("emer");
    $aEmerpaid  =array("emerpaid");
    $aDent          =array("dent");
    $aDentpaid  =array("dentpaid");
    $aPhysi       =array("physi");
    $aPhysipd  =array("physipd");
    $aHemo       =array("hemo");
    $aHemopd  =array("hemopd");
    $aOther      =array("other");
    $aOtherpd  =array("otherpd");
    $aWard      =array("Ward");
    $aWardpd  =array("Wardpd");
	 $aNid      =array("Nid");
    $aNidpd  =array("Nidpd");
	 $aEye      =array("Eye");
    $aEyepd  =array("Eyepd");
	   $aCredit_d =array("credit_detail");
    $aCredit =array("credit");
	 $aCredit_1 =array("credit_1");
	 $aCredit_1pd =array("credit_1pd");
	 $aCredit_2 =array("credit_2");
	 $aCredit_2pd =array("credit_2pd");
	 $aCredit_3 =array("credit_3");
	 $aCredit_3pd =array("credit_3pd");
	 $aCredit_4 =array("credit_4");
	 $aCredit_4pd =array("credit_4pd");
	 $aCredit_5 =array("credit_5");
	 $aCredit_5pd =array("credit_5pd");
	 $aCredit_6 =array("credit_6");
	 $aCredit_6pd =array("credit_6pd");
	 $aCredit_7 =array("credit_7");
	 $aCredit_7pd =array("credit_7pd");
	 $aCredit_8 =array("credit_8");
	 $aCredit_8pd =array("credit_8pd");
	  $aBillno   =array("billno");
		  $aPaidcscd   =array("paidcscd");
		    $aVn   =array("vn");
			$ptname = array("ptname");


    session_register("x");
    session_register("aDate");
    session_register("chkdate");
    session_register("repdate");
	  session_register("doctor");
    session_register("aHn");
    session_register("aAn");
    session_register("aIdname");
    session_register("aDepart");
    session_register("aDetail");
    session_register("aPrice");
    session_register("aPaid");
    session_register("aPhar");  
    session_register("aPharpaid");    
    session_register("aEssd");
    session_register("aNessdy");
    session_register("aNessdn");
    session_register("aDDL");
    session_register("aDDY");
    session_register("aDDN");
    session_register("aDPY");
    session_register("aDPN");
    session_register("aDSY");
    session_register("aDSN");
    session_register("aLabo");
    session_register("aLabopaid");
    session_register("aXray");
    session_register("aXraypaid");  
    session_register("aSurg");    
    session_register("aSurgpaid");
    session_register("aEmer");
    session_register("aEmerpaid");
    session_register("aDent");
    session_register("aDentpaid");
    session_register("aPhysi");
    session_register("aPhysipd");
    session_register("aHemo");
    session_register("aHemopd");
    session_register("aOther");
    session_register("aOtherpd");
    session_register("aWard");
    session_register("aWardpd");
	  session_register("aNid");
    session_register("aEyepd");
  session_register("aEye");
    session_register("aNidpd");
session_register("aCredit_d");
session_register("aCredit");
session_register("aCredit_1");
session_register("aCredit_1pd");
session_register("aCredit_2");
session_register("aCredit_2pd");
session_register("aCredit_3");
session_register("aCredit_3pd");
session_register("aCredit_4");
session_register("aCredit_4pd");
session_register("aCredit_5");
session_register("aCredit_5pd");
session_register("aCredit_6");
session_register("aCredit_6pd");
session_register("aCredit_7");
session_register("aCredit_7pd");
session_register("aCredit_8");
session_register("aCredit_8pd");
session_register("aBillno");
session_register("aPaidcscd");
session_register("aVn");
session_register("ptname");

    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   
	 
    include("connect.inc");	 
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
		$chkup="CHKUP$nPrefix";
  
	 print "บัญชีรายรับผู้ป่วยนอก ของวันที่ $repdate ";
    print "<b>รับชำระโดย$doctor</b> ";
  
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
?>
<table>
 <tr>
   <th bgcolor=6495ED><font size='2'>#</th>
  <th bgcolor=6495ED><font size='2'>เวลา</th>
  <th bgcolor=6495ED><font size='2'>HN</th>
  <?
  if($doctor1=="ตรวจสุขภาพ" || $doctor1==$chkup){
	?>
	<th bgcolor=6495ED><font size='2'>ชื่อ-สกุล</th>
	<? 
	}
  ?>
  <th bgcolor=6495ED><font size='2'>AN</th>
  <th bgcolor=6495ED><font size='2'>VN</th>
  <th bgcolor=6495ED><font size='2'>รายการ</th>
  <th bgcolor=6495ED><font size='2'>จ่ายเงิน</th>
   <th bgcolor=6495ED><font size='2'>ชำระ</th>
 
 
   <th bgcolor=6495ED><font size='2'>เลขที่</th>
  <th bgcolor=6495ED><font size='2'>detail</th>
  <th bgcolor=6495ED><font size='2'>จนท.</th>
  <th bgcolor=6495ED><font size='2'>เบิกได้</th>

  <th bgcolor=6495ED><font size='2'>ประเภท</th>
  </tr>

<?php
//$doctor=trim($doctor);


$doctor='chkup58';

$prow_id     =array("prow_id");
 $query = "SELECT * FROM opacc WHERE credit = '$doctor'  ORDER  BY hn  ";
    $result = mysql_query($query)or die("Query failed");
	
	//echo  $query;

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;   

	array_push($prow_id,$row->row_id);
    array_push($aDate,$row->date);
    array_push($aHn,$row->hn);
    array_push($aAn,$row->an);        
    array_push($aDepart,$row->depart);
    array_push($aDetail,$row->detail);
    array_push($aPrice,$row->price);
    array_push($aPaid,$row->paid);
	array_push($aCredit,$row->credit);
	array_push($aCredit_d,$row->credit_detail);
    array_push($aIdname,$row->idname);

 array_push($aBillno,$row->billno);
 array_push($aPaidcscd,$row->paidcscd);
  array_push($aVn,$row->vn);
  
  
 
	
if ($row->depart=="PHAR"){
	        array_push($aPhar,$row->price);  
            array_push($aPharpaid,$row->paid);
            array_push($aEssd,$row->essd);
            array_push($aNessdy,$row->nessdy);
            array_push($aNessdn,$row->nessdn);
            array_push($aDPY,$row->dpy);
            array_push($aDPN,$row->dpn); 
            array_push($aDSY,$row->dsy);  
            array_push($aDSN,$row->dsn);
}else if ($row->depart=="PATHO"){
            array_push($aLabo,$row->price);  
            array_push($aLabopaid,$row->paid);
}else if($row->depart=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aXraypaid,$row->paid);
}else if ($row->depart=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aSurgpaid,$row->paid);
}else if($row->depart=="EMER"){
            array_push($aEmer,$row->price);  
            array_push($aEmerpaid,$row->paid);
}else if ($row->depart=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aDentpaid,$row->paid);
}else if ($row->depart=="PHYSI"){
            array_push($aPhysi,$row->price);  
            array_push($aPhysipd,$row->paid);
}else if ($row->depart=="HEMO"){
            array_push($aHemo,$row->price);  
            array_push($aHemopd,$row->paid);
}else if ($row->depart=="OTHER"){
            array_push($aOther,$row->price);  
            array_push($aOtherpd,$row->paid);
}else if($row->depart=="NID"){
            array_push($aNid,$row->price);  
            array_push($aNidpd,$row->paid);
}else if($row->depart=="EYE"){
            array_push($aEye,$row->price);  
            array_push($aEyepd,$row->paid);
}else if($row->depart=="WARD"){
            array_push($aWard,$row->price);  
            array_push($aWardpd,$row->paid);
}else if($row->credit=="เงินสด"){
            array_push($aCredit_1,$row->price);  
            array_push($aCredit_1pd,$row->paid);
}else if($row->credit=="กรุงเทพ"){
            array_push($aCredit_2,$row->price);  
            array_push($aCredit_2pd,$row->paid);
}else if($row->credit=="ทหารไทย"){
            array_push($aCredit_3,$row->price);  
            array_push($aCredit_3pd,$row->paid);
}else if($row->credit=="จ่ายตรง"){
            array_push($aCredit_4,$row->price);  
            array_push($aCredit_4pd,$row->paid);
}else if($row->credit=="ประกันสังคม"){
            array_push($aCredit_5,$row->price);  
            array_push($aCredit_5pd,$row->paid);
}else if($row->credit=="30บาท"){
            array_push($aCredit_6,$row->price);  
            array_push($aCredit_6pd,$row->paid);
}else if($row->credit=="เงินเชื่อ"){
            array_push($aCredit_7,$row->price);  
            array_push($aCredit_7pd,$row->paid);
}else if($row->credit=="อื่นๆ"){
            array_push($aCredit_8,$row->price);  
            array_push($aCredit_8pd,$row->paid);
} 
$x++;

	   }


print "<font face='Angsana New'><br>จำนวนทั้งสิ้น $x รายการ ดังนี้<br>";
//   $x++;
$num=1;
for ($n=$x; $n>=1; $n--){
	$time=substr($aDate[$n],11,5);
	$aIdname[$n]=substr($aIdname[$n],0,9);
	$aDetail[$n]=substr($aDetail[$n],0,20);
	$aPaidcscd[$n]=number_format( $aPaidcscd[$n], 2, '.', '');
	
	
	$sql = "select ptname,yot,age,chunyot,camp from chkup_solider  where hn='$aHn[$n]' and yearchkup = '58' ";

  $result = Mysql_Query($sql);
  
  list($ptname,$yot,$age,$chunyot,$camp) = Mysql_fetch_row($result);
// echo $ptname;
  

	print("<tr>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$time</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$aHn[$n]</td>\n".
	"<td bgcolor=F5DEB3 ><font face='Angsana New'>$aDetail[$n]</td>\n".  
	"<td bgcolor=F5DEB3 align='right' ><font face='Angsana New'>$aPaid[$n]</td>\n".  
	"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$aIdname[$n]</td>\n". 
	"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$aDepart[$n]</td>\n". 
		"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$ptname</td>\n". 
			"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$camp</td>\n". 
				"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$age</td>\n". 
	" </tr>\n");


	$num++;
}       
//แสดงรายการคืนเงิน

print "</table>
</FORM>";
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'><br>แสดงรายการคืนเงิน<br></th>";
    print "</table>";

   print "<table>";
   print "<tr>";
  print "<th bgcolor=9999CC>#</th>";
  print "<th bgcolor=9999C>เวลา</th>";
  print "<th bgcolor=9999C>HN</th>";
 print " <th bgcolor=9999C>AN</th>";
  print "<th bgcolor=9999C>แผนก</th>";
 print " <th bgcolor=9999C>รายการ</th>";
  print "<th bgcolor=9999C>ราคา</th>";
 print " <th bgcolor=9999C>จ่ายเงิน</th>";
 print " <th bgcolor=9999C>บัตรเครดิต</th>";
  print "<th bgcolor=9999C>จนท.เก็บเงิน</th>";
  print "</tr>";

   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
        if ($aPaid[$n]<0){
           print("<tr>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$num</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$time</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aHn[$n]</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aAn[$n]</td>\n". 
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aDepart[$n]</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aDetail[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPrice[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPaid[$n]</td>\n".  
                 "<td bgcolor=99CCCC><font face='Angsana New'>$aCredit[$n]</td>\n".  
               //  "<td bgcolor=99CCCC><font face='Angsana New'>$aPtright[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aIdname[$n]</td>\n".  
                   " </tr>\n");
          $num++;
		     }       
		        }
				
				 include("unconnect.inc");
?>

</table>
      <br><a href="opmchkuser.php" >ตรวจสอบเงินรายรับ</a>
    

