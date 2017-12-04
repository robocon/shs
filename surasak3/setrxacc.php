<?php
include("connect.inc");

set_time_limit(0);

$sql_c = "CREATE TEMPORARY TABLE drugrx2 Select drugcode, date,amount  From drugrx where  (`date` between '2551-01-01 00:00:00' AND '2552-02-17 00:00:00')  ";
$result_c = Mysql_Query($sql_c) or Mysql_error();

$sql = "Select row_id, drugcode From druglst   Order by row_id ASC";
$result = Mysql_Query($sql);
$i=1;
while($arr = Mysql_fetch_assoc($result)){

$sql2 = "Select sum(amount) as amount_drug From drugrx2 where drugcode = '".$arr["drugcode"]."' AND (`date` between '2551-01-01 00:00:00' AND '2552-02-17 00:00:00') ";
$result2 = Mysql_Query($sql2);
list($rows) = Mysql_fetch_row($result2);

	$sql3 = "UPdate druglst set rxaccum = '$rows', rx1day = '$rows' where drugcode = '".$arr["drugcode"]."' limit 1";
	$result3 = Mysql_Query($sql3);
	if($result3)
		echo $arr["row_id"],"<BR>";
	else
		echo "Cannot ",$arr["row_id"],"<BR>";

}


include("unconnect.inc");

?>