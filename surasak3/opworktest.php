<?php
session_start();
if (isset($sOfficer)){} else {die;} //for security

$thdatehn="";
$thidate2 = (date("Y")).date("-m-d H:i:s"); 
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$thidate3 = (date("Y")+543).date("-m-d"); 

$time=date("H:i:s");
session_register("thdatehn"); 
session_register("admit_vn"); 

include("connect.inc");   
//หา VN จาก runno table
$query = "SELECT *,now() as now,@@session.time_zone as time_zone FROM runno WHERE title = 'VN'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

//  	    $cTitle=$row->title;  //=VN
date_default_timezone_set("Asia/Bangkok");
echo "PHP SERVER TIMEZONE:&nbsp;".date_default_timezone_get()."<br />";
$now = $row->now;
$time_zone = $row->time_zone;
$nVn=$row->runno;
$dVndate=$row->startday;
$dVndate=substr($dVndate,0,10);
$today = date("Y-m-d");  
echo $today."Today:<br />";
echo $dVndate."VN DATE<br />";
echo $nVn."nVN<br />";
echo date("Y-m-d H:i:s").":PHP SERVER DATE TIME<br />";
echo $now.":DB TIME NOW";
echo $time_zone;

include("unconnect.inc");
?>
