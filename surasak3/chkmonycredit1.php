<style type="text/css">
.txt {	font-family: TH SarabunPSK;
	font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
 
table, td, th {
                border: 0px solid black;
            }
            #separateTable {
                border-collapse: separate;
            }
            #collapseTable {
                border-collapse: collapse;
            }
</style>
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
    $medical_service  =array("medical_service");
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
if(isset($_POST["doctor1"])){
	$doctor1=$_POST["doctor1"];
}	
if(isset($_GET["doctor1"])){
	$doctor1 = $_GET["doctor1"];
	//$doctor1=$doctor1;
}	

    $today="$d-$m-$yr";
    $repdate=$today;   
	$doctor="$doctor1";
	//echo "==>".$doctor;
	
	 
    include("connect.inc");	 
	mysql_query("SET CHARACTER SET utf8 ");
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
  
	 print "<strong style='margin-left:10px;'>บัญชีรายรับผู้ป่วยนอก ของวันที่ $repdate</strong>";
    print "<strong style='margin-left:10px;'>รับชำระโดย$doctor</strong>";
  
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
?>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" id="collapseTable">
 <tr>
   <th bgcolor=6495ED><font size='4'>#</th>
  <th bgcolor=6495ED><font size='4'>เวลา</th>
  <th bgcolor=6495ED><font size='4'>HN</th>
  <?php
  if($doctor1=="ตรวจสุขภาพ" || $doctor1==$chkup || $doctor1=="ตรวจสุขภาพตำรวจ"){
	?>
	<th bgcolor=6495ED><font size='4'>ชื่อ-สกุล</th>
	<?php
	}
  ?>
  
  <th bgcolor=6495ED><font size='4'>VN</th>
  <th bgcolor=6495ED><font size='4'>รายการ</th>
  <th bgcolor=6495ED><font size='4'>จ่ายเงิน</th>
   <th bgcolor=6495ED><font size='4'>ชำระ</th>
 
 
   <th bgcolor=6495ED><font size='4'>เลขที่</th>
  
  <th bgcolor=6495ED><font size='4'>จนท.</th>
  <th bgcolor=6495ED><font size='4'>เบิกได้</th>

  <th bgcolor=6495ED><font size='4'>ประเภท</th>
  </tr>

<?php
//$doctor=trim($doctor);




$prow_id     =array("prow_id");
 $query = "SELECT * FROM opacc WHERE date LIKE '$today%' and credit = '$doctor'  ORDER  BY date  ";
 
    //echo $query;
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
	if($row->credit=="จ่ายตรง" || $row->credit=="จ่ายตรง อปท." || $row->credit=="จ่ายตรง อปท. (HD)" || $row->credit=="กทม" || $row->credit=="กสทช" || $row->credit=="ททท" || $row->credit=="กฟผ"){
		array_push($aPaid,$row->paidcscd);
	}else{
		array_push($aPaid,$row->paid);
	}
	array_push($aCredit,$row->credit);
	array_push($aCredit_d,$row->credit_detail);
    array_push($aIdname,$row->idname);

 array_push($aBillno,$row->billno);
 array_push($aPaidcscd,$row->paidcscd);
  array_push($aVn,$row->vn);
  
    if( $doctor != "ตรวจสุขภาพตำรวจ" )
    {
        $qquery = "select concat(yot,' ',name,' ',surname) as ptname from opcard where hn='".$row->hn."' ";
        $abrow = mysql_query($qquery);
        list($aaptname) = mysql_fetch_array($abrow);
        array_push($ptname,$aaptname);
    }
    else
    {
        $policeSql = mysql_query("SELECT `log_ptname` FROM `log_opcardchk` WHERE `log_hn` = '{$row->hn}' ");
        $police = mysql_fetch_assoc($policeSql);
        array_push($ptname,$police['log_ptname']);
    }

if ($row->depart=="PHAR"){
	        array_push($aPhar,$row->price);  
			if($row->credit=="จ่ายตรง"){
				array_push($aPharpaid,$row->paidcscd);
				//echo $aPharpaid;
			}else{
				array_push($aPharpaid,$row->paid);
			}
            array_push($aEssd,$row->essd);
            array_push($aNessdy,$row->nessdy);
            array_push($aNessdn,$row->nessdn);
            array_push($aDPY,$row->dpy);
            array_push($aDPN,$row->dpn); 
            array_push($aDSY,$row->dsy);  
            array_push($aDSN,$row->dsn);
}else if ($row->depart=="PATHO"){
            array_push($aLabo,$row->price); 
			if($row->credit=="จ่ายตรง"){
				array_push($aLabopaid,$row->paidcscd);
			}else{
				array_push($aLabopaid,$row->paid);
			}
}else if($row->depart=="XRAY"){
            array_push($aXray,$row->price); 
			if($row->credit=="จ่ายตรง"){
				array_push($aXraypaid,$row->paidcscd);
			}else{
				array_push($aXraypaid,$row->paid);
			}
}else if ($row->depart=="SURG"){
            array_push($aSurg,$row->price);
			if($row->credit=="จ่ายตรง"){
				array_push($aSurgpaid,$row->paidcscd);
			}else{
				array_push($aSurgpaid,$row->paid);
			}
}else if($row->depart=="EMER"){
            array_push($aEmer,$row->price);
			if($row->credit=="จ่ายตรง"){
				array_push($aEmerpaid,$row->paidcscd);
			}else{
				array_push($aEmerpaid,$row->paid);
			}
}else if ($row->depart=="DENTA"){
            array_push($aDent,$row->price); 
			if($row->credit=="จ่ายตรง"){			
				array_push($aDentpaid,$row->paidcscd);
			}else{
				array_push($aDentpaid,$row->paid);
			}
}else if ($row->depart=="PHYSI"){
            array_push($aPhysi,$row->price); 
			if($row->credit=="จ่ายตรง"){
				array_push($aPhysipd,$row->paidcscd);
			}else{
				array_push($aPhysipd,$row->paid);
			}
}else if ($row->depart=="HEMO"){
            array_push($aHemo,$row->price); 
			if($row->credit=="จ่ายตรง"){
				array_push($aHemopd,$row->paidcscd);
			}else{
				array_push($aHemopd,$row->paid);
			}
}else if ($row->depart=="OTHER" || $row->depart=="NCARE"){
    $paid = (int)$row->paid;
    if( strpos($row->ptright, 'R03') !== false && $paid == 30 ){
        
        array_push($aOther,$row->price); 
		if($row->credit=="จ่ายตรง"){
			array_push($aOtherpd,$row->paidcscd);
		}else{
			array_push($aOtherpd,$row->paid);
		}
    }else{
        if($row->credit=="จ่ายตรง"){
			array_push($medical_service, $row->paidcscd);
		}else{
			array_push($medical_service, $row->paid);
		}
    }
    
}else if($row->depart=="NID"){
            array_push($aNid,$row->price);  
			if($row->credit=="จ่ายตรง"){
				array_push($aNidpd,$row->paidcscd);
			}else{
				array_push($aNidpd,$row->paid);
			}
}else if($row->depart=="EYE"){
            array_push($aEye,$row->price);
			if($row->credit=="จ่ายตรง"){
				array_push($aEyepd,$row->paidcscd);
			}else{
				array_push($aEyepd,$row->paid);
			}
}else if($row->depart=="WARD"){
            array_push($aWard,$row->price);  
			if($row->credit=="จ่ายตรง"){
				array_push($aWardpd,$row->paidcscd);
			}else{
				array_push($aWardpd,$row->paid);
			}
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
            array_push($aCredit_4pd,$row->paidcscd);
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
 include("unconnect.inc");

print "<br><strong style='margin-left:10px;'>จำนวนทั้งสิ้น $x รายการ ดังนี้</strong><br>";
print "<FORM METHOD=POST ACTION=\"chkmonycredit1_edit.php?action=muti\" target=\"_blank\">";

//   $x++;
$num=1;
for ($n=$x; $n>=1; $n--){
	$time=substr($aDate[$n],11,5);
	//$aIdname[$n]=substr($aIdname[$n],0,100);
	$aIdname[$n]=iconv_substr($aIdname[$n],0,100,'UTF-8');
	$aIdname[$n] = str_replace("นางสาว ","", $aIdname[$n]);
	$aIdname[$n] = str_replace("นาย","", $aIdname[$n]);
	$aIdname[$n] = str_replace("น.ส. ","", $aIdname[$n]);
	$aIdname[$n] = str_replace("นาง ","", $aIdname[$n]);
	
	list($officer_name[$n],$officer_surname[$n])=explode(" ",$aIdname[$n]);
	//print_r($num.$officer_name[$n])."<br>";
	//print_r (explode(" ",$aIdname[$n]))."<br>";
	

	
	//$aDetail[$n]=substr($aDetail[$n],0,100);
	//$aDetail[$n]=iconv_substr($aDetail[$n],0,100,'UTF-8');
	//echo "==>".$aDetail[$n]."<br>";
	if($aDetail[$n]=="ค่าบริการทางการแพทย์ นอกเวลาราชการ (เบิกไม่ได้)"){
		$aDetail[$n]="ค่าบริการทางการแพทย์ นอกเวลาราชการ";
		//echo "==>".$aDetail[$n]."<br>";
	}
	$aPaidcscd[$n]=number_format( $aPaidcscd[$n], 2, '.', '');

	//$aDetail[$n]=iconv('UTF-8','TIS620',$aDetail[$n]);
	print("<tr>\n".
	"<td bgcolor=F5DEB3 align='center'><font face='Angsana New'>$num</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$time</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$aHn[$n]</td>\n");
  if($doctor1=="ตรวจสุขภาพ"  || $doctor1==$chkup || $doctor1=="ตรวจสุขภาพตำรวจ"){
	?>
	<td bgcolor=F5DEB3><font face='Angsana New'><?=$ptname[$n]?></td>
	<?php 
	}
	print("<td bgcolor=F5DEB3><font face='Angsana New'>$aVn[$n]</td>\n".    
	//"<td bgcolor=F5DEB3><font face='Angsana New'>$aDepart[$n]</td>\n".
	"<td bgcolor=F5DEB3 ><font face='Angsana New'>$aDetail[$n]</td>\n".  
	//"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$aPrice[$n]</td>\n".  
	"<td bgcolor=F5DEB3 align='right' ><font face='Angsana New'>$aPaid[$n]</td>\n".  
	"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$aCredit[$n]</td>\n".  
	//"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'><A HREF=\"chkmonycredit1_edit.php?fn=billno&row_id=".$prow_id[$n]."&title_name=".urlencode("หมายเลขบิล")."&\" target=\"_blank\">$aBillno[$n]</A></td>\n". 
	"<td bgcolor=F5DEB3 align='center'><INPUT TYPE=\"text\" NAME=\"billno[]\" value=\"".$aBillno[$n]."\" size=\"5\"><INPUT TYPE=\"hidden\" name=\"row_id[]\" value=\"".$prow_id[$n]."\"><INPUT TYPE=\"hidden\" name=\"billno2[]\" value=\"".$aBillno[$n]."\"></td>\n". 
	//"<td bgcolor=F5DEB3><font face='Angsana New'>$aPtright[$n]</td>\n".  
	"<td bgcolor=F5DEB3 align='left'><font face='Angsana New'>$officer_name[$n]</td>\n". 
	"<td bgcolor=F5DEB3 align='right'><font face='Angsana New'>$aPaidcscd[$n]</td>\n". 
	"<td bgcolor=F5DEB3 align='center'><font face='Angsana New'>$aDepart[$n]</td>\n". 
	" </tr>\n");


	$num++;
}       
//แสดงรายการคืนเงิน
$_SESSION['medical_service'] = $medical_service;

print "</table><br>
<div style='margin-left:10px;'>
<INPUT TYPE=\"submit\" value=\"แก้ไขข้อมูลเลขที่ใบเสร็จทั้งหมด\"></div>
</FORM>";

    print "<div style='margin-left:10px;'><table>";
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
                   "<td bgcolor=99CCCC align='center'><font face='Angsana New'>$num</td>\n".
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
print "</div>";				
?>

</table>
      <br><a href="opmchkuser.php" >ตรวจสอบเงินรายรับ</a><br>
	  <!--<br><a href="opmchkuser_new.php" >ตรวจสอบเงินรายรับที่ขอเบิกกับกองทุน</a>	-->  
    

