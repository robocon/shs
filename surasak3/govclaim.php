<?php
	//add field ptright to opacc 
	//add row title numreport to runno
    $today=date();
	//2550-10-23 15:30:25
	//0123456789
	$thyear=substr($today,0,4);
	$adyear=$thyear-543;
	$mon=substr($today,5,2);
	$day=substr($today,8,2);

//runno  for numreport
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'numreport'";
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

    $nRunno=$row->numreport;
    $nRunno++;

    $query ="UPDATE runno SET runno = $nRunno WHERE title='numreport'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for numreport


	include("connect.inc");
    $query="CREATE TEMPORARY TABLE govclaim SELECT * FROM opacc WHERE ptright='R03&nbsp;โครงการเบิกจ่ายตรง' and date LIKE '$thyear$mon$day%'";
    $result = mysql_query($query) or die("Query failed,opday");
//    echo mysql_errno() . ": " . mysql_error(). "\n";
//    echo "<br>";
   $query="SELECT * FROM govclaim";
   $result = mysql_query($query);
   $nrecords = mysql_num_rows($result);
   ///////list govclaim to check validity
  $query = "SELECT date,hn,price,nessdn,dpn,dsy,dsn FROM govclaim";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$hn,$price,$nessdn,$dpn,$dsy,$dsn) = mysql_fetch_row ($result)) {
	    $notclaim=$nessdn+$dpn+$dsy+$dsn;
		$vtime=substr($date,11,8);
		$hr=substr($vtime,11,2);
		$min=substr($vtime,14,2);
		$sec=substr($vtime,17,2);
		print (" <tr>\n".
           "  <td><font face='Angsana New'>01||$adyear-$mon-$day $vtime|11512|01$adyear$mon$day$hr$min$sec|01$adyear$mon$day$hr$min$sec|$hn||$price|$notclaim||</td>\n".
           " </tr>\n");
      }

   ///print report  ///////////////////////////
print" &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;BILLTRAN$adyear$mon$day<br>";
print"(HCODE)11512(/HCODE)<br>";
print"(HNAME)ค่ายสุรศักดิ์มนตรี(/HNAME)<br>";
print"(DATETIME)date()(/DATETIME)<br>";
print"(SESSNO)$nRunno(/SESSNO)<br>";
print"(RECCOUNT)$nrecords(/RECCOUNT)<br>";
print"(BILLTRAN)<br>";

  $query = "SELECT date,hn,price,nessdn,dpn,dsy,dsn FROM govclaim";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$hn,$price,$nessdn,$dpn,$dsy,$dsn) = mysql_fetch_row ($result)) {
	    $notclaim=$nessdn+$dpn+$dsy+$dsn;
		$vtime=substr($date,11,8);
		$hr=substr($vtime,11,2);
		$min=substr($vtime,14,2);
		$sec=substr($vtime,17,2);
		print (" <tr>\n".
           "  <td><font face='Angsana New'>01||$adyear-$mon-$day $vtime|11512|01$adyear$mon$day$hr$min$sec|01$adyear$mon$day$hr$min$sec|$hn||$price|$notclaim||</td>\n".
           " </tr>\n");
      }

print"(/BILLTREN)<br>";
print"(END)????(/END)";
?>

