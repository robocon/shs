<?php
    $Thaidate=date("d/m/").(date("Y")+543);
    print  "�Ҥ��� �Ǫ�ѳ�� ����ػ�ó���ᾷ�� $Thaidate<br> ";

    print "<br>[���ʡ���觡�������Ǫ�ѳ������ػ�ó�������ԡ<br> ";
    print "<font face='Angsana New'>DDL =   ��㹺ѭ������ѡ��觪ҵ� �ԡ��<br> ";
    print "<font face='Angsana New'>DDY =   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��(�������ᾷ��͹��ѵ�)<br> ";
    print "<font face='Angsana New'>DDN =   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����<br> ";
    print "<font face='Angsana New'>DSY =   �Ǫ�ѳ�� ����ԡ��(�����¹͡�ԡ�����,��������ԡ��)<br> ";
    print "<font face='Angsana New'>DSN =   �Ǫ�ѳ�� ����ԡ�����<br> ";
    print "<font face='Angsana New'>DPY =   �ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ)<br> ";
    print "<font face='Angsana New'>DPN =   �ػ�ó� ����ԡ����� ";

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
//1. ��㹺ѭ������ѡ��觪ҵ� �ԡ��ء��¡�� (DDL)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>1. ��㹺ѭ������ѡ��觪ҵ� �ԡ��ء��¡�� (DDL)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";


    print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
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
//2. �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��(��ͧ�ա������ᾷ��3��͹��ѵ�) DDY
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>2. �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��(��ͧ�ա������ᾷ��3��͹��ѵ�) DDY</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
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
//3. �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����� (DDN)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>3. �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����� (DDN)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
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
//4. �Ǫ�ѳ�� ����ԡ��(�����¹͡�ԡ�����,��������ԡ��) DSY
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>4. �Ǫ�ѳ�� ����ԡ��(�����¹͡�ԡ�����,��������ԡ��) DSY</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ�µ�� ú.</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
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
//5. �Ǫ�ѳ�� ����ԡ�����(DSN)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>5. �Ǫ�ѳ�� ����ԡ�����(DSN)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ�µ�� ú.</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
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
//6.�ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ) DPY
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>6.�ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ) DPY</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";


print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ�����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ�� ú</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";

    print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
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
//7. �ػ�ó� ����ԡ�����(DPN)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>7. �ػ�ó� ����ԡ�����(DPN)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>";
   
  print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ�µ�� ú.</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
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
// ��Ǩ�ͺ��¡�÷��ŧ���ʡ�����Դ
    print "<table>";
    print " <tr>";
    print "  <th>��Ǩ�ͺ��¡�÷��ŧ���ʡ�����Դ�������ŧ����(��ͧ������١��ͧ)</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>#</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>����</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>�������ѭ</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>������</th>";
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

 