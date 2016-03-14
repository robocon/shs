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
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("                          ราคาขาย  ");

    $sSumYprice = "";
    $sSumNprice = "";
    session_register("sSumYprice");
    session_register("sSumNprice");

    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
//    $aSlipcode = array("        วิธีใช้   ");
    $aMoney= array("       รวมเงิน   ");
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
  <th bgcolor=CD853F><font face='Angsana New' size='3'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>ราคา</th>
  <th bgcolor=9999CC><font face='Angsana New' size='3'>เบิกได้</th>
  <th bgcolor=9999CC><font face='Angsana New' size='3'>เบิกไม่ได้</th>
 </tr>

<?php
    $query = "SELECT detail,amount,price,yprice,nprice FROM patdata WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");
  print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ใบแจ้งรายการผู้ป่วย<br>";
    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;$sPtname, HN: $sHn ";
	print "<font face='Angsana New' size='3'>&nbsp;สิทธิ :$sPtright<br> ";
    print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;โรค: $sDiag, แพทย์ :$sDoctor<br>";
//    print "แพทย์ :$sDoctor<br><br>";

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
    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;รวมงิน  $sNetprice บาท";

    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;<b>(เบิกไม่ได้ $sSumNprice บาท</b>, เบิกได้$sSumYprice บาท)<br>";

// print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;เจ้าหน้าที่ผู้บันทึก...........................................<br>";
?>


