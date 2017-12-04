<?php
  session_start();
  include("connect.inc");
  
  function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

$diag=jschars($_POST['diag']);
  
  if ($diag==''){$diag='ไม่มี';};
  $query ="UPDATE bed SET diag1='$diag' WHERE bedcode='$cBedcode' ";
  $result = mysql_query($query)
        or die("Query failed bed");
  include("unconnect.inc");
  If (!$result){
         echo "new diagnosis fail <br>";
         echo mysql_errno() . ": " . mysql_error(). "\n";
         }
  else {
         print " แก้ไขการวินิจฉัยใหม่เป็น : $diag <br>";
         print "  ปิดหน้าต่างนี้   แล้ว Refresh หน้าต่างหอผู้ป่วยเพื่อทำข้อมูลให้เป็นปัจจุบัน";
         }
//  session_destroy();
    //ipdata.php
/*
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister('cDate');
    session_unregister('cBedcode');
    session_unregister('cBed');
    session_unregister('cPtname');
    session_unregister('cAge');
    session_unregister('cPtright');
    session_unregister('cDoctor');
    session_unregister('cHn');
    session_unregister('cAn');
    session_unregister('cDiag');
    session_unregister('cBedpri');
    session_unregister('cChgdate');
    session_unregister('cBedname');
    session_unregister('cAccno');
*/
    session_unregister('cBedcode');
    session_register("Bedcode");
////
?>
 