<?php
   session_start();

    $x=0;
    $aDgcode = array("����");
    $aTrade  = array("��¡��");
    $aPrice  = array("�Ҥ� ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aMoney= array("       ����Թ   ");
    $Netprice="";   

    $cPart="";

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");

    session_register("cPart");
///
    include("connect.inc");
       $query = "SELECT code FROM labcare WHERE code = '$suitcode'";
       $result = mysql_query($query) or die("Query failed");

        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

       if(mysql_num_rows($result)){
                   print "�����ٵ� $suitcode ��ӷ����������� �ô����¹����<br>";
    		                   }
        else{
 	   $cSuitname=$suitname;
	   $cSuitcode=$suitcode;
	   print "�����ٵ� :$suitname<br>";
	   print "�����ٵ� :$suitcode<br>";
                   print "<a href='suitseek.php'>����¡�õ���</a>";
	      }
    include("unconnect.inc");
?>







