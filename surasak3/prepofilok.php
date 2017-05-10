<?php
    session_start();
    include("connect.inc");

//update data in pocompany
        $query ="UPDATE pocompany SET  depart='$depart',
								departno='$departno',
								departdate='$departdate',
								prepono='$prepono', 
  		                        prepodate = '$prepodate',
				pono='$pono', 
				ponoyear='$ponoyear', 
  		                        podate = '$podate',
  		                        bounddate = '$bounddate',
								chkindate = '$chkindate',
								senddate = '$senddate'
                       WHERE  row_id='$xRow_id' ";
        $result = mysql_query($query)
                       or die("Query failed,update pocompany");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

include("unconnect.inc");
print "...............<br>";
print "...............<br>";
print "...............<br>";
print "...............<br>";
print "...............บันทึกข้อมูลเรียบร้อย<br>";

    session_unregister("xRow_id");
?>


