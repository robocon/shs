<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    //opitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
    session_unregister("sPtright");
    session_unregister("sDoctor");
    session_unregister("sDepart");
    session_unregister("sDetail");
    session_unregister("sNetprice");
    session_unregister("sDiag");
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("sAccno");  
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");  

    session_unregister("sSumYprice");
    session_unregister("sSumNprice");

//////  
    $dDate=$sDate;
    $sHn="";
    $sAn="";
    $sPtname="";
    $sPtright="";
    $sDoctor="";
/*
    $sEssd="";
    $sNessdy="";
    $sNessdn="";
    $sNetprice="";
    $sDPY="";
    $sDPN="";     
*/
    $sDepart="";
    $sDetail="";
    $sDiag="";
    $sRow_id=$nRow_id;
    $sAccno=$nAccno;
  
    $x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aPrice  = array("                          �ҤҢ��  ");

    $sSumYprice = "";
    $sSumNprice = "";
    session_register("sSumYprice");
    session_register("sSumNprice");

    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
//    $aSlipcode = array("        �Ը���   ");
    $aMoney= array("       ����Թ   ");
    $sRow=array("row_id of ipacc");

    session_register("dDate");  
    session_register("sHn");   
    session_register("sAn");
    session_register("sPtname");
    session_register("sPtright");
    session_register("sDoctor");
/*
    session_register("sEssd");
    session_register("sNessdy");
    session_register("sNessdn");
    session_register("sDPY");
    session_register("sDPN");
*/
    session_register("sDepart");
    session_register("sDetail");
    session_register("sNetprice");
    session_register("sDiag");
    session_register("sRow_id"); 
    session_register("sRow"); 
    session_register("sAccno");  

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
//    session_register("aSlipcode");
    session_register("aMoney");
   
    include("connect.inc");
  
 $query = "SELECT * FROM depart WHERE row_id = '$nRow_id' ";
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
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sPtright=$row->ptright;
    $sDoctor=$row->doctor;
    $sDepart=$row->depart;
    $sDetail=$row->detail;  
    $sNetprice=$row->price;

    $sSumYprice=$row->sumyprice;
    $sSumNprice=$row->sumnprice;

    $sDiag=$row->diag;

    $cPaid=$sNetprice;
?>

<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>��¡��</th>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>�Ҥ�</th>
  <th bgcolor=9999CC><font face='Angsana New' size='3'>�ԡ��</th>
  <th bgcolor=9999CC><font face='Angsana New' size='3'>�ԡ�����</th>
 </tr>

<?php
    $query = "SELECT detail,amount,price,yprice,nprice FROM patdata WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");
  print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����¡�ü�����<br>";
    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;$sPtname, HN: $sHn ";
	print "<font face='Angsana New' size='3'>&nbsp;�Է�� :$sPtright<br> ";
    print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;�ä: $sDiag, ᾷ�� :$sDoctor<br>";
//    print "ᾷ�� :$sDoctor<br><br>";

    while (list ($detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result)) {
        print (" <tr>\n".

           "  <td BGCOLOR=F5DEB3><font face='Angsana New' size='3'>$detail</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New' size='3'>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New' size='3'>$price</td>\n".
           "  <td BGCOLOR=99CCCC><font face='Angsana New' size='3'>$yprice</td>\n".
           "  <td BGCOLOR=99CCCC><font face='Angsana New' size='3'>$nprice</td>\n".
		   " </tr>\n");
      }
    include("unconnect.inc");
?>
</table>

<?php
    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;����Թ  $sNetprice �ҷ";

    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;<b>(�ԡ����� $sSumNprice �ҷ</b>, �ԡ��$sSumYprice �ҷ)<br>";

// print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;���˹�ҷ����ѹ�֡...........................................<br>";
?>


