<?php
   print"<br><b>รายชื่อผู้ป่วยที่มี เลขบัตรประจำตัวประชาชนซ้ำกัน</b>";
 print"<br><b>คลิกที่ เลขบัตรประจำตัวประชาชน ตรวจดูว่าข้อมูลซ้ำกันหรือไม่</b>";
print "&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br>";

 include("connect.inc");
   $query="SELECT  idcard,hn,name,surname,address ,COUNT(*) AS duplicate FROM opcard   GROUP BY idcard HAVING duplicate > 1";
   $result = mysql_query($query);
     $n=0;
 while (list ($idcard,$hn,$name,$surname,$adderss,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n,</td>\n".
              // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
      "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard</a></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>HN: $hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>ชื่อ: $name</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>สกุล: $surname</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนครั้งที่ซ้ำ = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");

    print"<br><b>รายชื่อผู้ป่วยที่มี ชื่อ-สกุลซ้ำกัน</b>";
 print"<br><b>คลิกที่ ชื่อ ตรวจดูว่าข้อมูลซ้ำกันหรือไม่</b>";
print "&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br>";

 include("connect.inc");
   $query="SELECT  idcard,hn,name,surname,address,concat(name,surname),COUNT(*) AS duplicate FROM opcard    GROUP BY concat(name,surname)  HAVING duplicate > 1";
   $result = mysql_query($query);
     $n=0;
 while (list ($idcard,$hn,$name,$surname,$adderss,$fullname,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n,</td>\n".
              // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</a></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>HN: $hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checknamechk.php? fullname=$fullname\">ชื่อ: $name</a></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>สกุล: $surname</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนครั้งที่ซ้ำ = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
 
?>

