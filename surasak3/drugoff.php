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

    print"<b>--------แก้ไขรายการ -------</b><br>";
    print"รหัส: $cDrugcode<br>";
    print"ชื่อการค้า: $cTradname<br>";

    print"<form method='POST' action='dgoffok.php'>";
    print"วิธีใช้........................<input type='text' name='slcode' size='15' value='$cSlcode'><br>";
    print"จำนวน......................<input type='text' name='amount' size='15' value='$nAmount'><br>";
  print "<p>งดใช้ ?.....................</td>";
  print " <select  name='onoff'>";
  print " <OPTION value='$cOnoff'>";
  print " <option value='$cOnoff' selected>$cOnoff</option>";
//  print " <option value='0' ><-เลือก-></option>";
  print "<option value='ON'>ON</option>";
  print "<option value='OFF'>OFF</option>";
  print "</select></font>";
  print"<br><input type='submit' value='        ตกลง        ' name='B1'></font><p>";

//ลบรายการออกจาก drug profile
	print "<br><b>---------ลบรายการ---------</b><br>";
	print "ต้องการลบรายการนี้ ออกจาก drug profile<br>";
    print "<a target=_self href='delprofi.php'>ยืนยันการลบ</a>";

	print"</form>";
?>