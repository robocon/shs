<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

   //item count
   $item=0;
   for ($n=1; $n<=$m; $n++){
        If (!empty($aLabcode[$n])){
             $item++;
	}
            };

    include("connect.inc");
//insert data into ddepart
   $query = "INSERT INTO ddepart(chktranx,date,ptname,hn,doctor,depart,item,detail,price,sumyprice,sumnprice, idname,diag,accno,tvn,ptright,whokey)VALUES('$nChktranx','$Thidate','$cPtname','$cHn','$sOfficer','$cDepart','$item','$cDetail',
                    '$nLabprice','$aSumYprice','$aSumNprice','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright','DR');";

       $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>
	*�ô��Ǩ�ͺ�������¡������� [�١�è����Թ] �������<br>
	*������ʴ���� ��ѹ�֡仡�͹����<br>
	*���������ʴ����  ��úѹ�֡�������<br><br>
                -------- ��¡�� ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn  VN:$tvn<br>
                �Է��: $cPtright<br>
                �ä:$cDiag<br>
                ᾷ��:$sOfficer<br>
                $cDetail<br>
               �ӹǹ $item ��¡��<br>
               �Ҥ���� $nLabprice �ҷ<br>
               ���. $sOfficer<br>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into dpatdata
    for ($n=1; $n<=$m; $n++){
         If (!empty($aLabcode[$n])){
                $query = "INSERT INTO dpatdata(date,hn,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
                                 VALUES('$Thidate','$cHn','$cPtname','$sOfficer','$item','$aLabcode[$n]','$aDetail[$n]','$aTime[$n]',
                                 '$aItemprice[$n]','$cDepart','$aLabpart[$n]','$aYprice[$n]','$aNprice[$n]','$idno','$cPtright');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
        }
        }

/* in case of inpatient insert data into ipacc
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
//update data in opday 
	if ($cDepart == 'XRAY'){
			    $xraypri=$Netprice;
	            }
	else {
					    $xraypri=0;
	         }
	if ($cDepart =='PATHO'){
			    $pathopri=$Netprice;
	            }
	else {
					    $pathopri=0;
	         }
	if ($cDepart =='EMER'){
			    $emerpri=$Netprice;
	            }
	else {
					    $emerpri=0;
	         }
	if ($cDepart =='SURG'){
			    $surgpri=$Netprice;
	            }
	else {
					    $surgpri=0;
	         }
	if ($cDepart =='PHYSI'){
			    $physipri=$Netprice;
	            }
	else {
					    $physipri=0;
	         }
	if ($cDepart =='DENTA'){
			    $dentapri=$Netprice;
	            }
	else {
					    $dentapri=0;
	         }
	if ($cDepart =='OTHER'){
			    $otherpri=$Netprice;
	            }
	else {
					    $otherpri=0;
	         }

		$Thdhn=date("d-m-").(date("Y")+543).$cHn;
        $query ="UPDATE opday SET   xray= xray+$xraypri,
																patho=patho+$pathopri,
																emer=emer+$emerpri,
																surg=surg+$surgpri,
																physi=physi+$physipri,
																denta=denta+$dentapri,
																other=other+$otherpri
					   WHERE thdatehn= '$Thdhn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");
*/
   include("unconnect.inc");
//���˹��
  print "���˹��<br>";
     print "<font face='Angsana New'>$cPtname HN:$cHn VN:$tvn  �Է��: $cPtright<br>";
//    print "�Է��: $cPtright<br>";
    print "�ä:$cDiag ᾷ��:$sOfficer<br>";
//    print "ᾷ��:$cDoctor<br>";
      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>��¡��</th>";
      print "  <th>�ӹǹ</th>";
      print "  <th>�Ҥ�</th>";
      print " </tr>";

    $no=0;
    for ($n=1; $n<=$m; $n++){
          If (!empty($aLabcode[$n])){
              $no++;
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$aDetail[$n]</td>\n".
           "  <td>$aTime[$n]</td>\n".
           "  <td>$aItemprice[$n]</td>\n".
           " </tr>\n");
                         }
                         } ;
      print "</table>";
   print "<B>�Ҥ���� $nLabprice �ҷ</B><br>";
   print "���. $sOfficer";  
      print "<font face='Angsana New'>&nbsp;&nbsp;$Thaidate<br>";
      print "***************************************************<br>";  
	     print "<B>�����˹��仪����Թ�����ͧ���Թ</B>";  
//�����˹��
?>
 
