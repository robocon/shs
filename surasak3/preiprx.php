<?php
    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("                          ราคาขาย  ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aSlipcode = array("        วิธีใช้   ");
    $aMoney= array("       รวมเงิน   ");
    $Netprice="";   

    $cHn="";
    $cPtname="";
    $cPtright=""; 
    $cAccno="";

    $cAn=$an;  
    $cDoctor="";
    $cIdname="";
    $cDiag=""; 
    $aEssd=array("Essd");
    $aNessdy=array("Nessdy");
    $aNessdn=array("Nessdn");
    $aDPY=array("DPY");
    $aDPN=array("DPN");
    $aDSY=array("DSY");
    $aDSN=array("DSN");     

    $sDcode="";
    $sSlip="";

    $nRunno="";
    session_register("nRunno");

    session_register("sDcode");
    session_register("sSlip");

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aSlipcode");
    session_register("aMoney");
    session_register("Netprice");
    session_register("cHn"); 
    session_register("cPtright");
    session_register("cPtname");
    session_register("cAccno");

    session_register("cAn");
    session_register("cDoctor");
    session_register("cIdname");
    session_register("cDiag");
    session_register("aEssd");
    session_register("aNessdy");
    session_register("aNessdn");
    session_register("aDPY");
    session_register("aDPN");
    session_register("aDSY");
    session_register("aDSN");

    include("connect.inc");

//seek $an in bed
    $query = "SELECT * FROM bed WHERE an = '$an'";
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
   If ($result){
      $cPtname= $row->ptname;
      $cPtright = $row->ptright;
      $cDoctor= $row->doctor;      
      $cHn=$row->hn;
      $cAn=$row->an;
      $cDiag= $row->diagnos;
      $cAccno=$row->accno;
//runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'phardep'";
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

    $query ="UPDATE runno SET runno = $nRunno WHERE title='phardep'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
       
      echo "โปรดตรวจสอบชื่อผู้ป่วย  เพื่อความถูกต้องก่อนจ่ายยา<br><br>";
      echo "HN : $cHn, ชื่อ: $cPtname,  สิทธิการรักษา : $cPtright<br> ";
      echo "AN : $cAn,    โรค: $cDiag,  แพทย์: $cDoctor<br>";
           }  
   else {
      echo "ไม่พบ AN : $an ในข้อมูลผู้ป่วยใน หรือจำหน่ายผู้ป่วยแล้ว ";
           }  
  
 include("unconnect.inc");  
		     $tvn=$an;
session_register("tvn");
?>
<a href="dgipseek.php">จ่ายยา</a>






