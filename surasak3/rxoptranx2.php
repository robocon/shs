<body Onload="window.print();">
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

$netfree=$Essd+$Nessdy+$DPY+$DSY;
$netpay=$Nessdn+ $DSN+$DPN;
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
       $query = "INSERT INTO phardep(chktranx,date,ptname,hn,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,phapt,datedr )VALUES('$nRunno','$Thidate','$cPtname','$cHn',
                    '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','$sOfficer','$Thidate');";

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

//insert data into drugrx
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){

	   	 $sql = "Select stock From druglst where drugcode = '".$aDgcode[$n]."' limit 0,1 ";
		 $result = Mysql_Query($sql);
		 $arr = Mysql_fetch_assoc($result);
		 $stock = $arr["stock"];

        $query = "INSERT INTO drugrx(date,hn,drugcode,tradname,
             amount,price,item,slcode,part,idno,stock)VALUES('$Thidate','$cHn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno','$stock');";
        $result = mysql_query($query) or die("Query failed,insert into drugrx");
			}
        };

//update data in opday 

        $query ="UPDATE opday SET diag = '$cDiag',
              			         doctor='$cDoctor',
			         phar= phar+$Netprice
                       WHERE thdatehn= '$Thdhn' AND vn = '$tvn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");


//������

  print "<font face='Angsana New' size='1'><center><B>��ʴ���¡����</B><BR></font>";
     
 print "<font face='Angsana New' size='1'>$Thaidate&nbsp; VN:$tvn<br></font>";
      print "<font face='Angsana New' size='2'>$cPtname  HN:$cHn<br></font>";
      print "<font face='Angsana New' size='2'><B>�Է��:$cPtright</B><br></font></font>";
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
     // print "����Թ  $total  �ҷ(�ԡ����� $netpay �ҷ , �ԡ�� $netfree �ҷ)<br></font>";
     // print "ᾷ�� $cDoctor<br>";
	    print "<font face='Angsana New' size='3'><B>�ԡ�� $netfree �ҷ&nbsp;";
		
  print "�ԡ����� $netpay �ҷ <br></B></font>";
	
    print "<font face='Angsana New' size='3'><B>***����Թ &nbsp; $total  �ҷ***</B><BR></font>";
	
   // print "<font face='Angsana New' size='1'>���˹�ҷ�� :$sOfficer<BR></font>";
		
  //  print "<B>*��仪����Թ�����ͧ���Թ</B>";
    
print "<br>";
//



// print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;<B>��駡�ê����Թ</B><BR></font>";
print "<div style=\"page-break-before: always;\"></div>";
    
  print "<font face='Angsana New' size='1'>$Thaidate <br></font>";
      print "<font face='Angsana New' size='1'><b>$cPtname </b> &nbsp;HN:$cHn<br></font>";
      print "<font face='Angsana New' size='1'><b>�Է��:$cPtright</b><br></font>";

 //    print "<font face='Angsana New' size='1'>$cPtname  HN:$cHn &nbsp;VN:$tvn<br></font>";
    print "<font face='Angsana New' size='1'>�ѭ������ѡ �ԡ��&nbsp;$Essd <br></font>";
    print "<font face='Angsana New' size='1'>�͡�ѭ������ѡ�ԡ�� &nbsp;$Nessdy &nbsp;&nbsp;�ԡ�����&nbsp; $Nessdn <br></font>";
    print "<font face='Angsana New' size='1'>����Ǫ�ѳ���ԡ�� &nbsp;$DSY &nbsp;&nbsp;�ԡ�����&nbsp;$DSN <br></font>";
    print "<font face='Angsana New' size='1'>����ػ�ó��ԡ��  &nbsp;$DPY &nbsp;&nbsp;�ԡ�����&nbsp;$DPN <br></font>";
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
     // print "����Թ  $total  �ҷ(�ԡ����� $netpay �ҷ , �ԡ�� $netfree �ҷ)<br></font>";
     // print "ᾷ�� $cDoctor<br>";
  print "<font face='Angsana New' size='2'><B>�ԡ�� $netfree �ҷ&nbsp;";
		
  print "�ԡ����� $netpay �ҷ </B><br></center></font>";
		
//    print "<font face='Angsana New' size='3'><B>***����Թ &nbsp; $total  �ҷ***</B><BR></font>";
		
//print "<font face='Angsana New' size='1'>���˹�ҷ�� :$sOfficer<BR></font>";
			
  //  print "<B>*��仪����Թ�����ͧ���Թ</B>";
   







 include("unconnect.inc");
?>


<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $aDetail1 = array("detail1");
    $aDetail2 = array("detail2");
    $aDetail3 = array("detail3");
    $aDetail4 = array("detail4");

    include("connect.inc");
//////// add drugnote from druglst
    $aDrugnote = array("drugnote");
    for ($n=1; $n<=$x; $n++){
             $query = "SELECT drugnote FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
             $result = mysql_query($query) or die("Query failed drugnote,druglst ");

             for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
                  if (!mysql_data_seek($result, $i)) {
                            echo "Cannot seek to row $i\n";
                            continue;
                                                                        }
                 if(!($row = mysql_fetch_object($result)))
                        continue;
		              }
             array_push($aDrugnote,$row->drugnote); 
                                          }
////// end  add drugnote from druglst
    for ($n=1; $n<=$x; $n++){
             $query = "SELECT slcode,detail1,detail2,detail3,detail4 FROM drugslip WHERE slcode = '$aSlipcode[$n]' ";
             $result = mysql_query($query) or die("Query failed");
//             echo mysql_errno() . ": " . mysql_error(). "\n";
//             echo "<br>";
             for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
                  if (!mysql_data_seek($result, $i)) {
                            echo "Cannot seek to row $i\n";
                            continue;
                                                                        }
                 if(!($row = mysql_fetch_object($result)))
                        continue;
		              }
             array_push($aDetail1,$row->detail1); 
             array_push($aDetail2,$row->detail2); 
             array_push($aDetail3,$row->detail3); 
             array_push($aDetail4,$row->detail4); 
                                          }

// print slip   
//�Ѵ��ҩִ�ҷ��
    $injcount=0;
    for ($n=1; $n<=$x; $n++){
	if ($aDgcode[$n]=='INJ'){
		$injcount++;
		}
	};
    $injcount=$x - $injcount;
//$aDrugnote[$n]=substr($aDrugnote[$n],0,27);

    for ($n=1; $n<=$x; $n++){
         If (!empty($aSlipcode[$n])){
//$aDgcode[$n]=substr($aDgcode[$n],0,2);
//$aDgcode0[$n]=substr($aDgcode[$n],0,1);
//$aDgcode1[$n]=substr($aDgcode[$n],1,1);
//$aDgcode2[$n]=substr($aDgcode[$n],2,1);
//$aDgcode3[$n]=substr($aDgcode[$n],3,1);
//$aDgcode4[$n]=substr($aDgcode[$n],4,1);
//$aDgcode5[$n]=substr($aDgcode[$n],5,1);
//$aDgcode6[$n]=substr($aDgcode[$n],6,1);
//$cPtname=substr($cPtname,0,24);
          //  print "<font face='Cordia UPC' size='1'> &nbsp;<br></font>";

		  print "<div style=\"page-break-before: always;\"></div>";
              print "<font face='Cordia UPC' size='1'><center>$cPtname<br></font>";
             print "<font face='Angsana New' size='1'>$Thaidate&nbsp;(vn$tvn)&nbsp;HN:$cHn.&nbsp;&nbsp;NO.$n/$injcount <br></font>";
     //print "<font face='DilleniaUPC' size='1'>$Thaidate&nbsp;(vn$tvn)&nbsp;HN:$cHn.&nbsp;&nbsp;NO.$n/$injcount <br></font>";
     
//         print "<font face='Cordia UPC' size='1'>$aTrade[$n],$aDgcode[$n],$aAmount[$n]<br></font>";
         //  $aTrade[$n]=substr($aTrade[$n],0,18);
           print "<font face='Angsana New' size='2'><b>$aTrade[$n]</b></font>";
        
      print "<font face='Angsana New' size='1'>&nbsp;&nbsp;($aDgcode[$n])</font>&nbsp;<font face='Angsana New' size='1'>=</font><font face='Angsana New' size='3'><B>&nbsp;&nbsp;$aAmount[$n]</B><br></font>";
   
//print "<font face='Microsoft sans serif' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></font>";
      
  print "<font face='DilleniaUPC' size='3'><b>$aDetail1[$n]</b><br></font>";
           print "<font face='DilleniaUPC' size='3'><b>$aDetail2[$n]</b><br></font>";

           if ($n==$x){
                      print "<font face='DilleniaUPC' size='4'><b>$aDetail3[$n]</b><br></font>";
				if($aDrugnote[$n] != "")
				 print "<font face='Angsana New' size='2'><u><b>$aDrugnote[$n]</u></b></font>";

		   
                           }
           else {   
                      print "<font face='DilleniaUPC' size='4'><b>$aDetail3[$n]</b><br></font>";
					  if($aDrugnote[$n] != "")
                   print "<font face='Angsana New' size='2'><u><b>$aDrugnote[$n]</u></b><br></font></center>";
	         	   }
	//   print "<font face='Angsana New' size='1'>$aDetail4[$n]<br></font>";
         	}
	}
	

 include("unconnect.inc");
?>
