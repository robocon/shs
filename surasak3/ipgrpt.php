<?php
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipgroup SELECT b.icd10, a.date, a.dcdate, a.days, a.an, a.result, a.camp, a.goup
FROM ipcard AS a, diag AS b
WHERE a.an = b.an   AND b.type = 'PRINCIPLE' AND a.date LIKE '$yrmonth%' 
ORDER BY `b`.`icd10` ASC";
    $result = mysql_query($query) or die("Query failed,opday");

    print "1. ผู้ป่วยในจำแนกตามประเภทบุคคล โดยเรียงรหัสโรค เดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
//G11
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ก.1 นายทหารประจำการ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ก1</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG1=0;
    $daysG11=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp FROM ipgroup WHERE goup LIKE 'G11%' ORDER BY icd10 asc"; 
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
        $num++;
        $daysG11=$daysG11+$days;
        $admdate=substr($date,0,10);
        $outdate=substr($dcdate,0,10);
		
		
	
		
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$outdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
       }

//G12
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ก.2 นายสิบ พลทหารประจำการ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ก2</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG12=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G12%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG12=$daysG12+$days;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G13
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ก.3 ข้าราชการกลาโหมพลเรือน</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ก3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG13=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G13%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG13=$daysG13+$days;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G14
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ก.4 ลูกจ้างประจำ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ก4</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG14=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G14%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG14=$daysG14+$days;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G15
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ก.5 ลูกจ้างชั่วคราว</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ก5</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG15=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G15%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG15=$daysG15+$days;
    $daysG1=$daysG11+$daysG12+$daysG13+$daysG14+$daysG15;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G21
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ข.1 นายสิบ พลทหารกองประจำการ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ข1</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG2=0;
    $daysG21=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G21%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG21=$daysG21+$days;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	
	
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G22
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ข.2 นักเรียนทหาร</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ข2</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG22=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G22%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG22=$daysG22+$days;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G23
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ข.3 อาสาสมัครทหารพราน</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ข3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG23=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G23%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG23=$daysG23+$days;
    $daysG2=$daysG21+$daysG22+$daysG23;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G24
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ข.4 นักโทษทหาร</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ข3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG24=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G24%' ORDER BY icd10 asc ";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG24=$daysG24+$days;
    $daysG2=$daysG21+$daysG22+$daysG23+$daysG24;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G31
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.1 ครอบครัวทหาร</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค1</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG3=0;
    $daysG31=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G31%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG31=$daysG31+$days;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G32
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.2 ทหารนอกประจำการ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค2</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG32=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G32%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG32=$daysG32+$days;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);


        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G33
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.3 นักศึกษาวิชาทหาร(รด)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG33=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G33%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG33=$daysG33+$days;
    $daysG3=$daysG31+$daysG32+$daysG33;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }
////////
//G34
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.4 วิวัฒน์พลเมือง</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG34=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G34%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG34=$daysG34+$days;
    $daysG3=$daysG31+$daysG32+$daysG33+$daysG34;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }

//G35
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.5 บัตรประกันสังคม</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG35=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G35%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG35=$daysG35+$days;
    $daysG3=$daysG31+$daysG32+$daysG33+$daysG34+$daysG35;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }
//G36
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.6 บัตรทอง30บาท</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG36=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G36%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG36=$daysG36+$days;
    $daysG3=$daysG31+$daysG32+$daysG33+$daysG34+$daysG35+$daysG36;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }
//G37
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG37=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G37%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG37=$daysG37+$days;
    $daysG3=$daysG31+$daysG32+$daysG33+$daysG34+$daysG35+$daysG36+$daysG37;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }
//G38
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.8 พลเรือน(ไม่เบิกต้นสังกัด)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG38=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G38%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG38=$daysG38+$days;
    $daysG3=$daysG31+$daysG32+$daysG33+$daysG34+$daysG35+$daysG36+$daysG37+$daysG38;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }
//G39
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>ค.9 อื่นๆไม่ระบุ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'># ค3</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ICD</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รับป่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>จำหน่าย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>AN</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ผลการรักษา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>สังกัด</th>";
    print "  </tr>";

    $num=0;
    $daysG39=0;
    $query = "SELECT icd10,date,dcdate,days,an,result,camp,goup FROM ipgroup WHERE goup LIKE 'G39%' ORDER BY icd10 asc";
    $ans = mysql_query($query) or die("Query failed");
    while (list ($icd10,$date,$dcdate,$days,$an,$result,$camp) = mysql_fetch_row ($ans)) {
    $num++;
    $daysG39=$daysG39+$days;
    $daysG3=$daysG31+$daysG32+$daysG33+$daysG34+$daysG35+$daysG36+$daysG37+$daysG38+$daysG39;
    $admdate=substr($date,0,10);
    $dcdate=substr($dcdate,0,10);
	

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$admdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$result</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp</td>\n".
           " </tr>\n");
      }
///////
    print "</table>";

////////////////////////
   print "<br><br>";
    $Gnet=0;
    print "2. รายงานจำนวนผู้ป่วยในจำแนกตามประเภทบุคคล เดือน $yrmonth";
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=CD853F>ประเภทบุคคล</th>";
    print "  <th bgcolor=CD853F>จำนวน(คน)</th>";
    print "  <th bgcolor=CD853F>วันรักษา(วัน)</th>";
    print " </tr>";
//ประเภท ก1
      $query="SELECT * FROM ipgroup WHERE goup LIKE 'G11%'";
      $ans = mysql_query($query);
      $G11 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ก.1 นายทหารประจำการ</td>\n".
              "<td bgcolor=F5DEB3>$G11</td>\n".
              "<td bgcolor=F5DEB3>$daysG11</td>\n".
              " </tr>\n");

//ประเภท ก2
      $query="SELECT * FROM ipgroup WHERE goup LIKE 'G12%'";
      $ans = mysql_query($query);
      $G12 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ก.2 นายสิบ พลทหารประจำการ</td>\n".
              "<td bgcolor=F5DEB3>$G12</td>\n".
              "<td bgcolor=F5DEB3>$daysG12</td>\n".
              " </tr>\n");
//ประเภท ก3
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G13%'";
     $ans = mysql_query($query);
     $G13 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ก.3 ข้าราชการกลาโหมพลเรือน</td>\n".
              "<td bgcolor=F5DEB3>$G13</td>\n".
              "<td bgcolor=F5DEB3>$daysG13</td>\n".
              " </tr>\n");
//ประเภท ก4
      $query="SELECT * FROM ipgroup WHERE goup LIKE 'G14%'";
      $ans = mysql_query($query);
      $G14 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ก.4 ลูกจ้างประจำ</td>\n".
              "<td bgcolor=F5DEB3>$G14</td>\n".
              "<td bgcolor=F5DEB3>$daysG14</td>\n".
              " </tr>\n");
//ประเภท ก5
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G15%'";
     $ans = mysql_query($query);
     $G15 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ก.5 ลูกจ้างชั่วคราว</td>\n".
              "<td bgcolor=F5DEB3>$G15</td>\n".
              "<td bgcolor=F5DEB3>$daysG15</td>\n".
              " </tr>\n");

     $G1=$G11+$G12+$G13+$G14+$G15;
     $Gnet=$Gnet+$G1;
        print("<tr>\n".
                "<td bgcolor=CCCCCC>........................รวมประเภท ก</td>\n".
                "<td bgcolor=CCCCCC>$G1</td>\n".
                "<td bgcolor=CCCCCC>$daysG1</td>\n".
                " </tr>\n");
//ประเภท ข1
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G21%'";
     $ans = mysql_query($query);
     $G21 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ข.1 นายสิบ พลทหารกองประจำการ</td>\n".
              "<td bgcolor=F5DEB3>$G21</td>\n".
              "<td bgcolor=F5DEB3>$daysG21</td>\n".
              " </tr>\n");
//ประเภท ข2
      $query="SELECT * FROM ipgroup WHERE goup LIKE 'G22%'";
      $ans = mysql_query($query);
      $G22 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ข.2 นักเรียนทหาร</td>\n".
              "<td bgcolor=F5DEB3>$G22</td>\n".
              "<td bgcolor=F5DEB3>$daysG22</td>\n".
              " </tr>\n");
//ประเภท ข3
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G23%'";
     $ans = mysql_query($query);
     $G23 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ข.3 อาสาสมัครทหารพราน</td>\n".
              "<td bgcolor=F5DEB3>$G23</td>\n".
              "<td bgcolor=F5DEB3>$daysG23</td>\n".
              " </tr>\n");
//ประเภท ข4
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G24%'";
     $ans = mysql_query($query);
     $G24 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ข.4 นักโทษทหาร</td>\n".
              "<td bgcolor=F5DEB3>$G24</td>\n".
              "<td bgcolor=F5DEB3>$daysG24</td>\n".
              " </tr>\n");

     $G2=$G21+$G22+$G23+$G24;
     $Gnet=$Gnet+$G2;
        print("<tr>\n".
                "<td bgcolor=CCCCCC>........................รวมประเภท ข</td>\n".
                "<td bgcolor=CCCCCC>$G2</td>\n".
                "<td bgcolor=CCCCCC>$daysG2</td>\n".
                " </tr>\n");
//ประเภท ค1
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G31%'";
     $ans = mysql_query($query);
     $G31 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.1 ครอบครัวทหาร</td>\n".
              "<td bgcolor=F5DEB3>$G31</td>\n".
              "<td bgcolor=F5DEB3>$daysG31</td>\n".
              " </tr>\n");
//ประเภท ค2
      $query="SELECT * FROM ipgroup WHERE goup LIKE 'G32%'";
      $ans = mysql_query($query);
      $G32 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.2 ทหารนอกประจำการ</td>\n".
              "<td bgcolor=F5DEB3>$G32</td>\n".
              "<td bgcolor=F5DEB3>$daysG32</td>\n".
              " </tr>\n");
//ประเภท ค3
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G33%'";
     $ans = mysql_query($query);
     $G33 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.3 นักศึกษาวิชาทหาร(รด)</td>\n".
              "<td bgcolor=F5DEB3>$G33</td>\n".
              "<td bgcolor=F5DEB3>$daysG33</td>\n".
              " </tr>\n");
///////
//ประเภท ค4
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G34%'";
     $ans = mysql_query($query);
     $G34 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.4 วิวัฒน์พลเมือง</td>\n".
              "<td bgcolor=F5DEB3>$G34</td>\n".
              "<td bgcolor=F5DEB3>$daysG34</td>\n".
              " </tr>\n");
//ประเภท ค5
      $query="SELECT * FROM ipgroup WHERE goup LIKE 'G35%'";
      $ans = mysql_query($query);
      $G35 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.5 บัตรประกันสังคม</td>\n".
              "<td bgcolor=F5DEB3>$G35</td>\n".
              "<td bgcolor=F5DEB3>$daysG35</td>\n".
              " </tr>\n");
//ประเภท ค6
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G36%'";
     $ans = mysql_query($query);
     $G36 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.6 บัตรทอง30บาท</td>\n".
              "<td bgcolor=F5DEB3>$G36</td>\n".
              "<td bgcolor=F5DEB3>$daysG36</td>\n".
              " </tr>\n");
//ประเภท ค7
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G37%'";
     $ans = mysql_query($query);
     $G37 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)</td>\n".
              "<td bgcolor=F5DEB3>$G37</td>\n".
              "<td bgcolor=F5DEB3>$daysG37</td>\n".
              " </tr>\n");
//ประเภท ค8
      $query="SELECT * FROM ipgroup WHERE goup LIKE 'G38%'";
      $ans = mysql_query($query);
      $G38 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.8 พลเรือน(ไม่เบิกต้นสังกัด)</td>\n".
              "<td bgcolor=F5DEB3>$G38</td>\n".
              "<td bgcolor=F5DEB3>$daysG38</td>\n".
              " </tr>\n");
//ประเภท ค9
     $query="SELECT * FROM ipgroup WHERE goup LIKE 'G39%'";
     $ans = mysql_query($query);
     $G39 = mysql_num_rows($ans);
      print("<tr>\n".
              "<td bgcolor=F5DEB3>ค.9 อื่นๆไม่ระบุ</td>\n".
              "<td bgcolor=F5DEB3>$G39</td>\n".
              "<td bgcolor=F5DEB3>$daysG39</td>\n".
              " </tr>\n");

////
     $G3=$G31+$G32+$G33+$G34+$G35+$G36+$G37+$G38+$G39;
     $daysG123=$daysG1+$daysG2+$daysG3;
     $Gnet=$Gnet+$G3;
        print("<tr>\n".
                "<td bgcolor=CCCCCC>........................รวมประเภท ค</td>\n".
                "<td bgcolor=CCCCCC>$G3</td>\n".
                "<td bgcolor=CCCCCC>$daysG3</td>\n".
                " </tr>\n");

        print("<tr>\n".
                "<td bgcolor=AAAAAA>........................รวมทั้งสิ้น</td>\n".
                "<td bgcolor=AAAAAA>$Gnet</td>\n".
                "<td bgcolor=AAAAAA>$daysG123</td>\n".
                " </tr>\n");

   $query="SELECT * FROM ipgroup";
   $ans = mysql_query($query);
   $Grecords = mysql_num_rows($ans);
   $avrdays=$daysG123/$Gnet;
   $avrdays=number_format($avrdays,1);
        print("<tr>\n".
                "<td bgcolor=AAAAAA>........................จำนวนระเบียน</td>\n".
                "<td bgcolor=AAAAAA>$Grecords</td>\n".
                "<td bgcolor=AAAAAA></td>\n".
                " </tr>\n");

        print("<tr>\n".
                "<td bgcolor=AAAAAA>...จำนวนวันนอนเฉลี่ยต่อผู้ป่วย 1 คน</td>\n".
                "<td bgcolor=AAAAAA>$avrdays</td>\n".
                "<td bgcolor=AAAAAA></td>\n".
                " </tr>\n");

    include("unconnect.inc");
?>