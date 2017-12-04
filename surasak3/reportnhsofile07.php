<?php
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="testing.csv"'); 
 
include("connect.inc");

 //$query="CREATE TEMPORARY TABLE reportnhso1 SELECT hn,an,dateadm,timeadm,datedsc,timedsc,dischs,discht,warddsc,dept FROM nhso07 WHERE date LIKE '$yrmonth%' ";
// $result = mysql_query($query) or die("Query failed,warphar1");

$sql = "select * from nhso07";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery);

$i=0;
while ($i < $num_rows)
{
$result= mysql_fetch_array($dbquery);

echo "$result[hn],$result[an],$result[dateadm],$result[timeadm],$result[datedsc],$result[timedsc],$result[dischs],$result[discht],$result[warddsc],$result[dept],\n";

$i++;
} 
   include("unconnect.inc");










?>