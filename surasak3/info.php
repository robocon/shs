<?php
session_start();
?>
<table>
 <tr> 
  <th bgcolor=CD853F><font face='Angsana New'>ź</th>
  <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>����</th>
  <th bgcolor=CD853F><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ը���</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New'>����Թ</th>
  <th bgcolor=CD853F><font face='Angsana New'>������</th>
 </tr>

<?php
    include("connect.inc");

    if (substr($Dgcode,0,1)=='@'){
       $aCode = array("drugcode");
       $aAmt = array("amount");
       $num=0;
       $query = "SELECT drugcode,amount,slipcode FROM labsuit WHERE suitcode = '$Dgcode' ";
       $result = mysql_query($query) or die("Query failed");

       while (list ($drugcode,$amount,$slipcode) = mysql_fetch_row ($result)) {
             $num++;
 //            array_push($aCode,$drugcode); 
             $aCode[$num]=$drugcode;
             $aAmt[$num]=$amount;
             $aSlcode[$num]=$slipcode;
                    }
///////
            for ($n=1; $n<=$num; $n++){
 	   $query = "SELECT * FROM druglst WHERE drugcode = '$aCode[$n]' ";
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

	    $x++;

	    $aDgcode[$x]=$row->drugcode;
	    $aTrade[$x]=$row->tradname;
	    $aSlipcode[$x]=$aSlcode[$num];      
	    $aPrice[$x]=$row->salepri;
	    $aPart[$x]=$row->part;
	    $aAmount[$x]=$aAmt[$n];
		$aMedical_sup_free[$x]=$row->medical_sup_free;
	    $money = $aAmt[$n]*$row->salepri ;
	    $aMoney[$x]=$money;
 	   $Netprice=array_sum($aMoney);

	//  ����Թ������ػ�ó� ��ǹ����ԡ����������

		if($row->freepri > $row->salepri)
			$row->freepri = $row->salepri;


		$notfree=$row->salepri - $row->freepri;
	    $Free=$aAmt[$n]*$row->freepri;   //����Թ����ػ�ó� ��ǹ����ԡ��
	    $Pay =$aAmt[$n]*$notfree;   //����Թ����ػ�ó� ��ǹ����ԡ�����, ��ͧ����

	//  ����Թ����Ǫ�ѳ����������� ��ǹ����ԡ����������
	    $Snotfree=$row->salepri - $row->freepri;
	    $SFree=$aAmt[$n]*$row->freepri;   //����Թ����ػ�ó� ��ǹ����ԡ��
	    $SPay =$aAmt[$n]*$Snotfree;   //����Թ����ػ�ó� ��ǹ����ԡ�����, ��ͧ����

	if (substr($row->part,0,3)=="DDL"){
	            $aEssd[$x]=$money;
	            }
	else {
	            $aEssd[$x]=0;
	        }
	//
	if (substr($row->part,0,3)=="DDY"){
	            $aNessdy[$x]=$money;
	            }
	else {
	            $aNessdy[$x]=0;
	         }
	//
	if (substr($row->part,0,3)=="DDN"){
	            $aNessdn[$x]=$money;
	            }
	else {
	             $aNessdn[$x]=0;
	         }
	//�ػ�ó�
	if (substr($row->part,0,3)=="DPY"){
	            $aDPY[$x]=$Free;  //�ػ�ó� ��ǹ����ԡ�� $row->free
	            $aDPN[$x]=$Pay;  // �ػ�ó� ��ǹ����ԡ����� $row->salepri - $row->free
	            }
	else {
	            $aDPY[$x]=0;
	            $aDPN[$x]=0;
	        }
	if (substr($row->part,0,3)=="DPN"){
	            $aDPN[$x]=$money;  //�ػ�ó��ԡ�����
	            } 

	//�Ǫ�ѳ���������
	if (substr($row->part,0,3)=="DSY" && $row->medical_sup_free ==1){
	            $aDSY[$x]=$SFree;  //�Ǫ�ѳ��������� ��ǹ����ԡ�� $row->free
	            $aDSN[$x]=$SPay;  // �Ǫ�ѳ��������� ��ǹ����ԡ����� $row->salepri - $row->free
	            }
	else if (substr($row->part,0,3)=="DSY"  && $row->medical_sup_free ==0){
	            $aDSY[$x]=0;  //�Ǫ�ѳ��������� ��ǹ����ԡ�� $row->free
	            $aDSN[$x]=$money;  // �Ǫ�ѳ��������� ��ǹ����ԡ����� $row->salepri - $row->free
	            }
	else {
	            $aDSY[$x]=0; 
	            $aDSN[$x]=0;
	        }
	if (substr($row->part,0,3)=="DSN"){
	            $aDSN[$x]=$money;  //�Ǫ�ѳ��������� �ԡ�����
	            }   
		}
	////////
	   for ($n=1; $n<=$x; $n++){
	        print("<tr>\n".
	                "<td bgcolor=F5DEB3><a target='right'  href=\"opdgdele.php? Delrow=$n\"><font face='Angsana New'>ź</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aSlipcode[$n]</td>\n".    
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".  
	                "<td bgcolor=F5DEB3><font face='Angsana New'>$aMoney[$n]</td>\n".  
	                " </tr>\n");
					        }
			} 
    else {

    $query = "SELECT * FROM druglst WHERE drugcode = '$Dgcode' ";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $x++;

    $aDgcode[$x]=$row->drugcode;
    $aTrade[$x]=$row->tradname;
    $aSlipcode[$x]=$Slcode;        
    $aPrice[$x]=$row->salepri;
    $aPart[$x]=$row->part;
    $aAmount[$x]=$Amount;
	$aMedical_sup_free[$x]=$row->medical_sup_free;
    $money = $Amount*$row->salepri ;
    $aMoney[$x]=$money;
    $Netprice=array_sum($aMoney);

if($row->freepri > $row->salepri)
			$row->freepri = $row->salepri;

//  ����Թ������ػ�ó� ��ǹ����ԡ����������
    $notfree=$row->salepri - $row->freepri;
//echo "notfree: $notfree<br>";
    $Free=$Amount*$row->freepri;   //����Թ����ػ�ó� ��ǹ����ԡ��
    $Pay =$Amount*$notfree;   //����Թ����ػ�ó� ��ǹ����ԡ�����, ��ͧ����
//echo "Pay: $Pay<br>";
//  ����Թ����Ǫ�ѳ����������� ��ǹ����ԡ����������
    $Snotfree=$row->salepri - $row->freepri;
    $SFree=$Amount*$row->freepri;   //����Թ����ػ�ó� ��ǹ����ԡ��
    $SPay =$Amount*$Snotfree;   //����Թ����ػ�ó� ��ǹ����ԡ�����, ��ͧ����

if (substr($row->part,0,3)=="DDL"){
            $aEssd[$x]=$money;
            }
else {
            $aEssd[$x]=0;
        }
//
if (substr($row->part,0,3)=="DDY"){
            $aNessdy[$x]=$money;
            }
else {
            $aNessdy[$x]=0;
         }
//
if (substr($row->part,0,3)=="DDN"){
            $aNessdn[$x]=$money;
            }
else {
             $aNessdn[$x]=0;
         }
//�ػ�ó�
if (substr($row->part,0,3)=="DPY"){
            $aDPY[$x]=$Free;  //�ػ�ó� ��ǹ����ԡ�� $row->free
            $aDPN[$x]=$Pay;  // �ػ�ó� ��ǹ����ԡ����� $row->salepri - $row->free
//echo "aDPY:$aDPY[$x]<br>";
//echo "aDPN:$aDPN[$x]<br>";
            }
else {
            $aDPY[$x]=0;
            $aDPN[$x]=0;   
        }
if (substr($row->part,0,3)=="DPN"){
            $aDPN[$x]=$money;  //�ػ�ó��ԡ�����
            } 

//echo "aDPY:$aDPY[$x]<br>";
//echo "aDPN:$aDPN[$x]<br>";
//�Ǫ�ѳ���������
if (substr($row->part,0,3)=="DSY" && $row->medical_sup_free == 1){
            $aDSY[$x]=$SFree;  //�Ǫ�ѳ��������� ��ǹ����ԡ�� $row->free
            $aDSN[$x]=$SPay;  // �Ǫ�ѳ��������� ��ǹ����ԡ����� $row->salepri - $row->free
            }
else if (substr($row->part,0,3)=="DSY" && $row->medical_sup_free == 0){ //�Ǫ�ѳ��������� ��ǹ����������ö�ԡ��
            $aDSY[$x]=0;  
            $aDSN[$x]=$money;  
            }
else {
            $aDSY[$x]=0; 
            $aDSN[$x]=0;
        }
if (substr($row->part,0,3)=="DSN"){
            $aDSN[$x]=$money;  //�Ǫ�ѳ��������� �ԡ�����
            }   

/////////
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"opdgdele.php? Delrow=$n\"><font face='Angsana New'>ź</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aSlipcode[$n]</td>\n".    
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aMoney[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPart[$n]</td>\n".  
                " </tr>\n");
        }
    }
 include("unconnect.inc");
?>
</table>
<?php
     echo " �Ҥ����  $Netprice �ҷ     ";
     $sDcode="";
     $sSlip="";
?>
    <br><br><a target=_BLANK href="slipprn.php">�������ҡ��</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="rxoptranx.php">�Ѵʵ�͡/���˹��</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxop.php">(¡��ԡ)</a>
 <br><br>
  <a target=_BLANK href="rxoptranx2.php">�Ѵʵ�͡/���˹���ҡ�������</a>
&nbsp;&nbsp;&nbsp;<a target=_BLANK href="slipprntest2.php">�������ҡ���������</a>

<br><BR>
  <a target=_BLANK href="slipprnopd.php">�ԴOPDCARD��ҧ����</a>
