<?php
    session_start();
    print"(�Ҥ����sPrice)=$sPrice, row_id=$cRow_id , $cDrugcode<br>";
    $re_price=$amount*$packpri; //�Ҥ����
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
    print"˹��¹Ѻ......................$packing<br>";
    print"��Ҵ��è�...................$pack<br>";
    print"�ӹǹ�ҧ�дѺ.........$minimum<br>";
   // print"�ӹǹ����ѧ............ $nTotalstk ˹���<br>";    
    print"�Ҥ�(���VAT)...........$packpri<br>";
    print"�ӹǹ���.....................$amount<br>";
    print"�Ҥ����������............$re_price �ҷ<br>";
    print"��................................$free<br>";
    print"specno. .........................$specno<br>";
    session_unregister("xNetpri");
    session_unregister("sPrice");
?>

