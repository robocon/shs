<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdhn=date("d-m-").(date("Y")+543).$cHn;
    $Essd    =array_sum($aEssd);   //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy=array_sum($aNessdy);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $Nessdn=array_sum($aNessdn);     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
    $DSY     =array_sum($aDSY);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN     =array_sum($aDSN);   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
    $DPY     =array_sum($aDPY);   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN     =array_sum($aDPN);   //����Թ����ػ�ó� ��ǹ����ԡ�����  

$netfree=$Essd+$Nessdy+$DPY;
$netpay=$Nessdn+$DSY+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

/*test
echo "aDPY:$aDPY[1] aDPN:$aDPN[1]<br>";
echo " Essd: $Essd,Nessdy:$Nessdy,Nessdn:$Nessdn<br>";
echo " DPY :$DPY, DPN: $DPN,  DSY :$DSY, DSN: $DSN <br>";

echo "��㹺ѭ������ѡ��觪ҵ�(Essd)...................$Essd<br>";
echo "�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�� (Nessdy).$Nessdy.............�ԡ����� (Nessdny):$Nessdn<br>";
echo "����Ǫ�ѳ�� �ԡ�� (DSY).............................$DSY...........................�ԡ�����(DSN):$DSN<br>";
echo "����ػ�ó� �ԡ�� (DPY).............................$DPY...........................�ԡ�����(DPN):$DPN<br>";

echo "����ԡ��.................................................$netfree..........................����ԡ�����:$netpay<br>";
echo "���������...........$total<br>";
*/


//item count
$item=0;
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
             $item++;
	}
        };

 include("connect.inc");

//insert data into phardep
       $query = "INSERT INTO dphardep(chktranx,date,ptname,hn,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,whokey)VALUES('$nRunno','$Thidate','$cPtname','$cHn',
                    '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','DR');";

       $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������Ѵ stock 仡�͹���� ���͡�õѴ stock �������<br>
	*�ô��Ǩ�ͺ�������¡��������� [������,��è����Թ] �������<br>
	*������ʴ���� ��Ѵ stock 仡�͹����<br>
	*���������ʴ����  ��õѴ stock �������<br><br>
                -------- ��¡�è��� ---------<br> 
                $Thaidate<br>
                $cPtname  HN:$cHn VN:$tvn<br>
                �Է��:$cPtright<br>
                �ä $cDiag<br>
                ����Թ�����  $total  �ҷ<br>
                ᾷ�� $cDoctor<br>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into drugrx
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,
             amount,price,item,slcode,part,idno)VALUES('$Thidate','$cHn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno');";
        $result = mysql_query($query) or die("Query failed,insert into drugrx");
			}
        };

/*
//update data in druglst 
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query ="UPDATE druglst SET stock = stock-$aAmount[$n],
              			  rxaccum = rxaccum + $aAmount[$n],
             			  rx1day   = rx1day +$aAmount[$n],
        			  totalstk = stock + mainstk
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
			}
        };

//update data in opday 

        $query ="UPDATE opday SET diag = '$cDiag',
              			         doctor='$cDoctor',
			         phar= phar+$Netprice
                       WHERE thdatehn= '$Thdhn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");
*/

//
  print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;<B>������</B><BR>";
      print "$Thaidate<font face='Angsana New' size='2'>&nbsp; VN:$tvn<br>";
      print "<font face='Angsana New' size='1'>$cPtname  HN:$cHn<br>";
      print "�Է��:$cPtright<br>";
      //print "�ä $cDiag<br>";
    //  print "<table>";
    //  print " <tr>";
    //  print "  <th>#</th>";
    //  print "  <th>��¡��</th>";
//      print "  <th>�Ը���</th>";
   //   print "  <th>�ӹǹ</th>";
   //   print "  <th>�Ҥ�</th>";
   //   print " </tr>";
  //    $no=0;
///      for ($n=1; $n<=$x; $n++){
//   If (!empty($aDgcode[$n])){
 //             $no++;
  //       print (" <tr>\n".
    //       "  <td>$no</td>\n".
   //        "  <td>$aTrade[$n]</td>\n".
    //       "  <td>$aSlipcode[$n]</td>\n".
  //         "  <td>$aAmount[$n]</td>\n".
    //       "  <td>$aMoney[$n]</td>\n".
     //      " </tr>\n");
	//		}
   //                                           };
  //    print "</table>";
     // print "����Թ  $total  �ҷ(�ԡ����� $netpay �ҷ , �ԡ�� $netfree �ҷ)<br>";
     // print "ᾷ�� $cDoctor<br>";
	    print "�ԡ�� $netfree �ҷ&nbsp;";
		  print "�ԡ����� $netpay �ҷ <br>";
		    print "<font face='Angsana New' size='2'><B>***����Թ &nbsp; $total  �ҷ***</B><BR>";
		    print "<font face='Angsana New' size='1'>���˹�ҷ�� :$sOfficer<BR>";
			  //  print "<B>*��仪����Թ�����ͧ���Թ</B>";
//
 include("unconnect.inc");
?>
 
