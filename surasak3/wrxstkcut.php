<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

 include("connect.inc");



	$query = "SELECT * FROM dphardep WHERE row_id = '$sRow_id' "; 
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
    $cHn=$row->hn;
    $cAn=$row->an;
    $cPtname=$row->ptname;
    $cDoctor=$row->doctor;
    $item=$row->item;
    $Essd=$row->essd;
    $Nessdy=$row->nessdy;
    $Nessdn=$row->nessdn;
    $DPY=$row->dpy;
    $DPN=$row->dpn;   
	$cAccno=$row->accno;   
    $DSY=$row->dsy;
    $DSN=$row->dsn;
    $Netprice=$row->price;
    $cDiag=$row->diag;
    $cBedcode=$row->whokey;
    $cPtright=$row->ptright;
/////////////	
	$netpay =0;
	$netfree=0;
	$total=0;

	$netfree=$Essd+$Nessdy+$DPY+$DSY;
	$netpay=$Nessdn+ $DSN+$DPN;
	$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

	///////
/*�鷴�ͺ  ���ź��� begin
$netfree=$Essd+$Nessdy+$DPY+$DSY;
$netpay=$Nessdn+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;
print"<br>�ԡ�� $netfree = $Essd+$Nessdy+$DPY+$DSY<br>";
print"�ԡ����� $netpay = $Nessdn+ $DSN+$DPN<br>";
print"��� Netprice $Netprice (total) = $Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN<br> ";
*/
   //////////////
	$Thdhn=date("d-m-").(date("Y")+543).$cHn;
   ///////////
        $aDgcode=array();
        $aTrade=array();
		$aSalepri=array();
		$aFreepri=array();
        $aAmount=array();
        $aMoney= array();
        $aSlipcode= array();
        $aPart=array();
		$aDPY=array();
		$aDPN=array();
    $query = "SELECT drugcode,tradname,amount,salepri,freepri,price,slcode,part FROM ddrugrx WHERE idno = '$sRow_id' ANd date = '".$_GET["sDate"]."' ";

    $result = mysql_query($query)
        or die("Query failed");
    $x=0;
    while (list ($drugcode,$tradname,$amount,$salepri,$freepri,$price,$slcode,$part) = mysql_fetch_row ($result)) {
        $x++;
        $aDgcode[$x]=$drugcode;
        $aTrade[$x]=$tradname;
		$aSalepri[$x]=$salepri;
		$aFreepri[$x]=$freepri;
        $aAmount[$x]=$amount;
        $aMoney[$x]=$price;  
        $aSlipcode[$x]=$slcode;        
        $aPart[$x]=$part;
		$aDPY[$x]=$freepri*$amount;
		$aDPN[$x]=$price-($freepri*$amount);
	//	echo $aDPY[$x]," , ",$aDPN[$x],"<BR>";
	     };

/*in case of  OPD
$netfree=$Essd+$Nessdy+$DPY;
$netpay=$Nessdn+$DSY+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;
*/

//insert into phardep///
//'$nRunno','$Thidate','$cPtname','$cHn',
// '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
// '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','DR');";
//insert into drugrx///
//'$aDgcode[$n]','$aTrade[$n]',
//'$aAmount[$n]','$aMoney[$n]','$aSlipcode[$n]','$aPart[$n]','$idno');";

//insert data into phardep
	$item=$x;
       $query = "INSERT INTO phardep(chktranx,date,ptname,hn,an,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,accno)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn',
                    '$Netprice','$cDoctor','$item','$sOfficer','$cDiag','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$DSY','$DSN','$cBedcode','$cPtright','$cAccno');";

       $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������Ѵ stock 仡�͹���� ���͡�õѴ stock �������<br>
	*�ô��Ǩ�ͺ�������¡����㹺ѭ�ռ�������������<br>
	*������ʴ���� ��Ѵ stock 仡�͹����<br>
	*���������ʴ����  ��õѴ stock �������<br><br>");
//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//update dphardep table, ��Ѵʵ�͡����
        $query ="UPDATE dphardep SET dgtake = '$Thidate'
                       WHERE row_id= '$sRow_id' ";
        $result = mysql_query($query)
                       or die("Query failed,update dphardep,stock cut");



//update data in druglst 
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query ="UPDATE druglst SET stock = stock-$aAmount[$n],
              			  rxaccum = rxaccum + $aAmount[$n],
             			  rx1day   = rx1day +$aAmount[$n],
        			  totalstk = stock + mainstk
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst in case of  IPD");
			}
        };

//insert data into drugrx
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){

	   	 $sql = "Select stock From druglst where drugcode = '".$aDgcode[$n]."' limit 0,1 ";
		 $result = Mysql_Query($sql);
		 $arr = Mysql_fetch_assoc($result);
		 $stock = $arr["stock"];

        $query = "INSERT INTO drugrx(date,hn,an,drugcode,tradname,
             amount,price,item,slcode,part,idno,stock,dpy,dpn)VALUES('$Thidate','$cHn','$cAn','$aDgcode[$n]','$aTrade[$n]',
             '$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno','$stock','$aDPY[$n]','$aDPN[$n]');";
        $result = mysql_query($query) or die("Query failed,insert into drugrx");
			}
        };

////begin to put data into ipacc
	$cDepart="PHAR";
     for ($n=1; $n<=$x; $n++){
            If (substr($aPart[$n],0,2) != "DP"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno,ptright)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n],$aSlipcode[$n]',
                                   '$aAmount[$n]','$aMoney[$n]','$aPart[$n]','$sOfficer','$cAccno','$idno','$cPtright');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
        }
       //////////
            If ($aPart[$n]=="DPY"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno,ptright)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n],$aSlipcode[$n]',
                                   '$aAmount[$n]','$aDPY[$n]','$aPart[$n]','$sOfficer','$cAccno','$idno','$cPtright');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
	///////////////////
                   If ($aDPN[$n] > 0){
                                $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno,ptright                                )VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n],$aSlipcode[$n]',
                                   '','$aDPN[$n]','DPN','$sOfficer','$cAccno','$idno','$cPtright');";
                                 $result = mysql_query($query) or die("insert into ipacc failed");
		        }

		}
            If ($aPart[$n]=="DPN"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno,ptright)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n],$aSlipcode[$n]',
                                   '$aAmount[$n]','$aDPN[$n]','$aPart[$n]','$sOfficer','$cAccno','$idno','$cPtright');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
        }
       }
  print "<font face='Angsana New'>&nbsp;&nbsp;&nbsp;<B>㺨����Ҽ������</B><BR>";
  print "�ѹ��� $Thaidate $cWardname ��§$cBed ᾷ��$cDoctor<BR>";
//print "$Thaidate<font face='Angsana New' size='2'>&nbsp; VN:$tvn<br>";
  print "<font face='Angsana New'>$cPtname  HN:$cHn AN:$cAn �Է��:$cPtright<br>";

print "<table>";
 print "<tr>";
  print " <th>#</th>";
  print "<th>����</th>";
  print "<th>��¡��</th>";
  print "<th>�ӹǹ</th>";
  print "<th>�Ҥ����</th>";
  print "<th>�Ը���</th>";
  print "<th>PART</th>";
 print "</tr>";

$num=0;
for ($n=1; $n<=$x; $n++){
	   If (!empty($aDgcode[$n])){
            $num++;
			print (" <tr>\n".
               "  <td>$num</td>\n".
               "  <td><font face='Angsana New'>$aDgcode[$n]</td>\n".
               "  <td><font face='Angsana New'>$aTrade[$n]</td>\n".
               "  <td><font face='Angsana New'> $aAmount[$n] </td>\n".
               "  <td><font face='Angsana New'>$aMoney[$n]</td>\n".
               "  <td><font face='Angsana New'>$aSlipcode[$n]</td>\n".
               "  <td><font face='Angsana New'>$aPart[$n]</td>\n".
               " </tr>\n");
               }
				}
   print"</table>";
   print " �Ҥ����  $Netprice �ҷ(�ԡ����� $netpay �ҷ , �ԡ�� $netfree �ҷ)<br> ";
   print "��������.....................................����Ѻ��................................";        
   /*�鷴�ͺ�����١��ͧ�ͧ�Ҥ�
   print "<br> Essd =   $aEssd  ����Թ�����㹺ѭ������ѡ��觪ҵ� <br>";
    print "Nessdy= $aNessdy ����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�� <br>";
    print "Nessdn=$aNessdn ����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����  <br>";
    print "DSY     =$aDSY ����Թ����Ǫ�ѳ�� ��ǹ����ԡ� �<br>";
    print "DSN     = $aDSN ����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  <br>";
    print "DPY     =$aDPY ����Թ����ػ�ó� ��ǹ����ԡ��<br>";
    print "DPN     = $aDPN ����Թ����ػ�ó� ��ǹ����ԡ�����  <br>";

	print"�ԡ�� $netfree = $Essd+$Nessdy+$DPY+$DSY<br>";
	print"ມ����� $netpay = $Nessdn+ $DSN+$DPN<br>";
	print"��� $total = $Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN ";
*/
 include("unconnect.inc");
 session_unregister("nRunno");
?>
 
