<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdhn=date("d-m-").(date("Y")+543).$cHn;

for ($n=1; $n<=$x; $n++){
    //  ����Թ������ػ�ó� ��ǹ����ԡ����������/unit

	if($aFreepri[$n] > $aSalepri[$n])
		$aFreepri[$n] = $aSalepri[$n];

    $notfree=$aSalepri[$n] - $aFreepri[$n];
    //echo "notfree: $notfree<br>";
    $Free=$aAmount[$n]*$aFreepri[$n];   //����Թ����ػ�ó� ��ǹ����ԡ��
    $Pay =$aAmount[$n]*$notfree;   //����Թ����ػ�ó� ��ǹ����ԡ�����, ��ͧ����

    //echo "Pay: $Pay<br>";
    //  ����Թ����Ǫ�ѳ����������� ��ǹ����ԡ����������
    $Snotfree=$aSalepri[$n] - $aFreepri[$n];
    $SFree=$aAmount[$n]*$aFreepri[$n];   //����Թ����ػ�ó� ��ǹ����ԡ��
    $SPay =$aAmount[$n]*$Snotfree;   //����Թ����ػ�ó� ��ǹ����ԡ�����, ��ͧ����

    if (substr($aPart[$n],0,3)=="DDL"){
            $aEssd[$n]=$aMoney[$n];
            }
    else {
            $aEssd[$n]=0;
        }
     //
     if (substr($aPart[$n],0,3)=="DDY"){
            $aNessdy[$n]=$aMoney[$n];
            }
     else {
            $aNessdy[$n]=0;
            }
     //
     if (substr($aPart[$n],0,3)=="DDN"){
            $aNessdn[$n]=$aMoney[$n];
            }
     else {
             $aNessdn[$n]=0;
         }
     //�ػ�ó�
     if (substr($aPart[$n],0,3)=="DPY"){
            $aDPY[$n]=$Free;  //�ػ�ó� ��ǹ����ԡ�� $row->free
            $aDPN[$n]=$Pay;  // �ػ�ó� ��ǹ����ԡ����� $row->salepri - $row->free
      //echo "aDPY:$aDPY[$n]<br>";
      //echo "aDPN:$aDPN[$n]<br>";
            }
      else {
            $aDPY[$n]=0;
            $aDPN[$n]=0;   
            }
     if (substr($aPart[$n],0,3)=="DPN"){
            $aDPN[$n]=$aMoney[$n]; //�ػ�ó��ԡ�����
            } 

      //echo "aDPY:$aDPY[$n]<br>";
      //echo "aDPN:$aDPN[$n]<br>";
     //�Ǫ�ѳ���������
     if (substr($aPart[$n],0,3)=="DSY"){
            $aDSY[$n]=$SFree;  //�Ǫ�ѳ��������� ��ǹ����ԡ�� $row->free
            $aDSN[$n]=$SPay;  // �Ǫ�ѳ��������� ��ǹ����ԡ����� $row->salepri - $row->free
            }
     else {
            $aDSY[$n]=0; 
            $aDSN[$n]=0;
            }
     if (substr($aPart[$n],0,3)=="DSN"){
            $aDSN[$n]=$aMoney[$n]; //�Ǫ�ѳ��������� �ԡ�����
            }   
			};
	///////////////////////////////////////
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

$Netprice=array_sum($aMoney);

//item count
$item=0;
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
             $item++;
	}
};

//insert data into dphardep
////////////////////////
//'$nRunno','$Thidate','$cPtname','$cHn',
// '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
// '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','DR');";

//'$aDgcode[$n]','$aTrade[$n]',
//'$aAmount[$n]','$aMoney[$n]','$aSlipcode[$n]','$aPart[$n]','$idno');";
///////////////////////////////////

 include("connect.inc");

       $query = "INSERT INTO dphardep(chktranx,date,ptname,hn,an,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,accno,dsy,dsn,tvn,ptright,whokey)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn',
                    '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$cAccno','$DSY','$DSN','$cAn','$cPtright','$cBedcode');";

       $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ�����鵡ŧ�ԡ��仡�͹���� ���͡���ԡ���������<br>
	*�ô��Ǩ�ͺ<br>
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
//print "<br>$idno <br>";//test 9/4/47 to find the last row

//insert data into ddrugrx
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query = "INSERT INTO ddrugrx(date,hn,an,drugcode,tradname,
             amount,salepri,freepri,price,item,slcode,part,idno)VALUES('$Thidate','$cHn','$cAn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aSalepri[$n]','$aFreepri[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno');";
        $result = mysql_query($query) or die("Query failed,insert into drugrx");
			}
        };

	   If (!empty($status)){
			print"$status<br>";
				   }
    print  "<font face='Angsana New'>�ԡ�Ҽ�����㹨ӹǹ $nDay �ѹ,  �ѹ��� $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,��§ $cBed, ���� $cPtname, ���� $cAge, HN:$cHn,AN:$cAn</b></font><br>";
	print" �Է�� $cPtright , ᾷ��  $cDoctor";
print"<table>";
 print"<tr>";
  print"<th><font face='Angsana New'>#</th>";
 print"  <th><font face='Angsana New'>�ѹ���</th>";
  print" <th><font face='Angsana New'>��¡��</th>";
   print"<th><font face='Angsana New'>˹��¹Ѻ</th>";
  print" <th><font face='Angsana New'>�Ը���</th>";
  print" <th><font face='Angsana New'>�ӹǹ</th>";
   print"<th><font face='Angsana New'>�Ҥ�</th>";
//  print"<th><font face='Angsana New'>PART</th>";
//  print"<th><font face='Angsana New'>�Ҥ��ԡ��</th>";
 print"</tr>";
$num=0;
for ($n=1; $n<=$x; $n++){
	   If (!empty($aDgcode[$n])){
            $num++;
			print (" <tr>\n".
               "  <td>$num</td>\n".
               "  <td><font face='Angsana New'>$aDgcode[$n]</td>\n".
               "  <td><font face='Angsana New'>$aTrade[$n]</td>\n".
               "  <td><font face='Angsana New'>$aUnit[$n]</td>\n".
               "  <td><font face='Angsana New'>$aSlipcode[$n]</td>\n".
               "  <td><font face='Angsana New'> $aAmount[$n] </td>\n".
               "  <td><font face='Angsana New'>$aMoney[$n]</td>\n".
//               "  <td><font face='Angsana New'>$aPart[$n]</td>\n".
//               "  <td><font face='Angsana New'>$aFreepri[$n]*$aAmount[$n]</td>\n".
               " </tr>\n");
               }
				}
   print"</table>";
   print " �Ҥ����  $Netprice(total= $total) �ҷ(�ԡ����� $netpay �ҷ , �ԡ�� $netfree �ҷ)<br> ";
   print "��������.....................................����Ѻ��................................"; 

//��¡������
   $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$cHn' ";
   $result = mysql_query($query)
        or die("Query drugreact failed!");

   if(mysql_num_rows($result)){
		print"<table>";
		print"<tr>
		  <td width='80%'><br>����ѵԡ������";
			while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                "  <td BGCOLOR=F5DEB3><font face='cordia New'  size=3>$tradname...$advreact($asses)</td>\n".
                " </tr>\n");
  						    }
		  print"	</td>";
		print"</tr>";
		print"</table>";
		print"(1=����͹,2=��Ҩ���,3=�Ҩ����,4=ʧ���)";
   }

 include("unconnect.inc");
 session_unregister("nRunno");
   ?>


 