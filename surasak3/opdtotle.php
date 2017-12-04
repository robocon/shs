<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
//oprxitem.php
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
	session_unregister("sVn");
    session_unregister("sPtright");
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
    $sPtright="";
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
    session_register("sPtright");
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
    $sPtright=$row->ptright;
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
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New'>เบิกได้?</th>
 </tr>
<?php
    $query = "SELECT tradname,amount,price,part FROM drugrx WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");

    print "<font face='Angsana New'>$sPtname<br> ";
    $ptright=substr($sPtright,4);
    $doctor=substr($sDoctor,5);
    print "HN: $sHn, สิทธิ์:$ptright<br>";
    print "โรค: $sDiag, แพทย์ :$doctor<br>";

    while (list ($tradname,$amount, $price,$part) = mysql_fetch_row ($result)) {
//        array_push($aPrice,$price);
//        $x++;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
      }

    if (empty($sAn) && $sNetprice > 0){
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>(55020/55021)ค่าบริการผู้ป่วยนอก</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>1</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>50.00</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>เบิกได้</td>\n".
           " </tr>\n");
                           }
//กรณีคืนยา จะติดลบ
    if (empty($sAn) && $sNetprice < 0){
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>(55020/55021)ค่าบริการผู้ป่วยนอก</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>-1</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>-50.00</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>เบิกได้</td>\n".
           " </tr>\n");
                           }
    include("unconnect.inc");
?>
</table>
<?php
    $pay=$sNessdn+$sDPN+$sDSY+$sDSN;

//  OPD CASE
    if (empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice+50;
           $cPaid=$sNetprice+50; //opd case เก็บ 50 บาท
           $free=$sEssd+$sNessdy+$sDPY+'50';
                            }

    if (empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice-50;
           $cPaid=$sNetprice-50; //opd case คืนยา,  คืนเงิน 50 บาท
           $free=$sEssd+$sNessdy+$sDPY-'50';
                            }
//  IPD CASE
    if (!empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }
//ipd case คืนยา
    if (!empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }

    $cPaid=number_format($cPaid,2,'.','');
    print "รวมงิน  $xNetpri บาท (<font face='Angsana New' size='5'><b>เบิกไม่ได้ $pay บาท</b>, เบิกได้ $free บาท)<br>";

    if (substr($sPtright,0,3)=='R03'){
          $cPaid= $pay;
          $cPaid=number_format($cPaid,2,'.','');
          print "<font face='Angsana New' size='5'><b>ผู้ป่วยสิทธิ: $ptright</b>";
          print "<form method='POST' action='oprxcscd.php'>";
          print "เก็บเงินส่วนที่เบิกไม่ได้&nbsp;&nbsp;&nbsp; <input type='text' name='xpaid' size='10' 	                                		value=$cPaid>&nbsp;&nbsp;บาท<br>";
 ///////ใช้บัตรเครดิด
         print "<font face='Angsana New' size='3'>ใช้บัตรเครดิด ?&nbsp;&nbsp;&nbsp;";
		 print"<INPUT TYPE='radio' NAME='credit' VALUE='กรุงเทพ'>ธ.กรุงเทพ";
  		 print"&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ทหารไทย'>ธ.ทหารไทย<br>";
////////
		  print "<input type='submit' value='เก็บเงินออกใบเสร็จ ส่วนที่เบิกไม่ได้' name='B1'>";
          print "</form>";
		}
    else {
          print "<form method='POST' action='oprxbill.php'>";
          print "เก็บเงิน&nbsp;&nbsp;&nbsp; <input type='text' name='xpaid' size='10' value=$cPaid>&nbsp;&nbsp;บาท<br>";
		   ///////ใช้บัตรเครดิด
         print "<font face='Angsana New' size='3'>ใช้บัตรเครดิด ? &nbsp;&nbsp;&nbsp;";
		 print"<INPUT TYPE='radio' NAME='credit' VALUE='กรุงเทพ'>ธ.กรุงเทพ";
  		 print"&nbsp;&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ทหารไทย'>ธ.ทหารไทย<br>";
////////

          print "<input type='submit' value='เก็บเงิน  ออกใบเสร็จ' name='B1'>";
          print "</form>";
	}

 

?>

