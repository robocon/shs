<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
/*
    $mward  = '41';
    $fward    = '42';
    $gward   = '43';
    $icuward = '44';
    $vipward =  '45';
*/
    print "��ª��ͼ�����㹷����� � �ѹ��� $Thaidate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>";
    include("connect.inc");

    $ward='41'; //mward
    $ward1='B01'; //mward
    $ward2='B02'; //mward  
  $ward3='B03'; //mward
    print "�ͼ����ª��<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>��§</b></th>";
 //   print "<th bgcolor=CD853F><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
   // print "<th bgcolor=CD853F><font face='Angsana New'><b>HN</b></th>";
  //  print "<th bgcolor=CD853F><font face='Angsana New'><b>AN</b></th>";
  //  print "<th bgcolor=CD853F><font face='Angsana New'><b>���ͼ�����</b></th>";
   // print " <th bgcolor=CD853F><font face='Angsana New'><b>�ä</b></th>";
 //   print "<th bgcolor=CD853F><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
  //  print " <th bgcolor=CD853F><font face='Angsana New'><b>ᾷ��</b></th>";
print " <th bgcolor=CD853F><font face='Angsana New'><b>�Ҥ���§</b></th>";
print " <th bgcolor=CD853F><font face='Angsana New'><b>ʶҹ�</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),hn,an,ptname,diagnos,
                    ptright,doctor,bedname,status FROM bed WHERE bedcode LIKE '$ward%' and status LIKE '$ward1%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$hn,$an,$ptname,$diagnos,$ptright,$doctor,$bedname,$status) = mysql_fetch_row ($result)) {
  if (empty($ptname))       
 print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bed</td>\n".
       //    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
     //      "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$hn</td>\n".
      //     "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
     //      "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptname</td>\n".
      //     "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diagnos</td>\n".
    //       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
    //       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$doctor</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bedname</td>\n".
"  <td BGCOLOR=F5DEB3><font face='Angsana New'>$status</td>\n".

           " </tr>\n");
        }
    print "</table>";
// $fward    = '42';

    $ward='42'; //mward
    print "�ͼ�����˭ԧ<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>��§</b></th>";
 //   print "<th bgcolor=#808000><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
 //   print "<th bgcolor=#808000><font face='Angsana New'><b>HN</b></th>";
 //   print "<th bgcolor=#808000><font face='Angsana New'><b>AN</b></th>";
 //  print "<th bgcolor=#808000><font face='Angsana New'><b>���ͼ�����</b></th>";
 //   print " <th bgcolor=#808000><font face='Angsana New'><b>�ä</b></th>";
 //   print "<th bgcolor=#808000><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
  //  print " <th bgcolor=#808000><font face='Angsana New'><b>ᾷ��</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>�Ҥ���§</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>ʶҹ�</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,status FROM bed WHERE bedcode LIKE '$ward%' and status LIKE '$ward1%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$status) = mysql_fetch_row ($result)) {
  if (empty($ptname))    
        print ("<tr>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$bed</td>\n".
        //   "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$date</td>\n".
         //  "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$hn</td>\n".
        //   "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$an</td>\n".
        //   "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$ptname</td>\n".
          // "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$diagnos</td>\n".
     //      "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$ptright</td>\n".
     //      "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$doctor</td>\n".
     "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$bedname</td>\n".
  "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$status</td>\n".
           " </tr>\n");
        }
    print "</table>";

// $gward   = '43';
    $ward='43'; //mward
    print "�ͼ������ٵ�-���<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>��§</b></th>";
   // print "<th bgcolor=#669999><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
 //   print "<th bgcolor=#669999><font face='Angsana New'><b>HN</b></th>";
 //   print "<th bgcolor=#669999><font face='Angsana New'><b>AN</b></th>";
//    print "<th bgcolor=#669999><font face='Angsana New'><b>���ͼ�����</b></th>";
//    print " <th bgcolor=#669999><font face='Angsana New'><b>�ä</b></th>";
//    print "<th bgcolor=#669999><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
//    print " <th bgcolor=#669999><font face='Angsana New'><b>ᾷ��</b></th>";
  print " <th bgcolor=#669999><font face='Angsana New'><b>�Ҥ���§</b></th>";
  print " <th bgcolor=#669999><font face='Angsana New'><b>ʶҹ�</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,status FROM bed WHERE bedcode LIKE '$ward%' and status LIKE '$ward1%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$status) = mysql_fetch_row ($result)) {
         if (empty($ptname))    
 print ("<tr>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$bed</td>\n".
        //   "  <td BGCOLOR=#00FF99><font face='Angsana New'>$date</td>\n".
  //         "  <td BGCOLOR=#00FF99><font face='Angsana New'>$hn</td>\n".
  //         "  <td BGCOLOR=#00FF99><font face='Angsana New'>$an</td>\n".
   //        "  <td BGCOLOR=#00FF99><font face='Angsana New'>$ptname</td>\n".
    //       "  <td BGCOLOR=#00FF99><font face='Angsana New'>$diagnos</td>\n".
     //      "  <td BGCOLOR=#00FF99><font face='Angsana New'>$ptright</td>\n".
    //       "  <td BGCOLOR=#00FF99><font face='Angsana New'>$doctor</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$bedname</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$status</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
// $icuward = '44';
    $ward='44'; //mward
    print "�ͼ������ԡĵ(ICU)<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>��§</b></th>";
 //   print "<th bgcolor=CD853F><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
//    print "<th bgcolor=CD853F><font face='Angsana New'><b>HN</b></th>";
//    print "<th bgcolor=CD853F><font face='Angsana New'><b>AN</b></th>";
 //   print "<th bgcolor=CD853F><font face='Angsana New'><b>���ͼ�����</b></th>";
 //   print " <th bgcolor=CD853F><font face='Angsana New'><b>�ä</b></th>";
//   print "<th bgcolor=CD853F><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
//    print " <th bgcolor=CD853F><font face='Angsana New'><b>ᾷ��</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>�Ҥ���§</b></th>";
print " <th bgcolor=CD853F><font face='Angsana New'><b>ʶҹ�</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,status FROM bed WHERE bedcode LIKE '$ward%' and status LIKE '$ward1%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$status) = mysql_fetch_row ($result)) {
         if (empty($ptname))    
 print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bed</td>\n".
      //     "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
      //     "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$hn</td>\n".
      //     "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
      //    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptname</td>\n".
      //     "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diagnos</td>\n".
      //     "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
    //       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$doctor</td>\n".
          "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bedname</td>\n".
"  <td BGCOLOR=F5DEB3><font face='Angsana New'>$status</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
// $vipward =  '45';
    $ward='45'; //mward
    print "�ͼ����¾����<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>��§</b></th>";
   // print "<th bgcolor=6495ED><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
  //  print "<th bgcolor=6495ED><font face='Angsana New'><b>HN</b></th>";
  //  print "<th bgcolor=6495ED><font face='Angsana New'><b>AN</b></th>";
//    print "<th bgcolor=6495ED><font face='Angsana New'><b>���ͼ�����</b></th>";
 //   print " <th bgcolor=6495ED><font face='Angsana New'><b>�ä</b></th>";
//    print "<th bgcolor=6495ED><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
//    print " <th bgcolor=6495ED><font face='Angsana New'><b>ᾷ��</b></th>";
   print " <th bgcolor=6495ED><font face='Angsana New'><b>�Ҥ���§</b></th>";
  print " <th bgcolor=6495ED><font face='Angsana New'><b>ʶҹ�</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,status,bedpri FROM bed WHERE bedcode LIKE '$ward%' and status LIKE '$ward1%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$status,$bedpri) = mysql_fetch_row ($result)) {
         if (empty($ptname))    
 print ("<tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bed</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
 //          "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
    //       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diagnos</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
    //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedname</td>\n".
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$status</td>\n".
	   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedpri</td>\n".
           " </tr>\n");
        }
    print "</table>";
//

  $ward='45'; //mward
print "<br><br>...............................................................................................................................<br><br><br>";
    print "��ª�����§�����ԡ��<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>��§</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>��§</b></th>";
   // print "<th bgcolor=6495ED><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
  //  print "<th bgcolor=6495ED><font face='Angsana New'><b>HN</b></th>";
  //  print "<th bgcolor=6495ED><font face='Angsana New'><b>AN</b></th>";
//    print "<th bgcolor=6495ED><font face='Angsana New'><b>���ͼ�����</b></th>";
 //   print " <th bgcolor=6495ED><font face='Angsana New'><b>�ä</b></th>";
//    print "<th bgcolor=6495ED><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
//    print " <th bgcolor=6495ED><font face='Angsana New'><b>ᾷ��</b></th>";
   print " <th bgcolor=6495ED><font face='Angsana New'><b>�Ҥ���§</b></th>";
  print " <th bgcolor=6495ED><font face='Angsana New'><b>ʶҹ�</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,status,bedcode FROM bed WHERE status LIKE '$ward2%' ORDER BY bedcode ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$status,$bedcode) = mysql_fetch_row ($result)) {
         if (empty($ptname))    
 print ("<tr>\n".
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bed</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
 //          "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
    //       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diagnos</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
    //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
   
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedname</td>\n".
  
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$status</td>\n".
           " </tr>\n");
        }
    print "</table>";
//

$ward='45'; //mward
print "<br><br>...............................................................................................................................<br>";
    print "��ª�����§�ͧ<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>��§</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>��§</b></th>";
   // print "<th bgcolor=6495ED><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
  //  print "<th bgcolor=6495ED><font face='Angsana New'><b>HN</b></th>";
  //  print "<th bgcolor=6495ED><font face='Angsana New'><b>AN</b></th>";
//    print "<th bgcolor=6495ED><font face='Angsana New'><b>���ͼ�����</b></th>";
 //   print " <th bgcolor=6495ED><font face='Angsana New'><b>�ä</b></th>";
//    print "<th bgcolor=6495ED><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
//    print " <th bgcolor=6495ED><font face='Angsana New'><b>ᾷ��</b></th>";
   print " <th bgcolor=6495ED><font face='Angsana New'><b>�Ҥ���§</b></th>";
  print " <th bgcolor=6495ED><font face='Angsana New'><b>ʶҹ�</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn,doctor,bedname,status,bedcode FROM bed WHERE status LIKE '$ward3%' ORDER BY bedcode ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn,$doctor,$bedname,$status,$bedcode) = mysql_fetch_row ($result)) {
         if (empty($ptname))    
 print ("<tr>\n".
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bed</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
 //          "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
    //       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diagnos</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
    //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
   
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedname</td>\n".
  
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$status</td>\n".
           " </tr>\n");
        }
    print "</table>";
    include("unconnect.inc");
?>

