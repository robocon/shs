<?php
    include("connect.inc");
    $query = "SELECT * FROM company WHERE comcode = '$Compcode' ";
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

      $cComname=$row->comname;
      $cComaddr=$row->comaddr;
      $cAmpur=$row->ampur;
      $cChangwat=$row->changwat;
      $cTel      =$row->tel;

      print "$cComname<br> ";
      print "$cComaddr<br> ";
      print "$cAmpur<br> ";
      print "$cChangwat<br> ";
      print "$cTel<br> ";

   include("unconnect.inc");
?>