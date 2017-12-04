<?php
//เปลี่ยนปีไทยเป็นปี คศ.
/*
$cGetdate="2549-01-30";
	if (substr($cGetdate,0,4)=='2549'){
		$cYear="2006";  // 2549-02-12
		$cMonth=substr($cGetdate,5,2);
		$cDay=substr($cGetdate,8,2);
		$nGetdate=$cYear."-".$cMonth."-".$cDay;
		print"getdate=$cGetdate, year=$cYear, month=$cMonth, date=$cDay,nGetdate=$nGetdate<br>";
			}
*/
   include("connect.inc");
//1-->27399
  for ($n=1; $n<=27399; $n++){

        $query = "SELECT date,getdate FROM stktranx  WHERE row_id= $n ";
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
        if(mysql_num_rows($result)){
        	$cGetdate = $row->date;
			}

	if (substr($cGetdate,0,4)=='2548'){
		$cYear=substr($cGetdate,0,4)-543;  // 2549-02-12
		$cMonth=substr($cGetdate,5,2);
		$cDay=substr($cGetdate,8,2);
		$nGetdate=$cYear."-".$cMonth."-".$cDay;
		print"$n, getdate=$cGetdate, year=$cYear, month=$cMonth, date=$cDay,nGetdate=$nGetdate<br>";

	        $query ="UPDATE stktranx SET date = '$nGetdate'
               		        WHERE row_id= '$n' ";
	        $result = mysql_query($query)
                  	        or die("Query failed,update stktranx");
			}

  }


 include("unconnect.inc");
?>




