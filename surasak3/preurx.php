<?php
    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("                          ราคาขาย  ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aMoney= array("       รวมเงิน   ");
    $Netprice="";   

//    $cBilldate=$billdate;
    $cBillno=$billno;
    $cDepcode=$depcode;

    $sDcode="";
    session_register("sDcode");

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");

//    session_register("cBilldate");
    session_register("cBillno");
    session_register("cDepcode"); 

    $nRunno="";
    session_register("nRunno");

//runno  for chktranx
    include("connect.inc");
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'stkbill'";
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

    $query ="UPDATE runno SET runno = $nRunno WHERE title='stkbill'";
    $result = mysql_query($query)
        or die("Query failed");
    include("unconnect.inc");
//end  runno  for chktranx

  echo "หน่วยเบิก: $cDepcode  <br>";
  echo "เลขที่ใบเบิก: $cBillno <br>";

?>
<a href="dguseek.php">จ่ายยาเวชภัณฑ์</a>






