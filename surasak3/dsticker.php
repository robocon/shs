<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM ddepart WHERE date = '$dDate'";
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
    $cHn=$row->hn;
    $cAn=$row->an;
    $cPtname=$row->ptname;

//print sticker
    $sticker=3;
    for($i=1; $i<=$sticker; $i++){
       print "<font face='Angsana New' size='1'>$Thaidate<br></font>";
       IF (!empty($cAn)) {
                  print "<font face='Angsana New' size='1'>IPD,AN:$cAn,HN:$cHn<br></font>";
		   }
       ELSE {
                  print "<font face='Angsana New' size='1'>OPD,HN:$cHn<br></font>";
                 };
       print "<font face='Angsana New' size='1'>$cPtname<br></font>";

//list items
    $query = "SELECT code FROM dpatdata WHERE date = '$dDate' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code) = mysql_fetch_row ($result)) {
             print "<font face='Angsana New' size='1'>$code,</font>";
      }
    print "<br><br><br><br>";
	};
    include("unconnect.inc");
?>
