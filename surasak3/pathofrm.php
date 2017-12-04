<?php
   session_start();

    $cDepart = 'PATHO';
   $cDetail=$cDiag;
   $cTitle="รหัสรายการตรวจห้องพยาธิ";
   session_register("cDepart");
   session_register("cDetail");
   session_register("cTitle");

   $m=0;
    $aLabcode = array("รหัส");
    $aDetail  = array("รายการ");
    $aEachprice  = array("ราคา ");
    $aLabpart = array("part");
    $aTime = array("        จำนวน   ");
    $aItemprice= array("       รวมเงิน   ");
    $nLabprice="";   
    $cLabpart="";
    $cAccno=0;
    session_register("m");
    session_register("aLabcode");
    session_register("aDetail");
    session_register("aEachprice");
    session_register("aLabpart");
    session_register("aTime");
    session_register("aItemprice");
    session_register("nLabprice");
    session_register("cLabpart");
    session_register("cAccno"); 

    $aYprice = array("ราคา ");
    $aNprice = array("ราคา ");
    $aSumYprice = array("ราคา ");
    $aSumNprice = array("ราคา ");
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");

	//begin  runno  for chktranx
    $nChktranx="";
    session_register("nChktranx");
    include("connect.inc");
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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
    $nChktranx=$row->runno;
    $nChktranx++;
    $query ="UPDATE runno SET runno = $nChktranx WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
   include("unconnect.inc");

   print "ตรวจ LAB :$cDiag<br>";
   print "*โปรดเลือกวิธีสั่งตรวจ*<br>";
   print"<a target=_BLANK href='labform.php'>Check Box</a><br>";
   print"<a target=_BLANK href='lablist.php'>เลือกรายการจากห้อง LAB</a><br>";
   print"<a target=_BLANK href='labsuit.php'>ใช้สูตร</a><br>";
?>



