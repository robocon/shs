<?php
    include("connect.inc");
    $query = "SELECT * FROM drugslip WHERE slcode = '$vSlcode' ";
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

      $cDetail1=$row->detail1;
      $cDetail2=$row->detail2;
      $cDetail3=$row->detail3;
      $cDetail4=$row->detail4;

      print "$cDetail1<br> ";
      print "$cDetail2<br> ";
      print "$cDetail3<br> ";
      print "$cDetail4<br> ";

   include("unconnect.inc");
?>