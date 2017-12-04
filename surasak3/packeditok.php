<?php
    session_start();
    print"(ราคาเดิมsPrice)=$sPrice, row_id=$cRow_id , $cDrugcode<br>";
    $re_price=$amount*$packpri; //ราคาใหม
    include("connect.inc");
        $query ="UPDATE poitems SET 
	    packing='$packing',
	    pack='$pack',
	    minimum='$minimum',
	    packpri='$packpri',
  amount='$amount',
  price='$re_price',
	    free='$free',
	    specno='$specno'
              WHERE  row_id='$cRow_id' ";
        $result = mysql_query($query)
              or die("Query failed,update poitems");
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "<br>";

        $query ="UPDATE pocompany SET 
	    netprice=netprice-$sPrice+$re_price    
              WHERE  row_id='$Pocomrow' ";
        $result = mysql_query($query)
              or die("Query failed,update pocompany");
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "<br>";
///
        $query ="UPDATE druglst SET
	     pack='$pack',
	    minimum='$minimum',
	    specno='$specno'
              WHERE  drugcode='$cDrugcode' "; 
        $result = mysql_query($query)
              or die("Query failed,update druglst drugcode=$cDrugcode");
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "<br>";

    include("unconnect.inc");
    print"หน่วยนับ......................$packing<br>";
    print"ขนาดบรรจุ...................$pack<br>";
    print"จำนวนวางระดับ.........$minimum<br>";
   // print"จำนวนคงคลัง............ $nTotalstk หน่วย<br>";    
    print"ราคา(รวมVAT)...........$packpri<br>";
    print"จำนวนสั่ง.....................$amount<br>";
    print"ราคารวมทั้งสิ้น............$re_price บาท<br>";
    print"แถม................................$free<br>";
    print"specno. .........................$specno<br>";
    session_unregister("xNetpri");
    session_unregister("sPrice");
?>

