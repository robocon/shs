<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
/*
    $mward  = '41';
    $fward    = '42';
    $gward   = '43';
    $icuward = '44';
    $vipward =  '45';
*/
    print "รายชื่อผู้ป่วยในทั้งหมด ณ วันที่ $Thaidate &nbsp;&nbsp;<a target=_self  href='ipptchk1.php'><<  ตรวจสอบห้องว่าง</a>&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br>";
    include("connect.inc");

    //$ward='41'; //mward
    //print "หอผู้ป่วยชาย<br>";
    print "<table width='1000'>";
    print "<tr>";
		  print "<th bgcolor=CD853F><font face='Angsana New'font size='2' font size='2' ><b>#</b></th>";
	  print "<th bgcolor=CD853F><font face='Angsana New'font size='2' font size='2' ><b>#</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>เตียง</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ฉลาก</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ชื่อผู้ป่วย</b></th>";
 print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>อายุ</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>โรค</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>สิทธิ</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>แพทย์</b></th>";
//print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ราคาเตียง</b></th>";
//print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>เวลาคำนวณค่าเตียง</b></th>";
    print "</tr>";
	 $num='0';
	  $numall='0';

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),hn,an,ptname,diagnos,
                    ptright,doctor,bedname,age,lastcalroom,bedcode FROM bed where an !='' and ptname<>'' ORDER BY bedcode ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$hn,$an,$ptname,$diagnos,$ptright,$doctor,$bedname,$age,$lastcalroom,$bedcode) = mysql_fetch_row ($result)) {
$num++;
if($lastcalroom=="0000-00-00 00:00:00"||$lastcalroom=="") $cloor="#FF0000";
else $cloor="#F5DEB3";

$lbedcode=substr($bedcode,0,2);
	if($lbedcode!=$lbedcode1){$num=1;}
	if($lbedcode=='42'){
$wardname="หอผู้ป่วยรวม";	
$sortname="รวม";
$color="#F5DEB3";
	}elseif($lbedcode=='43'){
$wardname="หอผู้ป่วยสูติ";	
$sortname="สูติ";
$color="#00FF99";
	}elseif($lbedcode=='44'){
$wardname="หอผู้ป่วยICU";	
$sortname="ICU";
$color="#FF9B9B";
	}elseif($lbedcode=='45'){
$wardname="หอผู้ป่วยพิเศษ";	
$sortname="พิเศษ";
$color="#66CDAA";
	}
	$numall++;
	$lbedcode1=$lbedcode;
        print ("<tr BGCOLOR='$color'>\n".
			"  <td ><font face='Angsana New'font size='2'>$numall</td>\n".
			"  <td ><font face='Angsana New'font size='2'>$num</td>\n".
           "  <td ><font face='Angsana New'font size='2'>$sortname เตียง$bed</td>\n".
   "  <td BGCOLOR=66CDAA><a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=..........................\">S</a></td>\n".

           "  <td ><font face='Angsana New'font size='2'>$date</td>\n".
           "  <td ><font face='Angsana New'font size='2'>$hn</td>\n".
           "  <td ><font face='Angsana New'font size='2'>$an</td>\n".
           "  <td ><font face='Angsana New'font size='3'><b>$ptname</b></td>\n".
			     "  <td ><font face='Angsana New'font size='2'>$age</td>\n".
           "  <td ><font face='Angsana New'font size='2'>$diagnos</td>\n".
           "  <td ><font face='Angsana New'font size='2'>$ptright</td>\n".
           "  <td ><font face='Angsana New'font size='2'>$doctor</td>\n".
// "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$bedname</td>\n".
// "  <td BGCOLOR=$cloor><font face='Angsana New'font size='2'>$lastcalroom</td>\n".
           " </tr>\n");
        }
    print "</table>";


// $fward    = '42';
   /* $ward='42'; //mward
	  
    print "หอผู้ป่วยรวม<br>";
    print "<table>";
    print "<tr>";
	   print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>#</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'font size='2' ><b>เตียง</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ฉลาก</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>ชื่อผู้ป่วย</b></th>";
  print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>อายุ</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'font size='2'><b>โรค</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>สิทธิ</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'font size='2'><b>แพทย์</b></th>";
 //   print " <th bgcolor=#808000><font face='Angsana New'font size='2'><b>ราคาเตียง</b></th>";
	//print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>เวลาคำนวณค่าเตียง</b></th>";
    print "</tr>";
 $num='0';
    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,age,lastcalroom FROM bed WHERE bedcode LIKE '$ward%'  and ptname<>'' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$age,$lastcalroom) = mysql_fetch_row ($result)) {
		 $num++;
		 if($lastcalroom=="0000-00-00 00:00:00"||$lastcalroom=="") $cloor="#FF0000";
else $cloor="#CCCC00";
        print ("<tr>\n".
			 "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$num</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>รวม เตียง $bed</td>\n".
   "  <td BGCOLOR=66CDAA><a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=..........................\">S</a></td>\n".

           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$date</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$hn</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$an</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='3'><b>$ptname</b></td>\n".
			    "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$age</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$diagnos</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$ptright</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$doctor</td>\n".
 //    "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>$bedname</td>\n".
//"  <td BGCOLOR=$cloor><font face='Angsana New'font size='2'>$lastcalroom</td>\n".
           " </tr>\n");
        }
    print "</table>";

// $gward   = '43';
    $ward='43'; //mward
    print "หอผู้ป่วยสูติ-นรี<br>";
    print "<table>";
    print "<tr>";
	    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>#</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>เตียง</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ฉลาก</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>ชื่อผู้ป่วย</b></th>";
	   print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>อายุ</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'font size='2'><b>โรค</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>สิทธิ</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'font size='2'><b>แพทย์</b></th>";
//  print " <th bgcolor=#669999><font face='Angsana New'font size='2'><b>ราคาเตียง</b></th>";
 // print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>เวลาคำนวณค่าเตียง</b></th>";
    print "</tr>";
$num='0';
    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,age,lastcalroom FROM bed WHERE bedcode LIKE '$ward%'  and ptname<>'' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$age,$lastcalroom) = mysql_fetch_row ($result)) {
		$num++;
		if($lastcalroom=="0000-00-00 00:00:00"||$lastcalroom=="") $cloor="#FF0000";
else $cloor="#00FF99";
        print ("<tr>\n".
			      "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$num</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>สูติ เตียง$bed</td>\n".
   "  <td BGCOLOR=66CDAA><a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=..........................\">S</a></td>\n".

           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$date</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$hn</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$an</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='3'><b>$ptname</b></td>\n".
			        "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$age</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$diagnos</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$ptright</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$doctor</td>\n".
      //     "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>$bedname</td>\n".
	//	   "  <td BGCOLOR=$cloor><font face='Angsana New'font size='2'>$lastcalroom</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
// $icuward = '44';
    $ward='44'; //mward
    print "หอผู้ป่วยวิกฤต(ICU)<br>";
    print "<table>";
    print "<tr>";
	    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>#</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>เตียง</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ฉลาก</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ชื่อผู้ป่วย</b></th>";
	    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>อายุ</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>โรค</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>สิทธิ</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>แพทย์</b></th>";
//    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ราคาเตียง</b></th>";
	//print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>เวลาคำนวณค่าเตียง</b></th>";
    print "</tr>";
$num='0';
    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,age,lastcalroom FROM bed WHERE bedcode LIKE '$ward%' and ptname<>'' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$age,$lastcalroom) = mysql_fetch_row ($result)) {
		$num++;
		if($lastcalroom=="0000-00-00 00:00:00"||$lastcalroom=="") $cloor="#FF0000";
else $cloor="#F5DEB3";
        print ("<tr>\n".
			 "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>ICUเตียง $bed</td>\n".
   "  <td BGCOLOR=66CDAA><a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=..........................\">S</a></td>\n".

           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$date</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$an</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='3'><b>$ptname</b></td>\n".
			          "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$age</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$diagnos</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$doctor</td>\n".
     //     "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>$bedname</td>\n".
	//	  "  <td BGCOLOR=$cloor><font face='Angsana New'font size='2'>$lastcalroom</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
// $vipward =  '45';
    $ward='45'; //mward
    print "หอผู้ป่วยพิเศษ<br>";
    print "<table>";
    print "<tr>";
	 print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>#</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>เตียง</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ฉลาก</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>วันรับป่วย</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>ชื่อผู้ป่วย</b></th>";
	    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>อายุ</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'font size='2'><b>โรค</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>สิทธิ</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'font size='2'><b>แพทย์</b></th>";
//   print " <th bgcolor=6495ED><font face='Angsana New'font size='2'><b>ราคาเตียง</b></th>";
 //  print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>เวลาคำนวณค่าเตียง</b></th>";
    print "</tr>";
$num='0';
    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,age,lastcalroom FROM bed WHERE bedcode LIKE '$ward%' and ptname<>'' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$age,$lastcalroom) = mysql_fetch_row ($result)) {
		$num++;
		if($lastcalroom=="0000-00-00 00:00:00"||$lastcalroom=="") $cloor="#FF0000";
else $cloor="66CDAA";
        print ("<tr>\n".
			      "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>พิเศษ เตียง $bed</td>\n".
   "  <td BGCOLOR=66CDAA><a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=..........................\">S</a></td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='3'><b>$ptname</b></td>\n".
			   "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$age</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$diagnos</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$doctor</td>\n".
      // "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>$bedname</td>\n".
	 //  "  <td BGCOLOR=$cloor><font face='Angsana New'font size='2'>$lastcalroom</td>\n".
           " </tr>\n");
        }
    print "</table>";*/
//
    include("unconnect.inc");
?>