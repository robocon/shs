<?php
    $Thaidate=date("d/m/").(date("Y")+543);
    print  "ราคายา เวชภัณฑ์ และอุปกรณ์การแพทย์ $Thaidate<br> ";

    print "<br>[รหัสการแบ่งกลุ่มยาเวชภัณฑ์และอุปกรณ์ตามการเบิก<br> ";
    print "<font face='Angsana New'>DDL =   ยาในบัญชียาหลักแห่งชาติ เบิกได้<br> ";
    print "<font face='Angsana New'>DDY =   ยานอกบัญชียาหลักแห่งชาติ เบิกได้(กรรมการแพทย์อนุมัติ)<br> ";
    print "<font face='Angsana New'>DDN =   ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้<br> ";
    print "<font face='Angsana New'>DSY =   เวชภัณฑ์ ที่เบิกได้(ผู้ป่วยนอกเบิกไม่ได้,ผู้ป่วยในเบิกได้)<br> ";
    print "<font face='Angsana New'>DSN =   เวชภัณฑ์ ที่เบิกไม่ได้<br> ";
    print "<font face='Angsana New'>DPY =   อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)<br> ";
    print "<font face='Angsana New'>DPN =   อุปกรณ์ ที่เบิกไม่ได้ ";

    include("connect.inc");
 /*runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RX1D'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $dStartday=$row->startday;
*/
//1. ยาในบัญชียาหลักแห่งชาติ เบิกได้ทุกรายการ (DDL)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>1. ยาในบัญชียาหลักแห่งชาติ เบิกได้ทุกรายการ (DDL)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";


    print "  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE part = 'DDL'ORDER BY drugcode ";
     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
//2. ยานอกบัญชียาหลักแห่งชาติ เบิกได้(ต้องมีกรรมการแพทย์3คนอนุมัติ) DDY
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>2. ยานอกบัญชียาหลักแห่งชาติ เบิกได้(ต้องมีกรรมการแพทย์3คนอนุมัติ) DDY</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE part = 'DDY' ORDER BY drugcode";
     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
//3. ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้ (DDN)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>3. ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้ (DDN)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE part = 'DDN'ORDER BY drugcode ";
     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
//4. เวชภัณฑ์ ที่เบิกได้(ผู้ป่วยนอกเบิกไม่ได้,ผู้ป่วยในเบิกได้) DSY
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>4. เวชภัณฑ์ ที่เบิกได้(ผู้ป่วยนอกเบิกไม่ได้,ผู้ป่วยในเบิกได้) DSY</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาขายตาม รบ.</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part,unitpri FROM druglst  WHERE part = 'DSY'ORDER BY drugcode ";
     $result = mysql_query($query)
        or die("Query failed");

    $num=0;

    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part,$unitpri) = mysql_fetch_row ($result)) {


       
 $num++;
 if ($unitpri<=0.2){
  $nSalepri1=0.5;}
else if($unitpri<=0.5){
  $nSalepri1=1;}
else if($unitpri<=1){
  $nSalepri1=1.5;}
else if($unitpri<=5){
  $nSalepri1=1.5+1.25*($unitpri-1);}
else if($salepri<=10){
  $nSalepri1=6.05+1.2*($unitpri-5);}
else if($salepri<=50){
  $nSalepri1=12.5+1.18*($unitpri-10);}
else if($salepri<=100){
  $nSalepri1=60+1.16*($unitpri-50);}
else if($salepri<=500){
  $nSalepri1=118+1.14*($unitpri-100);}
else if($salepri<=1000){
  $nSalepri1=574+1.12*($unitpri-500);}
else if($salepri<=5000){
  $nSalepri1=1134+1.10*($unitpri-1000);}
else if($salepri<=10000){
  $nSalepri1=5534+1.08*($unitpri-5000);}
else {$nSalepri1=10934+1.06*($unitpri-10000);
}



        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
            
"  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
"  <td BGCOLOR=99CCFF><font face='Angsana New'>$nSalepri1</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
//5. เวชภัณฑ์ ที่เบิกไม่ได้(DSN)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>5. เวชภัณฑ์ ที่เบิกไม่ได้(DSN)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาขายตาม รบ.</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part,unitpri FROM druglst  WHERE part = 'DSN'ORDER BY drugcode ";
     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part,$unitpri) = mysql_fetch_row ($result)) {
        $num++;
 if ($unitpri<=0.2){
  $nSalepri1=0.5;}
else if($unitpri<=0.5){
  $nSalepri1=1;}
else if($unitpri<=1){
  $nSalepri1=1.5;}
else if($unitpri<=5){
  $nSalepri1=1.5+1.25*($unitpri-1);}
else if($salepri<=10){
  $nSalepri1=6.05+1.2*($unitpri-5);}
else if($salepri<=50){
  $nSalepri1=12.5+1.18*($unitpri-10);}
else if($salepri<=100){
  $nSalepri1=60+1.16*($unitpri-50);}
else if($salepri<=500){
  $nSalepri1=118+1.14*($unitpri-100);}
else if($salepri<=1000){
  $nSalepri1=574+1.12*($unitpri-500);}
else if($salepri<=5000){
  $nSalepri1=1134+1.10*($unitpri-1000);}
else if($salepri<=10000){
  $nSalepri1=5534+1.08*($unitpri-5000);}
else {$nSalepri1=10934+1.06*($unitpri-10000);
}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".          
 "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
 "  <td BGCOLOR=99CCFF><font face='Angsana New'>$nSalepri1</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
//6.อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน) DPY
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>6.อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน) DPY</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกได้</th>";


print "  <th bgcolor=6495ED><font face='Angsana New'>เบิกไม่ได้</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาขาย รบ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";

    print "  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,freepri,unit,totalstk,rxrate,part,unitpri FROM druglst  WHERE part = 'DPY'ORDER BY drugcode ";
     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$freepri,$unit,$totalstk,$rxrate,$part,$unitpri) = mysql_fetch_row ($result)) {
        $num++;
$freepri1=0;
$freepri1=$salepri-$freepri;
 if ($unitpri<=0.2){
  $nSalepri1=0.5;}
else if($unitpri<=0.5){
  $nSalepri1=1;}
else if($unitpri<=1){
  $nSalepri1=1.5;}
else if($unitpri<=5){
  $nSalepri1=1.5+1.25*($unitpri-1);}
else if($salepri<=10){
  $nSalepri1=6.05+1.2*($unitpri-5);}
else if($salepri<=50){
  $nSalepri1=12.5+1.18*($unitpri-10);}
else if($salepri<=100){
  $nSalepri1=60+1.16*($unitpri-50);}
else if($salepri<=500){
  $nSalepri1=118+1.14*($unitpri-100);}
else if($salepri<=1000){
  $nSalepri1=574+1.12*($unitpri-500);}
else if($salepri<=5000){
  $nSalepri1=1134+1.10*($unitpri-1000);}
else if($salepri<=10000){
  $nSalepri1=5534+1.08*($unitpri-5000);}
else {$nSalepri1=10934+1.06*($unitpri-10000);
}

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
          "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
           
 "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
    "  <td BGCOLOR=99CCFF><font face='Angsana New'>$freepri</td>\n".
    "  <td BGCOLOR=99CCFF><font face='Angsana New'>$freepri1</td>\n".
      
      
 "  <td BGCOLOR=99CCFF><font face='Angsana New'>$nSalepri1</td>\n".

            "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
//7. อุปกรณ์ ที่เบิกไม่ได้(DPN)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>7. อุปกรณ์ ที่เบิกไม่ได้(DPN)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>";
   
  print "  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>ราคาขายตาม รบ.</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part,unitpri FROM druglst  WHERE part = 'DPN' ORDER BY drugcode";
     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part,$unitpri) = mysql_fetch_row ($result)) {
        $num++;
 if ($unitpri<=0.2){
  $nSalepri1=0.5;}
else if($unitpri<=0.5){
  $nSalepri1=1;}
else if($unitpri<=1){
  $nSalepri1=1.5;}
else if($unitpri<=5){
  $nSalepri1=1.5+1.25*($unitpri-1);}
else if($salepri<=10){
  $nSalepri1=6.05+1.2*($unitpri-5);}
else if($salepri<=50){
  $nSalepri1=12.5+1.18*($unitpri-10);}
else if($salepri<=100){
  $nSalepri1=60+1.16*($unitpri-50);}
else if($salepri<=500){
  $nSalepri1=118+1.14*($unitpri-100);}
else if($salepri<=1000){
  $nSalepri1=574+1.12*($unitpri-500);}
else if($salepri<=5000){
  $nSalepri1=1134+1.10*($unitpri-1000);}
else if($salepri<=10000){
  $nSalepri1=5534+1.08*($unitpri-5000);}
else {$nSalepri1=10934+1.06*($unitpri-10000);
}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
          "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
            
"  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
"  <td BGCOLOR=99CCFF><font face='Angsana New'>$nSalepri1</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
// ตรวจสอบรายการที่ลงรหัสกลุ่มผิด
    print "<table>";
    print " <tr>";
    print "  <th>ตรวจสอบรายการที่ลงรหัสกลุ่มผิดหรือไม่ลงรหัส(ต้องแก้ไขให้ถูกต้อง)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>#</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>ชื่อการค้า</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>ชื่อสามัญ</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>หน่วย</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>เหลือสุทธิ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>ใช้/เดือน</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>ประเภท</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE part<>'DDL' and part<>'DDY' and part<>'DDN' and part<>'DSY' and part<>'DSN' and part<>'DPY' and part<>'DPN'";
    $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }

   include("unconnect.inc");
?>

</table>

 