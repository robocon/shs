<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
/*
    $mward  = '41';
    $fward    = '42';
    $gward   = '43';
    $icuward = '44';
    $vipward =  '45';
*/
    print "��ª��ͼ�����㹷����� � �ѹ��� $Thaidate &nbsp;&nbsp;<a target=_self  href='ipptchk1.php'><<  ��Ǩ�ͺ��ͧ��ҧ</a>&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>";
    include("connect.inc");

    //$ward='41'; //mward
    //print "�ͼ����ª��<br>";
    print "<table width='1000'>";
    print "<tr>";
		  print "<th bgcolor=CD853F><font face='Angsana New'font size='2' font size='2' ><b>#</b></th>";
	  print "<th bgcolor=CD853F><font face='Angsana New'font size='2' font size='2' ><b>#</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>��§</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>��ҡ</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>���ͼ�����</b></th>";
 print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>����</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>�ä</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>�Է��</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ᾷ��</b></th>";
//print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>�Ҥ���§</b></th>";
//print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>���Ҥӹǳ�����§</b></th>";
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
$wardname="�ͼ��������";	
$sortname="���";
$color="#F5DEB3";
	}elseif($lbedcode=='43'){
$wardname="�ͼ������ٵ�";	
$sortname="�ٵ�";
$color="#00FF99";
	}elseif($lbedcode=='44'){
$wardname="�ͼ�����ICU";	
$sortname="ICU";
$color="#FF9B9B";
	}elseif($lbedcode=='45'){
$wardname="�ͼ����¾����";	
$sortname="�����";
$color="#66CDAA";
	}
	$numall++;
	$lbedcode1=$lbedcode;
        print ("<tr BGCOLOR='$color'>\n".
			"  <td ><font face='Angsana New'font size='2'>$numall</td>\n".
			"  <td ><font face='Angsana New'font size='2'>$num</td>\n".
           "  <td ><font face='Angsana New'font size='2'>$sortname ��§$bed</td>\n".
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
	  
    print "�ͼ��������<br>";
    print "<table>";
    print "<tr>";
	   print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>#</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'font size='2' ><b>��§</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>��ҡ</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>���ͼ�����</b></th>";
  print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>����</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'font size='2'><b>�ä</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'font size='2'><b>�Է��</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'font size='2'><b>ᾷ��</b></th>";
 //   print " <th bgcolor=#808000><font face='Angsana New'font size='2'><b>�Ҥ���§</b></th>";
	//print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>���Ҥӹǳ�����§</b></th>";
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
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'font size='2'>��� ��§ $bed</td>\n".
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
    print "�ͼ������ٵ�-���<br>";
    print "<table>";
    print "<tr>";
	    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>#</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>��§</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>��ҡ</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>���ͼ�����</b></th>";
	   print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>����</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'font size='2'><b>�ä</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'font size='2'><b>�Է��</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'font size='2'><b>ᾷ��</b></th>";
//  print " <th bgcolor=#669999><font face='Angsana New'font size='2'><b>�Ҥ���§</b></th>";
 // print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>���Ҥӹǳ�����§</b></th>";
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
           "  <td BGCOLOR=#00FF99><font face='Angsana New'font size='2'>�ٵ� ��§$bed</td>\n".
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
    print "�ͼ������ԡĵ(ICU)<br>";
    print "<table>";
    print "<tr>";
	    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>#</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>��§</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>��ҡ</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>���ͼ�����</b></th>";
	    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>����</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>�ä</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>�Է��</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>ᾷ��</b></th>";
//    print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>�Ҥ���§</b></th>";
	//print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>���Ҥӹǳ�����§</b></th>";
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
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'font size='2'>ICU��§ $bed</td>\n".
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
    print "�ͼ����¾����<br>";
    print "<table>";
    print "<tr>";
	 print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>#</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>��§</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'font size='2'><b>��ҡ</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>HN</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>AN</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>���ͼ�����</b></th>";
	    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>����</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'font size='2'><b>�ä</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'font size='2'><b>�Է��</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'font size='2'><b>ᾷ��</b></th>";
//   print " <th bgcolor=6495ED><font face='Angsana New'font size='2'><b>�Ҥ���§</b></th>";
 //  print " <th bgcolor=CD853F><font face='Angsana New'font size='2'><b>���Ҥӹǳ�����§</b></th>";
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
           "  <td BGCOLOR=66CDAA><font face='Angsana New'font size='2'>����� ��§ $bed</td>\n".
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