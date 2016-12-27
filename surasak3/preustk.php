<?php
    session_start();
    session_unregister("acstkcut");
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aExpdate");
    session_unregister("aLotno");
    session_unregister("aAmount");
    session_unregister("aUnitpri");
    session_unregister("aUnit");
    session_unregister("aDglotno");
    session_unregister("aStkcut");
    session_unregister("aNetlot");
    session_unregister("cTotal");
    session_unregister("cRestkcut");
    session_unregister("cCompany");
    session_unregister("aTotalstk");
    session_unregister("aMainstk");
    session_unregister("aStock");
    session_unregister("aPart");

    session_unregister("cBillno");
    session_unregister("cDepcode"); 
//    $cBilldate=$billdate;
    $cBillno=$billno;
    $cDepcode=$depcode;

    $acstkcut=0; //accumulate Stkcut ในแต่ละdrugcode
    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aExpdate = array("  วันหมดอายุ");
    $aLotno = array(" Lot.No");
    $aAmount = array("  amount");

    $aUnitpri  = array("ราคาทุน");

    $aUnit = array(" หน่วย");
    $aDglotno = array(" dgexplot");
    $aStkcut = array("  เบิก");
    $aNetlot = array("เหลือในLot");

    $cTotal="";
    $cRestkcut="";
    $cCompany="";

    $aTotalstk = array("  totalstk");
    $aMainstk = array("  mainstk");
    $aStock = array("  stock");
    $aPart = array("part");

    session_register("acstkcut");
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aExpdate");
    session_register("aLotno");
    session_register("aAmount");
    session_register("aUnitpri");
    session_register("aUnit");
    session_register("aDglotno");
    session_register("aStkcut");
    session_register("aNetlot");
    session_register("cTotal");
    session_register("cRestkcut");
    session_register("cCompany");
    session_register("aTotalstk");
    session_register("aMainstk");
    session_register("aStock");
    session_register("aPart");

//    session_register("cBilldate");
    session_register("cBillno");
    session_register("cDepcode"); 

  echo "หน่วยเบิก: $cDepcode  <br>";
  echo "เลขที่ใบเบิก: $cBillno <br>";

//runno  for chktranx
    session_unregister("nChktranx");
    $nChktran="";
    session_register("nChktran");

 If ($cDepcode=='ห้องจ่ายยา'){
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

    $nChktran=$row->runno;
    $nChktran++;

    $query ="UPDATE runno SET runno = $nChktran WHERE title='stkbill'";
    $result = mysql_query($query)
        or die("Query failed");
    include("unconnect.inc");
    }
//end  runno  for chktranx
?>
<a href="stkseek.php">เบิกยาเวชภัณฑ์</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>






