<?php
    session_start();
    session_start();//for security
    if (isset($sIdname)){} else {die;} //for security
//oprxitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
	session_unregister("sVn");
    session_unregister("sPtname");
    session_unregister("sDoctor");
    session_unregister("sEssd");
    session_unregister("sNessdy");
    session_unregister("sNessdn");
    session_unregister("sDPY");
    session_unregister("sDPN");
    session_unregister("sDSY");
    session_unregister("sDSN");
    session_unregister("sNetprice");
    session_unregister("sDiag"); 
    session_unregister("sAccno"); 
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("aMoney"); 
//   
    $dDate=$sDate;
    $sHn="";
    $sAn="";
    $sPtname="";
    $sDoctor="";
    $sEssd="";
    $sNessdy="";
    $sNessdn="";
    $sNetprice="";
    $sDPY="";
    $sDPN="";  
  
    $sDSY="";
    $sDSN="";    

    $sDiag="";
    $sRow_id=$nRow_id;
    $sAccno=$nAccno;

    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("                          ราคาขาย  ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aSlipcode = array("        วิธีใช้   ");
    $aMoney= array("       รวมเงิน   ");
    $sRow=array("row_id of ipacc");

    session_register("dDate");  
    session_register("sHn");   
    session_register("sAn");
	session_register("sVn");
    session_register("sPtname");
    session_register("sDoctor");
    session_register("sEssd");
    session_register("sNessdy");
    session_register("sNessdn");
    session_register("sDPY");
    session_register("sDPN");
    session_register("sDSY");
    session_register("sDSN");
    session_register("sNetprice");
    session_register("sDiag"); 
    session_register("sAccno"); 
    session_register("sRow_id"); 
    session_register("sRow"); 

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aSlipcode");
    session_register("aMoney");
   
    include("connect.inc");
  
 $query = "SELECT * FROM phardep WHERE row_id = '$nRow_id' "; 
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
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sDSY=$row->dsy;
    $sDSN=$row->dsn;     
    $sNetprice=$row->price;
    $sDiag=$row->diag;
	$_SESSION["sVn"]=$row->tvn;
    $cPaid=$sNetprice;
?>

<table>
 <tr>
  <th bgcolor=CD853F>รายการ</th>
  <th bgcolor=CD853F>จำนวน</th>
  <th bgcolor=CD853F>ราคา</th>
 </tr>

<?php
    $query = "SELECT tradname,amount,price FROM drugrx WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");

    print "$sPtname, HN: $sHn<br> ";
    print "โรค: $sDiag, แพทย์ :$sDoctor<br>";
//    print "แพทย์ :$sDoctor<br><br>";

    while (list ($tradname,$amount, $price) = mysql_fetch_row ($result)) {
//        array_push($aPrice,$price);
//        $x++;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$tradname</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
?>
</table>

<?php
    print "รวมงิน  $sNetprice บาท<br>";
    print "<form method='POST' action='ndfoprxbill.php'>";
    print "เก็บเงิน&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10' value=$cPaid>&nbsp;&nbsp;บาท<br>";
    print "<input type='submit' value='เก็บเงิน  ออกใบเสร็จ' name='B1'>";
    print "</form>";
?>


