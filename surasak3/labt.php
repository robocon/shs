<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

   $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sDepart=$row->depart;
    $sDetail=$row->detail;  
    $sNetprice=$row->price*-1;
    $sDiag=$row->diag;

    $cPaid=$sNetprice;

   //item count
   $item=0;
   for ($n=1; $n<=$x; $n++){
        If (!empty($aDgcode[$n])){
             $item++;
	}
            };

    include("connect.inc");
//insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,
                    idname,diag,accno,tvn)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn','$cDoctor','$cDepart','$item','$aDetail',
                    '$Netprice','$sOfficer','$cDiag','$cAccno','$tvn');";

       $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>
	*�ô��Ǩ�ͺ�������¡������� [�١�è����Թ] �������<br>
	*������ʴ���� ��ѹ�֡仡�͹����<br>
	*���������ʴ����  ��úѹ�֡�������<br><br>
                -------- ��¡�� ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn AN:$cAn VN:$tvn<br>
                �Է��: $cPtright<br>
                �ä:$cDiag<br>
                ᾷ��:$cDoctor<br>
                $aDetail<br>
               �ӹǹ $item ��¡��<br>
               �Ҥ���� $Netprice �ҷ<br>
               ���. $sOfficer<br>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into patdata
    for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$aDgcode[$n]','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$cDepart','$aPart[$n]','$idno');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
        }
        }

// in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
     for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n]',
                                    '$aAmount[$n]','$aMoney[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
        }
   }
}

   include("unconnect.inc");

//���˹��
    print "<font face='Angsana New'>$Thaidate<br>";
    print "$cPtname HN:$cHn VN:$tvn  �Է��: $cPtright<br>";
//    print "�Է��: $cPtright<br>";
    print "�ä:$cDiag ᾷ��:$cDoctor<br>";
//    print "ᾷ��:$cDoctor<br>";

      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>��¡��</th>";
      print "  <th>�ӹǹ</th>";
      print "  <th>�Ҥ�</th>";
      print " </tr>";

    $no=0;
    for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
              $no++;
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$aTrade[$n]</td>\n".
           "  <td>$aAmount[$n]</td>\n".
           "  <td>$aMoney[$n]</td>\n".
           " </tr>\n");
                         }
                         } ;
      print "</table>";
   print "�Ҥ���� $Netprice �ҷ<br>";
   print "���. $sOfficer<br>";  
//�����˹��
?>
 
