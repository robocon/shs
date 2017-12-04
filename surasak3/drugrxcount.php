<?php
  include("connect.inc");
//$n=row_id
$nTotal=0;
  for ($n=11990; $n<=998277; $n++){
       $query = "SELECT row_id,drugcode,amount FROM drugrx  where row_id=$n and amount>0 ";
       $result = mysql_query($query) or die("Query failed");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }
/////////
	if(mysql_num_rows($result)){
	   $nRow_id=$row->row_id;
        $nAmount=$row->amount;
	    $nTotal=$nTotal+$nAmount;
		print"row_id= $nRow_id , nAmount= $nAmount , totalamount= $nTotal<br>";
													}
         }
include("unconnect.inc");
print "<br>nTotal= $nTotal<br>";
?>

