<?php
    session_start();
    session_unregister("cRow_id");
    $cRow_id=$Delrow;
    session_register("cRow_id");

    include("connect.inc");
    $query = "SELECT * FROM dgprofile WHERE row_id = '$Delrow' ";
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


    include("unconnect.inc");

    print"<b>--------�����¡�� -------</b><br>";
    print"����: $cDrugcode<br>";
    print"���͡�ä��: $cTradname<br>";

    print"<form method='POST' action='dgoffok.php'>";
    print"�Ը���........................<input type='text' name='slcode' size='15' value='$cSlcode'><br>";
    print"�ӹǹ......................<input type='text' name='amount' size='15' value='$nAmount'><br>";
  print "<p>���� ?.....................</td>";
  print " <select  name='onoff'>";
  print " <OPTION value='$cOnoff'>";
  print " <option value='$cOnoff' selected>$cOnoff</option>";
//  print " <option value='0' ><-���͡-></option>";
  print "<option value='ON'>ON</option>";
  print "<option value='OFF'>OFF</option>";
  print "</select></font>";
  print"<br><input type='submit' value='        ��ŧ        ' name='B1'></font><p>";

//ź��¡���͡�ҡ drug profile
	print "<br><b>---------ź��¡��---------</b><br>";
	print "��ͧ���ź��¡�ù�� �͡�ҡ drug profile<br>";
    print "<a target=_self href='delprofi.php'>�׹�ѹ���ź</a>";

	print"</form>";
?>