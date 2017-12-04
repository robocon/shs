<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    include("connect.inc");

    print "บัญชีราคาค่าบริการ $Thaidate <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "1.รายการตรวจห้องพยาธิ<br>";
    print "2.ค่าบริการทางการพยาบาล<br>";
    print "3.รายการตรวจห้องเอ็กซเรย์<br>";
    print "4.ค่าบริการห้องผ่าตัด<br>";
    print "5.ค่าบริการห้องฉุกเฉิน<br>";
    print "6.ค่าบริการทางทันตกรรม<br>";
    print "7.ค่าบริการกายภาพบำบัด<br>";
    print "8.ค่าบริการไตเทียมฟอกโลหิต<br>";
    print "9.ค่าบริการอื่นๆ<br>";
    print "*****************<br>";

//1.รายการตรวจห้องพยาธิ
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>1. รายการตรวจห้องพยาธิ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
	 print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part,oldcode FROM labcare WHERE depart = 'PATHO' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part,$oldcode) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
			   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$oldcode</td>\n".
           " </tr>\n");
         }
//2.ค่าบริการทางการพยาบาล
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>2. ค่าบริการทางการพยาบาล</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'WARD' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//3.รายการตรวจห้องเอ็กซเรย์
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>3. รายการตรวจห้องเอ็กซเรย์</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
     print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
   print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'XRAY' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//4.ค่าบริการห้องผ่าตัด
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>4. ค่าบริการห้องผ่าตัด</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
   print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'SURG' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//5.ค่าบริการห้องฉุกเฉิน
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>5. ค่าบริการห้องฉุกเฉิน</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'EMER' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//6.ค่าบริการทางทันตกรรม
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>6. ค่าบริการทางทันตกรรม</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'DENTA' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//7.ค่าบริการกายภาพบำบัด
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>7. ค่าบริการกายภาพบำบัด</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'PHYSI' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//8.ค่าบริการไตเทียมฟอกโลหิต
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>8. ค่าบริการไตเทียมฟอกโลหิต</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'HEMO' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//9.ค่าบริการอื่นๆ
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>9. ค่าบริการอื่นๆ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>กลุ่ม</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'OTHER' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }

    print "</table>";
    include("unconnect.inc");
    print " <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
?>

