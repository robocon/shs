<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

    include("connect.inc");
    $query = "SELECT * FROM dgprofile WHERE row_id = '$cRow_id' ";
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
		 $cDrugcode=$row->drugcode;
		 $cTradname=$row-> tradname ;
	     $nSalepri=$row->salepri ;
		  $nAmount=$row->amount;
		 $nPrice=$row->price ;
		 $cSlcode=$row->slcode; 
		 $cOnoff=$row->onoff ;
        $re_price=$amount*$nSalepri; //�Ҥ�����
        //print "slcode $slcode,amount $amount ,re_price $re_price, onoff $onoff ,cRow_id $cRow_id ";
 
        $query ="UPDATE dgprofile SET 
	    slcode='$slcode',
	    amount='$amount',
        price='$re_price',
		onoff='$onoff',
	    dateoff='$Thidate',
	    officer='$sOfficer'
              WHERE  row_id='$cRow_id' ";
        $result = mysql_query($query)
              or die("Query failed,update dgprofile");
        echo mysql_errno() . ": " . mysql_error(). "\n";
        echo "<br>";

    include("unconnect.inc");
    print"����: $cDrugcode,   ���͡�ä��: $cTradname<br>";
    print"�Ը���....................��� $cSlcode  ����¹�� $slcode<br>";
    print"�ӹǹ/�ѹ...........����ӹǹ  $nAmount  ����¹��  $amount <br>";
	print"�Ҥ�.....................$nSalepri  �ҷ<br>";
    print"�Ҥ����............. ���  $nPrice  �ҷ  ����¹��  $re_price �ҷ<br>";
    print"ʶҹ�.................��� $cOnoff  ����¹�� $onoff �ҷ<br>";
?>


