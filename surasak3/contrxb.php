<?php
    session_start();
    session_unregister("nRunno");
    $nRunno="";
    session_register("nRunno");
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$nDay=$day;
	//runno  for chktranx
	 include("connect.inc");
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'dphardep'";
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
    $nRunno=$row->runno;
    $nRunno++;
    $query ="UPDATE runno SET runno = $nRunno WHERE title='dphardep'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx

    print  "<font face='Angsana New'>�ԡ�Ҽ�����㹨ӹǹ $nDay �ѹ,  �ѹ��� $Thaidate<br> ";
    print "<font face='AngsanaUPC' size='2'><b> $cWard,��§ $cBed, ���� $cPtname, ���� $cAge, AN:$cAn</b></font><br>";
	print" �Է�� $cPtright , ᾷ��  $cDoctor";
print"<table>";
 print"<tr>";
  print"<th><th bgcolor=20B2AA><font face='Angsana New'>#</th>";
 print"  <th><th bgcolor=20B2AA><font face='Angsana New'>����</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>��¡��</th>";
   print"<th><th bgcolor=20B2AA><font face='Angsana New'>˹��¹Ѻ</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>�Ը���</th>";
  print" <th><th bgcolor=20B2AA><font face='Angsana New'>�ӹǹ</th>";
   print"<th><th bgcolor=20B2AA><font face='Angsana New'>�Ҥ�</th>";
 print"</tr>";
    $n=0;
//    include("connect.inc");
        //an,part,idno,totalamt,totalpri,statcon,onoff,officer
        $query = "SELECT   drugcode,tradname,unit,slcode,salepri,amount,price,row_id,part,freepri 
                         FROM dgprofile  WHERE an = '$cAn' and statcon='CONT' and onoff='ON' ORDER BY date ";  
        $result = mysql_query($query) or die("Query failed");

        while (list ($drugcode,$tradname,$unit,$slcode,$salepri,$amount,$price,$row_id,$part,$freepri  
	) = mysql_fetch_row ($result)) {
    $n++;
    $x++;
    $aDgcode[$n] = $drugcode;
    $aTrade[$n]  = $tradname;
    $aSalepri[$n]  = $salepri;
    $aFreepri[$n]  = $freepri;
    $aPrice[$n]  = $price;
    $aPart[$n] = $part;
	$aUnit[$n] = $unit;
    $aAmount[$n] = $amount*$nDay;
    $aSlipcode[$n] = $slcode;
    $aMoney[$n]= $aAmount[$n]*$salepri;
    $Netprice=array_sum($aMoney);
            print (" <tr>\n".
               "  <td><th bgcolor=ADD8E6>$n</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aDgcode[$n]</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aTrade[$n]</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aUnit[$n]</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aSlipcode[$n]</td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'><a target='_self'  href=\"amtedit.php? Delrow=$n\"> $aAmount[$n] </td>\n".
               "  <td><th bgcolor=ADD8E6><font face='Angsana New'>$aMoney[$n]</td>\n".
               "  <td><font face='Angsana New'><a target='_self'  href=\"dprofidel.php? Delrow=$n\">ź���</td>\n".
               " </tr>\n");
               }
   include("unconnect.inc");
   print"</table>";
   $Netprice=number_format($Netprice,2);
   print " �Ҥ����  $Netprice �ҷ <br>";
   print"(��ԡ����Ţ��ͧ�ӹǹ�������)";

   ///////���͡ �Ѻ����  ��˹���  �ԡ��Ш��ѹ
   print "<form method='POST' action='rxdptranx.php' target ='_BLANK'>";
   print "<font face='Angsana New' size='3'>�ô���͡";
   print"&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='status' VALUE='�Ѻ����'>�Ѻ����";
   print"&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='status' VALUE='�ԡ�һ�Ш��ѹ'>�ԡ�һ�Ш��ѹ";
   print"&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='status' VALUE='��˹���'>��˹���<br>";
   print "<p><input type='submit' value='�������ԡ��'";
   print "</form>";
   ////////
?>
   <br><a target=_BLANK href="slipprn.php">�������ҡ��</a>
   &nbsp;&nbsp;&nbsp;<a target=_BLANK href="notrxop.php">(¡��ԡ)</a>


 